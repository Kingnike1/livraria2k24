<?php
require_once "./conexao.php";

$idautor = $_POST['idautor'];
$nome = $_POST['nome'];
$nacionalidade = $_POST['nacionalidade'];
$data_de_nascimento = $_POST['data_de_nascimento'];

if ($idautor == 0) {
    // Inserir novo autor
    $sql = "INSERT INTO autor (nome, nacionalidade, data_de_nascimento) 
            VALUES ('$nome', '$nacionalidade', '$data_de_nascimento')";
} else {
    // Atualizar autor existente
    $sql = "UPDATE autor 
            SET nome = '$nome', 
                nacionalidade = '$nacionalidade', 
                data_de_nascimento = '$data_de_nascimento' 
            WHERE idautor = $idautor";
}

mysqli_query($conexao, $sql);

header("Location: ../public/home.php");
?>
