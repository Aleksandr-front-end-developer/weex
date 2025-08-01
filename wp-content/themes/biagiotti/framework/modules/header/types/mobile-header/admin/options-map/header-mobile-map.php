<?php

if ( ! function_exists( 'biagiotti_mikado_mobile_header_options_map' ) ) {
	function biagiotti_mikado_mobile_header_options_map() {
		
		biagiotti_mikado_add_admin_page(
			array(
				'slug'  => '_mobile_header',
				'title' => esc_html__( 'Mobile Header', 'biagiotti' ),
				'icon'  => 'fa fa-mobile'
			)
		);
		
		$panel_mobile_header = biagiotti_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Mobile Header', 'biagiotti' ),
				'name'  => 'panel_mobile_header',
				'page'  => '_mobile_header'
			)
		);
		
		$mobile_header_group = biagiotti_mikado_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_group',
				'title'  => esc_html__( 'Mobile Header Styles', 'biagiotti' )
			)
		);
		
		$mobile_header_row1 = biagiotti_mikado_add_admin_row(
			array(
				'parent' => $mobile_header_group,
				'name'   => 'mobile_header_row1'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_header_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Height', 'biagiotti' ),
				'parent' => $mobile_header_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_header_background_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Background Color', 'biagiotti' ),
				'parent' => $mobile_header_row1
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_header_border_bottom_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Border Bottom Color', 'biagiotti' ),
				'parent' => $mobile_header_row1
			)
		);
		
		$mobile_menu_group = biagiotti_mikado_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_menu_group',
				'title'  => esc_html__( 'Mobile Menu Styles', 'biagiotti' )
			)
		);
		
		$mobile_menu_row1 = biagiotti_mikado_add_admin_row(
			array(
				'parent' => $mobile_menu_group,
				'name'   => 'mobile_menu_row1'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_menu_background_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Background Color', 'biagiotti' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_menu_border_bottom_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Border Bottom Color', 'biagiotti' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_menu_separator_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Menu Item Separator Color', 'biagiotti' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'        => 'mobile_logo_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Logo Height For Mobile Header', 'biagiotti' ),
				'description' => esc_html__( 'Define logo height for screen size smaller than 1024px', 'biagiotti' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'        => 'mobile_logo_height_phones',
				'type'        => 'text',
				'label'       => esc_html__( 'Logo Height For Mobile Devices', 'biagiotti' ),
				'description' => esc_html__( 'Define logo height for screen size smaller than 480px', 'biagiotti' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		biagiotti_mikado_add_admin_field(
			array(
				'name'          => 'mobile_header_in_grid',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Mobile Header in Grid', 'biagiotti' ),
				'description'   => esc_html__( 'Enabling this option will put mobile header in grid', 'biagiotti' ),
				'parent'        => $panel_mobile_header,
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		$mobile_header_without_grid_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $panel_mobile_header,
				'name'            => 'mobile_header_without_grid_container',
				'dependency' => array(
					'show' => array(
						'mobile_header_in_grid' => 'no'
					)
				)
			)
		);

		biagiotti_mikado_add_admin_field(
			array(
				'name'        => 'mobile_header_without_grid_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Mobile Header Padding', 'biagiotti' ),
				'description' => esc_html__( 'Set padding for Mobile Header', 'biagiotti' ),
				'parent'      => $mobile_header_without_grid_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		biagiotti_mikado_add_admin_section_title(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_fonts_title',
				'title'  => esc_html__( 'Typography', 'biagiotti' )
			)
		);
		
		$first_level_group = biagiotti_mikado_add_admin_group(
			array(
				'parent'      => $panel_mobile_header,
				'name'        => 'first_level_group',
				'title'       => esc_html__( '1st Level Menu', 'biagiotti' ),
				'description' => esc_html__( 'Define styles for 1st level in Mobile Menu Navigation', 'biagiotti' )
			)
		);
		
		$first_level_row1 = biagiotti_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row1'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'biagiotti' ),
				'parent' => $first_level_row1
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Hover/Active Text Color', 'biagiotti' ),
				'parent' => $first_level_row1
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_google_fonts',
				'type'   => 'fontsimple',
				'label'  => esc_html__( 'Font Family', 'biagiotti' ),
				'parent' => $first_level_row1
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_font_size',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Font Size', 'biagiotti' ),
				'parent' => $first_level_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$first_level_row2 = biagiotti_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row2'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_line_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Line Height', 'biagiotti' ),
				'parent' => $first_level_row2,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'    => 'mobile_text_text_transform',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Text Transform', 'biagiotti' ),
				'parent'  => $first_level_row2,
				'options' => biagiotti_mikado_get_text_transform_array()
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'    => 'mobile_text_font_style',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Style', 'biagiotti' ),
				'parent'  => $first_level_row2,
				'options' => biagiotti_mikado_get_font_style_array()
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'    => 'mobile_text_font_weight',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Weight', 'biagiotti' ),
				'parent'  => $first_level_row2,
				'options' => biagiotti_mikado_get_font_weight_array()
			)
		);
		
		$first_level_row3 = biagiotti_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row3'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'mobile_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'biagiotti' ),
				'default_value' => '',
				'parent'        => $first_level_row3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$second_level_group = biagiotti_mikado_add_admin_group(
			array(
				'parent'      => $panel_mobile_header,
				'name'        => 'second_level_group',
				'title'       => esc_html__( 'Dropdown Menu', 'biagiotti' ),
				'description' => esc_html__( 'Define styles for drop down menu items in Mobile Menu Navigation', 'biagiotti' )
			)
		);
		
		$second_level_row1 = biagiotti_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row1'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'biagiotti' ),
				'parent' => $second_level_row1
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Hover/Active Text Color', 'biagiotti' ),
				'parent' => $second_level_row1
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_google_fonts',
				'type'   => 'fontsimple',
				'label'  => esc_html__( 'Font Family', 'biagiotti' ),
				'parent' => $second_level_row1
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_font_size',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Font Size', 'biagiotti' ),
				'parent' => $second_level_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$second_level_row2 = biagiotti_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row2'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_line_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Line Height', 'biagiotti' ),
				'parent' => $second_level_row2,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_text_transform',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Text Transform', 'biagiotti' ),
				'parent'  => $second_level_row2,
				'options' => biagiotti_mikado_get_text_transform_array()
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_font_style',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Style', 'biagiotti' ),
				'parent'  => $second_level_row2,
				'options' => biagiotti_mikado_get_font_style_array()
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_font_weight',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Weight', 'biagiotti' ),
				'parent'  => $second_level_row2,
				'options' => biagiotti_mikado_get_font_weight_array()
			)
		);
		
		$second_level_row3 = biagiotti_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row3'
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'mobile_dropdown_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'biagiotti' ),
				'default_value' => '',
				'parent'        => $second_level_row3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		biagiotti_mikado_add_admin_section_title(
			array(
				'name'   => 'mobile_opener_panel',
				'parent' => $panel_mobile_header,
				'title'  => esc_html__( 'Mobile Menu Opener', 'biagiotti' )
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'        => 'mobile_menu_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Mobile Navigation Title', 'biagiotti' ),
				'description' => esc_html__( 'Enter title for mobile menu navigation', 'biagiotti' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3
				)
			)
		);

		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $panel_mobile_header,
				'type'          => 'select',
				'name'          => 'mobile_icon_source',
				'default_value' => 'icon_pack',
				'label'         => esc_html__( 'Select Mobile Navigation Icon Source', 'biagiotti' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'biagiotti' ),
				'options'       => biagiotti_mikado_get_icon_sources_array()
			)
		);

		$mobile_icon_pack_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $panel_mobile_header,
				'name'            => 'mobile_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'mobile_icon_source' => 'icon_pack'
					)
				)
			)
		);

		biagiotti_mikado_add_admin_field(
			array(
				'parent'        => $mobile_icon_pack_container,
				'type'          => 'select',
				'name'          => 'mobile_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Mobile Navigation Icon Pack', 'biagiotti' ),
				'description'   => esc_html__( 'Choose icon pack for mobile navigation icon', 'biagiotti' ),
				'options'       => biagiotti_mikado_icon_collections()->getIconCollectionsExclude( array( 'linea_icons', 'dripicons', 'simple_line_icons' ) )
			)
		);

		$mobile_icon_svg_path_container = biagiotti_mikado_add_admin_container(
			array(
				'parent'          => $panel_mobile_header,
				'name'            => 'mobile_icon_svg_path_container',
				'dependency' => array(
					'show' => array(
						'mobile_icon_source' => 'svg_path'
					)
				)
			)
		);

		biagiotti_mikado_add_admin_field(
			array(
				'parent'      => $mobile_icon_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'mobile_icon_svg_path',
				'label'       => esc_html__( 'Mobile Navigation Icon SVG Path', 'biagiotti' ),
				'description' => esc_html__( 'Enter your mobile navigation icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'biagiotti' ),
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_icon_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Mobile Navigation Icon Color', 'biagiotti' ),
				'parent' => $panel_mobile_header
			)
		);
		
		biagiotti_mikado_add_admin_field(
			array(
				'name'   => 'mobile_icon_hover_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Mobile Navigation Icon Hover Color', 'biagiotti' ),
				'parent' => $panel_mobile_header
			)
		);
	}
	
	add_action( 'biagiotti_mikado_action_options_map', 'biagiotti_mikado_mobile_header_options_map', biagiotti_mikado_set_options_map_position( 'mobile-header' ) );
}