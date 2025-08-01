<?php

if ( ! function_exists( 'biagiotti_mikado_like' ) ) {
	/**
	 * Returns BiagiottiMikadoClassLike instance
	 *
	 * @return BiagiottiMikadoClassLike
	 */
	function biagiotti_mikado_like() {
		return BiagiottiMikadoClassLike::get_instance();
	}
}

function biagiotti_mikado_get_like() {
	
	echo wp_kses( biagiotti_mikado_like()->add_like(), array(
		'span'  => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'     => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'     => array(
			'href'         => true,
			'class'        => true,
			'id'           => true,
			'title'        => true,
			'style'        => true,
			'data-post-id' => true
		),
		'input' => array(
			'type'  => true,
			'name'  => true,
			'id'    => true,
			'value' => true
		)
	) );
}