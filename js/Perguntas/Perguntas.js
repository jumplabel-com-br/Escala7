var dataInfos;
var IdQuestionario;
var PerguntasQuestionarios;

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

function filtersPerguntas(){
  let where = 'where'
  let statusFilter = '';
  let perguntasFilter = '';

  if ($('#StatusFilter').val() != null && $('#StatusFilter').val().length > 0){
    statusFilter = ` and perguntas.Status = ${$('#StatusFilter').val()}`  
    where += statusFilter;
  }

  if ($('#PerguntasFilter').val() != null && $('#PerguntasFilter').val().length > 0) {
    perguntasFilter = ` and perguntas.Pergunta like '%${$('#PerguntasFilter').val()}%'`
    where += perguntasFilter;
  }

  if (statusFilter.length > 0 || perguntasFilter.length > 0) {
    return where.replace('where and', 'where').replace('whereand', 'where');
  }

  return '';
}

function Perguntas(){
  let sql = `SELECT perguntas.Id, questionarioperguntas.IdQuestionario, perguntas.Pergunta, perguntas.Status, questionarios.Name FROM escala75_Easy7.Perguntas as perguntas
    left join escala75_Easy7.QuestionarioPerguntas as questionarioperguntas on perguntas.Id = questionarioperguntas.IdPergunta
    left join escala75_Easy7.Questionarios as questionarios on questionarioperguntas.IdQuestionario = questionarios.Id
    ${filtersPerguntas()}
    order by questionarios.Name;`
  
  SelectAdvanced(sql);

  let data = dataSelectAdvanced;
  PerguntasQuestionarios = dataSelectAdvanced;

  $('.tbody-Perguntas').html(templateTablePerguntas(data));
  $('.dropdown-trigger').dropdown();
  $('#modalPergunta').modal('close');
  clearForm('#formPergunta');
}

function selectedQuestionario(option = 'Select'){

  let Schema = 'escala75_Easy7';
  let tableName = 'Questionarios';
  let columns = 'Id, Name';
  let where = 'Status = 1'

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

function CreateQuestionarioPerguntas(option = 'Insert'){
  
  let verificaExistencia = PerguntasQuestionarios.filter(elem => elem.Id == $('#formEditPergunta #Id').val() && elem.IdQuestionario == $('#formEditPergunta #Questionarios').val());

  if (verificaExistencia.length > 0) {
    M.toast({html: 'O cadastro dessa pergunta a este questionário já foi executado', displayLength: 10000});
    return;
  }


  let IdQuestionario = $('#formEditPergunta #Questionarios').val();
  let IdPergunta = $('#formEditPergunta #Id').val();
  let UserRegistration = $('#UserRegistration').val();

  let Schema = 'escala75_Easy7';
  let tableName = 'QuestionarioPerguntas';
  let columns = 'IdQuestionario,IdPergunta,UserRegistration,DateRegistration'
  let lastquery = `${IdQuestionario},${IdPergunta},'${UserRegistration}',now()`;

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
    M.toast({html: 'Questionário cadastrado com êxito', displayLength: 10000})
    //$('#modalPergunta').modal('close');
  })
  .fail(function() {
    console.log("error");
  });

}

function CreatePerguntas(option = 'Insert'){


  validarForm('#formPergunta');

  if (v == false) {
    return false;
  }

  let Pergunta = $(`#formPergunta #Pergunta`).val();
  let Tipo = $(`#formPergunta #Tipo`).val();
  let Status = $(`#formPergunta #Status`).val();
  let Resposta = $(`#formPergunta #Resposta`).val();
  let UserRegistration = $(`#UserRegistration`).val();
  let UserInactivity = $(`#UserInactivity`).val();

  if (Pergunta.length > 100) {
    M.toast({html: 'A pergunta deve ter no máximo 100 caracteres', displayLength: 10000})
    return false;
  }

  let Schema = 'escala75_Easy7';
  let tableName = 'Perguntas';
  let columns = 'Pergunta,Tipo,Status,UserRegistration,DateRegistration,UserInactivity,DateInactivity'
  let lastquery = `'${Pergunta}','${Tipo}','${Status}','${UserRegistration}',now(),'${UserInactivity}',now()`;

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


    if (Pergunta.length > 100) {
      M.toast({html: 'A pergunta deve ter no máximo 100 caracteres', displayLength: 10000})
      return false;
    }


  let Schema = 'escala75_Easy7';
  let tableName = 'Perguntas';
  let setQuery = `Pergunta = '${Pergunta}',Tipo = '${Tipo}', Status = '${Status}', UserRegistration = '${UserRegistration}'`;
  let where = `Id = ${Id}`;

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
  let Schema = 'escala75_Easy7';
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

  let Schema = 'escala75_Easy7';
  let tableName = 'Respostas';
  let columns = '*';
  let where = `IdPergunta = ${$('#formEditPergunta #Id').val()} and Trash = 0`;

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
      $('#Resposta').val('');
    }else{
      $('.tbody-Respostas').html('<tr><td>0</td><td>Nenhum registro encontrado</td></tr>')
    }
  })
  .fail(function() {
    console.log("error");
  });
  
}

function deleteRespostas(id, option = 'Update'){
  let Schema = 'escala75_Easy7';
  let tableName = 'Respostas';
  let setQuery = 'Trash = 1';
  let where = `Id = ${id}`;

  let params = {
    option,
    Schema,
    tableName,
    setQuery,
    where
  }

  $.ajax({
    url: 'DBInserts.php',
    type: 'POST',
    dataType: 'html',
    data: params,
    beforeSend: function(){
      M.toast({html: 'Deletando....'})
    }
  })
  .done(function(data) {
    console.log("success");
    
    selectRespostas();
    M.toast({html: 'Deletado com êxito', displayLength: 10000})
  })
  .fail(function() {
    console.log("error");
  });
}

function select(nameFunction, id, tableName = 'Perguntas', columns = '*', complement){

 let option = 'Select';
 let Schema = 'escala75_Easy7';
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
      <td>${x.Name == null ? 'Definir Questionario' : x.Name}</td>
      <td>${x.Pergunta}</td>
      <td>${x.Status == 1 ? 'Ativo' : 'Inativo'}</td>
      <td><a href="#modalEditPergunta" class="modal-trigger" onclick="Editar(${x.Id}, ${x.IdQuestionario})"><i class="fas fa-edit"></i></a></td>
    </tr>
    `}).join('');
}

function templateRespostas(model){
  return model.map((x, i) => {
    return`
      <tr>
        <td>${i + 1}</td>
        <td>${x.Respostas}</td>
        <td><i class="material-icons red-text darken-3-text pointer" onclick="deleteRespostas(${x.Id})">delete_forever</i></td>
      </tr>
    `
  }).join('');
}

function setInputsModal(model){
  $('label[for="Pergunta"]').addClass('active');
  $('label[for="Tipo"]').addClass('active');
  $('label[for="Status"]').addClass('active');

  $('#formEditPergunta #Id').val(model[0].Id);
  $('#formEditPergunta #Questionarios').val(IdQuestionario);
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

function Editar(idPergunta, idQuestionario){
  $('.btn-action-formPergunta').html('Editar'); 
  select('', idPergunta);
  IdQuestionario = idQuestionario;
}