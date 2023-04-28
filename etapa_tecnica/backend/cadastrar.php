<?php

	include_once 'conexao.php';
	/*Inserindo dados na tabela*/
	$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
	$query_usuario = "INSERT INTO user (nome, email) VALUES ('$nome', '$email')";
	mysqli_query($conn, $query_usuario);
	if(mysqli_insert_id($conn)){
		echo true;
	}else{
		echo false;
	}
?> 