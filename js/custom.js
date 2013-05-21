$(document).ready(function(e) {

	
	/*---ORIENTACION---*/
	
	$( window ).on( "orientationchange", function( event ) {
                   console.log("This device is in " + event.orientation + " mode!" );
                  
	});
	// You can also manually force this event to fire.
	$( window ).orientationchange();
	
	var alto_ventana = $(window).height(); 
	var ancho_ventana = $(window).width();
	console.log(ancho_ventana);
	
	var debug = false;
	
	var navegador =  navigator.platform.toLowerCase();

	//cantidad de blogs
	total = ($('#home .blog').length);
	console.log(total);
	visibles = ($('#home .ui-grid-a .blog').length);
	//Print cantidad de Blogs
	$('#home').find('#cantidad').html("Blogs "+visibles+" of "+total);  

	
	
	$( "#popupSelcBlog" ).on( "popupafteropen", function( event, ui ) { 
		$(".selectMenu img").addClass("rot180");
		$("#headerBlog").css("z-index", "8");
		
		$( "#popupSelcBlog-screen" ).click(function() { 
			$("#headerBlog").css("z-index", "11");
		} );
	} );
	
	$( "#popupSelcBlog" ).on( "popupafterclose", function( event, ui ) { 
		$(".selectMenu img").removeClass("rot180");
	} );
	

	
	$("#flipBlog1").flip({
		
	});
	$("#flipBlog2").flip({
	
	
	});
    
    //intIndexBigCarousel = setInterval('fIndexBigCarousel();', 7000);
    //intIndexBigScroll = setInterval('fIndexBigScroll();', 10);
		
		
});


var iIndexBigCarousel = 0;
function fIndexBigCarousel()
{
    document.getElementById('imgIndexBig'+iIndexBigCarousel).style.display = 'none';
    document.getElementById('dIndexBig'+iIndexBigCarousel).style.display = 'none';
    iIndexBigCarousel++;
    if(iIndexBigCarousel == 4) iIndexBigCarousel = 0;
    document.getElementById('imgIndexBig'+iIndexBigCarousel).style.display = 'block';
    document.getElementById('dIndexBig'+iIndexBigCarousel).style.display = 'block';
    document.getElementById('imgIndexBig'+iIndexBigCarousel).style.marginLeft = '0px';
}

function fIndexBigScroll()
{
    document.getElementById('imgIndexBig'+iIndexBigCarousel).style.marginLeft = (parseInt(document.getElementById('imgIndexBig'+iIndexBigCarousel).style.marginLeft, 10)-1)+'px';
}
