<?php
require_once "../controle/verificalogado.php";

if (isset($_GET['valor'])) {
    $valor = $_GET['valor'];
} else {
    $valor = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../controle/pesquisaremprestimo.php" method="$_GET">
        Campo: <br>
        <input type= "text" name="valor" value="<?php echo $valor; ?>"> <br><br>

        <input type="submit" value="Enviar">
    </form> <br> 

    <?php 
    
    if (isset($_GET['valor'])) {
        require_once "../controle/conexao.php";
        $valor = $_GET['valor'];
        $sql = "SELECT * FROM emprestimo WHERE devolucao LIKE '%$valor%'";
        $resultados = mysqli_query($conexao, $sql);
    
        if (mysqli_num_rows($resultados) == 0) {
            echo "Não foram encontrados resultados.";

        } else {
            echo "<table border='1'";
            echo "<tr>";
            echo "<td>id</td>";
            echo "<td>devolucao</td>";
            echo "<td>dia_do_emprestimo</td>";
            echo "<td>funcionario_idfuncionario</td>";
            echo "<td>cliente_idcliente</td>";
            echo "<td>livro_idlivro</td>";
            echo "<tr/>";


            while ($linha = mysqli_fetch_array($resultados)){
               $id = $linha['idemprestimo'];
               $devolucao = $linha ['devolucao'];
               $dia_do_emprestimo= $linha ['dia_do_emprestimo'];
               $funcionario_idfuncionario = $linha['funcionario_idfuncionario'];
               $cliente_idcliente = $linha['cliente_idcliente'];
               $livro_idlivro = $linha['livro_idlivro'];
               echo "<tr>";
               echo "<td>$id</td>";
               echo "<td>$devolucao</td>";
               echo "<td>$dia_do_emprestimo</td>";
               echo "<td>$funcionario_idfuncionario</td>";
               echo "<td>$cliente_idcliente</td>";
               echo "<td>$livro_idlivro</td>";
               echo "<tr/>";

            }
        }
    }
    
    else {
        echo "Procure um nome";
    }
            
  
    ?>

</body>
</html>