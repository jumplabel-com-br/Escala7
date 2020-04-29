var dataInfos;

$(document).ready(function(){
 Perguntas();
});

/*
$('#li-img-logo-min').on('click', function(event) {
  $('#mobile-demo').show();
  $('.container-usuarios').addClass('desktop');
  $('#mobile-demo-1').hide();
  event.preventDefault();
  /* Act on the event */
//});

/*$('#li-img-logo-max').on('click', function(event) {
  $('#mobile-demo').hide();
  $('.container-usuarios').removeClass('desktop');
  $('#mobile-demo-1').show();
  event.preventDefault();
  /* Act on the event */
//});


function clearForm(form){
  document.querySelectorAll(`${form} input`).forEach(input => input.value = '');
}

function toggleRespostas(){
  if ($('#formEditPergunta #Tipo').val() == 1) {
    $('.div-respostas, #table-Respostas').show();
  }else{
     $('.div-respostas, #table-Respostas').hide();
  }
}

function Perguntas(){
  let sql = `SELECT perguntas.*, questionarios.Name FROM Escala7.Perguntas as perguntas
    join Escala7.Questionarios as questionarios on perguntas.IdQuestionario = questionarios.Id;`
  
  SelectAdvanced(sql);

  let data = dataSelectAdvanced;

  $('.tbody-Perguntas').html(templateTablePerguntas(data));
  $('.dropdown-trigger').dropdown();
  $('#modalPergunta').modal('close');
  clearForm('#formPergunta');
}

function selectedQuestionario(option = 'Select'){

  let Schema = 'Escala7';
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
    async: false,
    beforeSend: function(){
      $('#modalProgress').modal('open');
    }
  })
  .done(function(data) {

    if (data.length > 0 ) {
      $('.SelectQuestionarios').html(templateQuestionario(data));
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
    return `<option value="${x.Id}">${x.Name}</option>`;
    }).join('')}`
}

function CreatePerguntas(option = 'Insert'){


  validarForm('#formPergunta');

  if (v == false) {
    return false;
  }

  let Questionario = $(`#formPergunta #Questionarios`).val();
  let Pergunta = $(`#formPergunta #Pergunta`).val();
  let Tipo = $(`#formPergunta #Tipo`).val();
  let Status = $(`#formPergunta #Status`).val();
  let Resposta = $(`#formPergunta #Resposta`).val();
  let UserRegistration = $(`#UserRegistration`).val();
  let UserInactivity = $(`#UserInactivity`).val();


  let Schema = 'Escala7';
  let tableName = 'Perguntas';
  let columns = 'IdQuestionario,Pergunta,Tipo,Status,UserRegistration,DateRegistration,UserInactivity,DateInactivity'
  let lastquery = `'${Questionario}','${Pergunta}','${Tipo}','${Status}','${UserRegistration}',now(),'${UserInactivity}',now()`;

  let params = {
    Schema, 
    tableName,
    columns,
    lastquery,
    option
  }

  $.ajax({
    url: 'DBInserts.php',
    type: 'POST',
    dataType: 'html',
    data: params,
  })
  .done(function(data) {
    Perguntas();
    $('#modalPergunta').modal('close');
  })
  .fail(function() {
    console.log("error");
  });

}

