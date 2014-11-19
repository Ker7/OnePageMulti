<?php get_header();

if (have_posts()) {
  while (have_posts()) : the_post();

  $postId = get_the_ID();
  $postTitle = get_the_title();
  $postSisu = get_the_content();

  endwhile;
}

?>

    <div id="main">
    <!--div id="taust"></div -->
    <div id="ylaribatume" >
        <div class="section group">
            <div id="mobile">
                <div id="mnavnimi" class="mbtn col nspan_1_of_4"> <!-- mnavnimi oli ..-->
                    <!--<a href="<?php //echo get_home_url() ?>" class="mbtn">--><!-- //todo lisada koduka URL! -->
                        <a href="<?php echo get_home_url() ?>"><div class="logodivtume"></div></a> <!-- retina systeem -->
                        <!--<span class="primtext2"> sakumata </span>-->
                    <!--</a>-->
                </div>

                <div id="mnavkontakt" class="col nspan_2_of_4">
                    <span class="tumeTcol kontblk kontext htel"><?php echo constant('inf-etel') ?></span>
                    <a class="kontblk kontext hemail" href="mailto:<?php echo constant('inf-email') ?>"><?php echo constant('inf-email') ?></a>
                </div>

                <div id="toggle-bar" class="">
                    <!--<strong><a class="mtoggle" href="#">MAIN MENU</a></strong>-->
                    <a class="naviconTume mtoggle"> </a>
                </div>
            </div>
        </div>

        <div id="mmenu">
            <a data-targ="#teenused" class="tumeTcol mnavbtn mbtn mnb">TEENUSED</a>
            <a data-targ="#tutvustus" class="tumeTcol mnavbtn mbtn">ETTEVÕTTEST</a>
            <a data-targ="#galerii" class="tumeTcol mnavbtn mbtn">GALERII</a>
            <a data-targ="#fcont" class="tumeTcol mnavbtn mbtn">HINNAPÄRING</a>
            <a data-targ="#kontakt" class="tumeTcol mnavbtn mbtn">KONTAKT</a>
        </div>

        <div class="section group">
            <div id="pc">
                <div id="navnimi" class="mbtn col span_1_of_4">
                    <!--<div class="logodivtume"></div>-->
                    <a href="<?php echo get_home_url() ?>"><div class="logodivtume"></div></a>
                </div>

                <div id="navkontakt" class="col span_1_of_4">
                    <span class="kontblk kontext tumeTcol"><?php echo constant('inf-etel') ?></span>
                    <a class="kontblk kontext hemail" href="mailto:<?php echo constant('inf-email') ?>"><?php echo constant('inf-email') ?></a>
                </div>

                <div id="navnupud" class="col span_2_of_4">
                    <a data-targ="#teenused" class="tumeTcol mnavbtn mbtn">TEENUSED</a>
                    <a data-targ="#tutvustus" class="tumeTcol mnavbtn mbtn">ETTEVÕTTEST</a>
                    <a data-targ="#galerii" class="tumeTcol mnavbtn mbtn">GALERII</a>
                    <a data-targ="#fcont" class="tumeTcol mnavbtn mbtn">HINNAPÄRING</a>
                    <a data-targ="#kontakt" class="tumeTcol mnavbtn mbtn">KONTAKT</a>
                </div>
            </div>
        </div>
    </div>

    <div id="dragscroll">

    <div id="piltTume" class="section group">
        <div id="banner" class="section group mcenter">
          <div class="banhead-cont">
            <h1><?php echo (isset($postTitle)? mb_ucfirst( mb_convert_case($postTitle, MB_CASE_LOWER, "UTF-8"), 'utf8' ) :'Teenused') ?></h1>
            <?php /*
            <h2><?php echo constant('inf-ehtxt1') ?></h2>
            <h3><?php echo constant('inf-ehtxt2') ?></h3>
            */ ?>
            <div class="rohnupp4" onclick="keriTo('#fcont', 1200)"><p>SOOVIN PARIMAT HINDA</p></div>
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

    <div id="teenusedSingle">

    <?php require('req-teenusedTeenustes.php'); ?>

    </div>

<?php get_footer(); ?>