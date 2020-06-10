var infosRespostas = [];
var respostas = [];

function extrairRespostasLivres(){
	if ($('#QuestionariosRL').val() == "") {
		M.toast({html: 'Preencha o campo questionário', displayLength: 4000});
		return false;
	}

	if ($('#CampanhasRL').val() == "") {
		M.toast({html: 'Preencha o campo campanhas', displayLength: 4000});
		return false;
	}

	returnPerguntasLivres($('#QuestionariosRL').val(), $('#CampanhasRL').val());
}
function returnPerguntasLivres(IdQuestionario, IdCampanha, option = 'Select'){

	  let sql = `select d.Id as IdCampanha,d.Campanha, c.Name, a.Pergunta, a.Tipo from escala75_Easy7.Perguntas a
		join escala75_Easy7.QuestionarioPerguntas b on a.Id = b.IdPergunta
		join escala75_Easy7.Questionarios c on b.IdQuestionario = c.Id
		join escala75_Easy7.Campanhas d on c.Id = d.IdQuestionario
		where b.IdQuestionario = ${IdQuestionario}  and d.Id = ${IdCampanha}
		`
	  SelectAdvanced(sql);

	  let data = dataSelectAdvanced;
	  returnRespostasLivres(IdQuestionario, data);
}

function returnRespostasLivres(IdQuestionario, Perguntas, option = 'Select'){

	let Schema = 'escala75_Easy7';
  	let tableName = 'RespostasCampanha';
  	let columns = 'CPF, Respostas, DateRegistration'
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
		respostas = infosRespostas[i].Respostas.split(',');
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