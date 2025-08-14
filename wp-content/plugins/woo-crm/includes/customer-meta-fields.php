<?php
/**
 * Adds a meta box to the post editing screen
 */
function woocrm_customer_metaboxes() {
	add_meta_box(
		'woocrm_customer_meta', 
		__( 'Customer Informations', 'wc_crm' ), 
		'woocrm_customer_meta_callback', 
		'customers',
		'normal',
		'high'
	);
}

/**
 * Outputs the content of the meta box
 */
function woocrm_customer_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
	$prfx_stored_meta = get_post_meta( $post->ID );
	?>
	
	<div class="woo-crm">
		<p>
			<label for="first_name" class="prfx-row-title"><?php _e( 'First Name', 'wc_crm' )?></label>
			<input type="text" name="first_name" id="first_name" value="<?php if ( isset ( $prfx_stored_meta['first_name'] ) ) echo $prfx_stored_meta['first_name'][0]; ?>" />
		</p>

		<p>
			<label for="last_name" class="prfx-row-title"><?php _e( 'Last Name', 'wc_crm' )?></label>
			<input type="text" name="last_name" id="last_name" value="<?php if ( isset ( $prfx_stored_meta['last_name'] ) ) echo $prfx_stored_meta['last_name'][0]; ?>" />
		</p>
		
		<p>
			<label for="customer_status" class="prfx-row-title"><?php _e( 'Status', 'wc_crm' )?></label>
			<select name="customer_status" id="customer_status">
				<option value="Customer" <?php if ( isset ( $prfx_stored_meta['customer_status'] ) ) selected( $prfx_stored_meta['customer_status'][0], 'Customer' ); ?>><?php _e( 'Customer', 'wc_crm' )?></option>';
				<option value="Lead" <?php if ( isset ( $prfx_stored_meta['customer_status'] ) ) selected( $prfx_stored_meta['customer_status'][0], 'Lead' ); ?>><?php _e( 'Lead', 'wc_crm' )?></option>';
				<option value="Follow-up" <?php if ( isset ( $prfx_stored_meta['customer_status'] ) ) selected( $prfx_stored_meta['customer_status'][0], 'Follow-up' ); ?>><?php _e( 'Follow-up', 'wc_crm' )?></option>';
				<option value="Prospect" <?php if ( isset ( $prfx_stored_meta['customer_status'] ) ) selected( $prfx_stored_meta['customer_status'][0], 'Prospect' ); ?>><?php _e( 'Prospect', 'wc_crm' )?></option>';
				<option value="Favourite" <?php if ( isset ( $prfx_stored_meta['customer_status'] ) ) selected( $prfx_stored_meta['customer_status'][0], 'Favourite' ); ?>><?php _e( 'Favourite', 'wc_crm' )?></option>';
				<option value="Blocked" <?php if ( isset ( $prfx_stored_meta['customer_status'] ) ) selected( $prfx_stored_meta['customer_status'][0], 'Blocked' ); ?>><?php _e( 'Blocked', 'wc_crm' )?></option>';
				<option value="Flagged" <?php if ( isset ( $prfx_stored_meta['customer_status'] ) ) selected( $prfx_stored_meta['customer_status'][0], 'Flagged' ); ?>><?php _e( 'Flagged', 'wc_crm' )?></option>';
			</select>
		</p>
		
		<p>
			<label for="customer_title" class="prfx-row-title"><?php _e( 'Title', 'wc_crm' )?></label>
			<input type="text" name="customer_title" id="customer_title" value="<?php if ( isset ( $prfx_stored_meta['customer_title'] ) ) echo $prfx_stored_meta['customer_title'][0]; ?>" />
		</p>
		
		<p>
			<label for="user_email" class="prfx-row-title"><?php _e( 'Email', 'wc_crm' )?></label>
			<input type="text" name="user_email" id="user_email" value="<?php if ( isset ( $prfx_stored_meta['user_email'] ) ) echo $prfx_stored_meta['user_email'][0]; ?>" />
		</p>
		
		<p>
			<label for="customer_department" class="prfx-row-title"><?php _e( 'Department', 'wc_crm' )?></label>
			<input type="text" name="customer_department" id="customer_department" value="<?php if ( isset ( $prfx_stored_meta['customer_department'] ) ) echo $prfx_stored_meta['customer_department'][0]; ?>" />
		</p>
		
		<p>
			<label for="customer_mobile" class="prfx-row-title"><?php _e( 'Mobile', 'wc_crm' )?></label>
			<input type="text" name="customer_mobile" id="customer_mobile" value="<?php if ( isset ( $prfx_stored_meta['customer_mobile'] ) ) echo $prfx_stored_meta['customer_mobile'][0]; ?>" />
		</p>
		
		<p>
			<label for="customer_fax" class="prfx-row-title"><?php _e( 'Fax', 'wc_crm' )?></label>
			<input type="text" name="customer_fax" id="customer_fax" value="<?php if ( isset ( $prfx_stored_meta['customer_fax'] ) ) echo $prfx_stored_meta['customer_fax'][0]; ?>" />
		</p>
		
		<p>
			<label for="customer_site" class="prfx-row-title"><?php _e( 'Website', 'wc_crm' )?></label>
			<input type="text" name="customer_site" id="customer_site" value="<?php if ( isset ( $prfx_stored_meta['customer_site'] ) ) echo $prfx_stored_meta['customer_site'][0]; ?>" />
		</p>

		<p>
			<label for="customer_lead_source" class="prfx-row-title"><?php _e( 'Lead Source', 'wc_crm' )?></label>
			<select name="customer_lead_source" id="customer_lead_source">
				<option value="Advertisment" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Advertisment' ); ?>><?php _e( 'Advertisment', 'wc_crm' )?></option>';
				<option value="Cold Call" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Cold Call' ); ?>><?php _e( 'Cold Call', 'wc_crm' )?></option>';
				<option value="Employee Referral" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Employee Referral' ); ?>><?php _e( 'Employee Referral', 'wc_crm' )?></option>';
				<option value="External Referral" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'External Referral' ); ?>><?php _e( 'External Referral', 'wc_crm' )?></option>';
				<option value="Online Store" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Online Store' ); ?>><?php _e( 'Online Store', 'wc_crm' )?></option>';
				<option value="Partner" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Partner' ); ?>><?php _e( 'Partner', 'wc_crm' )?></option>';
				<option value="Public Relations" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Public Relations' ); ?>><?php _e( 'Public Relations', 'wc_crm' )?></option>';
				<option value="Sales Mail Alias" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Sales Mail Alias' ); ?>><?php _e( 'Sales Mail Alias', 'wc_crm' )?></option>';
				<option value="Seminal Partner" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Seminal Partner' ); ?>><?php _e( 'Seminal Partner', 'wc_crm' )?></option>';
				<option value="Seminar Internal" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Seminar Internal' ); ?>><?php _e( 'Seminar Internal', 'wc_crm' )?></option>';
				<option value="Trade Show" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Trade Show' ); ?>><?php _e( 'Trade Show', 'wc_crm' )?></option>';
				<option value="Web Download" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Web Download' ); ?>><?php _e( 'Web Download', 'wc_crm' )?></option>';
				<option value="Web Research" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Web Research' ); ?>><?php _e( 'Web Research', 'wc_crm' )?></option>';
				<option value="Web Cases" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Web Cases' ); ?>><?php _e( 'Web Cases', 'wc_crm' )?></option>';
				<option value="Web Mail" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Web Mail' ); ?>><?php _e( 'Web Mail', 'wc_crm' )?></option>';
				<option value="Chat" <?php if ( isset ( $prfx_stored_meta['customer_lead_source'] ) ) selected( $prfx_stored_meta['customer_lead_source'][0], 'Chat' ); ?>><?php _e( 'Chat', 'wc_crm' )?></option>';
			</select>
		</p>
		
		
		<p>
			<label for="customer_lead_status" class="prfx-row-title"><?php _e( 'Lead Status', 'wc_crm' )?></label>
			<select name="customer_lead_status" id="customer_lead_status">
				<option value="Attempted to Contact" <?php if ( isset ( $prfx_stored_meta['customer_lead_status'] ) ) selected( $prfx_stored_meta['customer_lead_status'][0], 'Attempted to Contact' ); ?>><?php _e( 'Attempted to Contact', 'wc_crm' )?></option>';
				<option value="Contact in Future" <?php if ( isset ( $prfx_stored_meta['customer_lead_status'] ) ) selected( $prfx_stored_meta['customer_lead_status'][0], 'Contact in Future' ); ?>><?php _e( 'Contact in Future', 'wc_crm' )?></option>';
				<option value="Contacted" <?php if ( isset ( $prfx_stored_meta['customer_lead_status'] ) ) selected( $prfx_stored_meta['customer_lead_status'][0], 'Contacted' ); ?>><?php _e( 'Contacted', 'wc_crm' )?></option>';
				<option value="Junk Lead" <?php if ( isset ( $prfx_stored_meta['customer_lead_status'] ) ) selected( $prfx_stored_meta['customer_lead_status'][0], 'Junk Lead' ); ?>><?php _e( 'Junk Lead', 'wc_crm' )?></option>';
				<option value="Lost Lead" <?php if ( isset ( $prfx_stored_meta['customer_lead_status'] ) ) selected( $prfx_stored_meta['customer_lead_status'][0], 'Lost Lead' ); ?>><?php _e( 'Lost Lead', 'wc_crm' )?></option>';
				<option value="Not Contacted" <?php if ( isset ( $prfx_stored_meta['customer_lead_status'] ) ) selected( $prfx_stored_meta['customer_lead_status'][0], 'Not Contacted' ); ?>><?php _e( 'Not Contacted', 'wc_crm' )?></option>';
				<option value="Pre Qualified" <?php if ( isset ( $prfx_stored_meta['customer_lead_status'] ) ) selected( $prfx_stored_meta['customer_lead_status'][0], 'Pre Qualified' ); ?>><?php _e( 'Pre Qualified', 'wc_crm' )?></option>';
			</select>
		</p>
		
		
		<p>
			<label for="customer_industry" class="prfx-row-title"><?php _e( 'Industry', 'wc_crm' )?></label>
			<select name="customer_industry" id="customer_industry">
				<option value="Accounting" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Accounting' ); ?>><?php _e( 'Accounting', 'wc_crm' )?></option>';
				<option value="Airlines/Aviation" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Airlines/Aviation' ); ?>><?php _e( 'Airlines/Aviation', 'wc_crm' )?></option>';
				<option value="Alternative Dispute Resolution" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Alternative Dispute Resolution' ); ?>><?php _e( 'Alternative Dispute Resolution', 'wc_crm' )?></option>';
				<option value="Alternative Medicine" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Alternative Medicine' ); ?>><?php _e( 'Alternative Medicine', 'wc_crm' )?></option>';
				<option value="Animation" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Animation' ); ?>><?php _e( 'Animation', 'wc_crm' )?></option>';
				<option value="Apparel & Fashion" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Apparel & Fashion' ); ?>><?php _e( 'Apparel & Fashion', 'wc_crm' )?></option>';
				<option value="Architecture & Planning" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Architecture & Planning' ); ?>><?php _e( 'Architecture & Planning', 'wc_crm' )?></option>';
				<option value="Arts and Crafts" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Arts and Crafts' ); ?>><?php _e( 'Arts and Crafts', 'wc_crm' )?></option>';
				<option value="Automotive" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Automotive' ); ?>><?php _e( 'Automotive', 'wc_crm' )?></option>';
				<option value="Aviation & Aerospace" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Aviation & Aerospace' ); ?>><?php _e( 'Aviation & Aerospace', 'wc_crm' )?></option>';
				<option value="Banking" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Banking' ); ?>><?php _e( 'Banking', 'wc_crm' )?></option>';
				<option value="Biotechnology" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Biotechnology' ); ?>><?php _e( 'Biotechnology', 'wc_crm' )?></option>';
				<option value="Broadcast Media" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Broadcast Media' ); ?>><?php _e( 'Broadcast Media', 'wc_crm' )?></option>';
				<option value="Building Materials" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Building Materials' ); ?>><?php _e( 'Building Materials', 'wc_crm' )?></option>';
				<option value="Business Supplies and Equipment" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Business Supplies and Equipment' ); ?>><?php _e( 'Business Supplies and Equipment', 'wc_crm' )?></option>';
				<option value="Capital Markets" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Capital Markets' ); ?>><?php _e( 'Capital Markets', 'wc_crm' )?></option>';
				<option value="Chemicals" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Chemicals' ); ?>><?php _e( 'Chemicals', 'wc_crm' )?></option>';
				<option value="Civic & Social Organization" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Civic & Social Organization' ); ?>><?php _e( 'Civic & Social Organization', 'wc_crm' )?></option>';
				<option value="Civil Engineering" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Civil Engineering' ); ?>><?php _e( 'Civil Engineering', 'wc_crm' )?></option>';
				<option value="Commercial Real Estate" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Commercial Real Estate' ); ?>><?php _e( 'Commercial Real Estate', 'wc_crm' )?></option>';
				<option value="Computer & Network Security" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Computer & Network Security' ); ?>><?php _e( 'Computer & Network Security', 'wc_crm' )?></option>';
				<option value="Computer Games" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Computer Games' ); ?>><?php _e( 'Computer Games', 'wc_crm' )?></option>';
				<option value="Others" <?php if ( isset ( $prfx_stored_meta['customer_industry'] ) ) selected( $prfx_stored_meta['customer_industry'][0], 'Others' ); ?>><?php _e( 'Others', 'wc_crm' )?></option>';
			</select>
		</p>
		
		<p>
			<label for="customer_agent" class="prfx-row-title"><?php _e( 'Agent', 'wc_crm' )?></label>
			<input type="text" name="customer_agent" id="customer_agent" value="<?php if ( isset ( $prfx_stored_meta['customer_agent'] ) ) echo $prfx_stored_meta['customer_agent'][0]; ?>" />
		</p>
		
		<p>
			<label for="date_of_birth" class="prfx-row-title"><?php _e( 'Date of Birth', 'wc_crm' )?></label>
			<input type="text" name="date_of_birth" id="date_of_birth" value="<?php if ( isset ( $prfx_stored_meta['date_of_birth'] ) ) echo $prfx_stored_meta['date_of_birth'][0]; ?>" />
		</p>
		
		<p>
			<label for="customer_assistant" class="prfx-row-title"><?php _e( 'Assistant', 'wc_crm' )?></label>
			<input type="text" name="customer_assistant" id="customer_assistant" value="<?php if ( isset ( $prfx_stored_meta['customer_assistant'] ) ) echo $prfx_stored_meta['customer_assistant'][0]; ?>" />
		</p>
		
		<p>
			<label for="customer_skype" class="prfx-row-title"><?php _e( 'Skype', 'wc_crm' )?></label>
			<input type="text" name="customer_skype" id="customer_skype" value="<?php if ( isset ( $prfx_stored_meta['customer_skype'] ) ) echo $prfx_stored_meta['customer_skype'][0]; ?>" />
		</p>
		
		<p>
			<label for="customer_twitter" class="prfx-row-title"><?php _e( 'Twitter', 'wc_crm' )?></label>
			<input type="text" name="customer_twitter" id="customer_twitter" value="<?php if ( isset ( $prfx_stored_meta['customer_twitter'] ) ) echo $prfx_stored_meta['customer_twitter'][0]; ?>" />
		</p>
		
		<p>
			<label for="customer_categories" class="prfx-row-title"><?php _e( 'Categories', 'wc_crm' )?></label>
			<input type="text" name="customer_categories" id="customer_categories" value="<?php if ( isset ( $prfx_stored_meta['customer_categories'] ) ) echo $prfx_stored_meta['customer_categories'][0]; ?>" />
		</p>
		
		<p>
			<label for="customer_brands" class="prfx-row-title"><?php _e( 'Brands', 'wc_crm' )?></label>
			<input type="text" name="customer_brands" id="customer_brands" value="<?php if ( isset ( $prfx_stored_meta['customer_brands'] ) ) echo $prfx_stored_meta['customer_brands'][0]; ?>" />
		</p>
	</div>

	<p>&nbsp;</p>

	<h4>Billing Address</h4>

	
	<div class="woo-crm">
		<p>
			<label for="billing_first_name" class="prfx-row-title"><?php _e( 'First Name', 'wc_crm' )?></label>
			<input type="text" name="billing_first_name" id="billing_first_name" value="<?php if ( isset ( $prfx_stored_meta['billing_first_name'] ) ) echo $prfx_stored_meta['billing_first_name'][0]; ?>" />
		</p>

		<p>
			<label for="billing_last_name" class="prfx-row-title"><?php _e( 'Last Name', 'wc_crm' )?></label>
			<input type="text" name="billing_last_name" id="billing_last_name" value="<?php if ( isset ( $prfx_stored_meta['billing_last_name'] ) ) echo $prfx_stored_meta['billing_last_name'][0]; ?>" />
		</p>

		<p>
			<label for="billing_company" class="prfx-row-title"><?php _e( 'Company', 'wc_crm' )?></label>
			<input type="text" name="billing_company" id="billing_company" value="<?php if ( isset ( $prfx_stored_meta['billing_company'] ) ) echo $prfx_stored_meta['billing_company'][0]; ?>" />
		</p>
		
		<p>
			<label for="billing_address_1" class="prfx-row-title"><?php _e( 'Address 1', 'wc_crm' )?></label>
			<input type="text" name="billing_address_1" id="billing_address_1" value="<?php if ( isset ( $prfx_stored_meta['billing_address_1'] ) ) echo $prfx_stored_meta['billing_address_1'][0]; ?>" />
		</p>
		
		<p>
			<label for="billing_address_2" class="prfx-row-title"><?php _e( 'Address 2', 'wc_crm' )?></label>
			<input type="text" name="billing_address_2" id="billing_address_2" value="<?php if ( isset ( $prfx_stored_meta['billing_address_2'] ) ) echo $prfx_stored_meta['billing_address_2'][0]; ?>" />
		</p>
		
		<p>
			<label for="billing_city" class="prfx-row-title"><?php _e( 'City', 'wc_crm' )?></label>
			<input type="text" name="billing_city" id="billing_city" value="<?php if ( isset ( $prfx_stored_meta['billing_city'] ) ) echo $prfx_stored_meta['billing_city'][0]; ?>" />
		</p>
		
		<p>
			<label for="billing_postcode" class="prfx-row-title"><?php _e( 'Postcode', 'wc_crm' )?></label>
			<input type="text" name="billing_postcode" id="billing_postcode" value="<?php if ( isset ( $prfx_stored_meta['billing_postcode'] ) ) echo $prfx_stored_meta['billing_postcode'][0]; ?>" />
		</p>
		
		<p>
			<label for="billing_country" class="prfx-row-title"><?php _e( 'Country', 'wc_crm' )?></label>
			<input type="text" name="billing_country" id="billing_country" value="<?php if ( isset ( $prfx_stored_meta['billing_country'] ) ) echo $prfx_stored_meta['billing_country'][0]; ?>" />
		</p>
		
		<p>
			<label for="billing_state" class="prfx-row-title"><?php _e( 'State', 'wc_crm' )?></label>
			<input type="text" name="billing_state" id="billing_state" value="<?php if ( isset ( $prfx_stored_meta['billing_state'] ) ) echo $prfx_stored_meta['billing_state'][0]; ?>" />
		</p>
		
		<p>
			<label for="billing_email" class="prfx-row-title"><?php _e( 'Email', 'wc_crm' )?></label>
			<input type="text" name="billing_email" id="billing_email" value="<?php if ( isset ( $prfx_stored_meta['billing_email'] ) ) echo $prfx_stored_meta['billing_email'][0]; ?>" />
		</p>
		
		<p>
			<label for="billing_phone" class="prfx-row-title"><?php _e( 'Phone', 'wc_crm' )?></label>
			<input type="text" name="billing_phone" id="billing_phone" value="<?php if ( isset ( $prfx_stored_meta['billing_phone'] ) ) echo $prfx_stored_meta['billing_phone'][0]; ?>" />
		</p>
	</div>

	<p>&nbsp;</p>

	<h4>Shipping Address</h4>

	
	<div class="woo-crm">
		<p>
			<label for="shipping_first_name" class="prfx-row-title"><?php _e( 'First Name', 'wc_crm' )?></label>
			<input type="text" name="shipping_first_name" id="shipping_first_name" value="<?php if ( isset ( $prfx_stored_meta['shipping_first_name'] ) ) echo $prfx_stored_meta['shipping_first_name'][0]; ?>" />
		</p>

		<p>
			<label for="shipping_last_name" class="prfx-row-title"><?php _e( 'Last Name', 'wc_crm' )?></label>
			<input type="text" name="shipping_last_name" id="shipping_last_name" value="<?php if ( isset ( $prfx_stored_meta['shipping_last_name'] ) ) echo $prfx_stored_meta['shipping_last_name'][0]; ?>" />
		</p>

		<p>
			<label for="shipping_company" class="prfx-row-title"><?php _e( 'Company', 'wc_crm' )?></label>
			<input type="text" name="shipping_company" id="shipping_company" value="<?php if ( isset ( $prfx_stored_meta['shipping_company'] ) ) echo $prfx_stored_meta['shipping_company'][0]; ?>" />
		</p>
		
		<p>
			<label for="shipping_address_1" class="prfx-row-title"><?php _e( 'Address 1', 'wc_crm' )?></label>
			<input type="text" name="shipping_address_1" id="shipping_address_1" value="<?php if ( isset ( $prfx_stored_meta['shipping_address_1'] ) ) echo $prfx_stored_meta['shipping_address_1'][0]; ?>" />
		</p>
		
		<p>
			<label for="shipping_address_2" class="prfx-row-title"><?php _e( 'Address 2', 'wc_crm' )?></label>
			<input type="text" name="shipping_address_2" id="shipping_address_2" value="<?php if ( isset ( $prfx_stored_meta['shipping_address_2'] ) ) echo $prfx_stored_meta['shipping_address_2'][0]; ?>" />
		</p>
		
		<p>
			<label for="shipping_city" class="prfx-row-title"><?php _e( 'City', 'wc_crm' )?></label>
			<input type="text" name="shipping_city" id="shipping_city" value="<?php if ( isset ( $prfx_stored_meta['shipping_city'] ) ) echo $prfx_stored_meta['shipping_city'][0]; ?>" />
		</p>
		
		<p>
			<label for="shipping_postcode" class="prfx-row-title"><?php _e( 'Postcode', 'wc_crm' )?></label>
			<input type="text" name="shipping_postcode" id="shipping_postcode" value="<?php if ( isset ( $prfx_stored_meta['shipping_postcode'] ) ) echo $prfx_stored_meta['shipping_postcode'][0]; ?>" />
		</p>
		
		<p>
			<label for="shipping_country" class="prfx-row-title"><?php _e( 'Country', 'wc_crm' )?></label>
			<input type="text" name="shipping_country" id="shipping_country" value="<?php if ( isset ( $prfx_stored_meta['shipping_country'] ) ) echo $prfx_stored_meta['shipping_country'][0]; ?>" />
		</p>
		
		<p>
			<label for="shipping_state" class="prfx-row-title"><?php _e( 'State', 'wc_crm' )?></label>
			<input type="text" name="shipping_state" id="shipping_state" value="<?php if ( isset ( $prfx_stored_meta['shipping_state'] ) ) echo $prfx_stored_meta['shipping_state'][0]; ?>" />
		</p>
	</div>
	<?php
}





