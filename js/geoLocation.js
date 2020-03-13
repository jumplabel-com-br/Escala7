var errorGeoLocation = document.querySelector('#errorGeoLocation');

function getLocation()
{
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showPosition,showError);
	}
	else{
		errorGeoLocation.innerHTML = "Geolocalização não é suportada nesse browser.";
	}
}

function showPosition(position)
{
	lat = position.coords.latitude;
	lon = position.coords.longitude;
	latlon = new google.maps.LatLng(lat, lon)
	mapholder = document.getElementById('mapholder')
	mapholder.style.height = '400px';
	mapholder.style.width = '423px';

	var myOptions = {
		center:latlon,zoom:20,
		mapTypeId:google.maps.MapTypeId.ROADMAP,
		mapTypeControl:false,
		navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
	};

	var map = new google.maps.Map(document.getElementById("mapholder"),myOptions);
	var marker = new google.maps.Marker({position:latlon,map:map,title:"Você está Aqui!"});

	console.log('lat: ', lat)
	console.log('lon: ', lon)
	console.log('latlon: ', latlon)
}

function showError(error)
{
	switch(error.code)
	{
		case error.PERMISSION_DENIED:
		errorGeoLocation.innerHTML = "Usuário rejeitou a solicitação de Geolocalização."
		break;
		case error.POSITION_UNAVAILABLE:
		errorGeoLocation.innerHTML = "Localização indisponível."
		break;
		case error.TIMEOUT:
		errorGeoLocation.innerHTML = "O tempo da requisição expirou."
		break;
		case error.UNKNOWN_ERROR:
		errorGeoLocation.innerHTML = "Algum erro desconhecido aconteceu."
		break;
	}
}