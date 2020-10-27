<?php
/**
* @package WL_GDPR_Compliance
*/

if( ! defined( 'ABSPATH' ) ) {
    die;
}

if ( ! class_exists( 'WL_GDPR_Compliance' ) ) {

    class WL_GDPR_Compliance 
    {     
        protected $loader;

        public function run() {
            $this->load_admin();
            $this->load_public();
        }

        public function load_admin() {
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wl-gdpr-compliance-admin.php';
            $wl_gdpr_compliance_admin = new WL_GDPR_Compliance_Admin();
        }

        public function load_public() {
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wl-gdpr-compliance-public.php';
            $wl_gdpr_compliance_public = new WL_GDPR_Compliance_Public();
        }

    }
}