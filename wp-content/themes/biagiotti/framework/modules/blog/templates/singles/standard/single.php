<?php

biagiotti_mikado_get_single_post_format_html( $blog_single_type );

do_action( 'biagiotti_mikado_action_after_article_content' );

biagiotti_mikado_get_module_template_part( 'templates/parts/single/single-navigation', 'blog' );

biagiotti_mikado_get_module_template_part( 'templates/parts/single/author-info', 'blog' );

biagiotti_mikado_get_module_template_part( 'templates/parts/single/related-posts', 'blog', '', $single_info_params );

biagiotti_mikado_get_module_template_part( 'templates/parts/single/comments', 'blog' );