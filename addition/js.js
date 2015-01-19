menuSlideSpeed = 250;   //mobile drop down menüü langemis/tousmise kiiru
galImageClickable = true;   //kui pikka aega dragida pole enam click toimif

jQuery(document).ready(function($) {

    console.log("JQ Document Ready!");

    $("#mmenu").hide();

    setInterval( function() {
        swapBack();
    }, 8000
    );

    $(".mnavbtnlink").click(function() {    //mobile nav pressed
        killGallery();
        $("#mmenu").slideToggle(menuSlideSpeed);   //fade-out mobile nav
        var target = $(this).data("targ"); //Get the target

        if (undefined != target) {  //If link is to another page, then there might not be data-targ
          $('html, body').animate({
              scrollTop: $(target).offset().top - 80
          }, 1200);
        }

    });

    $(".mtoggle").click(function() {    // YLEVAL PAREMAL nurgas nupp
            killGallery();
        $("#mmenu").slideToggle(menuSlideSpeed);
        $(".navicon").css("border-color","#4BA000");
        $(".naviconTume").css("border-color","#4BA000");

        //bootbox.alert("Hello world!");
        setTimeout(function() {
            $(".navicon").css("border-color","#202F38");
            $(".naviconTume").css("border-color","#919ba2");
        }, 300);
    });

    //kodunupp viiib ylesse
    $(".logodiv").click(function() {
            killGallery();
        $("html, body").animate({
            scrollTop: 0}, 1200);
    });

    setGalDraggable(true);//true=first!

    $('.galimg').click(
        function(){
            if ($('#galerii').hasClass('noclick')) {
                $('#galerii').removeClass('noclick');
            } else {
                pid = $(this).find('img').data('pid');
                changeGallayImage(pid);
                $('#gallay').css('display', 'block');
            }
        }
    );

    $('#gallayprev').click(
        function() {
            pid=findPid(1);
            changeGallayImage(pid);
        });
    $('#gallaynext').click(
        function() {
            pid=findPid(0);
            changeGallayImage(pid);
        });

    $("html").keyup(function(e)
    {
            if (e.keyCode == 37)
            {
                pid=findPid(1);
                changeGallayImage(pid);
            }
            if(e.keyCode==39)
            {
                pid=findPid(0); //NEXT
                changeGallayImage(pid);
            }
    });

    $('#galblack').click(
        function() {
            killGallery();
        });
    $('#gimg').click(
        function() {
            killGallery();
        });

    //KUi olen teenuste lehed ja leht on laetud, sean hover img teenustele
    //samasse elementi olen display:none'na lisanud hover img, mille src lisatakse hoveriks
    $('.ttblok').each(function(){
        //$(this).data('wercqwa4W', '123123123');
        imgObj = $(this).children('img');

        rim = imgObj.attr('src');
        him = $(this).find('.teenus-hover-holder').find('img').attr('src');

        imgObj.data('ddreg', rim);
        imgObj.data('ddhov', him);
      });

    $('.ttblok').hover(function(){

        imgObj = $(this).children('img');
        him = imgObj.data('ddhov');

        imgObj.attr('src', him);
    },function(){
        imgObj = $(this).children('img');
        rim = imgObj.data('ddreg');

        imgObj.attr('src', rim);
    });

    // pealehe teenuste hover, .tn-img sees on img elemendid, millest hovImg display=none alguses
    $('.tn-img').hover(function(){
        $(this).children('.tn-regImg').hide();
        $(this).children('.tn-hovImg').show();
    },function(){
        $(this).children('.tn-regImg').show();
        $(this).children('.tn-hovImg').hide();
    });
    
    //Kui Blogi Arhiivis aasta peale klikitakse, siis selle aasta konteineri .amb (Kuud) classiga laste display'd toggletakse
    $('.ayb-name').click(function(){
        $(this).toggleClass('aybgreen');
        $(this).parent().children('.amb').toggle();
    });
        
    //Kui Blogi Arhiivis kuu peale klikitakse, siis selle aasta konteineri .att (Postituste pealkirjad) classiga laste display'd toggletakse
    $('.amb-name').click(function(){
        $(this).toggleClass('ambold');
        $(this).parent().children('.att').toggle();
    });
});




