var infosRespostas = [];
var respostas = [];
$(document).ready(function($) {
	Respostas();

});

function Respostas(){
  let sql = `select Campanha ,COUNT(a.IdCampanha) as countRespostas, a.Status, IdQuestionario, a.IdCampanha from escala75_Easy7.RespostasUsers a
join escala75_Easy7.Campanhas b on a.IdCampanha = b.Id
left join escala75_Easy7.ClientesCampanhas c on a.IdCampanha = c.IdCampanha
${$('#IdUser').val() != undefined ? `where c.IdUsuario = ${$('#IdUser').val()}` : ''}
group by Campanha;`
  
  SelectAdvanced(sql);

  let data = dataSelectAdvanced;

  $('.tbody-Respostas').html(fnTemplateIndex(data));
  $('.dropdown-trigger').dropdown();
  $('#modalResposta').modal('close');
  $('.tooltipped').tooltip();
  clearForm('#formResposta');
}


function fnTemplateIndex(model){
	return model.map(x => {
		return`
		<tr>
			<td>${x.Status == 0 ? 'Desativado' : 'Ativo'}</td>
			<td>${x.Campanha}</td>
			<td><button type="button" class="btn btn-blue waves-effect tooltipped"  data-position="bottom" data-tooltip="Visualizar respostas" onclick="returnPerguntas(${x.IdQuestionario})">Respostas (${x.countRespostas})</button></td>
			<td><i class="material-icons i-default tooltipped" data-position="bottom" data-tooltip="Visualizar respostas" onclick="returnPerguntas(${x.IdQuestionario})">remove_red_eye</i></td>
		</tr>
		`
	});
}

function returnPerguntas(IdQuestionario, option = 'Select'){

	  let sql = `select a.* from escala75_Easy7.Perguntas a
		join escala75_Easy7.QuestionarioPerguntas b on a.Id = b.IdPergunta
		where IdQuestionario = ${IdQuestionario}
		`
	  
	  SelectAdvanced(sql);

	  let data = dataSelectAdvanced;
	  returnRespostas(IdQuestionario, data);

	/*
	let Schema = 'escala75_Easy7';
  	let tableName = 'Perguntas';
  	let columns = 'Id, Pergunta, Tipo'
//  	let where = `IdQuestionario = ${IdCampanha}`

	let params = {
		Schema,
		tableName,
		columns,
//		where,
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
		
		returnRespostas(IdCampanha, data);
		
	})
	.fail(function() {
		console.log("error");
		$('#modalProgress').modal('close');
	});
	*/
}

function returnRespostas(IdCampanha, Perguntas, option = 'Select'){

	let Schema = 'escala75_Easy7';
  	let tableName = 'RespostasCampanha';
  	let columns = 'Id, IdCampanha, CPF, Respostas'
  	let where = `IdCampanha = ${IdCampanha}`

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
		console.log("success");
		infosRespostas = data;

		$('.div-questionario-campanha').html(templatePerguntas(Perguntas));
		$('#modalResposta').modal('open');
		$('#modalProgress').modal('close');
	})
	.fail(function() {
		console.log("error");
		$('#modalProgress').modal('close');
	});
	
}

function templatePerguntas(model){
	return infosRespostas.map((value, i) => {
	respostas = infosRespostas[i].Respostas.split(',');
	return`
		<ul class="collection">
			<li class="collection-item avatar">
				<img src="images/DESK/4_wireframes_web_usuarios_cadastro/icone_usuario_fundo.png" alt="" class="circle">
				<span class="title CPFUsers">${value.CPF}</span>
				<p>
				${
					model.map((valuePergunta, i) => {
						return`
						<label class="lb-Perguntas">Pergunta: ${valuePergunta.Pergunta}</label> <label class="lb-respostas">Resposta: ${respostas[i]}</label>
						<br>
						`
					}).join('')	
				}
					
				</p>
			</li>
		</ul>
	`
}).join('')
}

