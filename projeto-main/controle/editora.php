<?php
$nome_ed = $_GET['nome_ed'];
$loc_ed = $_GET['loc_ed'];

require_once "./conexao.php";

$sql = "INSERT INTO editora (nome,localidade) 
VALUES ('$nome_ed','$loc_ed')";

mysqli_query($conexao, $sql);

header("Location: ../public/home.php");
?>