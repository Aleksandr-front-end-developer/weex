<?php

add_action('init', 'vancouver_create_tables_for_translates', 1 );

function vancouver_create_tables_for_translates() {
  global $wpdb;
  
  $create_tables = carbon_get_theme_option('create_translate_tables');
  
  if ($create_tables=='1')
  {
    $charset_collate = $wpdb->get_charset_collate();
    
    if($wpdb->get_var("SHOW TABLES LIKE '".TRANSLATE_POSTS_TERMS_TABLE."'") != TRANSLATE_POSTS_TERMS_TABLE)
    {
      $sql = "CREATE TABLE ".TRANSLATE_POSTS_TERMS_TABLE." (
              id int NOT NULL AUTO_INCREMENT,
              lng_from varchar(2) DEFAULT NULL,
              lng_to varchar(2) DEFAULT NULL,
              post_term_id int DEFAULT 0,
              post_or_term varchar(20) DEFAULT NULL,
              translate_strings text DEFAULT NULL,
              PRIMARY KEY (id),
              KEY lng_from (lng_from),
              KEY lng_to (lng_to),
              KEY post_term (post_term_id, post_or_term)
              ) ".$charset_collate.";";
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
    }  

    if($wpdb->get_var("SHOW TABLES LIKE '".TRANSLATE_STRINGS_TABLE."'") != TRANSLATE_STRINGS_TABLE)
    {
      $sql = "CREATE TABLE ".TRANSLATE_STRINGS_TABLE." (
              id int NOT NULL AUTO_INCREMENT,
              lng_from varchar(2) DEFAULT NULL,
              lng_to varchar(2) DEFAULT NULL,
              source_text text DEFAULT NULL,
              fragments text DEFAULT NULL,
              PRIMARY KEY (id),
              KEY lng_from (lng_from),
              KEY lng_to (lng_to)
              ) ".$charset_collate.";";
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
    }  

    if($wpdb->get_var("SHOW TABLES LIKE '".TRANSLATE_FRAGMENTS_TABLE."'") != TRANSLATE_FRAGMENTS_TABLE)
    {
      $sql = "CREATE TABLE ".TRANSLATE_FRAGMENTS_TABLE." (
              id int NOT NULL AUTO_INCREMENT,
              lng_from varchar(2) DEFAULT NULL,
              lng_to varchar(2) DEFAULT NULL,
              source_text text DEFAULT NULL,
              translate text DEFAULT NULL,
              translated int DEFAULT 0,
              PRIMARY KEY (id),
              KEY lng_from (lng_from),
              KEY lng_to (lng_to),
              KEY translated (translated)
              ) ".$charset_collate.";";
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
    }
  }  
}
