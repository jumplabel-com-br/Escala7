
$(document).ready(function($) {
	Respostas();

});

function Respostas(){
  let sql = `select Campanha ,COUNT(a.IdCampanha) as countRespostas, a.Status from Escala7.RespostasUsers a
join Escala7.Campanhas b on a.IdCampanha = b.Id
group by Campanha;`
  
  SelectAdvanced(sql);

  let data = dataSelectAdvanced;

  $('.tbody-Respostas').html(fnTemplateIndex(data));
  $('.dropdown-trigger').dropdown();
  $('#modalResposta').modal('close');
  clearForm('#formResposta');
}


function fnTemplateIndex(model){
	return model.map(x => {
		return`
		<tr>
			<td>${x.Status == 0 ? 'Desativado' : 'Ativo'}</td>
			<td>${x.Campanha}</td>
			<td><button type="button" class="btn btn-blue waves-effect tooltipped"  data-position="bottom" data-tooltip="Visualizar respostas">Respostas (${x.countRespostas})</button></td>
			<td><i class="material-icons i-default tooltipped" data-position="bottom" data-tooltip="Visualizar respostas">remove_red_eye</i></td>
		</tr>
		`
	});
}