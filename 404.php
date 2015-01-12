<?php get_header();

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
            <h1><?php echo icl_t('skptheme', '404tekst', 'Sorry! Page not found.') ?></h1>
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

    <div id="servicesteenused"></div>
    <div id="teenusedSingle">

    <?php
    
      $args = array( 'posts_per_page' => 65, 'category' => constant('TEENUSE_KATEGOORIA') );
  $myposts = get_posts( $args );
  $postCount = count($myposts);

  $tstring = '<div id="teenused-rida" class="center">';

  $imgA = array();
  $hhhA = array();

  foreach ( $myposts as $k => $post ) : setup_postdata( $post );

    $cTitle = mb_strtoupper(apply_filters( 'get_the_content', $post->post_title ));
    $fieldname = "TeenusIkoon";

    $tstring .= '<a href="'.get_site_url().'?p='.$post->ID.'"><div class="ttblok">';
    $tstring .= '<div class="teenus-hover-holder" style="display:none;">'.eemaldaAP(lisaBlokk($post->ID, 'TeenusIkoonHover')).'</div>';
    $tstring .= eemaldaAP(lisaBlokk($post->ID, $fieldname));
    $tstring .= '<h3>'.$cTitle.'</h3>';
    $tstring .= '</div></a>';

  endforeach;
  wp_reset_postdata();

    $tstring .= '</div>';
    
   /* $tstring .= '<div id="teenused-sisu">'
                    .'<div class="teenus-sisu-img">'
                        //.lisaBlokk($post->ID, 'TeenusPilt')
                        //.$post->ID
                    .'</div>'
                    .'<div class="teenus-sisu-sisu">'
                      //.get_the_content()
                      .'Page not found.'
                    .'</div>'
                  .'</div>'*/
	$tstring .= '</div>';
	echo $tstring; ?>
    

    

<?php get_footer();


?>