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
var gfeedfetcher_loading_image = "indicator.gif" //Full URL to "loading" image. No need to config after this line!!
var mastropiero = true;
google.load("feeds", "1") //Load Google Ajax Feed API (version 1)
function gfeedfetcher(divid, divClass, linktarget) {
    this.linktarget = linktarget || "" //link target of RSS entries
    this.feedlabels = [] //array holding lables for each RSS feed
    this.feedurls = []
    this.feeds = [] //array holding combined RSS feeds' entries from Feed API (result.feed.entries)
    this.feedsfetched = 0 //number of feeds fetched
    this.feedlimit = 5
    this.showoptions = "" //Optional components of RSS entry to show (none by default)
    this.sortstring = "date" //sort by "date" by default
    //document.write('<div id="'+divid+'" class="'+divClass+'"></div>') //output div to contain RSS entries
    //this.feedcontainer=document.getElementById(divid)
    this.itemcontainer = "<li>" //default element wrapping around each RSS entry item
}
gfeedfetcher.prototype.addFeed = function(label, url) {
    this.feedlabels[this.feedlabels.length] = label
    this.feedurls[this.feedurls.length] = url

}
gfeedfetcher.prototype.filterfeed = function(feedlimit, sortstr) {
    this.feedlimit = feedlimit
    if (typeof sortstr != "undefined")
        this.sortstring = sortstr
}
gfeedfetcher.prototype.displayoptions = function(parts) {
    this.showoptions = parts //set RSS entry options to show ("date, datetime, time, snippet, label, description")
}
gfeedfetcher.prototype.setentrycontainer = function(containerstr) {  //set element that should wrap around each RSS entry item
    this.itemcontainer = "<" + containerstr.toLowerCase() + ">"
}
gfeedfetcher.prototype.init = function() {
    this.feedsfetched = 0 //reset number of feeds fetched to 0 (in case init() is called more than once)
    this.feeds = [] //reset feeds[] array to empty (in case init() is called more than once)
    //this.feedcontainer.innerHTML='<p><img src="'+gfeedfetcher_loading_image+'" /> Retrieving RSS feed(s)</p>'
    var displayer = this
    
    for (var i = 0; i < this.feedurls.length; i++) { //loop through the specified RSS feeds' URLs
        var items_to_show = (this.feedlimit <= this.feedurls.length) ? 1 : Math.floor(this.feedlimit / this.feedurls.length) //Calculate # of entries to show for each RSS feed
        if (this.feedlimit % this.feedurls.length > 0 && this.feedlimit > this.feedurls.length && i == this.feedurls.length - 1) //If this is the last RSS feed, and feedlimit/feedurls.length yields a remainder
            items_to_show += (this.feedlimit % this.feedurls.length) //Add that remainder to the number of entries to show for last RSS feed
        var feedpointer='';
        if (navigator.onLine){
	        feedpointer = new google.feeds.Feed(this.feedurls[i]) //create new instance of Google Ajax Feed API
	        feedpointer.includeHistoricalEntries();
	        feedpointer.setNumEntries(items_to_show) //set number of items to display	       
	        feedpointer.load(function(label,i) {	        	 
	            return function(r) {	            	
	            	var thisfeed = (!r.error) ? r.feed.entries : "" //get all feed entries as a JSON array or "" if failed
	            		for (var d = 0; d < thisfeed.length; d++) { //For each entry within feed
	            	        r.feed.entries[d].ddlabel = label //extend it with a "ddlabel" property
	            	    }
	            	
	                displayer._fetch_data_as_array(thisfeed,i);
	            }
	        }(this.feedlabels[i],i)) //call Feed.load() to retrieve and output RSS feed.
        }else{
        	displayer._fetch_data_as_array('',i);
        }
    }
}
gfeedfetcher._formatdate = function(datestr, showoptions) {
    var itemdate = new Date(datestr)
    var parseddate = (showoptions.indexOf("datetime") != -1) ? itemdate.toLocaleString() : (showoptions.indexOf("date") != -1) ? itemdate.toLocaleDateString() : (showoptions.indexOf("time") != -1) ? itemdate.toLocaleTimeString() : ""
    return "<span class='datefield'>" + parseddate + "</span>"
}
gfeedfetcher._sortarray = function(arr, sortstr) {
    var sortstr = (sortstr == "label") ? "ddlabel" : sortstr //change "label" string (if entered) to "ddlabel" instead, for internal use
    if (sortstr == "title" || sortstr == "ddlabel") { //sort array by "title" or "ddlabel" property of RSS feed entries[]
        arr.sort(function(a, b) {
            var fielda = a[sortstr].toLowerCase()
            var fieldb = b[sortstr].toLowerCase()
            return (fielda < fieldb) ? -1 : (fielda > fieldb) ? 1 : 0
        })
    }
    else { //else, sort by "publishedDate" property (using error handling, as "publishedDate" may not be a valid date str if an error has occured while getting feed
        try {
            arr.sort(function(a, b) {
                return new Date(b.publishedDate) - new Date(a.publishedDate)
            })
        }
        catch (err) {
        }
    }
}

