<?php

add_filter( 'cron_schedules', 'cron_add_one_min' );

function cron_add_one_min( $schedules ) {
	$schedules['one_min'] = array(
		'interval' => 60,
		'display'  => 'Раз в минуту'
	);
	return $schedules;
}

add_filter( 'cron_schedules', 'cron_add_five_min' );

function cron_add_five_min( $schedules ) {
	$schedules['five_min'] = array(
		'interval' => 300,
		'display'  => 'Раз в 5 минут'
	);
	return $schedules;
}

add_action( 'chat_gpt_translate', 'do_chat_gpt_translate' );

if( ! wp_next_scheduled( 'chat_gpt_translate' ) )
{
  wp_schedule_event( time(), 'one_min', 'chat_gpt_translate');
}

function do_chat_gpt_translate() {
  global $wpdb;

  $key = carbon_get_theme_option('chat_gpt_key');
  $model = carbon_get_theme_option('chat_gpt_model');
  $message = carbon_get_theme_option('chat_gpt_message');

  $languages = get_languages_list_full();

  if (count($languages)>0 && $key!='' && $model!='' && $message!='')
  {
    $sql = $wpdb->prepare( "SELECT * FROM ".TRANSLATE_FRAGMENTS_TABLE." WHERE translated='%d' LIMIT 5", 0 );
    $rows = $wpdb->get_results($sql, ARRAY_A);
    
    if (count($rows)>0)
    {
      foreach ($rows as $row)
      {
        if (is_string($row['source_text']) && ((bool) preg_match('/[\p{Cyrillic}]/u', $row['source_text']))===true)
        {
          $final_message = $message;
          foreach ($languages as $language)
          {
            if ($row['lng_from']==$language->slug) $final_message = mb_ereg_replace('%src_lng%', $language->name, $final_message); 
            if ($row['lng_to']==$language->slug) $final_message = mb_ereg_replace('%dest_lng%', $language->name, $final_message); 
          }
          if (mb_strpos($final_message, '%src_lng%')===false && mb_strpos($final_message, '%dest_lng%')===false)
          {
            $data = array(
              "model" => $model,
              "messages" => array(array(
                "role" => "user",
                "content" => $final_message."\n\n".$row['source_text']
              )),
            );

            $response = wp_remote_post(CHAT_GPT_API_URL, array(
              'body' => json_encode($data),
              'headers' => array(
                "Content-Type" => "application/json",
                "Authorization" => "Bearer ".$key,
              ),
              'timeout' => 60,
            ));

            if ( !is_wp_error( $response ) )
            {
              $body = json_decode(wp_remote_retrieve_body( $response ), true);
              
              if (is_array($body) && isset($body['choices'][0]['message']['content']) && wp_remote_retrieve_response_code( $response ) == 200)
              {
                $content_temp = $body['choices'][0]['message']['content'];
                $temp = explode('```html', $content_temp);
                if (isset($temp[1]))
                {
                  $temp = explode('```', $temp[1]);
                  $content_temp = $temp[0];  
                }

                $wpdb->update( TRANSLATE_FRAGMENTS_TABLE, array( 'translate' => $content_temp, 'translated' => 1 ), array( 'id' => $row['id'] ) );
              }
              
              if (is_array($body) && isset($body['error']) && isset($body['error']['message']))
              {
                $updated = update_option( 'last_translate_error', wp_date('d.m.Y H:i') . ' - ' . $body['error']['message'], true );
              }
            }
          }
        } else
        {
          $wpdb->update( TRANSLATE_FRAGMENTS_TABLE, array( 'translate' => $row['source_text'], 'translated' => 1 ), array( 'id' => $row['id'] ) );
        }
      }
    }
  }
}


add_action( 'final_doing_after_translate', 'do_final_doing_after_translate' );

if( ! wp_next_scheduled( 'final_doing_after_translate' ) )
{
  wp_schedule_event( time(), 'five_min', 'final_doing_after_translate');
}

