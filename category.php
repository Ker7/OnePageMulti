<?php get_header();

$landing = false;
$blogpost = false;

?>
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
				<?php while ( have_posts() ) : the_post();
				
				echo '<div class="blog-post-'.get_the_ID().'" style="">'
                        .'<h1 style=" font-size: 24px;
                                    font-weight: 600;
                                    background-color: gray;">'.$post->post_title.'</h1>'
                        .'<h5>'.$post->post_date.'</h5>'
                        //.apply_filters( 'the_content', $post->post_content )	//TAHTIS format reset siinb
                        .apply_filters( 'the_content', get_the_excerpt() )	//TAHTIS format reset siinb
						//.get_the_excerpt()
					.'</div><!-- #post-'.get_the_ID().'-->'; 
				endwhile; 
		  echo '</div><!-- end previews -->';
/*		  echo '<div id="blog-latest" style="width:300px;
							float: left;
							background-color: #eee;
							border: red 1px dashed;
							margin-left: 40px;">'
				  .'<h3 style="font-size: 24px;
							   font-weight: 600;
							   background-color: gray;">Viimased postitused T!</h3>'
			  .'</div><!-- #blog-latest -->';*/ ?>

			        <div class="blog-archive">

						<div class="headline">Arhiiv</div>

						<div class="ayb ar-year-2015">
							<div class="ayb-name">2015 (3)</div>
		
							<div class="amb ar-month-1">
								<div class="amb-name">Jaanuar (1)</div>
								
								<div class="att ar-blogpost-1">
									<a href="#">Blogipost nimega üks meist on eriline.</a>
								</div>
								
							</div>
		
							<div class="amb ar-month-2">
								<div class="amb-name">Veebruar (2)</div>
								
								<div class="att ar-blogpost-2">
									<a href="#">Siin ei ole kala.</a>
								</div>
																
								<div class="att ar-blogpost-3">
									<a href="#">Blogipost nimega Teine meist on kummaline ja šallalallaa.</a>
								</div>
																
								<div class="att ar-blogpost-4">
									<a href="#">Soe puukoor läheb kergemini alla.</a>
								</div>
								
								<div class="att ar-blogpost-2">
									<a href="#">Siin ei ole kala.</a>
								</div>
																
								<div class="att ar-blogpost-3">
									<a href="#">Blogipost nimega Teine meist on kummaline ja šallalallaa.</a>
								</div>
																
								<div class="att ar-blogpost-4">
									<a href="#">Soe puukoor läheb kergemini alla.</a>
								</div>
								
								<div class="att ar-blogpost-2">
									<a href="#">Siin ei ole kala.</a>
								</div>
																
								<div class="att ar-blogpost-3">
									<a href="#">Blogipost nimega Teine meist on kummaline ja šallalallaa.</a>
								</div>
																
								<div class="att ar-blogpost-4">
									<a href="#">Soe puukoor läheb kergemini alla.</a>
								</div>
							</div>
						</div>
		
						<div class="ayb ar-year">
							<div class="ayb-name">2013 (0)</div>
						</div>
						<div class="ayb ar-year">
							<div class="ayb-name">2012 (0)</div>
						</div>
						<div class="ayb ar-year">
							<div class="ayb-name">2011 (0)</div>
						</div>
		
					<!--div>< /-->
			  
				</div><!-- blog-inner-frame -->
 
            </div><!-- #blog-previews -->
        </div><!-- #blog-frame -->
 
<?php get_footer(); ?>