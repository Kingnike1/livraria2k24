<?php
require_once "../controle/verificalogado.php";  // Verifica o login
require_once "../controle/conexao.php";  // Inclui o arquivo de conexão com o banco de dados

// Função para contar registros de uma tabela
function contarRegistros($tabela) {
    global $conexao;
    
    // Consulta SQL para contar os registros
    $sql = "SELECT COUNT(*) AS total FROM $tabela";
    $resultado = mysqli_query($conexao, $sql);
    
    if ($resultado) {
        $linha = mysqli_fetch_assoc($resultado);
        return $linha['total'];
    } else {
        return 0;
    }
}

// Contando os registros
$totalLivros = contarRegistros('livro');
$totalClientes = contarRegistros('cliente');
$totalEmprestimos = contarRegistros('emprestimo');
$totalFuncionarios = contarRegistros('funcionario');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Dados</title>
    
    <!-- Link para o Bootstrap (CDN) para estilizar o layout -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Link para a biblioteca Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Gráfico de Total de Registros</h2>
        <canvas id="graficoHorizontal" width="400" height="200"></canvas>
    </div>

    <script>
        // Dados para o gráfico
        const ctx = document.getElementById('graficoHorizontal').getContext('2d');
        const graficoHorizontal = new Chart(ctx, {
            type: 'bar',  // Tipo de gráfico (horizontal)
            data: {
                labels: ['Livros', 'Clientes', 'Empréstimos', 'Funcionários'], // Tabelas
                datasets: [{
                    label: 'Total de Registros',
                    data: [<?php echo $totalLivros; ?>, <?php echo $totalClientes; ?>, <?php echo $totalEmprestimos; ?>, <?php echo $totalFuncionarios; ?>], // Dados vindos do PHP
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
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true,  // Começa do zero no eixo X
                        title: {
                            display: true,
                            text: 'Número de Registros'
                        }
                    },
                    y: {
                        beginAtZero: true  // Começa do zero no eixo Y
                    }
                },
                indexAxis: 'y',  // Gráfico horizontal
            }
        });
    </script>

    <!-- Link para o Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
