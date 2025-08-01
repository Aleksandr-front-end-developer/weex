<?php
$share_type = isset( $share_type ) ? $share_type : 'list';
?>
<?php if ( biagiotti_mikado_is_plugin_installed( 'core' ) && biagiotti_mikado_options()->getOptionValue( 'enable_social_share' ) === 'yes' && biagiotti_mikado_options()->getOptionValue( 'enable_social_share_on_post' ) === 'yes' ) { ?>
	<div class="mkdf-blog-share">
		<?php echo biagiotti_mikado_get_social_share_html( array( 'type' => $share_type, 'icon_type' => 'font-ionicons' ) ); ?>
	</div>
<?php } ?>