$(window).resize(function() {
    //resaisides peaks muutma ka galerii containmenti...
    winw = getW();

    setGalDraggable(false); //false=not first

    fitGallayImage();
});

killGallery = function() {
    $('#gallayimg').css('opacity', '0');
    setTimeout( function(){ xGal(); }, 250);
}
xGal = function() { $('#gallay').css('display', 'none'); }

/* Annan pildi ID ja vahetab galerii img ära
 *
 * Pildi elemendis on kirjas:
 *  ID - pildi src
 *  hetke pID, tekib esimesele pildile klikkides, "pidcur"
 *  viiase pildi id, esimene on 0, viimane on "pidlast"
 *
 */
changeGallayImage = function(pid) {
//console.log('changeGallayImage');
    $('#gallayimg').css('opacity', '0');
    $('.spinner').css('display', 'block');

    setTimeout( function(){ swapGallayImage(pid); }, 250);
}

swapGallayImage = function(pid) {
    srcc = $('#gimg').data('pid-'+pid);//ID järgi galeriis on kirjas juba data-pid-ID = SRC
    $('#gimg').attr('src', srcc);// = srcc;
    $('#gimg').data('pidcur', pid);// = srcc;
    $('#gimg').load( function(){ fitGallayImage(); } ); //kui pilt on laetud alles siis edasi...
    //setTimeout( function(){ fitGallayImage(); }, fitImageTimeout);
}

fitGallayImage = function() {
    //console.log('fitGallayImage');
            $('#gallayimg').width('74%');   // Testin siin tagasi suureks venitamist

    winh = getH();
    gH=$('#gimg').height();
    hspace=winh-100-gH; //see osa on ala pildi alumisest äärest akna alaääreni, ehk ei tohiks minna neg.

    while (hspace<20) {
        gIw=$('#gallayimg').width()-5;      //uus kõrgus mis võiks sobida... ei saa calcida
        $('#gallayimg').width(gIw);
        winh = getH();
        gH=$('#gimg').height();
        hspace=winh-100-gH;
    //console.log('|');
    }


            $('#gallayimg').css('opacity', '1');
            $('.spinner').css('display', 'none');
}

/* Otsib galerii datast eelmise(arg-0) või järgmise(arg-1) pildi ID
 */
findPid = function(next) {
    cur = $('#gimg').data('pidcur');
    lst = $('#gimg').data('pidlast');
    if (next == 1) {
        if (cur == 0) {
            pid=lst;
        } else {
            pid = cur - 1;
        }
    } else {
        if (cur == lst) {
            pid=0;
        } else {
            pid = cur + 1;
        }
    }
    return pid;
}

setGalDraggable = function(first) {
    galtag = '#galerii';

    a = $(galtag).length;
    if (a == 0) {
      return;
    }
    //console.log(a);

    picdim = $('.galimg').css('width').replace(/[^-\d\.]/g, '');   //pildi kylg leida!!!
    pics = $(galtag).data('picsintop');

    widC = $('#galcont').width();

    winW = getW();
    vahe = (winW - widC)/2;
    pwx = pics * picdim - widC - 17;

    if (first) {
        $(galtag).udraggable({
    //otsi lehe laius, ja php'ga pane datasee kaasa mitu pilti - ehk kui palju kerida voib..
            start: function(event, ui) {    //jQ UI'ga oli ", ui" peale eventi
                $(this).addClass('noclick');
            },
            containment :   [-pwx,0,0,0],
            axis        :   'x',
            delay       :   300,
            distance    :   30,
            handle      :   '.galimg'
            ,stop        :   function(event, ui) {
                // event.toElement is the element that was responsible
                // for triggering this event. The handle, in case of a draggable.
                $( event.toElement ).one('click', function(e){ e.stopImmediatePropagation(); } );
            }
        });
    } else {
        $(galtag).udraggable(
                //'option', 'containment', [(-pwx),0,(vahe-17),0]
                'option', 'containment', [-pwx,0,0,0]
        );
    }
}

getW = function() {
    var w=window,
    d=document,
    e=d.documentElement,
    g=d.getElementsByTagName('body')[0],
    x=w.innerWidth||e.clientWidth||g.clientWidth,
    y=w.innerHeight||e.clientHeight||g.clientHeight;
    return x;
}

