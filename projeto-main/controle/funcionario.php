<?php
$nome_f = $_POST['nome'];
$data_nf = $_POST['data_de_nascimento'];
$cpf_f = $_POST['cpf'];
$tele_f = $_POST['telefone'];
$salario = $_POST['salario'];

require_once "./conexao.php";

$sql = "INSERT INTO funcionario (nome, data_de_nascimento, cpf, telefone, salario) VALUES ('$nome_f','$data_nf', '$cpf_f', '$tele_f', $salario)";

mysqli_query($conexao, $sql);

header("Location: ../public/home.php");
