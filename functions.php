<?php
	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'hbd-theme', TEMPLATEPATH . '/languages' );

	add_theme_support( 'menus' );

	//tutvustuse posti kategooria nimi 'tutvustus'	 CUSTOM FIELDI OPTIONS'i PUHUL ON SEAL ID handmade!
	define('TEENUSE_KATEGOORIA', 2);		// Piltide kategooria
	define('TAUST_KATEGOORIA', 4);			// Piltide kategooria
	define('SKPINFO_KATEGOORIA', 7);		// Üks post kategooria,, Kasutan cat nime 'skpinfo'
    define('KAMP_ET', 20);    //eesti keelse kampaania kategooria ID
    define('KAMP_EN', 21);
    define('KAMP_RU', 22);
	//constant('TAUST_POST_ID')

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable($locale_file) )
	    require_once($locale_file);

	// Get the page number
	function get_page_number() {
	    if ( get_query_var('paged') ) {
	        print ' | ' . __( 'Page ' , 'hbd-theme') . get_query_var('paged');
	    }
	} // end get_page_number

	// Custom callback to list comments in the hbd-theme style
	function custom_comments($comment, $args, $depth) {
	  $GLOBALS['comment'] = $comment;
	    $GLOBALS['comment_depth'] = $depth;
	  ?>
	    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
	        <div class="comment-author vcard"><?php commenter_link() ?></div>
	        <div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'hbd-theme'),
	                    get_comment_date(),
	                    get_comment_time(),
	                    '#comment-' . get_comment_ID() );
	                    edit_comment_link(__('Edit', 'hbd-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
	  <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'hbd-theme') ?>
	          <div class="comment-content">
	            <?php comment_text() ?>
	        </div>
	        <?php // echo the comment reply link
	            if($args['type'] == 'all' || get_comment_type() == 'comment') :
	                comment_reply_link(array_merge($args, array(
	                    'reply_text' => __('Reply','hbd-theme'),
	                    'login_text' => __('Log in to reply.','hbd-theme'),
	                    'depth' => $depth,
	                    'before' => '<div class="comment-reply-link">',
	                    'after' => '</div>'
	                )));
	            endif;
	        ?>
	<?php } // end custom_comments

	// Custom callback to list pings
	function custom_pings($comment, $args, $depth) {
	       $GLOBALS['comment'] = $comment;
	        ?>
	            <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
	                <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'hbd-theme'),
	                        get_comment_author_link(),
	                        get_comment_date(),
	                        get_comment_time() );
	                        edit_comment_link(__('Edit', 'hbd-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
	    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'hbd-theme') ?>
	            <div class="comment-content">
	                <?php comment_text() ?>
	            </div>
	<?php } // end custom_pings

	// Produces an avatar image with the hCard-compliant photo class
	function commenter_link() {
	    $commenter = get_comment_author_link();
	    if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
	        $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
	    } else {
	        $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
	    }
	    $avatar_email = get_comment_author_email();
	    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
	    echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
	} // end commenter_link

	// For category lists on category archives: Returns other categories except the current one (redundant)
	function cats_meow($glue) {
	    $current_cat = single_cat_title( '', false );
	    $separator = "\n";
	    $cats = explode( $separator, get_the_category_list($separator) );
	    foreach ( $cats as $i => $str ) {
	        if ( strstr( $str, ">$current_cat<" ) ) {
	            unset($cats[$i]);
	            break;
	        }
	    }
	    if ( empty($cats) )
	        return false;

	    return trim(join( $glue, $cats ));
	} // end cats_meow

	// For tag lists on tag archives: Returns other tags except the current one (redundant)
	function tag_ur_it($glue) {
	    $current_tag = single_tag_title( '', '',  false );
	    $separator = "\n";
	    $tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
	    foreach ( $tags as $i => $str ) {
	        if ( strstr( $str, ">$current_tag<" ) ) {
	            unset($tags[$i]);
	            break;
	        }
	    }
	    if ( empty($tags) )
	        return false;

	    return trim(join( $glue, $tags ));
	} // end tag_ur_it

	// Register widgetized areas
	function theme_widgets_init() {
	    // Area 1
	    register_sidebar( array (
	    'name' => 'Primary Widget Area',
	    'id' => 'primary_widget_area',
	    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
	    'after_widget' => "</li>",
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
	  ) );

	    // Area 2
	    register_sidebar( array (
	    'name' => 'Secondary Widget Area',
	    'id' => 'secondary_widget_area',
	    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
	    'after_widget' => "</li>",
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
	  ) );
	} // end theme_widgets_init

	//add_action( 'init', 'theme_widgets_init' );

	$preset_widgets = array (
	    'primary_widget_area'  => array( 'search', 'pages', 'categories', 'archives' ),
	    'secondary_widget_area'  => array( 'links', 'meta' )
	);
	if ( isset( $_GET['activated'] ) ) {
	    update_option( 'sidebars_widgets', $preset_widgets );
	}
	// update_option( 'sidebars_widgets', NULL );

	// Check for static widgets in widget-ready areas
	function is_sidebar_active( $index ){
	  global $wp_registered_sidebars;

	  $widgetcolums = wp_get_sidebars_widgets();

	  if ($widgetcolums[$index]) return true;

	    return false;
	} // end is_sidebar_active

    // Load jquery
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js", false, null);
	wp_enqueue_script('jquery');
}

	/* Checkib kas lisa blokk eksisteerib, ja siis kuvab selle sisu
	 *
	 *
	 **/
