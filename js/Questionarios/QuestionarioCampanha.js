var IdQuestionario = Campanha[0]["IdQuestionario"]

$(document).ready(function($) {
	$('.modal').modal();
	returnPerguntas();
});

function sendForm(option = 'Insert'){

	validarForm('#formQuestionarioCampanha');

	if (v == false) {
		return false;
	}

	InserRespostasUsers();
	let str = "";

	let Schema = 'escala75_Easy7';
  	let tableName = 'RespostasCampanha';
  	let columns = 'IdQuestionario, CPF, Respostas, DateRegistration'
  	
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
		$('#modalProgress').modal('close');
		createSession();
		window.location.href = window.location.href.replace('QuestionarioCampanha', 'HomeMobile')+"&Questionario=OK"
	})
	.fail(function() {
		console.log("error");
		$('#modalProgress').modal('close');
	});
}


function InserRespostasUsers(option = 'Insert'){
	let Schema = 'escala75_Easy7';
  	let tableName = 'RespostasUsers';
  	let columns = 'IdCampanha, CPF, Status, DateRegistration'

  	let lastquery = `${$('#IdQuestionario').val()}, '${$('#UserRegistration').val()}', 1, now()`


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
		$('#modalProgress').modal('close');
	})
	.fail(function() {
		console.log("error");
		$('#modalProgress').modal('close');
	});
}

function returnPerguntas(){
	let sql = `SELECT perguntas.Id, questionarioperguntas.IdQuestionario, perguntas.Pergunta, perguntas.Status, perguntas.Tipo, questionarios.Name FROM escala75_Easy7.Perguntas as perguntas
	  left join escala75_Easy7.QuestionarioPerguntas as questionarioperguntas on perguntas.Id = questionarioperguntas.IdPergunta
	  left join escala75_Easy7.Questionarios as questionarios on questionarioperguntas.IdQuestionario = questionarios.Id
	  where  questionarioperguntas.IdQuestionario = ${IdQuestionario};`
	
	SelectAdvanced(sql);

	let data = dataSelectAdvanced;

	$('.form-questionario-campanha').html(templatePerguntas(data));
	$('#modalProgress').modal('close');
}

function templatePerguntas(model){
	return`
		<input type="hidden" name="IdQuestionario" id="IdQuestionario" value="${IdQuestionario}">
		<form class="col s12" id="formQuestionarioCampanha">
			${model.map(value =>{
				return`
					<div class="row">
						<div class="input-field col s12">
							${value.Tipo == 0 ? 
								`
									<div class="input-field col s12">
										<input type="text" id="${value.Id}" class="autocomplete c-blue" plc="'${value.Pergunta}'">
										<label for="${value.Id}" class="c-blue">${value.Pergunta}</label>
									</div>
								`
							: `
								<div class="input-field col s12">
								    <select id="${value.Id}" plc="'${value.Pergunta}'">
								      ${returnOptions(value.Id, value.IdQuestionario, value.Pergunta)}								      	
								    </select>
								    <label class="color-default">${value.Pergunta}</label>
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

function returnOptions(IdPergunta, IdQuestionario,firstOption, option = 'Select'){
	let Schema = 'escala75_Easy7';
  	let tableName = 'Respostas';
  	let columns = 'Id, IdPergunta, IdQuestionario,Respostas'
  	let where = `IdPergunta = ${IdPergunta} and Trash = 0`

	let params = {
		Schema,
		tableName,
		columns,
		where,
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
		$('#'+IdPergunta).html(templateOptions(data, firstOption));
		$('select').formSelect();
		$('.select-dropdown li span').each(function(){
    		$(this).html($(this).html().replace(/star/g, '<i class="material-icons yellow-text">star</i>'));
		})
	})
	.fail(function() {
		console.log("error");
		$('#modalProgress').modal('close');
	});
}

function templateOptions(model, firstOption){
	return`
		<option selected disabled value="">${firstOption}</option>
		${model.map((value, i) => {
			return`
				<option value="${value.Id}">${value.Respostas/*Stars(i)*/}</option>
			`	
		}).join('')}
	`
}

function Stars(totalStars){
	stars = [];
	for (var i = 0; i <= totalStars; i++) {
   		stars.push({
   			'star' : i
   		})
   		// more statements
	}

	return stars.map(x => {
		return `
			<label>star</label>
		`
	}).join('')
}