$(document).ready(function($) {
  questionariosPreenchidos();
  campanhasCadastradas();
});

function questionariosPreenchidos(){
  let sql = `SELECT IdQuestionario, count(IdQuestionario) FROM escala75_Easy7.RespostasCampanha
group by IdQuestionario;`
  
  SelectAdvanced(sql);

  let data = dataSelectAdvanced;

  $('.questionarios-preenchidos').html(templateQuestionariosPreenchidos(data));
}

function templateQuestionariosPreenchidos(model){
  return `
    <div>
      <h2 class="black-text">${model.length}</h2>
      <label class="black-text">Total de questionários preenchidos</label>
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
        <h2 class="black-text">${elem.Total}</h2>
        <label class="black-text">${elem.status == '1' ? 'Total de campanhas ativas' : 'Total de campanhas Inativas'}</label>
      </div>
    `
  })
}