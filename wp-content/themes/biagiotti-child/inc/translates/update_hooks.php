<?php

add_action('wp_after_insert_post', 'vancouver_translate_for_insert_post', 10, 3 );

function vancouver_translate_for_insert_post($post_id, $post, $update) {
  global $translate_lists, $wpdb;

  if (is_translated_post_type($post->post_type) && $post->post_status=='publish')
  {  
    $post_lng = get_post_language($post_id);
    $default_lng = get_default_language();
    $post_auto_translate = carbon_get_post_meta($post_id, 'post_auto_translate');
    
    if (isset($translate_lists['posts'][$post->post_type]) && is_array($translate_lists['posts'][$post->post_type]) && $post_lng==$default_lng /*&& $post_auto_translate=='1'*/)
    {
      $translate_list = $translate_lists['posts'][$post->post_type];
      
      if (isset($translate_list['main_fields']) && is_array($translate_list['main_fields']))
      {
        $languages = get_languages_list();
        foreach ($languages as $lng_to)
        {
          $strings = array();
        
          foreach ($translate_list['main_fields'] as $field)
          {
            if (isset($post->$field) && is_string($post->$field) && ((bool) preg_match('/[\p{Cyrillic}]/u', $post->$field))===true && $lng_to!=$post_lng)
            {
              $strings[] = save_translate_field($post->$field, $post_lng, $lng_to);
            }  
          }

          foreach ($translate_list['meta_fields'] as $field)
          {
            $meta_field = get_post_meta( $post_id, $field, true );
            if (isset($meta_field) && is_string($meta_field) && ((bool) preg_match('/[\p{Cyrillic}]/u', $meta_field))===true && $lng_to!=$post_lng)
            {
              $strings[] = save_translate_field($meta_field, $post_lng, $lng_to);
            }  
          }

          foreach ($translate_list['carbon_wrappers'] as $wrapper)
          {
            $carbon_field = carbon_get_post_meta( $post_id, $wrapper );
            $strings = array_merge($strings, save_carbon_wpapper_for_translate($carbon_field, $post_lng, $lng_to ));
          }
          
          if ($lng_to!=$post_lng) save_translate_post_or_term_row($post_lng, $lng_to, $post_id, 'post', $strings);
        }
      }  
    }
  }
}

add_action('saved_term', 'vancouver_translate_for_saved_term', 10, 5 );

function vancouver_translate_for_saved_term($term_id, $tt_id, $taxonomy, $update, $args) {
  global $translate_lists, $wpdb;
  
  if (is_translated_taxonomy($taxonomy))
  {
    $blocked = false;
    $blocked_number = false;
    if (isset($GLOBALS['do_not_translate_terms']) && is_array($GLOBALS['do_not_translate_terms']))
    {
      foreach ($GLOBALS['do_not_translate_terms'] as $key=>$item)
      {
        if (isset($item['term_id']) && $item['term_id']==$term_id) { $blocked = true; $blocked_number = $key; }
        if (isset($item['term']) && $item['term']==$args['name'] && isset($item['taxonomy']) && $item['taxonomy']==$taxonomy) { $blocked = true; $blocked_number = $key; }
      }
    }
    
    if (!$blocked)
    {
      $term_lng = get_term_language($term_id);
      $default_lng = get_default_language();
      
      if (isset($translate_lists['terms'][$taxonomy]) && is_array($translate_lists['terms'][$taxonomy]) && $term_lng==$default_lng)
      {
        $translate_list = $translate_lists['terms'][$taxonomy];
        
        if (isset($translate_list['main_fields']) && is_array($translate_list['main_fields']))
        {
          $languages = get_languages_list();
          foreach ($languages as $lng_to)
          {
            $strings = array();
          
            foreach ($translate_list['main_fields'] as $field)
            {
              if (isset($args[$field]) && is_string($args[$field]) && ((bool) preg_match('/[\p{Cyrillic}]/u', $args[$field]))===true && $lng_to!=$term_lng)
              {
                $strings[] = save_translate_field($args[$field], $term_lng, $lng_to);
              }  
            }

            foreach ($translate_list['meta_fields'] as $field)
            {
              $meta_field = get_term_meta( $term_id, $field, true );
              if (isset($meta_field) && is_string($meta_field) && ((bool) preg_match('/[\p{Cyrillic}]/u', $meta_field))===true && $lng_to!=$term_lng)
              {
                $strings[] = save_translate_field($meta_field, $term_lng, $lng_to);
              }  
            }

            foreach ($translate_list['carbon_wrappers'] as $wrapper)
            {
              $carbon_field = carbon_get_term_meta( $term_id, $wrapper );
              $strings = array_merge($strings, save_carbon_wpapper_for_translate($carbon_field, $term_lng, $lng_to ));
            }
                
            if ($lng_to!=$term_lng) save_translate_post_or_term_row($term_lng, $lng_to, $term_id, 'term', $strings);
          }
        }  
      }
    }
    
    if ($blocked_number!==false) unset($GLOBALS['do_not_translate_terms'][$blocked_number]);
  }
}