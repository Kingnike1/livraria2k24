<?php
require_once "../controle/verificalogado.php";
require_once "../controle/conexao.php"; // Conexão com o banco de dados

// Verifica se existe um ID passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cliente WHERE idcliente = $id";
    $resultado = mysqli_query($conexao, $sql);

    // Se encontrou o cliente, preenche as variáveis com os dados
    if ($linha = mysqli_fetch_array($resultado)) {
        $nome = $linha['nome'];
        $cpf = $linha['cpf'];
        $telefone = $linha['telefone'];
        $data_de_nascimento = $linha['data_de_nascimento'];
        $botao = "Salvar";
    } else {
        $id = 0;
        $nome = '';
        $cpf = '';
        $telefone = '';
        $data_de_nascimento = '';
        $botao = "Cadastrar";
    }
} else {
    $id = 0;
    $nome = '';
    $cpf = '';
    $telefone = '';
    $data_de_nascimento = '';
    $botao = "Cadastrar";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do Cliente</title>
    <!-- Incluindo o link do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluindo o Font Awesome para ícones -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Estilos adicionais para bordas e animações -->
    <style>
        .navbar {
            border-bottom: 3px solid #007bff;
        }

        .form-control {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
        }

        .btn {
            border-radius: 25px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        h1 {
            color: #007bff;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .btn-submit {
            background-color: #007bff;
            color: white;
            border-radius: 25px;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .form-cadastro fieldset {
            border: none;
            margin-bottom: 15px;
        }

        .form-cadastro legend {
            font-weight: bold;
            color: #007bff;
            font-size: 1.2rem;
        }

        .form-cadastro input {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php"><i class="fas fa-home"></i> Página Inicial</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center"><?php echo ($id > 0) ? "Editar" : "Cadastrar"; ?> Cliente</h1>
        <!-- Formulário sem o ID na URL -->
        <form action="../controle/cliente.php" method="POST" class="form-cadastro">
            <fieldset>
                <legend>Dados do Cliente</legend>
                <!-- Campo oculto para ID -->
                <input type="hidden" name="idcliente" value="<?php echo $id; ?>">

                <!-- Campo de Nome -->
                <div class="mb-3">
                    <label for="nome" class="form-label" title="Informe o nome completo do cliente">Nome do Cliente:</label>
                    <input type="text" id="nome" name="nome" placeholder="Nome" class="form-control" value="<?php echo $nome; ?>"
                        title="Digite o nome completo do cliente" required>
                </div>

                <!-- Campo de Data de Nascimento -->
                <div class="mb-3">
                    <label for="data_de_nascimento" class="form-label" title="Informe a data de nascimento do cliente">Data de Nascimento:</label>
                    <input type="date" id="data_de_nascimento" name="data_de_nascimento" class="form-control"
                        value="<?php echo $data_de_nascimento; ?>"
                        title="Digite a data de nascimento no formato dia/mês/ano" required>
                </div>

                <!-- Campo de CPF -->
                <div class="mb-3">
                    <label for="cpf" class="form-label" title="Informe o CPF do cliente">CPF:</label>
                    <input type="text" id="cpf" name="cpf" placeholder="CPF" class="form-control" value="<?php echo $cpf; ?>"
                        title="Digite o CPF no formato XXX.XXX.XXX-XX" required>
                </div>

                <!-- Campo de Telefone -->
                <div class="mb-3">
                    <label for="telefone" class="form-label" title="Informe o telefone do cliente">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" placeholder="Telefone" class="form-control"
                        value="<?php echo $telefone; ?>"
                        title="Digite o telefone no formato (DDD) 9XXXX-XXXX" required>
                </div>
            </fieldset>

            <!-- Botão de Submit -->
            <button type="submit" class="btn-submit btn-lg"
                title="Clique para salvar os dados do cliente">
                <i class="fas fa-save"></i> <?php echo $botao; ?>
            </button>
        </form>

    </div>

    <!-- Incluindo o script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>