/**
 * Saves the custom meta input
 */
function woocrm_customer_meta_save( $post_id ) {
 
	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? true : false;
 
	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}

	$customers_meta['first_name'] = sanitize_text_field( $_POST['first_name'] );
	$customers_meta['last_name'] = sanitize_text_field( $_POST['last_name'] );
	$customers_meta['customer_status'] = sanitize_text_field( $_POST['customer_status'] );
	$customers_meta['customer_title'] = sanitize_text_field( $_POST['customer_title'] );
	$customers_meta['account_name'] = sanitize_text_field( $_POST['account_name'] );
	$customers_meta['user_email'] = sanitize_text_field( $_POST['user_email'] );
	$customers_meta['customer_department'] = sanitize_text_field( $_POST['customer_department'] );
	$customers_meta['customer_mobile'] = sanitize_text_field( $_POST['customer_mobile'] );
	$customers_meta['customer_fax'] = sanitize_text_field( $_POST['customer_fax'] );
	$customers_meta['customer_site'] = sanitize_text_field( $_POST['customer_site'] );
	$customers_meta['customer_lead_source'] = sanitize_text_field( $_POST['customer_lead_source'] );
	$customers_meta['customer_lead_status'] = sanitize_text_field( $_POST['customer_lead_status'] );
	$customers_meta['customer_industry'] = sanitize_text_field( $_POST['customer_industry'] );
	$customers_meta['customer_agent'] = sanitize_text_field( $_POST['customer_agent'] );
	$customers_meta['date_of_birth'] = sanitize_text_field( $_POST['date_of_birth'] );
	$customers_meta['customer_assistant'] = sanitize_text_field( $_POST['customer_assistant'] );
	$customers_meta['customer_skype'] = sanitize_text_field( $_POST['customer_skype'] );
	$customers_meta['customer_twitter'] = sanitize_text_field( $_POST['customer_twitter'] );
	$customers_meta['customer_categories'] = sanitize_text_field( $_POST['customer_categories'] );
	$customers_meta['customer_brands'] = sanitize_text_field( $_POST['customer_brands'] );
	$customers_meta['billing_first_name'] = sanitize_text_field( $_POST['billing_first_name'] );
	$customers_meta['billing_last_name'] = sanitize_text_field( $_POST['billing_last_name'] );
	$customers_meta['billing_company'] = sanitize_text_field( $_POST['billing_company'] );
	$customers_meta['billing_address_1'] = sanitize_text_field( $_POST['billing_address_1'] );
	$customers_meta['billing_address_2'] = sanitize_text_field( $_POST['billing_address_2'] );
	$customers_meta['billing_city'] = sanitize_text_field( $_POST['billing_city'] );
	$customers_meta['billing_postcode'] = sanitize_text_field( $_POST['billing_postcode'] );
	$customers_meta['billing_country'] = sanitize_text_field( $_POST['billing_country'] );
	$customers_meta['billing_state'] = sanitize_text_field( $_POST['billing_state'] );
	$customers_meta['billing_email'] = sanitize_text_field( $_POST['billing_email'] );
	$customers_meta['billing_phone'] = sanitize_text_field( $_POST['billing_phone'] );
	$customers_meta['shipping_first_name'] = sanitize_text_field( $_POST['shipping_first_name'] );
	$customers_meta['shipping_last_name'] = sanitize_text_field( $_POST['shipping_last_name'] );
	$customers_meta['shipping_company'] = sanitize_text_field( $_POST['shipping_company'] );
	$customers_meta['shipping_address_1'] = sanitize_text_field( $_POST['shipping_address_1'] );
	$customers_meta['shipping_address_2'] = sanitize_text_field( $_POST['shipping_address_2'] );
	$customers_meta['shipping_city'] = sanitize_text_field( $_POST['shipping_city'] );
	$customers_meta['shipping_postcode'] = sanitize_text_field( $_POST['shipping_postcode'] );
	$customers_meta['shipping_country'] = sanitize_text_field( $_POST['shipping_country'] );
	$customers_meta['shipping_state'] = sanitize_text_field( $_POST['shipping_state'] );

	foreach ( $customers_meta as $key => $value ) :
		if ( get_post_meta( $post_id, $key, false ) ) {
			update_post_meta( $post_id, $key, $value );
		} else {
			add_post_meta( $post_id, $key, $value);
		}
		if ( ! $value ) {
			delete_post_meta( $post_id, $key );
		}
	endforeach;

}
add_action( 'save_post', 'woocrm_customer_meta_save' );
