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

function exportExcel(id, nome){
    var table_div = document.getElementById(id);   
          // esse "\ufeff" é importante para manter os acentos
    
    var blobData = new Blob(['\ufeff'+table_div.outerHTML], { type: 'application/vnd.ms-excel' });
    var url = window.URL.createObjectURL(blobData);
    var a = document.createElement('a');
    a.href = url;
    a.download = nome;
    a.click();
}

function grafico(div_montagem, dataPoints){

    var options = {
        animationEnabled: true,
        title: {
            text: "Gráfico perguntas combo"
        },
        axisY: {
            title: "Gráfico perguntas combo (in %)",
            suffix: "%",
            includeZero: true
        },
        axisX: {
            title: "Countries"
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.0#"%"",
            dataPoints: [
                { label: "Iraq", y: 22 },   
                { label: "Turks & Caicos Islands", y: 9.40 },   
                { label: "Nauru", y: 8.50 },
                { label: "Ethiopia", y: 7.96 }, 
                { label: "Uzbekistan", y: 7.80 },
                { label: "Nepal", y: 7.56 },
                { label: "Iceland", y: 7.20 },
                { label: "India", y: 7.1 },
                { label: "China", y: 12.1 }
                
            ]
        }]
    };

    $(div_montagem).CanvasJSChart(options);
}


