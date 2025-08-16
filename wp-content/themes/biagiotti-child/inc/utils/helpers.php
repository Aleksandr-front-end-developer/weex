<?php
if ( ! function_exists( 'carbon_lang_prefix' ) ) {
	function carbon_lang_prefix( $as_label = false ) {
		$prefix = '_ru';

		if ( defined( 'ICL_LANGUAGE_CODE' ) && 'all' !== ICL_LANGUAGE_CODE ) {
			$prefix = '_' . ICL_LANGUAGE_CODE;
		}

		if ( $as_label ) {
			$prefix = strtoupper( str_replace( '_', '', $prefix ) );
		}

		return $prefix;
	}
}

if ( ! function_exists( 'carbon_get_association_ids' ) ) {
	function carbon_get_association_id( $id, $name, $is_single = true, $container_id = '' ) {
		$ids = 0;

		$items = carbon_get_post_meta( $id, $name, $container_id = '' );
		if ( $items ) {
			$ids = wp_list_pluck( $items, 'id' );

			if ( $is_single ) {
				$ids = current( $ids );
			}
		}

		return $ids;
	}
}

function get_template_page_id( $template = '' ) {
	$current_lang = pll_current_language();
	$templates    = get_transient( 'templates_page_id' );
	$template_key = $current_lang . '-' . $template;

	if ( false === $templates || ! isset( $templates[ $template_key ] ) ) {
		$page_id   = 0;
		$posts_ids = get_posts( [
			'post_type'        => 'page',
			'posts_per_page'   => 2,
			'meta_key'         => '_wp_page_template',
			'meta_value'       => $template,
			'fields'           => 'ids',
			'orderby'          => 'DESC',
			'suppress_filters' => false
		] );
		if ( $posts_ids ) {
			$page_id = current( $posts_ids );

			$templates[ $template_key ] = $page_id;
			set_transient( 'templates_page_id', $templates );
		}
	} else {
		$page_id = $templates[ $template_key ];
	}

	return $page_id;
}

function santinize_content_for_description( $text ) {

  //Двойная очистка с помощью wp_strip_all_tags из-за вложенных тэгов в iframe srcset
  return esc_attr(sanitize_text_field(wp_strip_all_tags($text)));
}

/*//Для создания дерева объектов WP_Term
function recursive_set_category_array($terms, $terms_unedited, $level) {
global $terms_tree;

  foreach ($terms as $term_id=>$term)
  {
    if ($term->parent==0 && $level==0)
    {
      $terms_tree[$term->term_id]['term'] = $term;
      unset($terms[$term_id]);
    }
    if ($term->parent>0 && $level>0)
    {
      $parents = array_reverse(recursive_get_category_parents($terms_unedited, $term->term_id));

      $item = &$terms_tree;
      $found = true;
      foreach($parents as $k){
        if (isset($item[$k]))
        {
          $item = &$item[$k];
        } else $found = false;
      }
      if ($found)
      {
        $item[$term->term_id]['term'] = $term;
        unset($terms[$term_id]);
      }
    }    
  }
  if (count($terms)>0 && $level<=10) recursive_set_category_array($terms, $terms_unedited, $level+1);
}

//для создания списка родителей термина из полного массива
function recursive_get_category_parents($terms, $term_id) {

  $parents = array();
  if ($terms[$term_id]->parent>0)
  {
    $parents[] = $terms[$term_id]->parent;
    $parents = array_merge($parents, recursive_get_category_parents($terms, $terms[$terms[$term_id]->parent]->term_id));
  }
  
  return $parents;
}*/

function get_term_w_parents($term) {

  $temp = array();
  $next_term = $term;          
  while ($next_term->parent!=0)
  {
    $next_term  = get_term_by( 'id', $next_term->parent, $next_term->taxonomy );
    $temp[] = $next_term;
  }
  $temp = array_reverse($temp);
  $temp = array_merge($temp, array($term));
  
  return $temp;
}

function mb_trim( $str ) {
	return mb_ereg_replace(
		'^[[:space:]]*([\s\S]*?)[[:space:]]*$', '\1', $str );
}

function get_acronym( $str ) {
	$words   = explode( " ", mb_trim( $str ) );
	$acronym = "";

	foreach ( $words as $w ) {
		if ( mb_strlen( $w ) > 0 ) {
			$acronym .= mb_strtoupper( mb_substr( $w, 0, 1 ) );
		}
	}
	$acronym = mb_substr( $acronym, 0, 3 );

	return $acronym;
}

function get_first_word( $str ) {
	$words = explode( " ", mb_trim( $str ) );

	return $words[0];
}

function get_language_page_url( $post_slug, $lng ) {

	if ( function_exists( 'pll_get_post' ) ) {
		return pll_get_post( $post_slug, $lng );
	}

	return $post_slug;
}

function get_language_preffix() {

	if ( function_exists( 'pll_default_language' ) && function_exists( 'pll_current_language' ) ) {
		$current = pll_current_language();
		if ( $current == pll_default_language() ) {
			$preffix = '';
		}
		else {
			$preffix = '/' . $current;
		}

		return $preffix;
	}

	return '';
}

function get_default_language() {

	if ( function_exists( 'pll_default_language' ) ) {
		return pll_default_language();
	}

	return 'uk';
}

function get_current_language( $value = 'slug' ) {

	if ( function_exists( 'pll_current_language' ) ) {
		return pll_current_language( $value );
	}

	return 'uk';
}

function get_language_post( $post_id, $slug = '' ) {

	if ( function_exists( 'pll_get_post' ) ) {
		return pll_get_post( $post_id, $slug );
	}

	return $post_id;
}

function get_language_term( $term_id, $slug ) {

	if ( function_exists( 'pll_get_term' ) ) {
		return pll_get_term( $term_id, $slug );
	}

	return $term_id;
}

function get_languages_list() {

	if ( function_exists( 'pll_languages_list' ) ) {
		return pll_languages_list();
	}

	return array( 'ru' );
}

function get_languages_list_full() {

	if ( function_exists( 'pll_languages_list' ) ) {
		return pll_languages_list( array( 'fields' => array() ) );
	}

	return array();
}

function get_post_language( $post_id ) {

	if ( function_exists( 'pll_get_post_language' ) ) {
		return pll_get_post_language( $post_id );
	}

	return 'ru';
}

function get_term_language( $term_id ) {

	if ( function_exists( 'pll_get_term_language' ) ) {
		return pll_get_term_language( $term_id );
	}

	return 'ru';
}

function is_translated_post_type( $post_type ) {

	if ( function_exists( 'pll_is_translated_post_type' ) ) {
		return pll_is_translated_post_type( $post_type );
	}

	return false;
}

function is_translated_taxonomy( $tax ) {

	if ( function_exists( 'pll_is_translated_taxonomy' ) ) {
		return pll_is_translated_taxonomy( $tax );
	}

	return false;
}

function trim_post( $errors = array() ) {

	foreach ( $_POST as $k => &$v ) {
		$v = mb_trim( $v );
		if ( $v == '' ) {
			$errors[ $k ] = __( 'Поле обязательно для заполнения', THEME_NAME );
		}
	}
	unset( $v );

	return $errors;
}