function do_final_doing_after_translate() {
  global $wpdb, $translate_lists;
  
  $rows = $wpdb->get_results("SELECT * FROM ".TRANSLATE_POSTS_TERMS_TABLE." LIMIT 5", ARRAY_A);
  
  if (is_array($rows))
  {
    foreach ($rows as $row)
    {
      $need_delete = true;
      if ($row['post_or_term']=='post')
      {
        $post = get_post($row['post_term_id']);
        if (!is_null($post) && is_translated_post_type($post->post_type))
        {
          $languages = get_languages_list();
          if (isset($translate_lists['posts'][$post->post_type]) && is_array($translate_lists['posts'][$post->post_type])
           && array_search($row['lng_from'], $languages)!==false && array_search($row['lng_to'], $languages)!==false)
          {
            $translate_list = $translate_lists['posts'][$post->post_type];

            if (isset($translate_list['main_fields']) && is_array($translate_list['main_fields']))
            {
              $check = check_translate_post_term($row);
              
              if ($check===false) $need_delete = false;
              else
              {
                $new_post_id = clone_post_for_translate($post, $row['lng_to']);
                if ($new_post_id!=0)
                {
                  $new_post = get_post($new_post_id, ARRAY_A);

                  foreach ($translate_list['meta_fields'] as $field)
                  {
                    $meta_value = get_post_meta( $post->ID, $field, true );
                    if (isset($meta_value) && is_string($meta_value) && ((bool) preg_match('/[\p{Cyrillic}]/u', $meta_value))===true)
                    {
                      update_post_meta( $new_post_id, $field, get_translate_string($meta_value, $row['lng_from'], $row['lng_to']) );
                    }  
                  }

                  foreach ($translate_list['carbon_wrappers'] as $wrapper)
                  {
                    $carbon_field = carbon_get_post_meta( $post->ID, $wrapper );
                    $carbon_field = get_carbon_wpapper_translate($carbon_field, $row['lng_from'], $row['lng_to'] );
                    
                    carbon_set_post_meta( $new_post_id, $wrapper, $carbon_field );
                  }

                  $args = $new_post;
                  foreach ($translate_list['main_fields'] as $field)
                  {
                    if (isset($post->$field) && is_string($post->$field) && ((bool) preg_match('/[\p{Cyrillic}]/u', $post->$field))===true)
                    {
                      $args[$field] = get_translate_string($post->$field, $row['lng_from'], $row['lng_to']);
                    }  
                  }
                  //$args['post_status'] = 'publish';
                  $new_post_id = wp_insert_post( $args, false, false );

                  if ($new_post_id!=0)
                  {
                    foreach ($translate_list['taxonomies'] as $taxonomy)
                    {
                      $post_terms = wp_get_object_terms( $post->ID, $taxonomy );
                      
                      $new_post_terms = array();
                      foreach ($post_terms as $post_term)
                      {
                        $temp = intval(get_language_term($post_term->term_id, $row['lng_to']));
                        $new_post_terms[] = ($temp!=0) ? $temp : clone_term_for_translate($post_term, $row['lng_to']); 
                      }
                      
                      wp_set_object_terms( $new_post_id, $new_post_terms, $taxonomy, false );
                    }
                  }

                } else $need_delete = false;
              }       
            }  
          }
        }
      } elseif ($row['post_or_term']=='term')
      {
        $term = get_term($row['post_term_id']);
        if (!is_null($term) && is_translated_taxonomy($term->taxonomy))
        {
          $languages = get_languages_list();
          
          if (isset($translate_lists['terms'][$term->taxonomy]) && is_array($translate_lists['terms'][$term->taxonomy])
           && array_search($row['lng_from'], $languages)!==false && array_search($row['lng_to'], $languages)!==false)
          {
            $translate_list = $translate_lists['terms'][$term->taxonomy];
            if (isset($translate_list['main_fields']) && is_array($translate_list['main_fields']))
            {
              $check = check_translate_post_term($row);
              
              if ($check===false) $need_delete = false;
              else
              {
                $new_term_id = clone_term_for_translate($term, $row['lng_to']);  
                
                if ($new_term_id!=0)
                {
                  $new_term = get_term($new_term_id);
                  $args = array();
                  foreach ($translate_list['main_fields'] as $field)
                  {
                    $cyrillic = (bool) preg_match('/[\p{Cyrillic}]/u', $term->$field);
                    if (isset($term->$field) && is_string($term->$field) && $cyrillic===true)
                    {
                      $args[$field] = get_translate_string($term->$field, $row['lng_from'], $row['lng_to']);
                    } elseif (isset($term->$field) && is_string($term->$field) && $cyrillic===false)
                    {
                      $args[$field] = $term->$field;
                    }  
                  }
                  if (isset($args['name'])) $args['slug'] = wp_unique_term_slug(sanitize_title($args['name']), $new_term);
                  //$args['slug'] = $term->slug;
                  
                  if (!isset($GLOBALS['do_not_translate_terms']) || !is_array($GLOBALS['do_not_translate_terms'])) $GLOBALS['do_not_translate_terms'] = array();
                  $GLOBALS['do_not_translate_terms'][] = array('term_id'=>$new_term_id);
                  
                  wp_update_term( $new_term_id, $new_term->taxonomy, $args );


                  foreach ($translate_list['meta_fields'] as $field)
                  {
                    $meta_value = get_term_meta( $term->term_id, $field, true );
                    if (isset($meta_value) && is_string($meta_value) && ((bool) preg_match('/[\p{Cyrillic}]/u', $meta_value))===true)
                    {
                      update_term_meta( $new_term_id, $field, get_translate_string($meta_value, $row['lng_from'], $row['lng_to']) );
                    }  
                  }

                  foreach ($translate_list['carbon_wrappers'] as $wrapper)
                  {
                    $carbon_field = carbon_get_term_meta( $term->term_id, $wrapper );
                    $carbon_field = get_carbon_wpapper_translate($carbon_field, $row['lng_from'], $row['lng_to'] );
                    
                    carbon_set_term_meta( $new_term_id, $wrapper, $carbon_field );
                  }
                } else $need_delete = false;
              }
            }
          }
        }
      }
      
      if ($need_delete===true)
      {
        $wpdb->delete( TRANSLATE_POSTS_TERMS_TABLE, array( 'id' => $row['id'] ), array( '%d' ) );
      }
    }
  }
}
