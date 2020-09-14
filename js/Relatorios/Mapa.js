var str = '';
var locations = [];
var infosLocation;
var strArr = [];
var strArrStr = []; 
jQuery(document).ready(function($) {
  selectCampanhas();
  $("#CampanhasMapa").select2().on("change", function(e){
    returnLocations()
  })
});

function returnLocations(){
  if ($('#CampanhasMapa').val() == '') {
    M.toast({html: 'Selecione a campanha para montar o mapa', displayLength: 10000});
  }

  $('#modalProgress').modal('open');

  //debugger;
  sql = `SELECT a.* FROM escala75_Easy7.CoordenadasEndereco a
  join escala75_Easy7.ImagensCampanha b on a.latitude = b.latitude and a.longitude = b.longitude
  where b.IdCampanha = ${$('#CampanhasMapa').val()}
  group by a.latitude, a.longitude, a.endereco;`;
  
  SelectAdvanced(sql);

  let data = dataSelectAdvanced;
  
  locations = [];
  
  dataSelectAdvanced.map(elem => {
    locations.push([elem.endereco, elem.latitude, elem.longitude])  
  });

  initMap(locations);
  $('#modalProgress').modal('close');
}

/*
function createLocations(){

  if ($('#CampanhasMapa').val() == '') {
    M.toast({html: 'Selecione a campanha para montar o mapa', displayLength: 10000});
  }

  $('#modalProgress').modal('open');

  let Schema = 'escala75_Easy7';
  let tableName = 'ImagensCampanha';
  let columns = 'Latitude, Longitude';
  let where = `IdCampanha = ${$('#CampanhasMapa').val()}`
  let option = 'Select'

  let params = {
    Schema,
    tableName,
    columns,
    where,
    option
  }

  $.ajax({
    url: 'DBInserts.php',
    type: 'POST',
    dataType: 'json',
    data: params,
  })
  .done(function(data) {
    console.log("success");

    if (data.length > 0) {
      locations = [];
      str = ''
      data.map(elem => {
        returnLocation(elem.Latitude, elem.Longitude);

                //locations += `[${returnLocation(elem.Latitude, elem.Longitude)}, ${elem.Latitude}, ${elem.Longitude}]`;
              });

      str = str.substr(0,str.length-1).split('],');

      setTimeout(function (){
        str.forEach(elem => {
          strArrStr.push(elem.replace("]]", "]").replace('undefined', ''));
        });

        strArrStr.forEach(elem => {
          elem != "" ? locations.push(JSON.parse(elem)) : '';
        });

        initMap(locations);
      },3000)
    }else{
      document.querySelector('#map').innerHTML = '<label style-"color:black">Sem informações para esta campanha</label>'
    }

    $('#modalProgress').modal('close');
  })
  .fail(function() {
    console.log("error");
  });
}


function returnLocation(lat, log){
  //let latlng = 'latlng='+lat+','+log;
  //let key = 'key=AIzaSyBOni-fl7eqwuCXR7qUppY4-afzDp31oaU'//AIzaSyBOni-fl7eqwuCXR7qUppY4-afzDp31oaU;
  let urlComplement = `https://nominatim.openstreetmap.org/reverse?format=json&lon=${log}&lat=${lat}`

  $.ajax({
    url: urlComplement,
    type: 'GET',
    dataType: 'json',
    async: false,
        //data: {latlng, key},
      })
  .done(function(data) {
        //console.log("success: ", data.results[0].formatted_address);
        str += `["${data.display_name}", ${lat}, ${log}]],`;

        // str = str.replace(/undefined/g,'');

      })
  .fail(function() {
    console.log("error");
  });

}*/


function initMap(locations){

  var map = new google.maps.Map(document.querySelector('#map'), {
    zoom: 6,
    center: new google.maps.LatLng(-22, -45),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var infowindow = new google.maps.InfoWindow();

  var marker, i;

  for (i = 0; i < locations.length; i++) {  
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map: map,
      title: locations[i][0]
    });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(locations[i][0]);
            infowindow.open(map, marker);
          }
        })(marker, i));
  }

}

function selectCampanhas(option = 'Select'){
  
  let sql = `SELECT a.* FROM escala75_Easy7.Campanhas a 
  ${$('#UserRegistration').val() != "" && $('#IdUser').val() != undefined ? 
  `
  join escala75_Easy7.ClientesCampanhas b on a.Id = b.IdCampanha
  join escala75_Easy7.Users c on b.IdUsuario = c.Id
  where c.Id = ${$('#IdUser').val()}` 
  : ''}
  group by a.Campanha;`

  SelectAdvanced(sql);

  let data = dataSelectAdvanced;

  if(data != null && data.length > 0){
    $('.Campanhas').html(templaceCampanhas(data));
  }else{
    $('.Campanhas').html('<option value="" disabled>Sem campanha cadastrada</option>')
  }

  //$('select').formSelect();;
  
}


function templaceCampanhas(model){
  return`
    <option value="">Selecione</option>
    ${model.map(elem => {
      return`
        <option value="${elem.Id}">${elem.Campanha}</option>
      `
    })}
  `
}