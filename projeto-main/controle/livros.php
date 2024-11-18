<?php
        $genero = $_GET['genero'];
        $titulo = $_GET['titulo'];
        $idioma = $_GET['idioma'];
        $editora = $_GET['editora'];
        $autor = $_GET['autor'];
        $data_pu = $_GET['data_pu'];
        $disponivel = $_GET['disponivel'];
        
      require_once "./conexao.php";

      $sql = "INSERT INTO livro(genero, titulo, idioma, editora_ideditora,data_de_publicacao,autor_idautor,disponivel) 
      VALUES ('$genero','$titulo','$idioma', '$editora','$data_pu','$autor','$disponivel')";

      mysqli_query($conexao, $sql);
      
      header("Location: ../public/home.php");
?>