<?php
require_once "../controle/verificalogado.php";  // Certifique-se de que o caminho esteja correto
require_once "../controle/conexao.php";  // Inclua o arquivo de conexão

// Função para contar os registros de empréstimos por funcionário
function contarEmprestimosFuncionario($idfuncionario)
{
    global $conexao;
    $sql = "SELECT COUNT(*) AS total_emprestimos FROM emprestimo WHERE funcionario_idfuncionario = $idfuncionario";
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado) {
        $linha = mysqli_fetch_assoc($resultado);
        return $linha['total_emprestimos'];
    }
    return 0;
}

// Exemplo de função modificada para garantir que o valor não seja null
function tempoMedioAtendimento($idfuncionario)
{
    global $conexao;
    $sql = "SELECT AVG(DATEDIFF(dia_do_emprestimo, devolucao)) AS tempo_medio FROM emprestimo WHERE funcionario_idfuncionario = $idfuncionario";
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado) {
        $linha = mysqli_fetch_assoc($resultado);
        // Verificar se o valor é null, caso seja, definir como 0
        $tempoMedio = $linha['tempo_medio'] !== null ? $linha['tempo_medio'] : 0;
        return round($tempoMedio, 2);  // Retorna o tempo médio em dias
    }
    return 0;
}

// Função para calcular a média de avaliações de cada funcionário (caso tenha avaliações)
function mediaAvaliacoesFuncionario($idfuncionario)
{
    global $conexao;
    $sql = "SELECT AVG(avaliacao) AS media_avaliacao FROM avaliacao_funcionario WHERE funcionario_idfuncionario = $idfuncionario";
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado) {
        $linha = mysqli_fetch_assoc($resultado);
        // Verificar se o valor é null, caso seja, definir como 0
        $media = $linha['media_avaliacao'] !== null ? $linha['media_avaliacao'] : 0;
        return round($media, 2);  // Retorna a média de avaliações
    }
    return 0;
}

// Obter todos os funcionários
$sqlFuncionarios = "SELECT * FROM funcionario ORDER BY nome ASC";
$resultadoFuncionarios = mysqli_query($conexao, $sqlFuncionarios);

// Gerar o ranking com base nos critérios
$rankingFuncionarios = [];
while ($funcionario = mysqli_fetch_assoc($resultadoFuncionarios)) {
    $idfuncionario = $funcionario['idfuncionario'];
    $nome = $funcionario['nome'];
    $cpf = $funcionario['cpf'];

    // Obter o número de empréstimos, tempo médio de atendimento e a média de avaliações
    $totalEmprestimos = contarEmprestimosFuncionario($idfuncionario);
    $tempoMedio = tempoMedioAtendimento($idfuncionario);
    $mediaAvaliacoes = mediaAvaliacoesFuncionario($idfuncionario);

    // Adicionar no ranking
    $rankingFuncionarios[] = [
        'nome' => $nome,
        'cpf' => $cpf,
        'total_emprestimos' => $totalEmprestimos,
        'tempo_medio' => $tempoMedio,
        'media_avaliacoes' => $mediaAvaliacoes,
    ];
}

// Ordenar o ranking pelos empréstimos e tempo médio de atendimento
usort($rankingFuncionarios, function ($a, $b) {
    if ($a['total_emprestimos'] == $b['total_emprestimos']) {
        return $a['tempo_medio'] <=> $b['tempo_medio'];  // Ordena por tempo médio de atendimento
    }
    return $b['total_emprestimos'] <=> $a['total_emprestimos'];  // Ordena por número de empréstimos
});
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking de Funcionários</title>

    <!-- Link para o Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvT6X2x3Zg3I5fbs3CzH4mfvsh0lb8J77s" crossorigin="anonymous">

    <style>
        /* Reset de margens e padding, garantindo que todos os elementos fiquem alinhados corretamente */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilo para o corpo da página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            /* Cor de fundo suave */
            margin-top: 20px;
        }

        /* Estilo para o contêiner principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #ffffff;
            /* Cor de fundo branca para destacar o conteúdo */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilo para o título */
        h1 {
            font-size: 2.5rem;
            color: #343a40;
            /* Cor do texto */
            margin-bottom: 20px;
            text-align: center;
        }

        /* Estilo para o subtítulo */
        p.lead {
            font-size: 1.2rem;
            color: #6c757d;
            /* Cor suave para o subtítulo */
            text-align: center;
            margin-bottom: 40px;
        }

        /* Tabela */
        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
        }

        /* Estilo para cabeçalhos da tabela */
        thead {
            background-color: #007bff;
            /* Azul para o cabeçalho */
            color: #ffffff;
            /* Cor do texto no cabeçalho */
        }

        table th {
            font-size: 1.1rem;
            font-weight: bold;
        }

        /* Linha de alternância da tabela */
        table tr:nth-child(even) {
            background-color: #f2f2f2;
            /* Cor suave para linhas alternadas */
        }

        table tr:hover {
            background-color: #e9ecef;
            /* Cor de destaque quando passar o mouse */
        }

        /* Estilo para a célula de posição (primeira coluna) */
        table td:first-child {
            font-weight: bold;
            color: #007bff;
            /* Azul para destacar a posição */
        }

        /* Ajuste no estilo de tabelas para responsividade */
        @media (max-width: 768px) {
            table {
                font-size: 0.9rem;
                /* Reduz o tamanho da fonte em telas menores */
            }

            h1 {
                font-size: 2rem;
                /* Ajuste no tamanho do título */
            }

            p.lead {
                font-size: 1rem;
                /* Ajuste no subtítulo */
            }
        }

        /* Estilo para a borda da página */
        .container {
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid #f1f1f1;
        }

        /* Efeito no botão de ordenação das tabelas */
        th.sortable:hover {
            cursor: pointer;
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="my-4 text-center">Ranking de Funcionários</h1>
        <p class="lead text-center">Ranking baseado no número de empréstimos realizados, tempo médio de atendimento e avaliações.</p>

        <!-- Tabela com o ranking -->
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Posição</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Total de Empréstimos</th>
                    <th scope="col">Tempo Médio de Atendimento (dias)</th>
                    <th scope="col">Média de Avaliações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $posicao = 1;
                foreach ($rankingFuncionarios as $funcionario) {
                    echo "<tr>";
                    echo "<td>{$posicao}</td>";
                    echo "<td>{$funcionario['nome']}</td>";
                    echo "<td>{$funcionario['cpf']}</td>";
                    echo "<td>{$funcionario['total_emprestimos']}</td>";
                    echo "<td>{$funcionario['tempo_medio']}</td>";
                    echo "<td>{$funcionario['media_avaliacoes']}</td>";
                    echo "</tr>";
                    $posicao++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb6dtz5dJle0p/4w1w7O1dBGvXyM4pWw3A7l3w5m1jZG3R4l2F" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0p6NsxFQd0fS5zxW4QpJXZK3mP+7e0I2x6lCVK8r2xY1NLo4" crossorigin="anonymous"></script>
</body>

</html>