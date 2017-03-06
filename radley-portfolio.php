<?php
/*
Plugin Name: Web Developer Portfolio
Version:     1.0.0b
Plugin URI:  http://radleysustaire.com/
Description: Designed to display portfolio items for a web developer. Demonstrate your work with photos, categorize items, and embed your favorites using the shortcode [rad_featured_portfolio].
Author:      Radley Sustaire &lt;radleygh@gmail.com&gt;
Author URI:  mailto:radleygh@gmail.com
License:     GPLv2
*/

if( !defined( 'ABSPATH' ) ) exit;

define( 'WDP_URL', untrailingslashit(plugin_dir_url( __FILE__ )) );
define( 'WDP_PATH', dirname(__FILE__) );
define( 'WDP_VERSION', '1.0.0b' );

function wdp_init_plugin() {
	if ( !class_exists( 'acf' ) ) {
		add_action( 'admin_notices', 'wdp_acf_not_running' );
		return;
	}
	
	include_once( WDP_PATH . '/includes/options.php' );
	include_once( WDP_PATH . '/includes/enqueue.php' );
	include_once( WDP_PATH . '/includes/post-type.php' );
	
	// custom fields
	include_once( WDP_PATH . '/fields/project-features.php' );
	include_once( WDP_PATH . '/fields/project-information.php' );
}
add_action( 'plugins_loaded', 'wdp_init_plugin' );

function wdp_acf_not_running() {
	?>
	<div class="error">
		<p><strong>Web Developer Portfolio: Error</strong></p>
		<p>The required plugin <strong>Advanced Custom Fields Pro</strong> is not running. Please activate this required plugin, or disable Expert City Authors.</p>
	</div>
	<?php
}

function wdp_activate_plugin() {
	include_once( WDP_PATH . '/includes/post-type.php' );
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'wdp_activate_plugin' );

function wdp_deactivate_plugin() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'wdp_deactivate_plugin' );
