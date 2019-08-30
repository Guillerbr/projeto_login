<?php
require_once 'classes/usuarios.php';
$u = new Usuario; //herda da classe acima transforma em variavel

session_start();         

if (!isset($_SESSION['id_usuario'])) {  //se não está definido o id do usuario na sessao,redireciona para o login
	header("location:index.php");
}

?>

<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/estilo.css">
	<title>Alterar Senha</title>
</head>

<body>
	<div>
	<center>
	<h2>Altere sua senha!</h2>
	</center>
	</div>
	
	<div id="corpo-form-cad">
		<h1></h1>
		<form method="POST">

			<input type="password" name="novasenha" placeholder="Senha" maxlength="20">
			<input type="password" name="confSenha" placeholder="Confirmar senha">
			<input type="submit" value="Trocar senha" class="entrar">

		</form>
	</div>

	<a href="conta.php">Voltar</a>

</body>

</html>




<?php

$id_usuario = $_SESSION['id_usuario'];

require_once 'classes/usuarios.php';
$u = new Usuario;

if (isset($_POST['novasenha'])) {

	$novasenhaup = htmlentities(addslashes($_POST['novasenha']));
	$confirmarSenha = htmlentities(addslashes($_POST['confSenha']));

	if (!empty($novasenhaup) && !empty($confirmarSenha)) {

		$u->conectar("sistem_login", "localhost", "root", "");
		if ($u->msgErro == "") {


			if ($novasenhaup == $confirmarSenha) {
				if ($update = $u->trocarSenha($novasenhaup, $id_usuario)) {
					echo '<br>';
					echo "Nova senha cadastrada com sucesso!";
				}
			} else {
				echo '<br>';
				echo "Senhas não conferem!";
			}
		} else {
			echo "Erro: " . $u->msgErro;
		}
	} else {
		echo "Preencha todos os campos!";
	}
}



?>
