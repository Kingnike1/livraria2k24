<?php
require_once "../controle/verificalogado.php";  // Certifique-se de que o caminho esteja correto
require_once "../controle/conexao.php";  // Inclua o arquivo de conexão

// Função para contar registros
function contarRegistros($tabela)
{
    global $conexao;  // Usando a variável $conexao definida no arquivo de conexão

    // Cria a consulta SQL para contar os registros
    $sql = "SELECT COUNT(*) AS total FROM $tabela";

    // Executa a consulta
    $resultado = mysqli_query($conexao, $sql);

    // Verifica se houve erro na consulta
    if ($resultado) {
        // Recupera o número total de registros
        $linha = mysqli_fetch_assoc($resultado);
        return $linha['total'];
    } else {
        // Retorna 0 caso ocorra um erro
        return 0;
    }
}

// Contando os registros
$totalLivros = contarRegistros('livro');
$totalClientes = contarRegistros('cliente');
$totalEmprestimos = contarRegistros('emprestimo');
$totalFuncionarios = contarRegistros('funcionario');

// Consulta SQL para obter a quantidade de empréstimos por livro por mês
$sql = "SELECT livro_idlivro, MONTH(dia_do_emprestimo) AS mes, COUNT(*) AS total_emprestimos
        FROM emprestimo
        WHERE YEAR(dia_do_emprestimo) = 2024  -- Ajuste o ano conforme necessário
        GROUP BY livro_idlivro, MONTH(dia_do_emprestimo)
        ORDER BY mes ASC, livro_idlivro";

$resultado = mysqli_query($conexao, $sql);

