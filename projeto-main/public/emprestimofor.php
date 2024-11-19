<?php
require_once "../controle/verificalogado.php";
require_once "../controle/conexao.php"; // Conexão com o banco de dados

// Verifica se existe um ID de empréstimo na URL (edição de um empréstimo existente)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM emprestimo WHERE idemprestimo = $id";
    $resultado = mysqli_query($conexao, $sql);

    // Se encontrou o empréstimo, preenche as variáveis com os dados
    if ($linha = mysqli_fetch_array($resultado)) {
        $data_devolucao = $linha['devolucao'];
        $funcionario_id = $linha['funcionario_idfuncionario'];
        $cliente_id = $linha['cliente_idcliente'];
        $livro_id = $linha['livro_idlivro'];
        $botao = "Salvar"; // Botão para editar
    } else {
        $id = 0;
        $data_devolucao = '';
        $funcionario_id = '';
        $cliente_id = '';
        $livro_id = '';
        $botao = "Cadastrar"; // Botão para criar
    }
} else {
    // Caso não tenha ID, cria um novo empréstimo
    $id = 0;
    $data_devolucao = '';
    $funcionario_id = '';
    $cliente_id = '';
    $livro_id = '';
    $botao = "Cadastrar"; // Botão para criar
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Empréstimo</title>
    <!-- Link do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluindo o Font Awesome para ícones -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.css">
    <!-- Estilos adicionais -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-control, .form-select {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 25px;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-back {
            color: #007bff;
            font-size: 18px;
            text-decoration: none;
            margin-bottom: 20px;
        }
        .btn-back:hover {
            text-decoration: underline;
        }
        h1 {
            color: #007bff;
            text-align: center;
        }
        .form-group label {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container mt-4 animate__animated animate__fadeIn">
        <a href="home.php" class="btn-back"><i class="fas fa-home"></i> Página inicial</a>
        
        <h1><?php echo ($id > 0) ? "Editar" : "Cadastrar"; ?> Empréstimo</h1>

        <!-- Formulário para cadastrar ou editar o empréstimo -->
        <form action="../controle/emprestimo.php" method="POST">
            <!-- Campo oculto para ID do empréstimo -->
            <input type="hidden" name="idemprestimo" value="<?php echo $id; ?>">

            <!-- Campo de data de devolução -->
            <div class="form-group mb-3">
                <label for="Data_Devol">Data de Devolução:</label>
                <input type="date" id="Data_Devol" name="Data_Devol" class="form-control" value="<?php echo $data_devolucao; ?>" required>
            </div>

            <!-- Campo de funcionário -->
            <div class="form-group mb-3">
                <label for="funcionario">Funcionário:</label>
                <select id="funcionario" name="funcionario" class="form-select select2" required>
                    <?php
                        // Consulta para buscar os funcionários
                        $sql = "SELECT idfuncionario, nome FROM funcionario";
                        $resultados = mysqli_query($conexao, $sql);

                        while ($linha = mysqli_fetch_array($resultados)) {
                            $id_funcionario = $linha['idfuncionario'];
                            $nome_funcionario = $linha['nome'];
                            $selected = ($id_funcionario == $funcionario_id) ? 'selected' : '';
                            echo "<option value='$id_funcionario' $selected>$nome_funcionario</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Campo de cliente -->
            <div class="form-group mb-3">
                <label for="cliente">Cliente:</label>
                <select id="cliente" name="cliente" class="form-select select2" required>
                    <?php
                        // Consulta para buscar os clientes
                        $sql = "SELECT idcliente, nome FROM cliente";
                        $resultados = mysqli_query($conexao, $sql);

                        while ($linha = mysqli_fetch_array($resultados)) {
                            $id_cliente = $linha['idcliente'];
                            $nome_cliente = $linha['nome'];
                            $selected = ($id_cliente == $cliente_id) ? 'selected' : '';
                            echo "<option value='$id_cliente' $selected>$nome_cliente</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Campo de livro -->
            <div class="form-group mb-3">
                <label for="livro">Livro:</label>
                <select id="livro" name="livro" class="form-select select2" required>
                    <?php
                        // Consulta para buscar os livros
                        $sql = "SELECT idlivro, titulo FROM livro";
                        $resultados = mysqli_query($conexao, $sql);

                        while ($linha = mysqli_fetch_array($resultados)) {
                            $id_livro = $linha['idlivro'];
                            $titulo_livro = $linha['titulo'];
                            $selected = ($id_livro == $livro_id) ? 'selected' : '';
                            echo "<option value='$id_livro' $selected>$titulo_livro</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Botão de envio -->
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> <?php echo $botao; ?>
            </button>
        </form>
    </div>

    <!-- Scripts do Bootstrap, Font Awesome, Select2, e SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializando o Select2
            $('.select2').select2();

            // Exemplo de SweetAlert2 (pode ser modificado conforme necessidade)
            <?php if ($botao == "Salvar") { ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Empréstimo salvo com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                });
            <?php } ?>
        });
    </script>
</body>
</html>
