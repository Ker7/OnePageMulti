<?php get_header();

$landing = false;
$blogpost = false;
global $joonistaHinnaParing;
$joonistaHinnaParing = false;


?>

<!-- For FB!!! -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <div id="main">
    <div id="ylaribatume" >
      <div class="section group">
        <div id="mobile">
          <div id="mnavnimi" class="mbtn col"> <!-- mnavnimi oli ..-->
            <a href="<?php echo get_home_url() ?>"><div class="logodivtume"></div></a> <!-- retina systeem -->
          </div>

          <div id="mnavkontakt" class="col nspan_2_of_4">
            <span class="tumeTcol kontblk kontext htel"><?php echo constant('inf-etel') ?></span>
            <a class="kontblk kontext hemail" href="mailto:<?php echo constant('inf-email') ?>"><?php echo constant('inf-email') ?></a>
          </div>

          <div id="toggle-bar" class="">
                <div id="mnavlangsw" class="col nspan_x_of_4"><?php other_languages(); ?></div>
            <a class="naviconTume mtoggle"> </a>
          </div>
        </div>
      </div>

      <?php require('req-menu-mob.php') ?>

      <div class="section group">
        <div id="pc">
          <div id="navnimi" class="mbtn col span_n_of_4">
              <a href="<?php echo get_home_url() ?>"><div class="logodivtume"></div></a>
          </div>

          <div id="navkontakt" class="col span_1_of_4">
              <span class="kontblk kontext tumeTcol"><?php echo constant('inf-etel') ?></span>
              <a class="kontblk kontext hemail" href="mailto:<?php echo constant('inf-email') ?>"><?php echo constant('inf-email') ?></a>
          </div>

          <?php require('req-menu-pc.php') ?>

        </div>
      </div>
    </div>

    <div id="dragscroll">

    <div id="piltTume" class="section group">
        <div id="banner" class="section group mcenter">
          <div class="banhead-cont">
            <h1><?php echo 'SKP Invest Metsa blogi'.((is_month())?' - '.get_the_time('F Y'):'') ?></h1>

          </div>
        </div>
        <?php
            $args = array (
                'post_type'              => 'attachment',
                'post_status'            => array('inherit', 'publish'),
                'category_name'          => 'taustapiltmedia',
            );
            // The Query
            $myposts = new WP_Query( $args );
            if ( $myposts->have_posts() ) {
                $k = 0; //post counter, esimene pilt tuleb auto visible(display:block)
                while ( $myposts->have_posts() ) {
                    $myposts->the_post();
                    echo  '<div class="taust" style="opacity:'.($k==0?'1':'0').'"> <img alt="'.$myposts->post->post_excerpt.'" src="'.$myposts->post->guid.'" /> </div>';
                    //echo 'jeo: '.$myposts->post->post_excerpt;
                    $k++;
                }
            } else {
                // no posts found FIXED PILT, msg?
            }
            wp_reset_postdata();
        ?>
        <div id="rkolnTume"></div>
    </div>

    <!--div id="servicesteenused"></div>
    <div id="teenusedSingle">
	    <div id="teenused-sisu"-->
            <div class="blog-frame">
             <div class="blog-inner-frame">
			  <div class="blog-previews">
                <?php
                $args = array('posts_per_page' => constant('POSTS_PER_BLOG_MAIN'),
                  'orderby'          => 'post_date',
                  'order'            => 'DESC',
                  //'offset'=> 1,
                  'category' => constant('BLOG_ET')  //WPML abil otsib ka teiste keelte kat'e
                );

                $myposts = get_posts( $args );
                foreach ( $myposts as $post ) : setup_postdata( $post );
                ?>
				<?php //while ( have_posts() ) : the_post(); ?>
				    <div class="blog-post blog-pid-<?php the_ID(); ?>">
						<?php	//Kui headerimg on lisatud...
						$blogHeader = eemaldaAP(lisaBlokk($post->ID, "HeaderPilt"));
						if (strlen($blogHeader)>32) {
							echo '<div class="blog-preview-header">'.$blogHeader.'</div>';
						} ?>
                        <h1 class="blog-post-title"><?php echo $post->post_title; ?></h1>
                        <h5 class="blog-post-date"><?php the_time('j.m.Y'); ?></h5>
                        <?php //echo '<p class="blog-post-excerpt">'.apply_filters( 'the_content', get_the_excerpt() ).'</p>'; ?>
                        <p class="blog-post-excerpt"><?php echo wp_strip_all_tags( lisaBlokk($post->ID, "BlogSissejuhatus") ).' [...]'; ?></p>
						
						<a href="<?php echo get_permalink(get_the_ID()); ?>" class="rohnupp-blog"><p>LOE ROHKEM</p></a>
						
						<div class="fb-like"
							 data-href="<?php echo get_permalink(get_the_ID()); ?>"
							 data-colorscheme="dark"
							 data-width="242"
							 data-layout="standard"
							 data-action="like"
							 data-show-faces="false"
							 data-share="true"></div>
						
					</div><!-- #post-<?php the_ID(); ?> -->
				<?php //endwhile;
                      endforeach; 
                      wp_reset_postdata();?>
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
 
<?php get_footer(); ?>