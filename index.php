<?php get_header(); ?>
    <div id="main">
    <!--div id="taust"></div-->
    <div id="ylariba" >
        <div class="section group">
            <div id="mobile">
                <div id="mnavnimi" class="mbtn col nspan_1_of_4"> <!-- mnavnimi oli ..-->
                    <!--<a href="<?php //echo get_home_url() ?>" class="mbtn">--><!-- //todo lisada koduka URL! -->
                        <div class="logodiv"></div> <!-- retina systeem -->
                        <!--<span class="primtext2"> sakumata </span>-->
                    <!--</a>-->
                </div>

                <div id="mnavkontakt" class="col nspan_2_of_4">
                    <span class="kontblk kontext htel"><?php echo constant('inf-etel') ?></span>
                    <a class="kontblk kontext hemail" href="mailto:<?php echo constant('inf-email') ?>"><?php echo constant('inf-email') ?></a>
                </div>

                <div id="toggle-bar" class="">
                    <!--<strong><a class="mtoggle" href="#">MAIN MENU</a></strong>-->
                    <a class="navicon mtoggle"> </a>
                </div>
            </div>
        </div>

        <div id="mmenu">
            <a data-targ="#teenused" class="mnavbtn mbtn mnb">TEENUSED</a>
            <a data-targ="#tutvustus" class="mnavbtn mbtn">ETTEVÕTTEST</a>
            <a data-targ="#galerii" class="mnavbtn mbtn">GALERII</a>
            <a data-targ="#fcont" class="mnavbtn mbtn">HINNAPÄRING</a>
            <a data-targ="#kontakt" class="mnavbtn mbtn">KONTAKT</a>
        </div>

        <div class="section group">
            <div id="pc">
                <div id="navnimi" class="mbtn col span_1_of_4">
                    <div class="logodiv"></div>
                </div>

                <div id="navkontakt" class="col span_1_of_4">
                    <span class="heleTcol kontblk kontext"><?php echo constant('inf-etel') ?></span>
                    <a class="kontblk kontext hemail" href="mailto:<?php echo constant('inf-email') ?>"><?php echo constant('inf-email') ?></a>
                </div>

                <div id="navnupud" class="col span_2_of_4">
                    <a data-targ="#teenused" class="heleTcol mnavbtn mbtn">TEENUSED</a>
                    <a data-targ="#tutvustus" class="heleTcol mnavbtn mbtn">ETTEVÕTTEST</a>
                    <a data-targ="#galerii" class="heleTcol mnavbtn mbtn">GALERII</a>
                    <a data-targ="#fcont" class="heleTcol mnavbtn mbtn">HINNAPÄRING</a>
                    <a data-targ="#kontakt" class="heleTcol mnavbtn mbtn">KONTAKT</a>
                </div>
            </div>
        </div>
    </div>

    <div id="dragscroll">

    <div id="pilt" class="section group">
        <div id="banner" class="section group mcenter">
            <h2><?php echo constant('inf-ehtxt1') ?></h2>
            <h3><?php echo constant('inf-ehtxt2') ?></h3>
            <div class="rohnupp3" onclick="keriTo('#fcont', 1200)"><p>PAKU KINNISVARA</p></div>
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
        <div id="rkoln"></div>
    </div>

    <div id="teenused">

    <?php require('req-teenused.php'); ?>

    </div>

    <?php
    $argstut = array( 'post_type'   => 'post',
                    'post_status'   => array('inherit', 'publish'),
                   'posts_per_page' => 1,
                   'category_name'  => 'tutvustus', );
    //$mypostst = get_posts( $args );
    //print_r($mypostst);
    //foreach ( $mypostst as $k => $post ) : setup_postdata( $post );
    //
    //    echo '<div id="tutvustus">'
    //            .'<div class="tsection">'
    //                .'<div class="tutspan1">'
    //                    .'<h2>TUTVUSTUS</h2>'
    //                    .'<h3>'.apply_filters( 'get_the_content', $post->post_title ).'</h3>'
    //                    .'</div>'
    //                    .'<div class="tutspan2">'
    //                    .apply_filters( 'the_content', $post->post_content )
    //        .'</div></div></div>';
    //
    //endforeach;
    $myposts = new WP_Query( $argstut );
    //print_r($myposts);
        if ( $myposts->have_posts() ) {
            while ( $myposts->have_posts() ) {
                $myposts->the_post();
                //echo $myposts->post->post_title;
                echo '<div id="tutvustus">'
                        .'<div class="tsection">'
                            .'<div class="tutspan1">'
                                .'<h2>TUTVUSTUS</h2>'
                                .'<h3>'.apply_filters( 'get_the_content', $myposts->post->post_title ).'</h3>'
                                .'</div>'
                                .'<div class="tutspan2">'
                                .apply_filters( 'the_content', $myposts->post->post_content )
                    .'</div></div></div>';
            }
        }
    wp_reset_postdata();
