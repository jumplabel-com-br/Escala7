var errorGeoLocation = document.querySelector('#errorGeoLocation');
var autorizationLocation;
var errorCode;
var lat;
var lon;
var confirmation = confirm("Deseja ativar a localização ?");

$(document).ready(function($) {
	getLocation();
});

function getLocation()
{
	if (navigator.geolocation)
	{
		confirmation == true ? navigator.geolocation.getCurrentPosition(showPosition) : navigator.geolocation.getCurrentPosition(showError);
		//navigator.geolocation.getCurrentPosition(showPosition,showError);
	}
	else{
		M.toast({html: "Geolocalização não é suportada nesse browser.", displayLength: 4000});
	}
}

function showPosition(position)
{
	let lat = position.coords.latitude;
	let lon = position.coords.longitude;

	$('#latitue').val(lat);
	$('#longitude').val(lon);

	autorizationLocation = true
}

function showError(error)
{
	switch(error.code)
	{
		case error.PERMISSION_DENIED:
			errorCode = "Usuário rejeitou a solicitação de Geolocalização.";
			autorizationLocation = false;
		break;
		case error.POSITION_UNAVAILABLE:
			errorCode = "Localização indisponível.";
			autorizationLocation = false;
		break;
		case error.TIMEOUT:
			errorCode = "O tempo da requisição expirou.";
			autorizationLocation = false;
		break;
		case error.UNKNOWN_ERROR:
			errorCode = "Algum erro desconhecido aconteceu.";
			autorizationLocation = false;
		break;
	}
}