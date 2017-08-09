<?php
/*
 * GS Team - Theme One
 * @author Golam Samdani <samdani1997@gmail.com>
 * 
 */
$gs_member_connect = gs_team_getoption('gs_member_connect', 'gs_team_settings', 'on');
$gs_tm_link_tar = gs_team_getoption('gs_tm_link_tar', 'gs_team_settings', '_blank');
$gs_member_name = gs_team_getoption('gs_member_name', 'gs_team_settings', 'on');
$gs_member_role = gs_team_getoption('gs_member_role', 'gs_team_settings', 'on');
$gs_member_details = gs_team_getoption('gs_member_details', 'gs_team_settings', 'on');
$gs_tm_details_contl = gs_team_getoption('gs_tm_details_contl', 'gs_team_settings', 100);

$output .= '<div class="container">';
$output .= '<div class="row clearfix gs_team" id="gs_team'.get_the_id().'">';

	if ( $GLOBALS['gs_team_loop']->have_posts() ) {
			
			while ( $GLOBALS['gs_team_loop']->have_posts() ) {
				$GLOBALS['gs_team_loop']->the_post();
				$gs_team_id = get_post_thumbnail_id();
				$gs_team_url = wp_get_attachment_image_src($gs_team_id, 'full', true);
				$team_thumb = $gs_team_url[0];
				$gs_team_alt = get_post_meta($gs_team_id,'_wp_attachment_image_alt',true);
				$gs_member_desc = get_the_content();
				$gs_member_desc_link = get_the_permalink();
				$gs_member_desc = (strlen($gs_member_desc) > 50) ? substr($gs_member_desc,0, $gs_tm_details_contl ).'...<a href="'.$gs_member_desc_link.'">more</a>' : $gs_member_desc;

				$gs_tm_meta = get_post_meta( get_the_id() );
				$designation = !empty($gs_tm_meta['_gs_des'][0]) ? $gs_tm_meta['_gs_des'][0] : '';
				$in_url = !empty($gs_tm_meta['_gs_in'][0]) ? $gs_tm_meta['_gs_in'][0] : '';
				$fb_url = !empty($gs_tm_meta['_gs_fb'][0]) ? $gs_tm_meta['_gs_fb'][0] : '';
				$tw_url = !empty($gs_tm_meta['_gs_tw'][0]) ? $gs_tm_meta['_gs_tw'][0] : '';
				$gplus_url = !empty($gs_tm_meta['_gs_gplus'][0]) ? $gs_tm_meta['_gs_gplus'][0] : '';
				$ytube_url = !empty($gs_tm_meta['_gs_ytube'][0]) ? $gs_tm_meta['_gs_ytube'][0] : '';
				$psite_url = !empty($gs_tm_meta['_gs_psite'][0]) ? $gs_tm_meta['_gs_psite'][0] : '';

			    $output .= '<div itemscope="" itemtype="http://schema.org/Person">'; //Start sehema
				$output .= '<div class="col-md-'.$cols.' col-sm-6 col-xs-6">';
				
					$output .= '<div class="single-member">'; // start single meember

					if ( has_post_thumbnail() )
			            $output .= '<img src="'. $team_thumb .'" alt="'. $gs_team_alt .'" itemprop="image"/>';
			        else {
			            $output .= '<img src="' . GSTEAM_FILES_URI . '/assets/img/no_img.png" class=""/>';
			        }

			        $output .= '<div class="single-mem-desc-social">'; // start desc & social
					if ( 'on' ==  $gs_member_details ) :
			        $output.= '<p class="gs-member-desc" itemprop="description">'. $gs_member_desc .'</p>';
			        endif;

			        if ( 'on' == $gs_member_connect ) :
			        $output .= '<div itemscope itemtype="http://schema.org/Organization">'; // social links
			          if( $in_url || $fb_url || $tw_url || $gplus_url ||  $ytube_url ||  $psite_url ) :
			            $output .= '<ul class="gs-team-social">';
			              if(!empty( $in_url )) :
			                  $output .= '<li class="tm_in"><a href="'. $in_url .'" target="'. $gs_tm_link_tar .'" itemprop="sameAs"><i class="fa fa-linkedin"></i></a></li>';
			              endif;
			              if(!empty( $fb_url )) :
			                  $output .= '<li class="tm_fb"><a href="'. $fb_url .'" target="'. $gs_tm_link_tar .'" itemprop="sameAs"><i class="fa fa-facebook"></i></a></li>';
			              endif;
			              if(!empty( $tw_url )) :
			                  $output .= '<li class="tm_tw"><a href="'. $tw_url .'" target="'. $gs_tm_link_tar .'" itemprop="sameAs"><i class="fa fa-twitter"></i></a></li>';
			              endif;
			              if(!empty( $gplus_url )) :
			                  $output .= '<li class="tm_gplus"><a href="'. $gplus_url .'" target="'. $gs_tm_link_tar .'" itemprop="sameAs"><i class="fa fa-google-plus"></i></a></li>';
			              endif;
			              if(!empty( $ytube_url )) :
			                  $output .= '<li class="tm_yt"><a href="'. $ytube_url .'" target="'. $gs_tm_link_tar .'" itemprop="sameAs"><i class="fa fa-youtube"></i></a></li>';
			              endif;
			              if(!empty( $psite_url )) :
			                  $output .= '<li class="tm_psite"><a href="'. $psite_url .'" target="'. $gs_tm_link_tar .'" itemprop="url"><i class="fa fa-paper-plane-o"></i></a></li>';
			              endif;
			            $output .= '</ul>';
			          endif;
			        $output .= '</div>'; // end social links
			        $output .= '</div>'; // end desc & social

			        endif;
			        $output .= '</div>'; // end single meember

			        if ( 'on' ==  $gs_member_name ) :
			            $output.= '<div class="gs-member-name" itemprop="name">'. get_the_title() .'</div>';
			        endif;

					if(!empty( $designation ) && 'on' == $gs_member_role ):
			          $output.= '<div class="gs-member-desig" itemprop="jobtitle">'. $designation .'</div>';
			        endif;
				$output .= '</div>'; // end col
				$output .= '</div>'; //end sehema
			} // end while loop
		} else {
			$output .= "No Team Member Added!";
		}

		wp_reset_postdata();

$output .= '</div>'; // end row
$output .= '</div>'; // end container
return $output;