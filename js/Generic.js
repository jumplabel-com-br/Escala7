var v;
var dataSelectAdvanced;

$(document).ready(function($) {

    $('.sidenav').sidenav();
    $('.dropdown-trigger').dropdown();
    $('.modal').modal();
    $('select').formSelect();
    $('.tooltipped').tooltip();
    $('.datepicker').datepicker({
         i18n: {
            months: [
                'Janeiro',
                'Fevereiro',
                'Março',
                'Abril',
                'Maio',
                'Junho',
                'Julho',
                'Agosto',
                'Setembto',
                'Outubro',
                'Novembro',
                'Dezembro'
            ],
            
            monthsShort : [
                'Jan',
                'Fev',
                'Mar',
                'Abr',
                'Mai',
                'Jun',
                'Jul',
                'Ago',
                'Set',
                'Out',
                'Nov',
                'Dez'
            ],
            
            weekdays: [
                'Dom',
                'Seg',
                'Ter',
                'Qua',
                'Qui',
                'Sex',
                'Sab'
            ],

            weekdaysShort: [
                'Dom',
                'Seg',
                'Ter',
                'Qua',
                'Qui',
                'Sex',
                'Sab'
            ],

            weekdaysAbbrev : 
            ['D','S','T','Q','Q','S','S']

        }
    });
});

function validarEmail(email){
	return /^[\w+.]+@\w+\.\w{2,}(?:\.\w{2})?$/.test(email);
}

function validarForm(form){
    v = true;

    $(`${form} input[type="text"], ${form} input[type="password"], ${form} select`).each(function () {

        if (($(this).val() == '' || $(this).val() == null) && $(this).attr('plc') != undefined) {
            M.toast({html: 'Preencha o campo '+ $(this).attr('plc'), displayLength: 4000})
            v = false;
        }

        if ($(this).attr('plc') == 'Email' && validarEmail($(this).val()) == false && $(this).attr('plc') != undefined) {
            M.toast({html: 'O campo '+ $(this).attr('plc') + ' está inválido', displayLength: 4000})
            v = false;
        }
    });

    return v;
}

function SelectAdvanced(sql, option = 'SelectAdvanced'){
    $.ajax({
        url: 'DBInserts.php',
        type: 'POST',
        dataType: 'json',
        async: false,
        data: {option, sql},
    })
    .done(function(data) {
        dataSelectAdvanced = data;
    })
    .fail(function() {
        console.log("error");
    });
    
}

function clearForm(form){
	document.querySelectorAll(`${form} input`).forEach(input => input.value = '');
}
