<?php

/**
 * Template Name: Добавление в переводы
 *
 * Front page php tempate
 */

get_header();

$count = -1;

$my_posts = get_posts( array(
	'numberposts' => $count,
	'post_type'   => 'product',
  'tax_query' => array(
      array(
        'taxonomy' => 'language',
        'field'    => 'slug',
        'terms'    => 'uk'
      )
    ),
	'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
) );

//print_r(count($my_posts));
//print_r($my_posts[0]);

foreach( $my_posts as $post )
{
  do_action('wp_after_insert_post', $post->ID, $post, true);
  usleep(20);
}

get_footer();
?>