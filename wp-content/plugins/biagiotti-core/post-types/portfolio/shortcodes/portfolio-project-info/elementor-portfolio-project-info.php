<?php

class BiagiottiCoreElementorPortfolioProjectInfo extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_portfolio_project_info';
    }

    public function get_title() {
        return esc_html__( 'Portfolio Project Info', 'biagiotti-core' );
    }

    public function get_icon() {
        return 'biagiotti-elementor-custom-icon biagiotti-elementor-portfolio-project-info';
    }

    public function get_categories() {
        return [ 'mikado' ];
    }

	protected function register_controls() {
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'biagiotti-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'project_id',
            [
                'label'       => esc_html__( 'Selected Project', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'If you left this field empty then project ID will be of the current page', 'biagiotti-core' )
            ]
        );

        $this->add_control(
            'project_info_type',
            [
                'label'       => esc_html__( 'Project Info Type', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => [
                    'title'    => esc_html__( 'Title', 'biagiotti-core' ),
                    'category' => esc_html__( 'Category', 'biagiotti-core' ),
                    'tag'      => esc_html__( 'Tag', 'biagiotti-core' ),
                    'author'   => esc_html__( 'Author', 'biagiotti-core' ),
                    'date'     => esc_html__( 'Date', 'biagiotti-core' ),
                    'image'    => esc_html__( 'Featured Image', 'biagiotti-core' ),
                    'additional-info'    => esc_html__( 'Additional Info', 'biagiotti-core' )
                ],
                'default'     => 'title'
            ]
        );

        $this->add_control(
            'project_info_title_type_tag',
            [
                'label'       => esc_html__( 'Project Title Tag', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => biagiotti_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
                'description' => esc_html__( 'Set title tag for project title element', 'biagiotti-core' ),
                'condition'   => [
                    'project_info_type' => array( 'title' )
                ],
                'default'     => 'h2'
            ]
        );

        $this->add_control(
            'project_info_title',
            [
                'label'       => esc_html__( 'Project Info Label', 'biagiotti-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Add project info label before project info element/s', 'biagiotti-core' )
            ]
        );

        $this->add_control(
            'project_info_title_tag',
            [
                'label'     => esc_html__( 'Project Info Label Tag', 'biagiotti-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => biagiotti_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
                'condition' => [
                    'project_info_title!' => ''
                ],
                'default'   => 'h6'
            ]
        );

        $this->end_controls_section();
    }

    public function render() {

        $params = $this->get_settings_for_display();


		$params['project_id'] = ! empty( $params['project_id'] ) ? $params['project_id'] : get_the_ID();
	    $params['project_id'] = apply_filters( 'wpml_object_id', $params['project_id'], get_post_type( $params['project_id'] ) );

		$holder_classes = $this->getHolderClasses( $params );

		$html = '<div class="mkdf-portfolio-project-info ' . esc_attr( $holder_classes ) . '">';

		if ( ! empty( $params['project_info_title'] ) ) {
			$html .= '<' . esc_attr( $params['project_info_title_tag'] ) . ' class="mkdf-ppi-label">' . esc_html( $params['project_info_title'] ) . '</' . esc_attr( $params['project_info_title_tag'] ) . '>';
		}

		switch ( $params['project_info_type'] ) {
			case 'title':
				$html .= $this->getItemTitleHtml( $params );
				break;
			case 'category':
				$html .= $this->getItemCategoryHtml( $params );
				break;
			case 'tag':
				$html .= $this->getItemTagHtml( $params );
				break;
			case 'author':
				$html .= $this->getItemAuthorHtml( $params );
				break;
			case 'date':
				$html .= $this->getItemDateHtml( $params );
				break;
			case 'image':
				$html .= $this->getItemImageHtml( $params );
				break;
			case 'additional-info':
				$html .= $this->getItemAdditionalInfoHtml( $params );
				break;
			default:
				$html .= $this->getItemTitleHtml( $params );
				break;
		}

		$html .= '</div>';

        echo biagiotti_mikado_get_module_part( $html );
    }

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['project_info_type'] ) ? 'mkdf-project-info-' . $params['project_info_type'] : '';

		return implode( ' ', $holderClasses );
	}

	public function getItemTitleHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$title      = get_the_title( $project_id );
		$title_tag  = $params['project_info_title_type_tag'];

		if ( ! empty( $title ) ) {
			$html = '<' . esc_attr( $title_tag ) . ' itemprop="name" class="mkdf-ppi-title entry-title">';
			$html .= '<a itemprop="url" class="mkdf-ppi-title-item" href="' . esc_url( get_the_permalink( $project_id ) ) . '">' . esc_html( $title ) . '</a>';
			$html .= '</' . esc_attr( $title_tag ) . '>';
		}

		return $html;
	}

	public function getItemCategoryHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$categories = wp_get_post_terms( $project_id, 'portfolio-category' );

		if ( ! empty( $categories ) ) {
			$html = '';
			foreach ( $categories as $cat ) {
				$html .= '<a itemprop="url" class="mkdf-ppi-category-item" href="' . esc_url( get_term_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
			}
		}

		return $html;
	}

	public function getItemTagHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$tags       = wp_get_post_terms( $project_id, 'portfolio-tag' );

		if ( ! empty( $tags ) ) {
			$html = '';
			foreach ( $tags as $tag ) {
				$html .= '<a itemprop="url" class="mkdf-ppi-tag-item" href="' . esc_url( get_term_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a>';
			}
		}

		return $html;
	}

	public function getItemAuthorHtml( $params ) {
		$html         = '';
		$project_id   = $params['project_id'];
		$project_post = get_post( $project_id );
		$autor_id     = $project_post->post_author;
		$author       = get_the_author_meta( 'display_name', $autor_id );

		if ( ! empty( $author ) ) {
			$html = '<span class="mkdf-ppi-author">' . esc_html( $author ) . '</span>';
		}

		return $html;
	}

	public function getItemDateHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$date       = get_the_time( get_option( 'date_format' ), $project_id );

		if ( ! empty( $date ) ) {
			$html = '<span class="mkdf-ppi-date">' . esc_html( $date ) . '</span>';
		}

		return $html;
	}

	public function getItemImageHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$image      = get_the_post_thumbnail( $project_id, 'full' );

		if ( ! empty( $image ) ) {
			$html = '<a itemprop="url" class="mkdf-ppi-image" href="' . esc_url( get_the_permalink( $project_id ) ) . '">' . $image . '</a>';
		}

		return $html;
	}

	public function getItemAdditionalInfoHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$custom_fields = get_post_meta($project_id, 'mkdf_portfolio_properties', true);

		if(is_array($custom_fields) && count($custom_fields)) {
			$html = '';
			foreach($custom_fields as $custom_field) {
				$html .= '<div>';
				if(!empty($custom_field['item_title'])) {
					$html .= '<' . esc_attr( $params['project_info_title_tag'] ) . ' class="mkdf-ppi-label">' . esc_html( $custom_field['item_title'] ) . '</' . esc_attr( $params['project_info_title_tag'] ) . '>';
				}

				if(!empty($custom_field['item_url'])) {
					$html .= '<a itemprop="url" href="' .  esc_url($custom_field['item_url']) . '">';
				}
				$html .= esc_html($custom_field['item_text']);
				if(!empty($custom_field['item_url'])) {
					$html .= '</a>';
				}
				$html .= '</div>';
			}
		}

		return $html;
	}

	/**
	 * Filter portfolios by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$portfolio_id    = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts}
					WHERE post_type = 'portfolio-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'biagiotti-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'biagiotti-core' ) . ': ' . $value['title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find portfolio by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio
			$portfolio = get_post( (int) $query );
			if ( ! is_wp_error( $portfolio ) ) {

				$portfolio_id    = $portfolio->ID;
				$portfolio_title = $portfolio->post_title;

				$portfolio_title_display = '';
				if ( ! empty( $portfolio_title ) ) {
					$portfolio_title_display = ' - ' . esc_html__( 'Title', 'biagiotti-core' ) . ': ' . $portfolio_title;
				}

				$portfolio_id_display = esc_html__( 'Id', 'biagiotti-core' ) . ': ' . $portfolio_id;

				$data          = array();
				$data['value'] = $portfolio_id;
				$data['label'] = $portfolio_id_display . $portfolio_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BiagiottiCoreElementorPortfolioProjectInfo() );