gfeedfetcher.prototype._fetch_data_as_array = function(thisfeed,j) {
    if (thisfeed == "") { //if error has occured fetching feed
    	var retrievedObject = JSON.parse(localStorage.getItem('listBlogObject'+j));
    	if(retrievedObject==null){
    		alert("Some blog posts could not be loaded: ");			
			return false;
    	}else{
    		thisfeed=retrievedObject;
    	}
    }else{
    	
    	localStorage.setItem('listBlogObject'+j, JSON.stringify(thisfeed));
    }
    
    //console.log(thisfeed);
    this.feeds = this.feeds.concat(thisfeed) //add entry to array holding all feed entries
    this._signaldownloadcomplete() //signal the retrieval of this feed as complete (and move on to next one if defined)
}

gfeedfetcher.prototype._signaldownloadcomplete = function() {
    this.feedsfetched += 1
    if (this.feedsfetched == this.feedurls.length) //if all feeds fetched
        this._displayresult(this.feeds) //display results
}
gfeedfetcher.prototype._displayresult = function(feeds) {
	
    var rssoutput = (this.itemcontainer == "<li>") ? "<ul>\n" : ""
    gfeedfetcher._sortarray(feeds, this.sortstring)
    
    
    
    
    for (var i = 0; i < feeds.length; i++) {
    	var itemdescription = /description/i.test(this.showoptions) ? "<br />" + feeds[i].content : /snippet/i.test(this.showoptions) ? "" + feeds[i].contentSnippet : ""
        if (i == 0) {
            rssoutput += '<div id="blog' + (i + 1) + '" class="box blog1Box"><div class="boxInner"><a href="javascript:viewBlog(\'' + this.feeds[i].ddlabel["url"] + '\', \' ' + this.feeds[i].ddlabel["hastag"] + ' \');" data-transition="slidefade" class="linkBlog"></a>    <img src="' + this.feeds[i].ddlabel["img"] + '"><div class="titleBlog"><img src="img/bullet_titleBlog.png" class="bullet" /><h1 class="title1">' + this.feeds[i].ddlabel["name"] + '</h1><h1 class="title2"></h1><div class="desc"><h2>' + itemdescription + '</h2></div></div></div></div>';
        } else {
            rssoutput += '<div id="blog' + (i + 1) + '" class="box blogBox"><div class="boxInner"><a href="javascript:viewBlog(\'' + this.feeds[i].ddlabel["url"] + '\', \' ' + this.feeds[i].ddlabel["hastag"] + ' \')" data-transition="slidefade" class="linkBlog"></a>    <img src="' + this.feeds[i].ddlabel["img"] + '"><div class="titleBlog"><img src="img/bullet_titleBlog.png" class="bullet" /><h1 class="title1">' + this.feeds[i].ddlabel["name"] + '</h1><h1 class="title2"></h1><div class="desc"><h2>' + itemdescription + '</h2></div></div></div></div>';
        }

        var blogName = this.feeds[i].ddlabel["name"];

    }
    
    $("#feedrss").css('opacity', '0');
    
    $("#feedrss").html(rssoutput);




    $("#feedrss").animate({
        opacity: 1
    }, "fast", function() {
        if (mastropiero == false) {
            console.log(mastropiero);
            console.log('Entro');
            sliptTitlesHome('#blogskl');
        }
    });
    $('.facebookloading').click(function() {
        $.mobile.loading('show');
    });
    $("#feedrss .titleBlog").css('opacity', '0');
    // SPLIT TITLES 
    withdCalculator1();


}

