<!DOCTYPE html>
<html>
<head>
	<title>Jogo Par ou Ímpar</title>
</head>
<body>

	<h1>teste result</h1>
	<?php
		// Inicia o placar o contador e o histórico de resultados.
		session_start();
		if (!isset($_SESSION['placarUsuario'])) {
			$_SESSION['placarUsuario'] = 0;
		}
		if (!isset($_SESSION['placarComputador'])) {
			$_SESSION['placarComputador'] = 0;
		}
		if (!isset($_SESSION['contador'])) {
			$_SESSION['contador'] = 1;
		}
		if (!isset($_SESSION['resultados'])) {
			$_SESSION['resultados'] = array();
		}

		// Verifica se o formulário foi enviado.
		if (isset($_POST['escolha'])) {
			// Obtém a escolha do usuário.
			$escolhaUsuario = $_POST['escolha'];
			// Obtém o número escolhido pelo usuário.
			$numeroUsuario = $_POST['numero'];
			// Gera um número aleatório para o computador ;)
			$numeroComputador = rand(0, 10);
			// Calcula a soma dos números ;)
			$soma = $numeroUsuario + $numeroComputador;
			// Verifica se a soma é par ou ímpar
			if ($soma % 2 == 0) {
				$resultado = "par";
			} else {
				$resultado = "ímpar";
			}
			// Verifica se o usuário ganhou ou perdeu
			if ($resultado == $escolhaUsuario) {
				echo "<p>Você ganhou! O número do computador foi $numeroComputador.</p>";
				$_SESSION['placarUsuario']++;
				$_SESSION['resultados'][] = $_SESSION['contador'] . " - Usuário: " . $_SESSION['placarUsuario'] . " | Computador: " . $_SESSION['placarComputador'] . " | Resultado: Vitória do Usuário";
			} else {
				echo "<p>Você perdeu! O número do computador foi $numeroComputador.</p>";
				$_SESSION['placarComputador']++;
				$_SESSION['resultados'][] = $_SESSION['contador'] . " - Usuário: " . $_SESSION['placarUsuario'] . " | Computador: " . $_SESSION['placarComputador'] . " | Resultado: Vitória do Computador";
			}
			// Incrementa o contador
			$_SESSION['contador']++;
		}

		// Exibe o placar
		echo "<p>Placar:</p>";
		echo "<p>Usuário: " . $_SESSION['placarUsuario'] . "</p>";
		echo "<p>Computador: " . $_SESSION['placarComputador'] ."</p>";

		// Exibe o histórico de resultados
	
		if (isset($_SESSION['resultados']) && count($_SESSION['resultados']) > 0) {
	echo "<ol>";
	foreach ($_SESSION['resultados'] as $resultado) {
		echo "<li>$resultado</li>";
	}
	echo "</ol>";
}


		// Bnt para zerar o placar e o histórico de resultados
		echo "<form method='POST'>";
		echo "<button type='submit' name='zerar'>Zerar Placar e Histórico</button>";
		echo "</form>";
		// Verifica se o botão de zerar foi clicado
		if (isset($_POST['zerar'])) {
    $_SESSION['placarUsuario'] = 0;
    $_SESSION['placarComputador'] = 0;
    $_SESSION['resultados'] = array();
}
?>
	<form method="POST">
		<label>Escolha:</label>
		<select name="escolha">
			<option value="par">Par</option>
			<option value="ímpar">Ímpar</option>
		</select>
		<br>
		<label>Número:</label>
		<input type="number" name="numero" min="0" max="10">
		<br>
		<button type="submit">Jogar</button>
	</form>

</body>
</html>
