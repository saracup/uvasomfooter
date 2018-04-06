<?php
add_filter('genesis_theme_settings_defaults', 'uvasom_footer_settings_defaults');
 
/**
 * Register Defaults
 *
 * @param array $defaults
 * @return array modified defaults
 *
 */
 
function uvasom_footer_settings_defaults( $defaults ) {
	$defaults[] = array(
				'uvasom_footer_office_location' => '',
				'uvasom_footer_office_email' => '',
				'uvasom_footer_office_phone' => '',
				'uvasom_footer_office_fax' => ''
				);
	return $defaults;
}
add_action( 'genesis_settings_sanitizer_init', 'uvasom_footer_sanitization_filters' );
 
/**
 * Sanitization
 *
 */
function uvasom_footer_sanitization_filters() {
	genesis_add_option_filter( 'no_html', GENESIS_SETTINGS_FIELD, array('uvasom_footer_office_location') );
	genesis_add_option_filter( 'no_html', GENESIS_SETTINGS_FIELD, array('uvasom_footer_office_email') );
	genesis_add_option_filter( 'no_html', GENESIS_SETTINGS_FIELD, array('uvasom_footer_office_phone') );
	genesis_add_option_filter( 'no_html', GENESIS_SETTINGS_FIELD, array('uvasom_footer_office_fax') );
}
add_action('genesis_theme_settings_metaboxes', 'uvasom_register_footer_settings_meta_box');
 
/**
 * Register Metabox
 *
 */
function uvasom_register_footer_settings_meta_box() {
	global $_genesis_theme_settings_pagehook;
	add_meta_box('uvasom-footer-settings', 'UVA SOM Footer Contact Information', 'uvasom_footer_settings_meta_box', $_genesis_theme_settings_pagehook, 'main', 'high');
}
 
/**
 * Create Metabox
 *
 */
function uvasom_footer_settings_meta_box() {
	
?>
    <p><strong>Site Contact Information:</strong><br />
    <em>The following information will display in the footer of your site.</em><br />
    Building/Room Number.PO Box <em>(e.g.: McKim Hall, Room 3127, PO Box 21149)</em>: <br /><input id="uvasomaddress" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[uvasom_footer_office_location]" value="<?php echo genesis_get_option('uvasom_footer_office_location') ?>"><br />
	Full Email Address: <br /><input id="uvasomemail" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[uvasom_footer_office_email]" value="<?php echo genesis_get_option('uvasom_footer_office_email') ?>"><br />
    Office Telephone: <br /><input id="uvasomtelephone" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[uvasom_footer_office_phone]" value="<?php echo genesis_get_option('uvasom_footer_office_phone') ?>"><br />
    Office Fax (if applicable): <br /><input id="uvasomfax" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[uvasom_footer_office_fax]" value="<?php echo genesis_get_option('uvasom_footer_office_fax') ?>">		
	</p>
 
	
<?php
}
?>