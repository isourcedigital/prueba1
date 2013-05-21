$(document).ready(function(e) {
	/*
	$( "#slider-4" ).on("slidestart", function( event, ui ) {
		console.log("ok");
		alert("ok");
	});
	*/
	
	
	/*---ORIENTACION---*/
	
	$( window ).on( "orientationchange", function( event ) {
                   console.log("This device is in " + event.orientation + " mode!" );
                   //if(event.orientation == 'landscape') $("#flipBlog1").flip({ forwardDir: 'btor' });
                   //else $("#flipBlog1").flip({ forwardDir: 'btot' });
	});
 
	// You can also manually force this event to fire.
	$( window ).orientationchange();
	
	/*--Alturas de los Devices---*/
	
	var debug = false;
	
	var alto_ventana = $(window).height(); 
	var ancho_ventana = $(window).width();
	
	//console.log(ancho_ventana);
	
	var altoIpad = 1004;
	var altoIphone = 1096;
	var altoIpod = 940;
	
	
	
	var restaAlto1Ipad = 127;
	var restaAlto1Iphone = 655;
	var restaAlto1Ipod = 585;
	
	var restaAlto2Ipad = 75;
	var restaAlto2Iphone = 635;
	var restaAlto2Ipod = 560;
	
	/*--Alturas de los Devices---*/
	
	var navegador =  navigator.platform.toLowerCase();
	
	//console.log(navegador);
	
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


	if(navegador == "ipod" || navegador == "ipod simulator" || alto_ventana <=480 ){
		
		if(debug){
		alert("ESTO ES "+navegador);	
		
			if (alto_ventana <=480 && navegador=="iphone"){
			alert("ESTO ES IPHONE 4");
			}
			
		}
		
		altovariable1 = altoIpod - restaAlto1Ipod;
		altovariable2 = altoIpod - restaAlto2Ipod;
		
		altovariablePx1 = altovariable1 + "px";
		altovariablePx2 = altovariable2 + "px";
		
		if(debug){
		alert("alto completo de "+navegador+": "+alto_ventana+"px");
		alert("alto variable1 de "+navegador+": "+altovariablePx1);
		alert("alto variable2 de "+navegador+": "+altovariablePx2);
		}
		
		
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
		
		if(debug){
			console.log(index);
			console.log(element);
		}
		//textoCompletoNotaPop += $(element).html();
		$(element).removeClass('colum');
		if(index > 0){			
		  if(index%2 == 1){
				$(element).html("The overwhelming majority of businesses today are encouraging employees to adopt “mobile” working practices, meaning that work can be done wherever, whenever and from whatever device – smartphone, tablet or laptop. This flexibility increases employees’ involvement and labor efficiency, but it also creates fundamentally new threats to business: securing smartphones is far more difficult than securing desktop computers. Mobile Device Management (MDM) has been one of the hottest topics at the Mobile World Congress in Barcelona. To promote this discussion, Kaspersky Lab arranged a panel at which it presented its MDM solution. Mobile security is demanding more and more attention from corporate IT directors. According to a Gartner survey in 2012, smartphones and tablets have skyrocketed to second place on the list of strategically important technologies, up from sixth place in 2011. The situation has fundamentally changed over the past five years");
			}else{
				$(element).html("Meaning that work can be done wherever, whenever and from whatever device – smartphone, tablet or laptop. This flexibility increases employees’ involvement and labor efficiency, but it also creates fundamentally new threats to business: securing smartphones is far more difficult than securing desktop computers. Mobile Device Management (MDM) has been one of the hottest topics at the Mobile World Congress in Barcelona. To promote this discussion, Kaspersky Lab arranged a panel at which it presented its MDM solution. Mobile security is demanding more and more attention from corporate IT directors. According to a Gartner survey in 2012, smartphones and tablets have skyrocketed to second place on the list of strategically important technologies, up from sixth place in 2011. The situation has fundamentally changed over the past five years. The overwhelming majority of businesses today are encouraging employees to adopt “mobile” working practices,");
			}
		}else{
			$(element).html("The overwhelming majority of businesses today are encouraging employees to adopt “mobile” working practices, meaning that work can be done wherever, whenever and from whatever device – smartphone, tablet or laptop. This flexibility increases employees’ involvement and labor efficiency, but it also creates fundamentally new threats to business");
		}
		
	});
	
		
	$('#boxFooter').css('margin-top','-10px');
	
	
	
	$('.contenedorNotas .nota').each(function(index, element) {
		
		if(debug){
			console.log(index);
			console.log(element);
		}
		if(index == 0){
			
			$(element).children('.titulo').css('font-size','13px');
			$(element).children('.titulo').css('line-height','20px');
				
		}
		
			
		
	});
	$('.notaDestacada .imagen ').css('height','38%');
	$('.notaDestacada .imagen ').css('width','38%');	
	
	$('.notaPrincipa').css('margin-bottom','15px');
  $('.notaPrincipal .imagen .titulo ').css('font-size','22px');
	$('.notaPrincipal .imagen .titulo ').css('line-height','26px');
		
	
		
	}else if(navegador == "iphone" || navegador == "iphone simulator"){


		//hack X iphon5
		$("span.ui-icon-delete").css("background-position","-50px -50px");

		
		if (debug){
			alert("ESTO ES "+navegador);
			alert("ESTO ES IPHONE 5");
		}
		
		altovariable1 = altoIphone - restaAlto1Iphone;
		altovariable2 = altoIphone - restaAlto2Iphone;
		
		altovariablePx1 = altovariable1 + "px";
		altovariablePx2 = altovariable2 + "px";

		if (debug){
			alert("alto completo de "+navegador+": "+altoIphone+"px");
			alert("alto variable1 de "+navegador+": "+altovariablePx1);
			alert("alto variable2 de "+navegador+": "+altovariablePx2);
		}

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
		
		if (debug){
			console.log(index);
			console.log(element);
			
		}
		//textoCompletoNotaPop += $(element).html();
		$(element).removeClass('colum');
		if(index > 0){
			
		  if(index%2 == 1){
				$(element).html("The overwhelming majority of businesses today are encouraging employees to adopt “mobile” working practices, meaning that work can be done wherever, whenever and from whatever device – smartphone, tablet or laptop. This flexibility increases employees’ involvement and labor efficiency, but it also creates fundamentally new threats to business: securing smartphones is far more difficult than securing desktop computers. Mobile Device Management (MDM) has been one of the hottest topics at the Mobile World Congress in Barcelona. To promote this discussion, Kaspersky Lab arranged a panel at which it presented its MDM solution. Mobile security is demanding more and more attention from corporate IT directors. According to a Gartner survey in 2012, smartphones and tablets have skyrocketed to second place on the list of strategically important technologies, up from sixth place in 2011. According to a Gartner survey in 2012, smartphones and tablets have skyrocketed to second place on the list of strategically important technologies, up from sixth place in 2011.");
			}else{
				$(element).html("Meaning that work can be done wherever, whenever and from whatever device – smartphone, tablet or laptop. This flexibility increases employees’ involvement and labor efficiency, but it also creates fundamentally new threats to business: securing smartphones is far more difficult than securing desktop computers. Mobile Device Management (MDM) has been one of the hottest topics at the Mobile World Congress in Barcelona. To promote this discussion, Kaspersky Lab arranged a panel at which it presented its MDM solution. Mobile security is demanding more and more attention from corporate IT directors. According to a Gartner survey in 2012, smartphones and tablets have skyrocketed to second place on the list of strategically important technologies, up from sixth place in 2011. The overwhelming majority of businesses today are encouraging employees to adopt “mobile” working practices, The overwhelming majority of businesses today are encouraging. The overwhelming majority of businesses");
			}

		}else{
			$(element).html("The overwhelming majority of businesses today are encouraging employees to adopt “mobile” working practices, meaning that work can be done wherever, whenever and from whatever device – smartphone, tablet or laptop. This flexibility increases employees’ involvement and labor efficiency, but it also creates fundamentally new threats to business: securing smartphones is far more difficult than securing desktop computers. Mobile Device Management (MDM) has been one of. Mobile Device Management (MDM) has been one of.");
		}
	});
	
	$('#boxFooter').css('margin-top','60px');
	$('#boxTitContent').css('margin-top','30px');
	
	$('.ui-icon-delete').css('background-position','0px 0px');
	$('.ui-icon').css('background-image','url(images/icons-cerrar.png)');
		
	} else {
		
		if (debug){
			alert("NO ENTRO EN MOBILES");
		}
		
		altovariable1 = altoIpad - restaAlto1Ipad;
		altovariable2 = altoIpad - restaAlto2Ipad;
		
		altovariablePx1 = altovariable1 + "px";
		altovariablePx2 = altovariable2 + "px";
		
		if (debug){
		alert("alto completo de "+navegador+": "+altoIpad+"px");	
		alert("alto variable1 de "+navegador+": "+altovariablePx1);
		alert("alto variable2 de "+navegador+": "+altovariablePx2);
		}
	}

	
	
	
	
	$("#flipBlog1").flip({
		height: altovariablePx1, /*--127-- 877*/
		
	});
	$("#flipBlog2").flip({
		//height: altovariablePx2, /*--75-- 929*/
	
	});
    
    intIndexBigCarousel = setInterval('fIndexBigCarousel();', 7000);
    intIndexBigScroll = setInterval('fIndexBigScroll();', 10);
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
