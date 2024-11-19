<?php
require_once "../controle/verificalogado.php";
require_once "../controle/db_functions.php";

$totalLivros = contarRegistros('livro');
$totalClientes = contarRegistros('cliente');
$totalEmprestimos = contarRegistros('emprestimo');
$totalFuncionarios = contarRegistros('funcionario');

$emprestimosPorMes = obterEmprestimosPorLivroMes(2024);

include "header.php";  // Arquivo com o <head>
?>

<body>
    <div class="d-flex">
        <?php include "sidebar.php"; ?> <!-- Barra lateral em outro arquivo -->

        <main class="flex-fill p-4">
            <header class="mb-5">
                <h1>Gerenciamento de Cadastros</h1>
            </header>

            <!-- Estatísticas -->
            <section class="row mb-5">
                <?php
                $estatisticas = [
                    'Livros' => $totalLivros,
                    'Clientes' => $totalClientes,
                    'Empréstimos' => $totalEmprestimos,
                    'Funcionários' => $totalFuncionarios
                ];

                foreach ($estatisticas as $titulo => $total) {
                    echo "<div class='col-md-3'>
                            <div class='card text-center'>
                                <div class='card-body'>
                                    <h5 class='card-title'>Total de $titulo</h5>
                                    <p class='card-text'>$total</p>
                                </div>
                            </div>
                          </div>";
                }
                ?>
            </section>

            <!-- Gráfico -->
            <div class="container">
                <canvas id="graficoHorizontal" width="400" height="200"></canvas>
            </div>
        </main>
    </div>

    <script>
        const graficoDados = [<?php echo $totalLivros; ?>, <?php echo $totalClientes; ?>, <?php echo $totalEmprestimos; ?>, <?php echo $totalFuncionarios; ?>];

        new Chart(document.getElementById('graficoHorizontal').getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Livros', 'Clientes', 'Empréstimos', 'Funcionários'],
                datasets: [{
                    label: 'Total de Registros',
                    data: graficoDados,
                    backgroundColor: ['rgba(255,99,132,0.2)', 'rgba(54,162,235,0.2)', 'rgba(255,206,86,0.2)', 'rgba(75,192,192,0.2)'],
                    borderColor: ['rgba(255,99,132,1)', 'rgba(54,162,235,1)', 'rgba(255,206,86,1)', 'rgba(75,192,192,1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    <?php include "footer.php"; ?>

</body>

</html>