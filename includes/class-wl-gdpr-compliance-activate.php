<?php
/**
* @package WL_GDPR_Compliance
*/

if( ! defined( 'ABSPATH' ) ) {
    die;
}

class WL_GDPR_Compliance_Activate
{
    public static function activate(){
        flush_rewrite_rules();
    }
}