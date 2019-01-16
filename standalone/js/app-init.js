/* ================================================= BASE VARIABLEs ================================================= */

var JSmainUrl = '$global-url';
var JSmainLang = $('body').data('js-lang');

/* ================================================= BASE VARIABLEs ================================================= */

/* ================================================= BASE CONSOLE ================================================= */

// Check element existance
function JSexist(elem)
{
	return elem.length > 0;
}

// Custom console log
function JSconsole(data)
{
	if(!(JSexist($('*[data-js-console="false"]'))))
	{
		if(/\[JS/i.test(data) && JSexist($('*[data-js-console="base"]')))
		{
			console.log('%c'+data, 'color: orange');
		}
		else if(!(/\[JS/i.test(data)))
		{		
			console.log(data);
		}
	}
}

/* ================================================= BASE CONSOLE ================================================= */

/* ================================================= BASE LANGUAGE ================================================= */

// Define language by default
var JSLangDetect = navigator.language || navigator.userLanguage;
var JSlanguage = {
				// Form validation
				'$validate-title': {
					en: 'Form Alert',
					es: 'Alerta Formulario',
				},
				'$validate-normal': {
					en: 'Please fill the fields.',
					es: 'Por favor complete los campos.',
				},
				'$validate-number': {
					en: 'Please type a valid number.',
					es: 'Por favor escriba un número válido.',
				},
				'$validate-tel': {
					en: 'Please type a phone number.',
					es: 'Por favor escriba un teléfono válido.',
				},
				'$validate-pass': {
					en: 'Please fill your password.',
					es: 'Por favor complete su clave.',
				},
				'$validate-email': {
					en: 'Please type a correct E-Mail.',
					es: 'Por favor escriba un E-Mail válido.',
				},
				'$validate-search': {
					en: 'Please fill the search field.',
					es: 'Por favor complete el campo de busqueda.',
				},
				'$validate-checkbox': {
					en: 'Please check an option.',
					es: 'Por favor elija opciones.',
				},
				'$validate-radio': {
					en: 'Please check one of the options.',
					es: 'Por favor elija una de las opciones.',
				},
				'$validate-textarea': {
					en: 'Please write a message.',
					es: 'Por favor escriba un mensaje.',
				},
				'$validate-recaptcha': {
					en: 'Please confirm that you not are a robot.',
					es: 'Por favor confirma que no eres un robot.',
				},
				'$validate-select': {
					en: 'Please select a valid option.',
					es: 'Por favor seleccione una opción válida.',
				},
				'$validate-file': {
					en: 'Please select a file.',
					es: 'Por favor seleccione un archivo.',
				},
				'$validate-confirm-title': {
					en: 'Form Confirm',
					es: 'Confirmar Formulario',
				},
				'$validate-confirm-text': {
					en: 'Are you sure you want to send the previous info?',
					es: '¿Estas seguro de que deseas enviar el formulario?',
				},
				// Video launch
				'$videolaunch-title': {
					en: 'Share Link',
					es: 'Compartir Enlace',
				},
				'$videolaunch-text': {
					en: 'Share link has been copied!',
					es: '¡El enlace ha sido copiado!',
				},
				// Map launch
				'$maplaunch-title': {
					en: 'Map Select',
					es: 'Mapa Dirección',
				},
				'$maplaunch-text': {
					en: 'Select one of options below',
					es: 'Seleccione una de las opciones',
				},
				'$maplaunch-alert': {
					en: 'We remind you that you must have this app installed on your device. Do you want to continue?',
					es: 'Le recordamos que debe tener esta aplicación instalada en su dispositivo. ¿Desea continuar?',
				},
				// Lightgallery
				'$lgtitle-prev-text': {
					en: 'Loading previous page ...',
					es: 'Cargando página anterior ...',
				},
				'$lgtitle-next-text': {
					en: 'Loading next page ...',
					es: 'Cargando siguiente página ...',
				},
				'$lgtitle-prev-button': {
					en: 'Previous Page',
					es: 'Pág. Anterior',
				},
				'$lgtitle-next-button': {
					en: 'Next Page',
					es: 'Pág. Siguiente',
				},
				'$lgtitle-gallery-close': {
					en: 'Closing ...',
					es: 'Cerrando ...',
				},
				// Check disabled
				'$disabled-text': {
					en: 'This content is currently disabled.',
					es: 'Este contenido esta deshabilitado por el momento.',
				},
				// Window popup error
				'$winpopup-title': {
					en: 'Pop-up Blocked!',
					es: 'Pop-up Bloqueado!',
				},
				'$winpopup-text': {
					en: 'Please add this site to your exception list and try again.',
					es: 'Por favor agrega este sitio a la lista de excepciones e inténtalo denuevo.',
				},
				// Modal
				'$modal-open': {
					en: 'Open',
					es: 'Abrir',
				},
				'$modal-close': {
					en: 'Close',
					es: 'Cerrar',
				},
				'$modal-confirm': {
					en: 'Confirm',
					es: 'Confirmar',
				},
				'$modal-send': {
					en: 'Send',
					es: 'Enviar',
				},
				'$modal-agree': {
					en: 'Agree',
					es: 'Aceptar',
				},
				'$modal-decline': {
					en: 'Decline',
					es: 'Rechazar',
				},
				'$modal-cancel': {
					en: 'Cancel',
					es: 'Cancelar',
				},
			};

// Set default language
if(JSmainLang === undefined || JSmainLang === null || JSmainLang == 'auto' || JSmainLang == '')
{
	JSmainLang = /\es/i.test(JSLangDetect) ? 'es' : 'en';
}

// Parse language strings
function JSlang(string)
{
	// Console Log
	JSconsole('[JS Function] Get Language');
	
	var text = JSlanguage[string][JSmainLang];
	
	if(text === undefined || text === null || text == ''){
		text = JSlanguage[string]['en'];
	}
	
	return text;
}

/* ================================================= BASE LANGUAGE ================================================= */
