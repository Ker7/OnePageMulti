<?php get_header();

global $joonistaHinnaParing;
$landing = false;
$blogpost = false;


if (have_posts()) {
  while (have_posts()) : the_post();

  $postId = get_the_ID();
  $postTitle = get_the_title();
  $postSisu = get_the_content();
  $pCat = get_the_category();
  $cNum = $pCat[0]->term_id;

  if ($cNum == constant('KAMP_ET') ||
      $cNum == constant('KAMP_EN') ||
      $cNum == constant('KAMP_RU')) {
    $landing= true;
  }
  
  if ($cNum == constant('BLOG_ET') ||
      $cNum == constant('BLOG_EN') ||
      $cNum == constant('BLOG_RU')) {
    $blogpost= true;
    $joonistaHinnaParing = false;
  }

  endwhile;
}
?>
<?php if ($landing == true) {
  include("single-landing-page.php");
} else {
  if ($blogpost){ ?>
    <!-- For FB!!! -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
  <?php } ?>

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
            <h1><?php echo (isset($postTitle)? mb_ucfirst( mb_convert_case($postTitle, MB_CASE_LOWER, "UTF-8"), 'utf8' ) :'Teenused') ?></h1>
            <?php if (!$blogpost) { ?>
              <div class="rohnupp4" onclick="keriTo('#fcont', 1200)">
                <p><?php echo lisaBlokk($postId, 'TeenusNupuTekst'); ?></p>
              </div>
            <?php } ?>
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
    // KUI ON BLOGIPOST SIIS BLOGISISU, muidu eeldab et on teenusepost
    if ($blogpost) {
      require('req-singleBlogis.php');
    } else {
      require('req-teenusedTeenustes.php');
    }
    ?>

    </div>

<?php get_footer();

}

?>