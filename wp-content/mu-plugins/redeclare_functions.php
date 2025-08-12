<?php


function qode_wishlist_for_woocommerce_get_cpt_items( $cpt_slug = 'product', $args = array(), $enable_default = true ) {
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

  if ( $cpt_items->have_posts() )
  {

    if ( $enable_default ) {
      $options[''] = esc_html__( 'Default', 'qode-quick-view-for-woocommerce' );
    }

    foreach ( $cpt_items->posts as $post )
    {
      $options[ $post->ID ] = $post->post_title;
    }
  }

  wp_reset_postdata();

  return $options;
}

function qode_quick_view_for_woocommerce_get_cpt_items( $cpt_slug = 'product', $args = array(), $enable_default = true ) {

  return qode_wishlist_for_woocommerce_get_cpt_items( $cpt_slug, $args, $enable_default );  
}

function qi_addons_for_elementor_get_cpt_items( $cpt_slug = 'product', $args = array(), $enable_default = true ) {

  return qode_wishlist_for_woocommerce_get_cpt_items( $cpt_slug, $args, $enable_default );  
}


function qode_wishlist_for_woocommerce_get_pages( $enable_default = false ) {
  $options = array();

  $query_args = array(
    'post_status'    => 'publish',
    'post_type'      => 'page',
    'posts_per_page' => '-1',
    'fields'         => '',
  );

  $cpt_items = new \WP_Query( $query_args );

  if ( $cpt_items->have_posts() )
  {

    if ( $enable_default ) {
      $options[''] = esc_html__( 'Default', 'qode-wishlist-for-woocommerce' );
    }

    foreach ( $cpt_items->posts as $post )
    {
      $options[ $post->ID ] = $post->post_title;
    }
  }

  return $options;
}

function qode_quick_view_for_woocommerce_get_pages( $enable_default = false ) {

  return qode_wishlist_for_woocommerce_get_pages( $enable_default);  
}


function biagiotti_membership_get_dashboard_page_url() {
  $url   = '';
  
  $pages_with_template_filename = get_pages( [
    'meta_key' => '_wp_page_template',
    'meta_value' => 'user-dashboard.php',
  ] );
  
  if (is_array($pages_with_template_filename) && isset($pages_with_template_filename[0]))
  {
    $url = esc_url( get_the_permalink( $pages_with_template_filename[0] ) );  
  }

  return $url;
}


function biagiotti_mikado_save_options() {
  global $biagiotti_mikado_global_options;

  if ( current_user_can( 'edit_theme_options' ) ) {
    $_REQUEST = stripslashes_deep( $_REQUEST );

    unset( $_REQUEST['action'] );

    check_ajax_referer( 'mkdf_ajax_save_nonce', 'mkdf_ajax_save_nonce' );

    $biagiotti_mikado_global_options = array_merge( $biagiotti_mikado_global_options, $_REQUEST );

    update_option( 'mkdf_options_biagiotti', $biagiotti_mikado_global_options, true );

    do_action( 'biagiotti_mikado_action_after_theme_option_save' );
    echo esc_html__( 'Saved', 'biagiotti' );

    die();
  }
}

function biagiotti_mikado_is_customizer_item_enabled( $item, $option_name, $is_item_id_class = false ) {
  $item_slug       = $is_item_id_class ? $item : basename( dirname( $item ) );
  $item_id_class   = str_replace( '-', '_', $item_slug );
  
  if (strpos($option_name, 'biagiotti_performance_')!==false)
  {
    $alloptions = wp_load_alloptions();
    $is_item_enabled = !(isset($alloptions[$option_name . $item_id_class]) && intval($alloptions[$option_name . $item_id_class])==1);
    
  } else
  {
    $item_option     = get_option( $option_name . $item_id_class );
    $is_item_enabled = empty( $item_option );
  }
  
  return $is_item_enabled;
}


function biagiotti_mikado_get_logo( $slug = '' ) {
global $biagiotti_logos;

  $id            = biagiotti_mikado_get_page_id();
  $header_height = biagiotti_mikado_set_default_menu_height_for_header_types();
  
  if (!isset($biagiotti_logos[$id]) || !isset($biagiotti_logos[$id][$header_height]))
  {
    if ( $slug == 'sticky' ) {
      $logo_image = biagiotti_mikado_get_meta_field_intersect( 'logo_image_sticky', $id );
    } else {
      $logo_image = biagiotti_mikado_get_meta_field_intersect( 'logo_image', $id );
    }
    
    $logo_image_dark  = biagiotti_mikado_get_meta_field_intersect( 'logo_image_dark', $id );
    $logo_image_light = biagiotti_mikado_get_meta_field_intersect( 'logo_image_light', $id );
    
    //get logo image dimensions and set style attribute for image link.
    $logo_dimensions = biagiotti_mikado_get_image_dimensions( $logo_image );
    
    $logo_styles = '';
    if ( is_array( $logo_dimensions ) && array_key_exists( 'height', $logo_dimensions ) ) {
      $logo_height = $logo_dimensions['height'];
      $logo_styles = 'height: ' . intval( $logo_height / 2 ) . 'px;'; //divided with 2 because of retina screens
    } else if ( ! empty( $header_height ) && empty( $logo_dimensions ) ) {
      $logo_styles = 'height: ' . intval( $header_height / 2 ) . 'px;'; //divided with 2 because of retina screens
    }
    
    $params = array(
      'logo_image'       => $logo_image,
      'logo_image_dark'  => $logo_image_dark,
      'logo_image_light' => $logo_image_light,
      'logo_styles'      => $logo_styles
    );

    $is_text_logo = biagiotti_mikado_get_meta_field_intersect( 'logo_source', $id ) == 'text' ? true : false;

    if ( $is_text_logo ) {
      $params['slug']            = 'text';
      $params['logo_text']       = biagiotti_mikado_get_meta_field_intersect( 'logo_text', $id );
      $params['logo_text_color'] = biagiotti_mikado_get_meta_field_intersect( 'logo_text_color', $id );
    }

    $params = apply_filters( 'biagiotti_mikado_filter_get_logo_html_parameters', $params );
    
    $biagiotti_logos[$id] = array($header_height => $params);
    
  } else
  {
    $params = $biagiotti_logos[$id][$header_height];
  }
  
  biagiotti_mikado_get_module_template_part( 'parts/logo', 'header', $slug, $params );
}
