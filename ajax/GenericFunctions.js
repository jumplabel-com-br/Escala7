function logoff(){

	let option = 'logoff';


	$.ajax({
		url: 'GenericFunctions.php',
		type: 'POST',
		dataType: 'html',
		data: {option},
	})
	.done(function(data) {
		console.log("success: ", data);
		redirectToAction('Index.php');
	})
	.fail(function() {
		console.log("error");
	});

}

function redirectToAction(strView){
	window.location.href = strView;
}

function select(sql, nameFunction, columns, tableName, where){

	let option = 'Select';
	let Schema = 'Escala7';

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

		if (data.length > 0 && nameFunction == 'templateTableCampanhas') {

			$('.row-cards-usuarios').html(templateTableCampanhas(data));
			$('.dropdown-trigger').dropdown();

		}

		$('#modalProgress').modal('close');
	})
	.fail(function() {
		console.log("error");
		M.toast({html: 'Erro ao processar dados, informe o suporte', displayLength: 4000})
		$('#modalProgress').modal('close');
	});
}

jQuery(document).ready(function($) {
	let navbarLocation = window.location.href.split('/')[4].replace('.php', '')

	if (navbarLocation == 'Camapanhas') {
		select('select * from ')
	}
});	
