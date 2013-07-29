var fastButtons = {
	
	replace: function() {
		// copy the current click events on document
		var clickEvents = jQuery.hasData( document ) && jQuery._data( document ).events.click;
		clickEvents = jQuery.extend(true, {}, clickEvents);
		
		// remove these click events
		$(document).off('click');
	
		// reset them as vclick events
		for (var i in clickEvents) {
			$(document).on('vclick', clickEvents[i].handler);
		}
	}
};





// FEED FETCHER

var mastropiero = true;


//CUSTOM////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var screenW;
var blogH;
screenW = $(window).width();
$(document).ready(function() {
// Call fastbuttons and replace all click events with vclick

    fastButtons.replace();

//Height Fix    
    $('[data-role="page"]').removeAttr('style');

    withdCalculator();
 

//BIG NEWS
    bignewsanimate();

    
    
// Link Home Logo
    $(document).on("vclick", ".logoHome", function() {
        $('.flipCurrent').removeClass('flipCurrent');
        $('#blogskl').addClass('flipCurrent');
    });
    $("#flipRoot").flip({
        height: '100.28%'
    });
//    Images Preloader
    $(".loading").krioImageLoader();





    $(document).on('endFlip', function() {
        sliptTitlesHome('#blogskl');
    });


    $('.logo').on('vclick', function() {
        console.log('vuelvo a home y habilito MASTROPIERO');
        $('#home .blank').remove();
        //refreshHome();
        $.removeCookie('view_blog');
        $.removeCookie('view_details');
    });
    
    
    
    $('.btn_share').on('vclick',function(){
        console.log('click comments');
    });

    
    $(window).on('hashchange', function() {
        cambia();
     });
    


});

window.resizeEvt;
$(window).resize(function() {
    clearTimeout(window.resizeEvt);
    window.resizeEvt = setTimeout(function()
    {
        $('[data-role="page"]').removeAttr('style');
        screenW = $(window).width();
       
        if (screenW == '1024') {
            $('[data-role="page"]').removeAttr('style');
            withdCalculator();
            screenW = $(window).width();
           
        } else {
            $('[data-role="page"]').removeAttr('style');
            withdCalculator();
            screenW = $(window).width();
        }
        cambia(); 
    }, 50);
});

// Landscape or Portrait
function withdCalculator() {
    var landscape;
    if (screenW == '1024') {
        landscape = 360;
    } else {
        landscape = 0;
    }
    var wrapperR = screenW - landscape;
    $('.wrapper').width(wrapperR);
    $('.footer').width(wrapperR);
    //console.log(wrapperR);
    var boxRow = 3;
    var boxWidth = (wrapperR / boxRow);
    var box1Width = [(wrapperR / boxRow)] * 2;
    $(".box").width(boxWidth);
    $(".box").height(boxWidth);
    $(".blog1Box").width(box1Width);
    $(".blog1Box").height(box1Width);
}
function withdCalculator1() {
    
	var landscape;
    if (screenW == '1024') {
        landscape = 360;
    } else {
        landscape = 0;
    }
    var wrapperR = screenW - landscape;
    $('.wrapper').width(wrapperR);
    $('.footer').width(wrapperR);
    var boxRow = 3;
    var boxWidth = (wrapperR / boxRow);
    var box1Width = [(wrapperR / boxRow)] * 2;
    $(".box").width(boxWidth);
    $(".box").height(boxWidth);
    $(".blog1Box").width(box1Width);
    $(".blog1Box").height(box1Width);

    fastButtons.replace();
}






//SPLIT TITLES
function sliptTitles(elemento) {
    var title1 = $(elemento).find('.title1');
    var title2 = $(elemento).find('.title2');
    var title1H = title1.height();
    $('.bullet').height(title1H).width(title1H);
    title1.dotdotdot({
        ellipsis: '',
        watch: false,
        //CALLBACK
        tolerance: 0,
        callback: function(isTruncated, orgContent) {
            var firstTitleCount = title1.text().length;
            var secondTitle = orgContent.text().substring(firstTitleCount);
            title2.text(secondTitle);
            if (title2.text() === '') {
                title2.css('display', 'none');
            }
            else {
                title2.css('display', 'block');
                title2.dotdotdot({
                    ellipsis: '...'
                });
            }
        }
    });
}
function sliptTitlesHome(elemento) {
    var title1 = $(document).find(elemento + ' .title1');
    $.each(title1, function() {
        $(this).animate({"opacity": "1"});
        //console.log($(this));
        var title1H = $(this).height();
        $(this).parent('.titleBlog').children('.bullet').height(title1H).width(title1H);
        //console.log(bullet);
        $(this).dotdotdot({
            ellipsis: '',
            watch: false,
            callback: function(isTruncated, orgContent) {
                var firstTitleCount = $(this).text().length;
                var secondTitle = orgContent.text().substring(firstTitleCount);
                var title2 = $(this).parent('.titleBlog').children('.title2');
                title2.text(secondTitle);
                if (title2.text() === '') {
                    title2.css('display', 'none');
                }
                else {
                    title2.css('display', 'block');
                    title2.dotdotdot({
                        ellipsis: '...'
                    });
                }
            }
        });
    });

    $("#feedrss").find('.titleBlog').animate({
        opacity: 1
    }, "slow", function() {

    });

}
function heightBullets(elemento) {
    var title1 = $(elemento).find('.title1');
    $.each(title1, function() {
        var title1H = $(this).height();
        $(this).parent('.titleBlog').children('.bullet').height(title1H).width(title1H);
    });
}


