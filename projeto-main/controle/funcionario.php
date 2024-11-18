<?php
$nome_f = $_GET['nome_f'];
$data_nf = $_GET['data_nf'];
$cpf_f = $_GET['cpf_f'];
$tele_f = $_GET['tele_f'];
$salario = $_GET['salario'];

require_once "./conexao.php";

$sql = "INSERT INTO funcionario (nome, data_de_nascimento, cpf, telefone, salario) VALUES ('$nome_f','$data_nf', '$cpf_f', '$tele_f', $salario)";

mysqli_query($conexao, $sql);

header("Location: ../public/home.php");
