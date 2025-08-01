<?php do_action( 'biagiotti_mikado_action_before_footer_content' ); ?>
</div> <!-- close div.content_inner -->
	</div>  <!-- close div.content -->
		<?php if($display_footer && ($display_footer_top || $display_footer_bottom)) { ?>
			<footer class="mkdf-page-footer <?php echo esc_attr($holder_classes); ?>">
				<?php
					if($display_footer_top) {
						biagiotti_mikado_get_footer_top();
					}
					if($display_footer_bottom) {
						biagiotti_mikado_get_footer_bottom();
					}
				?>
			</footer>
		<?php } ?>
	</div> <!-- close div.mkdf-wrapper-inner  -->
</div> <!-- close div.mkdf-wrapper -->
<?php
/**
 * biagiotti_mikado_action_before_closing_body_tag hook
 *
 * @see biagiotti_mikado_get_side_area() - hooked with 10
 * @see biagiotti_mikado_smooth_page_transitions() - hooked with 10
 */
do_action( 'biagiotti_mikado_action_before_closing_body_tag' ); ?>
<?php wp_footer(); ?>
</body>
</html>