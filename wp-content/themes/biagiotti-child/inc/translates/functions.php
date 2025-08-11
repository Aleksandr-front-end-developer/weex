<?php

function santinize_to_text_array($text) {

/*  $text_array = explode("\n", sanitize_textarea_field($text));
  foreach ($text_array as $key=>$fragment)
  {
    $text_array[$key] = sanitize_text_field($fragment);
  }*/

  $text_array = explode("\n", $text);
  
  return $text_array;
}

function fragment_array_strlen($text_fragment_array) {

  $fragment_strlen = 0;
  foreach ($text_fragment_array as $text_fragment) $fragment_strlen += mb_strlen($text_fragment);
  
  return $fragment_strlen;
}

function save_carbon_wpapper_for_translate($carbon_field, $post_lng, $lng_to ) {

  $strings = array();

  if (is_array($carbon_field))
  {
    foreach ($carbon_field as $item)
    {
      if (is_array($item)) $strings = array_merge($strings, save_carbon_wpapper_for_translate($item, $post_lng, $lng_to));
      elseif (is_string($item) && ((bool) preg_match('/[\p{Cyrillic}]/u', $item))===true && $lng_to!=$post_lng)
      {
        $strings[] = save_translate_field($item, $post_lng, $lng_to);
      }
    }
  }
  
  return $strings;
}

function save_translate_field($text, $post_lng, $lng_to) {

  $text_array = santinize_to_text_array($text);
  
  $text_fragment_array = array();
  $i = 0;
  $fragment_ids = array();
  while (isset($text_array[$i]))
  {
    $fragment_strlen = fragment_array_strlen($text_fragment_array);
    $text_fragment_temp = array_merge($text_fragment_array, array($text_array[$i]));

    if ($fragment_strlen!=0 && $fragment_strlen<MAX_FRAGMENT_LENGTH && fragment_array_strlen($text_fragment_temp)<=MAX_FRAGMENT_LENGTH)
    {
      $text_fragment_array[] = $text_array[$i];
    } elseif ($fragment_strlen==0)
    {
      $text_fragment_array[] = $text_array[$i];
    } elseif ($fragment_strlen>=MAX_FRAGMENT_LENGTH || fragment_array_strlen($text_fragment_temp)>MAX_FRAGMENT_LENGTH)
    {
      $fragment_ids[] = save_translate_fragment($text_fragment_array, $post_lng, $lng_to);
      $text_fragment_array = array($text_array[$i]);
    }  
    $i++;
  }
  if (count($text_fragment_array)>0) $fragment_ids[] = save_translate_fragment($text_fragment_array, $post_lng, $lng_to);
  
  return save_translate_string($text_array, $post_lng, $lng_to, $fragment_ids);
}

function save_translate_fragment($text_fragment_array, $lng_from, $lng_to) {
  global $wpdb;
  
  $text = implode("\n", $text_fragment_array);

  $sql = $wpdb->prepare( "SELECT id FROM ".TRANSLATE_FRAGMENTS_TABLE." WHERE lng_from = '%s' AND lng_to = '%s' AND source_text = '%s'", $lng_from, $lng_to, $text );
  $id = $wpdb->get_var($sql);
  
  if (is_null($id))
  {
    $wpdb->insert( TRANSLATE_FRAGMENTS_TABLE, array( 'lng_from' => $lng_from, 'lng_to' => $lng_to, 'source_text' => $text ) );
    $id = $wpdb->insert_id;
  }

  return $id;
}

function save_translate_string($text_array, $lng_from, $lng_to, $fragment_ids) {
  global $wpdb;
  
  $text = implode("\n", $text_array);
  $fragment_ids = json_encode($fragment_ids, JSON_NUMERIC_CHECK);
  
  $sql = $wpdb->prepare( "SELECT id FROM ".TRANSLATE_STRINGS_TABLE." WHERE lng_from = '%s' AND lng_to = '%s' AND source_text = '%s' AND fragments = '%s'", $lng_from, $lng_to, $text, $fragment_ids );
  $id = $wpdb->get_var($sql);
  
  if (is_null($id))
  {
    $wpdb->insert( TRANSLATE_STRINGS_TABLE, array( 'lng_from' => $lng_from, 'lng_to' => $lng_to, 'source_text' => $text, 'fragments' => $fragment_ids ) );
    $id = $wpdb->insert_id;
  }

  return $id;
}

