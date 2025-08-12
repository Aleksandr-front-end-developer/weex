<?php
add_filter('doing_it_wrong_trigger_error', function ($enable, $function_name) {
	if ($function_name === '_load_textdomain_just_in_time') {
		$enable = false;
	}

	return $enable;
}, 1, 2);

/*
add_filter( 'deprecated_function_run', function( $function, $replacement, $version ) {
    if ( $function === 'WC_Order_Item_Product::offsetSet' ) {
        $trace = debug_backtrace();
        error_log( '=== Deprecated function backtrace ===' );
        foreach ( $trace as $step ) {
            if ( isset( $step['file'], $step['line'] ) ) {
                error_log( sprintf(
                    '%s:%d -> %s%s()',
                    $step['file'],
                    $step['line'],
                    isset($step['class']) ? $step['class'].'::' : '',
                    $step['function']
                ));
            }
        }
        error_log( '=== End backtrace ===' );
    }
    return true;
}, 10, 3 );
*/