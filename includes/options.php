<?php

if( !defined( 'ABSPATH' ) ) exit;

function wdp_register_settings_menu() {
	acf_add_options_sub_page(array(
		'parent_slug' => 'options-general.php',
		'page_title'  => 'Web Developer Portfolio &ndash; Settings',
		'menu_title'  => 'Web Developer Portfolio',
		'autoload'    => false,
	));
}
add_action( 'admin_menu', 'wdp_register_settings_menu' );