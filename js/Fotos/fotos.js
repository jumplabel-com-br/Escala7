let Usuario;
let Image;
let Caminho;

jQuery(document).ready(function($) {
	Usuarios();
});

function CaminhoCompleto(){
	let sql = `SELECT Imagem as Caminho FROM escala75_Easy7.ImagensCampanha group by Caminho;;`
	SelectAdvanced(sql);

	Caminho = dataSelectAdvanced;
}

function Usuarios(){
	CaminhoCompleto();
	Images();

	let sql = `SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(Imagem, '/', 3), '/', -1) as CPF FROM escala75_Easy7.ImagensCampanha group by CPF;`;
	SelectAdvanced(sql);

	Usuario = dataSelectAdvanced;
	$('.card-fotos').html(templateUsuarios(Usuario));
}


function Images(){
	let sql = `SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(Imagem, '/', 4), '/', -1) as Images FROM escala75_Easy7.ImagensCampanha group by Images;`;
	SelectAdvanced(sql);

	Image = dataSelectAdvanced;
}


function templateUsuarios(Campanhas){
	return Usuario.map(elemU => {
		if (elemU.CPF != "" && elemU.CPF != undefined) {
			return`
				<ul class="collection">
				  <li class="collection-item avatar"> 
				    <i class="material-icons circle pointer" onclick="$('.card-fotos').html(templateImages())">folder</i>
				    <span class="title color-default pointer" onclick="$('.card-fotos').html(templateImages('${elemU.CPF}'))">${elemU.CPF}</span>
				  </li>
				</ul>
			`
		}
	})
}

function templateImages(usuario){
	var template = `
	<ul class="collection with-header">
	    <li class="collection-header color-default"><h4>Fotos</h4></li>
	`;
	Image.map((elem,i) => {
		let images = elem.Images;

		Caminho.map((elemC, iC) => {

			let image = elemC.Caminho.split('/')[3];
			let user = elemC.Caminho.split('/')[2];

			if (image == images && usuario == user && images != undefined) { 
				template+=`
					
				<li class="collection-item">
					<div class="color-default">
						<a href="${elemC.Caminho}" download="${elemC.Caminho}" class="pointer">${images}</a>
						<a href="#!" onclick="Usuarios();" class="secondary-content">
							<i class="material-icons i-default pointer">arrow_back</i>
						</a>
					</div>
				</li>
				`
			}
		})
	});

	return template+="</ul>";
}