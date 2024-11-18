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
    <form action="../controle/pesquisarautor.php" method="$_GET">
        Campo: <br>
        <input type= "text" name="valor" value="<?php echo $valor; ?>"> <br><br>

        <input type="submit" value="Enviar">
    </form> <br> 

    <?php 
    
    if (isset($_GET['valor'])) {
        require_once "../controle/conexao.php";
        $valor = $_GET['valor'];
        $sql = "SELECT * FROM autor WHERE nome LIKE '%$valor%'";
        $resultados = mysqli_query($conexao,$sql);
    
        if (mysqli_num_rows($resultados) == 0) {
            echo "Não foram encontrados resultados.";


        } else {
            echo "<table border='1'";
            echo "<tr>";
            echo "<td>id</td>";
            echo "<td>nome</td>";
            echo "<td>nacionalidade</td>";
            echo "<td>data_de_nascimento</td>";
            echo "<tr/>";

           
            
            while ($linha = mysqli_fetch_array($resultados)){

                $id = $linha['idautor'];
                $nome = $linha ['nome'];
                $nacionalidade = $linha ['nacionalidade'];
                $data_de_nascimento= $linha['data_de_nascimento'];
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$nome</td>";
                echo "<td>$nacionalidade</td>";
                echo "<td>$data_de_nascimento</td>";
                echo"<tr/>";
            
            }

                
        }
    }
    
    else {
        echo "Procure um nome";
    }
            
  
    ?>

</body>
</html>