function save_translate_post_or_term_row($lng_from, $lng_to, $post_id, $type, $strings) {
  global $wpdb;
  
  $strings = json_encode($strings, JSON_NUMERIC_CHECK);

  $sql = $wpdb->prepare( "SELECT id FROM ".TRANSLATE_POSTS_TERMS_TABLE." WHERE lng_from = '%s' AND lng_to = '%s' AND post_term_id = '%d' AND post_or_term = '%s'", $lng_from, $lng_to, $post_id, $type );
  $id = $wpdb->get_var($sql);
  
  if (is_null($id))
  {
    $wpdb->insert( TRANSLATE_POSTS_TERMS_TABLE, array( 'lng_from' => $lng_from, 'lng_to' => $lng_to, 'post_term_id' => $post_id, 'post_or_term' => $type, 'translate_strings' => $strings ) );
    $id = $wpdb->insert_id;
  } else
  {
    $wpdb->update( TRANSLATE_POSTS_TERMS_TABLE, array( 'translate_strings' => $strings ), array( 'id' => $id ) );
  }

  return $id;
}

function check_translate_post_term($row) {
  global $wpdb;
  
  $return = true;
  
  $strings = json_decode($row['translate_strings'], true);

  if (is_array($strings))
  {
    foreach ($strings as $string_id)
    {
      $sql = $wpdb->prepare( "SELECT * FROM ".TRANSLATE_STRINGS_TABLE." WHERE id = '%d'", $string_id );
      $string = $wpdb->get_row($sql, ARRAY_A);
    
      $fragments = json_decode($string['fragments'], true);
      if (is_array($fragments))
      {
        $results = $wpdb->get_results("SELECT translated FROM ".TRANSLATE_FRAGMENTS_TABLE." WHERE id IN ('".implode("', '", $fragments)."')", ARRAY_A);

        foreach ($results as $result)
        {
          if ($result['translated']!=1) $return = false;
        }
      } else $return = false;
    }
  } else $return = false;
  
  
  return $return;
}

function clone_post_for_translate($post, $lng_to) {
global $wpdb;

  $new_post_id = get_language_post($post->ID, $lng_to);
  $new_post = (array) $post;
  
  if ($new_post_id==0 && function_exists('pll_get_post_translations') && function_exists('pll_save_post_translations')
   && function_exists('pll_set_post_language')  && function_exists('pll_is_translated_taxonomy'))
  {
		$taxonomies = get_object_taxonomies( $post->post_type ); // возвращает массив названий таксономий, используемых для указанного типа поста, например array("category", "post_tag");
    $new_post_terms = array();
    $translated_taxonomies = true;
		foreach ( $taxonomies as $taxonomy )
    {
			$post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
      
      if ($taxonomy!='language' && $taxonomy!='post_translations') //Эти таксономии уже прописаны выше
      {
        if (pll_is_translated_taxonomy($taxonomy))
        {
          $new_post_terms[$taxonomy] = array();
          foreach ($post_terms as $post_term)
          {
            $temp = intval(get_language_term($post_term, $lng_to));
            $new_post_terms[$taxonomy][] = $temp;
            if ($temp==0 || $temp==$post_term)
            {
              $translated_taxonomies = false;
              $args = get_term($post_term, $taxonomy, ARRAY_A);
              do_action( 'saved_term', $args['term_id'], $args['term_taxonomy_id'], $args['taxonomy'], true, $args );
            }
          }
        } else $new_post_terms[$taxonomy] = $post_terms;
      }
		}
   
    unset($new_post['ID']);
    unset($new_post['guid']);
    $new_post['post_status'] = 'draft';
    $new_post_id = wp_insert_post( $new_post, false, false );
    
    pll_set_post_language($new_post_id, $lng_to);
    
    $translations = pll_get_post_translations($post->ID);
    $translations[$lng_to] = $new_post_id;
    pll_save_post_translations($translations);

    if ($translated_taxonomies)
    {
      // присваиваем новому посту все элементы таксономий (рубрики, метки и т.д.) старого
      foreach ( $new_post_terms as $taxonomy=>$post_terms )
      {
        wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );
      }
    }
   
  } elseif ($new_post_id!=0)
  {
    $wpdb->delete( $wpdb->postmeta, [ 'post_id'=>$new_post_id ] );
    clean_post_cache( $new_post_id );
  }
  
  if ($new_post_id!=0)
  {
    // дублируем все произвольные поля
    $post_meta = get_post_meta( $post->ID );
    if( $post_meta )
    {
      foreach ( $post_meta as $meta_key => $meta_values ) {
        if( '_wp_old_slug' == $meta_key )
        { // это лучше не трогать
          continue;
        }
        foreach ( $meta_values as $meta_value )
        {
          add_post_meta( $new_post_id, $meta_key, maybe_unserialize($meta_value) );
        }
      }
    }
  }
  
  return $new_post_id;
}

