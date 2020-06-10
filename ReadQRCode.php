<?php
  $url = "https://www.canalti.com.br/api/pokemons.json";
  $pokemons = json_decode(file_get_contents($url));

  var_dump($pokemons);
?>

<script type="text/javascript">
	
	let email = 'matheus.ferreira@jumplabel.com.br';
	let senha = 'jump123';

	let params = {
		email,
		senha
	};

	$.ajax({
		url: 'https://localhost:44356/api/HoursAPI',
		type: 'POST',
		data: params,
	})
	.done(function(data) {
		console.log("success: ");
	})
	.fail(function() {
		console.log("error");
	});


</script>