<?php 

// -- Getting values from setting panel

function gs_team_getoption( $option, $section, $default = '' ) {
    $options = get_option( $section );
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
    return $default;
}

// -- Shortcode [gs_team]

add_shortcode('gs_team','gs_team_shortcode');

function gs_team_shortcode( $atts ) {

	$gs_team_theme = gs_team_getoption('gs_team_theme', 'gs_team_settings', 'theme1');
	$gs_team_cols = gs_team_getoption('gs_team_cols', 'gs_team_settings', 3);

	extract(shortcode_atts(
		array(
		'num' 		=> -1,
		'order'		=> 'DESC',
		'orderby'	=> 'date',
		'theme'		=> $gs_team_theme,
		'cols'		=> $gs_team_cols
		), $atts
	));

	$GLOBALS['gs_team_loop'] = new WP_Query(
		array(
		'post_type'			=> 'gs_team',
		'order'				=> $order,
		'orderby'			=> $orderby,
		'posts_per_page'	=> $num
	));
       
        $output = '';
		$output = '<div class="wrap gs_team_area '.$theme.'">';

		if ( $theme == 'gs_tm_theme1' || $theme == 'gs_tm_theme2') {
			include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_one.php';
		} else {
			echo('<h4 style="text-align: center;">Select correct Theme or Upgrade to <a href="https://www.gsamdani.com/product/gs-team-members" target="_blank">Pro version</a> for more Options<br><a href="http://www.team.gsamdani.com">Chcek available demos</a></h4>');
		}

		$output .= '</div>'; // end wrap

	return $output;
}