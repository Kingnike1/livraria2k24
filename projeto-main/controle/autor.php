<?php
        $nome = $_POST['nome'];
        $nacionalidade = $_POST['nacionalidade'];
        $data_de_nascimento = $_POST['data_de_nascimento'];

        require_once "./conexao.php";

        $sql = "INSERT INTO autor (nome,nacionalidade,data_de_nascimento) 
        VALUES ('$nome','$nacionalidade','$data_de_nascimento')";
        
        mysqli_query($conexao, $sql);
        
        header("Location: ../public/home.php");
?>
