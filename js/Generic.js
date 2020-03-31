var v;

$(document).ready(function($) {
    $('.sidenav').sidenav();
    $('.dropdown-trigger').dropdown();
    $('.modal').modal();
    $('select').formSelect();
    $('.tooltipped').tooltip();
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

function clearForm(form){
	document.querySelectorAll(`${form} input`).forEach(input => input.value = '');
}
