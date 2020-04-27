$(document).ready(function($) {
	$('.modal').modal();
	returnPerguntas();
});

function sendForm(option = 'Insert'){
	let str = "";

	let Schema = 'Escala7';
  	let tableName = 'RespostasCampanha';
  	let columns = 'IdCampanha, CPF, Respostas, DataCriacao'
  	
  	document.querySelectorAll('form input').forEach(x => str += x.value + ',');
  	let respostas = str.substr(0,str.length-1);

  	let lastquery = `${$('#IdQuestionario').val()}, '${$('#UserRegistration').val()}', '${respostas}', now()`


  	let params = {
		Schema,
		tableName,
		columns,
		lastquery,
		option
	};

	$.ajax({
		url: 'DBInserts.php',
		type: 'POST',
		dataType: 'html',
		data: params,
		beforeSend: function(){
			$('#modalProgress').modal('open');
		}
	})
	.done(function(data) {
		console.log("send success");
	})
	.fail(function() {
		console.log("error");
		$('#modalProgress').modal('close');
	});
}

function returnPerguntas(option = 'Select'){

	let Schema = 'Escala7';
  	let tableName = 'Perguntas';
  	let columns = 'Id, IdQuestionario, Pergunta, Tipo'

	let params = {
		Schema,
		tableName,
		columns,
		option
	};

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
		console.log("success");
		$('.form-questionario-campanha').html(templatePerguntas(data));
		$('select').formSelect();
		$('#modalProgress').modal('close');
	})
	.fail(function() {
		console.log("error");
		$('#modalProgress').modal('close');
	});
	
}

function templatePerguntas(model){
	return`
		<input type="hidden" name="IdQuestionario" id="IdQuestionario" value="${model[0].IdQuestionario}">
		<form class="col s12">
			${model.map(value =>{
				return`
					<div class="row">
						<div class="input-field col s12">
							${value.Tipo == 0 ? 
								`
									<div class="input-field col s12">
										<input type="text" id="${value.IdQuestionario}" class="autocomplete c-blue">
										<label for="${value.IdQuestionario}" class="c-blue">${value.Pergunta}</label>
									</div>
								`
							: `
								<div class="input-field col s12">
								    <select id="${value.IdQuestionario}">
								      ${returnOptions(value.IdQuestionario, value.Pergunta)}								      	
								    </select>
								    <label>${value.Pergunta}</label>
								  </div>
							`}
							
						</div>
					</div>
				`
			}).join('')}
			<div class="row">
				<div class="col s12 center">
					<button type="button" class="btn waves-effect blue darken-3" name="action" onclick="sendForm();">Enviar
					   <i class="material-icons right">send</i>
					 </button
				</div>
			</div>
		</form>
	`;
}

function returnOptions(IdQuestionario,firstOption, option = 'Select'){
	let Schema = 'Escala7';
  	let tableName = 'Respostas';
  	let columns = 'Id, IdQuestionario,Respostas'

	let params = {
		Schema,
		tableName,
		columns,
		option
	};

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
		$('#'+IdQuestionario).html(templateOptions(data, firstOption));
		$('select').formSelect();
	})
	.fail(function() {
		console.log("error");
		$('#modalProgress').modal('close');
	});
}

function templateOptions(model, firstOption){
	return`
		<option selected disabled>${firstOption}</option>
		${model.map(value => {
			return`
				<option value="${value.Id}">${value.Respostas}</option>
			`	
		})}
	`
}