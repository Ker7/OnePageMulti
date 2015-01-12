            <!--</div><!-- #main -->

                <div id="footer">
                    <div id="fcont">
                        <h2><?php echo icl_t('skptheme', 'HinnaparingPealkiri', 'PRICE INQUIRY'); ?></h2>
                        <p><?php echo constant('inf-ehptxt') ?></p>
                        <div id="form_container">
<?php


//kõigepealt käin teenused läbi ja teen valikute htmli valmis,
$args = array( 'posts_per_page' => 65, 'category' => constant('TEENUSE_KATEGOORIA') );
$myposts = get_posts( $args );
$teenusOptions='';
$valitudTeenuseNimi='';
    foreach ($myposts as $post) : setup_postdata( $post );
        $sel = '';
        if (isset($_POST['teenusmenu'])) {
            if ($_POST['teenusmenu']==$post->ID) {
                $valitudTeenuseNimi=apply_filters( 'get_the_content', $post->post_title );
                $sel = 'selected';
            }
        }
        //$sel = $_POST['teenusmenu']==$post->ID?'selected':'';
        $teenusOptions .= '<option class="topt" value="'.$post->ID.'" '.$sel.' >'.apply_filters( 'get_the_content', $post->post_title ).'</option>';
    endforeach;


$captcha_correct = false; //set it to false until proven true
$sent=false;

//require_once(ABSPATH . 'wp-admin/admin.php'); //include the WordPress admin functions file
//if (is_plugin_active(plugin_basename('really-simple-captcha/really-simple-captcha.php'))) { //check if the plugin is installed and active
    if (class_exists('ReallySimpleCaptcha')) { //check if the Really Simple Captcha class is available
        //echo 'class-exists';
        $captcha = new ReallySimpleCaptcha();

        if (!empty($_POST)) { //data has been posted by the user, lets check whats going on
            if ($captcha -> check($_POST['captcha_prefix'], $_POST['captcha_code'])) {
                $captcha_correct = true; //the captcha has been proven as correct


                //saada mail
                $let_from = "SKPWood";
                $let_to = get_option( 'admin_email' );
                $let_title = 'SKP Webmail';
                $let_bodyun = 'Teenus: '. $valitudTeenuseNimi . "\r\n"
                .'Nimi: '.$_POST['fel1'] . "\r\n"
                .'Telefon: '.$_POST['fel2'] . "\r\n"
                .'E-post: '.$_POST['fel3'] . "\r\n"
                .'Kinnistu nimi: '.$_POST['fel4'] . "\r\n"
                .'Vald: '.$_POST['fel5'] . "\r\n"
                .'Küla: '.$_POST['fel6'] . "\r\n"
                .'Katastritunnus: '.$_POST['fel7'] . "\r\n"
                .'Kommentaarid: '.$_POST['fel8'];
                $let_bodyenc = base64_encode($let_bodyun);

                $let_headers = 	""
                        . "From:" . $let_from . "\r\n"
                        . "MIME-Version: 1.0\r\n"
                        . "Content-type: text/plain\r\n"     //; charset=iso-8859-1
                        . "Content-Transfer-Encoding: base64\r\n";
                mail($let_to, $let_title, $let_bodyenc, $let_headers);

				echo "<script type='text/javascript'>delayMsg('".icl_t('skptheme', 'KiriSaadetud', 'Your message has been sent. We will contact you within two business days.')."', 1000);</script>";
                $_POST = array();
                $sent=true;

            } else {
                //postis on kiri, aga kaptcha ei matchi, tuleb teha uus kaptcha
				echo "<script type='text/javascript'>keriTo('#form_container', 1000); delayMsg('".icl_t('skptheme', 'TurvakoodEiKlapi', 'The security code you entered does not appear to be correct.')."', 1000);</script>";
            }
        }
        if ($captcha_correct == false) {
            $captcha_word = $captcha -> generate_random_word(); //generate a random string with letters
            $captcha_prefix = mt_rand(); //random number
            $captcha_image = $captcha -> generate_image($captcha_prefix, $captcha_word); //generate the image file. it returns the file name
            $captcha_file = rtrim(get_bloginfo('wpurl'), '/') . '/wp-content/plugins/really-simple-captcha/tmp/' . $captcha_image; //construct the absolute URL of the captcha image
        }
    }
//}

        echo    '<form id="teenusform" name="teenusform" method="post" action="#">
                    <div class="form-block">
                        <div class="fcol fcol1">
                            <select id="teenusmenu" name="teenusmenu" class="felem valiteenus" >';
        echo '<option class="topt" value="0" >'.icl_t('skptheme', 'FormValiTeenus', 'Select a suitable service').'</option>';

        //echo 'asddd'.$_POST['teenusmenu'];
        echo $teenusOptions;
