<?php

/**
 *
 * This file registers all of this plugin's 
 * specific Theme Settings, accessible from
 * Genesis > Site Contact Info.
 *
 * @package      WPS_Starter_Genesis_Child
 * @author       Travis Smith <travis@wpsmith.net>
 * @copyright    Copyright (c) 2012, Travis Smith
 * @license      <a href="http://opensource.org/licenses/gpl-2.0.php" onclick="javascript:_gaq.push(['_trackEvent','outbound-article','http://opensource.org']);" rel="nofollow">http://opensource.org/licenses/gpl-2.0.php</a> GNU Public License
 * @since        1.0
 * @alter        1.1.2012
 *
 */
 
 
/**
 * Registers a new admin page, providing content and corresponding menu item
 * for the Child Theme Settings page.
 *
 * @package      WPS_Starter_Genesis_Child
 * @subpackage   Admin
 *
 * @since 1.0.0
 */
class UVASOMFOOTER_Settings extends Genesis_Admin_Boxes {
	/**
	 * Create an admin menu item and settings page.
	 * 
	 * @since 1.0.0
	 */
	function __construct() {
		
		// Specify a unique page ID. 
		$page_id = 'uvasomfooter';
		
		// Set it as a child to genesis, and define the menu and page titles
		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => 'Site Contact Info',
				'menu_title'  => 'Site Contact Info',
				'capability' => 'manage_options',
			)
		);
		
		// Set up page options. These are optional, so only uncomment if you want to change the defaults
		$page_ops = array(
		//	'screen_icon'       => array( 'custom' => WPS_ADMIN_IMAGES . '/staff_32x32.png' ),
			'screen_icon'       => 'options-general',
		//	'save_button_text'  => 'Save Settings',
		//	'reset_button_text' => 'Reset Settings',
		//	'save_notice_text'  => 'Settings saved.',
		//	'reset_notice_text' => 'Settings reset.',
		);		
		
		// Give it a unique settings field. 
		// You'll access them from genesis_get_option( 'option_name', CHILD_SETTINGS_FIELD );
		$settings_field = 'UVASOMFOOTER_SETTINGS_FIELD';
		
		// Set the default values
		$default_settings = array(
			'office_location' => '',
				'office_email' => '',
				'office_phone' => '',
				'office_fax' => ''
		);
		
		// Create the Admin Page
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );

		// Initialize the Sanitization Filter
		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitization_filters' ) );
	}
	/** 
	 * Set up Sanitization Filters
	 *
	 * See /lib/classes/sanitization.php for all available filters.
	 *
	 * @since 1.0.0
	 */	
	function sanitization_filters() {
		genesis_add_option_filter( 'no_html', $this->settings_field, array(
			'office_location',
				'office_email',
				'office_phone',
				'office_fax'
		) );
	}
	
	/**
	 * Register metaboxes on Child Theme Settings page
	 *
	 * @since 1.0.0
	 *
	 * @see Child_Theme_Settings::contact_information() Callback for contact information
	 */
	function metaboxes() {
		
		add_meta_box('footer-settings', 'Site Contact Settings', array( $this, 'footer_meta_box' ), $this->pagehook, 'main', 'high');
		
	}
	
	/**
	 * Register contextual help on Child Theme Settings page
	 *
	 * @since 1.0.0
	 *
	 */
	function help( ) {	
		global $my_admin_page;
		$screen = get_current_screen();
		
		if ( $screen->id != $this->pagehook )
			return;
		
		$tab1_help = 
			'<h3>' . __( 'Office Location' , 'uvasomfooter' ) . '</h3>' .
			'<p>' . __( 'This should be the building and room and/or or the mailing address where the web site contact is located.' , 'uvasomfooter' ) . '</p>';
		
		$tab2_help = 
			'<h3>' . __( 'Full Email Address' , 'uvasomfooter' ) . '</h3>' .
			'<p>' . __( 'Email address of the site manager OR the person who is designated as the contact for this department.' , 'uvasomfooter' ) . '</p>';
		
		$tab3_help = 
			'<h3>' . __( 'Office Telephone/Fax' , 'uvasomfooter' ) . '</h3>' .
			'<p>' . __( 'The best phone numbers to call or fax regarding information included in this website.' , 'uvasomfooter' ) . '</p>' .
		
		$screen->add_help_tab( 
			array(
				'id'	=> $this->pagehook . '-location',
				'title'	=> __( 'Location' , 'uvasomfooter' ),
				'content'	=> $tab1_help,
			) );
		$screen->add_help_tab( 
			array(
				'id'	=> $this->pagehook . '-email',
				'title'	=> __( 'Email' , 'uvasomfooter' ),
				'content'	=> $tab2_help,
			) );
		$screen->add_help_tab( 
			array(
				'id'	=> $this->pagehook . '-phonefax',
				'title'	=> __( 'Phone and Fax' , 'uvasomfooter' ),
				'content'	=> $tab3_help,
			) );
		
		// Add Genesis Sidebar
		$screen->set_help_sidebar(
                '<p><strong>' . __( 'For more information:', 'uvasomfooter' ) . '</strong></p>'.
                '<p><a href="' . __( 'http://www.studiopress.com/support', 'uvasomfooter' ) . '" target="_blank" title="' . __( 'Support Forums', 'uvasomfooter' ) . '">' . __( 'Support Forums', 'uvasomfooter' ) . '</a></p>'.
                '<p><a href="' . __( 'http://www.studiopress.com/tutorials', 'uvasomfooter' ) . '" target="_blank" title="' . __( 'Genesis Tutorials', 'uvasomfooter' ) . '">' . __( 'Genesis Tutorials', 'uvasomfooter' ) . '</a></p>'.
                '<p><a href="' . __( 'http://dev.studiopress.com/', 'uvasomfooter' ) . '" target="_blank" title="' . __( 'Genesis Developer Docs', 'uvasomfooter' ) . '">' . __( 'Genesis Developer Docs', 'uvasomfooter' ) . '</a></p>'
        );
	}
	
	/**
	 * Callback for Contact Information metabox
	 *
	 * @since 1.0.0
	 *
	 * @see Child_Theme_Settings::metaboxes()
	 */
	function footer_meta_box() {
		
?>

    <p><strong>The following information will display in the footer of your site:</strong></p>
    <p>Building/Room Number.PO Box <em>(e.g.: McKim Hall, Room 3127, PO Box 21149)</em>:<br /><input name="<?php echo 'UVASOMFOOTER_SETTINGS_FIELD'; ?>[office_location]" value="<?php echo $this->get_field_value( 'office_location') ?>"></p>
	<p>Full Email Address: <br /><input id="uvasomemail"  name="<?php echo 'UVASOMFOOTER_SETTINGS_FIELD'; ?>[office_email]" value="<?php echo $this->get_field_value( 'office_email') ?>"></p>
    <p>Office Telephone: <br /><input id="uvasomtelephone" name="<?php echo 'UVASOMFOOTER_SETTINGS_FIELD'; ?>[office_phone]" value="<?php echo $this->get_field_value( 'office_phone') ?>"></p>
    <p>Office Fax (if applicable): <br /><input id="uvasomfax" name="<?php echo 'UVASOMFOOTER_SETTINGS_FIELD'; ?>[office_fax]" value="<?php echo $this->get_field_value( 'office_fax') ?>">		
	</p>
<?php
	}
}
add_action( 'genesis_admin_menu', 'uvasomfooter_settings_menu' );
/**
 * Instantiate the class to create the menu.
 *
 * @since 1.8.0
 */
function uvasomfooter_settings_menu() {

	new UVASOMFOOTER_Settings;

}