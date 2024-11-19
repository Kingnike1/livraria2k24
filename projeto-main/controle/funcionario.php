<?php
require_once "./conexao.php";

$idfuncionario = $_POST['idfuncionario'];
$nome_f = $_POST['nome'];
$data_nf = $_POST['data_de_nascimento'];
$cpf_f = $_POST['cpf'];
$tele_f = $_POST['telefone'];
$salario = $_POST['salario'];

if ($idfuncionario == 0) {
    // Inserir novo funcionário
    $sql = "INSERT INTO funcionario (nome, data_de_nascimento, cpf, telefone, salario) 
            VALUES ('$nome_f', '$data_nf', '$cpf_f', '$tele_f', $salario)";
} else {
    // Atualizar funcionário existente
    $sql = "UPDATE funcionario 
            SET nome = '$nome_f', 
                data_de_nascimento = '$data_nf', 
                cpf = '$cpf_f', 
                telefone = '$tele_f', 
                salario = $salario 
            WHERE idfuncionario = $idfuncionario";
}

mysqli_query($conexao, $sql);

header("Location: ../public/home.php");
?>