function lisaBlokk($postId, $fieldName) {
	if(get_post_meta($postId, $fieldName, true)) {
		return ( get_post_meta($postId, $fieldName, $single = true) );
	}
}
/* Eemaldab stringis ankru ja paragrafi tähised
   kasutan seda teenuse pildi urli töötlemiseks
   */
function eemaldaAP( $content ) {
    $content =
        preg_replace(array('{<a[^>]*><img}','{/></a>}'), array('<img','/>'), $content);
    $content =
        preg_replace(array('{<p[^>]*><img}','{/></p>}'), array('<img','/>'), $content);
    return $content;
}
	//media taxonomy !! galerii piltide jaoksh...
	/** Register taxonomy for images */
function olab_register_taxonomy_for_images() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init', 'olab_register_taxonomy_for_images' );

/* Now add the category field to the Media Library table.
 * This will also add a filter to the table to allow search of attachments by category.
 * Super useful if you’ve got a bunch of files you need to categorize.
 **/
 /** Add a category filter to images */
function olab_add_image_category_filter() {
    $screen = get_current_screen();
    if ( 'upload' == $screen->id ) {
        $dropdown_options = array( 'show_option_all' => __( 'View all categories', 'olab' ),
								   'hide_empty' => false,
								   'hierarchical' => true,
								   'orderby' => 'name', );
        wp_dropdown_categories( $dropdown_options );
    }
}
add_action( 'restrict_manage_posts', 'olab_add_image_category_filter' );

//media galerii thumbnaili suurus
add_image_size( 'gallaythumb', 290, 290, true );

//info posti muutujatesse kirjutamine...
    $args = array(
                  'post_type'       => 'post',
                  'posts_per_page' => 1,
                  'category_name' => 'skpinfo',
                  );
	$infoVars = array();
	$infoVars[]='inf-enimi';
	$infoVars[]='inf-etel';
	$infoVars[]='inf-email';
	$infoVars[]='inf-eadr';
	$infoVars[]='inf-ereg';
	$infoVars[]='inf-ekmknr';
	$infoVars[]='inf-ehtxt1';
	$infoVars[]='inf-ehtxt2';
	$infoVars[]='inf-ehptxt';

    $infop = new WP_Query( $args );
    if ( $infop->have_posts() ) {
        while ( $infop->have_posts() ) {
            $infop->the_post();
			foreach($infoVars as $id){
				define($id, lisaBlokk($infop->post->ID, $id));
			}
        }
    }
    wp_reset_postdata();

//--------------------


function mb_ucfirst($string, $encoding)
{
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
    return mb_strtoupper($firstChar, $encoding) . $then;
}


