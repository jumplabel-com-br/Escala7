var errorGeoLocation = document.querySelector('#errorGeoLocation');
var autorizationLocation;
var errorCode;
var lat;
var lon;

$(document).ready(function($) {
	getLocation();
});

function getLocation()
{
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showPosition,showError);
	}
	else{
		M.toast({html: "Geolocalização não é suportada nesse browser.", displayLength: 4000});
	}
}

function showPosition(position)
{
	lat = position.coords.latitude;
	lon = position.coords.longitude;
	//latlon = new google.maps.LatLng(lat, lon)
	//mapholder = document.getElementById('mapholder')
	//mapholder.style.height = '400px';
	//mapholder.style.width = '423px';

	//var myOptions = {
	//	center:latlon,zoom:20,
	//	mapTypeId:google.maps.MapTypeId.ROADMAP,
	//	mapTypeControl:false,
	//	navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
	//};

	//var map = new google.maps.Map(document.getElementById("mapholder"),myOptions);
	//var marker = new google.maps.Marker({position:latlon,map:map,title:"Você está Aqui!"});

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