<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once 'biagiotti-instagram-helper.php';

/**
 * Class BiagiottiInstagramApi
 */
class BiagiottiInstagramApi {
	private $instagram_client_id;
	private $instagram_redirect_uri;
	private $instagram_code;
	private $instagram_user_id;
	private $instagram_access_token;
	private $instagram_access_token_long_lived;

	private $facebook_client_id;
	private $facebook_secret;
	private $facebook_redirect_uri;
	private $facebook_code;
	private $facebook_access_token;

	private static $instance;
	private $helper;

	const INSTAGRAM_CODE                  = 'biagiotti_instagram_code';
	const INSTAGRAM_USER_ID               = 'biagiotti_instagram_user_id';
	const INSTAGRAM_TOKEN                 = 'biagiotti_instagram_access_token';
	const INSTAGRAM_TOKEN_LONG_LIVED      = 'biagiotti_instagram_access_token_long_lived';
	const INSTAGRAM_TOKEN_LONG_LIVED_TIME = 'biagiotti_instagram_access_token_long_lived_time';

	const FACEBOOK_CODE  = 'biagiotti_facebook_code';
	const FACEBOOK_TOKEN = 'biagiotti_facebook_access_token';

	const CONNECTION_TYPE = 'biagiotti_connection_type';

	/**
	 * Private constructor because of singletone pattern. It sets all necessary properties
	 */
	public function __construct() {
		$this->instagram_client_id               = '3961337950544094';
		$this->instagram_redirect_uri            = 'https://demo.qodeinteractive.com/instagram-app/instagram-redirect-secret.php';
		$this->instagram_code                    = get_option( self::INSTAGRAM_CODE );
		$this->instagram_user_id                 = get_option( self::INSTAGRAM_USER_ID );
		$this->instagram_access_token            = get_option( self::INSTAGRAM_TOKEN );
		$this->instagram_access_token_long_lived = get_option( self::INSTAGRAM_TOKEN_LONG_LIVED );

		$this->facebook_client_id    = '132128361763786';
		$this->facebook_secret       = '';
		$this->facebook_redirect_uri = 'https://demo.qodeinteractive.com/facebook-app/facebook-redirect.php';
		$this->facebook_code         = '';
		$this->facebook_access_token = get_option( self::FACEBOOK_TOKEN );

		$this->helper = new BiagiottiInstagramHelper();
	}

	public static function get_instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function get_helper() {
		return $this->helper;
	}

