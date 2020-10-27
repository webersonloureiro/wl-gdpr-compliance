<?php
/**
* @package WL_GDPR_Compliance
*/

if( ! defined( 'ABSPATH' ) ) {
    die;
}

$wl_box_message_text = get_option( 'wl_box_message_text' ); 
$wl_box_btn_label = esc_attr( get_option( 'wl_box_btn_label' ) );

$wl_box_position = esc_attr( get_option( 'wl_box_position' ) );
$wl_color_theme = strtolower ( esc_attr( get_option( 'wl_color_theme' ) ) );

if( isset ( $_POST['submit'] ) ){
    $wl_gdpr_compliance_public = new WL_GDPR_Compliance_Public;
    $save_cookie = $wl_gdpr_compliance_public->save_cookie();
    die;
}
?>

<div id="wl_gdpr_compliance_bar" class="wl-gdpr-compliance-bar wl-position-<?php echo $wl_box_position; ?> wl-color-<?php echo $wl_color_theme; ?> wl-border-<?php echo $wl_box_position; ?>-<?php echo $wl_color_theme; ?>">
    <div class="wl-gdpr-compliance-bar__container">
        <p class="wl-gdpr-compliance-bar__container__content">
            <?php echo $wl_box_message_text; ?>
        </p>
        <form id="wl_gdpr_compliance_submit" action="" method="POST">
            <input type="submit" name="submit" class="wl-gdpr-compliance-bar__container__button" value="<?php echo $wl_box_btn_label; ?>" />
        </form>
    </div>
</div>