//proovin koodi et menüüasjadele data-target lisada
add_filter( 'nav_menu_link_attributes', 'skpmenudata_contact_menu_atts', 10, 3 );

function skpmenudata_contact_menu_atts( $atts, $item, $args )
{
  // The ID of the target menu item
  //$menu_targets1 = array(214,213,215); //teenustelingid MINU LOCALIS
  //$menu_targets2 = array(218,220,221); //Hinnap lingid
  //$menu_targets3 = array(219,222,223); //kontakt
  //$menu_targets1 = array(338,345,346); //teenustelingid AMAZING AMAZING
  //$menu_targets2 = array(341,351,352); //Hinnap lingid
  //$menu_targets3 = array(342,353,354); //kontakt
  $menu_targets1 = array(273,272,263); //teenustelingid AMAZING AMAZING
  $menu_targets2 = array(279,278,267); //Hinnap lingid
  $menu_targets3 = array(281,280,269); //kontakt
  // inspect $item
  foreach($menu_targets1 as $menu_target1){
    if ($item->ID == $menu_target1) {
      $atts['data-targ'] = '#servicesteenused';
      $atts['class'] = 'mnavbtnlink';
    }
  }
  foreach($menu_targets2 as $menu_target2){
    if ($item->ID == $menu_target2) {
      $atts['data-targ'] = '#fcont';
      $atts['class'] = 'mnavbtnlink';
    }
  }
  foreach($menu_targets3 as $menu_target3){
    if ($item->ID == $menu_target3) {
      $atts['data-targ'] = '#kontakt';
      $atts['class'] = 'mnavbtnlink';
    }
  }

  return $atts;
}

//icl_register_string($context, $name, $value)
//$context – the name of the plugin, in a human readable format
//$name – the name of the string which helps the user (or translator) understand what’s being translated.
//$value – the string that needs to be translated
//hilejm use: icl_t($context, $name, $value) => echo icl_t('skptheme', 'tutvustus', 'INTRODUCTION');

icl_register_string('skptheme', 'EsimeneSuurNupp', 'OFFER REAL ESTATE');
icl_register_string('skptheme', 'HinnaparingPealkiri', 'PRICE INQUIRY');
icl_register_string('skptheme', 'KiriSaadetud', 'Your message has been sent. We will contact you within two business days.');
icl_register_string('skptheme', 'TurvakoodEiKlapi', 'The security code you entered does not appear to be correct.');
icl_register_string('skptheme', 'FormValiTeenus', 'Select a suitable service');

icl_register_string('skptheme', 'FormNimi', 'Name');
icl_register_string('skptheme', 'FormTelefon', 'Telephone');
icl_register_string('skptheme', 'FormEpost', 'E-mail');
icl_register_string('skptheme', 'FormKinnistu', 'Name of property');
icl_register_string('skptheme', 'FormVald', 'Rular municipality');
icl_register_string('skptheme', 'FormKyla', 'Village');
icl_register_string('skptheme', 'FormKataster', 'Cadastral register number');
icl_register_string('skptheme', 'FormKommentaarid', 'Remarks');
icl_register_string('skptheme', 'FormSisestaKood', 'Enter the code');
icl_register_string('skptheme', 'FormSaada', 'SEND');
icl_register_string('skptheme', 'FormSulge', 'CLOSE');
icl_register_string('skptheme', 'SoovidMyyaMidagi', 'Are you planning to sell standing timber, a forest property or cutting rights?');
icl_register_string('skptheme', 'SaadaPakkumine', 'SEND OFFER');
icl_register_string('skptheme', 'voiKirjuta', 'or write');
icl_register_string('skptheme', 'tutvustus', 'INTRODUCTION');
//icl_register_string('skptheme', '', '');
//icl_register_string('skptheme', '', '');

// keelte linkida kuvamine
function other_languages(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
        foreach($languages as $l){
            if(!$l['active']){
                echo '<a href="'.$l['url'].'"class="lang-button">';
                echo mb_convert_case($l['language_code'], MB_CASE_UPPER, "UTF-8").' ';
                echo '</a>';
                //print_r($l);
            }
        }
    }
}

?>
