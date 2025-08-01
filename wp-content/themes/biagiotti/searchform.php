<form role="search" method="get" class="mkdf-searchform searchform" id="searchform-<?php echo esc_attr(rand(0, 1000)); ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text"><?php esc_html_e( 'Search for:', 'biagiotti' ); ?></label>
	<div class="input-holder clearfix">
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search...', 'biagiotti' ); ?>" value="" name="s" title="<?php esc_attr_e( 'Search for:', 'biagiotti' ); ?>"/>
		<button type="submit" class="mkdf-search-submit"><span class="mkdf-search-icon"><?php echo biagiotti_mikado_search_icon_svg(); ?></span></button>
	</div>
</form>