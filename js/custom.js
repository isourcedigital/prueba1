$(document).ready(function(e) {
	/*
	$( "#slider-4" ).on("slidestart", function( event, ui ) {
		console.log("ok");
		alert("ok");
	});
	*/
	

	
	var navegador =  navigator.platform.toLowerCase();
	
	console.log(navegador);
	
	$(function() {
        	// Bind the tapHandler callback function to the tap event on div.box
            $( "a#testPop" ).on( 'tap', tapHandler );
 
            // Callback function references the event target and adds the 'tap' class to it
            function tapHandler( event ) {
				$.mobile.navigate( "#blog1-nota1" );
			}
      });
	
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
	var altovariable;
	
	if(navegador == "ipod" || navegador == "iphone" ){
		altovariable = alto_ventana - 44;
		alert("alto variable de "+navegador+": "+altovariable)
	}
	
	altovariable = alto_ventana - 76;
		
	
	
	
	alert("alto de "+navegador+": "+alto_ventana)
	alert("alto variable de "+navegador+": "+altovariable);
	
	$("#flipBlog1").flip({
		height:altovariable,
	});
	$("#panelOptions").css("height",altovariable);
	$("#panelMore").css("height",altovariable);
	
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
