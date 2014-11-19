<!-- div -->
<?php
/*
    $args = array( 'posts_per_page' => 65, 'offset'=> 0, 'category' => 2 );
    $myposts = get_posts( $args );
    foreach ( $myposts as $post ) : setup_postdata( $post );


        echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';

        lisaBlokk($post->ID, "TeenusNupuTekst");
        lisaBlokk($post->ID, "TeenusIkoon");
    endforeach;
    wp_reset_postdata();
    */

    $args = array( 'posts_per_page' => 65, 'category' => constant('TEENUSE_KATEGOORIA') );
    $myposts = get_posts( $args );

    $postCount = count($myposts);

//echo "Post1 ID (16): ";
//echo apply_filters( 'get_the_content', $myposts[1]->ID );
//echo '<br />';

//echo "Poste: ".$postCount.'<br />';
//var_dump($myposts);

  $tstring = '<div id="teenused-rida" class="center">';

  $imgA = array();
  $hhhA = array();

    foreach ( $myposts as $k => $post ) : setup_postdata( $post );

      //echo $k.'<div class="tteenusbl">'
      //      .'<div class="tb-img">'.eemaldaAP(lisaBlokk($post->ID, "TeenusIkoon")).'</div>'
      //        .'<div class="tb-h">'.'<h3>'.mb_strtoupper(apply_filters( 'get_the_content', $post->post_title ))
      //        .'</h3></div>'
      //        //.'<p>'.apply_filters( 'get_the_content', $post->post_content ).'</p>'
      //        //.'<a onclick="preT('.($k+1).');">'.lisaBlokk($post->ID, "TeenusNupuTekst").' ></a>'
      //    //.'</div>'
      //    //.'<div class="tblock"> </div>'
      //.'</div>';
      $cTitle = mb_strtoupper(apply_filters( 'get_the_content', $post->post_title ));


      if ($cTitle==$postTitle) {
        $fieldname = "TeenusIkoonHover";
      } else {
        $fieldname = "TeenusIkoon";
      }

      //$imgA[] = eemaldaAP(lisaBlokk($post->ID, $fieldname));
      //$hhhA[] = '<h3>'.$cTitle.'</h3>';
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
                <span>või kirjuta </span>
                <a class="" href="mailto:<?php echo constant('inf-email') ?>"><?php echo constant('inf-email') ?></a>
            </div>
        </div>
    </div>
</div>