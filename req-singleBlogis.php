<div class="blog-frame">
             <div class="blog-inner-frame">
			  <div id="blog-post-single" class="blog-previews">
                <?php
                $args = array('posts_per_page' => constant('POSTS_PER_BLOG_MAIN'),
                  'orderby'          => 'post_date',
                  'order'            => 'DESC',
                  //'offset'=> 1,
                  'category' => constant('BLOG_ET')  //WPML abil otsib ka teiste keelte kat'e
                );

                //$myposts = get_posts( $args );
                //foreach ( $myposts as $post ) : setup_postdata( $post );
                global $post;
                while ( have_posts() ) : the_post(); ?>
				    <div class="blog-post blog-pid-<?php the_ID(); ?>">
						<?php	//Kui headerimg on lisatud...
						$blogHeader = eemaldaAP(lisaBlokk($post->ID, "HeaderPilt"));
						if (strlen($blogHeader)>32) {
							echo '<div class="blog-preview-header">'.$blogHeader.'</div>';
						} ?>
                        <h1 class="blog-post-title"><?php echo $post->post_title; ?></h1>
                        <h5 class="blog-post-date"><?php the_time('j.m.Y'); ?></h5>
                        <?php //echo '<p class="blog-post-excerpt">'.apply_filters( 'the_content', get_the_excerpt() ).'</p>'; ?>
                        <?php echo apply_filters( 'the_content', get_the_content() ); ?></p>
						
						<div class="fb-like"
							 data-href="<?php echo get_permalink(get_the_ID()); ?>"
							 data-colorscheme="dark"
							 data-width="242"
							 data-layout="standard"
							 data-action="like"
							 data-show-faces="false"
							 data-share="true"></div>
						
					</div><!-- #post-<?php the_ID(); ?> -->
				<?php endwhile;
                      //endforeach; 
                      //wp_reset_postdata();?>
		        </div><!-- end previews -->

				<div class="blog-archive">
					<div class="headline"><?php echo icl_t('skptheme', 'Blogis_Arhiivi_Pealkiri', 'Archive'); ?></div>
<?php
$args = array('posts_per_page' => 0,
			  'orderby'          => 'post_date',
			  'order'            => 'DESC',
			  'category' => constant('BLOG_ET'));	//WPML abil otsib ka teiste keelte kat'e
$myposts = get_posts( $args );
$arhiiv = array();	//array kuhu kogun postid
foreach ( $myposts as $post ) : setup_postdata( $post );
  $arhiiv[get_the_time('Y')][get_the_time('n')][] = array(
									'id' => get_the_ID(),
									'permalink' => get_the_permalink(),
									'title' => get_the_title());
endforeach; 
wp_reset_postdata();
//print_r($arhiiv);
foreach($arhiiv as $yname => $ayear){
	$aastasPostitusi = countYearPost($ayear);
	echo '<div class="ayb">'
			.'<div class="ayb-name">'.$yname.' ('.($aastasPostitusi).')</div>';
	foreach($ayear as $mname => $amonth){
		echo '<div class="amb">'
				.'<div class="amb-name">'.teeNumberKuuks($mname).' ('.count($amonth).')</div>';
		foreach($amonth as $ablogpost){
			echo '<div class="att ar-blogpost-'.$ablogpost['id'].'">'
					.'<a href="'.$ablogpost['permalink'].'">'.$ablogpost['title'].'</a>'
				.'</div>';
		}
		echo '</div><!-- .amb -->';
	}
	echo '</div><!-- .ayb -->';
}
?>
				</div><!-- blog-inner-frame -->
 
            </div><!-- #blog-previews -->
        </div><!-- #blog-frame -->