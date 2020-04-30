function logoff(type = 'adm'){

	let option = 'logoff';
	let IC;
	let QCC;
	if (type != 'adm') {
		IC = Campanha[0].Id;
		QCC = Campanha[0].QRCode;
	}

	$.ajax({
		url: 'GenericFunctions.php',
		type: 'POST',
		dataType: 'html',
		data: {option},
	})
	.done(function(data) {
		console.log("success: ", data);

		if (type == 'adm') {
			redirectToAction(`index.php?type=${type}`);	
		}else{
			redirectToAction(`index.php?type=${type}&IC=${IC}&QCC=${QCC}`);	
		}
		
	})
	.fail(function() {
		console.log("error");
	});

}

function redirectToAction(strView){
	window.location.href = strView;
}