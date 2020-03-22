var dataInfos;

$(document).ready(function(){
  $('.sidenav').sidenav();
  $('.dropdown-trigger').dropdown();
  $('.modal').modal();
  $('select').formSelect();
  $('.datepicker').datepicker();
  $('.tooltipped').tooltip();

  select('templateTableCampanhas');
});


$('#li-img-logo-min').on('click', function(event) {
  $('#mobile-demo').show();
  $('.container-usuarios').addClass('desktop');
  $('#mobile-demo-1').hide();
  event.preventDefault();
  /* Act on the event */
});

$('#li-img-logo-max').on('click', function(event) {
  $('#mobile-demo').hide();
  $('.container-usuarios').removeClass('desktop');
  $('#mobile-demo-1').show();
  event.preventDefault();
  /* Act on the event */
});


function clearForm(form){
  document.querySelectorAll(`${form} input`).forEach(input => input.value = '');
}

function CRUDCampanhas(option){

  let QRCode = $('#QRCode').val();
  let Campanha = $('#Campanha').val();
  let Dt_Inicio = dateFormart($('#Dt_Inicio').val());
  let Dt_Termino = dateFormart($('#Dt_Termino').val());
  let Status = $('#Status').val();
  let iFame = $('#iFame').val();
  let UserRegistration = $('#UserRegistration').val();
  let UserInactivity = $('#UserInactivity').val();

  let param = {
    QRCode,
    Campanha,
    Dt_Inicio,
    Dt_Termino,
    Status,
    iFame,
    UserRegistration,
    UserInactivity
  }


  let Schema = 'Escala7';
  let tableName = 'Campanhas';
  let columns = 'QRCode,Campanha,Dt_Inicio,Dt_Termino,Status,IFrame,UserRegistration,DateRegistration,UserInactivity,DateInactivity'
  let lastquery = `'${param.QRCode}','${param.Campanha}','${param.Dt_Inicio}','${param.Dt_Termino}',${param.Status},'${param.iFame}','${param.UserRegistration}',now(),'${param.UserInactivity}',now()`;

  let setQuery = `QRCode = '${param.QRCode}',Campanha = '${param.Campanha}',Dt_Inicio = '${param.Dt_Inicio}', Dt_Termino = '${param.Dt_Termino}', Status = ${param.Status},
  iFame = '${param.iFame}',UserRegistration = '${param.UserRegistration}'`
  let where = `id = ${Id}`

  if ($('#Status').val() == 0) {
    setQuery += `, UserInactivity = '${param.UserInactivity}',DateInactivity = now()`
  }

  let params = {
    Schema, 
    tableName,
    columns,
    lastquery,
    option,
    setQuery,
    where
  }

  $.ajax({
    url: 'DBInserts.php',
    type: 'POST',
    dataType: 'html',
    data: params,
  })
  .done(function(data) {
    console.log("success: ", data);
    select('templateTableCampanhas');
    $('#modalUser').modal('close');
  })
  .fail(function() {
    console.log("error");
  });

}

function select(nameFunction, id){

 let option = 'Select';
 let Schema = 'Escala7';
 let tableName = 'Campanhas';

 let columns = '*';
 let where = id > 0 ? `id = ${id}` : '';

 let params = {
  option,
  Schema,
  tableName,
  columns,
  where
}

$.ajax({
  url: 'DBInserts.php',
  type: 'POST',
  dataType: 'json',
  data: params,
  beforeSend: function(){
    $('#modalProgress').modal('open');
  }
})
.done(function(data) {
  console.log("success select: ", data);
  dataInfos = data;

  if (data.length > 0 && nameFunction == 'templateTableCampanhas') {

    $('.tbody-campanhas').html(templateTableCampanhas(data));
    $('.dropdown-trigger').dropdown();
    $('#modalCampanha').modal('close');
    clearForm('#formCampanha');

  }else if (data.length > 0 && id > 0) {
    setInputsModal(data);
  }


  $('#modalProgress').modal('close');
})
.fail(function() {
  console.log("error");
  M.toast({html: 'Erro ao processar dados, informe o suporte', displayLength: 4000})
  $('#modalProgress').modal('close');
})

}