?>
        <!--<table>-->
        <!--    <tr>-->

        <?php
        $args = array (
            'post_type'              => 'attachment',
            'post_status'            => array('inherit', 'publish'),
            'category_name'          => 'galeriipiltmedia',
            'posts_per_page'      => 99,
            'orderby' => 'rand'
        );
        // The Query

        $esimeneGaleriiRida = '';
        $teineGaleriiRida = '';
        //$uploadsUrl = get_bloginfo('template_url').'/wp-content/uploads/';
        $uploadsUrl = get_bloginfo('url').'/wp-content/uploads/';

        $allGalSrc = array();
        $galRow[1] = array();
        $galRow[2] = array();

        $myposts = new WP_Query( $args );
        if ( $myposts->have_posts() ) {
            $k = 0;  //post counter
            $k1= 0;
            $k2= 0;
            while ( $myposts->have_posts() ) {
                $myposts->the_post();
                //$allGalSrc[] = $myposts->post->guid; see on otse postist v kuskilt, kus url peale editimist ei muutu jvm
                //võtan attach ID järgi selle meta, kust saand õige urli + thumbnaili ka

                $imgMeta = wp_get_attachment_metadata( $myposts->post->ID );

                //print_r($myposts->post);
                //print_r($imgMeta);
                $imgCaption = $myposts->post->post_excerpt;//kirjeldustekst mida kuvada

                $fullImgFile = $imgMeta['file'];
                //see leiab img asukohta Upload's kausta suhtes, seal on 'aasta/kuu' vajalik thumbi diri loomiseks
                $thumbRelImgPath =  substr($fullImgFile,0,strpos($fullImgFile, '/', strpos($fullImgFile, '/', 0)+1));

                $fullImgUrl = $uploadsUrl.$fullImgFile;

                $thumbImgUrl = $uploadsUrl.$thumbRelImgPath.'/'.$imgMeta['sizes']['gallaythumb']['file']; //thumbnail 150x medium, gallaythumb on 290x290-max size

                //echo 'UPS-'.$uploadsUrl.'-'.$fullImgFile;
                //praegune VALE!
//[full] => http://localhost/skpinvest/wp-content/themes/skptheme/wp-content/uploads/2014/08/Pilt1613.jpg

                //echo '<br>postID: '.$myposts->post->ID;
                //////print_r( 'file'.$imgFile );
                //echo 'real URL: '.$fullImgUrl.', thumb: '.$thumbImgUrl;
                //print_r($imgMeta);
                $allGalSrc[$k]['full'] = $fullImgUrl;   //fulli ei kauta
                $allGalSrc[$k]['thumb'] = $thumbImgUrl;
                $allGalSrc[$k]['caption'] = $imgCaption;    //pildi tekst
                $allGalSrc[$k]['pid'] = $k; //pildicounteri mille järgi vahetab pilte

                //echo '<div class="galimg"><img  src="'.$myposts->post->guid.'" /></div>';
                //if (($k+1) % 2 != 0) {
                //    //k-0 läheb esimesse ritta, peaks nii olema, edasi 2,4,6..
                //    $esimeneGaleriiRida .= '<div class="tgalimg"><img src="'.$myposts->post->guid.'" /></div>';
                //    //$k1++;
                //} else {
                //    $teineGaleriiRida .= '<div class="tgalimg"><img src="'.$myposts->post->guid.'" /></div>';
                //    //$k2++;
                //}
                $k++;
            }
        } else {
            // no posts found msg?
        }
        //echo "Pilte:".$k;
        wp_reset_postdata();

        $picsC = count($allGalSrc);
        $r1=ceil($picsC/2);
        $r2=$picsC-$r1;
        //echo 'Count: '.$picsC.'r1.: '.$r1.', r2.: '.$r2."\n<br>";

        //WARNING very not OOP style..
        for($v=0; $v<$r1; $v++) {
            $esimeneGaleriiRida .= '<div class="galimg">'
                                    .'<img'
                                    .' data-pid="'.$allGalSrc[$v]['pid'].'"'
                                    .' src="'.$allGalSrc[$v]['thumb'].'"'
									.' alt="'.$allGalSrc[$v]['caption'].'" />'
                                    .'<div class="galimcap"><p>'.$allGalSrc[$v]['caption'].'</p></div>'
                                  .'</div>';
        }

        for($s=$r1; $s<$picsC; $s++) {
            $teineGaleriiRida .= '<div class="galimg">'
                                    .'<img'
                                    .' data-pid="'.$allGalSrc[$s]['pid'].'"'
                                    .' src="'.$allGalSrc[$s]['thumb'].'"'
									.' alt="'.$allGalSrc[$s]['caption'].'" />'
                                    .'<div class="galimcap"><p>'.$allGalSrc[$s]['caption'].'</p></div>'
                                  .'</div>';
        }
        //print_r($allGalSrc);
        //print_r(count($allGalSrc));
        //print_r($esimeneGaleriiRida);
        //print_r($teineGaleriiRida);


        echo '<div id="galcont"><div id="galerii" data-picsintop="'.$r1.'">'
            .'<div class="galrida" >'.$esimeneGaleriiRida.'</div>'  //data-picc="'.$r1.'"
            .'<div class="galrida" >'.$teineGaleriiRida.'</div>'// data-picc="'.$r2.'"   style="top: 290px;"
            .'</div></div><!-- #galerii -->';
        ?>

    <div id="gallay">
        <div id="galblack"></div>

            <div class="spinner">
                <div class="spinner-container container1">
                  <div class="circle1"></div>
                  <div class="circle2"></div>
                  <div class="circle3"></div>
                  <div class="circle4"></div>
                </div>
                <div class="spinner-container container2">
                  <div class="circle1"></div>
                  <div class="circle2"></div>
                  <div class="circle3"></div>
                  <div class="circle4"></div>
                </div>
                <div class="spinner-container container3">
                  <div class="circle1"></div>
                  <div class="circle2"></div>
                  <div class="circle3"></div>
                  <div class="circle4"></div>
                </div>
            </div>

        <div id="gallayimg" class="ppc">
            <?php
            //lisan galeriisse full-piltide scr'd datana
            $fullPicsArray=array();
            $fullPicsArray[] = 'data-pidlast="'.(count($allGalSrc)-1).'" ';
            foreach($allGalSrc as $k => $v) {
                $fullPicsArray[] = 'data-pid-'.$k.'="'.$v['full'].'" ';
            }

            $fullPicsString = implode(' ', $fullPicsArray);

            echo '<img id="gimg" '
                    .$fullPicsString
                    .' src="'.$allGalSrc[3]['full'].'" />'; ?>
            <div id="gallayprev" class="ppc"></div>
            <div id="gallaynext" class="ppc"></div>



        </div>

    </div>

<?php get_footer(); ?>