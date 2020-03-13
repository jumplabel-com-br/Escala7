function takePicture()
{
	Webcam.snap(function(data_uri)
	{
		document.querySelector('#results').innerHTML = '<img id="base64image" src="'+data_uri+'" style="height: 395.6px; margin-left: 16%;"/>';
	});
}

function showCamera()
{
	Webcam.set({
		width: 640,
		height: 480,
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
	document.querySelector('#carregando').innerHTML="Salvando, aguarde...";
	var file = document.querySelector('#base64image').src;
	var formdata = new FormData();
	formdata.append("base64image", file);
	var ajax = new XMLHttpRequest();
	ajax.addEventListener("load", function(event) { upload_completo(event);}, false);
	ajax.open("POST", "upload.php");
	ajax.send(formdata);
}

function upload_completo(event)
{
	document.querySelector('#carregando').innerHTML="";
	var image_return=event.target.responseText;
	var showup=document.querySelector('#completado').src=image_return;
	var showup2=document.querySelector('#carregando').innerHTML='<b>Upload feito:</b>';
}
window.onload= showCamera;