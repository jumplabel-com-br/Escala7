var dataInfos;

  $(document).ready(function(){
  	$('.sidenav').sidenav();
  	$('.dropdown-trigger').dropdown();
  	$('.modal').modal();
  	$('select').formSelect();
    $('.tooltipped').tooltip();

    $('#modal1').modal('open');
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
  		select('SELECT * FROM Escala7.Users', 'templateCardsUsuarios');
      $('#modalUser').modal('close');
  	})
  	.fail(function() {
  		console.log("error");
  	});
  	
  }

  function select(sql, nameFunction){

  	let option = 'Select';
  	let Schema = 'Escala7';
  	let tableName = 'Users';

  	let params = {
  		sql,
  		option,
  		Schema,
  		tableName,
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
  		}

      $('#modalProgress').modal('close');
  	})
  	.fail(function() {
  		console.log("error");
      M.toast({html: 'Erro ao processar dados, informe o suporte', displayLength: 4000})
      $('#modalProgress').modal('close');
  	})
  	
  }

  function templateCardsUsuarios(model){

  	return model.map(x => {
  		return`
  		<div class="col s12 m3">
  		  <div class="card">
  		    <div class="right-align">
  		      <i class="fas fa-ellipsis-h dropdown-trigger" data-target='dropdown1'></i>
  		      <ul id='dropdown1' class='dropdown-content'>
  		        <li><a href="#modalUser" class="modal-trigger" onclick="$('#modalUser').modal('open');$('.btn-action-formUser').html('Editar'); select('select * from  Escala7.Users where id = ${x.Id}', 'inputsCardsValues');optionCRUDUsers('Editar');disabledInputsCards('#modalUser')"><i class="material-icons right">send</i>visualizar mais</a></li>
  		        <li><a href="#modalUser" class="modal-trigger" onclick="$('#modalUser').modal('open');$('.btn-action-formUser').html('Editar'); select('select * from  Escala7.Users where id = ${x.Id}', 'inputsCardsValues');optionCRUDUsers('Editar');">editar <i class="material-icons right">send</i></a></li>
  		      </ul>
  		    </div>
  		    <div class="card-content center-align">
  		      <span class="card-title"><i class="xl material-icons">account_box</i></span>
  		    </div>
  		    <div class="card-action">
  		      <p class="center-align">
  		        Nome: ${x.Nome}
  		        <br>
  		        ${x.CPF}
  		      </p>
  		    </div>
  		  </div>
  		</div>
  		`});
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

  function optionCRUDUsers(buttonHtml){
    if (buttonHtml == 'Salvar') {
      
      $('.btn-action-formUser').on('click', function(event) {
        CRUDUsers('Insert');
        //event.preventDefault();
      });

    }else if (buttonHtml == 'Editar') {
      $('.btn-action-formUser').on('click', function(event) {
        CRUDUsers('Update');
       // event.preventDefault();
      });
    }
  }

  jQuery(document).ready(function($) {
    select('SELECT * FROM Escala7.Users', 'templateCardsUsuarios');
  });