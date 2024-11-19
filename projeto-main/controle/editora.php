<?php
require_once "./conexao.php";

$ideditora = $_POST['ideditora'];
$nome_ed = $_POST['nome_ed'];
$loc_ed = $_POST['loc_ed'];

if ($ideditora == 0) {
    // Inserir nova editora
    $sql = "INSERT INTO editora (nome, localidade) 
            VALUES ('$nome_ed', '$loc_ed')";
} else {
    // Atualizar editora existente
    $sql = "UPDATE editora 
            SET nome = '$nome_ed', 
                localidade = '$loc_ed' 
            WHERE ideditora = $ideditora";
}

mysqli_query($conexao, $sql);

header("Location: ../public/home.php");
?>
