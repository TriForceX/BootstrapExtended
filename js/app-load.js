/*JS Start*/

/* ================================================= WINDOWS LOAD ================================================= */
		
//Modal content delete
$('#alert').on('hidden.bs.modal', function () {

	$('#alert').find(".modal-body").html("");
	$('#alert').removeClass("onlyVideo");
	$('#alert').find(".modal-dialog").removeClass("modal-sm");
	$('#alert').find(".modal-dialog").removeClass("modal-md");
	$('#alert').find(".modal-dialog").removeClass("modal-lg");
});


//Lightbox Fixes
$(document).mousemove(function(e){

   $(".hoverSwipebox").css({
		   left:e.pageX+15, //Posicion horizontal del mensaje
		   top:e.pageY-30 //Posicion vertical del mensaje
   });

   $(".hoverSwipebox").css("visibility","visible");

});
$(document).keyup(function(e){
	if (e.which == 37 || e.which == 39) {//Left - Rightå
		$(".hoverSwipebox").css("visibility","hidden");
	}
});
//Lightbox Fixes

//Pruebas de contenido dinamico
/*$(".class").click(function(){
	$(".class").append("dsaaddsa<br>");
});

$(".class").click(function(){
	$(".class").find("br:last").remove();
});*/
//Pruebas de contenido dinamico

//Mobile
if(isMovil)
{
	//*** CODIGO GENERAL MOVILES ***//

}
else{
	//*** CODIGO GENERAL FUERA DE MOVILES ***//

}
//Mobile

//*** CODIGO GENERAL DESPUES DEL SITIO CARGADO ***//

//Custom Clicks
var urlMoDisp = "a[href*=#]";

//$(String(urlMoDisp)).not(".carousel-control").click(function(e) {
$(document).on("click", urlMoDisp, function(e) {

	var textoUrl = $(this).attr("href");
	var seccion = capitalizeFirstLetter(textoUrl.split('#')[1]/*.replace("#", "")*/);

	//Sin Enlace
	if(textoUrl=="#sinlink"){
		e.preventDefault();
	}
	else if(textoUrl=="#"){
		e.preventDefault();
	}
	else if(textoUrl=="#carousel-example-generic"){

	}
	/*else if (textoUrl.indexOf('#videoID=') >= 0){
		var titulo = 'Video Title';
		videoLaunch(titulo,textoUrl.replace("#videoID=",""));
		e.preventDefault();
	}*/
	else{
		if (textoUrl.indexOf(window.location.host) >= 0){
			//***
			if(textoUrl.substr(textoUrl.length - 1, 1) == 's') {
				alert2(seccion+" no disponibles","Este contenido se encuentra en desarrollo.");
			}
			else{
				alert2(seccion+" no disponible","Este contenido se encuentra en desarrollo.");
			}

			e.preventDefault();
			//***
		}
	}

});
//Custom Clicks

//New Title Attr
if(!(isMovil))
{
	//$("*[title2]").css("background-color","red");

	$(document).on("mouseenter", "*[title2]", function() {

		//console.log("tiene "+$(this).index());

		$(this).popover({
			container: 'body',
			html: true,
			placement: $(this).attr("title2_pos"),
			content: function () {
				return $(this).attr("title2");
			}
		});

		$(this).popover('show');
	});

	$(document).on("mouseleave", "*[title2]", function() {

		//console.log("no tiene "+$(this).index());

		$(this).popover('destroy');

	});

}
//New Title Attr

//Cookie
/*

if ( !($.cookie('TEST_FirstTime') ) )
{
	//Añadir la cookie
	$.cookie("TEST_FirstTime", enlace, { expires: 365 });

}
else
{
	//Actualizar cookie
	$.cookie("TEST_FirstTime", enlace, { path: '/' });
}

*/

//Data Tables
//$('#example').DataTable();

//Data Tables Mod
/*$('.listaAlumnos').DataTable( {
	//"lengthMenu": [[5, 15, -1], [5, 15, "All"]]
	paging: false,
	"columnDefs": [ {
	"targets": 'no-sort',
	"orderable": false,
	} ],
	 "initComplete": function(settings, json) {
		 //Ocultar cosas
		$(".dataTables_wrapper").find(".row:first-child").find(".dataTables_filter").parent().prev().remove();
		$(".dataTables_wrapper").find(".row:first-child").find(".dataTables_filter").parent().removeAttr("class");
		$(".dataTables_wrapper").find(".row:first-child").find(".dataTables_filter").find("input").addClass("in-txt");

		$(".dataTables_wrapper").find(".row:last-child").find(".dataTables_info").parent().removeAttr("class");
		$(".dataTables_wrapper").find(".row:last-child").find(".dataTables_info").parent().next().remove();

		//Funciones despues de aplicar todo

	  },
});*/

//bootbox prompt
/*bootbox.prompt({
	  title: "What is your real name?",
	  //value: "makeusabrew",
	  callback: function(result) {
			if (result === null) {
			  $('#alert').show("Prompt dismissed");
			} else {
			  $('#alert').show("Hi <b>"+result+"</b>");
			}
	  }
});*/

//Bootbox confirm
/*bootbox.confirm({ 
	message: "¿Seguro que desea eliminar a este alumno?", 
	callback: function(result) {
		if (result == false) {
			$('#alert').show("Prompt dismissed");
		} else {
			$('#alert').show("Hi <b>"+result+"</b>");
		}
	}
});*/
		
/* ================================================= WINDOWS LOAD ================================================= */

/*JS End*/