$vel1= (isset($_POST['fel1'])?esc_attr(stripslashes($_POST['fel1'])):'');
$vel2= (isset($_POST['fel2'])?esc_attr(stripslashes($_POST['fel2'])):'');
$vel3= (isset($_POST['fel3'])?esc_attr(stripslashes($_POST['fel3'])):'');
$vel4= (isset($_POST['fel4'])?esc_attr(stripslashes($_POST['fel4'])):'');
$vel5= (isset($_POST['fel5'])?esc_attr(stripslashes($_POST['fel5'])):'');
$vel6= (isset($_POST['fel6'])?esc_attr(stripslashes($_POST['fel6'])):'');
$vel7= (isset($_POST['fel7'])?esc_attr(stripslashes($_POST['fel7'])):'');
$vel75= (isset($_POST['fel75'])?esc_attr(stripslashes($_POST['fel75'])):'');
$vel8= (isset($_POST['fel8'])?esc_attr(stripslashes($_POST['fel8'])):'');

        echo    '</select>
                    </div>
                    <div class="fcol fcol2">
                        <input id="fel1" name="fel1" class="felem" type="text" maxlength="255" value="'. $vel1 .'" spellcheck="false" placeholder="'.icl_t('skptheme', 'FormNimi', 'Name').'"/>
                    </div>
                    <div class="fcol fcol3">
                        <input id="fel2" name="fel2" class="felem" type="text" maxlength="255" value="'. $vel2 .'" spellcheck="false" placeholder="'.icl_t('skptheme', 'FormTelefon', 'Telephone').'"/>
                    </div>
                    <div class="fcol fcol4">
                        <input id="fel3" name="fel3" class="felem" type="text" maxlength="255" value="'. $vel3 .'" spellcheck="false" placeholder="'.icl_t('skptheme', 'FormEpost', 'E-mail').'"/>
                    </div>
                    <div class="fcol fcol5">
                        <input id="fel4" name="fel4" class="felem" type="text" maxlength="255" value="'. $vel4 .'" spellcheck="false" placeholder="'.icl_t('skptheme', 'FormKinnistu', 'Name of property').'"/>
                    </div>
                </div>
                <div class="form-block">
                    <!-- brk -->
                    <div class="fcol fcol6">
                        <input id="fel5" name="fel5" class="felem" type="text" maxlength="255" value="'. $vel5 .'" spellcheck="false" placeholder="'.icl_t('skptheme', 'FormVald', 'Rular municipality').'"/>
                    </div>
                    <div class="fcol fcol7">
                        <input id="fel6" name="fel6" class="felem" type="text" maxlength="255" value="'. $vel6 .'" spellcheck="false" placeholder="'.icl_t('skptheme', 'FormKyla', 'Village').'"/>
                    </div>
                    <div class="fcol fcol8">
                        <input id="fel7" name="fel7" class="felem" type="text" maxlength="255" value="'. $vel7 .'" spellcheck="false" placeholder="'.icl_t('skptheme', 'FormKataster', 'Cadastral register number').'"/>
                    </div>
                    <div class="fcol fcol85">
                        <input id="fel75" name="fel75" class="felem" type="text" maxlength="255" value="'. $vel75 .'" spellcheck="false" placeholder="'.icl_t('skptheme', 'FormHind', 'Price offer').'"/>
                    </div>
                    <div class="fcol fcol9">
                        <textarea id="fel8" name="fel8" class="felem" type="text" maxlength="255" spellcheck="false" placeholder="'.icl_t('skptheme', 'FormKommentaarid', 'Remarks').'" >'.$vel8 .'</textarea>
                    </div>
                </div>';

//if ( !empty($_POST) ) :
//    echo '<p>The captcha code you filled in is correct!<p>';
//endif;
if ($sent==false) {
    echo '<div class="capfloat">'
          .'<div class="capcont">'
            .'<img class="bCapImg" src="'.$captcha_file.'" />'
            .'<input class="cap" type="text" name="captcha_code" placeholder="'.icl_t('skptheme', 'FormSisestaKood', 'Enter the code').'" value="" spellcheck="false" />'
            .'<input type="hidden" name="captcha_prefix" value="'. $captcha_prefix .'" />'
          .'</div>'
        .'</div>';
}
            echo '<input type="hidden" name="form_id" value="teenusform" />
                <div class="fsubmit">
                    <input id="saada" class="button_text rohnupp" type="submit" name="submit" value="'.icl_t('skptheme', 'FormSaada', 'SEND').'" />
                </div>

            </form>';
?>
                        </div><!-- form cont -->
                    </div><!-- fcont -->

                    <div id="colophon">

                        <div id="kontakt">
                            <?php
                            echo '<p>'.constant('inf-enimi').'</p>'
                                .'<p>'.constant('inf-eadr').'</p>'
                                .'<p>'.constant('inf-ereg').'</p>'
                                .'<p>'.constant('inf-ekmknr').'</p>'
                                .'<p>'.constant('inf-etel').'</p>'
                                .'<p>'.constant('inf-email').'</p>';
                            ?>
                        </div><!-- #kontakt -->
                    </div><!-- #colophon -->
                </div><!-- #footer -->
            </div><!-- #dragscroll -->
            </div><!-- main -->
        </div><!-- #pwrap -->
      </div>
        <?php wp_footer(); ?>
    </body>
</html>