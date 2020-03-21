jQuery(document).ready(function($) {
	$('.chips').chips({placeholder: 'Cole o llink do iframe desejado e pressione Enter', onChipAdd: keypressChip(), limit: 1});
	$('.tooltipped').tooltip();
	returnIframe();
});

var countChip = $('.chip').length;

function keypressChip(){
	$('.chips').on('keyup', function(e) {

		key = e.keyCode || e.which
		if (key == 13 && countChip === 0) {
			onChipUpdate();
		}

	});	
}

function onChipAdd(option = 'Insert'){
	M.toast({html: 'Só pode ser inserido um Video institucional, deletar o anterior para um novo!'})

	let Schema = 'Escala7'
	let tableName = 'VideoInstitucional'
	let link = $('.chips .chip').html() != undefined ? $('.chips .chip').html().replace('<i class="material-icons close">close</i>', '') : '';
	let Status = 1
	let UserRegistration = $('#UserRegistration').val();    

	let columns = 'link, status, UserRegistration, DateRegistration';
	let lastquery = `'${link}', ${Status}, ${UserRegistration}, now()`

	let params = {
		option,
		Schema,
		tableName,
		columns,
		lastquery		    	
	}

	$.ajax({
		url: 'DBInserts.php',
		type: 'POST',
		dataType: 'html',
		data: params,
	})
	.done(function() {
		console.log("success insert");
		returnIframe();
	})
	.fail(function() {
		console.log("error");
	});	
}

function returnIframe(option = 'Select'){

	let Schema = 'Escala7';
	let tableName = 'VideoInstitucional';
	let columns = 'link';
	let where = 'Status = 1';

	let params = {
		option,
		Schema,
		tableName,
		columns,
		where
	}

	$.ajax({
		url: 'DBInserts.php',
		type: 'POST',
		dataType: 'json',
		data: params,
	})
	.done(function(data) {
		console.log("success select: ", data);

		if (data.length > 0) {
			link = data[0].link;

			countChip = 1;

			$('.chips').chips({data: [{tag: link}], limit: 1});

			$('.cards-footer iframe').attr({'src':link})	
		}
	})
	.fail(function() {
		console.log("error");
	});

}

function onChipUpdate(option = 'Update'){
	let Schema = 'Escala7'
	let tableName = 'VideoInstitucional'
	let link = $('.chips input').val();
	let Status = 1
	let UserRegistration = $('#UserRegistration').val();    

	let setQuery = 'Status = 0';
	let where = `Status = 1`;

	let params = {
		option,
		Schema,
		tableName,
		setQuery,
		where		    	
	}

	$.ajax({
		url: 'DBInserts.php',
		type: 'POST',
		dataType: 'html',
		data: params,
	})
	.done(function() {
		console.log("success Update");
		onChipAdd();
	})
	.fail(function() {
		console.log("error");
	});	
}