function clone_term_for_translate($term, $lng_to) {
global $wpdb;

  $new_term_id = intval(get_language_term($term->term_id, $lng_to));
  
  if ($new_term_id==0 && function_exists('pll_get_term_translations') && function_exists('pll_save_term_translations')
   && function_exists('pll_get_term_language')  && function_exists('pll_is_translated_taxonomy'))
  {
    $args = (array) $term;
    unset($args['term_id']);
    //unset($args['slug']);
    $args['slug'] = $args['slug'].'-'.$lng_to;
    unset($args['term_taxonomy_id']);
    unset($args['count']);
    unset($args['name']);
    unset($args['taxonomy']);
    //$name = $term->name.md5($term->name);
    
    $parent_lng_term = 0;
    if ($term->parent!=0)
    {
      $parent_lng_term = get_language_term( $term->parent, $lng_to );
      if ($parent_lng_term==$term->term_id || $parent_lng_term==0)
      {
        $parent_args = get_term($term->parent, $term->taxonomy, ARRAY_A);
        do_action( 'saved_term', $parent_args['term_id'], $parent_args['term_taxonomy_id'], $parent_args['taxonomy'], true, $parent_args );
        return 0;
      }
    }
    $args['parent'] = $parent_lng_term;
    
    if (!isset($GLOBALS['do_not_translate_terms']) || !is_array($GLOBALS['do_not_translate_terms'])) $GLOBALS['do_not_translate_terms'] = array();
    $GLOBALS['do_not_translate_terms'][] = array('term'=>$term->name, 'taxonomy'=>$term->taxonomy);
    
    $new_term_id = wp_insert_term( $term->name, $term->taxonomy, $args );
    $new_term_id = $new_term_id['term_id'];
    
    pll_set_term_language($new_term_id, $lng_to);
    
    $translations = pll_get_term_translations($term->term_id);
    $translations[$lng_to] = $new_term_id;
    pll_save_term_translations($translations);

  } elseif ($new_term_id!=0)
  {
    $wpdb->delete( $wpdb->termmeta, [ 'term_id'=>$new_term_id ] );
    clean_term_cache( $new_term_id );
  }
  
  if ($new_term_id!=0)
  {
		// дублируем все произвольные поля
		$term_meta = get_term_meta( $term->term_id );
		if( $term_meta )
    {
			foreach ( $term_meta as $meta_key => $meta_values ) {
				foreach ( $meta_values as $meta_value )
        {
					add_term_meta( $new_term_id, $meta_key, maybe_unserialize($meta_value) );
				}
			}
		}
  }
  
  return $new_term_id;
}

function get_translate_string($text, $lng_from, $lng_to) {
  global $wpdb;
  
  $return = $text;
  $text = implode("\n", santinize_to_text_array($text));
  
  $sql = $wpdb->prepare( "SELECT fragments FROM ".TRANSLATE_STRINGS_TABLE." WHERE lng_from = '%s' AND lng_to = '%s' AND source_text = '%s'", $lng_from, $lng_to, $text );
  $fragments = json_decode($wpdb->get_var($sql), true);

   
  if (is_array($fragments))
  {
    $results = $wpdb->get_results("SELECT translate FROM ".TRANSLATE_FRAGMENTS_TABLE." WHERE id IN ('".implode("', '", $fragments)."') ORDER BY FIELD(id, ".implode(", ", $fragments).")", ARRAY_A);
    $return = implode("\n", array_column($results, 'translate'));
  }

  return $return;
}

function get_carbon_wpapper_translate($carbon_field, $post_lng, $lng_to ) {

  if (is_array($carbon_field))
  {
    foreach ($carbon_field as $key=>$item)
    {
      if (is_array($item)) $carbon_field[$key] = get_carbon_wpapper_translate($item, $post_lng, $lng_to);
      elseif (is_string($item) && ((bool) preg_match('/[\p{Cyrillic}]/u', $item))===true && $lng_to!=$post_lng)
      {
        $carbon_field[$key] = get_translate_string($item, $post_lng, $lng_to);
      }
    }
  }
  
  return $carbon_field;
}