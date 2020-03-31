function logoff(){

	let option = 'logoff';
	let type = window.location.href.split('=')[1].substr(0,3);
	let IC = window.location.href.split('=')[2].replace('&QCC','');
	let QCC = window.location.href.split('=')[3];

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