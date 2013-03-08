$(document).ready(function(e) {
	/*
	$( "#slider-4" ).on("slidestart", function( event, ui ) {
		console.log("ok");
		alert("ok");
	});
	*/
	
	//cantidad de blogs
	total = ($('#home .blog').length);
	visibles = ($('#home .ui-grid-a .blog').length);
	//Print cantidad de Blogs
	$('#home').find('#cantidad').html("Blogs "+visibles+" of "+total);  
	
	//cantidad de Paginas Blog
	totalPaginas = ($('#blog1-page .p').length);
	//Print cantidad de paginas
	$('#blog1-page').find('#slider-4').attr("max",totalPaginas);
	
	
	
	
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
	var alto_ventana_menos60 = alto_ventana - 60;
	
	console.log(alto_ventana);
	console.log(alto_ventana_menos60);
	
	$("#flipBlog1").flip({
		height: "880px",
	});
	
	/*$(window).bind("orientationchange", function(event){            
		if (event.orientation){          
			 console.log("Me han reorientado a " + event.orientation);     
		}
 	});
	
	$(window).trigger("orientationchange");*/
		

	
/*	$('#flipBlog1 .p:first-child').live("swiperight", function(){
		$.mobile.changePage( "#home", {
			transition: "slide",
			reverse: true,
			changeHash: true,
		});
	});*/
	
	
	
	//pinch
/*	$("a#pinchTest").fidget({
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
	}*/
			
	//alert("probando 2");
	
});
