<!-- div -->
<?php

    $args = array( 'posts_per_page' => 65, 'category' => constant('TEENUSE_KATEGOORIA') );
    $myposts = get_posts( $args );
    $postCount = count($myposts);

  $tstring = '<div id="teenused-rida" class="center">';

  $imgA = array();
  $hhhA = array();

    foreach ( $myposts as $k => $post ) : setup_postdata( $post );

      $cTitle = mb_strtoupper(apply_filters( 'get_the_content', $post->post_title ));


      if ($cTitle==$postTitle) {
        $fieldname = "TeenusIkoonHover";
      } else {
        $fieldname = "TeenusIkoon";
      }

      $tstring .= '<a href="'.get_site_url().'?p='.$post->ID.'"><div class="ttblok">';
      $tstring .= '<div class="teenus-hover-holder" style="display:none;">'.eemaldaAP(lisaBlokk($post->ID, 'TeenusIkoonHover')).'</div>';
      $tstring .= eemaldaAP(lisaBlokk($post->ID, $fieldname));
      $tstring .= '<h3>'.$cTitle.'</h3>';
      $tstring .= '</div></a>';

    endforeach;
    wp_reset_postdata();

    $args = array (
    'post_type'              => 'attachment',
    'post_status'            => array('inherit', 'publish'),
    'category_name'          => 'img-ettevottest',
    );
    //
    $imgEttevottest = '';
    // The Query
    $myposts = new WP_Query( $args );
    if ( $myposts->have_posts() ) {
      $k = 0; //post counter, esimene pilt tuleb auto visible(display:block)
      while ( $myposts->have_posts() ) {
        $myposts->the_post();
        $imgEttevottest = '<img alt="'.$myposts->post->post_excerpt.'" src="'.$myposts->post->guid.'" />';
        $k++;
      }
    } else {
        // no posts found FIXED PILT, msg?
    }
    wp_reset_postdata();

    $tstring .= '</div>';

    $tstring .=  '<div id="teenused-sisu">'
                    //.'<div class="teenus-sisu-img">'
                        //.$imgEttevottest
                    //.'</div>'
                    .'<div class="teenus-sisu-page">'
                      //.get_the_content()
                      .apply_filters( 'the_content', $post->post_content )
                    .'</div>'
                  .'</div>';

    echo $tstring;

?>
