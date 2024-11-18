<?php
require_once "../controle/verificalogado.php";
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autor</title>
    <!-- Link do Bootstrap (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJRBCkT9q9zYq1zN4r5drKK9lfkVVVhxRZoOPjcjqwSoPQcklmPknDL3ESzM" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center text-primary my-4">Lista de Autor</h1>
        <div class="mb-3">
            <a href="home.php" class="btn btn-secondary">Página Inicial</a>
            <a href="../controle/pesquisarautor.php" class="btn btn-info">Pesquisar</a>
        </div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID Autor</th>
                    <th>Nome</th>
                    <th>Nacionalidade</th>
                    <th>Data de Nascimento</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "../controle/conexao.php";
                $campo = 'idautor';
                $tabela = 'autor';
                $loc = 'autorsql.php';

                $sql = "SELECT * FROM autor";
                $resultados = mysqli_query($conexao, $sql);

                while ($linha = mysqli_fetch_array($resultados)) {
                    $id = $linha['idautor'];
                    $nome = $linha['nome'];
                    $nacionalidade = $linha['nacionalidade'];
                    $nascimento = $linha['data_de_nascimento'];    

                    echo "<tr>";
                    echo "<td>$id</td>";
                    echo "<td>$nome</td>";
                    echo "<td>$nacionalidade</td>";
                    echo "<td>$nascimento</td>";
                    echo "<td><a href='../controle/deletar.php?id=$id&campo=$campo&tabela=$tabela&loc=$loc' class='btn btn-danger btn-sm'>Deletar</a></td>";
                    echo "<td><a href='cliente.php?id={$linha['idautor']}' class='btn btn-warning btn-sm'>Editar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Link do Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-TfX0JP2Uom6MIyZ4mGs2kjyR8RR5+9MwXwJXZ7hmltX5b4kb4D7TZB+5di9gU8Qm" crossorigin="anonymous"></script>
</body>
</html>
