var dataInfos;

$(document).ready(function(){
  selectCampanhas();
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


function selectCampanhas(){

let sql = `select a.* from escala75_Easy7.Campanhas as a
left join escala75_Easy7.ClientesCampanhas as b on a.Id = b.IdCampanha
${$('#IdUser').val() != undefined ? `where b.IdUsuario = ${$('#IdUser').val()}` : ''};`

SelectAdvanced(sql);

let data = dataSelectAdvanced;

data != null && data != undefined && data.length > 0 ? $('.tbody-campanhas').show() : $('.tbody-campanhas').hide()
$('.tbody-campanhas').html(templateTableCampanhas(data));
}

function clearForm(form){
  document.querySelectorAll(`${form} input`).forEach(input => input.value = '');
}

function selectedQuestionario(option = 'Select'){

  let Schema = 'escala75_Easy7';
  let tableName = 'Questionarios';
  let columns = 'Id, Name';

  let params = {
    option,
    Schema,
    tableName,
    columns

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

    if (data.length > 0 ) {
      $('#Questionarios').html(templateQuestionario(data));
      $('select').formSelect();
    }

    $('#modalProgress').modal('close');
  })
  .fail(function() {
    console.log("error");
  });

}

function templateQuestionario(model){
  return `
  <option value="">Questionarios</option>
  ${model.map(x =>{
    return `<option ${x.Id == dataInfos[0].IdQuestionario ? 'selected' : ''} value="${x.Id}">${x.Name}</option>`;
    }).join('')}`
}


function CRUDCampanhas(option){


  validarForm('#formCampanha');

    if (v == false) {
      return false;
    }

  let Id = $('#Id').val();
  let QRCode = $('#QRCode').val();
  let Campanha = $('#Campanha').val();
  let Questionarios = $('#Questionarios').val();
  let Dt_Inicio = dateFormart($('#Dt_Inicio').val());
  let Dt_Termino = dateFormart($('#Dt_Termino').val());
  let Status = $('#Status').val();
  let IFrame = $('#IFrame').val();
  let UserRegistration = $('#UserRegistration').val();
  let UserInactivity = $('#UserInactivity').val();

  let param = {
    QRCode,
    Campanha,
    Questionarios,
    Dt_Inicio,
    Dt_Termino,
    Status,
    IFrame,
    UserRegistration,
    UserInactivity
  }


  let Schema = 'escala75_Easy7';
  let tableName = 'Campanhas';
  let columns = 'QRCode,Campanha,IdQuestionario, Dt_Inicio,Dt_Termino,Status,IFrame,UserRegistration,DateRegistration,UserInactivity,DateInactivity'
  let lastquery = `'${param.QRCode}','${param.Campanha}', '${param.Questionarios}', '${param.Dt_Inicio}','${param.Dt_Termino}',${param.Status},'${param.IFrame}','${param.UserRegistration}',now(),'${param.UserInactivity}',now()`;

  let setQuery = `QRCode = '${param.QRCode}',Campanha = '${param.Campanha}',IdQuestionario = '${param.Questionarios}', Dt_Inicio = '${param.Dt_Inicio}', Dt_Termino = '${param.Dt_Termino}', Status = ${param.Status},
  IFrame = '${param.IFrame}',UserRegistration = '${param.UserRegistration}'`
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
    $('.btn-action-formCampanha').html() == 'Salvar' ? clearForm('#formCampanha') : '';
    $('#modalUser').modal('close');
  })
  .fail(function() {
    console.log("error");
  });

}

function select(nameFunction, id){

 let option = 'Select';
 let Schema = 'escala75_Easy7';
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

    selectCampanhas();
    $('.dropdown-trigger').dropdown();
    $('#modalCampanha').modal('close');
    clearForm('#formCampanha');

  }else if (data.length > 0 && id > 0) {
    selectedQuestionario();
    setInputsModal(data);
    selectClientes();
  }


  $('#modalProgress').modal('close');
})
.fail(function() {
  console.log("error");
  M.toast({html: 'Erro ao processar dados, informe o suporte', displayLength: 4000})
  $('#modalProgress').modal('close');
})

}

function addClientInTemplate(option = 'Insert'){

  let Schema = 'escala75_Easy7';
  let tableName = 'ClientesCampanhas';
  let columns = 'IdCampanha, IdUsuario, UserRegistration , DateRegistration'
  let lastquery = `${$('#Id').val()}, ${$('#VinculoCliente').val()}, '${$('#UserRegistration').val()}', now()`;

  let params = {
    option,
    Schema,
    tableName,
    columns,
    lastquery
  }

  $.ajax({
    url: 'DBInserts.php',
    type: 'POST',
    dataType: 'html',
    data: params,
  })
  .done(function() {
    console.log("success");
    returnClientes();
  })
  .fail(function() {
    console.log("error");
  });
}

function selectClientes(){

  let option = 'Select';
  let Schema = 'escala75_Easy7';
  let tableName = 'Users';

  let columns = 'Id, Email';
  let where = 'UserType = 2';

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
  })
  .done(function(data) {
    console.log("success");
    $('#VinculoCliente').html(templateClientes(data));
    $('select').formSelect();
  })
  .fail(function() {
    console.log("error");
  });
}

