$(document).ready(function(e) {
	/*
	$( "#slider-4" ).on("slidestart", function( event, ui ) {
		console.log("ok");
		alert("ok");
	});
	*/
	
	/*--Alturas de los Devices---*/
	
	var alto_ventana = $(window).height(); 
	var ancho_ventana = $(window).width();
	
	console.log(ancho_ventana);
	
	var altoIpad = 1004;
	var altoIphone = 1096;
	var altoIpod = 940;
	
	
	
	var restaAlto1Ipad = 127;
	var restaAlto1Iphone = 655;
	var restaAlto1Ipod = 119;
	
	var restaAlto2Ipad = 75;
	var restaAlto2Iphone = 635;
	var restaAlto2Ipod = 70;
	
	/*--Alturas de los Devices---*/
	
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
	
	
	
	
	
	
	var altovariable1;
	var altovariable2;
	
	var altovariablePx1;
	var altovariablePx2;
	
	
	/*---Contenidos---*/
	var imagenNotaPrincipal = $('#blog .notaPrincipal .imagen').html();
	var TextoNotaPrincipal = $('#blog .notaPrincipal .texto').html();
	
	var imagenNota = $('#blog .nota .imagen').html();
	var TituloNota = $('#blog .nota .titulo').html();
	var TextoNota = $('#blog .nota .texto').html();
	var FechaNota = $('#blog .nota .contentFechaComent').html();
	
	var imagenNotaDestacada = $('#blog .notaDestacada .imagen').html();
	var TituloNotaDestacada = $('#blog .notaDestacada .titulo').html();
	var TextoNotaDestacada = $('#blog .notaDestacada .texto').html();
	var Texto2NotaDestacada = $('#blog .notaDestacada .texto2').html();
	var FechaNotaDestacada = $('#blog .notaDestacada .contentFechaComent').html();
	
	
	
	/*---Contenidos--*/

	
	if(navegador == "ipod" || navegador == "ipod simulator" ){
		alert("ESTO ES "+navegador);	
		
		altovariable1 = altoIpod - restaAlto1Ipod;
		altovariable2 = altoIpod - restaAlto2Ipod;
		
		altovariablePx1 = altovariable1 + "px";
		altovariablePx2 = altovariable2 + "px";
		
		
		alert("alto completo de "+navegador+": "+alto_ventana+"px");
		alert("alto variable1 de "+navegador+": "+altovariablePx1);
		alert("alto variable2 de "+navegador+": "+altovariablePx2);
		
		
		
		$('#blog .notaPrincipal .imagen').html(imagenNotaPrincipal);
		$('#blog .notaPrincipal .texto').html("");
		$('#blog .notaPrincipal .imagen .contentFechaComent .fecha img').attr("src","images/calendarGris.png");
		$('#blog .notaPrincipal .imagen .contentFechaComent .coment img').attr("src","images/comentGris.png");
		
		$('#blog .nota .imagen').remove();
		$('#blog .nota .titulo').html(TituloNota);
		$('#blog .nota .contentFechaComent').html(FechaNota);
		$('#blog .nota .texto').remove();
		
		$('#blog .notaDestacada .imagen').html(imagenNotaDestacada);
		$('#blog .notaDestacada .titulo').html(TituloNotaDestacada);
		$('#blog .notaDestacada .contentFechaComent').html(FechaNotaDestacada);
		$('#blog .notaDestacada .texto').remove();
		$('#blog .notaDestacada .texto2').remove();
		
		
		
		var textoCompletoNotaPop="";
	
	$('.notaPop .texto p').each(function(index, element) {
		//console.log(index);
		//console.log(element);
		//textoCompletoNotaPop += $(element).html();
		$(element).removeClass('colum');
		if(index > 0){
			$(element).html("The overwhelming majority of businesses today are encouraging employees to adopt “mobile” working practices, meaning that work can be done wherever, whenever and from whatever device – smartphone, tablet or laptop. This flexibility increases employees’ involvement and labor efficiency, but it also creates fundamentally new threats to business: securing smartphones is far more difficult than securing desktop computers. Mobile Device Management (MDM) has been one of the hottest topics at the Mobile World Congress in Barcelona. To promote this discussion, Kaspersky Lab arranged a panel at which it presented its MDM solution. Mobile security is demanding more and more attention from corporate IT directors. According to a Gartner survey in 2012, smartphones and tablets have skyrocketed to second place on the list of strategically important technologies, up from sixth place in 2011. The situation has fundamentally changed over the past five years");
		}else{
			$(element).html("The overwhelming majority of businesses today are encouraging employees to adopt “mobile” working practices, meaning that work can be done wherever, whenever and from whatever device – smartphone, tablet or laptop. This flexibility increases employees’ involvement and labor efficiency, but it also creates fundamentally new threats to business: securing smartphones is far more difficult than securing desktop computers. Mobile Device Management (MDM) has been one of...");
		}
	});
	
	var paginasP = $('#flipBlog2:first-child').html();
		
		
	
		
	}else if(navegador == "iphone" || navegador == "iphone simulator"){
		//alert("ESTO ES "+navegador);
		altovariable1 = altoIphone - restaAlto1Iphone;
		altovariable2 = altoIphone - restaAlto2Iphone;
		
		altovariablePx1 = altovariable1 + "px";
		altovariablePx2 = altovariable2 + "px";

		$('#blog .notaPrincipal .imagen').html(imagenNotaPrincipal);
		$('#blog .notaPrincipal .texto').html("");
		$('#blog .notaPrincipal .imagen .contentFechaComent .fecha img').attr("src","images/calendarGris.png");
		$('#blog .notaPrincipal .imagen .contentFechaComent .coment img').attr("src","images/comentGris.png");
		
		$('#blog .nota .imagen').remove();
		$('#blog .nota .titulo').html(TituloNota);
		$('#blog .nota .contentFechaComent').html(FechaNota);
		$('#blog .nota .texto').remove();
		
		$('#blog .notaDestacada .imagen').html(imagenNotaDestacada);
		$('#blog .notaDestacada .titulo').html(TituloNotaDestacada);
		$('#blog .notaDestacada .contentFechaComent').html(FechaNotaDestacada);
		$('#blog .notaDestacada .texto').remove();
		$('#blog .notaDestacada .texto2').remove();
		
		
		
		var textoCompletoNotaPop="";
	
	$('.notaPop .texto p').each(function(index, element) {
		//console.log(index);
		//console.log(element);
		//textoCompletoNotaPop += $(element).html();
		$(element).removeClass('colum');
		if(index > 0){
			$(element).html("The overwhelming majority of businesses today are encouraging employees to adopt “mobile” working practices, meaning that work can be done wherever, whenever and from whatever device – smartphone, tablet or laptop. This flexibility increases employees’ involvement and labor efficiency, but it also creates fundamentally new threats to business: securing smartphones is far more difficult than securing desktop computers. Mobile Device Management (MDM) has been one of the hottest topics at the Mobile World Congress in Barcelona. To promote this discussion, Kaspersky Lab arranged a panel at which it presented its MDM solution. Mobile security is demanding more and more attention from corporate IT directors. According to a Gartner survey in 2012, smartphones and tablets have skyrocketed to second place on the list of strategically important technologies, up from sixth place in 2011. The situation has fundamentally changed over the past five years");
		}else{
			$(element).html("The overwhelming majority of businesses today are encouraging employees to adopt “mobile” working practices, meaning that work can be done wherever, whenever and from whatever device – smartphone, tablet or laptop. This flexibility increases employees’ involvement and labor efficiency, but it also creates fundamentally new threats to business: securing smartphones is far more difficult than securing desktop computers. Mobile Device Management (MDM) has been one of...");
		}
	});
	
	var paginasP = $('#flipBlog2:first-child').html();
		
		
		//alert("alto completo de "+navegador+": "+altoIphone+"px");
		//alert("alto variable1 de "+navegador+": "+altovariablePx1);
		//alert("alto variable2 de "+navegador+": "+altovariablePx2);
		
	
		
	} else {
		
		//alert("NO ENTRO EN MOBILES");
		
		altovariable1 = altoIpad - restaAlto1Ipad;
		altovariable2 = altoIpad - restaAlto2Ipad;
		
		altovariablePx1 = altovariable1 + "px";
		altovariablePx2 = altovariable2 + "px";
		
		//alert("alto completo de "+navegador+": "+altoIpad+"px");	
		//alert("alto variable1 de "+navegador+": "+altovariablePx1);
		//alert("alto variable2 de "+navegador+": "+altovariablePx2);

	}

	
	$("#flipBlog1").flip({
		height: altovariablePx1, /*--127-- 877*/
	});
	$("#flipBlog2").flip({
		height: altovariablePx2, /*--75-- 929*/
	});
	
	
//	$("#panelOptions").css("height", alto_ventana+"px");
//	$("#panelMore").css("height", alto_ventana+"px");


	
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