function cambia(){
    var hash = location.hash;
    var hash1 = hash.split('&ui-state=dialog');
    var hash = hash1[1];
    console.log(hash);
    if(hash === undefined){
        console.log('NO HAY POPUP');
    }else{
       var hash1 = hash1[0].split('#details');
       var hash1detail = hash1[0];
       var n = hash1[1]
       console.log(n);
       if(hash1detail === ''){
           console.log('HAY POP UP y es DETALLE') 
         //$('#details'+n+' #popupComment'+n ).popup( "option", "positionTo", "window" );  
         $('#details'+n+' #popupComment'+n ).popup( "open",{
            x:'50%',
            y:'50%'
        });
       }else{
        console.log('HAY POP UP') 
        $('.ui-popup-active .ui-popup' ).popup( "open",{
            x:'50%',
            y:'50%'
        });
       }
    }

}  











//BIG NEWS
function bignewsanimate() {
    bigNewsid();
    bigNewsTitleid();
    animateImgs();
    $(document).bind('endFlip', function() {
        var current = $('#bigNews').hasClass('flipCurrent');
        //console.log(current);
        if (current) {
            animateImgs();
        } else {
            $('.img img').stop();
        }
    });
    function bigNewsid() {
        var bigNews = $('.bigNewsContent .img').find('img');
        var i = 1;
        var zindexBase = 1000;
        $.each(bigNews, function() {
            var img = $(this).attr('id', i);
            var img = $(this).css('z-index', zindexBase);
            //console.log(img);
            i++;
            zindexBase--;
            $(this).hide();
        });
        $('.bigNewsContent .img img:odd').css('left', '-50%'); //PARES
        $('.bigNewsContent .img img:even').css('left', '0%'); //IMPARES
    }
    function bigNewsTitleid() {
        var bigNewsTitles = $('.bigNewsContent .titles').find('div');
        var i = 1;
        var zindexBase = 2000;
        $.each(bigNewsTitles, function() {
            $(this).attr('id', 't' + i);
            $(this).css('z-index', zindexBase);
            i++;
            $('.bigNewsContent .titlesBox').css('z-index', (zindexBase - 1));
            zindexBase + 1;
            zindexBase--;
            $(this).hide();
            var text;
            text = $(this).text();
        });
        bigNewsTextsid();
    }
    function bigNewsTextsid() {
        var bigNewsTitles = $('.bigNewsContent .textBignews').find('p');
        var i = 1;
        var zindexBase = 2000;
        $.each(bigNewsTitles, function() {
            $(this).attr('id', 'text' + i);
            $(this).css('z-index', zindexBase);
            i++;
            zindexBase--;
            $(this).hide();
        });
    }
    function animateImgs() {
        var bigNews = $('.bigNewsContent .img').find('img');
        var i = 0;
        var h = bigNews.length;
        animation(i);
        function animation(i) {
            i++;
            $(this).hide();
            $('.titles div').hide();
            $('#t' + i).fadeIn();
            $('#' + i).fadeIn(3000, function() {
                if (i % 2 !== 0) {
                    $(this).animate({
                        left: '-50%'
                    }, 8000, function() {
                        $(this).fadeOut(3000, function() {
                            $('#t' + i).fadeOut();
                            $(this).hide();
                            $(this).css('left', '0%');
                            if (i !== h) {
                                animation(i);
                            } else {
                                animation(0);
                            }
                        });
                    });
                } else {
                    $(this).animate({
                        left: '0%'
                    }, 8000, function() {
                        $(this).fadeOut(3000, function() {
                            $('#t' + i).fadeOut();
                            $(this).css('left', '-50%');
                            if (i !== h) {
                                animation(i);
                            } else {
                                animation(0);
                            }
                        });
                    });
                }
            });
        }
    }
}
