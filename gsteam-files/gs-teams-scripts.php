<?php
// -- Enqueue Latest jQuery

if ( ! function_exists('enqueue_gs_team_latest_jquery') ) {
	function enqueue_gs_team_latest_jquery(){
		if(!wp_script_is('jquery', 'enqueued' )){
			wp_enqueue_script('jquery');
		}
	}
	add_action('init', 'enqueue_gs_team_latest_jquery');
}

if ( ! function_exists('enqueue_gs_team_admin_style')) {
	function enqueue_gs_team_admin_style($screen){
		$s_action = $screen->action;
		$s_post_type = $screen->post_type;
		$s_parent_base = $screen->parent_base;
		$s_base = $screen->base;

		if(($s_action == 'add' || $s_action == null) && $s_base == 'post' && $s_post_type == 'gs_team'){
			add_action('admin_enqueue_scripts', function(){

			$media = 'all';
			wp_register_style( 'gs-team-admin', GSTEAM_FILES_URI . '/assets/css/gs-team-admin.css', '', GSTEAM_VERSION, $media );
	        wp_enqueue_style( 'gs-team-admin' );

	        wp_register_style('gsteam-fa-icons-admin', GSTEAM_FILES_URI . '/assets/fa-icons/css/font-awesome.min.css','', GSTEAM_VERSION, $media);
    		wp_enqueue_style( 'gsteam-fa-icons-admin' );
			} );
		}
	}
	add_action('current_screen', 'enqueue_gs_team_admin_style');
}

// -- Include js files
if ( ! function_exists('gs_enqueue_team_scripts') ) {
	function gs_enqueue_team_scripts() {
		if (!is_admin()) {

			wp_register_script('gsteam-custom-js', GSTEAM_FILES_URI . '/assets/js/gs-team.custom.js', array('jquery'), GSTEAM_VERSION, true);
			wp_enqueue_script('gsteam-custom-js');
		}	
	}
	add_action( 'wp_enqueue_scripts', 'gs_enqueue_team_scripts' ); 
}

// -- Include css files
if ( ! function_exists('gs_enqueue_team_styles') ) {
	function gs_enqueue_team_styles() {
		if (!is_admin()) {
			$media = 'all';
		
			if(!wp_style_is('gsteam-fa-icons','registered')){
				wp_register_style('gsteam-fa-icons', GSTEAM_FILES_URI . '/assets/fa-icons/css/font-awesome.min.css','', GSTEAM_VERSION, $media);
			}
			if(!wp_style_is('gsteam-fa-icons','enqueued')){
				wp_enqueue_style('gsteam-fa-icons');
			}

			wp_register_style('gsteam-custom-bootstrap', GSTEAM_FILES_URI . '/assets/css/gs-team-custom-bootstrap.css','', GSTEAM_VERSION, $media);
			wp_enqueue_style('gsteam-custom-bootstrap');

			// Plugin main stylesheet
			wp_register_style('gs_team_csutom_css', GSTEAM_FILES_URI . '/assets/css/gs-team-custom.css','', GSTEAM_VERSION, $media);
			wp_enqueue_style('gs_team_csutom_css');			
		}
	}
	add_action( 'init', 'gs_enqueue_team_styles' );
}