	/**
	 * Builds current page url that we use to redirect user to the page from which
	 * he made request to sign in to Instagram.
	 *
	 * @return string
	 */
	public function build_current_page_uri() {
		$protocol = is_ssl() ? 'https' : 'http';
		$site     = isset( $_SERVER['SERVER_NAME'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_NAME'] ) ) : '';
		$slug     = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

		$replaced_slug = str_replace( 'page=', 'page***', $slug );

		return rawurlencode( $protocol . '://' . $site . $replaced_slug );
	}

	/**
	 * Saves code that will be used when requesting token
	 */
	public function instagram_store_codes() {
		$return_object = new stdClass();
		// phpcs:ignore WordPress.Security.NonceVerification
		if ( isset( $_GET['status'] ) && 'error' === $_GET['status'] ) {
			// phpcs:ignore WordPress.Security.NonceVerification
			$return_object->message = isset( $_GET['message'] ) ? sanitize_text_field( wp_unslash( $_GET['message'] ) ) : '';

			return $return_object;
		} else {
			// phpcs:ignore WordPress.Security.NonceVerification
			$this->instagram_code = isset( $_GET['code'] ) ? sanitize_text_field( wp_unslash( $_GET['code'] ) ) : '';
			// phpcs:ignore WordPress.Security.NonceVerification
			update_option( self::INSTAGRAM_CODE, isset( $_GET['code'] ) ? sanitize_text_field( wp_unslash( $_GET['code'] ) ) : '' );
			// phpcs:ignore WordPress.Security.NonceVerification
			update_option( self::INSTAGRAM_USER_ID, isset( $_GET['user_id'] ) ? sanitize_text_field( wp_unslash( $_GET['user_id'] ) ) : '' );
			// phpcs:ignore WordPress.Security.NonceVerification
			update_option( self::INSTAGRAM_TOKEN, isset( $_GET['access_token'] ) ? sanitize_text_field( wp_unslash( $_GET['access_token'] ) ) : '' );
			// phpcs:ignore WordPress.Security.NonceVerification
			update_option( self::INSTAGRAM_TOKEN_LONG_LIVED, isset( $_GET['access_token_long'] ) ? sanitize_text_field( wp_unslash( $_GET['access_token_long'] ) ) : '' );
			// phpcs:ignore WordPress.Security.NonceVerification
			update_option( self::INSTAGRAM_TOKEN_LONG_LIVED_TIME, isset( $_GET['access_token_time'] ) ? sanitize_text_field( wp_unslash( $_GET['access_token_time'] ) ) : '' );

			return $return_object;
		}
	}

	/**
	 * Saves code that will be used when requesting token
	 */
	public function facebook_store_token() {
		// phpcs:ignore WordPress.Security.NonceVerification
		if ( isset( $_GET['access_token'] ) && ! empty( $_GET['access_token'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification
			$this->instagram_code = isset( $_GET['access_token'] ) ? sanitize_text_field( wp_unslash( $_GET['access_token'] ) ) : '';
			// phpcs:ignore WordPress.Security.NonceVerification
			update_option( self::FACEBOOK_TOKEN, isset( $_GET['access_token'] ) ? sanitize_text_field( wp_unslash( $_GET['access_token'] ) ) : '' );
		}
	}

	/**
	 * Saves code that will be used when requesting token
	 */
	public function set_connection_type( $type = '' ) {
		if ( ! empty( $type ) ) {
			update_option( self::CONNECTION_TYPE, $type );
		}
	}

	/**
	 * Retrieves images data from Instagram
	 *
	 * @param int $limit
	 * @param array $transient transient config
	 *
	 * @return mixed returns either array of retrieved data if request was successful, or it returns false if it wasn't
	 *
	 * @see BiagiottiInstagramApi::fetch_data()
	 */
	public function get_images( $limit = '', $transient = array() ) {
		$response = $this->fetch_data( $limit, $transient );

		if ( property_exists( $response, 'status' ) && 'ok' === $response->status ) {
			return $response->data;
		}

		return false;
	}

	/**
	 * Gets requested data from Instagram API
	 *
	 * @param int $limit how much images to retrieve
	 * @param array $transient transient config
	 *
	 * @return stdClass
	 */
	private function fetch_data( $limit = '', $transient = array( 'use_transient' => false ) ) {

		// refresh token.
		if ( get_option( self::INSTAGRAM_TOKEN_LONG_LIVED_TIME ) && get_option( self::INSTAGRAM_TOKEN_LONG_LIVED_TIME ) < strtotime( '1 month ago' ) ) {

			// long lived refresh.
			$long_lived_url           = wp_remote_get( 'https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=' . $this->instagram_access_token_long_lived );
			$long_lived_http_response = wp_remote_retrieve_body( $long_lived_url );
			$long_lived_http_body     = json_decode( $long_lived_http_response, true );
			update_option( self::INSTAGRAM_TOKEN_LONG_LIVED, $long_lived_http_body['access_token'] );
			update_option( self::INSTAGRAM_TOKEN_LONG_LIVED_TIME, strtotime( 'now' ) );
		}

		$return_object = new stdClass();
		// do we use transient and does it exists in the database?
		if ( $this->use_transients( $transient ) && get_transient( $transient['transient_name'] ) ) {
			// get transient value.
			$data = get_transient( $transient['transient_name'] );

		} else {

			if ( get_option( self::CONNECTION_TYPE ) === 'instagram' ) {
				if ( get_option( self::INSTAGRAM_TOKEN_LONG_LIVED_TIME ) ) {
					$url = wp_remote_get( 'https://graph.instagram.com/me/media?fields=media_url,caption,permalink,media_type,thumbnail_url&access_token=' . $this->instagram_access_token_long_lived . '&count=' . $limit );
				} else {
					$url = wp_remote_get( 'https://graph.instagram.com/me/media?fields=media_url,caption,permalink,media_type,thumbnail_url&access_token=' . $this->instagram_access_token . '&count=' . $limit );
				}
			} elseif ( get_option( self::CONNECTION_TYPE ) === 'facebook' ) {
				$url = wp_remote_get( 'https://graph.facebook.com/v8.0/me/accounts?access_token=' . $this->facebook_access_token );
			} else {
				$url = '';
			}

			// request data from API.
			$http_response = wp_remote_retrieve_body( $url );

			// is response an error.
			if ( is_wp_error( $http_response ) ) {
				$return_object->status  = 'error';
				$return_object->message = 'Can\'t connect with Instagram';

				return $return_object;
			}

			// parse returned JSON response to assoc array.
			$http_body = json_decode( $http_response, true );

			// if response code is something different than ok?
			if ( ! isset( $http_body ) ) {
				$return_object->status  = 'error';
				$return_object->message = 'Can\'t connect with Instagram';

				return $return_object;
			}

			if ( get_option( self::CONNECTION_TYPE ) === 'instagram' ) {
				$data = $http_body['data'];
			}

			if ( get_option( self::CONNECTION_TYPE ) === 'facebook' ) {
				$data       = array();
				$fb_api_url = 'https://graph.facebook.com/v8.0/';

				if ( isset( $http_body['data'] ) ) {
					foreach ( $http_body['data'] as $single_ig ) {
						$page_id = $single_ig['id'];
						// it can get more pages - we take first one.
						$pages_url      = wp_remote_get( $fb_api_url . $page_id . '?fields=instagram_business_account&access_token=' . $this->facebook_access_token );
						$pages_response = wp_remote_retrieve_body( $pages_url );
						$pages_body     = json_decode( $pages_response, true );

						if ( isset( $pages_body['instagram_business_account'] ) ) {
							$instagram_id = implode( $pages_body['instagram_business_account'] );
							// probably it can have more accounts also.
							$get_media      = wp_remote_get( $fb_api_url . $instagram_id . '/media?access_token=' . $this->facebook_access_token );
							$media_response = wp_remote_retrieve_body( $get_media );
							$media_body     = json_decode( $media_response, true );
							$multiple_image = $media_body['data'];

							foreach ( $multiple_image as $single_image_id ) {
								$single_image          = wp_remote_get( $fb_api_url . $single_image_id['id'] . '?fields=media_url,caption,permalink,media_type,thumbnail_url,username&access_token=' . $this->facebook_access_token );
								$single_image_response = wp_remote_retrieve_body( $single_image );
								$single_image_body     = json_decode( $single_image_response, true );
								$data[]                = $single_image_body;
							}
						}
					}
				}
			}

			// do we use transients?
			if ( $this->use_transients( $transient ) ) {
				// store transient so we can use it later.
				set_transient( $transient['transient_name'], $data, $transient['transient_time'] );
			}
		}

		if ( ( count( $data ) > $limit ) && '' !== $limit ) {
			$data = array_slice( $data, 0, $limit );
		}

		// prepare return object and return it.
		$return_object->status  = 'ok';
		$return_object->message = 'Success';
		$return_object->data    = $data;

		return $return_object;
	}

	/**
	 * Build disonnect url
	 *
	 * @return bool
	 */
	public function disconnect_url() {
		$protocol = is_ssl() ? 'https' : 'http';
		$site     = isset( $_SERVER['SERVER_NAME'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_NAME'] ) ) : '';
		$slug     = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

		return $protocol . '://' . $site . $slug . '&disconnect=yes';
	}

	/**
	 * Build reload url
	 *
	 * @return bool
	 */
	public function reload_url() {
		$protocol = is_ssl() ? 'https' : 'http';
		$site     = isset( $_SERVER['SERVER_NAME'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_NAME'] ) ) : '';
		$slug     = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
		$slug     = strstr( $slug, '&', true );

		return $protocol . '://' . $site . $slug;
	}

	/**
	 * Check reset database fields
	 *
	 * @return bool
	 */
	public function disconnect() {
		// phpcs:ignore WordPress.Security.NonceVerification
		if ( ! empty( $_GET['disconnect'] ) ) {
			update_option( self::INSTAGRAM_CODE, '' );
			update_option( self::INSTAGRAM_USER_ID, '' );
			update_option( self::INSTAGRAM_TOKEN, '' );
			update_option( self::INSTAGRAM_TOKEN_LONG_LIVED, '' );
			update_option( self::INSTAGRAM_TOKEN_LONG_LIVED_TIME, '' );
			update_option( self::FACEBOOK_CODE, '' );
			update_option( self::FACEBOOK_TOKEN, '' );
			update_option( self::CONNECTION_TYPE, '' );
		}

		return '';
	}

	/**
	 * Check if user has authorized our application
	 *
	 * @return bool
	 */
	public function has_user_connected() {
		$access_token_ig = get_option( self::INSTAGRAM_TOKEN_LONG_LIVED_TIME );
		$access_token_fb = get_option( self::FACEBOOK_TOKEN );

		return ! empty( $access_token_ig ) || ! empty( $access_token_fb );
	}

	/**
	 * Checks whether transient config array is set to use transients or not
	 *
	 * @param $transient_config associative array of transient configuration
	 *
	 * @return bool
	 */
	private function use_transients( $transient_config ) {
		return ( isset( $transient_config['use_transients'] ) && $transient_config['use_transients'] ) && ( ! empty( $transient_config['transient_time'] ) );
	}

	/**
	 * Generates authorize URL which is used to allow access to our application and get instagram code
	 *
	 * @return string
	 */
	public function instagram_request_code() {
		return 'https://api.instagram.com/oauth/authorize?client_id=' . $this->instagram_client_id . '&redirect_uri=' . $this->instagram_redirect_uri . '&response_type=code&scope={user_profile,user_media}&state=' . $this->build_current_page_uri();
	}

	/**
	 * Generates authorize URL which is used to allow access to our application and get instagram code
	 *
	 * @return string
	 */
	public function facebook_request_code() {
		return 'https://www.facebook.com/dialog/oauth?client_id=' . $this->facebook_client_id . '&redirect_uri=' . $this->facebook_redirect_uri . '&response_type=token&scope={instagram_basic,pages_show_list,pages_read_engagement}&state=' . $this->build_current_page_uri();
	}
}
