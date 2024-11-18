<?php
$Data_Devol = $_GET['Data_Devol'];
$funcionario = $_GET['funcionario'];
$cliente = $_GET['cliente'];
$livro = $_GET['livro'];
// echo 'Data do empréstimo: ' . $data_de_emprestimo;
// echo "<br>";
// echo 'Data de devolução: ' . $data_de_devolucao;
// echo "<br>";
// echo 'Juros do empréstimo' . $juros_de_emprestimo;



// mudei o  texte para date no Data_Devol 

require_once "./conexao.php";

$sql = "INSERT INTO emprestimo (devolucao,funcionario_idfuncionario,cliente_idcliente,livro_idlivro) 
VALUES ('$Data_Devol','$funcionario','$cliente','$livro')";

mysqli_query($conexao, $sql);

header("Location: ../public/home.php");
?>