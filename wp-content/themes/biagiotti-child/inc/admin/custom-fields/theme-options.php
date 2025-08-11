<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'vancouverok_theme_options');
function vancouverok_theme_options()
{
  $tarnslate_error = get_option( 'last_translate_error', '' );

	$basic_options_container = Container::make('theme_options', __('Site settings', 'biagiotti' ))

		->set_page_menu_title('Site settings')

		->add_tab( __('Auto-translate', 'biagiotti' ), array(
      Field::make( 'text', 'chat_gpt_url', __('LLM API url', 'biagiotti' ) )
      ->set_autoload(true),
      Field::make( 'text', 'chat_gpt_key', __('LLM API Authorization Key', 'biagiotti' ) )
      ->set_autoload(true),
      Field::make( 'text', 'chat_gpt_model', __('LLM API model', 'biagiotti' ) )
      ->set_autoload(true),
      Field::make( 'text', 'chat_gpt_text_symbols_qty', __('Maximum number of characters in the request text (excluding prompt)', 'biagiotti' ) )
      ->set_attribute( 'type', 'number' )
      ->set_autoload(true),
      Field::make( 'textarea', 'chat_gpt_message', __('LLM prompt before sending text (%src_lng% - source language, %dest_lng% - destination language)', 'biagiotti' ) )
      ->set_autoload(true),
      Field::make( 'html', 'chat_gpt_error_information_text' )
      ->set_html( '<h2><strong>'.__('Last error request to LLM', 'biagiotti' ).':</strong></h2><p style="color:red">'.$tarnslate_error.'</p>' ),
      Field::make( 'checkbox', 'create_translate_tables', __('Create database tables for auto-translation (after checking the functionality, it is better to disable it to increase performance)', 'biagiotti' ) )
      ->set_option_value( '1' )
      ->set_autoload(true),
		));

}