function templateTableCampanhas(model){
  return model.map(x => {
    return`
      <tr>
        <td>${x.QRCode}</td>
        <td>${x.Campanha}</td>
        <td>${DateFormatPtBr(x.Dt_Inicio)}</td>
        <td>${DateFormatPtBr(x.Dt_Termino)}</td>
        <td>${x.Status}</td>
        <td><a href="#modalCampanha" class="modal-trigger" onclick="optionCRUDCampanhas('Editar'); select('', ${x.Id})"><i class="fas fa-edit"></i></a></td>
      </tr>
    `});
}

function setInputsModal(model){

  $('label[for="QRCode"]').addClass('active');
  $('label[for="Campanha"]').addClass('active');
  $('label[for="Dt_Inicio"]').addClass('active');
  $('label[for="Dt_Termino"]').addClass('active');
  $('label[for="Status"]').addClass('active');
  $('label[for="iFame"]').addClass('active');


  $('#QRCode').val(model[0].QRCode);
  $('#Campanha').val(model[0].Campanha);
  $('#Dt_Inicio').val(DateFormtDatePicker(model[0].Dt_Inicio));
  $('#Dt_Termino').val(DateFormtDatePicker(model[0].Dt_Termino));
  $('#Status').val(model[0].Status);
  $('#iFame').val(model[0].IFrame);

   $('#Status').formSelect();
}

function dateFormart(inputDate){
  date = inputDate.replace(',','').split(" ");

  let Year = date[2];
  let Month;
  let Day = date[1];
  let Hours = " 00:00:00";

  if (date[0] == "Jan") {
    Month = "01";
  }else if(date[0] == "Feb"){
    Month = "02";
  }else if(date[0] == "Mar"){
    Month = "03";
  }else if(date[0] == "Apr"){
    Month = "04";
  }else if(date[0] == "May"){
    Month = "05";
  }else if(date[0] == "Jun"){
    Month = "06";
  }else if(date[0] == "Jul"){
    Month = "07";
  }else if(date[0] == "Aug"){
    Month = "08";
  }else if(date[0] == "Sep"){
    Month = "09";
  }else if(date[0] == "Oct"){
    Month = "10";
  }else if(date[0] == "Nov"){
    Month = "11";
  }else if(date[0] == "Dec"){
    Month = "12";
  }

  return `${Year}-${Month}-${Day} ${Hours}`;
}

function DateFormatPtBr(value){
  value = value.replace(' 00:00:00','');
  value = value.split('-')

  date = `${value[2]}/${value[1]}/${value[0]}`;
  return date;
}

function DateFormtDatePicker(value){
  value = value.replace(' 00:00:00','');
  value = value.split('-');

  let Year = value[0];
  let Month;
  let Day = value[2];

  if (value[1] == "01") {
    Month = "Jan";
  }else if(value[1] == "02"){
    Month = "Feb";
  }else if(value[1] == "03"){
    Month = "Mar";
  }else if(value[1] == "04"){
    Month = "Apr";
  }else if(value[1] == "05"){
    Month = "May";
  }else if(value[1] == "06"){
    Month = "Jun";
  }else if(value[1] == "07"){
    Month = "Jul";
  }else if(value[1] == "08"){
    Month = "Aug";
  }else if(value[1] == "09"){
    Month = "Sep";
  }else if(value[1] == "10"){
    Month = "Oct";
  }else if(value[1] == "11"){
    Month = "Nov";
  }else if(value[1] == "12"){
    Month = "Dec";
  }

  return `${Month} ${Day}, ${Year}`

}

function optionCRUDCampanhas(buttonHtml){

  $('.btn-action-formCampanha').html(buttonHtml);

  if (buttonHtml == 'Salvar') {
    clearForm('#formCampanha');

    $('.btn-action-formCampanha').on('click', function(event) {
      CRUDCampanhas('Insert');
        //event.preventDefault();
      });

  }else if (buttonHtml == 'Editar') {
    $('.btn-action-formCampanha').on('click', function(event) {
      CRUDCampanhas('Update');
       // event.preventDefault();
     });
  }
}