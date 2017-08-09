<?php
/**
 * This page shows the procedural or functional example
 * OOP way example is given on the main plugin file.
 * @author Tareq Hasan <tareq@weDevs.com>
 */
 
/**
 * WordPress settings API demo class
 * @author Tareq Hasan
 */

if ( !class_exists('GS_team_Settings_Config' ) ):
class GS_team_Settings_Config {

    private $settings_api;

    function __construct() {
        $this->settings_api = new GS_Team_WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
	
		add_submenu_page( 'edit.php?post_type=gs_team', 'Team Settings', 'Team Settings', 'delete_posts', 'team-settings', array($this, 'plugin_page')); 
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' 	=> 'gs_team_settings',
                'title' => __( 'GS Team Settings', 'gsteam' )
            ),
            array(
                'id'    => 'gs_team_style_settings',
                'title' => __( 'Style Settings', 'gsteam' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'gs_team_settings' => array(
                // Columns
                array(
                    'name'      => 'gs_team_cols',
                    'label'     => __( 'Columns', 'gsteam' ),
                    'desc'      => __( 'Select number of Team columns', 'gsteam' ),
                    'type'      => 'select',
                    'default'   => '3',
                    'options'   => array(
                        '6'      => '2 Columns',
                        '4'      => '3 Columns',
                        '3'      => '4 Columns'
                    )
                ),
                // teams theme
                array(
                    'name'  => 'gs_team_theme',
                    'label' => __( 'Style & Theming', 'gsteam' ),
                    'desc'  => __( 'Select preffered Style & Theme', 'gsteam' ),
                    'type'  => 'select',
                    'default'   => 'gs_tm_theme1',
                    'options'   => array(
                        'gs_tm_theme1'   => 'Hover (Lite)',
                        'gs_tm_theme2'   => 'Round (Lite)',
                        'gs_tm_theme3'   => 'Left/Right (Pro)',
                        'gs_tm_theme4'   => 'Right/Left (Pro)',
                        'gs_tm_theme5'   => 'L/R Round (Pro)',
                        'gs_tm_theme6'   => 'R/L Round (Pro)',
                        'gs_tm_theme7'   => 'Slider (Pro)',
                        'gs_tm_theme8'   => 'Popup (Pro)',
                        'gs_tm_theme9'   => 'Filter (Pro)',
                        'gs_tm_theme10'  => 'Greyscale (Pro)',
                    )
                ),
                // Team Member Name
                array(
                    'name'      => 'gs_member_name',
                    'label'     => __( 'Member Name', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Team Member Name', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // Team Member Designation
                array(
                    'name'      => 'gs_member_role',
                    'label'     => __( 'Member Designation', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Team Member Designation', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // Team Member Details
                array(
                    'name'      => 'gs_member_details',
                    'label'     => __( 'Member Details', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Team Member Details', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // Team Member Social Connection
                array(
                    'name'      => 'gs_member_connect',
                    'label'     => __( 'Social Connection', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Team Member Social Connections', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // Clickable Logos
                array(
                    'name'      => 'gs_tm_link_tar',
                    'label'     => __( 'Social Link Target', 'gsteam' ),
                    'desc'      => __( 'Specify target to load the Links, Default New Tab ', 'gsteam' ),
                    'type'      => 'select',
                    'default'   => '_blank',
                    'options'   => array(
                        '_blank'    => 'New Tab',
                        '_self'     => 'Same Window'
                    )
                ),
                // Title char limit
                array(
                    'name'  => 'gs_tm_details_contl',
                    'label' => __( 'Details Control', 'gswps' ),
                    'desc'  => __( 'Define maximum number of characters in Member details. Default 100', 'gsteam' ),
                    'type'  => 'number',
                    'min'   => 1,
                    'max'   => 300,
                    'default' => 100
                )
            ),
            'gs_team_style_settings' => array(
                array(
                    'name'      => 'gs_tm_setting_banner',
                    'label'     => __( '', 'gsteam' ),
                    'desc'      => __( '<p class="gstm_pro">Available at <a href="https://www.gsamdani.com/product/gs-team-members/" target="_blank">PRO</a> version.</p>', 'gsteam' ),
                    'row_classes' => 'gspt_banner'
                ),
                // Font Size
                array(
                    'name'      => 'gs_tm_m_fz',
                    'label'     => __( 'Font Size', 'gsteam' ),
                    'desc'      => __( 'Set Font Size for <b>Member Name</b>', 'gsteam' ),
                    'type'      => 'number',
                    'default'   => '18',
                    'options'   => array(
                        'min'   => 1,
                        'max'   => 30,
                        'default' => 18
                    )
                ),
                // Font weight
                array(
                    'name'      => 'gs_tm_m_fntw',
                    'label'     => __( 'Font Weight', 'gsteam' ),
                    'desc'      => __( 'Select Font Weight for <b>Member Name</b>', 'gsteam' ),
                    'type'      => 'select',
                    'default'   => 'normal',
                    'options'   => array(
                        'normal'    => 'Normal',
                        'bold'      => 'Bold',
                        'lighter'   => 'Lighter'
                    )
                ),
                // Font style
                array(
                    'name'      => 'gs_tm_m_fnstyl',
                    'label'     => __( 'Font Style', 'gsteam' ),
                    'desc'      => __( 'Select Font Weight for <b>Member Name</b>', 'gsteam' ),
                    'type'      => 'select',
                    'default'   => 'normal',
                    'options'   => array(
                        'normal'    => 'Normal',
                        'italic'      => 'Italic'
                    )
                ),
                // Member Name Color
                array(
                    'name'    => 'gs_tm_mname_color',
                    'label'   => __( 'Member Name Color', 'gsteam' ),
                    'desc'    => __( 'Select color for <b>Member Name</b>.', 'gsteam' ),
                    'type'    => 'color',
                    'default' => '#141412'
                ), 

                // Font Size Role
                array(
                    'name'      => 'gs_tm_role_fz',
                    'label'     => __( 'Font Size', 'gsteam' ),
                    'desc'      => __( 'Set Font Size for <b>Member Role</b>', 'gsteam' ),
                    'type'      => 'number',
                    'default'   => '18',
                    'options'   => array(
                        'min'   => 1,
                        'max'   => 30,
                        'default' => 18
                    )
                ),
                // Font weight
                array(
                    'name'      => 'gs_tm_role_fntw',
                    'label'     => __( 'Font Weight', 'gsteam' ),
                    'desc'      => __( 'Select Font Weight for <b>Member Role</b>', 'gsteam' ),
                    'type'      => 'select',
                    'default'   => 'normal',
                    'options'   => array(
                        'normal'    => 'Normal',
                        'bold'      => 'Bold',
                        'lighter'   => 'Lighter'
                    )
                ),
                // Font style
                array(
                    'name'      => 'gs_tm_role_fnstyl',
                    'label'     => __( 'Font Style', 'gsteam' ),
                    'desc'      => __( 'Select Font Weight for <b>Member Role</b>', 'gsteam' ),
                    'type'      => 'select',
                    'default'   => 'italic',
                    'options'   => array(
                        'italic'      => 'Italic',
                        'normal'    => 'Normal'
                    )
                ),
                // Member Name Color
                array(
                    'name'    => 'gs_tm_role_color',
                    'label'   => __( 'Member Role Color', 'gsteam' ),
                    'desc'    => __( 'Select color for <b>Member Role</b>.', 'gsteam' ),
                    'type'    => 'color',
                    'default' => '#141412'
                ),
                // Team Custom CSS
                array(
                    'name'    => 'gs_tm_custom_css',
                    'label'   => __( 'Team Custom CSS', 'gsteam' ),
                    'desc'    => __( 'You can write your own custom css', 'gsteam' ),
                    'type'    => 'textarea'
                ), 
            )
        );

        return $settings_fields;
    }

    function plugin_page() {
        settings_errors();
        echo '<div class="wrap gs_team_wrap" style="width: 845px; float: left;">';
        // echo '<div id="post-body-content">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';

        ?> 
            <div class="gswps-admin-sidebar" style="width: 277px; float: left; margin-top: 62px;">
                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Support / Report a bug' ) ?></span></h3>
                    <div class="inside centered">
                        <p>Please feel free to let me know if you got any bug to report. Your report / suggestion can make the plugin awesome!</p>
                        <p style="margin-bottom: 1px! important;"><a href="https://www.gsamdani.com/support" target="_blank" class="button button-primary">Get Support</a></p>
                    </div>
                </div>
                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Buy me a coffee' ) ?></span></h3>
                    <div class="inside centered">
                        <p>If you like the plugin, please buy me a coffee to inspire me to develop further.</p>
                        <p style="margin-bottom: 1px! important;"><a href='https://www.2checkout.com/checkout/purchase?sid=202460873&quantity=1&product_id=8' class="button button-primary" target="_blank">Donate</a></p>
                    </div>
                </div>

                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Join GS Plugins on facebook' ) ?></span></h3>
                    <div class="inside centered">
                        <iframe src="//www.facebook.com/plugins/likebox.php?href=https://www.facebook.com/gsplugins&amp;width&amp;height=258&amp;colorscheme=dark&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=723137171103956" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:220px;" allowTransparency="true"></iframe>
                    </div>
                </div>

                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Follow GS Plugins on twitter' ) ?></span></h3>
                    <div class="inside centered">
                        <a href="https://twitter.com/gsplugins" target="_blank" class="button button-secondary">Follow @gsplugins<span class="dashicons dashicons-twitter" style="position: relative; top: 3px; margin-left: 3px; color: #0fb9da;"></span></a>
                    </div>
                </div>
            </div>
        <?php
    }


    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;

$settings = new GS_team_Settings_Config();