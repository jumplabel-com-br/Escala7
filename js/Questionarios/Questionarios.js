var dataInfos;

$(document).ready(function(){
  $('.sidenav').sidenav();
  $('.dropdown-trigger').dropdown();
  $('.modal').modal();
  $('select').formSelect();
  $('.datepicker').datepicker();
  $('.tooltipped').tooltip();

  select('templateTableQuestionarios');
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

function CRUDQuestionarios(option){

  validarForm('#formQuestionario');

    if (v == false) {
      return false;
    }
  
  let Id = $('#Id').val();
  let Name = $('#Name').val();
  let Status = $('#Status').val();
  let UserRegistration = $('#UserRegistration').val();
  let UserInactivity = $('#UserInactivity').val();

  let param = {
    Name,
    Status,
    UserRegistration,
    UserInactivity
  }


  let Schema = 'Escala7';
  let tableName = 'Questionarios';
  let columns = 'Name,Status,UserRegistration,DateRegistration,UserInactivity,DateInactivity'
  let lastquery = `'${param.Name}', ${param.Status}, '${param.UserRegistration}',now(),'${param.UserInactivity}',now()`;

  let setQuery = `Name = '${param.Name}', Status = ${param.Status},UserRegistration = '${param.UserRegistration}'`
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
    select('templateTableQuestionarios');
    $('#modalUser').modal('close');
  })
  .fail(function() {
    console.log("error");
  });

}

function select(nameFunction, id){

 let option = 'Select';
 let Schema = 'Escala7';
 let tableName = 'Questionarios';

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

  if (data.length > 0 && nameFunction == 'templateTableQuestionarios') {

    $('.tbody-Questionarios').html(templateTableQuestionarios(data));
    $('.dropdown-trigger').dropdown();
    $('#modalQuestionario').modal('close');
    clearForm('#formQuestionario');

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

function templateTableQuestionarios(model){
  return model.map(x => {
    return`
      <tr>
        <td>${x.Name}</td>
        <td>${x.Status == 1 ? 'Ativo' : 'Inativo'}</td>
        <td><a href="#modalQuestionario" class="modal-trigger" onclick="optionCRUDQuestionarios('Editar'); select('', ${x.Id})"><i class="fas fa-edit"></i></a></td>
      </tr>
    `});

}

function setInputsModal(model){

  $('label[for="Name"]').addClass('active');
  $('label[for="Status"]').addClass('active');


  $('#Id').val(model[0].Id)
  $('#Name').val(model[0].Name);
  $('#Status').val(model[0].Status);

   $('select').formSelect();
}

function optionCRUDQuestionarios(buttonHtml){

  $('.btn-action-formQuestionario').html(buttonHtml);

  if (buttonHtml == 'Salvar') {
    clearForm('#formQuestionario');

    $('.btn-action-formQuestionario').on('click', function(event) {
      CRUDQuestionarios('Insert');
        //event.preventDefault();
      });

  }else if (buttonHtml == 'Editar') {
    $('.btn-action-formQuestionario').on('click', function(event) {
      CRUDQuestionarios('Update');
       // event.preventDefault();
     });
  }
}