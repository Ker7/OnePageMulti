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

    $tstring .= '</div>';

    $tstring .=  '<div id="teenused-sisu">'
                    .'<div class="teenus-sisu-img">'
                        .lisaBlokk($post->ID, 'TeenusPilt')
                        //.$post->ID
                    .'</div>'
                    .'<div class="teenus-sisu-sisu">'
                      //.get_the_content()
                      .apply_filters( 'the_content', $post->post_content )
                    .'</div>'
                  .'</div>';

    echo $tstring;

?>
<div id="saadapakkumine" class="center">
    <div class="spcont">
        <div class="spbl1">
            <p><?php
                $sissej = "";
                $sissej.= lisaBlokk($post->ID, 'TeenusNupuSissejuh');
                $pikk = mb_strlen($sissej, 'UTF-8');
                if ($pikk>3) {
                  echo $sissej;
                } else {
                  echo '![TeenusNupuSissejuh]';
                }
              ?></p>
        </div>
        <div class="spbl2">
            <div class="rohnupp2 mcenter" onclick="keriTo('#fcont', 1200)"><p><?php
                //echo lisaBlokk($post->ID, 'TeenusNupuTekst');
                //echo (isset($postTitle)? mb_ucfirst( mb_convert_case($postTitle, MB_CASE_LOWER, "UTF-8"), 'utf8' ) :'Teenused') ;
                $lisatekst = "";
                $lisatekst.= lisaBlokk($post->ID, 'TeenusNupuTekst');
                $pikkus = mb_strlen($lisatekst, 'UTF-8');
                if ($pikkus>3) {
                  echo mb_strtoupper($lisatekst, 'UTF-8');
                } else {
                  echo '![TeenusNupuTekst]';
                }
                // või võta yhendust
                ?></p></div>
            <div class="sptekst2">
                <span><?php echo icl_t('skptheme', 'voiKirjuta', 'or write') ?> </span>
                <a class="" href="mailto:<?php echo constant('inf-email') ?>"><?php echo constant('inf-email') ?></a>
            </div>
        </div>
    </div>
</div>