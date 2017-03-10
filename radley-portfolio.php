<?php
/*
Plugin Name: Web Developer Portfolio by Radley
Version:     1.0.1
Plugin URI:  http://radleysustaire.com/
Description: Designed to display portfolio items for a web developer. Demonstrate your work with photos, categorize items, and embed your favorites using the shortcode [rad_featured_portfolio].
Author:      Radley Sustaire &lt;radleygh@gmail.com&gt;
Author URI:  http://radleysustaire.com/
License:     GPLv2
*/

if( !defined( 'ABSPATH' ) ) exit;

define( 'PBR_URL', untrailingslashit(plugin_dir_url( __FILE__ )) );
define( 'PBR_PATH', dirname(__FILE__) );
define( 'PBR_VERSION', '1.0.1' );

function pbr_init_plugin() {
	if ( !class_exists( 'acf' ) ) {
		add_action( 'admin_notices', 'pbr_acf_not_running' );
		return;
	}
	
	include_once( PBR_PATH . '/includes/options.php' );
	include_once( PBR_PATH . '/includes/enqueue.php' );
	include_once( PBR_PATH . '/includes/post-type.php' );
	
	// custom fields
	include_once( PBR_PATH . '/fields/project-features.php' );
	include_once( PBR_PATH . '/fields/project-information.php' );
	include_once( PBR_PATH . '/fields/testimonial-information.php' );
}
add_action( 'plugins_loaded', 'pbr_init_plugin' );

function pbr_acf_not_running() {
	?>
	<div class="error">
		<p><strong>Web Developer Portfolio: Error</strong></p>
		<p>The required plugin <strong>Advanced Custom Fields Pro</strong> is not running. Please activate this required plugin, or disable Expert City Authors.</p>
	</div>
	<?php
}

function pbr_activate_plugin() {
	include_once( PBR_PATH . '/includes/post-type.php' );
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'pbr_activate_plugin' );

function pbr_deactivate_plugin() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pbr_deactivate_plugin' );
