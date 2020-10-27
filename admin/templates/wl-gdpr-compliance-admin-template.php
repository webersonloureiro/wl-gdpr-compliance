<?php
/**
* @package WL_GDPR_Compliance
*/

if( ! defined( 'ABSPATH' ) ) {
    die;
}
?>

<div class="wrap">
<h1>GDPR Compliance</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'wl-gdpr-compliance-options' ); ?>
    <?php do_settings_sections( 'wl-gdpr-compliance-options' ); ?>

    <table class="form-table">
        <h2>General Settings</h2>
        <tr valign="top">
            <th scope="row">Enable cookie bar</th>
            <td>
                <?php $wl_box_enable = esc_attr( get_option( 'wl_box_enable' ) ); ?>

                <input type="radio" id="enable" name="wl_box_enable" value="enable" <?php echo $wl_box_enable == 'enable' ? 'checked="checked"' : ''; ?>>
                <label for="enable">Enable</label><br>

                <input type="radio" id="disable" name="wl_box_enable" value="disable" <?php echo $wl_box_enable == 'disable' ? 'checked="checked"' : ''; ?>>
                <label for="disable">Disable</label><br>
            </td>
        </tr>
    </table>

    <table class="form-table">
        <h2>Cookie Bar</h2>

        <tr valign="top">
            <th scope="row">Position</th>
            <td>
                <?php $wl_box_position = esc_attr( get_option( 'wl_box_position' ) ); ?>

                <input type="radio" id="top" name="wl_box_position" value="top" <?php echo $wl_box_position == 'top' ? 'checked="checked"' : ''; ?>>
                <label for="top">Top</label><br>

                <input type="radio" id="bottom" name="wl_box_position" value="bottom" <?php echo $wl_box_position == 'bottom' ? 'checked="checked"' : ''; ?>>
                <label for="bottom">Bottom</label><br>
            </td>
        </tr>
        
        <tr valign="top">
            <th scope="row">Color theme</th>
            <td>
                <?php $wl_color_theme = esc_attr( get_option( 'wl_color_theme' ) ); ?>

                <select id="wl_color_theme" name="wl_color_theme">
                <option value="Ocean" <?php echo !$wl_color_theme || $wl_color_theme == 'Ocean' ? 'selected' : ''; ?>>Ocean</option> 

                <option value="Light" <?php echo $wl_color_theme == 'Light' ? 'selected' : ''; ?>>Light</option>
                <option value="Forest" <?php echo $wl_color_theme == 'Forest' ? 'selected' : ''; ?>>Forest</option>
                </select>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Message</th>
            <td>
                <?php 
                $privacy_policy_page = get_option( 'wp_page_for_privacy_policy' );
                
                if( $privacy_policy_page ) {
                    $privacy_policy_permalink = esc_url( get_permalink( $privacy_policy_page ) );
                }

                $wl_box_message_text = get_option( 'wl_box_message_text' ); 
                if( ! $wl_box_message_text ){
                    $wl_box_message_text = 'We use cookies to provide our services and for analytics and marketing. To find out more about our use of cookies, please see our <a href="'.$privacy_policy_permalink.'" target="_blank">Privacy Policy</a>. By continuing to browse our website, you agree to our use of cookies.';
                }
                ?>

                <?php
                wp_editor( $wl_box_message_text , 'wl_box_message_text', array(
                    'wpautop'       => true,
                    'media_buttons' => false,
                    'quicktags' => true,
                    'tinymce' => true,
                    'textarea_name' => 'wl_box_message_text',
                    'editor_class'  => 'wl_box_message_text',
                    'textarea_rows' => 10
                ) );
                ?>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Button label</th>
            <td>
                <?php $wl_box_btn_label = esc_attr( get_option( 'wl_box_btn_label' ) ); ?>

                <input type="text" id="wl_box_btn_label" name="wl_box_btn_label" value="<?php echo $wl_box_btn_label ? $wl_box_btn_label : 'Accept'; ?>" />
            </td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>

</div>