<?php 
/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
if ( ! function_exists( 'GS_Team' ) ) {

	function GS_Team() {
		$labels = array(
			'name'               => _x( 'Teams', 'gsteam' ),
			'singular_name'      => _x( 'Team', 'gsteam' ),
			'menu_name'          => _x( 'GS Team', 'admin menu', 'gsteam' ),
			'name_admin_bar'     => _x( 'GS Team Lite', 'add new on admin bar', 'gsteam' ),
			'add_new'            => _x( 'Add New Member', 'team', 'gsteam' ),
			'add_new_item'       => __( 'Add New Member', 'gsteam' ),
			'new_item'           => __( 'New Team', 'gsteam' ),
			'edit_item'          => __( 'Edit Team', 'gsteam' ),
			'view_item'          => __( 'View Team', 'gsteam' ),
			'all_items'          => __( 'All Members', 'gsteam' ),
			'search_items'       => __( 'Search Members', 'gsteam' ),
			'parent_item_colon'  => __( 'Parent Teams:', 'gsteam' ),
			'not_found'          => __( 'No Teams found.', 'gsteam' ),
			'not_found_in_trash' => __( 'No Teams found in Trash.', 'gsteam' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'team_members' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => GSTEAM_MENU_POSITION,
			'menu_icon'          => 'dashicons-image-filter',
			'supports'           => array( 'title', 'editor','thumbnail')
		);

		register_post_type( 'gs_team', $args );
	}
}
add_action( 'init', 'GS_Team' );


// Register Theme Features (feature image for Team)
if ( ! function_exists('gs_team_theme_support') ) {

	function gs_team_theme_support()  {
		// Add theme support for Featured Images
		add_theme_support( 'post-thumbnails', array( 'gs_team' ) );
		add_theme_support( 'post-thumbnails', array( 'post' ) ); // Add it for posts
		add_theme_support( 'post-thumbnails', array( 'page' ) ); // Add it for pages
		add_theme_support( 'post-thumbnails', array( 'product' ) ); // Add it for products
		add_theme_support( 'post-thumbnails');
		// Add Shortcode support in text widget
		add_filter('widget_text', 'do_shortcode'); 
	}

	// Hook into the 'after_setup_theme' action
	add_action( 'after_setup_theme', 'gs_team_theme_support' );
}

// SIDEBAR Ad for PRO version
function gs_team_pro_features_meta_box() {
	add_meta_box(
		'gs_team_sectionid_pro_sidebar',
		__( "GS Team Pro Features" , 'gsteam' ),
		'gs_team_pro_features',
		'gs_team',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'gs_team_pro_features_meta_box' );

function gs_team_pro_features() { ?>
	<ul class="gstm_pro_fea">
		<li>10 different themes</li>
		<li>Single Team Template included</li>
		<li>Archive Team Template included</li>
		<li>GS Team Widget available</li>
		<li>GS Team Shortcode generator available at page / post</li>
		<li>Display members by Group / Department wise (category)</li>
		<li>Limit number of team member to display.</li>
		<li>Custom CSS – Add Custom CSS to GS Team Member.</li>
		<li>Great Settings Panel.</li>
		<li>Priority Email Support.</li>
	</ul>
	<p><a class="button button-primary button-large" href="https://www.gsamdani.com/product/gs-team-members" target="_blank">Go for PRO</a></p>
	<div style="clear:both"></div>
<?php
}