<?php 

if ( !function_exists('biagiotti_membership_dashboard_edit_profile_fields') ) {
	function biagiotti_membership_dashboard_edit_profile_fields($params){

		extract($params);

		$edit_profile = biagiotti_mikado_add_dashboard_fields(array(
			'name' => 'edit_profile',
		));

		$edit_profile_form = biagiotti_mikado_add_dashboard_form(array(
			'name' => 'edit_profile_form',
			'form_id'   => 'mkdf-membership-update-profile-form',
			'form_action' => 'biagiotti_membership_update_user_profile',
			'parent' => $edit_profile,
			'button_label' => esc_html__('Update Profile','biagiotti-membership'),
			'button_args' => array(
				'data-updating-text' => esc_html__('Updating Profile', 'biagiotti-membership'),
				'data-updated-text' => esc_html__('Profile Updated', 'biagiotti-membership'),
			)
		));

		$edit_profile_name_group = biagiotti_mikado_add_dashboard_group(array(
			'name' => 'edit_profile_name_group',
			'parent' => $edit_profile_form,
		));

		biagiotti_mikado_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'first_name',
			'label' => esc_html__('First Name','biagiotti-membership'),
			'parent' => $edit_profile_name_group,
			'value' => $first_name
		));
		
		biagiotti_mikado_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'last_name',
			'label' => esc_html__('Last Name','biagiotti-membership'),
			'parent' => $edit_profile_name_group,
			'value' => $last_name
		));

		biagiotti_mikado_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'email',
			'label' => esc_html__('Email','biagiotti-membership'),
			'parent' => $edit_profile_form,
			'value' => $email,
			'args' => array(
				'input_type' => 'email'
			)
		));

		biagiotti_mikado_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'url',
			'label' => esc_html__('Website','biagiotti-membership'),
			'parent' => $edit_profile_form,
			'value' => $website
		));

		biagiotti_mikado_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'description',
			'label' => esc_html__('Description','biagiotti-membership'),
			'parent' => $edit_profile_form,
			'value' => $description
		));

		biagiotti_mikado_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'password',
			'label' => esc_html__('Password','biagiotti-membership'),
			'parent' => $edit_profile_form,
			'args' => array(
				'input_type' => 'password'
			)
		));

		biagiotti_mikado_add_dashboard_field(array(
			'type' => 'text',
			'name' => 'password2',
			'label' => esc_html__('Repeat Password','biagiotti-membership'),
			'parent' => $edit_profile_form,
			'args' => array(
				'input_type' => 'password'
			)
		));

		$edit_profile->render();
	}
}
?>

<div class="mkdf-membership-dashboard-page">
	<div>
		<?php biagiotti_membership_dashboard_edit_profile_fields($params); ?>
		<?php do_action( 'biagiotti_membership_action_login_ajax_response' ); ?>
	</div>
</div>