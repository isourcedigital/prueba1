$(document).ready(function(e) {
	
	//cantidad de blogs
	total = ($('#home .blog').length);
	visibles = ($('#home .ui-grid-a .blog').length);
	//Print cantidad de Blogs
	$('#home').find('#cantidad').html("blogs "+visibles+" de "+total);  
	
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
		height: "889px",
	});
	
	$(window).bind("orientationchange", function(event){            
		if (event.orientation){          
			 console.log("Me han reorientado a " + event.orientation);     
		}
 	});
	$(window).trigger("orientationchange");
		

	
	$('.p:first-child').live("swiperight", function(){
		$.mobile.changePage( "#home", {
			transition: "slide",
			reverse: true,
			changeHash: true,
		});
	});
	
	
	$( "#slider-4" ).on( "slidestart", function( event, ui ) {
		console.log("ok");
		console.log(event);
	});
	
		/*$('div#blog4').bind('pinch', function(){
			console.log("pinch");
			$.mobile.changePage( "#blog2-page", {
								transition: "slide",
								reverse: true,
								changeHash: false
							});
		});*/


});
