var infosRespostas = [];
var respostas = [];
$(document).ready(function($) {
	Respostas();

});

function Respostas(){

	let sql = `select Campanha ,COUNT(a.IdCampanha) as countRespostas, a.IdQuestionario, a.IdCampanha from escala75_Easy7.RespostasCampanha a
	join escala75_Easy7.Campanhas b on a.IdCampanha = b.Id
	${$('#IdUser').val() != undefined ? `
										left join escala75_Easy7.ClientesCampanhas c on a.IdCampanha = c.IdCampanha
										where c.IdUsuario = ${$('#IdUser').val()}` : ''}
	group by a.IdCampanha;`
  
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
			<td><button type="button" class="btn btn-blue waves-effect tooltipped"  data-position="bottom" data-tooltip="Visualizar respostas" onclick="returnPerguntas(${x.IdQuestionario}, ${x.IdCampanha})">Respostas (${x.countRespostas})</button></td>
			<td><i class="material-icons i-default tooltipped" data-position="bottom" data-tooltip="Visualizar respostas" onclick="returnPerguntas(${x.IdQuestionario}, ${x.IdCampanha})">remove_red_eye</i></td>
		</tr>
		`
	});
}

function returnPerguntas(IdQuestionario, IdCampanha, option = 'Select'){

	  let sql = `select a.* from escala75_Easy7.Perguntas a
		join escala75_Easy7.QuestionarioPerguntas b on a.Id = b.IdPergunta
		join escala75_Easy7.Campanhas c on b.IdQuestionario = c.IdQuestionario
		where b.IdQuestionario = ${IdQuestionario} and c.Id = ${IdCampanha}
		`
	  
	  SelectAdvanced(sql);

	  let data = dataSelectAdvanced;
	  returnRespostas(IdQuestionario, IdCampanha, data);
}

function returnRespostas(IdQuestionario, IdCampanha, Perguntas, option = 'Select'){

	let sql = `SELECT * FROM escala75_Easy7.RespostasCampanha a
	join escala75_Easy7.Campanhas b on a.IdQuestionario = b.IdQuestionario
	where a.IdQuestionario = ${IdQuestionario} and b.Id = ${IdCampanha} and a.IdCampanha = ${IdCampanha} `;

	SelectAdvanced(sql);
	infosRespostas = dataSelectAdvanced;

	$('.div-questionario-campanha').html(templatePerguntas(Perguntas));
	$('#modalResposta').modal('open');
	$('#modalProgress').modal('close');

	/*
	let Schema = 'escala75_Easy7';
  	let tableName = 'RespostasCampanha';
  	let columns = 'Id, IdQuestionario, CPF, Respostas'
  	let where = `IdQuestionario = ${IdQuestionario}`

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
	});*/
	
}

function templatePerguntas(model){
	return infosRespostas.map((value, i) => {
	respostas = infosRespostas[i].Respostas.split('$&');
	return`
		<ul class="collection">
			<li class="collection-item avatar">
				<img src="images/DESK/4_wireframes_web_usuarios_cadastro/icone_usuario_fundo.png" alt="" class="circle">
				<span class="title CPFUsers">${value.CPF}</span>
				<p>
				${
					model.map((valuePergunta, i) => {
						return`
						<label class="lb-Perguntas">Pergunta: ${valuePergunta.Pergunta}</label> <label class="lb-respostas">Resposta: ${respostas[i] == undefined ? "cadastro de pergunta pós resposta" : respostas[i]}</label>
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

