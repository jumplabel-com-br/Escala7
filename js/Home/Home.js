$(document).ready(function($) {
  questionariosPreenchidos();
  campanhasCadastradas();
  implantacaoCampanha();
});

function implantacaoCampanha(){
  let sql = `SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(Imagem, '/', 2), '/', -1) as Campanha, 
count(SUBSTRING_INDEX(SUBSTRING_INDEX(Imagem, '/', 2), '/', -1)) as qtd 
  FROM escala75_Easy7.ImagensCampanha
    join escala75_Easy7.Campanhas on SUBSTRING_INDEX(SUBSTRING_INDEX(Imagem, '/', 2), '/', -1) = Campanhas.Campanha
    join escala75_Easy7.ClientesCampanhas on Campanhas.Id = ClientesCampanhas.IdCampanha
    ${$('#IdUser').val() != undefined ? ` where ClientesCampanhas.IdUsuario = ${$('#IdUser').val()}` : ''}
    group by Campanha;`

  SelectAdvanced(sql);

  let data = dataSelectAdvanced;

  $('.implantacao-campanha').html(templateImplantacaoCampanha(data));
}

function templateImplantacaoCampanha(model){
  return model.map(elem => {
    return `
    <div>
        <h2 class="color-default">${elem.qtd} <label class="color-default" style="font-size: 2.28rem;line-height: 110%;margin: 1.52rem 0 0.912rem 0;">${elem.qtd == 1 ? 'vez' : 'vezes'}</label></h2>
      <label class="color-default">${elem.Campanha}</label>
    </div>
    `
  })
}

function questionariosPreenchidos(){
  let sqlPreenchidos = `SELECT IdQuestionario, count(IdQuestionario) FROM escala75_Easy7.RespostasCampanha
  group by IdQuestionario;`
  
  SelectAdvanced(sqlPreenchidos);
  let dataPreenchidos = dataSelectAdvanced;

  let sqlCadastrados = `SELECT Name FROM escala75_Easy7.Questionarios
  where status = 1;`

  SelectAdvanced(sqlCadastrados);
  let dataCadastrados = dataSelectAdvanced;

  $('.questionarios-preenchidos').html(templateQuestionariosPreenchidos(dataPreenchidos, dataCadastrados));
}

function templateQuestionariosPreenchidos(model1, model2){
  return `
    <div>
      <h2 class="color-default">${model1.length}</h2>
      <label class="color-default">Total de questionários preenchidos</label>

      <h2 class="color-default">${model2.length}</h2>
      <label class="color-default">Total de questionários cadastrados (ativos)</label>      
    </div>
  `
}

function campanhasCadastradas(){
  let sql = `SELECT Count(Campanha) as Total, status FROM escala75_Easy7.Campanhas group by status;`
  
  SelectAdvanced(sql);

  let data = dataSelectAdvanced;

  $('.campanhas-cadastradas').html(templateCampanhasCadastradas(data));
}

function templateCampanhasCadastradas(model){
  return model.map(elem => {
    return`
      <div>
        <h2 class="color-default">${elem.Total}</h2>
        <label class="color-default">${elem.status == '1' ? 'Total de campanhas ativas' : 'Total de campanhas Inativas'}</label>
      </div>
    `
  })
}