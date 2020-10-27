<?php
/**
* @package WL_GDPR_Compliance
*/

if( ! defined( 'ABSPATH' ) ) {
    die;
}

class WL_GDPR_Compliance_Deactivate
{
    public static function deactivate(){
        flush_rewrite_rules();
    }
}