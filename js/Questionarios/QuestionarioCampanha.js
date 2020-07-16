var IdQuestionario = Campanha[0]["IdQuestionario"];
var IdCampanha = Campanha[0]["Id"];

$(document).ready(function($) {
	$('.modal').modal();
	returnPerguntas();
});

function sendForm(option = 'Insert'){

	validarForm2('#formQuestionarioCampanha');

	if (v == false) {
		return false;
	}

	InserRespostasUsers();
	let str = "";

	let Schema = 'escala75_Easy7';
  	let tableName = 'RespostasCampanha';
  	let columns = 'IdQuestionario, CPF, Respostas, DateRegistration'
  	
  	document.querySelectorAll('form input').forEach(x => str += x.value + '$&');
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

  	let lastquery = `${IdCampanha}, '${$('#UserRegistration').val()}', 1, now()`


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
	let sql = `SELECT perguntas.Id, questionarioperguntas.IdQuestionario, perguntas.Pergunta, perguntas.Status, perguntas.Tipo, questionarios.Name 
	  FROM escala75_Easy7.Perguntas as perguntas
	  left join escala75_Easy7.QuestionarioPerguntas as questionarioperguntas on perguntas.Id = questionarioperguntas.IdPergunta
	  left join escala75_Easy7.Questionarios as questionarios on questionarioperguntas.IdQuestionario = questionarios.Id
	  where  questionarioperguntas.IdQuestionario = ${IdQuestionario}
	  and perguntas.status = 1;`
	
	SelectAdvanced(sql);

	let data = dataSelectAdvanced;

	$('.form-questionario-campanha').html(templatePerguntas(data));
	$('#modalProgress').modal('close');
}

function Avaliar(estrela, id, s1, s2, s3, s4, s5) {
	//var url = window.location;
	//url = url.toString()
	//url = url.split("index.html");
	//url = url[0];
	debugger;
	var s1 = document.querySelector("#"+s1);
	var s2 = document.querySelector("#"+s2);
	var s3 = document.querySelector("#"+s3);
	var s4 = document.querySelector("#"+s4);
	var s5 = document.querySelector("#"+s5);
	var id = $(`#${id}`);

	var avaliacao = 0;

	if (estrela == 5){ 
		if (s5.src == "https://easy7.info/images/icons/star_vazia.png") {
			s1.src = "images/icons/star_cheia.png";
			s2.src = "images/icons/star_cheia.png";
			s3.src = "images/icons/star_cheia.png";
			s4.src = "images/icons/star_cheia.png";
			s5.src = "images/icons/star_cheia.png";
			avaliacao = 5;
		} else {
			s1.src = "images/icons/star_cheia.png";
			s2.src = "images/icons/star_cheia.png";
			s3.src = "images/icons/star_cheia.png";
			s4.src = "images/icons/star_cheia.png";
			s5.src = "images/icons/star_vazia.png";
			avaliacao = 4;
		}}

 //ESTRELA 4
 if (estrela == 4){ 
 	if (s4.src == "https://easy7.info/images/icons/star_vazia.png") {
 		s1.src = "images/icons/star_cheia.png";
 		s2.src = "images/icons/star_cheia.png";
 		s3.src = "images/icons/star_cheia.png";
 		s4.src = "images/icons/star_cheia.png";
 		s5.src = "images/icons/star_vazia.png";
 		avaliacao = 4;
 	} else {
 		s1.src = "images/icons/star_cheia.png";
 		s2.src = "images/icons/star_cheia.png";
 		s3.src = "images/icons/star_cheia.png";
 		s4.src = "images/icons/star_vazia.png";
 		s5.src = "images/icons/star_vazia.png";
 		avaliacao = 3;
 	}}

//ESTRELA 3
if (estrela == 3){ 
	if (s3.src == "https://easy7.info/images/icons/star_vazia.png") {
		s1.src = "images/icons/star_cheia.png";
		s2.src = "images/icons/star_cheia.png";
		s3.src = "images/icons/star_cheia.png";
		s4.src = "images/icons/star_vazia.png";
		s5.src = "images/icons/star_vazia.png";
		avaliacao = 3;
	} else {
		s1.src = "images/icons/star_cheia.png";
		s2.src = "images/icons/star_cheia.png";
		s3.src = "images/icons/star_vazia.png";
		s4.src = "images/icons/star_vazia.png";
		s5.src = "images/icons/star_vazia.png";
		avaliacao = 2;
	}}

//ESTRELA 2
if (estrela == 2){ 
	if (s2.src == "https://easy7.info/images/icons/star_vazia.png") {
		s1.src = "images/icons/star_cheia.png";
		s2.src = "images/icons/star_cheia.png";
		s3.src = "images/icons/star_vazia.png";
		s4.src = "images/icons/star_vazia.png";
		s5.src = "images/icons/star_vazia.png";
		avaliacao = 2;
	} else {
		s1.src = "images/icons/star_cheia.png";
		s2.src = "images/icons/star_vazia.png";
		s3.src = "images/icons/star_vazia.png";
		s4.src = "images/icons/star_vazia.png";
		s5.src = "images/icons/star_vazia.png";
		avaliacao = 1;
	}}

 //ESTRELA 1
 if (estrela == 1){ 
 	if (s1.src == "https://easy7.info/images/icons/star_vazia.png") {
 		s1.src = "images/icons/star_cheia.png";
 		s2.src = "images/icons/star_vazia.png";
 		s3.src = "images/icons/star_vazia.png";
 		s4.src = "images/icons/star_vazia.png";
 		s5.src = "images/icons/star_vazia.png";
 		avaliacao = 1;
 	} else {
 		s1.src = "images/icons/star_vazia.png";
 		s2.src = "images/icons/star_vazia.png";
 		s3.src = "images/icons/star_vazia.png";
 		s4.src = "images/icons/star_vazia.png";
 		s5.src = "images/icons/star_vazia.png";
 		avaliacao = 0;
 	}}

 	if (avaliacao == 0) {
 		id.val('Sem nota');
 	}else if(avaliacao == 1){
 		id.val('1 estrela');
 	}else if(avaliacao == 2){
 		id.val('2 estrelas');
 	}else if(avaliacao == 3){
 		id.val('3 estrelas');
 	}else if(avaliacao == 4){
 		id.val('4 estrelas');
 	}else if(avaliacao == 5){
 		id.val('5 estrelas');
 	}

 }

