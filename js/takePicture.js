var arrpictures = [];
var pictures = [];

function takePicture()
{
	if (autorizationLocation == false) {
		M.toast({html: errorCode, displayLength: 4000});
		return;
	}


	if (file0.value == '' && file1.value == '' && file2.value == '') {
		M.toast({html: 'É necessário anexar ao menos 1 imagem', displayLength: 4000});
		return;
	}

	$('#modalProgress').modal('open');
	//$('.container-new-foto').hide();
	//$('.container-view-fotos').show();


	/*Webcam.snap(function(data_uri)
	{
		document.querySelector('#results').innerHTML = '<img id="base64image" src="'+data_uri+'" style="width: 100%"/>';
		pictures.push({
			img : data_uri
		})
	});*/

	var reader0 = new FileReader();
	var reader1 = new FileReader();
	var reader2 = new FileReader();
		
	var baseString0;
	var baseString1;
	var baseString2;

		reader0.onloadend = function () {
		        baseString0 = reader0.result;
		};

		reader1.onloadend = function () {
		        baseString1 = reader1.result;
		};

		reader2.onloadend = function () {
		        baseString2 = reader2.result;
		};


		document.querySelector('#file0')['files'][0] != undefined ? reader0.readAsDataURL(document.querySelector('#file0')['files'][0]) : '';
		document.querySelector('#file1')['files'][0] != undefined ? reader1.readAsDataURL(document.querySelector('#file1')['files'][0]) : '';
		document.querySelector('#file2')['files'][0] != undefined ? reader2.readAsDataURL(document.querySelector('#file2')['files'][0]) : '';

		setTimeout(function(){

			if (baseString0 != undefined) {
				pictures.push({
					img : baseString0
				})	
			}

			if (baseString1 != undefined) {
				pictures.push({
					img : baseString1
				})
			}

			if (baseString2 != undefined) {
				pictures.push({
					img : baseString2
				});	
			}
			savePicture()
		}, 2000)


	/*if (pictures[0] != undefined) {
		document.querySelector('#picture_1').setAttribute("img" , pictures[0].img);
		document.querySelector('#picture_1').innerHTML = `<img src="${pictures[0].img}" name="file0" id="file0" style="width: 100%">`;
	}
	if (pictures[1] != undefined) {
		document.querySelector('#picture_2').setAttribute("img" , pictures[1].img);
		document.querySelector('#picture_2').innerHTML = `<img src="${pictures[1].img}" name="file1" id="file1" style="width: 100%">`;
	}
	if (pictures[2] != undefined) {
		document.querySelector('#picture_3').setAttribute("img" , pictures[2].img);
		document.querySelector('#picture_3').innerHTML = `<img src="${pictures[2].img}" name="file2" id="file2" style="width: 100%">`
	}*/
	
}

function setPrevia(img){
	 document.querySelector('#base64image').setAttribute("src" , img)
}

function newPicture(){
	if (pictures.length == 3) {
		M.toast({html: 'Delete uma foto antes de prosseguir', displayLength: 4000});
		return;
	};

	$('.container-view-fotos').hide();
	$('.container-new-foto').show();
}

function deletePicture(){
	
	arrpictures = pictures;
	pictures = [];

	arrpictures.map(x => {
		if (x.img !=  document.querySelector('#base64image').getAttribute("src")) {
			pictures.push({
				'img' : x.img
			})
		}
	})

	document.querySelector('#base64image').setAttribute("src", pictures[0] != undefined ? pictures[0].img : '')

		if (pictures[0] != undefined) {
			document.querySelector('#picture_1').setAttribute("img" , pictures[0].img);
			document.querySelector('#picture_1').innerHTML = `<img src="${pictures[0].img}" name="file0" id="file0" style="width: 100%">`;
		}else{
			document.querySelector('#picture_1').innerHTML = `
				<div class=" ">
					<label class="label-pictures">FOTO 1</label>
				</div>
			`
		}

		if (pictures[1] != undefined) {
			document.querySelector('#picture_2').setAttribute("img" , pictures[1].img);
			document.querySelector('#picture_2').innerHTML = `<img src="${pictures[1].img}" name="file1" id="file1" style="width: 100%">`;
		}else{
			document.querySelector('#picture_2').innerHTML = `
				<div class=" ">
					<label class="label-pictures">FOTO 2</label>
				</div>
			`
		}

		if (pictures[2] != undefined) {
			document.querySelector('#picture_3').setAttribute("img" , pictures[2].img);
			document.querySelector('#picture_3').innerHTML = `<img src="${pictures[2].img}" name="file2" id="file2" style="width: 100%">`
		}else{
			document.querySelector('#picture_3').innerHTML = `
				<div class=" ">
					<label class="label-pictures">FOTO 3</label>
				</div>
			`
		}

	M.toast({html: 'Imagem deletada', displayLength: 4000});
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

function savePicture(){

	let date = new Date();
	let ajax = new XMLHttpRequest();
	let formdata = new FormData();

	let CPF = $('#UserRegistration').val();
	let Campanha = $('.title-campanha:eq(0)').html().replace(' ', '');
	let Data0 = date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate()+"-"+date.getMinutes()+"-"+date.getSeconds()+'-'+date.getMilliseconds();
	let Data1 = date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate()+"-"+date.getMinutes()+"-"+date.getSeconds()+'-'+date.getMilliseconds();
	let Data2 = date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate()+"-"+date.getMinutes()+"-"+date.getSeconds()+'-'+date.getMilliseconds();
	let file0 = pictures[0] != null ? pictures[0].img : '';
	let file1 = pictures[1] != null ? pictures[1].img : '';
	let file2 = pictures[2] != null ? pictures[2].img : '';
	let lat = document.querySelector('#latitue').value;
	let lon = document.querySelector('#longitude').value;

	//console.log('file0 : ', file0);
	//console.log('file1 : ', file1);
	//console.log('file2 : ', file2);
	file0 != '' ? formdata.append("file0", file0) : '';
	file1 != '' ? formdata.append("file1", file1) : '';
	file2 != '' ? formdata.append("file2", file2) : '';
	formdata.append('CPF', CPF);
	formdata.append('Campanha', Campanha);
	file0 != "" ? formdata.append('Data0', Data0) : '';
	file1 != "" ? formdata.append('Data1', Data1) : '';
	file2 != "" ? formdata.append('Data2', Data2) : '';
	lat != "" ? formdata.append('lat', lat) : '';
	lon != "" ? formdata.append('lon', lon) : '';
	IdCampanha != "" ? formdata.append('IdCampanha', IdCampanha) : '';

	ajax.addEventListener("load", function(event) { upload_completo(event);}, false);
	ajax.open("POST", "upload.php");
	ajax.send(formdata);
}

function upload_completo(event){
	$('#modalProgress').modal('close');
	window.location.href = window.location.href.replace('Fotos','HomeMobile')+'&FotosOk=T'
}

//window.onload = showCamera;