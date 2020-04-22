

function takePicture()
{

	$('.container-new-foto').hide();
	$('.container-view-fotos').show();

	Webcam.snap(function(data_uri)
	{
		document.querySelector('#results').innerHTML = '<img id="base64image" src="'+data_uri+'" style="width: 100%"/>';
	});
}

function showCamera()
{
	Webcam.set({
		width: 'auto',
		height: 'auto',
		dest_width: 640,
		dest_height: 480,
		crop_width: 300,
		crop_height: 400,
		image_format: 'jpeg',
		jpeg_quality: 100,
		flip_horiz: true
	});

	Webcam.attach('#myCamera');
}

	function savePicture()
	{
		var date = new Date();

		CPF = $('#UserRegistration').val();
		Campanha = $('.title-campanha:eq(0)').html().replace(' ', '');
		Data = date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate()+"-"+date.getMinutes()+"-"+date.getSeconds();

		//document.querySelector('#carregando').innerHTML = "Salvando, aguarde...";
		var file = document.querySelector('#base64image').src;
		var formdata = new FormData();
		formdata.append("base64image", file);
		formdata.append('CPF', CPF);
		formdata.append('Campanha', Campanha);
		formdata.append('Data', Data);

		var ajax = new XMLHttpRequest();
		ajax.addEventListener("load", function(event) { upload_completo(event);}, false);
		ajax.open("POST", "upload.php");
		ajax.send(formdata);
	}

function upload_completo(event)
{
	$('.container-new-foto').hide();
	$('.container-fotos').show();

	$('#carregando').html("");
	//var image_return = event.target.responseText;
	//var showup = document.querySelector('#completado').src = image_return;
	//var showup2 = $('#carregando').html('<b>Upload feito:</b>');
}

window.onload = showCamera;