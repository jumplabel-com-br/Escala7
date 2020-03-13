let scanner = new Instascan.Scanner({
	video: document.querySelector('#preview')
});

scanner.addListener('scan', function(content) {
	alert('Conteudo escaneado com êxito');
	
	document.querySelector('#valueScanner').value = content;
	document.querySelector('.rowpreview').style.display = 'none';
	
	getLocation();

	window.open(content, "_blank");
});

Instascan.Camera.getCameras().then(cameras => 
{
	if(cameras.length > 0){
		scanner.start(cameras[0]);
		document.querySelector('#preview').style.transform = 'scaleY(-2.1) scaleX(1) rotate(180deg)';
	} else {
		console.error("Não existe câmera no dispositivo!");
	}
});