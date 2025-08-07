<?php
/**
 * Post Type
 */

function woocrm_customers_post_type() {
	$labels = array(
		'name'               => __( 'Customers' ),
		'singular_name'      => __( 'Customer' ),
		'add_new'            => __( 'Add New Customer' ),
		'add_new_item'       => __( 'Add New Customer' ),
		'edit_item'          => __( 'Edit Customer' ),
		'new_item'           => __( 'Add New Customer' ),
		'view_item'          => __( 'View Customer' ),
		'search_items'       => __( 'Search Customer' ),
		'not_found'          => __( 'No customers found' ),
		'not_found_in_trash' => __( 'No customers found in trash' )
	);
	$supports = array(
		'title',
	);
	$args = array(
		'labels'               => $labels,
		'supports'             => $supports,
		'public'               => true,
		'capability_type'      => 'post',
		'rewrite'              => array( 'slug' => 'customers' ),
		'has_archive'          => true,
		'menu_position'        => 30,
		'show_in_menu'         => 'woo_crm_index',
		'menu_icon'            => 'dashicons-calendar-alt',
		'register_meta_box_cb' => 'woocrm_customer_metaboxes',
	);
	register_post_type( 'customers', $args );
}
add_action( 'init', 'woocrm_customers_post_type' );


function woocrm_customers_remove_post_type_support() {
    remove_post_type_support( 'customers', 'title' );
}
add_action( 'init', 'woocrm_customers_remove_post_type_support' );

// Add the custom columns to the book post type:
add_filter( 'manage_customers_posts_columns', 'woocrm_set_edit_customers_columns' );

function woocrm_set_edit_customers_columns($columns) {
    unset( $columns['title'] );
    unset( $columns['date'] );
    $columns['customer_name'] = __( 'Name', 'wc_crm' );
    $columns['user_email'] = __( 'Email Address', 'wc_crm' );
	$columns['customer_mobile'] = __( 'Mobile', 'wc_crm' );
	$columns['customer_status'] = __( 'Status', 'wc_crm' );
    $columns['date'] = __( 'Date', 'wc_crm' );

    return $columns;
}


// Add the data to the custom columns for the book post type:
add_action( 'manage_customers_posts_custom_column' , 'woocrm_customers_column', 10, 2 );

function woocrm_customers_column( $column, $post_id ) {
    switch ( $column ) {
        case 'customer_name' :
			$first_name = get_post_meta( $post_id , 'first_name' , true );
			$last_name = get_post_meta( $post_id , 'last_name' , true );
			$email = get_post_meta( $post_id , 'user_email' , true );

			echo get_avatar( $email, 50 ) . '<a class="row-title" href="post.php?post=' . $post_id . '&action=edit">' . $first_name . ' ' . $last_name . '</a>';
            break;
		
		case 'customer_status' :
			$customer_status = get_post_meta( $post_id , 'customer_status' , true );

			if ($customer_status == 'Customer') {
				$status = 'Customer';
			} else if ($customer_status == 'Lead') {
				$status = 'Lead';
			} else if ($customer_status == 'Follow-up') {
				$status = 'Follow-Up';
			} else if ($customer_status == 'Prospect') {
				$status = 'Prospect';
			} else if ($customer_status == 'Favourite') {
				$status = 'Favourite';
			} else if ($customer_status == 'Blocked') {
				$status = 'Blocked';
			} else if ($customer_status == 'Flagged') {
				$status = 'Flagged';
			}

			echo '<span class="' . $status . '">' . $customer_status . '</span>';
            break;
		
		case 'user_email' :
			echo get_post_meta( $post_id , 'user_email' , true );
            break;
		
		case 'customer_mobile' :
			echo get_post_meta( $post_id , 'customer_mobile' , true );
            break;
    }
}