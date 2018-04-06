<?php
/*
Plugin Name: UVA Health/School of Medicine Footer Text for Genesis Framework
Plugin URI: http://webmaster.imedicine.virginia.edu
Description: A top navigation bar that loads for WordPress sites based on the Genesis Framework.
Version: 0.1
Author: Cathy Finn-Derecki
Author URI: http://transparentuniversity.com
Copyright 2012  Cathy Finn-Derecki  (email : cad3r@virginia.edu)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
require_once( trailingslashit( get_template_directory() ) . 'lib/classes/class-genesis-admin.php');
require_once( trailingslashit( get_template_directory() ) . 'lib/classes/class-genesis-admin-boxes.php');
include_once(WP_PLUGIN_DIR.'/uvasomfooter/uvasomfooter_settings_page.php');
/******allow for jquery validation of form****/
function jquery_validate() {
    wp_enqueue_script( 'jquery_validate', plugins_url('/jquery.maskedinput.min.js', __FILE__),null,null,true );
    wp_enqueue_script( 'jquery_phone', plugins_url('/uvasom_phonevalidate.js', __FILE__) ,null,null,true);
}
add_action( 'admin_enqueue_scripts', 'jquery_validate' );

/***load the plugin stylesheet**/
function uvasomfooterstyles()
{
	?>
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
<!--[if IE]>
<style type="text/css">
</style>
<![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/uvasomfooter/uvasomfooter.css"  />
<?php
}
add_action( 'wp_head', 'uvasomfooterstyles',15 );
/** Customize the entire footer */
//add_filter('genesis_footer_output', 'uvasom_footer_output_filter', 10, 3);
add_filter('genesis_footer_creds_text', 'uvasom_footer_creds_text');
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action ('genesis_footer_output','genesis_footer_backtotop_text');
add_action( 'genesis_footer', 'uvasom_footer' );
function uvasom_footer() {
	?><div id="uvasomfooterleft">
<?php
/*********determine if this is a clinical themed site***********/
$uvasomsitetype = get_stylesheet();
if (($uvasomsitetype=='uvasom_clinical')||($uvasomsitetype=='uvasom_parallax')) { ?>
<h3><a href="http://uvahealth.com">UVA Health System</a> | <a href="http://medicine.virginia.edu">University of Virginia School of Medicine</a></h3>
    <div class="social-footer">
		<a class="rss" title="RSS" href="http://www.medicine.virginia.edu/administration/office-of-the-dean/school-news/rss-of-news-stories/"><span class="visuallyhidden">RSS</span></a>
        <a class="facebook" title="facebook" href="https://www.facebook.com/Medicine.Virginia"><span class="visuallyhidden">Facebook</span></a>
        <a class="youtube" title="youtube" href="https://www.youtube.com/user/MedicineVirginia/featured"><span class="visuallyhidden">YouTube</span></a>
<?php
        if (genesis_get_option('office_email','UVASOMFOOTER_SETTINGS_FIELD') !=""){ ?>
        <a class="email" title="email" href="mailto:<?php echo genesis_get_option('office_email','UVASOMFOOTER_SETTINGS_FIELD'); ?>"><span class="visuallyhidden">Email</span></a>
<?php } ?>
        <!--<a class="location" title="location" href="http://uvahealth.com/directions-locations"><span class="visuallyhidden">Location</span></a>
        <a class="phone" title="phone" href="http://uvahealth.com/patients-visitors-guide/important-phone-numbers"><span class="visuallyhidden">Phone</span></a>-->
	</div>
<?php } ?>
    <h4><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h4>
 	<p><a href="http://medicine.virginia.edu">University of Virginia School of Medicine</a><br />
<?php
	if (genesis_get_option('office_location','UVASOMFOOTER_SETTINGS_FIELD') !=""){
	echo genesis_get_option('office_location','UVASOMFOOTER_SETTINGS_FIELD') . '<br />';}
?>
	Charlottesville, Virginia 22908<br />
<?php
	if (genesis_get_option('office_phone','UVASOMFOOTER_SETTINGS_FIELD') !=""){
	echo 'Telephone: '.genesis_get_option('office_phone','UVASOMFOOTER_SETTINGS_FIELD') . '<br />';}
	if (genesis_get_option('office_fax','UVASOMFOOTER_SETTINGS_FIELD') !=""){
	echo 'Fax: '.genesis_get_option('office_fax','UVASOMFOOTER_SETTINGS_FIELD') . '<br />';}
	if (genesis_get_option('office_email','UVASOMFOOTER_SETTINGS_FIELD') !=""){
?>
	<a href="mailto:<?php echo genesis_get_option('office_email','UVASOMFOOTER_SETTINGS_FIELD'); ?>"><?php echo genesis_get_option('office_email','UVASOMFOOTER_SETTINGS_FIELD'); ?></a>
<?php } ?>
	</p>
    </div>
<?php
}
function uvasom_footer_creds_text() {
?>
<div id="uvasomfooterright">
    <p><em>Copyright &copy; <?php echo date('Y');?>  <a href="http://virginia.edu/bov">Rector and Board of Visitors</a></em><br/>
    <em><a href="http://www.virginia.edu/copyright.html">Copyright/Privacy</a></em>
    </p>
        <p>
    <?php if ( is_user_logged_in() ) { ?>
    <em><a href="<?php echo wp_logout_url(); ?>" title="Login">Logout</a></em>
    <?php }
	if ( !is_user_logged_in() ) { ?>
    <em><a href="<?php echo wp_login_url(); ?>" title="Login">Login</a></em>
    <?php } ?>
    </p>

    </div>
    <?php
}
?>
