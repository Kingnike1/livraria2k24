<?php
        $genero = $_POST['genero'];
        $titulo = $_POST['titulo'];
        $idioma = $_POST['idioma'];
        $editora = $_POST['editora'];
        $autor = $_POST['autor'];
        $data_pu = $_POST['data_pu'];
        $disponivel = $_POST['disponivel'];
        
      require_once "./conexao.php";

      $sql = "INSERT INTO livro(genero, titulo, idioma, editora_ideditora,data_de_publicacao,autor_idautor,disponivel) 
      VALUES ('$genero','$titulo','$idioma', '$editora','$data_pu','$autor','$disponivel')";

      mysqli_query($conexao, $sql);
      
      header("Location: ../public/home.php");
?>