<?php 
// se conectar ao banco
// qual o servidor? qual usuario? qual senha? qual banco
require_once "../controle/conexao.php";

$id = $_GET['id'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$nome = $_POST['nome'];
$data_de_nascimento = $_POST['data_de_nascimento'];

if ($id == 0) {
    // criar um comando SQL que grava no banco
    $sql = "INSERT INTO cliente (cpf, telefone, nome, data_de_nascimento ) VALUES ('cpf', 'telefone', 'nome', 'data_de_nascimento')";
} else {
    $sql = "UPDATE cliente SET cpf = '$cpf', telefone = '$telefone', nome = '$nome', data_de_nascimento = '$data_de_nascimento' WHERE idcliente = '$id'";
}

mysqli_query($conexao, $sql);
// Mandar executar o comando

header("Location: ../public/home.php");

?>