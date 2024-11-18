<?php
 require_once "./conexao.php";

 $id = $_GET['id'];

 $nome = $_POST['nome'];
 $localidade = $_POST['localidade'];

 if ($id == 0) {

    $sql = "INSERT INTO editora (nome, cpf, telefone) VALUES ('$nome', '$localidade')";

 } else {

    $sql = "UPDATE editora SET nome = '$nome', localidade = '$localidade' WHERE ideditora = $id";

 }

 mysqli_query($conexao, $sql);

 header("Locantion: ../public/home.php");