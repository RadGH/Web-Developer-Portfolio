<?php

if( !defined( 'ABSPATH' ) ) exit;

function pbr_enqueue_admin_scripts() {
	wp_enqueue_style( 'pbr-admin', PBR_URL . '/assets/pbr-admin.css', array(), PBR_VERSION );
}
add_action( 'admin_enqueue_scripts', 'pbr_enqueue_admin_scripts' );