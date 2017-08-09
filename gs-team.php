<?php
/**
 * @package   GS_Team
 * @author    Golam Samdani <samdani1997@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.gsamdani.com
 * @copyright 2016 Golam Samdani
 *
 * @wordpress-plugin
 * Plugin Name:			GS Team Lite
 * Plugin URI:			http://www.gsamdani.com/wordpress-plugins
 * Description:       	Best Responsive Team member plugin for Wordpress to showcase member Image, Name, Designation, Social connectivity links. Display anywhere at your site using shortcode like [gs_team theme="gs_tm_theme1"] & widgets. Check more shortcode examples and documentation at <a href="http://www.team.gsamdani.com">GS Team PRO Demos & Docs</a>
 * Version:           	1.0.1
 * Author:       		Golam Samdani
 * Author URI:       	http://www.gsamdani.com
 * Text Domain:       	gsteam
 * License:           	GPL-2.0+
 * License URI:       	http://www.gnu.org/licenses/gpl-2.0.txt
 */

if( ! defined( 'GSTEAM_HACK_MSG' ) ) define( 'GSTEAM_HACK_MSG', __( 'Sorry cowboy! This is not your place', 'gsteam' ) );

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) die( GSTEAM_HACK_MSG );

/**
 * Defining constants
 */
if( ! defined( 'GSTEAM_VERSION' ) ) define( 'GSTEAM_VERSION', '1.0.0' );
if( ! defined( 'GSTEAM_MENU_POSITION' ) ) define( 'GSTEAM_MENU_POSITION', 39 );
if( ! defined( 'GSTEAM_PLUGIN_DIR' ) ) define( 'GSTEAM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
if( ! defined( 'GSTEAM_PLUGIN_URI' ) ) define( 'GSTEAM_PLUGIN_URI', plugins_url( '', __FILE__ ) );
if( ! defined( 'GSTEAM_FILES_DIR' ) ) define( 'GSTEAM_FILES_DIR', GSTEAM_PLUGIN_DIR . 'gsteam-files' );
if( ! defined( 'GSTEAM_FILES_URI' ) ) define( 'GSTEAM_FILES_URI', GSTEAM_PLUGIN_URI . '/gsteam-files' );

require_once GSTEAM_FILES_DIR . '/includes/gs-team-cpt.php';
require_once GSTEAM_FILES_DIR . '/includes/gs-team-meta-fields.php';
require_once GSTEAM_FILES_DIR . '/includes/gs-team-column.php';
require_once GSTEAM_FILES_DIR . '/includes/gs-team-shortcode.php';
require_once GSTEAM_FILES_DIR . '/gs-teams-scripts.php';
require_once GSTEAM_FILES_DIR . '/admin/class.settings-api.php';
require_once GSTEAM_FILES_DIR . '/admin/gs_team_options_config.php';
require_once GSTEAM_FILES_DIR . '/gs-plugins/gs-plugins.php';

if ( ! function_exists('gs_team_change_image_box') ) {
	function gs_team_change_image_box() {
	    remove_meta_box( 'postimagediv', 'gs_team', 'side' );
	    add_meta_box('postimagediv', __('Team Member Image'), 'post_thumbnail_meta_box', 'gs_team', 'side', 'low');
	}
	add_action('do_meta_boxes', 'gs_team_change_image_box');
}

if ( ! function_exists('gs_team_pro_link') ) {
	function gs_team_pro_link( $gsTeam_links ) {
		$gsTeam_links[] = '<a class="gs-pro-link" href="https://www.gsamdani.com/product/gs-team-members" target="_blank">Go Pro!</a>';
		$gsTeam_links[] = '<a href="https://www.gsamdani.com/wordpress-plugins" target="_blank">GS Plugins</a>';
		return $gsTeam_links;
	}
	add_filter( 'plugin_action_links_' .plugin_basename(__FILE__), 'gs_team_pro_link' );
}