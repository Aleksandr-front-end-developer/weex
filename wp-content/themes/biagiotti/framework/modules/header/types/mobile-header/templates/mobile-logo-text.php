<?php
if(!function_exists('biagiotti_mikado_generate_mobile_logo_text_output')){
    function biagiotti_mikado_generate_mobile_logo_text_output($output){
        if(!empty($output)){
            return $output;
        }
    }
}

$styles = array();
if($logo_text_color != '') {
    $styles[] =  'color: ' . $logo_text_color;
}

do_action( 'biagiotti_mikado_action_before_mobile_logo' ); ?>

    <div class="mkdf-mobile-logo-wrapper mkdf-text-logo">
        <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>">
	        <?php if($mobile_logo_text !== '') { ?>
                <span class="mkdf-text-logo-left" <?php biagiotti_mikado_inline_style($styles); ?>>
                <?php print biagiotti_mikado_generate_mobile_logo_text_output($mobile_logo_text); ?>
                </span>
	        <?php } ?>
        </a>
    </div>

<?php do_action( 'biagiotti_mikado_action_after_mobile_logo' ); ?>
