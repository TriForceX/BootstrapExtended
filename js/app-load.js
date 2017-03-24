/*JS Start*/

/* ================================================= WINDOWS LOAD ================================================= */
		
//Modal content delete
$('#alert').on('hidden.bs.modal', function () {

	$('#alert').find(".modal-body").html("");
	$('#alert').find(".modal-dialog").removeClass("modal-sm");
	$('#alert').find(".modal-dialog").removeClass("modal-md");
	$('#alert').find(".modal-dialog").removeClass("modal-lg");
});

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
	
	var itemURL =  $(this).attr("href");
	
	if(!(checkDisabledLink(itemURL))){
		e.preventDefault();
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


//LightGallery
$("#lightgallery img").each(function(){ //search all images inside
	
  var imgSrc = $(this).attr("src"); 
  
  $(this).wrap('<a href="'+imgSrc+'" class="myImage"></a>'); 
  
});

//load gallery after images get converted to links
$("#lightgallery").lightGallery({ //this is the parent container of imgs
  selector:'a', //this is the button to launch the lightbox
  thumbnail:true //if u want use thumbs change it to true, so u need include an image inside the button container to get detected as thumb, in this case inside the "a", u can "uncomment" the hidden line above to try it
}); 
//LightGallery in content







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