//GET COMMENTS ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

google.load("feeds", "1") //Load Google Ajax Feed API (version 1)
var rssoutput = '';
var hastagtwitter = '';
var idNote = '';
function gfeedfetcher2() {
    this.feedlabels = [] //array holding lables for each RSS feed
    this.feedurls = []
    this.feeds = [] //array holding combined RSS feeds' entries from Feed API (result.feed.entries)	
    this.feedlimit = 30
    this.itemcontainer = "<li>" //default element wrapping around each RSS entry item
}
gfeedfetcher2.prototype.addFeed = function(label, url, note) {
    this.feedlabels[this.feedlabels.length] = label
    this.feedurls[this.feedurls.length] = url;
    hastagtwitter = label;
    idNote = note;
}
gfeedfetcher2.prototype.init = function() {
    //$("#blog").html('<p><img src="indicator.gif" /> Retrieving RSS feed(s)</p>');
    rssoutput = '';

    this.feeds = [] //reset feeds[] array to empty (in case init() is called more than once)

    for (var i = 0; i < this.feedurls.length; i++) { //loop through the specified RSS feeds' URLs
        var feedpointer = new google.feeds.Feed(this.feedurls[i]) //create new instance of Google Ajax Feed API
        feedpointer.setResultFormat(google.feeds.Feed.XML_FORMAT);
        //feedpointer.includeHistoricalEntries();
        feedpointer.setNumEntries(this.feedlimit) //set number of items to display
        feedpointer.load(function() {
            return function(result) {
                var thisfeed = (!result.error) ? result.xmlDocument.getElementsByTagName('item') : "" //get all feed entries as a JSON array or "" if failed
                if (thisfeed == "") { //if error has occured fetching feed
                    alert("Some comments posts could not be loaded: " + result.error.message);
                }
                var p = 0;
                $(".commentsList").remove();
                var commentsList = '';
                for (var i = 0; i < thisfeed.length; i++) { //For each entry within feed	
                    var item = thisfeed[i];

                    var arrItem = item.childNodes;


                    var content = '';
                    var content_b = 0;

                    var pubDate = '';
                    var pubDate_b = 0;

                    var author = '';
                    var author_b = 0;
                    for (var k = 0; k < arrItem.length; k++) {
                        if (arrItem[k].nodeName == "content:encoded" && content_b == 0) {
                            content = arrItem[k].firstChild.nodeValue;
                            contentclear = content.replace(/(?:<(?:script|style)[^>]*>[\s\S]*?<\/(?:script|style)>|<[!\/]?[a-z]\w*(?:\s*[a-z][\w\-]*=?[^>]*)*>|<!--[\s\S]*?-->|<\?[\s\S]*?\?>)[\r\n]*/gi, '');
                            content_b = 1;
                        }
                        if (arrItem[k].nodeName == "pubDate" && pubDate_b == 0) {
                            pubDate = arrItem[k].firstChild.nodeValue;
                            pubDate_b = 1;
                        }
                        if (arrItem[k].nodeName == "author" && author_b == 0) {
                            author = arrItem[k].firstChild.nodeValue;
                            author_b = 1;
                        }
                    }
                    var parseddate = new Date(pubDate)
                    var itemdate = parseddate.toLocaleDateString()

                    commentsList+='<p class="wp_author">'+author+' --- '+itemdate+'</p>';
                    commentsList+='<p class="wp_comment">'+contentclear+'</p>';


                }

                $("#popupComment" + idNote).popup({
                    beforeopen: function(event, ui) {
                        $(".klbloglist").html(commentsList);
                    }
                });
                if (hastagtwitter.trim()) {
                    $.ajax({
                        type: "POST",
                        data: {'hastag': hastagtwitter},
                        url: 'blogs/gettwitter/',
                        success:
                                function(response) {

                                    $("#commentstwitter" + idNote).html(response);
                                    var restantes;
                                    $("#txt_comments_t" + idNote).keyup(function() {
                                        var limit = $(this).attr("maxlength"); // Límite del textarea
                                        var value = $(this).val();             // Valor actual del textarea
                                        var current = value.length;              // Número de caracteres actual
                                        if (limit < current) {                   // Más del límite de caracteres?
                                            // Establece el valor del textarea al límite
                                            $(this).val(value.substring(0, limit));
                                        }
                                        restantes = 140 - current;
                                        $("#numberRest" + idNote).html('-' + restantes + '-');
                                    });

                                    var actual = $("#txt_comments_t" + idNote).val();
                                    var current = actual.length;
                                    restantes = 140 - current;
                                    $("#numberRest" + idNote).html('-' + restantes + '-');
                                }
                    });// end GET FIND HASTAG TWITTER
                }

            }
        }(this.feedlabels[i])) //call Feed.load() to retrieve and output RSS feed.
    }
}

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

    //Refresh
    $(document).on("vclick", ".btn_refresh", function() {
        refreshNotes();
    });

    $(document).on("vclick", ".btn_refresh1", function() {

        refreshHome();

    });

    $(document).on("vclick", ".btn_shuffle", function() {
        shufflebtn();
    });
    
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




