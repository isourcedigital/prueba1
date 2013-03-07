$(document).ready(function(e) {
	
	//cantidad de blogs
	total = ($('#home .blog').length);
	visibles = ($('#home .ui-grid-a .blog').length);
	//Print cantidad de Blogs
	$('#home').find('#cantidad').html("Blogs "+visibles+" of "+total);  
	
	//cantidad de Paginas Blog
	totalPaginas = ($('#blog1-page .p').length);
	//Print cantidad de paginas
	$('#blog1-page').find('#slider-4').attr("max",totalPaginas);
	
	$("#home .contentTit").fitText(1, {maxFontSize: '50px'});
	$("#home .button").fitText(1, { minFontSize:'15px', maxFontSize: '40px'});
	
	
	
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
	
	
	
	var alto_ventana = $(window).height(); 
	console.log(alto_ventana);
	
	$("#flipBlog1").flip({
		height: alto_ventana,
	});
	
	$(window).bind("orientationchange", function(event){            
		if (event.orientation){          
			 console.log("Me han reorientado a " + event.orientation);     
		}
 	});
	$(window).trigger("orientationchange");
		

	
	$('#flipBlog1 .p:first-child').live("swiperight", function(){
		$.mobile.changePage( "#home", {
			transition: "slide",
			reverse: true,
			changeHash: true,
		});
	});
	
	
	$( "#slider-4" ).on("slidestart", function( event, ui ) {
		console.log("ok");
		alert("ok");
	});
	
	//pinch
	$("a#pinchTest").fidget({
		swipe: null,
		dragThis: false,
		pinch: handleSwipe,
		zoomThis: false,
		rotateThis: false,
		tap: null,
		doubleTap: null
	});
	function handleSwipe(event, fidget) {
		//$('.dragMe').html('<p>Status: ' + fidget.swipe.status + '</p>');
		alert("pinch");
	}
			
	//alert("probando 2");
	
});
