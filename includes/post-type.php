<?php

if( !defined( 'ABSPATH' ) ) exit;

function wdp_register_portfolio_project_post_type() {
	$labels = array(
		'name'                  => 'Projects',
		'singular_name'         => 'Project',
		'menu_name'             => 'Projects',
		'name_admin_bar'        => 'Projects',
		'archives'              => 'Project Archives',
		'attributes'            => 'Project Attributes',
		'parent_item_colon'     => 'Parent Project:',
		'all_items'             => 'All Projects',
		'add_new_item'          => 'Add New Project',
		'add_new'               => 'Add New',
		'new_item'              => 'New Project',
		'edit_item'             => 'Edit Project',
		'update_item'           => 'Update Project',
		'view_item'             => 'View Project',
		'view_items'            => 'View Projects',
		'search_items'          => 'Search Project',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into project',
		'uploaded_to_this_item' => 'Uploaded to this project',
		'items_list'            => 'Projects list',
		'items_list_navigation' => 'Projects list navigation',
		'filter_items_list'     => 'Filter projects list',
	);
	
	$args = array(
		'label'                 => 'Project',
		'description'           => 'Displays projects for your web development portfolio',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'revisions', ),
		'taxonomies'            => array( 'project_cat', ' project_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-id-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	
	register_post_type( 'project', $args );
		
	$labels = array(
		'name'                       => 'Project Categories',
		'singular_name'              => 'Project Category',
		'menu_name'                  => 'Project Categories',
		'all_items'                  => 'All Project Categories',
		'parent_item'                => 'Parent Project Category',
		'parent_item_colon'          => 'Parent Project Category:',
		'new_item_name'              => 'New Project Category Name',
		'add_new_item'               => 'Add New Project Category',
		'edit_item'                  => 'Edit Project Category',
		'update_item'                => 'Update Project Category',
		'view_item'                  => 'View Project Category',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Project Categories',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No items',
		'items_list'                 => 'Items list',
		'items_list_navigation'      => 'Items list navigation',
	);
	
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	
	register_taxonomy( 'project_cat', array( 'project' ), $args );
		
	$labels = array(
		'name'                       => 'Project Tags',
		'singular_name'              => 'Project Tag',
		'menu_name'                  => 'Project Tags',
		'all_items'                  => 'All Project Tags',
		'parent_item'                => 'Parent Project Tag',
		'parent_item_colon'          => 'Parent Project Tag:',
		'new_item_name'              => 'New Project Tag Name',
		'add_new_item'               => 'Add New Project Tag',
		'edit_item'                  => 'Edit Project Tag',
		'update_item'                => 'Update Project Tag',
		'view_item'                  => 'View Project Tag',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Project Tags',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No items',
		'items_list'                 => 'Items list',
		'items_list_navigation'      => 'Items list navigation',
	);
	
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	
	register_taxonomy( 'project_tag', array( 'project' ), $args );
}
add_action( 'init', 'wdp_register_portfolio_project_post_type', 0 );

function wdp_custom_columns( $columns ) {
	// Add custom column "project_image"
	return array_merge(
		array_splice( $columns, 0, 2 ),
		array( 'project_featured' => 'Featured' ),
		array( 'project_image' => 'Project Image' ),
		$columns
	);
}
add_action( "manage_edit-project_columns", 'wdp_custom_columns' );

function wdp_display_columns( $column, $post_id ) {
	// Redefine our columns, preserving some default fields
	switch( $column ) {
		case 'project_featured':
			$featured = get_field( 'featured', $post_id );
			
			if ( $featured ) {
				$link = add_query_arg( array( 'wdp_action' => 'remove-featured', 'wdp_id' => $post_id) );
				$text = '<span class="dashicons dashicons-star-filled"><span class="screen-reader-text">Remove featured status</span></span>';
			}else{
				$link = add_query_arg( array( 'wdp_action' => 'mark-featured', 'wdp_id' => $post_id) );
				$text = '<span class="dashicons dashicons-star-empty"><span class="screen-reader-text">Add featured status</span></span>';
				
			}
			
			echo '<a href="'. esc_attr($link) .'">'. $text .'</a>';
			break;
			
		case 'project_image':
			$image = get_field( 'screenshot_desktop', $post_id );
			if ( !$image ) {
				echo '<em>No image</em>';
				return;
			}
			
			$thumbnail = isset($image['sizes']['thumbnail']) ? $image['sizes']['thumbnail'] : $image['url'];
			echo '<a href="'. get_edit_post_link($post_id) .'"><img src="'. $thumbnail .'"></a>';
			break;
	};
}
add_action( "manage_project_posts_custom_column", 'wdp_display_columns', 10, 2 );

function wdp_sort_columns( $columns ) {
	$columns['project_featured'] = 'featured';
	$columns['project_image'] = 'screenshot_desktop';
	return $columns;
}
add_action( "manage_edit-project_sortable_columns", 'wdp_sort_columns' );

function wdp_toggle_featured_project_status() {
	if ( isset($_REQUEST['wdp_action']) ) {
		$feature = null;
		if ( $_REQUEST['wdp_action'] == 'remove-featured' ) $feature = false;
		if ( $_REQUEST['wdp_action'] == 'mark-featured' ) $feature = true;
		if ( $feature === null ) return;
		
		$post_id = isset($_REQUEST['wdp_id']) ? (int) $_REQUEST['wdp_id'] : false;
		if ( !$post_id || get_post_type($post_id) != 'project' ) return;
		
		update_field( 'featured', $feature, $post_id );
		wp_redirect( remove_query_arg( array( 'wdp_action', 'wdp_id' ) ) );
		exit;
	}
}
add_action( 'admin_init', 'wdp_toggle_featured_project_status' );