<?php
/**
* @package WL_GDPR_Compliance
*/

if( ! defined( 'ABSPATH' ) ) {
    die;
}

class WL_GDPR_Compliance_Admin 
{     
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'settings_link' ) );
        add_action( 'admin_init', array( $this, 'register_options' ) );
    }

    public function add_admin_pages() {
        add_menu_page( 
        'GDPR Compliance', 
        'GDPR Compliance', 
        'activate_plugins', 
        'wl-gdpr-compliance', 
        array( $this, 'admin_index' ), 
        'dashicons-superhero', 
        110 );
    }

    public function admin_index() {
        if ( ! current_user_can( 'activate_plugins' ) ) {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        require_once plugin_dir_path( __DIR__ ) . 'admin/templates/wl-gdpr-compliance-admin-template.php';
    }

    public function settings_link( $links ) {
        $settings_link = '<a href="admin.php?page=wl-gdpr-compliance">Settings</a>';
        array_push( $links, $settings_link );
        return $links;
    }

    public function register_options( ) {
        register_setting( 
        'wl-gdpr-compliance-options', 
        'wl_box_enable'  
        );
        
        register_setting( 
        'wl-gdpr-compliance-options', 
        'wl_box_position' 
        );

        register_setting( 
        'wl-gdpr-compliance-options', 
        'wl_color_theme' 
        );

        register_setting( 
        'wl-gdpr-compliance-options', 
        'wl_box_message_text' 
        );

        register_setting( 
        'wl-gdpr-compliance-options', 
        'wl_box_btn_label' 
        );
    }
       
}