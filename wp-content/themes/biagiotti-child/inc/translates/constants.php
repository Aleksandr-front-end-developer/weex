<?php

define('TRANSLATE_POSTS_TERMS_TABLE', $wpdb->prefix . "translate_posts_terms");
define('TRANSLATE_STRINGS_TABLE', $wpdb->prefix . "translate_strings");
define('TRANSLATE_FRAGMENTS_TABLE', $wpdb->prefix . "translate_fragments");

$chat_gpt_text_symbols_qty = intval(get_option('_chat_gpt_text_symbols_qty'));
$count = ($chat_gpt_text_symbols_qty==0) ? 500 : $chat_gpt_text_symbols_qty;
define('MAX_FRAGMENT_LENGTH', $count);

define('CHAT_GPT_API_URL', get_option('_chat_gpt_url'));
