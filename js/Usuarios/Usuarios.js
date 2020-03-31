var dataInfos;

  $(document).ready(function(){
  	$('.sidenav').sidenav();
  	$('.dropdown-trigger').dropdown();
  	$('.modal').modal();
  	$('select').formSelect();
    $('.tooltipped').tooltip();
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

  function CRUDUsers(option){
    let Id = $('#Id').val();
    let Nome = $('#Nome').val();
    let Email = $('#Email').val();
    let CPF = $('#CPF').val();
    let Senha = $('#Senha').val();
    let Status = $('#Status').val();
    let UserType = $('#UserType').val();
    let UserRegistration = $('#UserRegistration').val();
    let UserInactivity = $('#UserInactivity').val();

    select('CPF', '', 'Select', `email = '${Email}' or CPF = '${CPF}'`, true);

    validarForm('#formUser');

    if (v == false) {
      $('#modalProgress').modal('close');
      return false;
      console.log('v: ',v)
    }


  	let param = {
  		Nome,
  		Email,
  		CPF,
  		Senha,
  		Status,
  		UserType,
  		UserRegistration,
  		UserInactivity
  	}


  	let Schema = 'Escala7';
  	let tableName = 'Users';
  	let columns = 'Nome,Email,CPF,Senha,Status,UserType,UserRegistration,DateRegistration,UserInactivity,DateInactivity'
  	let lastquery = `'${param.Nome}','${param.Email}','${param.CPF}','${param.Senha}',${param.Status},'${param.UserType}','${param.UserRegistration}',now(),'${param.UserInactivity}',now()`;

    let setQuery = `Nome = '${param.Nome}',Email = '${param.Email}',CPF = '${param.CPF}', Senha = '${param.Senha}', Status = ${param.Status},
    UserType = '${param.UserType}',UserRegistration = '${param.UserRegistration}'`
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
  		select('*', 'templateCardsUsuarios');
      $('#modalUser').modal('close');
  	})
  	.fail(function() {
  		console.log("error");
  	});
  	
  }

  function select(columns, nameFunction, option = 'Select', where = '', search = false){

  	let Schema = 'Escala7';
  	let tableName = 'Users';

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

  		if (data.length > 0 && nameFunction == 'templateCardsUsuarios') {
  			
  			$('.row-cards-usuarios').html(templateCardsUsuarios(data));
  			$('.dropdown-trigger').dropdown();

  		}else if(nameFunction == 'inputsCardsValues'){
  			inputsCardsValues(data)
  		}else{
        return dataInfos;
      }

      if (dataInfos.length > 0 && $('.btn-action-formUser').html() == 'Salvar' && search == true) {
        M.toast({html: 'Email ou CPF já cadastrados', displayLength: 4000});
        $('#modalProgress').modal('close');
        return false;
      }

      $('#modalProgress').modal('close');
      $('.tooltipped').tooltip();

  	})
  	.fail(function() {
  		console.log("error");
      M.toast({html: 'Erro ao processar dados, informe o suporte ou tente novamente mais tarde', displayLength: 4000})
      $('#modalProgress').modal('close');
  	})
  	
  }

  function templateCardsUsuarios(model){

  	return model.map(x => {
  		return`
  		<div class="col s12 m3 tooltipped" data-position="top" data-tooltip="Clique para Editar/Visualizar" onclick="setHTMLButtonModal('Editar', ${x.Id});" class="modal-trigger">
        <div class="card white">
          <div class="card-content white-text card-usuario center-align">
            <img src="images/DESK/3_wireframes_web_usuarios_cadastrados/icone_usuario.png" class="responsive-img">
            <p class="card-ml-20-p">
              <p class="color-default">${x.Nome}</p>
              <p class="color-default">${x.CPF}</p>
            </p>
          </div>
        </div>
      </div>
  		`});
  }

  function setHTMLButtonModal(tipo, id){

    $('#modalUser').modal('open');

    if (tipo == 'Salvar') {
      clearForm('#formUser');

      $('#controlButton').val('Salvar')  
    }else if(tipo == 'Editar'){
      select('*', 'inputsCardsValues', 'Select', `id = ${id}`);
      $('#formUser #Id').val(id);
      $('#controlButton').val('Editar');
    }

    $('select').formSelect();

    $('.btn-action-formUser').html($('#controlButton').val());
  }

  function disabledInputsCards(formName){
   $(`${formName} input, ${formName} select`).addClass('disabled')
   $('.disabled').attr('disabled', 'disabled')
  }

  function inputsCardsValues(model){

    $('label[for="Nome"]').addClass('active');
	   $('label[for="Email"]').addClass('active');
	   $('label[for="CPF"]').addClass('active');
	   $('label[for="Senha"]').addClass('active');
	   $('label[for="Status"]').addClass('active');
	   $('label[for="UserType"]').addClass('active');

    $('#Id').val(model[0].Id)
  	$('#Nome').val(model[0].Nome);
  	$('#Email').val(model[0].Email);
  	$('#CPF').val(model[0].CPF);
  	$('#Senha').val(model[0].Senha);
  	$('#Status').val(model[0].Status);
  	$('#UserType').val(model[0].UserType);

  	 $('#Status').formSelect();
  	 $('#UserType').formSelect();
  }

  jQuery(document).ready(function($) {
    select('*', 'templateCardsUsuarios');
  });