// Armazenar os dados para o gráfico de empréstimos por livro
$emprestimos = [];
while ($linha = mysqli_fetch_assoc($resultado)) {
    $livro_id = $linha['livro_idlivro'];
    $mes = $linha['mes'];
    $total_emprestimos = $linha['total_emprestimos'];

    $emprestimos[$livro_id][$mes] = $total_emprestimos;  // Armazenando os dados por livro e mês
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <!-- Link para o Bootstrap (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link para a biblioteca Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="./css/pagina_inicial.css">
</head>

<body>
    <div class="d-flex">
        <!-- Barra Lateral -->
        <nav class="sidenav bg-dark text-white p-4">
            <h3 class="mb-4">Banco de Dados</h3>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="autorsql.php" class="nav-link text-white">Autores</a></li>
                <li class="nav-item"><a href="clientesql.php" class="nav-link text-white">Clientes</a></li>
                <li class="nav-item"><a href="editorasql.php" class="nav-link text-white">Editoras</a></li>
                <li class="nav-item"><a href="funcionariosql.php" class="nav-link text-white">Funcionários</a></li>
                <li class="nav-item"><a href="livrosql.php" class="nav-link text-white">Livros</a></li>
                <li class="nav-item"><a href="historico.php" class="nav-link text-white">Emprestimo do Cliente</a></li>
                <li class="nav-item"><a href="funcionario_ranking.php" class="nav-link text-white">Ranking do Funcionario</a></li>
                <li class="nav-item"><a href="../controle/deslogar.php" class="nav-link text-white">Sair</a></li>
            </ul>
        </nav>

        <!-- Conteúdo Principal -->
        <main class="flex-fill p-4">
            <header class="mb-5">
                <h1>Gerenciamento de Cadastros</h1>
            </header>

            <!-- Estatísticas (Exemplo) -->
            <section class="mb-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Total de Livros</h5>
                                <p class="card-text"><?php echo $totalLivros; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Clientes Cadastrados</h5>
                                <p class="card-text"><?php echo $totalClientes; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Empréstimos Ativos</h5>
                                <p class="card-text"><?php echo $totalEmprestimos; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Funcionários</h5>
                                <p class="card-text"><?php echo $totalFuncionarios; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Gráfico de Total de Registros -->
            <div class="container mt-5">
                <h2 class="mb-4">Gráfico de Total de Registros</h2>
                <canvas id="graficoHorizontal" width="400" height="200"></canvas>
            </div>

            <div>
                <canvas id="graficoLinha"></canvas>
            </div>

            <!-- Seção de Cadastro -->
            <section>
                <h2>Cadastrar</h2>
                <div class="d-flex flex-wrap mb-3">
                    <button class="btn btn-primary m-2"><a href="cliente.php" class="text-white">Cadastrar Cliente</a></button>
                    <button class="btn btn-primary m-2"><a href="autor.php" class="text-white">Cadastrar Autor</a></button>
                    <button class="btn btn-primary m-2"><a href="editoras.php" class="text-white">Cadastrar Editora</a></button>
                    <button class="btn btn-primary m-2"><a href="emprestimofor.php" class="text-white">Cadastrar Empréstimo</a></button>
                    <button class="btn btn-primary m-2"><a href="funcionario.php" class="text-white">Cadastrar Funcionário</a></button>
                    <button class="btn btn-primary m-2"><a href="livrosfor.php" class="text-white">Cadastrar Livro</a></button>
                </div>
            </section>

            <!-- Seção de Listagem -->
            <section>
                <h2>Listar Cadastros</h2>
                <div class="d-flex flex-wrap">
                    <button class="btn btn-success m-2"><a href="clientesql.php" class="text-white">Listar Clientes</a></button>
                    <button class="btn btn-success m-2"><a href="autorsql.php" class="text-white">Listar Autores</a></button>
                    <button class="btn btn-success m-2"><a href="editorasql.php" class="text-white">Listar Editoras</a></button>
                    <button class="btn btn-success m-2"><a href="emprestimosql.php" class="text-white">Listar Empréstimos</a></button>
                    <button class="btn btn-success m-2"><a href="funcionariosql.php" class="text-white">Listar Funcionários</a></button>
                    <button class="btn btn-success m-2"><a href="livrosql.php" class="text-white">Listar Livros</a></button>
                </div>
            </section>
        </main>
    </div>

    <!-- Link para o Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Dados para o gráfico de registros (gráfico misto)
    const ctxHorizontal = document.getElementById('graficoHorizontal').getContext('2d');
    const graficoHorizontal = new Chart(ctxHorizontal, {
        type: 'bar', // Tipo principal
        data: {
            labels: ['Livros', 'Clientes', 'Empréstimos', 'Funcionários'], // Categorias
            datasets: [
                {
                    label: 'Total de Registros (Barras)', // Dados de barras
                    type: 'bar', // Tipo específico para este dataset
                    data: [<?php echo $totalLivros; ?>, <?php echo $totalClientes; ?>, <?php echo $totalEmprestimos; ?>, <?php echo $totalFuncionarios; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Total de Registros (Linha)', // Dados de linha
                    type: 'line', // Tipo específico para este dataset
                    data: [<?php echo $totalLivros; ?>, <?php echo $totalClientes; ?>, <?php echo $totalEmprestimos; ?>, <?php echo $totalFuncionarios; ?>],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    tension: 0.3 // Suaviza a linha
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Categorias'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Número de Registros'
                    }
                }
            }
        }
    });

    // Dados para o gráfico de empréstimos por livro
    const ctxEmprestimos = document.getElementById('graficoEmprestimos').getContext('2d');
    const graficoEmprestimos = new Chart(ctxEmprestimos, {
        type: 'bar',
        data: {
            labels: Object.keys(<?php echo json_encode($emprestimos); ?>),
            datasets: [
                <?php
                foreach ($emprestimos as $livro_id => $meses) {
                    foreach ($meses as $mes => $total) {
                        echo "{ label: 'Livro $livro_id - Mês $mes', data: [$total], backgroundColor: 'rgba(75, 192, 192, 0.2)', borderColor: 'rgba(75, 192, 192, 1)', borderWidth: 1 },";
                    }
                }
                ?>
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
        // Exemplo de dados para o gráfico, esses dados podem vir do PHP
        const ctx = document.getElementById('graficoLinha').getContext('2d');
        const graficoLinha = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'], // Meses
                datasets: [{
                    label: 'Livros',
                    data: [100, 120, 140, 160, 180, 200], // Número de livros por mês
                    borderColor: '#36A2EB',
                    fill: false,
                }, {
                    label: 'Clientes',
                    data: [80, 95, 110, 125, 140, 160], // Número de clientes por mês
                    borderColor: '#FF5733',
                    fill: false,
                }, {
                    label: 'Empréstimos',
                    data: [50, 60, 75, 90, 110, 130], // Número de empréstimos por mês
                    borderColor: '#FFB74D',
                    fill: false,
                }, {
                    label: 'Funcionários',
                    data: [10, 12, 14, 16, 18, 20], // Número de funcionários por mês
                    borderColor: '#81C784',
                    fill: false,
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Meses'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Número de Registros'
                        }
                    }
                }
            }
        });
    </script>


</body>

</html>