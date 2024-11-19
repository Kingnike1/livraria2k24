<?php
require_once "../controle/verificalogado.php";
require_once "../controle/conexao.php"; // Conexão com o banco de dados

// Verifica se existe um ID passado pela URL (edição de um funcionário existente)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM funcionario WHERE idfuncionario = $id";
    $resultado = mysqli_query($conexao, $sql);

    // Se encontrou o funcionário, preenche as variáveis com os dados
    if ($linha = mysqli_fetch_array($resultado)) {
        $nome = $linha['nome'];
        $cpf = $linha['cpf'];
        $telefone = $linha['telefone'];
        $data_de_nascimento = $linha['data_de_nascimento'];
        $salario = $linha['salario'];
        $botao = "Salvar"; // Botão para editar
    } else {
        $id = 0;
        $nome = '';
        $cpf = '';
        $telefone = '';
        $data_de_nascimento = '';
        $salario = '';
        $botao = "Cadastrar"; // Botão para criar
    }
} else {
    // Caso não tenha ID, cria um novo funcionário
    $id = 0;
    $nome = '';
    $cpf = '';
    $telefone = '';
    $data_de_nascimento = '';
    $salario = '';
    $botao = "Cadastrar"; // Botão para criar
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionário</title>
    <!-- Link do Bootstrap para melhorar o visual -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos customizados -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-control, .form-select {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .btn-submit {
            background-color: #007bff;
            border: none;
            border-radius: 25px;
            width: 100%;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        h1 {
            color: #007bff;
            text-align: center;
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
    </style>
</head>
<body>
    <div class="container mt-4">
        <a href="home.php" class="btn-back"><i class="fas fa-home"></i> Página inicial</a>
        
        <h1><?php echo ($id > 0) ? "Editar" : "Cadastrar"; ?> Funcionário</h1>

        <!-- Formulário de cadastro/edição de funcionário -->
        <form action="../controle/funcionario.php" method="POST">
            <fieldset>
                <legend>Dados do Funcionário</legend>

                <!-- Campo oculto para ID do funcionário -->
                <input type="hidden" name="idfuncionario" value="<?php echo $id; ?>">

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Funcionário" value="<?php echo $nome; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="data_de_nascimento" class="form-label">Data de Nascimento:</label>
                    <input type="date" class="form-control" id="data_de_nascimento" name="data_de_nascimento" value="<?php echo $data_de_nascimento; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" value="<?php echo $cpf; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="salario" class="form-label">Salário:</label>
                    <input type="text" class="form-control" id="salario" name="salario" placeholder="Salário" value="<?php echo $salario; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone:</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="<?php echo $telefone; ?>" required>
                </div>
            </fieldset>

            <!-- Botão dinâmico para cadastrar ou salvar -->
            <button type="submit" class="btn btn-submit"><?php echo $botao; ?></button>
        </form>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
