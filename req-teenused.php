<div>
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

    global $post;
    $args = array( 'posts_per_page' => 65, 'category' => constant('TEENUSE_KATEGOORIA') );
    $myposts = get_posts( $args );

    $postCount = count($myposts);

//echo "Post1 ID (16): ";
//echo apply_filters( 'get_the_content', $myposts[1]->ID );
//echo '<br />';

//echo "Poste: ".$postCount.'<br />';
//var_dump($myposts);
    foreach ( $myposts as $k => $post ) : setup_postdata( $post );
        //echo "-------------------------------------------";
        //echo 'Post: '.($k).'<br />';

        $algusTag = ($k % 3 == 0);
        $lopuTag = (($k % 3 == 2) || ($k+1 == $postCount));

        //echo ($algusTag?'rea-esimene<br />':'');
        //echo ($lopuTag?'rea-viimane<br />':'');
        //Hakkan posti kuvama
        if ($algusTag) {
            echo '<div class="tsection group">';
        }
        ///// SISU OSA
        //print_r($post);
            echo '<div class="col span_1_of_3">'
                    //.'<a class="nulllink" href="'.get_site_url().'?p='.$post->ID.'">' //tahan nime järgi linkida
                    .'<a class="nulllink" href="'.get_site_url().'/'.$post->post_name.'">'
                      .'<div class="tn-img tcol tspan_1_of_4">'
                        .'<div class="tn-regImg">'.eemaldaAP(lisaBlokk($post->ID, "TeenusIkoon")).'</div>'
                        .'<div class="tn-hovImg" style="display: none;">'.eemaldaAP(lisaBlokk($post->ID, "TeenusIkoonHover")).'</div>'
                      .'</div>'
                    .'</a>'
                        .'<div class="tn-cont tcol tspan_3_of_4">'
                            .'<a class="headlink" href="'.get_site_url().'/'.$post->post_name.'">'.'<h3>'.mb_strtoupper(apply_filters( 'get_the_content', $post->post_title )).'</h3></a>'
                            //.'<p>'.apply_filters( 'get_the_content', $post->post_content ).'</p>' //vanas oli posti sisu ka tutv. tekst
                            //.'<p>'.lisaBlokk($post->ID, "TeenusTekstLyhike").'</p>' // x-formattinguga õige asi
                            //.'<p>'.apply_filters( 'the_content', lisaBlokk($post->ID, "TeenusTekstLyhike") ).'</p>'
                            .'<p>'.lisaBlokk($post->ID, "TeenusTekstLyhike").'</p>'

                            //.'<p>'.get_the_title().'</p>'
                            .'<a onclick="preT('.($k+1).');">'.lisaBlokk($post->ID, "TeenusNupuTekst").' ></a>'
                        .'</div>'
                        .'<div class="tblock"> </div>'
                    //.'</div>'
                .'</div>';
        //// SISU LOPP
        if ($lopuTag) {
            echo '</div>';
        }
    endforeach;
    wp_reset_postdata();
?>
</div>

<div id="saadapakkumine" class="center">
    <div class="spcont">
        <div class="spbl1">
            <p>Soovid müüa kinnisvara või raieõigust?</p>
        </div>
        <div class="spbl2">
            <div class="rohnupp2 mcenter" onclick="keriTo('#fcont', 1200)"><p>SAADA PAKKUMINE</p></div>
            <div class="sptekst2">
                <span>või kirjuta </span>
                <a class="" href="mailto:<?php echo constant('inf-email') ?>"><?php echo constant('inf-email') ?></a>
            </div>
        </div>
    </div>
</div>
