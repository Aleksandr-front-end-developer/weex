<?php
/**
 * Admin Menu
 */
function woocrm_get_dynamic_position($start, $increment = 0.1) {

	if (isset($GLOBALS['menu']) && !empty($GLOBALS['menu'])) {

		foreach ($GLOBALS['menu'] as $key => $menu) {
			$menus_positions[] = $key;
		}

		if (!in_array($start, $menus_positions)) {
			return $start;
		}

		while (in_array($start, $menus_positions)) {
			$start += $increment;
		}
	}

	return $start;
}

function woocrm_admin_menu() {

	$menu_place = woocrm_get_dynamic_position(28.1, .1);

	add_menu_page( __( 'WOO CRM', 'wc_crm' ), __( 'WOO CRM', 'wc_crm' ), 'manage_options', 'woo_crm_index', 'plugin_page', WOOCRM_IMAGES_URL . '/wooexim_logo.png', (string) $menu_place );

	add_submenu_page( 'woo_crm_index', __( 'Emails', 'wc_crm' ), __( 'Emails', 'wc_crm' ), 'manage_options', 'woo-crm-emails', 'woocrm_this_is_pro' );

	add_submenu_page( 'woo_crm_index', __( 'Accounts', 'wc_crm' ), __( 'Accounts', 'wc_crm' ), 'manage_options', 'woo-crm-accounts', 'woocrm_this_is_pro' );

	add_submenu_page( 'woo_crm_index', __( 'Tasks', 'wc_crm' ), __( 'Tasks', 'wc_crm' ), 'manage_options', 'woo-crm-tasks', 'woocrm_this_is_pro' );

	add_submenu_page( 'woo_crm_index', __( 'Calls', 'wc_crm' ), __( 'Calls', 'wc_crm' ), 'manage_options', 'woo-crm-calls', 'woocrm_this_is_pro' );

	add_submenu_page( 'woo_crm_index', __( 'Groups', 'wc_crm' ), __( 'Groups', 'wc_crm' ), 'manage_options', 'woo-crm-groups', 'woocrm_this_is_pro' );

	add_submenu_page( 'woo_crm_index', __( 'Pro Features', 'wc_crm' ), __( 'Pro Features', 'wc_crm' ), 'manage_options', 'woo-crm-pro', 'woocrm_pro' );


}

add_action( 'admin_menu', 'woocrm_admin_menu' );


function woocrm_this_is_pro() {
	?>

	<div class="woo-pro">

		<div class="pro-title">
			<h2>This is a Pro feature</h2>
			<a href="https://wooexim.com/woocommerce-crm/" target="_blank">Browse WooCommerce CRM Pro</a>
			<p>Checkout some of WooCommerce CRM Pro features</p>
		</div>
		
		<div class="woo-pro-feature">
			<h3>Manage Customers</h3>
			<p>WooCommerce CRM will help you to enhance the seller to customer relationship. While it may be imperative to bring new orders in, it’s just as important to make sure you keep your existing customers.</p>
		</div>
		
		<div class="woo-pro-feature">
			<h3>Leads Management</h3>
			<p>Every audience is a lead. Manage Lead to Customer workflow using customer statuses and delegate agents to customers for personal management. Which will mature a lead to customer and drive sales.</p>
		</div>
		
		<div class="woo-pro-feature">
			<h3>Communication</h3>
			<p>To build a relationship with customer you need proper communication. Use every channel you have like phone, email, skype twiter or anything else. Send dynamic email to bulk or single recipient.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Customer Profile</h3>
			<p>Maintaining familiarity, we’ve ensured using our Customer Relationship Manager is easy for the new users and existing users. Should the fields available not be sufficient for your stores industry, don’t worry – we’ve got you covered.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Quick Actions</h3>
			<p>Closing a sale cannot be quicker with our quick actions. From our research and customers, we’ve realised that creating orders, viewing orders, sending an email should be done with one click (or tap).</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Documents</h3>
			<p>Allow your customers to upload important documents related to your products and services. This can be done straight from the My Accounts page. Each upload has three statuses: awaiting confirmation, confirm and cancelled.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Customer/Lead Statuses</h3>
			<p>The workflow for some Customer Relationship Managers can be a little bit daunting. We’ve made it easier and simpler using statuses. Assign statuses to customers in the same way you would for your orders.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Key Customer Indicators</h3>
			<p>Using this plugin, a new column will be introduced to the Orders page presenting shop managers with key customer indicators. Like repeat customer, flagged customer, favourite customer or high spending customer.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Default Statuses</h3>
			<p>Currently, there are three ways a customer is added to your WooCommerce store: registration, manually and the checkout page. We allow you to control what status the customer is depending on how they registered.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Importing & Exporting</h3>
			<p>Giving you the freedom to take your data anywhere you want, we’ve provided you with the means to export your customers along with their relevant fields. Should you need to import customers, map fields and import it.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>View Customers Profile</h3>
			<p>Expanding on the User Profile, we’ve created a customer profile with shop related metadata such as purchased products, customer notes, customer orders, emails, tasks and phone calls.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Branded Emails</h3>
			<p>Using your stores email template, this plugin offers the functionality to send branded emails (similar to the order email they receive) straight from the WordPress admin.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Phone Calls</h3>
			<p>Create and place telephone calls with your customers straight from the WordPress admin. Using the default “tel” application on your computer, you can start the phone call right away using Skype or FaceTime.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Customer Notes</h3>
			<p>Notes are useful for customers to keep a track on what is going on with their orders, accounts and other business related activity. With every note, you can define the customer or for the agents managing their target goals.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Customer Groups</h3>
			<p>Group your special customers and manage them more efficiently using this plugin. You can group your customers dynamically or have a fixed set list with your chosen customers.</p>
		</div>

		<p>&nbsp;</p>

		<div class="pro-title">
			<a href="https://wooexim.com/woocommerce-crm/" target="_blank">Browse More Features</a>
		</div>

	</div>

	<?php
}


