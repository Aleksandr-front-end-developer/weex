<?php

class Weex_Color_Filter_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'weex_color_filter', // ID
            'Weex фільтр за кольором', // Назва в адмінці
            array( 'description' => 'Відображає фільтр по атрибуту "Колір" (pa_kolir)' )
        );

        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
    }

    public function enqueue_styles() {
        wp_enqueue_style(
            'weex-color-filter',
            get_stylesheet_directory_uri() . '/widgets/weex-color-filter-widget.css',
            array(),
            '1.0'
        );
    }

    public function widget( $args, $instance ) {
        if ( ! is_post_type_archive( 'product' ) && ! is_product_taxonomy() ) {
            return;
        }

        $taxonomy = 'pa_kolir';
        $terms = get_terms( array(
            'taxonomy' => $taxonomy,
            'hide_empty' => true,
        ) );

        $args['before_title'] = str_replace(
            'mkdf-widget-title',
            'mkdf-widget-title weex-color-filter',
            $args['before_title']
        );

        if ( empty( $terms ) || is_wp_error( $terms ) ) return;

        $title = 'Фільтр за кольором';
        if (function_exists('pll_current_language')) {
            $lng = pll_current_language();
            switch ( $lng ) {
                case 'ru':
                    $title = 'Фильтр по цвету';
                    break;
                case 'en':
                    $title = 'Filter by color';
                    break;
            }
        }

        echo $args['before_widget'];
        echo $args['before_title'] . $title . $args['after_title'];

        echo '<div class="weex-color-filter">';

        foreach ( $terms as $term ) {
            $color = get_term_meta( $term->term_id, 'color_hex', true );
            $image_id = get_term_meta( $term->term_id, 'color_image', true );
            $image_url = wp_get_attachment_url( $image_id );

            $style_parts = [];

            if ( $color ) {
                $style_parts[] = "background-color: {$color};";
            }

            if ( $image_url ) {
                $style_parts[] = "background-image: url('" . esc_url( $image_url ) . "');";
                $style_parts[] = "background-size: cover;";
                $style_parts[] = "background-position: center;";
                $style_parts[] = "background-repeat: no-repeat;";
            }

            $style = implode( ' ', $style_parts );

            $link = esc_url( get_term_link( $term ) );
            $title = esc_attr( $term->name );

            echo "<a href='{$link}' class='weex-color-dot' title='{$title}' style=\"{$style}\"></a>";

        }
        echo '</div>';

        echo $args['after_widget'];
    }

    public function form( $instance ) {
        echo '<p>Налаштування не потрібні.</p>';
    }

    public function update( $new_instance, $old_instance ) {
        return $old_instance;
    }
}