function UpdatePerguntas(option = 'Update'){
  let Id = $(`#formEditPergunta #Id`).val();
  let Questionario = $(`#formEditPergunta #Questionarios`).val();
  let Pergunta = $(`#formEditPergunta #Pergunta`).val();
  let Tipo = $(`#formEditPergunta #Tipo`).val();
  let Status = $(`#formEditPergunta #Status`).val();
  let Resposta = $(`#formEditPergunta #Resposta`).val();
  let UserRegistration = $(`#UserRegistration`).val();
  let UserInactivity = $(`#UserInactivity`).val();

  if (form == '#formEditPergunta') {
    if (Questionario == '') {
      alert('Preecha o questionário');
      return false;
    }

    if (Pergunta == '') {
      alert('Preecha o questionário');
      return false;
    }

    if (Tipo == '') {
      alert('Preecha o questionário');
      return false;
    }

    if (Status == '') {
      alert('Preecha o questionário');
      return false;
    }
  }


  let Schema = 'Escala7';
  let tableName = 'Perguntas';
  let setQuery = `IdQuestionario = '${Questionario}',Pergunta = '${Pergunta}',Tipo = '${Tipo}', Status = '${Status}', UserRegistration = '${UserRegistration}'`;
  let where = `id = ${Id}`;

  if ($('#Status').val() == 0) {
    setQuery += `, UserInactivity = '${param.UserInactivity}',DateInactivity = now()`
  }

  let params = {
    Schema, 
    tableName,
    setQuery,
    where,
    option
  }

  $.ajax({
    url: 'DBInserts.php',
    type: 'POST',
    dataType: 'html',
    data: params,
  })
  .done(function(data) {
    Perguntas();
    $('#modalEditPergunta').modal('close');
  })
  .fail(function() {
    console.log("error");
  });
}

function CreateRespostas(option = 'Insert'){


  let resposta = $('#Resposta').val();
  let IdPergunta = $('#formEditPergunta #Id').val();
  let IdQuestionario = $('#formEditPergunta #Questionarios').val();
  let Schema = 'Escala7';
  let tableName = 'Respostas';
  let columns = 'IdPergunta, IdQuestionario, Respostas'
  let lastquery = `${IdPergunta}, ${IdQuestionario}, '${resposta}'`;


  let param = {
    Schema,
    tableName,
    columns,
    lastquery,
    option
  }

  $.ajax({
    url: 'DBInserts.php',
    type: 'POST',
    dataType: 'html',
    data: param,
  })
  .done(function() {
    console.log("success respostas");
    selectRespostas();
  })
  .fail(function() {
    console.log("error");
  });
  
}

function selectRespostas(option = 'Select'){

  let Schema = 'Escala7';
  let tableName = 'Respostas';
  let columns = '*';
  let where = `IdPergunta = ${$('#formEditPergunta #Id').val()}`;

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
    
    if (data.length > 0) {
      $('.tbody-Respostas').html(templateRespostas(data));
    }else{
      $('.tbody-Respostas').html('<tr><td>0</td><td>Nenhum registro encontrado</td></tr>')
    }
  })
  .fail(function() {
    console.log("error");
  });
  
}

function select(nameFunction, id, tableName = 'Perguntas', columns = '*', complement){

 let option = 'Select';
 let Schema = 'Escala7';
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

  if (data.length > 0 && id > 0 && nameFunction == '') {

    selectedQuestionario();
    setInputsModal(data);

  }else{
    return data;
  }


  $('#modalProgress').modal('close');
})
.fail(function() {
  console.log("error");
  M.toast({html: 'Erro ao processar dados, informe o suporte', displayLength: 4000})
  $('#modalProgress').modal('close');
})

}

function templateTablePerguntas(model){
  return model.map(x => {
    return`
    <tr>
      <td>${x.Name}</td>
      <td>${x.Pergunta}</td>
      <td>${x.Status == 1 ? 'Ativo' : 'Inativo'}</td>
      <td><a href="#modalEditPergunta" class="modal-trigger" onclick="$('.btn-action-formPergunta').html('Editar'); select('', ${x.Id});"><i class="fas fa-edit"></i></a></td>
    </tr>
    `}).join('');
}

function templateRespostas(model){
  return model.map((x, i) => {
    return`
      <tr>
        <td>${i + 1}</td>
        <td>${x.Respostas}</td>
      </tr>
    `
  }).join('');
}

function setInputsModal(model){
  $('label[for="Pergunta"]').addClass('active');
  $('label[for="Tipo"]').addClass('active');
  $('label[for="Status"]').addClass('active');

  $('#formEditPergunta #Id').val(model[0].Id);
  $('#formEditPergunta #Questionarios').val(model[0].IdQuestionario);
  $('#formEditPergunta #Pergunta').val(model[0].Pergunta);
  $('#formEditPergunta #Tipo').val(model[0].Tipo);
  $('#formEditPergunta #Status').val(model[0].Status);

  $('select').formSelect();
  toggleRespostas();
  selectRespostas();
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