function woocrm_pro() {
	?>

	<div class="woo-pro">

		<div class="pro-title">
			<h2>WooCommerce CRM Pro</h2>
			<a href="https://wooexim.com/woocommerce-crm/" target="_blank">Browse Website</a>
			<p>Checkout some of WooCommerce CRM Pro features</p>
		</div>
		
		<div class="woo-pro-feature">
			<h3>Manage Customers</h3>
			<p>WooCommerce CRM will help you to enhance the seller to customer relationship. While it may be imperative to bring new orders in, it’s just as important to make sure you keep your existing customers.</p>
		</div>
		
		<div class="woo-pro-feature">
			<h3>Leads Management</h3>
			<p>Every audience is a lead. Manage Lead to Customer workflow using customer statuses and delegate agents to customers for personal management. Which will mature a lead to customer and drive sales.</p>
		</div>
		
		<div class="woo-pro-feature">
			<h3>Communication</h3>
			<p>To build a relationship with customer you need proper communication. Use every channel you have like phone, email, skype twiter or anything else. Send dynamic email to bulk or single recipient.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Customer Profile</h3>
			<p>Maintaining familiarity, we’ve ensured using our Customer Relationship Manager is easy for the new users and existing users. Should the fields available not be sufficient for your stores industry, don’t worry – we’ve got you covered.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Quick Actions</h3>
			<p>Closing a sale cannot be quicker with our quick actions. From our research and customers, we’ve realised that creating orders, viewing orders, sending an email should be done with one click (or tap).</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Documents</h3>
			<p>Allow your customers to upload important documents related to your products and services. This can be done straight from the My Accounts page. Each upload has three statuses: awaiting confirmation, confirm and cancelled.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Customer/Lead Statuses</h3>
			<p>The workflow for some Customer Relationship Managers can be a little bit daunting. We’ve made it easier and simpler using statuses. Assign statuses to customers in the same way you would for your orders.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Key Customer Indicators</h3>
			<p>Using this plugin, a new column will be introduced to the Orders page presenting shop managers with key customer indicators. Like repeat customer, flagged customer, favourite customer or high spending customer.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Default Statuses</h3>
			<p>Currently, there are three ways a customer is added to your WooCommerce store: registration, manually and the checkout page. We allow you to control what status the customer is depending on how they registered.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Importing & Exporting</h3>
			<p>Giving you the freedom to take your data anywhere you want, we’ve provided you with the means to export your customers along with their relevant fields. Should you need to import customers, map fields and import it.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>View Customers Profile</h3>
			<p>Expanding on the User Profile, we’ve created a customer profile with shop related metadata such as purchased products, customer notes, customer orders, emails, tasks and phone calls.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Branded Emails</h3>
			<p>Using your stores email template, this plugin offers the functionality to send branded emails (similar to the order email they receive) straight from the WordPress admin.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Phone Calls</h3>
			<p>Create and place telephone calls with your customers straight from the WordPress admin. Using the default “tel” application on your computer, you can start the phone call right away using Skype or FaceTime.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Customer Notes</h3>
			<p>Notes are useful for customers to keep a track on what is going on with their orders, accounts and other business related activity. With every note, you can define the customer or for the agents managing their target goals.</p>
		</div>

		<div class="woo-pro-feature">
			<h3>Customer Groups</h3>
			<p>Group your special customers and manage them more efficiently using this plugin. You can group your customers dynamically or have a fixed set list with your chosen customers.</p>
		</div>

		<p>&nbsp;</p>

		<div class="pro-title">
			<a href="https://wooexim.com/woocommerce-crm/" target="_blank">Browse More Features</a>
		</div>

	</div>

	<?php
}
