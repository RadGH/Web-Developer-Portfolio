<?php

if( !defined( 'ABSPATH' ) ) exit;

function wdp_enqueue_admin_scripts() {
	wp_enqueue_style( 'wdp-admin', WDP_URL . '/assets/wdp-admin.css', array(), WDP_VERSION );
}
add_action( 'admin_enqueue_scripts', 'wdp_enqueue_admin_scripts' );