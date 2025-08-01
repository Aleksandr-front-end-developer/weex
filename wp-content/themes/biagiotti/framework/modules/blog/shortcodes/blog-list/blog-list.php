<?php
namespace BiagiottiCore\CPT\Shortcodes\BlogList;

use BiagiottiCore\Lib;

class BlogList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_blog_list';
		
		add_action('vc_before_init', array($this,'vcMap'));
		
		//Category filter
		add_filter( 'vc_autocomplete_mkdf_blog_list_category_callback', array( &$this, 'blogCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Category render
		add_filter( 'vc_autocomplete_mkdf_blog_list_category_render', array( &$this, 'blogCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map(
			array(
				'name'                      => esc_html__( 'Blog List', 'biagiotti' ),
				'base'                      => $this->base,
				'icon'                      => 'icon-wpb-blog-list extended-custom-icon',
				'category'                  => esc_html__( 'by BIAGIOTTI', 'biagiotti' ),
				'allowed_container_element' => 'vc_row',
				'params'                    => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'type',
						'heading'     => esc_html__( 'Type', 'biagiotti' ),
						'value'       => array(
							esc_html__( 'Standard', 'biagiotti' ) => 'standard',
							esc_html__( 'Boxed', 'biagiotti' )    => 'boxed',
							esc_html__( 'Masonry', 'biagiotti' )  => 'masonry',
							esc_html__( 'Simple', 'biagiotti' )   => 'simple',
							esc_html__( 'Minimal', 'biagiotti' )  => 'minimal'
						),
						'save_always' => true
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'number_of_posts',
						'heading'    => esc_html__( 'Number of Posts', 'biagiotti' )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'number_of_columns',
						'heading'     => esc_html__( 'Number of Columns', 'biagiotti' ),
						'value'       => array_flip( biagiotti_mikado_get_number_of_columns_array( true ) ),
						'dependency'  => array(
							'element' => 'type',
							'value'   => array( 'standard', 'boxed', 'masonry' )
						),
						'save_always' => true
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'space_between_items',
						'heading'     => esc_html__( 'Space Between Items', 'biagiotti' ),
						'value'       => array_flip( biagiotti_mikado_get_space_between_items_array() ),
						'save_always' => true,
						'dependency'  => array( 'element' => 'type', 'value'   => array( 'standard', 'boxed', 'masonry' ) )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'orderby',
						'heading'     => esc_html__( 'Order By', 'biagiotti' ),
						'value'       => array_flip( biagiotti_mikado_get_query_order_by_array() ),
						'save_always' => true
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'order',
						'heading'     => esc_html__( 'Order', 'biagiotti' ),
						'value'       => array_flip( biagiotti_mikado_get_query_order_array() ),
						'save_always' => true
					),
					array(
						'type'        => 'autocomplete',
						'param_name'  => 'category',
						'heading'     => esc_html__( 'Category', 'biagiotti' ),
						'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'biagiotti' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'image_size',
						'heading'    => esc_html__( 'Image Size', 'biagiotti' ),
						'value'      => array(
							esc_html__( 'Original', 'biagiotti' )  => 'full',
							esc_html__( 'Square', 'biagiotti' )    => 'biagiotti_mikado_image_square',
							esc_html__( 'Landscape', 'biagiotti' ) => 'biagiotti_mikado_image_landscape',
							esc_html__( 'Portrait', 'biagiotti' )  => 'biagiotti_mikado_image_portrait',
							esc_html__( 'Thumbnail', 'biagiotti' ) => 'thumbnail',
							esc_html__( 'Medium', 'biagiotti' )    => 'medium',
							esc_html__( 'Large', 'biagiotti' )     => 'large',
							esc_html__( 'Custom', 'biagiotti' )    => 'custom'
						),
						'save_always' => true,
						'dependency'  => Array( 'element' => 'type', 'value' => array( 'standard', 'boxed', 'masonry' ) )
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'custom_image_width',
						'heading'     => esc_html__( 'Custom Image Width', 'biagiotti' ),
						'description' => esc_html__( 'Enter image width in px', 'biagiotti' ),
						'dependency'  => array( 'element' => 'image_size', 'value' => 'custom' )
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'custom_image_height',
						'heading'     => esc_html__( 'Custom Image Height', 'biagiotti' ),
						'description' => esc_html__( 'Enter image height in px', 'biagiotti' ),
						'dependency'  => array( 'element' => 'image_size', 'value' => 'custom' )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'title_tag',
						'heading'     => esc_html__( 'Title Tag', 'biagiotti' ),
						'value'       => array_flip( biagiotti_mikado_get_title_tag( true ) ),
						'save_always' => true,
						'group'       => esc_html__( 'Post Info', 'biagiotti' )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'title_transform',
						'heading'     => esc_html__( 'Title Text Transform', 'biagiotti' ),
						'value'       => array_flip( biagiotti_mikado_get_text_transform_array( true ) ),
						'save_always' => true,
						'group'       => esc_html__( 'Post Info', 'biagiotti' )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'title_font_weight',
						'heading'     => esc_html__( 'Title Font Weight', 'biagiotti' ),
						'value'       => array_flip( biagiotti_mikado_get_font_weight_array( true ) ),
						'save_always' => true,
						'group'       => esc_html__( 'Post Info', 'biagiotti' )
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'excerpt_length',
						'heading'     => esc_html__( 'Text Length', 'biagiotti' ),
						'description' => esc_html__( 'Number of words', 'biagiotti' ),
						'dependency'  => Array( 'element' => 'type', 'value'   => array( 'standard', 'boxed', 'masonry', 'simple' ) ),
						'group'       => esc_html__( 'Post Info', 'biagiotti' )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'post_info_image',
						'heading'     => esc_html__( 'Enable Post Info Image', 'biagiotti' ),
						'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
						'dependency'  => Array(
							'element' => 'type',
							'value'   => array( 'standard', 'boxed', 'masonry' )
						),
						'save_always' => true,
						'group'       => esc_html__( 'Post Info', 'biagiotti' )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'post_info_section',
						'heading'     => esc_html__( 'Enable Post Info Section', 'biagiotti' ),
						'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
						'dependency'  => Array(
							'element' => 'type',
							'value'   => array( 'standard', 'boxed', 'masonry' )
						),
						'save_always' => true,
						'group'       => esc_html__( 'Post Info', 'biagiotti' )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'post_info_author',
						'heading'     => esc_html__( 'Enable Post Info Author', 'biagiotti' ),
						'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
						'dependency'  => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'save_always' => true,
						'group'       => esc_html__( 'Post Info', 'biagiotti' )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'post_info_date',
						'heading'     => esc_html__( 'Enable Post Info Date', 'biagiotti' ),
						'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
						'dependency'  => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'save_always' => true,
						'group'       => esc_html__( 'Post Info', 'biagiotti' )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'post_info_category',
						'heading'     => esc_html__( 'Enable Post Info Category', 'biagiotti' ),
						'value'       => array_flip( biagiotti_mikado_get_yes_no_select_array( false, true ) ),
						'dependency'  => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'save_always' => true,
						'group'       => esc_html__( 'Post Info', 'biagiotti' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'pagination_type',
						'heading'    => esc_html__( 'Pagination Type', 'biagiotti' ),
						'value'      => array(
							esc_html__( 'None', 'biagiotti' )            => 'no-pagination',
							esc_html__( 'Standard', 'biagiotti' )        => 'standard-shortcodes',
							esc_html__( 'Load More', 'biagiotti' )       => 'load-more',
							esc_html__( 'Infinite Scroll', 'biagiotti' ) => 'infinite-scroll'
						),
						'save_always' => true,
						'group'       => esc_html__( 'Additional Features', 'biagiotti' )
					)
				)
			)
		);
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'type'                  => 'standard',
			'number_of_posts'       => '-1',
			'number_of_columns'     => 'four',
			'space_between_items'   => 'normal',
			'category'              => '',
			'orderby'               => 'title',
			'order'                 => 'ASC',
			'image_size'            => 'full',
			'custom_image_width'    => '',
			'custom_image_height'   => '',
			'title_tag'             => 'h4',
			'title_transform'       => '',
			'title_font_weight'     => '',
			'excerpt_length'        => '40',
			'post_info_section'     => 'yes',
			'post_info_image'       => 'yes',
			'post_info_author'      => 'no',
			'post_info_date'        => 'yes',
			'post_info_category'    => 'yes',
			'pagination_type'       => 'no-pagination'
		);
		$params       = shortcode_atts( $default_atts, $atts );
		
		$queryArray             = $this->generateQueryArray( $params );
		$query_result           = new \WP_Query( $queryArray );
		$params['query_result'] = $query_result;

		$params['type']                = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];
		$params['number_of_posts']     = ! empty( $params['number_of_posts'] ) ? $params['number_of_posts'] : $default_atts['number_of_posts'];
		$params['number_of_columns']   = ! empty( $params['number_of_columns'] ) ? $params['number_of_columns'] : $default_atts['number_of_columns'];
		$params['space_between_items'] = ! empty( $params['space_between_items'] ) ? $params['space_between_items'] : $default_atts['space_between_items'];
		$params['orderby']             = ! empty( $params['orderby'] ) ? $params['orderby'] : $default_atts['orderby'];
		$params['order']               = ! empty( $params['order'] ) ? $params['order'] : $default_atts['order'];
		$params['image_size']          = ! empty( $params['image_size'] ) ? $params['image_size'] : $default_atts['image_size'];
		$params['title_tag']           = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['excerpt_length']      = ! empty( $params['excerpt_length'] ) ? $params['excerpt_length'] : $default_atts['excerpt_length'];
		$params['post_info_section']   = ! empty( $params['post_info_section'] ) ? $params['post_info_section'] : $default_atts['post_info_section'];
		$params['post_info_image']     = ! empty( $params['post_info_image'] ) ? $params['post_info_image'] : $default_atts['post_info_image'];
		$params['post_info_author']    = ! empty( $params['post_info_author'] ) ? $params['post_info_author'] : $default_atts['post_info_author'];
		$params['post_info_date']      = ! empty( $params['post_info_date'] ) ? $params['post_info_date'] : $default_atts['post_info_date'];
		$params['post_info_category']  = ! empty( $params['post_info_category'] ) ? $params['post_info_category'] : $default_atts['post_info_category'];
		$params['pagination_type']     = ! empty( $params['pagination_type'] ) ? $params['pagination_type'] : $default_atts['pagination_type'];

		$params['holder_data']    = $this->getHolderData( $params );
		$params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		$params['module']         = 'list';
		
		$params['max_num_pages'] = $query_result->max_num_pages;
		$params['paged']         = isset( $query_result->query['paged'] ) ? $query_result->query['paged'] : 1;
		
		$params['this_object'] = $this;
		
		ob_start();
		
		biagiotti_mikado_get_module_template_part( 'shortcodes/blog-list/holder', 'blog', $params['type'], $params );
		
		$html = ob_get_contents();
		
		ob_end_clean();
		
		return $html;
	}
	
	public function getHolderClasses( $params, $default_atts ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-bl-' . $params['type'] : 'mkdf-bl-' . $default_atts['type'];
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'mkdf-' . $params['number_of_columns'] . '-columns' : 'mkdf-' . $default_atts['number_of_columns'] . '-columns';
		$holderClasses[] = ! in_array( $params['pagination_type'], array( 'standard-shortcodes', 'load-more' ) ) ? 'mkdf-disable-bottom-space' : '';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $default_atts['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['pagination_type'] ) ? 'mkdf-bl-pag-' . $params['pagination_type'] : 'mkdf-bl-pag-' . $default_atts['pagination_type'];
		
		return implode( ' ', $holderClasses );
	}
	
	public function getHolderData( $params ) {
		$dataString = '';
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		
		$query_result = $params['query_result'];
		
		$params['max_num_pages'] = $query_result->max_num_pages;
		
		if ( ! empty( $paged ) ) {
			$params['next-page'] = $paged + 1;
		}
		
		foreach ( $params as $key => $value ) {
			if ( $key !== 'query_result' && $value !== '' ) {
				$new_key = str_replace( '_', '-', $key );
				
				$dataString .= ' data-' . $new_key . '=' . esc_attr( str_replace( ' ', '', $value ) );
			}
		}
		
		return $dataString;
	}
	
	public function generateQueryArray( $params ) {
		$queryArray = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'orderby'        => $params['orderby'],
			'order'          => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'post__not_in'   => get_option( 'sticky_posts' )
		);
		
		if ( ! empty( $params['category'] ) ) {
			$queryArray['category_name'] = $params['category'];
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$queryArray['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
		return $queryArray;
	}
	
	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}

		if ( ! empty( $params['title_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['title_font_weight'];
		}
		
		return implode( ';', $styles );
	}

	/**
	 * Filter blog categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function blogCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['category_title'] ) > 0 ) ? esc_html__( 'Category', 'biagiotti' ) . ': ' . $value['category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find blog category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function blogCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$category = get_term_by( 'slug', $query, 'category' );
			if ( is_object( $category ) ) {
				
				$category_slug = $category->slug;
				$category_title = $category->name;
				
				$category_title_display = '';
				if ( ! empty( $category_title ) ) {
					$category_title_display = esc_html__( 'Category', 'biagiotti' ) . ': ' . $category_title;
				}
				
				$data          = array();
				$data['value'] = $category_slug;
				$data['label'] = $category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}