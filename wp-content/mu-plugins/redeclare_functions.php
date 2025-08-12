<?php


function qode_quick_view_for_woocommerce_get_cpt_items( $cpt_slug = 'product', $args = array(), $enable_default = true ) {
  $options    = array();
  $query_args = array(
    'post_status'    => 'publish',
    'post_type'      => $cpt_slug,
    'posts_per_page' => '-1',
    'fields'         => '',
  );

  if ( ! empty( $args ) ) {
    foreach ( $args as $key => $value ) {
      if ( ! empty( $value ) ) {
        $query_args[ $key ] = $value;
      }
    }
  }

  $cpt_items = new \WP_Query( $query_args );

  if ( $cpt_items->have_posts() ) {

    if ( $enable_default ) {
      $options[''] = esc_html__( 'Default', 'qode-quick-view-for-woocommerce' );
    }

    foreach ( $cpt_items->posts as $post )
    {
      $options[ $post->ID ] = $post->post_title;
    }
  }
  
  error_log(print_r($options, true));

  wp_reset_postdata();

  return $options;
}
