var infosRespostas = [];
var respostas = [];
var pergunta = [];
var respostaTotal = [];
var perguntaRespostaTotal = [];
var repetidos = [];
var unicos = [];
var dataPoints = [];
var labelY;

jQuery(document).ready(function($) {
	$('.PerguntasRC').hide();
});

function extractCombo(){
	if ($('#CampanhasRC').val() == "") {
		M.toast({html: 'Preencha o campo campanhas para próxima etapa', displayLength: 4000});
		return false;
	}

	exportExcel('relatorioRespostasCombo', 'Relatório Respostas Combo')

}

function extrairRespostasCombo(){
	/*if ($('#QuestionariosRC').val() == "") {
		M.toast({html: 'Preencha o campo questionário', displayLength: 4000});
		return false;
	}*/

	if ($('#CampanhasRC').val() == "") {
		M.toast({html: 'Preencha o campo campanhas', displayLength: 4000});
		return false;
	}


	returnOptionPerguntas();
	$('.PerguntasRC').show();
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

	
	fnPerguntas();
}

function fnPerguntas(){
	//debugger;
	let sql = `SELECT perguntas.Id, perguntas.Pergunta 
	FROM escala75_Easy7.Perguntas as perguntas
	join escala75_Easy7.QuestionarioPerguntas as questPerguntas on perguntas.Id = questPerguntas.IdPergunta
	join escala75_Easy7.Questionarios as questionarios on questPerguntas.IdQuestionario = questionarios.Id
	join escala75_Easy7.Campanhas as campanhas on questionarios.Id = campanhas.IdQuestionario
	where campanhas.Id = ${$('#CampanhasRC').val()};`

	SelectAdvanced(sql);
	let data = dataSelectAdvanced;
	$('#RespostasCombo').html(templateDivsPerguntas(data));
};

function templateDivsPerguntas(model){
	//debugger;
	let divs = '';
	return model.map(elem => {
		idPergunta = elem.Pergunta.normalize("NFD").replace(/[^a-zA-Zs]/g, "")+'_'+elem.Id;
		return`
			<div class="${elem.Id} ${elem.Pergunta}" id="${idPergunta}" style="height: 370px;width: 100%; margin-bottom: 35%;">
			</div> 
			<script>
				fnReturnCanvas('${idPergunta}', '${elem.Pergunta}')
			</script>
		`;
		//return divs;
	}).join('')
}

function fnReturnCanvas(IdPergunta, Pergunta){
	//debugger;
	let data = [];
	let dataPoints = [];
	let sql = `Select label as resposta, sum(y) as y, resposta as label
	FROM escala75_Easy7.Perguntas as perguntas
	join escala75_Easy7.grafico as grafico on perguntas.Pergunta = grafico.label
	where Pergunta = '${Pergunta}'
	${$('#PerguntasRC').val() != 0 ? `and label = '${$('#PerguntasRC').val()}'` : ''}
	group by label, resposta
	order by label;`

	SelectAdvanced(sql);

	dataSelectAdvanced.forEach(elem => {
		if (elem.label != null) {
			dataPoints.push({
	        	label : elem.label,
	        	y : parseInt(elem.y),
	        	resposta : elem.resposta
	    	});

	    	grafico('#'+IdPergunta, dataPoints);
		}else{
			//debugger;
			$(`#`+IdPergunta).remove()
		}
	});

	$('#modal1').modal('open')
	$('#modalProgress').modal('close');
}


/*
function selectGrafico(){
	let sql = `select label, sum(y) as y, resposta from escala75_Easy7.grafico ${$('#PerguntasRC').val() != 0 ? `where label = '${$('#PerguntasRC').val()}'` : ''} group by label, resposta;`
	SelectAdvanced(sql);

	let data = dataSelectAdvanced;

	dataPoints = [];
	data.map(elem => {
	    dataPoints.push({
	        label : $('#PerguntasRC').val() == "0" ? elem.label + ' R:' + elem.resposta : elem.resposta,
	        y : parseInt(elem.y),
	        z : elem.label
	    });
	});
	if (dataSelectAdvanced.length > 0) {
		grafico('#RespostasCombo', dataPoints);
		$('#modal1').modal('open');
	}else{
		M.toast({html: 'Não há informações de acordo com o selecionado', displayLength: 4000});
		$('#modalProgress').modal('close');
	}
}*/

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

	if ($('#PerguntasRC').val() == "") {
		M.toast({html: 'Preencha o campo pergunta', displayLength: 4000});
		return false;
	}

	$('#modalProgress').modal('open');

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
		$('#modalProgress').modal('close');
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
			$('#modalProgress').modal('close');
		}
		//$('#modalResposta').modal('open');
		//$('#modalProgress').modal('close');
	})
	.fail(function() {
		console.log("error");
		$('#modalProgress').modal('close');
	});
	
}


function returnOptionPerguntas(){

	let sql = `select a.* from escala75_Easy7.Perguntas a
		join escala75_Easy7.QuestionarioPerguntas b on a.Id = b.IdPergunta
		join escala75_Easy7.Campanhas c on b.IdQuestionario = c.IdQuestionario 
		where c.Id = ${$('#CampanhasRC').val()} and (a.Tipo = 1 or a.Tipo = 2);
		`
	SelectAdvanced(sql);

	let data  = dataSelectAdvanced;
	
	if (data.length > 0 ) {
		$('#PerguntasRC').html(templateOptionPerguntas(data));
	}else{
		M.toast({html: 'Não há informações para essa campanha com essa pergunta', displayLength: 4000});
	}
	//$('#modalResposta').modal('open');
	$('select').formSelect();
	$('#modalProgress').modal('close');

}

function templateOptionPerguntas(model){
	return`
		<option value="">Selecione</option>
		<option value="0">Todas</option>
		${
			model.map(elem => {
				return`
					<option value="${elem.Pergunta}">${elem.Pergunta}</option>
				`
			})
		}
	`
}


function templatePerguntas(model){
	pergunta = [];
	respostaTotal = [];
	perguntaRespostaTotal = [];

return infosRespostas.map((value, i) => {
		respostas = infosRespostas[i].Respostas.split('$&');
		infos =  infosRespostas[i]
			return model.map((valuePergunta, i) => {
				if (valuePergunta.Tipo == "1" || valuePergunta.Tipo == "2" && respostas[i] != undefined) {
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