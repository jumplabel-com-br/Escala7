var infosRespostas = [];
var respostas = [];
var pergunta = [];
var respostaTotal = [];
var perguntaRespostaTotal = [];
var repetidos = [];
var unicos = [];
var dataPoints = [];
var labelY;

function extrairRespostasCombo(){
	/*if ($('#QuestionariosRC').val() == "") {
		M.toast({html: 'Preencha o campo questionário', displayLength: 4000});
		return false;
	}*/

	if ($('#CampanhasRC').val() == "") {
		M.toast({html: 'Preencha o campo campanhas', displayLength: 4000});
		return false;
	}

	/*
	if ($('#PerguntasRC').val() == "") {
		M.toast({html: 'Preencha o campo pergunta', displayLength: 4000});
		return false;
	}*/

	returnPerguntas($('#CampanhasRC').val());
}

function returnGrafico(option = 'Insert'){
	repetidos = [];
	unicos = [];
	labelY = [];
	
	perguntaRespostaTotal.map( (x,i) => { 
	    if (respostaTotal.indexOf(x.Respostas) > 0 && pergunta.indexOf(x.Perguntas) > -1 ) {
	    	repetidos.push({'label': x.Perguntas, 'y': 1, resposta : x.Respostas}) 
	    }else{
	    	unicos.push({'label': x.Perguntas, 'y': 1, resposta : x.Respostas})
	    }
	});

	labelY = repetidos.concat(unicos);

	labelY.map(x => {
		let label = x.label;
		let y = x.y;
		let resposta = x.resposta;
		let Schema = 'escala75_Easy7';
		let tableName = 'grafico';
		let columns = 'label, y, resposta';
		let lastquery = `'${label}', ${y}, '${resposta}'`;

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
			async : false,
			data: param,
			
		})
		.done(function() {
			console.log("success insert grafico");
		})
		.fail(function() {
			console.log("error");
		});
	});

	selectGrafico();
}

function selectGrafico(){
	let sql = 'select label, sum(y) as y, resposta from escala75_Easy7.grafico group by label, resposta;'
	SelectAdvanced(sql);

	let data = dataSelectAdvanced;

	dataPoints = [];
	data.map(elem => {
	    dataPoints.push({
	        label : elem.label+'R: '+elem.resposta,
	        y : parseInt(elem.y)
	    });
	});
	if (dataSelectAdvanced.length > 0) {
		grafico('#RespostasCombo', dataPoints);
		$('#modal1').modal('open');
	}else{
		M.toast({html: 'Não há informações de acordo com o selecionado', displayLength: 4000});
	}
}

function deleteGrafico(option = 'Delete'){
	let Schema = 'escala75_Easy7';
	let tableName = 'grafico';
	let where = 'y >= 1'

	let param = {
		Schema,
		tableName,
		where,
		option
	}

	$.ajax({
		url: 'DBInserts.php',
		type: 'POST',
		dataType: 'html',
		async : false,
		data: param,
		beforeSend: function(){
				$('#modalProgress').modal('open');
		}
	})
	.done(function() {
		console.log("success delete chart");
	})
	.fail(function() {
		console.log("error");
	});
}

function returnPerguntas(IdCampanha, option = 'Select'){

	  let sql = `select d.Id as IdCampanha,d.Campanha, c.Name, a.Pergunta, a.Tipo,  d.IdQuestionario 
	  	from escala75_Easy7.Perguntas a
		join escala75_Easy7.QuestionarioPerguntas b on a.Id = b.IdPergunta
		join escala75_Easy7.Questionarios c on b.IdQuestionario = c.Id
		join escala75_Easy7.Campanhas d on c.Id = d.IdQuestionario
		where d.Id = ${IdCampanha} and b.IdQuestionario = d.IdQuestionario;
		`
	  SelectAdvanced(sql);

	  let data = dataSelectAdvanced;
	  if (dataSelectAdvanced.length > 0) {
	  	returnRespostas(data[0].IdQuestionario, data);
	  	deleteGrafico();
	  }else{
	  	M.toast({html: 'Não há informações de acordo com o selecionado', displayLength: 4000});
	  }
	  
}

function returnRespostas(IdQuestionario, Perguntas, option = 'Select'){

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

		if (data.length > 0 ) {
			$('#tbodyRespostasCombo').html(templatePerguntas(Perguntas));
			returnGrafico()
		}else{
			M.toast({html: 'Não há informações para esse questionário', displayLength: 4000});
		}
		//$('#modalResposta').modal('open');
		//$('#modalProgress').modal('close');
	})
	.fail(function() {
		console.log("error");
		$('#modalProgress').modal('close');
	});
	
}

/*
function returnOptionPerguntas(){
	let Schema = 'escala75_Easy7';
  	let tableName = 'Perguntas';
  	let columns = 'Id, Pergunta'
  	let option = 'Select';

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

		if (data.length > 0 ) {
			$('#PerguntasRC').html(templateOptionPerguntas(data));
		}else{
			M.toast({html: 'Não há informações para essa campanha com essa pergunta', displayLength: 4000});
		}
		//$('#modalResposta').modal('open');
		$('select').formSelect();
		$('#modalProgress').modal('close');
	})
	.fail(function() {
		console.log("error");
		$('#modalProgress').modal('close');
	});
}

function templateOptionPerguntas(model){
	return`
		<option value="">Selecione</option>
		${
			model.map(elem => {
				return`
					<option value="${elem.Id}">${elem.Pergunta}</option>
				`
			})
		}
	`
}*/


function templatePerguntas(model){
	pergunta = [];
	respostaTotal = [];
	perguntaRespostaTotal = [];

return infosRespostas.map((value, i) => {
		respostas = infosRespostas[i].Respostas.split(',');
		infos =  infosRespostas[i]
			return model.map((valuePergunta, i) => {
				if (valuePergunta.Tipo == "1" && respostas[i] != undefined) {
					pergunta.push(valuePergunta.Pergunta)
					respostaTotal.push(respostas[i])
					perguntaRespostaTotal.push({
						Perguntas : valuePergunta.Pergunta,
						Respostas : respostas[i]
					})
					return`
						<tr>
							<td>${infos.CPF}</td>
							<td>${DatePtBr(infos.DateRegistration)}</td>
							<td>${valuePergunta.Campanha}</td>
							<td>${valuePergunta.Name}</td>
							<td>${valuePergunta.Pergunta}</td>
							<td>${respostas[i]}</td>
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