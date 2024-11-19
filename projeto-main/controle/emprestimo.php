<?php
require_once "./conexao.php";

$idemprestimo = $_POST['idemprestimo'];
$Data_Devol = $_POST['Data_Devol'];
$funcionario = $_POST['funcionario'];
$cliente = $_POST['cliente'];
$livro = $_POST['livro'];

if ($idemprestimo == 0) {
    // Inserir novo empréstimo
    $sql = "INSERT INTO emprestimo (devolucao, funcionario_idfuncionario, cliente_idcliente, livro_idlivro) 
            VALUES ('$Data_Devol', '$funcionario', '$cliente', '$livro')";
} else {
    // Atualizar empréstimo existente
    $sql = "UPDATE emprestimo 
            SET devolucao = '$Data_Devol', 
                funcionario_idfuncionario = '$funcionario', 
                cliente_idcliente = '$cliente', 
                livro_idlivro = '$livro' 
            WHERE idemprestimo = $idemprestimo";
}

mysqli_query($conexao, $sql);

header("Location: ../public/home.php");
?>
