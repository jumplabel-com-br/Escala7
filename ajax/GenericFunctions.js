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
		redirectToAction('index.php');
	})
	.fail(function() {
		console.log("error");
	});

}

function redirectToAction(strView){
	window.location.href = strView;
}