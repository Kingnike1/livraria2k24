<?php
require_once "../controle/verificalogado.php";
require_once "../controle/conexao.php"; // Conexão com o banco de dados
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <!-- Link do Bootstrap (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJRBCkT9q9zYq1zN4r5drKK9lfkVVVhxRZoOPjcjqwSoPQcklmPknDL3ESzM" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilo.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center text-primary my-4">Lista de Clientes</h1>
        <div class="mb-3">
            <a href="home.php" class="btn btn-secondary">Página Inicial</a>
        </div>
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID Cliente</th>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $campo = 'idcliente';
                $tabela = 'cliente';
                $loc = 'clientesql.php';
                
                // Consulta SQL para obter os clientes
                $sql = "SELECT * FROM cliente";
                $resultados = mysqli_query($conexao, $sql);

                // Loop pelos resultados e geração das linhas da tabela
                while ($linha = mysqli_fetch_array($resultados)) {
                    $id = $linha['idcliente'];
                    $cpf = $linha['cpf'];
                    $telefone = $linha['telefone'];
                    $nome = $linha['nome'];
                    $nascimento = $linha['data_de_nascimento'];

                    echo "<tr>";
                    echo "<td>{$id}</td>";
                    echo "<td>{$cpf}</td>";
                    echo "<td>{$nome}</td>";
                    echo "<td>{$telefone}</td>";
                    echo "<td>{$nascimento}</td>";
                    echo "<td>
                            <a href='../controle/deletar.php?id=$id&campo=$campo&tabela=$tabela&loc=$loc' class='btn btn-danger btn-sm'>Deletar</a>
                        </td>";
                    echo "<td>
                            <a href='cliente.php?id={$linha['idcliente']}' class='btn btn-warning btn-sm'>Editar</a>
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