var infosRespostas = [];
var respostas = [];

function extrairRespostasLivres(){
	/*if ($('#QuestionariosRL').val() == "") {
		M.toast({html: 'Preencha o campo questionário', displayLength: 4000});
		return false;
	}*/

	if ($('#CampanhasRL').val() == "") {
		M.toast({html: 'Preencha o campo campanhas', displayLength: 4000});
		return false;
	}

	returnPerguntasLivres($('#CampanhasRL').val());
}
function returnPerguntasLivres(IdCampanha, option = 'Select'){

	  let sql = `select d.Id as IdCampanha,d.Campanha, c.Name, a.Pergunta, a.Tipo, d.IdQuestionario from escala75_Easy7.Perguntas a
		join escala75_Easy7.QuestionarioPerguntas b on a.Id = b.IdPergunta
		join escala75_Easy7.Questionarios c on b.IdQuestionario = c.Id
		join escala75_Easy7.Campanhas d on c.Id = d.IdQuestionario
		where d.Id = ${IdCampanha} and b.IdQuestionario = d.IdQuestionario
		`
	  SelectAdvanced(sql);

	  let data = dataSelectAdvanced;
	  returnRespostasLivres(data[0].IdQuestionario, data, IdCampanha);
}

function returnRespostasLivres(IdQuestionario, Perguntas, IdCampanha, option = 'Select'){

	let Schema = 'escala75_Easy7';
  	let tableName = 'RespostasCampanha';
  	let columns = 'CPF, Respostas, DateRegistration'
  	let where = `IdQuestionario = ${IdQuestionario} and IdCampanha = ${IdCampanha}`

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

		if (data.length > 0) {
			$('#tbodyRespostasLivres').html(templatePerguntasLivres(Perguntas));
			exportExcel('relatorioRespostasLivres', 'Relatório Respostas Livres')
		}else{
			M.toast({html: 'Não há informações para esse questionário', displayLength: 4000});
		}
		//$('#modalResposta').modal('open');
		$('#modalProgress').modal('close');
	})
	.fail(function() {
		console.log("error");
		$('#modalProgress').modal('close');
	});
	
}


function templatePerguntasLivres(model){
return infosRespostas.map((value, i) => {
		respostas = infosRespostas[i].Respostas.split('$&');
		infos =  infosRespostas[i]
			return model.map((valuePergunta, i) => {
				if (valuePergunta.Tipo == "0") {
					return`
						<tr>
							<td>${infos.CPF}</td>
							<td>${DatePtBr(infos.DateRegistration)}</td>
							<td>${valuePergunta.Campanha}</td>
							<td>${valuePergunta.Name}</td>
							<td>${valuePergunta.Pergunta}</td>
							<td>${respostas[i] == undefined ? 'Pergunta cadastradas pós resposta' : respostas[i]}</td>
						</tr>
				`
				}
			}).join('')
	}).join('')
}

function DatePtBr(date){
	arrDate = date.split(' ');
	arrDate = arrDate[0].split('-')[2]+'/'+arrDate[0].split('-')[1]+'/'+arrDate[0].split('-')[0]+' '+arrDate[1];
	return arrDate;
}