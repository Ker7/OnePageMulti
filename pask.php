//req teenustest



    //the_block("sittkusi");

    //$args = array( 'posts_per_page' => 5, 'offset'=> 1, 'category' => 1 );
//    $args = array(
//	'posts_per_page'   => 64,
//	'offset'           => 0,
//	'category'         => 2,    //category id KONSTANT
//	'orderby'          => 'post_date',
//	'order'            => 'DESC',
//	'include'          => '',
//	'exclude'          => '',
//	'meta_key'         => '',
//	'meta_value'       => '',
//	'post_type'        => 'post',
//	'post_mime_type'   => '',
//	'post_parent'      => '',
//	'post_status'      => 'publish',
//	'suppress_filters' => true );
<?php
    $args = array( 'posts_per_page' => 65, 'offset'=> 1, 'category' => 2 );
    $myposts = get_posts( $args );
    foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
        <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <?php
            [TeenusIkoon]
            echo "jou";
            [TeenusNupuTekst]
            ?>
        </li>
    <?php endforeach;
    wp_reset_postdata();
?>


#pilt
/*    background: url(img/kolmnurgad_vasakul.png) bottom left no-repeat,*/
/*				url(img/kolmnurgad_paremal.png) bottom right no-repeat;*/
/*				/*url(img/back2.jpg) 0px 0px no-repeat*/
/*	@media only screen and (max-width: 1016px) {*/
/*		background: url(img/kolmnurgad_vasakul.png) bottom left no-repeat;*/
/*					/*url(img/back2.jpg) 0px 0px no-repeat;*/
/*    }*/



js backgroundi osa

                //ik = $('#pilt > div.taust').get();
                //jc = $('#pilt > div.taust').children();
                //t1 = $('#pilt > div').lenght;
                //t1 = $('#pilt > div.taust').lenght;
                //$t2 = $('#pilt').children().lenght;
                //t3 = document.getElementById('pilt');
                //n3 = t3.childNodes;

                //console.log('----------------------------');

                //console.log($(j)[0]);
                //console.log($(j)[1]);
                //console.log($(j)[2]);
                //console.log($(j).lenght );



                //for (var i = 0; i<8;i++) {
                //    if ($(j)[i] !== undefined) {
                //        //elem = $(j)[i].css('display');
                //        console.log('on mingi!!'+i);
                //        //console.log('display: '+elem);
                //        //console.log($(j)[i].css('display'));
                //    }
                //    //var node = $(j).get[i];
                //    //console.log($(node));
                //    //console.log(node.nodeName);
                //}


                //console.log('count: '+c);

                //console.log(typeof(t1));
                //console.log(typeof($t2));
                //console.log(typeof(t3));
                //for (var i = 0; i<3;i++) {
                //    if (test) {
                //        //code
                //    }
                //    var node = $(j).get[i];
                //    console.log($(node));
                //    //console.log(node.nodeName);
                //}
                //for (var i = 0; i<t3.childNodes.length;i++) {
                //    var node = t3.childNodes[i];
                //    console.log(i);
                //    console.log(node.nodeName);
                //}
                //console.log(n3);


INDEX.php taust osa kood
        <?php


        //$args = array( 'posts_per_page' => 32, 'category' => constant('TAUST_KATEGOORIA') );
        // WP_Query arguments
        $args = array (
            'post_type'              => 'attachment',
            'post_status'            => array('inherit', 'publish'),
            'category_name'          => 'taustapiltmedia',
            //'cat'                    => '4',
            //'category'                    => '4',
            //'posts_per_page' => 32,
        );

        // The Query
        $myposts = new WP_Query( $args );

        //echo "Count: ".count($myposts);
        //print_r($myposts);

            //$sisu = apply_filters( 'get_the_content', $post->post_content );
            //////////preg_match_all ( '#<img>(.+?)/>#', $sisu, $pildid );
            //$strip = strip_tags($sisu);
            //$jada = explode('/>', $sisu);
            //array_pop($jada);

            //////////print_r($sisu);
            //////////print_r('----------------------');
            //////////print_r($strip);
            //print_r('----------------------');
            //print_r($jada);

        //echo "----------------------------------------Tere Maailm";//.constant('TAUST_POST_ID');
        //print_r($myposts);
        //echo $mypost;
        //echo "Tere Maailm";


        if ( $myposts->have_posts() ) {

            while ( $myposts->have_posts() ) {
                $myposts->the_post();

                echo '<li>' . get_the_title() . '</li>';
                //$r = get_the_content();
                //print_r( $myposts ) ;
                //print_r( array(1, $r) );
                //echo apply_filters( 'get_the_content', $myposts->post_content() );
                print_r('-------------1 ');
                print_r( $myposts->post->guid );
                print_r(' 2--------------');
                //echo '<div class="taust" style="display:'.($k==0?'block':'none').'">'.apply_filters( 'get_the_content', $post->post_content ).'</div>';
            }

        } else {
            // no posts found FIXED PILT
        }

        //foreach ( $myposts as $k => $post ) : setup_postdata( $post );
        //
        //    ////echo '<div class="tsection group">';
            //echo $k;
        //    ////echo '<div class="taust" style="display:'.($k==0?'block':'none').'">'.apply_filters( 'get_the_content', $post->post_content ).'</div>';
        //
        //endforeach;
        wp_reset_postdata();



        ?>



Galerii piltide kırguse suuruse paikaajamine...

$(window).resize(function() {
    //resaisides peaks muutma ka galerii containmenti...
    winw = getW();

    setGalDraggable(false); //false=not first

    //gW=$('#gimg').css('width').replace(/[^-\d\.]/g, '');
    //gH=$('#gimg').css('height').replace(/[^-\d\.]/g, '');

    //gW=$('#gimg').width();

    //gWi=$('#gallayimg').width();
    //console.log(gWi);
    //gx=$('#gimg').width();

    //rat=gW/gH;

    winh = getH();
    gH=$('#gimg').height();
    hspace=winh-100-gH; //see osa on ala pildi alumisest ‰‰rest akna ala‰‰reni, ehk ei tohiks minna neg.

    while (hspace<20) {
        gIw=$('#gallayimg').width()-5;
        $('#gallayimg').width(gIw);
        winh = getH();
        gH=$('#gimg').height();
        hspace=winh-100-gH;
    }

    //console.log(winw+'x'+winh+', gimg: '+gW+'x'+gH+', RAT: '+rat+' extra:'+hspace);

});