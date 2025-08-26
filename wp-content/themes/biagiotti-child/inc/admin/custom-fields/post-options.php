<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'weexnail_translate_post_options', 1 );
function weexnail_translate_post_options() {

	Container::make( 'post_meta', 'Настройки авто-перевода' )
	         ->where( 'post_type', 'IN', array( 'product' ) )
	         ->add_fields( array(
		         Field::make( 'checkbox', 'post_auto_translate', __('Переводить эту запись автоматически. Работает только для перевода записей с основного языка сайта на остальные. Переводятся только ОПУБЛИКОВАННЫЕ записи.', 'biagiotti-child') )
		              ->set_option_value( '1' )
		              ->set_default_value( '1' ),
	         ) );
}
