var VarCampanha = '';

jQuery(document).ready(function($) {
	Campanhas();
});

function Campanhas(){
	let sql = `SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(Imagem, '/', 2), '/', -1) as Campanha
	FROM escala75_Easy7.ImagensCampanha a
	join escala75_Easy7.Campanhas b on SUBSTRING_INDEX(SUBSTRING_INDEX(a.Imagem, '/', 2), '/', -1) = b.Campanha
	left join escala75_Easy7.ClientesCampanhas c on b.Id = c.IdCampanha
	left join escala75_Easy7.Users d on c.IdUsuario = d.Id
	${$('#UserRegistration').val() != "" && $('#IdUser').val() != undefined ? `where d.CPF = ${$('#UserRegistration').val()}` : ''}
	group by SUBSTRING_INDEX(SUBSTRING_INDEX(Imagem, '/', 2), '/', -1);
	`
	SelectAdvanced(sql);

	let data = dataSelectAdvanced;
	$('.card-fotos').html(templateCampanhas(data));
}

function Usuarios(campanha){
	let sql = `SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(Imagem, '/', 3), '/', -1) as Usuario
		FROM escala75_Easy7.ImagensCampanha a
		where SUBSTRING_INDEX(SUBSTRING_INDEX(Imagem, '/', 2), '/', -1) = '${campanha}'
		group by SUBSTRING_INDEX(SUBSTRING_INDEX(Imagem, '/', 3), '/', -1);`

	SelectAdvanced(sql);
	VarCampanha = campanha;

	let data = dataSelectAdvanced;
	$('.card-fotos').html(templateUsuarios(data, campanha));
}

function Images(campanha, usuario){
	let sql = `SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(Imagem, '/', 4), '/', -1) as Images, Imagem as Caminho
	FROM escala75_Easy7.ImagensCampanha a
	where SUBSTRING_INDEX(SUBSTRING_INDEX(Imagem, '/', 2), '/', -1) = '${campanha}'
	and SUBSTRING_INDEX(SUBSTRING_INDEX(Imagem, '/', 3), '/', -1)  = '${usuario}'
	group by SUBSTRING_INDEX(SUBSTRING_INDEX(Imagem, '/', 4), '/', -1), Caminho;`

	SelectAdvanced(sql);

	let data = dataSelectAdvanced;
	$('.card-fotos').html(templateImages(data));
	//$('.carousel.carousel-slider').carousel({
	//  fullWidth: true,
	//  indicators: true
	//});
	$('.carousel').carousel();
	//$('.carousel').carousel();
}


function templateCampanhas(model){
	return model.map(elem => {
		if (elem.Campanha != "" && elem.Campanha != undefined) {
			return`
				<ul class="collection">
				  <li class="collection-item avatar"> 
				    <i class="material-icons circle pointer" onclick="Usuarios('${elem.Campanha}')">folder</i>
				    <span class="title color-default pointer" onclick="Usuarios('${elem.Campanha}')">${elem.Campanha}</span>
				  </li>
				</ul>
			`
		}
	})
}

function templateUsuarios(model, campanha){
	return model.map(elem => {
		if (elem.Usuario != "" && elem.Usuario != undefined) {
			return`
				<ul class="collection">
				  <li class="collection-item avatar"> 
				    <i class="material-icons circle pointer" onclick="Images('${campanha}', '${elem.Usuario}')">folder</i>
				    <span class="title color-default pointer" onclick="Images('${campanha}', '${elem.Usuario}')">${elem.Usuario}</span>
				    <i class="material-icons i-default right pointer" onclick="Campanhas()">keyboard_return</i>
				  </li>
				</ul>
			`
		}
	})
}

function templateImages(model){
	return`
	<ul class="collection with-header">
	    <li class="collection-header color-default"><h4>Fotos <i class="material-icons i-default right pointer" onclick="Usuarios('${VarCampanha}')">keyboard_return</i></h4></li>

	    <div class="carousel" style="overflow: auto">
	    	${model.map((elem, i) => {
	    	  	return`
	    	  	    <div class="carousel-item center" href="#${i}!">
	    	  	    	<img src="${elem.Caminho}">
	    	  	    	<a class="btn waves-effect blue darken-3 darken-text-2" href="${elem.Caminho}" download="${elem.Caminho}">Baixar</a>
	    	  	    </div>
	    	  	`
	    	}).join('')}
	    </div>
	    
	`
}

/*
	    <div class="carousel carousel-slider center" style="height: 415px;">
	    ${model.map((elem, i) => {
	    	return`
	    		<div class="carousel-fixed-item center">
	    		      <a class="btn waves-effect white grey-text darken-text-2" href="${elem.Caminho}" download="${elem.Caminho}" onclick="$('.carousel .carousel-slider .center').css({'height' : '415px;'})">Baixar</a>
	    		</div>
	    		<div class="carousel-item" href="#${i}!">
	    			<img src="${elem.Caminho}">
	    		</div>
	    	`
	    	/*return`<li class="collection-item">
					<div class="color-default">
						<a onclick="viewImage('${elem.Caminho}')" class="pointer">${elem.Images}</a>
						<a href="#!" onclick="Campanhas();" class="secondary-content">
							<i class="material-icons i-default pointer">arrow_back</i>
						</a>
					</div>
				</li>`
			
	    })}
	    </div>
*/
function viewImage(caminho){
	$('#view-image').attr({'src' : caminho})
	$('.download-image').attr({
		href: caminho,
		download: caminho 
	});
	$('#modalView').modal('open');
}