function valuesTypes(elem){
	if (elem.Tipo == 0) {
		return`
			<div class="input-field col s12">
				<input type="text" id="${elem.Id}" class="autocomplete c-blue" plc="'${elem.Pergunta}'">
				<label for="${elem.Id}" class="c-blue">${elem.Pergunta}</label>
			</div>
		` 
	}else if (elem.Tipo == 1){
		return`
			<div class="input-field col s12">
				<select id="${elem.Id}" plc="'${elem.Pergunta}'">
					${returnOptions(elem.Id, elem.IdQuestionario, elem.Pergunta)}								      	
				</select>
				<label class="color-default">${elem.Pergunta}</label>
			</div>
		`
	}else if (elem.Tipo == 2){
		let s1 = 's' + elem.Id + Math.random();
		let s2 = 's' + elem.Id + Math.random();
		let s3 = 's' + elem.Id + Math.random();
		let s4 = 's' + elem.Id + Math.random();
		let s5 = 's' + elem.Id + Math.random();

		s1 = s1.replace('0.', '')
		s2 = s2.replace('0.', '')
		s3 = s3.replace('0.', '')
		s4 = s4.replace('0.', '')
		s5 = s5.replace('0.', '')

		return`
			<div class="input-field col s12">
			<label class="color-default">${elem.Pergunta}</label>
			<br>
			<br>
				<a onclick="Avaliar(1, ${elem.Id}, '${s1}', '${s2}', '${s3}', '${s4}', '${s5}')">
				<img src="images/icons/star_vazia.png" width="40" id="${s1}"></a>

				<a onclick="Avaliar(2, ${elem.Id}, '${s1}', '${s2}', '${s3}', '${s4}', '${s5}')">
				<img src="images/icons/star_vazia.png" width="40" id="${s2}"></a>

				<a onclick="Avaliar(4, ${elem.Id}, '${s1}', '${s2}', '${s3}', '${s4}', '${s5}')">
				<img src="images/icons/star_vazia.png" width="40" id="${s3}"></a>

				<a onclick="Avaliar(4, ${elem.Id}, '${s1}', '${s2}', '${s3}', '${s4}', '${s5}')">
				<img src="images/icons/star_vazia.png" width="40" id="${s4}"></a>

				<a onclick="Avaliar(5, ${elem.Id}, '${s1}', '${s2}', '${s3}', '${s4}', '${s5}')">
				<img src="images/icons/star_vazia.png" width="40" id="${s5}"></a>
				<input type="hidden" id="${elem.Id}" class="autocomplete c-blue" plc="${elem.Pergunta}"">
			</div>
		`
	}
}


function templatePerguntas(model){
	return`
		<input type="hidden" name="IdQuestionario" id="IdQuestionario" value="${IdQuestionario}">
		<form class="col s12" id="formQuestionarioCampanha">
			${model.map(value =>{
				return`
					<div class="row">
						<div class="input-field col s12">
							${valuesTypes(value)}
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