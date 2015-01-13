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
                    //.'<div class="teenus-sisu-img">'
                    //    .lisaBlokk($post->ID, 'TeenusPilt')
                    //    //.$post->ID
                    //.'</div>'
                    //.'<div class="teenus-sisu-sisu">'
                    //  //.get_the_content()
                    //  .apply_filters( 'the_content', $post->post_content )
                    //.'</div>'
                    .'<div class="previewTeenus" style="border: blue 1px dashed;
                                                    width: 600px;
                                                    float: left;">'
                        .'<h1 style=" font-size: 24px;
                                    font-weight: 600;
                                    background-color: gray;">'.$postTitle.'</h1>'
                        .'<h5>'.$post->post_date.'</h5>'
                        .apply_filters( 'the_content', $post->post_content )


                    .'</div>'

                    .'<div style="width:300px;
                                  float: left;
                                  background-color: #eee;
                                  border: red 1px dashed;
                                  margin-left: 40px;">'
                    .'<h1 style=" font-size: 24px;
                                    font-weight: 600;
                                    background-color: gray;">Viimased postitused T!</h1>';

    echo $tstring;
                      
                      
                      
$args = array(
              'posts_per_page' => 5,
              'orderby'          => 'post_date',
              'order'            => 'DESC',
              //'offset'=> 1,
              'category' => 24  //WPML abil otsib ka teiste keelte kat'e
              );

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post );
  $ppermalink = get_the_permalink();
  $ttitle = get_the_title();
  //$ddate = get_the_date();
  //$ddate = apply_filters("get_the_date",get_the_date(),get_option("date_format"));
  //$ddate = apply_filters("get_the_date",get_the_date(),"Y m d");
  $ddate = date('d F Y', strtotime(get_the_date()));

  echo '<a style="color:#000" href="' . $ppermalink . '">' . $ttitle . '</a>'
      .'<br />'
      .'<p style="color:green;
                  display: inline-block;" >
                        '.$ddate.'</p> <li style="display: inline-block;
                                                  float: right;">&nbsp</li>'; 


?>
		<!--a href="<?php the_permalink(); ?>"><?php echo get_the_title().'('.apply_filters("get_the_date",get_the_date(),get_option("date_format")).')'; ?></a-->
	<br />
<?php endforeach; 
wp_reset_postdata();
                      
                      
                      
                      
                    $tstring = '</div><!-- sis -->';//'</select>';
                    //smart_archives();
                    //Right Sidebar
                    
                    
                    
        $tstring .= '</div>'

                  //.'</div'
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
                  echo 'LIKE NO-COMMENT SHARE';
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