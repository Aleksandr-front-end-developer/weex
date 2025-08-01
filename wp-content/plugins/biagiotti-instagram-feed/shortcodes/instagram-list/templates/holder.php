<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="mkdf-instagram-list-holder <?php echo esc_attr( $outer_classes ); ?>">
	<?php
	if ( is_array( $images_array ) && count( $images_array ) ) {
		?>
		<ul class="mkdf-instagram-feed mkdf-outer-space <?php echo esc_attr( $holder_classes ); ?> clearfix" <?php biagiotti_instagram_inline_attrs( $data_attr ); ?>>
			<?php
			foreach ( $images_array as $image ) {
				?>
				<li class="mkdf-il-item mkdf-item-space">
					<a href="<?php echo esc_url( $instagram_api->get_helper()->get_image_link( $image ) ); ?>"
					   target="_blank">
						<?php
						echo wp_kses_post( $instagram_api->get_helper()->get_image_html( $image ) );
						?>
						<?php if ( 'yes' === $show_instagram_icon ) { ?>
							<span class="mkdf-instagram-icon"><i class="ion-social-instagram-outline"></i></span>
						<?php } ?>
					</a>
				</li>
			<?php } ?>
		</ul>
	<?php } else { ?>
		<div class="mkdf-instagram-not-connected">
			<?php esc_html_e( 'It seams that you haven\'t connected with your Instagram account', 'estelle-instagram-feed' ); ?>
		</div>
	<?php } ?>
	<?php if ( 'yes' === $show_instagram_info ) { ?>
		<div class="mkdf-instagram-info">
			<?php if ( ! empty( $tagline ) ) { ?>
				<div class="mkdf-instagram-tagline"><?php echo esc_html( $tagline ); ?></div>
			<?php } ?>
			<?php if ( ! empty( $title ) ) { ?>
				<h2 class="mkdf-instagram-title"><?php echo esc_html( $title ); ?></h2>
			<?php } ?>
			<?php if ( ! empty( $subtitle ) ) { ?>
				<div class="mkdf-instagram-subtitle"><?php echo esc_html( $subtitle ); ?></div>
			<?php } ?>
		</div>
	<?php } ?>
</div>
