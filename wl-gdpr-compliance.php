<?php 
/**
* @package WL_GDPR_Compliance
*/
/**
 * Plugin Name: WL GDPR Compliance
 * Plugin URI:  https://wordpress.org/
 * Description: WordPress Developer challenge
 * Version: 1.0.0
 * Author: Weberson Loureiro
 * Author URI: https://github.com/webersonloureiro
 * License: GPLv2 or later
 * Text Domain: wl-gdpr-compliance
 */

if( ! defined( 'ABSPATH' ) ) {
    die;
}

function wl_gdpr_compliance_activate() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-wl-gdpr-compliance-activate.php';
    WL_GDPR_Compliance_Activate::activate();
    register_uninstall_hook( __FILE__, 'wl_gdpr_compliance_delete' );
}

function wl_gdpr_compliance_deactivate() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-wl-gdpr-compliance-deactivate.php';
    WL_GDPR_Compliance_Deactivate::deactivate();
}

register_activation_hook( __FILE__, 'wl_gdpr_compliance_activate' );
register_deactivation_hook( __FILE__, 'wl_gdpr_compliance_deactivate' );

function wl_gdpr_compliance_delete() {
    delete_option( 'wl_box_enable' );
    delete_option( 'wl_box_position' );
    delete_option( 'wl_color_theme' );
    delete_option( 'wl_box_message_text' );
    delete_option( 'wl_box_btn_label' );

    $args = array('post_type' => 'wl_cookies');
    $posts = get_posts($args);    

    if ( ! $posts ) {
        return;
    } else {
        foreach ( $posts as $post ) {
            wp_delete_post( $post->ID, true );
        }
    }      
}

// main class
require plugin_dir_path( __FILE__ ) . 'includes/class-wl-gdpr-compliance.php';

//run everything!
function run_wl_gdpr_compliance() {
	$plugin = new WL_GDPR_Compliance();
	$plugin->run();
}

run_wl_gdpr_compliance();