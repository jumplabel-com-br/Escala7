function selectDb(sqlStr, dataType = 'html', createLoop){ //sqlStr = queryString que deseja realizar, dataType o tipo de retorno que deseja obter e create loop a id de onde criara o loop
	let sql = sqlStr;
	let option = 0;

	$.ajax({
		url: 'DBInserts.php',
		type: 'POST',
		dataType: dataType,
		data: {sql, option},
	})
	.done(function(data) {
		console.log("success");
		console.log("data: ", data)

		if (dataType == 'json' && data.length > 0) {
			console.log(data)
		}

	})
	.fail(function() {
		console.log("error");
	});
}