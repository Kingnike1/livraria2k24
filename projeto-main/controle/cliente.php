<?php

// Verifica se existe um ID de cliente passado, caso contrário, usa 0
$id = isset($_POST['idcliente']) ? $_POST['idcliente'] : 0;  // ID do cliente

$nome = $_POST['nome'];
$data_c = $_POST['data_de_nascimento'];
$cpf_c = $_POST['cpf'];
$telef_c = $_POST['telefone'];

require_once "./conexao.php";

// Lógica de inserção ou atualização
if ($id == 0) {
    // Inserção de um novo cliente
    $sql = "INSERT INTO cliente (nome, data_de_nascimento, cpf, telefone) 
            VALUES ('$nome', '$data_c', '$cpf_c', '$telef_c')";
} else {
    // Atualização de um cliente existente
    $sql = "UPDATE cliente 
            SET nome = '$nome', data_de_nascimento = '$data_c', cpf = '$cpf_c', telefone = '$telef_c' 
            WHERE idcliente = $id";  // A chave primária da tabela é 'idcliente', não 'id'
}

// Executa o SQL
mysqli_query($conexao, $sql);

// Redireciona para a página inicial após a inserção ou atualização
header("Location: ../public/home.php");

?>