function refreshHome() {
    console.log('refresh home')
    $("#feedrss").animate({
        opacity: 0
    }, "fast", function() {
        mastropiero = false;
        newsfeed.init();
        $.removeCookie('view_blog');
        $.removeCookie('view_details');
    });

}

function refreshNotes() {
    if ($.cookie('view_blog')) {
        var arr1 = $.cookie('view_blog').split(";");
        var url_blog_feed = '';
        var hastag_blog = '';
        if (arr1[0]) {
            if (arr1[1]) {
                hastag_blog = arr1[1];
            }
            url_blog_feed = arr1[0];
            viewBlog(url_blog_feed, hastag_blog);
        }
    }
    $.removeCookie('view_details');
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

//function shufflebtn(){
//    var elements = $(document).find('.shuffle');
//    var arr = new Array();
//    
//    $.each(elements,function(){
//        arr.push(this);
//    });
//   
//    console.log(arr);
//    arr = $.shuffle(arr);
//};

function shufflebtn() {
    if ($.cookie('view_blog')) {
        var arr1 = $.cookie('view_blog').split(";");
        var url_blog_feed = '';
        var hastag_blog = '';
        if (arr1[0]) {
            if (arr1[1]) {
                hastag_blog = arr1[1];
            }
            console.log(arr1[0]);
            url_blog_feed = arr1[0];
            //viewBlog(url_blog_feed, hastag_blog);
        }
    }
    $.removeCookie('view_details');
}







function tabs() {
    
    $('.dTwitterButton').click(function() {
        $('.dTwitter').show();
        $('.dFacebook').hide();
        $('.dKlblog').hide();
        $(this).css('height', '45px');
        $('.dFacebookButton').css('height', '40px');
        $('.dKlblogButton').css('height', '40px');
        $('.dBox').css('border', '5px solid #48CBFE');
    });
    $('.dFacebookButton').click(function() {
        $('.dFacebook').show();
        $('.dKlblog').hide();
        $('.dTwitter').hide();
        $(this).css('height', '45px');
        $('.dTwitterButton').css('height', '40px');
        $('.dKlblogButton').css('height', '40px');
        $('.dBox').css('border', '5px solid #3B5998');
    });
    $('.dKlblogButton').click(function() {
        $('.dKlblog').show();
        $('.dFacebook').hide();
        $('.dTwitter').hide();
        $(this).css('height', '45px');
        $('.dFacebookButton').css('height', '40px');
        $('.dTwitterButton').css('height', '40px');
        $('.dBox').css('border', '5px solid #1F6F55');
    });
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
