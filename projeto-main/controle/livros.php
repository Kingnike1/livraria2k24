<?php
require_once "./conexao.php";

$idlivro = $_POST['idlivro'];
$genero = $_POST['genero'];
$titulo = $_POST['titulo'];
$idioma = $_POST['idioma'];
$editora = $_POST['editora'];
$autor = $_POST['autor'];
$data_pu = $_POST['data_pu'];
$disponivel = $_POST['disponivel'];

if ($idlivro == 0) {
    // Inserir novo livro
    $sql = "INSERT INTO livro (genero, titulo, idioma, editora_ideditora, data_de_publicacao, autor_idautor, disponivel) 
            VALUES ('$genero', '$titulo', '$idioma', '$editora', '$data_pu', '$autor', '$disponivel')";
} else {
    // Atualizar livro existente
    $sql = "UPDATE livro 
            SET genero = '$genero', 
                titulo = '$titulo', 
                idioma = '$idioma', 
                editora_ideditora = '$editora', 
                data_de_publicacao = '$data_pu', 
                autor_idautor = '$autor', 
                disponivel = '$disponivel' 
            WHERE idlivro = $idlivro";
}

mysqli_query($conexao, $sql);

header("Location: ../public/home.php");
?>