function returnClientes(){

  let sql = `SELECT a.Id, Email FROM escala75_Easy7.Users a
  join escala75_Easy7.ClientesCampanhas b on a.Id = b.IdUsuario where IdCampanha = ${$('#Id').val()};`
  
  SelectAdvanced(sql);

  let data = dataSelectAdvanced;

  data != null && data != undefined && data.length > 0 ? $('#table-Clientes').show() : $('#table-Clientes').hide()
  $('.tbody-Clientes').html(templateTableClientes(data));

}

function templateTableClientes(model){
  return model.map((x,i) => {
    return `
      <tr>
        <td>${i+1}</td>
        <td>${x.Email}</td>
      </tr>
    `
  })
}

function templateClientes(model){
  return`
    <option value="" disabled selected>Selecione o cliente que acessará a campanha</option>
    ${model.map(x => {
      return`
        <option value="${x.Id}">${x.Email}</option>
      `
    }).join('')}
  `
}

function templateTableCampanhas(model){
  return model.map(x => {
    return`
      <tr>
        <td>#${x.QRCode}</td>
        <td>${x.Campanha}</td>
        <td>${DateFormatPtBr(x.Dt_Inicio)}</td>
        <td>${DateFormatPtBr(x.Dt_Termino)}</td>
        <td>${x.Status == 1 ? 'Ativo' : 'Inativo'}</td>
        <td><a href="#modalCampanha" class="modal-trigger" onclick="$('.btn-action-formCampanha').html('Editar'); select('', ${x.Id})"><i class="fas fa-edit"></i></a></td>
      </tr>
    `});
}

function setInputsModal(model){

  $('label[for="QRCode"]').addClass('active');
  $('label[for="Campanha"]').addClass('active');
  $('label[for="Dt_Inicio"]').addClass('active');
  $('label[for="Dt_Termino"]').addClass('active');
  $('label[for="Status"]').addClass('active');
  $('label[for="IFrame"]').addClass('active');


  $('#Id').val(model[0].Id);
  $('#QRCode').val(model[0].QRCode);
  $('#Campanha').val(model[0].Campanha);
  $('#Questionarios').val(dataInfos[0].IdQuestionario);
  $('#IdUser').val() != undefined ? $('#Questionarios').attr('disabled' , 'disabled') : '';
  $('#Dt_Inicio').val(DateFormtDatePicker(model[0].Dt_Inicio));
  $('#Dt_Termino').val(DateFormtDatePicker(model[0].Dt_Termino));
  $('#Status').val(model[0].Status);
  $('#IFrame').val(model[0].IFrame);
  $('#iframeCampanha').attr({
    src: model[0].IFrame
  });

  $('.editShow').removeClass('hide');
  returnClientes();
  $('select').formSelect();

  let wlh = window.location.href.split('/');
  let url = wlh[0]+'//'+wlh[2]+`?type=usr&IC=${model[0].Id}&QCC=${model[0].QRCode}`;

      // Clear Previous QR Code
      $('#qrcode').empty();

      // Set Size to Match User Input
      $('#qrcode').css({
        'width' : 158,
        'height' : 158
      })

      // Generate and Output QR Code
      $('#qrcode').qrcode({width: 158,height: 158,text: url});
    }

function dateFormart(inputDate){
  date = inputDate.replace(',','').split(" ");

  let Year = date[2];
  let Month;
  let Day = date[1];
  let Hours = " 00:00:00";

  if (date[0] == "Jan") {
    Month = "01";
  }else if(date[0] == "Fev"){
    Month = "02";
  }else if(date[0] == "Mar"){
    Month = "03";
  }else if(date[0] == "Abr"){
    Month = "04";
  }else if(date[0] == "Mai"){
    Month = "05";
  }else if(date[0] == "Jun"){
    Month = "06";
  }else if(date[0] == "Jul"){
    Month = "07";
  }else if(date[0] == "Aug"){
    Month = "08";
  }else if(date[0] == "Set"){
    Month = "09";
  }else if(date[0] == "Out"){
    Month = "10";
  }else if(date[0] == "Nov"){
    Month = "11";
  }else if(date[0] == "Dez"){
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
    Month = "Fev";
  }else if(value[1] == "03"){
    Month = "Mar";
  }else if(value[1] == "04"){
    Month = "Abr";
  }else if(value[1] == "05"){
    Month = "Mai";
  }else if(value[1] == "06"){
    Month = "Jun";
  }else if(value[1] == "07"){
    Month = "Jul";
  }else if(value[1] == "08"){
    Month = "Ago";
  }else if(value[1] == "09"){
    Month = "Set";
  }else if(value[1] == "10"){
    Month = "Out";
  }else if(value[1] == "11"){
    Month = "Nov";
  }else if(value[1] == "12"){
    Month = "Dez";
  }

  return `${Month} ${Day}, ${Year}`

}