<?php
require_once "../controle/verificalogado.php";

if (isset($_GET['valor'])) {
    $valor = $_GET['valor'];
} else {
    $valor = '';
}
?>  

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Editoras</title>
    <!-- Link do Bootstrap (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJRBCkT9q9zYq1zN4r5drKK9lfkVVVhxRZoOPjcjqwSoPQcklmPknDL3ESzM" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center text-primary my-4">Lista de Editoras</h1>
        <div class="mb-3">
            <a href="home.php" class="btn btn-secondary">Página Inicial</a>
            <a href="../controle/pesquisareditora.php" class="btn btn-info">Pesquisar</a>
        </div>
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Localidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "../controle/conexao.php";
                $campo = 'ideditora';
                $tabela = 'editora';
                $loc = 'editorasql.php';

                // Consulta SQL para obter as editoras
                $sql = "SELECT * FROM editora";
                $resultados = mysqli_query($conexao, $sql);

                // Loop pelos resultados e geração das linhas da tabela
                while ($linha = mysqli_fetch_array($resultados)) {
                    $id = $linha['ideditora'];
                    $nome = $linha['nome'];
                    $localidade = $linha['localidade'];

                    echo "<tr>";
                    echo "<td>{$id}</td>";
                    echo "<td>{$nome}</td>";
                    echo "<td>{$localidade}</td>";
                    echo "<td>
                            <a href='../controle/deletar.php?id={$id}&campo={$campo}&tabela={$tabela}&loc={$loc}' class='btn btn-danger btn-sm'>Deletar</a>
                        </td>";
                    echo "<td>
                            <a href='editoras.php?id={$linha['ideditora']}' class='btn btn-warning btn-sm'>Editar</a>
                        </td>";
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
