<?php 
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
if ( ! function_exists('add_gs_team_metaboxes') ) {
	
	function add_gs_team_metaboxes(){
		add_meta_box('gsTeamSection', 'Member\'s Additioinal Info' ,'gs_team_cmb_cb', 'gs_team', 'normal', 'high', '');
	}
	add_action('add_meta_boxes', 'add_gs_team_metaboxes');
}

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
if ( ! function_exists('gs_team_cmb_cb') ) {
	function gs_team_cmb_cb($post){

		// Add a nonce field so we can check for it later.
		wp_nonce_field( 'gs_team_nonce_name', 'gs_team_cmb_token' );

		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		$gs_des = get_post_meta( $post->ID, '_gs_des', true );
		$gs_in = get_post_meta( $post->ID, '_gs_in', true );
		$gs_tw = get_post_meta( $post->ID, '_gs_tw', true );
		$gs_fb = get_post_meta( $post->ID, '_gs_fb', true );
		$gs_gplus = get_post_meta( $post->ID, '_gs_gplus', true );
		$gs_ytube = get_post_meta( $post->ID, '_gs_ytube', true );
		$gs_psite = get_post_meta( $post->ID, '_gs_psite', true );

		?>
		<div class="gs_team-metafields">
			<div style="height: 20px;"></div>
			<div class="form-group">
				<label for="gsDes">Designation</label>
				<input type="text" id="gsDes" class="form-control" name="gs_des" value="<?php echo isset($gs_des) ? esc_attr($gs_des) : ''; ?>">
			</div>
			<h2>Member's social links</h2>
			<div class="form-group">
				<label for="gsIn">Linkedin</label>
				<input type="text" id="gsIn" class="form-control" name="gs_in" value="<?php echo isset($gs_in) ? esc_attr($gs_in) : ''; ?>">
			</div>

			<div class="form-group">
				<label for="gsTw">Twitter</label>
				<input type="text" id="gsTw" class="form-control" name="gs_tw" value="<?php echo isset($gs_tw) ? esc_attr($gs_tw) : ''; ?>">
			</div>
			<div class="form-group">
				<label for="gsTw">Facebook</label>
				<input type="text" id="gsTw" class="form-control" name="gs_fb" value="<?php echo isset($gs_fb) ? esc_attr($gs_fb) : ''; ?>">
			</div>
			<div class="form-group">
				<label for="gsGplus">Google+</label>
				<input type="text" id="gsGplus" class="form-control" name="gs_gplus" value="<?php echo isset($gs_gplus) ? esc_attr($gs_gplus) : ''; ?>">
			</div>
			<div class="form-group">
				<label for="gsYyube">Youtube</label>
				<input type="text" id="gsYyube" class="form-control" name="gs_ytube" value="<?php echo isset($gs_ytube) ? esc_attr($gs_ytube) : ''; ?>">
			</div>
			<div class="form-group">
				<label for="gsPsite">Personal Site</label>
				<input type="text" id="gsPsite" class="form-control" name="gs_psite" value="<?php echo isset($gs_psite) ? esc_attr($gs_psite) : ''; ?>">
			</div>
		</div>

		<?php
	}
}


/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */

if ( ! function_exists('save_gs_team_metadata') ) {

	function save_gs_team_metadata($post_id) {

		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['gs_team_cmb_token'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['gs_team_cmb_token'], 'gs_team_nonce_name' ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		/* OK, it's safe for us to save the data now. */
		
		// Make sure that it is set.
		if ( ! isset( $_POST['gs_des'] ) ) {
			return;
		}	
		// Make sure that it is set.
		if ( ! isset( $_POST['gs_in'] ) ) {
			return;
		}	
		// Make sure that it is set.
		if ( ! isset( $_POST['gs_tw'] ) ) {
			return;
		}	
		// Make sure that it is set.
		if ( ! isset( $_POST['gs_fb'] ) ) {
			return;
		}	
		// Make sure that it is set.
		if ( ! isset( $_POST['gs_gplus'] ) ) {
			return;
		}	
		// Make sure that it is set.
		if ( ! isset( $_POST['gs_ytube'] ) ) {
			return;
		}	
		// Make sure that it is set.
		if ( ! isset( $_POST['gs_psite'] ) ) {
			return;
		}

		// Sanitize user input.
		$gs_des_data = sanitize_text_field( $_POST['gs_des'] );
		$gs_in_data = sanitize_text_field( $_POST['gs_in'] );
		$gs_tw_data = sanitize_text_field( $_POST['gs_tw'] );
		$gs_fb_data = sanitize_text_field( $_POST['gs_fb'] );
		$gs_gplus_data = sanitize_text_field( $_POST['gs_gplus'] );
		$gs_ytube_data = sanitize_text_field( $_POST['gs_ytube'] );
		$gs_psite_data = sanitize_text_field( $_POST['gs_psite'] );

		// Update the meta field in the database.
		update_post_meta( $post_id, '_gs_des', $gs_des_data );
		update_post_meta( $post_id, '_gs_in', $gs_in_data );
		update_post_meta( $post_id, '_gs_tw', $gs_tw_data );
		update_post_meta( $post_id, '_gs_fb', $gs_fb_data );
		update_post_meta( $post_id, '_gs_gplus', $gs_gplus_data );
		update_post_meta( $post_id, '_gs_ytube', $gs_ytube_data );
		update_post_meta( $post_id, '_gs_psite', $gs_psite_data );
	}
	add_action( 'save_post', 'save_gs_team_metadata');
}