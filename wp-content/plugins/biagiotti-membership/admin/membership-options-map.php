<?php
/**
 * Options map file
 */

if ( ! function_exists( 'biagiotti_membership_get_pages_list' ) ) {
	function biagiotti_membership_get_pages_list() {
		$all_pages = array();
		$pages     = get_pages();
		if ( ! empty( $pages ) ) {
			$all_pages[] = esc_html__( 'Default', 'biagiotti-membership' );

			foreach ( $pages as $page ) {
				$all_pages[ $page->ID ] = esc_html( $page->post_title );
			}
		}

		return $all_pages;
	}
}

if ( ! function_exists( 'biagiotti_membership_options_map' ) ) {
	function biagiotti_membership_options_map( $page ) {
		
		if ( biagiotti_membership_theme_installed() ) {
			
			$panel_social_login = biagiotti_mikado_add_admin_panel(
				array(
					'page'  => $page,
					'name'  => 'panel_social_login',
					'title' => esc_html__( 'Enable Social Login', 'biagiotti-membership' )
				)
			);
			
			biagiotti_mikado_add_admin_field(
				array(
					'type'          => 'text',
					'name'          => 'mkdf_membership_privacy_policy_text',
					'label'         => esc_html__( 'Privacy Policy Text', 'biagiotti-membership' ),
					'description'   => esc_html__( 'Enter privacy policy text for registration modal form', 'biagiotti-membership' ),
					'parent'        => $panel_social_login
				)
			);

			biagiotti_mikado_add_admin_field(
				array(
					'type'          => 'select',
					'name'          => 'mkdf_membership_privacy_policy_link',
					'label'         => esc_html__( 'Privacy Policy Link', 'biagiotti-membership' ),
					'description'   => esc_html__( 'Choose Privacy Policy Link page to link from registration modal form', 'biagiotti-membership' ),
					'default_value' => '',
					'options'       => biagiotti_membership_get_pages_list(),
					'parent'        => $panel_social_login
				)
			);

			biagiotti_mikado_add_admin_field(
				array(
					'type'          => 'text',
					'name'          => 'mkdf_membership_privacy_policy_link_text',
					'label'         => esc_html__( 'Privacy Policy Link Text', 'biagiotti-membership' ),
					'description'   => esc_html__( 'Enter privacy policy link text for registration modal form. Default value is "privacy policy"', 'biagiotti-membership' ),
					'parent'        => $panel_social_login
				)
			);

			biagiotti_mikado_add_admin_field(
				array(
					'type'          => 'yesno',
					'name'          => 'enable_social_login',
					'default_value' => 'no',
					'label'         => esc_html__( 'Enable Social Login', 'biagiotti-membership' ),
					'description'   => esc_html__( 'Enabling this option will allow login from social networks of your choice', 'biagiotti-membership' ),
					'parent'        => $panel_social_login
				)
			);
			
			$panel_enable_social_login = biagiotti_mikado_add_admin_panel(
				array(
					'page'       => $page,
					'name'       => 'panel_enable_social_login',
					'title'      => esc_html__( 'Enable Login via', 'biagiotti-membership' ),
					'dependency' => array(
						'show' => array(
							'enable_social_login' => 'yes'
						)
					)
				)
			);
			
			biagiotti_mikado_add_admin_field(
				array(
					'type'          => 'yesno',
					'name'          => 'enable_facebook_social_login',
					'default_value' => 'no',
					'label'         => esc_html__( 'Facebook', 'biagiotti-membership' ),
					'description'   => esc_html__( 'Enabling this option will allow login via Facebook', 'biagiotti-membership' ),
					'parent'        => $panel_enable_social_login
				)
			);
			
			$enable_facebook_social_login_container = biagiotti_mikado_add_admin_container(
				array(
					'name'       => 'enable_facebook_social_login_container',
					'parent'     => $panel_enable_social_login,
					'dependency' => array(
						'show' => array(
							'enable_facebook_social_login' => 'yes'
						)
					)
				)
			);
			
			biagiotti_mikado_add_admin_field(
				array(
					'type'          => 'text',
					'name'          => 'enable_facebook_login_fbapp_id',
					'default_value' => '',
					'label'         => esc_html__( 'Facebook App ID', 'biagiotti-membership' ),
					'description'   => esc_html__( 'Copy your application ID form created Facebook Application', 'biagiotti-membership' ),
					'parent'        => $enable_facebook_social_login_container
				)
			);
		}
	}
	
	add_action( 'biagiotti_mikado_action_social_options', 'biagiotti_membership_options_map' );
}