getH = function() {
    var w=window,
    d=document,
    e=d.documentElement,
    g=d.getElementsByTagName('body')[0],
    x=w.innerWidth||e.clientWidth||g.clientWidth,
    y=w.innerHeight||e.clientHeight||g.clientHeight;
    return y;
}

/* sätib galerii kõrguse vastavalt laiusele, teha alguses ja resizemisel */
galW = function() {
    $('#galerii').css('height', getW()/2 );
    $('.galimg').css('height', $(this).css('width') );
}

/* Teenuse lingi onclik, kerib alla vormijuurde ja teeb seal valiku 'ra */
preT = function(itemToSelect){
    var myDropdownList = document.teenusform.teenusmenu;//.teenusmenu;//document.form_880402.teenusmenu;

    if (typeof myDropdownList.options[itemToSelect] !== 'undefined') {
        document.teenusform.teenusmenu.options[itemToSelect].selected = true;
//console.log('selected: '+itemToSelect);
        $('html, body').animate({
        scrollTop: $('#teenusform').offset().top -80
    }, 800);
    } else {
//console.log('undefined reference: '+itemToSelect);
    }
}

/* Kerib elemendi juurde - elementTo
 * scrSpd MS palju aega kulub selleks
 * yOffSet nõks yles/alla
 *
*/
keriTo = function(elementTo, scrSpd, yOffSet) {
    //default param. defineerimine
    scrSpd = (typeof scrSpd === "undefined") ? 1200 : scrSpd;
    yOffSet = (typeof yOffSet === "undefined") ? 0 : yOffSet;
    $('html, body').animate({
        scrollTop: $(elementTo).offset().top - 80 + yOffSet
    }, scrSpd);
}

/* kustutada vist see */
suffleTaust = function() {
    $('html, body').animate({
        scrollTop: $(elementTo).offset().top
    }, 1200);
}

function setBackground() {
    ww = $(window).width();
    cssString = "";
    if (ww>1016) {
        $("#pilt").css('background','url(wp-content/themes/skptheme/img/kolmnurgad_vasakul.png) bottom left no-repeat,'
                       +'url(wp-content/themes/skptheme/img/kolmnurgad_paremal.png) bottom right no-repeat');
    } else {
        $("#pilt").css('background','url(wp-content/themes/skptheme/img/kolmnurgad_vasakul.png) bottom left no-repeat');
    //console.log("suurem"+ww);
    }
}

// This code is from http://andylangton.co.uk/articles/javascript/get-viewport-size-javascript/
// http://stackoverflow.com/questions/11309859/css-media-queries-and-javascript-window-width-do-not-match
function viewport() {
    var e = window, a = 'inner';
    if (!('innerWidth' in window )) {
        a = 'client';
        e = document.documentElement || document.body;
    }
    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
}

//Tausta arvamisel
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

//Tausa vahetamine
function swapBack() {   // 1 #PILT > div.taust peab olema opacity:1'ga
    prevN=-1;   //res def
    newN=-2;
    i = $('#piltTume > div.taust'); //taustad on juba dommis
    iC = i.length;
    if (i.length>0) {
      j = i;
    } else {  //tumedaid taustu pole, seega heledad...
      j = $('#pilt > div.taust');
    }
    jC = j.length;
    c=0;    //count imgs
    nn=0;   //tsyki counter
    $(j).each(function() {  //Esimene pilt on juba valitud visible PHP's, otsin selle yles siin
        c++;    //et salvestada 'eelmine pildi id(0,1,2..)'
        if ($(this).css('opacity') > '0.9') {    //('display') == 'block')
            prevN=nn;
        }
        nn++;
    });
    n=c-1;  //count alates 0'st
    if (prevN == -1) {
        return ;
    }

    if (c<2) {
        return ;
    }
    if (c==2) {     //kui 2 tausta siis swapib aind
        newN=1-prevN;
    } else {
        newN=getRandomInt(0,n);

        var steps=0;    //et segi ei läheks
        while (newN == prevN) {
            newN=getRandomInt(0,n); //uus õnnelik pilt
            steps++;
            if (steps>8) {
                return ;
            }
        }
    }
    cc=0;   //uue tsykli counter...
    $(j).each(function() {
        if (cc == newN) {
            $(this).css('opacity', '1');
        } else {
            $(this).css('opacity', '0');
        }
        cc++;
    });
}