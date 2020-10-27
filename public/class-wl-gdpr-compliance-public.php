<?php
/**
* @package WL_GDPR_Compliance
*/

if( ! defined( 'ABSPATH' ) ) {
    die;
}

class WL_GDPR_Compliance_Public 
{     
    public function __construct() {
        add_action( 'init', array( $this, 'custom_post_type' ) );

        $wl_box_enable = esc_attr( get_option( 'wl_box_enable' ) );
        $user_ip = $this->get_user_ip();
        
        $cookie_exists = $this->check_cookie_exists( $user_ip );

        if ( $wl_box_enable === 'enable' && $cookie_exists === 0 ) {
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
            add_action( 'wp_footer', array( $this, 'cookie_bar' ) );
        } 
    }

    public function enqueue() {
        wp_enqueue_style( 'wlstyle', plugin_dir_url( __FILE__ ) . '/assets/dist/wl-style.min.css', '', '1.0.0' );
        wp_enqueue_script( 'wlscript', plugin_dir_url( __FILE__ ) . '/assets/dist/wl-script.min.js', '', '1.0.0', true );
    }

    public function custom_post_type(){
        $args = array(
            'label'			        => 'Cookies',
            'public'				=> false,
            'publicly_queryable'	=> false,
            'exclude_from_search'	=> true,
            'show_ui'				=> true,
            'query_var'				=> true,
            'rewrite'				=> true,
            'capabilities' => array(
                'publish_posts' => 'manage_options',
                'edit_posts' => 'manage_options',
                'edit_others_posts' => 'manage_options',
                'delete_posts' => 'manage_options',
                'delete_others_posts' => 'manage_options',
                'read_private_posts' => 'manage_options',
                'edit_post' => 'manage_options',
                'delete_post' => 'manage_options',
                'read_post' => 'manage_options',
            ),
            /** done editing */
            'menu_icon'				=> 'dashicons-visibility',
            'hierarchical'			=> false,
            'menu_position'			=> null,
            'supports'				=> array('title', 'editor')
        );
        register_post_type( 'wl_cookies', $args );
    }

    public function cookie_bar(){
        require_once plugin_dir_path( __FILE__ ) . 'templates/wl-gdpr-compliance-bar.php';
    }

    public function get_user_ip(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function check_cookie_exists( $post_title ) {
        global $wpdb;
        $wpdb->query( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_status = 'publish' AND post_type = 'wl_cookies'", $post_title ) );
        return $wpdb->num_rows;
    }

    public function save_cookie(){
        $user_ip = $this->get_user_ip();
        if ( $user_ip ) {
            $my_post = array(
                'post_title'    => $user_ip,
                'post_content'  => 'Cookie accepted by user: ' . $user_ip,
                'post_status'   => 'publish',
                'post_author'   => 1,
                'post_type'     => 'wl_cookies'
            );
            wp_insert_post( $my_post );
        }
    }
}