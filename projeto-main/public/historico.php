<?php
$servidor = "db";
$usuario = "root";
$senha = "123";
$banco = "mydb";
// Conectar ao banco de dados (substitua com suas credenciais)
$conexao = mysqli_connect("$servidor", "$usuario", "$senha", "$banco");

if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Função para buscar cliente pelo nome
function buscarClientePorNome($nome_cliente) {
    global $conexao;
    $nome_cliente = mysqli_real_escape_string($conexao, $nome_cliente);
    $sql = "SELECT idcliente, nome FROM cliente WHERE nome LIKE '%$nome_cliente%'";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        $clientes = [];
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $clientes[] = $linha;
        }
        return $clientes;
    }
    return [];
}

// Função para obter o histórico de empréstimos de um cliente
function historicoEmprestimosCliente($cliente_id) {
    global $conexao;
    $sql = "SELECT e.dia_do_emprestimo, e.devolucao, l.titulo AS livro
            FROM emprestimo e
            JOIN livro l ON e.livro_idlivro = l.idlivro
            WHERE e.cliente_idcliente = $cliente_id";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        $historico = [];
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $historico[] = $linha;
        }
        return $historico;
    }
    return [];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Empréstimos</title>
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <a href="home.php">Pagina Inicial</a>
    <div class="container">
        <h1 class="center-align teal-text text-darken-2">Consultar Histórico de Empréstimos</h1>
        <form method="POST" action="historico.php" class="col s12 m6 offset-m3">
            <div class="input-field">
                <input type="text" name="nome_cliente" id="nome_cliente" class="validate" required>
                <label for="nome_cliente">Nome do Cliente</label>
            </div>
            <button type="submit" class="btn waves-effect waves-light teal">Buscar Histórico</button>
        </form>

        <?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome_cliente'])) {
    $nome_cliente = $_POST['nome_cliente'];
    $clientes = buscarClientePorNome($nome_cliente);

    // Exibe os resultados
    if (count($clientes) > 0) {
        foreach ($clientes as $cliente) {
            $historico = historicoEmprestimosCliente($cliente['idcliente']);

            echo "<h2>Histórico de Empréstimos de " . $cliente['nome'] . "</h2>";
            if (count($historico) > 0) {
                echo "<table class='highlight responsive-table'>";
                echo "<thead><tr><th>Data de Empréstimo</th><th>Data de Devolução</th><th>Livro</th></tr></thead>";
                echo "<tbody>";
                foreach ($historico as $registro) {
                    echo "<tr>";
                    echo "<td>" . $registro['dia_do_emprestimo'] . "</td>";
                    echo "<td>" . $registro['devolucao'] . "</td>";
                    echo "<td>" . $registro['livro'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>Este cliente não tem empréstimos registrados.</p>";
            }
        }
    } else {
        echo "<p>Cliente não encontrado.</p>";
    }
}        ?>

    </div>

    <!-- Materialize JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){
            M.AutoInit(); // Inicia os componentes do Materialize
        });
    </script>
</body>
</html>
