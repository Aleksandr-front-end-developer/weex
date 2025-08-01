<?php
include_once get_template_directory() . '/theme-includes.php';

if ( ! function_exists( 'biagiotti_mikado_styles' ) ) {
	/**
	 * Function that includes theme's core styles
	 */
	function biagiotti_mikado_styles() {
		
		$modules_css_deps_array = apply_filters( 'biagiotti_mikado_filter_modules_css_deps', array() );
		
		//include theme's core styles
		wp_enqueue_style( 'biagiotti-mikado-default-style', BIAGIOTTI_MIKADO_ROOT . '/style.css' );
		wp_enqueue_style( 'biagiotti-mikado-modules', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/css/modules.min.css', $modules_css_deps_array );
		
		biagiotti_mikado_icon_collections()->enqueueStyles();
		
		wp_enqueue_style( 'wp-mediaelement' );
		
		do_action( 'biagiotti_mikado_action_enqueue_third_party_styles' );
		
		//is woocommerce installed?
		if ( biagiotti_mikado_is_plugin_installed( 'woocommerce' ) && biagiotti_mikado_load_woo_assets() ) {
			//include theme's woocommerce styles
			wp_enqueue_style( 'biagiotti-mikado-woo', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/css/woocommerce.min.css' );
		}
		
		if ( biagiotti_mikado_dashboard_page() || biagiotti_mikado_has_dashboard_shortcodes() ) {
			wp_enqueue_style( 'biagiotti-mikado-dashboard', BIAGIOTTI_MIKADO_FRAMEWORK_ADMIN_ASSETS_ROOT . '/css/mkdf-dashboard.css' );
		}
		
		//define files after which style dynamic needs to be included. It should be included last so it can override other files
		$style_dynamic_deps_array = apply_filters( 'biagiotti_mikado_filter_style_dynamic_deps', array() );
		
		if ( file_exists( BIAGIOTTI_MIKADO_ROOT_DIR . '/assets/css/style_dynamic.css' ) && biagiotti_mikado_is_css_folder_writable() && ! is_multisite() ) {
			wp_enqueue_style( 'biagiotti-mikado-style-dynamic', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/css/style_dynamic.css', $style_dynamic_deps_array, filemtime( BIAGIOTTI_MIKADO_ROOT_DIR . '/assets/css/style_dynamic.css' ) ); //it must be included after woocommerce styles so it can override it
		} else if ( file_exists( BIAGIOTTI_MIKADO_ROOT_DIR . '/assets/css/style_dynamic_ms_id_' . biagiotti_mikado_get_multisite_blog_id() . '.css' ) && biagiotti_mikado_is_css_folder_writable() && is_multisite() ) {
			wp_enqueue_style( 'biagiotti-mikado-style-dynamic', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/css/style_dynamic_ms_id_' . biagiotti_mikado_get_multisite_blog_id() . '.css', $style_dynamic_deps_array, filemtime( BIAGIOTTI_MIKADO_ROOT_DIR . '/assets/css/style_dynamic_ms_id_' . biagiotti_mikado_get_multisite_blog_id() . '.css' ) ); //it must be included after woocommerce styles so it can override it
		}
		
		//is responsive option turned on?
		if ( biagiotti_mikado_is_responsive_on() ) {
			wp_enqueue_style( 'biagiotti-mikado-modules-responsive', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/css/modules-responsive.min.css' );
			
			//is woocommerce installed?
			if ( biagiotti_mikado_is_plugin_installed( 'woocommerce' ) && biagiotti_mikado_load_woo_assets() ) {
				//include theme's woocommerce responsive styles
				wp_enqueue_style( 'biagiotti-mikado-woo-responsive', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/css/woocommerce-responsive.min.css' );
			}
			
			//include proper styles
			if ( file_exists( BIAGIOTTI_MIKADO_ROOT_DIR . '/assets/css/style_dynamic_responsive.css' ) && biagiotti_mikado_is_css_folder_writable() && ! is_multisite() ) {
				wp_enqueue_style( 'biagiotti-mikado-style-dynamic-responsive', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/css/style_dynamic_responsive.css', array(), filemtime( BIAGIOTTI_MIKADO_ROOT_DIR . '/assets/css/style_dynamic_responsive.css' ) );
			} else if ( file_exists( BIAGIOTTI_MIKADO_ROOT_DIR . '/assets/css/style_dynamic_responsive_ms_id_' . biagiotti_mikado_get_multisite_blog_id() . '.css' ) && biagiotti_mikado_is_css_folder_writable() && is_multisite() ) {
				wp_enqueue_style( 'biagiotti-mikado-style-dynamic-responsive', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/css/style_dynamic_responsive_ms_id_' . biagiotti_mikado_get_multisite_blog_id() . '.css', array(), filemtime( BIAGIOTTI_MIKADO_ROOT_DIR . '/assets/css/style_dynamic_responsive_ms_id_' . biagiotti_mikado_get_multisite_blog_id() . '.css' ) );
			}
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'biagiotti_mikado_styles' );
}

if ( ! function_exists( 'biagiotti_mikado_google_fonts_styles' ) ) {
	/**
	 * Function that includes google fonts defined anywhere in the theme
	 */
	function biagiotti_mikado_google_fonts_styles() {
		$is_enabled = boolval( apply_filters( 'biagiotti_mikado_filter_enable_google_fonts', true ) );

		if ( $is_enabled ) {
			$font_simple_field_array = biagiotti_mikado_options()->getOptionsByType( 'fontsimple' );
			if ( ! ( is_array( $font_simple_field_array ) && count( $font_simple_field_array ) > 0 ) ) {
				$font_simple_field_array = array();
			}

			$font_field_array = biagiotti_mikado_options()->getOptionsByType( 'font' );
			if ( ! ( is_array( $font_field_array ) && count( $font_field_array ) > 0 ) ) {
				$font_field_array = array();
			}

			$available_font_options = array_merge( $font_simple_field_array, $font_field_array );

			$google_font_weight_array = biagiotti_mikado_options()->getOptionValue( 'google_font_weight' );
			if ( ! empty( $google_font_weight_array ) && is_array( $google_font_weight_array ) ) {
				$google_font_weight_array = array_slice( biagiotti_mikado_options()->getOptionValue( 'google_font_weight' ), 1 );
			}

			$font_weight_str = '300,400';
			if ( ! empty( $google_font_weight_array ) && $google_font_weight_array !== '' && is_array( $google_font_weight_array ) ) {
		        $font_weight_str = implode( ',', $google_font_weight_array );
	        }

			$google_font_subset_array = biagiotti_mikado_options()->getOptionValue( 'google_font_subset' );
			if ( ! empty( $google_font_subset_array ) && is_array( $google_font_subset_array ) ) {
				$google_font_subset_array = array_slice( biagiotti_mikado_options()->getOptionValue( 'google_font_subset' ), 1 );
			}

			$font_subset_str = 'latin-ext';
			if ( ! empty( $google_font_subset_array ) && $google_font_subset_array !== '' && is_array( $google_font_subset_array ) ) {
		        $font_subset_str = implode( ',', $google_font_subset_array );
	        }

			//default fonts
			$default_font_family = array(
				'Poppins'
			);

			$modified_default_font_family = array();
			foreach ( $default_font_family as $default_font ) {
				$modified_default_font_family[] = $default_font . ':' . str_replace( ' ', '', $font_weight_str );
			}

			$default_font_string = implode( '|', $modified_default_font_family );

			//define available font options array
			$fonts_array = array();
			foreach ( $available_font_options as $font_option ) {
				//is font set and not set to default and not empty?
				$font_option_value = biagiotti_mikado_options()->getOptionValue( $font_option );

				if ( biagiotti_mikado_is_font_option_valid( $font_option_value ) && ! biagiotti_mikado_is_native_font( $font_option_value ) ) {
					$font_option_string = $font_option_value . ':' . $font_weight_str;

					if ( ! in_array( str_replace( '+', ' ', $font_option_value ), $default_font_family ) && ! in_array( $font_option_string, $fonts_array ) ) {
						$fonts_array[] = $font_option_string;
					}
				}
			}

			$fonts_array         = array_diff( $fonts_array, array( '-1:' . $font_weight_str ) );
			$google_fonts_string = implode( '|', $fonts_array );

			//is google font option checked anywhere in theme?
			if ( count( $fonts_array ) > 0 ) {

				//include all checked fonts
				$fonts_full_list      = $default_font_string . '|' . str_replace( '+', ' ', $google_fonts_string );
				$fonts_full_list_args = array(
					'family' => urlencode( $fonts_full_list ),
					'subset' => urlencode( $font_subset_str ),
				);

				$theme_name_php_global_fonts = add_query_arg( $fonts_full_list_args, 'https://fonts.googleapis.com/css' );
				wp_enqueue_style( 'themename-style-handle-google-fonts', esc_url_raw( $theme_name_php_global_fonts ), array(), '1.0.0' );

			} else {
				//include default google font that theme is using
				$default_fonts_args          = array(
					'family' => urlencode( $default_font_string ),
					'subset' => urlencode( $font_subset_str ),
				);
				$theme_name_php_global_fonts = add_query_arg( $default_fonts_args, 'https://fonts.googleapis.com/css' );
				wp_enqueue_style( 'themename-style-handle-google-fonts', esc_url_raw( $theme_name_php_global_fonts ), array(), '1.0.0' );
			}
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'biagiotti_mikado_google_fonts_styles' );
}

if ( ! function_exists( 'biagiotti_mikado_scripts' ) ) {
	/**
	 * Function that includes all necessary scripts
	 */
	function biagiotti_mikado_scripts() {
		global $wp_scripts;
		
		//init theme core scripts
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'wp-mediaelement' );
		
		// 3rd party JavaScripts that we used in our theme
		wp_enqueue_script( 'appear', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.appear.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'modernizr', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/modernizr.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'hoverIntent' );
		wp_enqueue_script( 'jquery-plugin', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.plugin.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'owl-carousel', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/owl.carousel.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waypoints', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.waypoints.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fluidvids', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/fluidvids.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'perfect-scrollbar', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/perfect-scrollbar.jquery.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'scroll-to-plugin', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/ScrollToPlugin.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'parallax', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/parallax.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waitforimages', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.waitforimages.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'prettyphoto', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.prettyPhoto.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-easing-1.3', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.easing.1.3.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'isotope', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/isotope.pkgd.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'packery', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/packery-mode.pkgd.min.js', array( 'jquery' ), false, true );
		
		do_action( 'biagiotti_mikado_action_enqueue_third_party_scripts' );
		
		if ( biagiotti_mikado_is_plugin_installed( 'woocommerce' ) ) {
			wp_enqueue_script( 'select2' );
		}
		
		if ( biagiotti_mikado_is_page_smooth_scroll_enabled() ) {
			wp_enqueue_script( 'tweenLite', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/TweenLite.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'smooth-page-scroll', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/smoothPageScroll.js', array( 'jquery' ), false, true );
		}
		
		//include google map api script
		$google_maps_api_key          = biagiotti_mikado_options()->getOptionValue( 'google_maps_api_key' );
		$google_maps_extensions       = '';
		$google_maps_extensions_array = apply_filters( 'biagiotti_mikado_filter_google_maps_extensions_array', array() );
		
		if ( ! empty( $google_maps_extensions_array ) ) {
			$google_maps_extensions .= '&libraries=';
			$google_maps_extensions .= implode( ',', $google_maps_extensions_array );
		}
		
		if ( ! empty( $google_maps_api_key ) ) {
			wp_enqueue_script( 'biagiotti-mikado-google-map-api', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( $google_maps_api_key ) . "&callback=qodefEmptyCallback&loading=async" . $google_maps_extensions, array(), false, true );
			if ( ! empty( $google_maps_extensions_array ) && is_array( $google_maps_extensions_array ) ) {
				wp_enqueue_script( 'geocomplete', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.geocomplete.min.js', array(
					'jquery',
					'biagiotti-mikado-google-map-api'
				), false, true );
			}

			wp_add_inline_script('biagiotti-mikado-google-map-api', 'window.qodefEmptyCallback = function () {};','before');
		}
		
		wp_enqueue_script( 'biagiotti-mikado-modules', BIAGIOTTI_MIKADO_ASSETS_ROOT . '/js/modules.min.js', array( 'jquery' ), false, true );
		
		if ( biagiotti_mikado_dashboard_page() || biagiotti_mikado_has_dashboard_shortcodes() ) {
			$dash_array_deps = array(
				'jquery-ui-datepicker',
				'jquery-ui-sortable'
			);
			
			wp_enqueue_script( 'biagiotti-mikado-dashboard', BIAGIOTTI_MIKADO_FRAMEWORK_ADMIN_ASSETS_ROOT . '/js/mkdf-dashboard.js', $dash_array_deps, false, true );
			
			wp_enqueue_script( 'wp-util' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'iris', admin_url( 'js/iris.min.js' ), array(
				'jquery-ui-draggable',
				'jquery-ui-slider',
				'jquery-touch-punch'
			), false, 1 );
			wp_enqueue_script( 'wp-color-picker', admin_url( 'js/color-picker.min.js' ), array( 'iris' ), false, 1 );
			
			$colorpicker_l10n = array(
				'clear'         => esc_html__( 'Clear', 'biagiotti' ),
				'defaultString' => esc_html__( 'Default', 'biagiotti' ),
				'pick'          => esc_html__( 'Select Color', 'biagiotti' ),
				'current'       => esc_html__( 'Current Color', 'biagiotti' ),
			);
			
			wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n );
		}
		
		//include comment reply script
		$wp_scripts->add_data( 'comment-reply', 'group', 1 );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'biagiotti_mikado_scripts' );
}

if ( ! function_exists( 'biagiotti_mikado_theme_setup' ) ) {
	/**
	 * Function that adds various features to theme. Also defines image sizes that are used in a theme
	 */
	function biagiotti_mikado_theme_setup() {
		//add support for feed links
		add_theme_support( 'automatic-feed-links' );
		
		//add support for post formats
		add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'video', 'audio' ) );
		
		//add theme support for post thumbnails
		add_theme_support( 'post-thumbnails' );
		
		//add theme support for title tag
		add_theme_support( 'title-tag' );
		
		//add theme support for editor style
		add_editor_style( 'framework/admin/assets/css/editor-style.css' );
		
		//defined content width variable
		$GLOBALS['content_width'] = apply_filters( 'biagiotti_mikado_filter_set_content_width', 1100 );
		
		//define thumbnail sizes
		add_image_size( 'biagiotti_mikado_image_square', 650, 650, true );
		add_image_size( 'biagiotti_mikado_image_landscape', 1300, 650, true );
		add_image_size( 'biagiotti_mikado_image_portrait', 650, 1300, true );
		add_image_size( 'biagiotti_mikado_image_huge', 1300, 1300, true );
		
		load_theme_textdomain( 'biagiotti', get_template_directory() . '/languages' );
	}
	
	add_action( 'after_setup_theme', 'biagiotti_mikado_theme_setup' );
}

if ( ! function_exists( 'biagiotti_mikado_enqueue_editor_customizer_styles' ) ) {
	/**
	 * Enqueue supplemental block editor styles
	 */
	function biagiotti_mikado_enqueue_editor_customizer_styles() {
		wp_enqueue_style( 'themename-style-modules-admin-styles', BIAGIOTTI_MIKADO_FRAMEWORK_ADMIN_ASSETS_ROOT . '/css/mkdf-modules-admin.css' );
		wp_enqueue_style( 'biagiotti-mikado-editor-customizer-styles', BIAGIOTTI_MIKADO_FRAMEWORK_ADMIN_ASSETS_ROOT . '/css/editor-customizer-style.css' );
	}
	
	// add google font
	add_action( 'enqueue_block_editor_assets', 'biagiotti_mikado_google_fonts_styles' );
	// add action
	add_action( 'enqueue_block_editor_assets', 'biagiotti_mikado_enqueue_editor_customizer_styles' );
}

if ( ! function_exists( 'biagiotti_mikado_is_responsive_on' ) ) {
	/**
	 * Checks whether responsive mode is enabled in theme options
	 * @return bool
	 */
	function biagiotti_mikado_is_responsive_on() {
		return biagiotti_mikado_options()->getOptionValue( 'responsiveness' ) !== 'no';
	}
}

if ( ! function_exists( 'biagiotti_mikado_rgba_color' ) ) {
	/**
	 * Function that generates rgba part of css color property
	 *
	 * @param $color string hex color
	 * @param $transparency float transparency value between 0 and 1
	 *
	 * @return string generated rgba string
	 */
	function biagiotti_mikado_rgba_color( $color, $transparency ) {
		if ( $color !== '' && $transparency !== '' ) {
			$rgba_color = '';
			
			$rgb_color_array = biagiotti_mikado_hex2rgb( $color );
			$rgba_color      .= 'rgba(' . implode( ', ', $rgb_color_array ) . ', ' . $transparency . ')';
			
			return $rgba_color;
		}
	}
}

if ( ! function_exists( 'biagiotti_mikado_header_meta' ) ) {
	/**
	 * Function that echoes meta data if our seo is enabled
	 */
	function biagiotti_mikado_header_meta() { ?>
		
		<meta charset="<?php bloginfo( 'charset' ); ?>"/>
		<link rel="profile" href="https://gmpg.org/xfn/11"/>
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
	
	<?php }
	
	add_action( 'biagiotti_mikado_action_header_meta', 'biagiotti_mikado_header_meta' );
}

if ( ! function_exists( 'biagiotti_mikado_user_scalable_meta' ) ) {
	/**
	 * Function that outputs user scalable meta if responsiveness is turned on
	 * Hooked to biagiotti_mikado_action_header_meta action
	 */
	function biagiotti_mikado_user_scalable_meta() {
		//is responsiveness option is chosen?
		if ( biagiotti_mikado_is_responsive_on() ) { ?>
			<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
		<?php } else { ?>
			<meta name="viewport" content="width=1200,user-scalable=yes">
		<?php }
	}
	
	add_action( 'biagiotti_mikado_action_header_meta', 'biagiotti_mikado_user_scalable_meta' );
}

if ( ! function_exists( 'biagiotti_mikado_smooth_page_transitions' ) ) {
	/**
	 * Function that outputs smooth page transitions html if smooth page transitions functionality is turned on
	 * Hooked to biagiotti_mikado_action_before_closing_body_tag action
	 */
	function biagiotti_mikado_smooth_page_transitions() {
		$id = biagiotti_mikado_get_page_id();
		
		if ( biagiotti_mikado_get_meta_field_intersect( 'smooth_page_transitions', $id ) === 'yes' && biagiotti_mikado_get_meta_field_intersect( 'page_transition_preloader', $id ) === 'yes' ) { ?>
			<div class="mkdf-smooth-transition-loader mkdf-mimic-ajax">
				<div class="mkdf-st-loader">
					<div class="mkdf-st-loader1">
						<?php biagiotti_mikado_loading_spinners(); ?>
					</div>
				</div>
			</div>
		<?php }
	}
	
	add_action( 'biagiotti_mikado_action_after_opening_body_tag', 'biagiotti_mikado_smooth_page_transitions', 10 );
}

if ( ! function_exists( 'biagiotti_mikado_back_to_top_button' ) ) {
	/**
	 * Function that outputs back to top button html if back to top functionality is turned on
	 * Hooked to biagiotti_mikado_action_after_wrapper_inner action
	 */
	function biagiotti_mikado_back_to_top_button() {
		if ( biagiotti_mikado_options()->getOptionValue( 'show_back_button' ) == 'yes' ) { ?>
			<a id='mkdf-back-to-top' href='#'>
                <span class="mkdf-icon-stack">
                     <?php echo esc_html__( 'Top', 'biagiotti' ); ?>
                </span>
			</a>
		<?php }
	}
	
	add_action( 'biagiotti_mikado_action_after_wrapper_inner', 'biagiotti_mikado_back_to_top_button', 30 );
}

if ( ! function_exists( 'biagiotti_mikado_get_page_id' ) ) {
	/**
	 * Function that returns current page / post id.
	 * Checks if current page is woocommerce page and returns that id if it is.
	 * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
	 * page that is created in WP admin.
	 *
	 * @return int
	 *
	 * @version 0.1
	 *
	 * @see biagiotti_mikado_is_plugin_installed()
	 * @see biagiotti_mikado_is_woocommerce_shop()
	 */
	function biagiotti_mikado_get_page_id() {
		if ( biagiotti_mikado_is_plugin_installed( 'woocommerce' ) && biagiotti_mikado_is_woocommerce_shop() ) {
			return biagiotti_mikado_get_woo_shop_page_id();
		}
		
		if ( biagiotti_mikado_is_default_wp_template() ) {
			return - 1;
		}
		
		return get_queried_object_id();
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_multisite_blog_id' ) ) {
	/**
	 * Check is multisite and return blog id
	 *
	 * @return int
	 */
	function biagiotti_mikado_get_multisite_blog_id() {
		if ( is_multisite() ) {
			return get_blog_details()->blog_id;
		}
	}
}

if ( ! function_exists( 'biagiotti_mikado_is_default_wp_template' ) ) {
	/**
	 * Function that checks if current page archive page, search, 404 or default home blog page
	 * @return bool
	 *
	 * @see is_archive()
	 * @see is_search()
	 * @see is_404()
	 * @see is_front_page()
	 * @see is_home()
	 */
	function biagiotti_mikado_is_default_wp_template() {
		return is_archive() || is_search() || is_404() || ( is_front_page() && is_home() );
	}
}

if ( ! function_exists( 'biagiotti_mikado_has_shortcode' ) ) {
	/**
	 * Function that checks whether shortcode exists on current page / post
	 *
	 * @param string shortcode to find
	 * @param string content to check. If isn't passed current post content will be used
	 *
	 * @return bool whether content has shortcode or not
	 */
	function biagiotti_mikado_has_shortcode( $shortcode, $content = '' ) {
		$has_shortcode = false;
		
		if ( $shortcode ) {
			//if content variable isn't past
			if ( $content == '' ) {
				//take content from current post
				$page_id = biagiotti_mikado_get_page_id();
				if ( ! empty( $page_id ) ) {
					$current_post = get_post( $page_id );
					
					if ( is_object( $current_post ) && property_exists( $current_post, 'post_content' ) ) {
						$content = $current_post->post_content;
					}
				}
			}
			
			//does content has shortcode added?
			if ( has_shortcode( $content, $shortcode ) ) {
				$has_shortcode = true;
			}
		}
		
		return $has_shortcode;
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_unique_page_class' ) ) {
	/**
	 * Returns unique page class based on post type and page id
	 *
	 * $params int $id is page id
	 * $params bool $allowSingleProductOption
	 * @return string
	 */
	function biagiotti_mikado_get_unique_page_class( $id, $allowSingleProductOption = false ) {
		$page_class = '';
		
		if ( biagiotti_mikado_is_plugin_installed( 'woocommerce' ) && $allowSingleProductOption ) {
			
			if ( is_product() ) {
				$id = get_the_ID();
			}
		}
		
		if ( is_single() ) {
			$page_class = '.postid-' . $id;
		} elseif ( is_home() ) {
			$page_class .= '.home';
		} elseif ( is_archive() || $id === biagiotti_mikado_get_woo_shop_page_id() ) {
			$page_class .= '.archive';
		} elseif ( is_search() ) {
			$page_class .= '.search';
		} elseif ( is_404() ) {
			$page_class .= '.error404';
		} else {
			$page_class .= '.page-id-' . $id;
		}
		
		return $page_class;
	}
}

if ( ! function_exists( 'biagiotti_mikado_page_custom_style' ) ) {
	/**
	 * Function that print custom page style
	 */
	function biagiotti_mikado_page_custom_style() {
		$style = apply_filters( 'biagiotti_mikado_filter_add_page_custom_style', $style = '' );
		
		if ( $style !== '' ) {
			
			if ( biagiotti_mikado_is_plugin_installed( 'woocommerce' ) && biagiotti_mikado_load_woo_assets() ) {
				wp_add_inline_style( 'biagiotti-mikado-woo', $style );
			} else {
				wp_add_inline_style( 'biagiotti-mikado-modules', $style );
			}
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'biagiotti_mikado_page_custom_style' );
}

if ( ! function_exists( 'biagiotti_mikado_print_custom_js' ) ) {
	/**
	 * Prints out custom css from theme options
	 */
	function biagiotti_mikado_print_custom_js() {
		$custom_js = biagiotti_mikado_options()->getOptionValue( 'custom_js' );
		
		if ( ! empty( $custom_js ) ) {
			wp_add_inline_script( 'biagiotti-mikado-modules', $custom_js );
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'biagiotti_mikado_print_custom_js' );
}

if ( ! function_exists( 'biagiotti_mikado_get_global_variables' ) ) {
	/**
	 * Function that generates global variables and put them in array so they could be used in the theme
	 */
	function biagiotti_mikado_get_global_variables() {
		$global_variables = array();
		
		$global_variables['mkdfAddForAdminBar']      = is_admin_bar_showing() ? 32 : 0;
		$global_variables['mkdfElementAppearAmount'] = - 100;
		$global_variables['mkdfAjaxUrl']             = esc_url( admin_url( 'admin-ajax.php' ) );
		$global_variables['sliderNavPrevArrow']      = biagiotti_mikado_get_left_arrow_svg();
		$global_variables['sliderNavNextArrow']      = biagiotti_mikado_get_right_arrow_svg();
		$global_variables['sliderNavPrevArrowBig']   = biagiotti_mikado_get_bigger_left_arrow_svg();
		$global_variables['sliderNavNextArrowBig']   = biagiotti_mikado_get_bigger_right_arrow_svg();
		$global_variables['quoteBlogIcon']           = biagiotti_mikado_get_quote_icon_svg();
		$global_variables['linkBlogIcon']            = biagiotti_mikado_get_link_icon_svg();
		$global_variables['searchIcon']              = biagiotti_mikado_search_icon_svg();
		$global_variables['closePopupIcon']          = biagiotti_mikado_close_popup_icon_svg();
		$global_variables['ppExpand']                = esc_html__( 'Expand the image', 'biagiotti' );
		$global_variables['ppNext']                  = esc_html__( 'Next', 'biagiotti' );
		$global_variables['ppPrev']                  = esc_html__( 'Previous', 'biagiotti' );
		$global_variables['ppClose']                 = esc_html__( 'Close', 'biagiotti' );
		
		$global_variables = apply_filters( 'biagiotti_mikado_filter_js_global_variables', $global_variables );
		
		wp_localize_script( 'biagiotti-mikado-modules', 'mkdfGlobalVars', array(
			'vars' => $global_variables
		) );
	}
	
	add_action( 'wp_enqueue_scripts', 'biagiotti_mikado_get_global_variables' );
}

if ( ! function_exists( 'biagiotti_mikado_per_page_js_variables' ) ) {
	/**
	 * Outputs global JS variable that holds page settings
	 */
	function biagiotti_mikado_per_page_js_variables() {
		$per_page_js_vars = apply_filters( 'biagiotti_mikado_filter_per_page_js_vars', array() );
		
		wp_localize_script( 'biagiotti-mikado-modules', 'mkdfPerPageVars', array(
			'vars' => $per_page_js_vars
		) );
	}
	
	add_action( 'wp_enqueue_scripts', 'biagiotti_mikado_per_page_js_variables' );
}

if ( ! function_exists( 'biagiotti_mikado_content_elem_style_attr' ) ) {
	/**
	 * Defines filter for adding custom styles to content HTML element
	 */
	function biagiotti_mikado_content_elem_style_attr() {
		$styles = apply_filters( 'biagiotti_mikado_filter_content_elem_style_attr', array() );
		
		biagiotti_mikado_inline_style( $styles );
	}
}

if ( ! function_exists( 'biagiotti_mikado_is_plugin_installed' ) ) {
	/**
	 * Function that checks if forward plugin installed
	 *
	 * @param $plugin string
	 *
	 * @return bool
	 */
	function biagiotti_mikado_is_plugin_installed( $plugin ) {
		switch ( $plugin ) {
			case 'core':
				return defined( 'BIAGIOTTI_CORE_VERSION' );
				break;
			case 'woocommerce':
				return function_exists( 'is_woocommerce' );
				break;
			case 'visual-composer':
				return class_exists( 'WPBakeryVisualComposerAbstract' );
				break;
			case 'revolution-slider':
				return class_exists( 'RevSliderFront' );
				break;
			case 'contact-form-7':
				return defined( 'WPCF7_VERSION' );
				break;
			case 'wpml':
				return defined( 'ICL_SITEPRESS_VERSION' );
				break;
			case 'gutenberg-editor':
				return class_exists( 'WP_Block_Type' );
				break;
			case 'gutenberg-plugin':
				return function_exists( 'is_gutenberg_page' ) && is_gutenberg_page();
				break;
			default:
				return false;
				break;
		}
	}
}

if ( ! function_exists( 'biagiotti_mikado_is_elementor_installed' ) ) {
	/**
	 * Function that checks if Elementor plugin installed
	 * @return bool
	 */
	function biagiotti_mikado_is_elementor_installed() {
		return defined('ELEMENTOR_VERSION');
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_module_part' ) ) {
	function biagiotti_mikado_get_module_part( $module ) {
		return $module;
	}
}

if ( ! function_exists( 'biagiotti_mikado_max_image_width_srcset' ) ) {
	/**
	 * Set max width for srcset to 1920
	 *
	 * @return int
	 */
	function biagiotti_mikado_max_image_width_srcset() {
		return 1920;
	}
	
	add_filter( 'max_srcset_image_width', 'biagiotti_mikado_max_image_width_srcset' );
}

if ( ! function_exists( 'biagiotti_mikado_has_dashboard_shortcodes' ) ) {
	/**
	 * Function that checks if current page has at least one of dashboard shortcodes added
	 * @return bool
	 */
	function biagiotti_mikado_has_dashboard_shortcodes() {
		$dashboard_shortcodes = array();
		
		$dashboard_shortcodes = apply_filters( 'biagiotti_mikado_filter_dashboard_shortcodes_list', $dashboard_shortcodes );
		
		foreach ( $dashboard_shortcodes as $dashboard_shortcode ) {
			$has_shortcode = biagiotti_mikado_has_shortcode( $dashboard_shortcode );
			
			if ( $has_shortcode ) {
				return true;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_left_arrow_svg' ) ) {
	function biagiotti_mikado_get_left_arrow_svg() {
		
		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="25px" height="35px" viewBox="0 0 25 35" enable-background="new 0 0 25 35" xml:space="preserve">
					<g>
						<polygon fill="#010101" points="16.708,32.394 17.559,31.866 9.277,18.491 17.475,5.25 16.624,4.723 8.102,18.491 	"/>
					</g>
				</svg>';
		
		return $html;
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_right_arrow_svg' ) ) {
	function biagiotti_mikado_get_right_arrow_svg() {
		
		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="25px" height="35px" viewBox="0 0 25 35" enable-background="new 0 0 25 35" xml:space="preserve">
					<g>
						<polygon fill="#010101" points="8.952,32.394 8.102,31.866 16.383,18.491 8.186,5.25 9.036,4.723 17.559,18.491 	"/>
					</g>
				</svg>';
		
		return $html;
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_bigger_left_arrow_svg' ) ) {
	function biagiotti_mikado_get_bigger_left_arrow_svg() {
		
		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="30px" height="50px" viewBox="0 0 30 50" enable-background="new 0 0 30 50" xml:space="preserve">
					<g>
						<polygon fill="#010101" points="21.684,46.448 22.533,45.921 10.039,25.773 22.404,5.688 21.553,5.164 8.863,25.775 	"/>
					</g>
				</svg>';
		
		return $html;
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_bigger_right_arrow_svg' ) ) {
	function biagiotti_mikado_get_bigger_right_arrow_svg() {
		
		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="30px" height="50px" viewBox="0 0 30 50" enable-background="new 0 0 30 50" xml:space="preserve">
					<g>
						<polygon fill="#010101" points="9.712,46.448 8.863,45.921 21.357,25.773 8.993,5.688 9.844,5.164 22.533,25.775 	"/>
					</g>
				</svg>';
		
		return $html;
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_close_icon_svg' ) ) {
	function biagiotti_mikado_get_close_icon_svg() {
		
		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="23px" height="23px" viewBox="0 0 23 23" enable-background="new 0 0 23 23" xml:space="preserve">
<polygon fill="#010101" points="20.207,3.188 19.5,2.48 11.383,10.597 3.268,2.481 2.561,3.188 10.676,11.304 2.561,19.418 3.268,20.125 11.383,12.011 19.498,20.127 20.205,19.42 12.09,11.304 "/>
</svg>';
		
		return $html;
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_bigger_close_icon_svg' ) ) {
	function biagiotti_mikado_get_bigger_close_icon_svg() {
		
		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="24px" viewBox="0 0 28 24" enable-background="new 0 0 28 24" xml:space="preserve">
					<polygon points="24.637,1.769 23.93,1.062 13.698,11.293 3.468,1.062 2.761,1.769 12.991,12 2.76,22.23 3.467,22.938 13.698,12.707 23.929,22.938 24.636,22.23 14.405,12 "/>
				</svg>';
		
		return $html;
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_quote_icon_svg' ) ) {
	function biagiotti_mikado_get_quote_icon_svg() {
		
		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	    width="72px" height="72px" viewBox="0 0 72 72" enable-background="new 0 0 72 72" xml:space="preserve">
		<g>
			<path fill="#FFFFFF" d="M36.438,13.075c1.588,0.794,2.184,2.452,1.787,4.965c-0.398,2.52-1.328,5.232-2.782,8.144
				c-1.459,2.917-3.047,5.698-4.768,8.342c-1.725,2.65-2.979,4.506-3.773,5.561c-5.301,7.945-12.185,15.096-20.657,21.451
				c5.294-5.294,9.931-11.718,13.903-19.266c3.973-7.548,6.753-15.157,8.342-22.841c0.527-2.117,1.323-4.035,2.383-5.76
				C31.929,11.952,33.787,11.753,36.438,13.075z M63.846,13.075c1.59,0.794,2.186,2.452,1.789,4.965
				c-0.398,2.52-1.328,5.232-2.781,8.144c-1.459,2.917-3.047,5.698-4.768,8.342c-1.725,2.65-2.979,4.506-3.773,5.561
				c-5.561,8.479-12.451,15.63-20.657,21.451c5.561-5.561,10.192-11.916,13.903-19.066c3.707-7.151,6.617-14.829,8.74-23.041
				c0.527-1.85,1.191-3.706,1.986-5.562C59.08,12.02,60.93,11.753,63.846,13.075z"/>
		</g>
		</svg>';
		
		return $html;
	}
}

if ( ! function_exists( 'biagiotti_mikado_get_link_icon_svg' ) ) {
	function biagiotti_mikado_get_link_icon_svg() {
		
		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="72px" height="72px" viewBox="0 0 72 72" enable-background="new 0 0 72 72" xml:space="preserve">
		<g>
			<g>
				<g>
					<g>
						<g>
							<g>
								<path fill="#FFFFFF" d="M23.665,63.436c-3.602,0-7.209-1.371-9.952-4.115c-2.663-2.659-4.126-6.196-4.126-9.955
									c0-3.763,1.467-7.298,4.126-9.957l6.542-6.546c0.68-0.679,1.779-0.679,2.458,0c0.68,0.679,0.68,1.779,0,2.46l-6.542,6.545
									c-2.004,2.004-3.107,4.666-3.107,7.498s1.104,5.493,3.107,7.496c4.013,4.011,10.991,4.004,14.991,0l6.546-6.546
									c0.68-0.679,1.779-0.679,2.458,0c0.679,0.68,0.679,1.778,0,2.458l-6.546,6.547C30.877,62.064,27.271,63.436,23.665,63.436z"/>
							</g>
						</g>
					</g>
				</g>
				<g>
					<g>
						<g>
							<g>
								<path fill="#FFFFFF" d="M49.845,42.377c-0.445,0-0.89-0.17-1.229-0.51c-0.68-0.679-0.68-1.779,0-2.459l6.547-6.546
									c4.132-4.132,4.132-10.857,0-14.994c-4.14-4.132-10.863-4.132-14.995,0l-6.546,6.547c-0.68,0.678-1.779,0.678-2.458,0
									c-0.679-0.68-0.679-1.779,0-2.459l6.546-6.546c5.483-5.483,14.414-5.49,19.911,0c5.487,5.49,5.487,14.425,0,19.912
									l-6.546,6.545C50.734,42.207,50.289,42.377,49.845,42.377z"/>
							</g>
						</g>
					</g>
				</g>
				<g>
					<g>
						<g>
							<g>
								<path fill="#FFFFFF" d="M23.665,51.104c-0.444,0-0.89-0.17-1.229-0.51c-0.679-0.679-0.679-1.779,0-2.458l23.999-23.999
									c0.68-0.679,1.78-0.679,2.459,0s0.679,1.779,0,2.458L24.895,50.594C24.555,50.934,24.11,51.104,23.665,51.104z"/>
							</g>
						</g>
					</g>
				</g>
			</g>
		</g>
		</svg>';
		
		return $html;
	}
}

if ( ! function_exists( 'biagiotti_mikado_search_icon_svg' ) ) {
	function biagiotti_mikado_search_icon_svg() {
		
		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	         width="25px" height="25px" viewBox="0 0 25 25" enable-background="new 0 0 25 25" xml:space="preserve">
			<path d="M16.963,15.664c1.21-1.302,1.957-3.041,1.957-4.955c0-4.021-3.271-7.293-7.293-7.293c-4.021,0-7.292,3.271-7.292,7.293
				c0,4.021,3.271,7.292,7.292,7.292c1.747,0,3.352-0.619,4.609-1.647l4.871,4.59l0.686-0.729L16.963,15.664z M5.334,10.709
				c0-3.47,2.823-6.293,6.292-6.293s6.293,2.823,6.293,6.293c0,3.469-2.823,6.292-6.293,6.292S5.334,14.179,5.334,10.709z"/>
			</svg>';
		
		return $html;
	}
}

if ( ! function_exists( 'biagiotti_mikado_close_dd_cart_icon_svg' ) ) {
	function biagiotti_mikado_close_dd_cart_icon_svg() {
		
		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
				<polygon fill="#D0D0CF" points="14.012,2.629 13.305,1.922 8.001,7.226 2.697,1.922 1.99,2.629 7.294,7.933 1.99,13.236
					2.698,13.943 8.001,8.64 13.305,13.943 14.012,13.236 8.708,7.933 "/>
				</svg>';
		
		return $html;
	}
}

if ( ! function_exists( 'biagiotti_mikado_close_popup_icon_svg' ) ) {
	function biagiotti_mikado_close_popup_icon_svg() {
		
		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 29 29" enable-background="new 0 0 29 29" xml:space="preserve">
				<line fill="none" stroke="currentColor" stroke-miterlimit="10" x1="3.893" y1="3.895" x2="25.105" y2="25.107"></line>
				<line fill="none" stroke="currentColor" stroke-miterlimit="10" x1="3.893" y1="3.895" x2="25.105" y2="25.107"></line>
				<line fill="none" stroke="currentColor" stroke-miterlimit="10" x1="3.894" y1="25.106" x2="25.107" y2="3.894"></line>
				<line fill="none" stroke="currentColor" stroke-miterlimit="10" x1="3.894" y1="25.106" x2="25.107" y2="3.894"></line>
				</svg>';
		
		return $html;
	}
}

if( ! function_exists( 'biagiotti_mikado_is_theme_registered' ) ) {
	function biagiotti_mikado_is_theme_registered() {
		if( function_exists( 'biagiotti_core_is_theme_registered' ) ){
			return biagiotti_core_is_theme_registered();
		} else {
			return false;
		}
	}
}

if( ! function_exists( 'biagiotti_mikado_add_registration_admin_notice' ) ) {
	function biagiotti_mikado_add_registration_admin_notice() {
		if( biagiotti_mikado_is_plugin_installed('core' ) &&  ! biagiotti_mikado_is_theme_registered() ) {
			?>
			<div class="error">
				<p>
					<?php
					echo wp_kses_post( sprintf(
						__( 'Your copy of the theme has not been activated. Please navigate to <a href="%s">Biagiotti Dashboard</a> where you can input your purchase code and activate your copy of the theme so you can have access to all the theme features, elements & options.', 'biagiotti' ),
						admin_url('admin.php?page=biagiotti_core_dashboard')
					) );
					?>
				</p>
			</div>
			<?php
		}
	}

	add_action('admin_notices', 'biagiotti_mikado_add_registration_admin_notice');
}
