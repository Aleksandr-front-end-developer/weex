<?php

function theme_scripts()
{
}
add_action('wp_enqueue_scripts', 'theme_scripts');


add_action('admin_enqueue_scripts', 'vanc_admin_scripts');
function vanc_admin_scripts() {
}
