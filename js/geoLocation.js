var errorGeoLocation = document.querySelector('#errorGeoLocation');

function getLocation()
{
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showPosition);
	}
	else{
		M.toast({html: "Geolocalização não é suportada nesse browser.", displayLength: 4000});
	}
}

function showPosition(position)
{
	lat = position.coords.latitude;
	lon = position.coords.longitude;
	latlon = new google.maps.LatLng(lat, lon)
	//mapholder = document.getElementById('mapholder')
	//mapholder.style.height = '400px';
	//mapholder.style.width = '423px';

	var myOptions = {
		center:latlon,zoom:20,
		mapTypeId:google.maps.MapTypeId.ROADMAP,
		mapTypeControl:false,
		navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
	};

	//var map = new google.maps.Map(document.getElementById("mapholder"),myOptions);
	//var marker = new google.maps.Marker({position:latlon,map:map,title:"Você está Aqui!"});

	console.log('lat: ', lat)
	console.log('lon: ', lon)
	console.log('latlon: ', latlon)
	return true
}

function showError(error)
{
	switch(error.code)
	{
		case error.PERMISSION_DENIED:
		M.toast({html: "Usuário rejeitou a solicitação de Geolocalização.", displayLength: 4000});
		return false;
		break;
		case error.POSITION_UNAVAILABLE:
		M.toast({html: "Localização indisponível.", displayLength: 4000});
		return false;
		break;
		case error.TIMEOUT:
		M.toast({html: "O tempo da requisição expirou.", displayLength: 4000});
		return false;
		break;
		case error.UNKNOWN_ERROR:
		M.toast({html: "Algum erro desconhecido aconteceu.", displayLength: 4000});
		return false;
		break;
	}
}