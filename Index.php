<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!--Import Jquey-->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<link rel="stylesheet" type="text/css" href="materialize/css/materialize.css">
	<link rel="stylesheet" type="text/css" href="materialize/css/materialize.min.css">
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<!--Impor JQuery Mask Plugin-->
	<script type="text/javascript" src="jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>
	<script type="text/javascript" src="jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
	<script type="text/javascript" src="jQuery-Mask-Plugin-master/src/jquery.mask.js"></script>

	<style type="text/css">
		/*.Escala-7-Logo{
			background: url('fotos/Escala-7-Logo.png') no-repeat;
			background-position: 50%;
			z-index: -1;
			}*/
		</style>
	</head>

	<body>
		<section class="Escala-7 mt-3">
			<div class="container">
				<div class="row">
					<div class="col s12">
						<div class="row">
							<div class="input-field col s12">
								<i class="material-icons prefix">assignment_ind</i>
								<input type="text" id="autocomplete-input-cpf" class="autocomplete cpf">
								<label for="autocomplete-input-cpf">CPF</label>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col s12">
						<div class="row">
							<div class="input-field col s12">
								<i class="material-icons prefix remove_red_eye">remove_red_eye</i>
								<input type="password" id="autocomplete-input-password" class="autocomplete autocomplete-input-password">
								<label for="password" class="autocomplete-input-password">Senha</label>

								<input type="text" id="autocomplete-input-text-password" class="autocomplete autocomplete-input-text-password" style="display: none">
								<label for="autocomplete-input" class="autocomplete-input-text-password" style="display: none">Senha</label>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col s12">
						<div class="row">
							<div class="col s6 left-align">
								<span class="helper-text" data-error="wrong" data-success="left" onclick="newPassoword();">Esqueceu a senha?</span>
							</div>

							<div class="col s6 right-align">
								<button class="btn waves-effect waves-light" type="submit" name="action" onclick="ValidatorCPF($('.cpf').val()) == true ? validUser() : '';">Login
									<i class="material-icons right">send</i>
								</button>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<script type="text/javascript" src="materialize/js/materialize.js"></script>
		<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
		<script type="text/javascript">

			function validUser(){
				let sql = `select CPF, Senha from Escala7.Users where CPF = '${$('#autocomplete-input-cpf').val().replace(/[.|-]/g,'')}' and Senha = '${$('#autocomplete-input-password').val()}'`
				let option = 'validLogin';

				$.ajax({
					url: 'GenericFunctions.php',
					type: 'POST',
					dataType: 'html',
					data: {sql, option},
				})
				.done(function(data) {
					console.log("success");
					data == 'True' ? redirectToAction('Home.php') : '';
				})
				.fail(function() {
					console.log("error");
				});
				
			}

			function newPassoword(){
				var arrayToRandomic = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9'];
				var random = '';

				for (i = 0; i < 32 ; i++) {
					random += arrayToRandomic[Math.ceil(Math.random() * (arrayToRandomic.length - 1))]
				}

				alert(`sua nova senha é: ${random}`)
			}

			function ValidatorCPF(strCPF, strView) {
				var numeros, digitos, soma, i, resultado, digitos_iguais;
				cpf = strCPF.replace(/[.|-]/g,'');

				digitos_iguais = 1;
				if (cpf.length < 11)
					return false;
				for (i = 0; i < cpf.length - 1; i++)
					if (cpf.charAt(i) != cpf.charAt(i + 1))
					{
						digitos_iguais = 0;
						break;
					}
					if (!digitos_iguais)
					{
						numeros = cpf.substring(0,9);
						digitos = cpf.substring(9);
						soma = 0;
						for (i = 10; i > 1; i--)
							soma += numeros.charAt(10 - i) * i;
						resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
						if (resultado != digitos.charAt(0))
							return false;
						numeros = cpf.substring(0,10);
						soma = 0;
						for (i = 11; i > 1; i--)
							soma += numeros.charAt(11 - i) * i;
						resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
						if (resultado != digitos.charAt(1))
							return false;
						return true;
					}
					else
						return Toast('CPF Inválido');
			}

			function redirectToAction(strView){
					window.location.href = strView;
			}

			function Toast(str){
				M.toast({html: str})
			}

			$('#autocomplete-input-password').on('keyup', function(e){
				$('#autocomplete-input-text-password').val($('#autocomplete-input-password').val())
			});

			$('#autocomplete-input-text-password').on('keyup', function(e){
				$('#autocomplete-input-password').val($('#autocomplete-input-text-password').val())
			});

			$('.remove_red_eye').mouseenter(function(event) {
				$('.autocomplete-input-password').hide();
				$('.autocomplete-input-text-password').show();

			});

			$('.remove_red_eye').mouseout(function(event) {
				$('.autocomplete-input-password').show();
				$('.autocomplete-input-text-password').hide();

			});

			document.querySelector('.remove_red_eye').addEventListener('click', function(){
				if (document.querySelector('.autocomplete-input-password').style.display == 'block') {
					document.querySelector('.autocomplete-input-password').style.display = 'none';
					document.querySelector('.autocomplete-input-text-password').style.display = 'block';
				}else{
					document.querySelector('.autocomplete-input-password').style.display = 'block'
					document.querySelector('.autocomplete-input-text-password').style.display =  'none';
				};
			})


			$('.cpf').mask('000.000.000-00', {reverse: true});
		</script>
	</body>
	</html>