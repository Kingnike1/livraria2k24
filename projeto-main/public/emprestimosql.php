<?php
require_once "../controle/verificalogado.php";
require_once "../controle/conexao.php"; // Conexão com o banco de dados
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empréstimos</title>
    <!-- Link do Bootstrap (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJRBCkT9q9zYq1zN4r5drKK9lfkVVVhxRZoOPjcjqwSoPQcklmPknDL3ESzM" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilo.css">
</head>

<body>
    <div class="container my-4">
        <h1 class="text-center text-primary mb-4">Lista de Empréstimos</h1>
        
        <div class="mb-3">
            <a href="home.php" class="btn btn-secondary">Página Inicial</a>
            <a href="../controle/pesquisaremprestimo.php" class="btn btn-info">Pesquisar</a>
        </div>

        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID Empréstimo</th>
                    <th>Devolução</th>
                    <th>Dia do Empréstimo</th>
                    <th>Funcionário ID</th>
                    <th>Cliente ID</th>
                    <th>Livro ID</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $campo = 'idemprestimo';
                $tabela = 'emprestimo';
                $loc = 'emprestimosql.php';

                // Consulta SQL para obter os empréstimos
                $sql = "SELECT * FROM emprestimo";
                $resultados = mysqli_query($conexao, $sql);

                // Loop pelos resultados e geração das linhas da tabela
                while ($linha = mysqli_fetch_array($resultados)) {
                    $id = $linha['idemprestimo'];
                    $devolucao = $linha['devolucao'];
                    $dia_do_emprestimo = $linha['dia_do_emprestimo'];
                    $funcionario = $linha['funcionario_idfuncionario'];
                    $cliente = $linha["cliente_idcliente"];
                    $livro = $linha["livro_idlivro"];

                    echo "<tr>";
                    echo "<td>{$id}</td>";
                    echo "<td>{$devolucao}</td>";
                    echo "<td>{$dia_do_emprestimo}</td>";
                    echo "<td>{$funcionario}</td>";
                    echo "<td>{$cliente}</td>";
                    echo "<td>{$livro}</td>";
                    echo "<td>
                            <a href='../controle/deletar.php?id={$id}&campo={$campo}&tabela={$tabela}&loc={$loc}' class='btn btn-danger btn-sm'>Deletar</a>
                        </td>";
                    echo "<td>
                            <a href='emprestimofor.php?id={$linha['idemprestimo']}' class='btn btn-warning btn-sm'>Editar</a>
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
