<?php
require_once "../controle/verificalogado.php";
require_once "../controle/conexao.php"; // Conexão com o banco de dados

// Verifica se existe um ID de autor na URL (edição de um autor existente)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM autor WHERE idautor = $id";
    $resultado = mysqli_query($conexao, $sql);

    // Se encontrou o autor, preenche as variáveis com os dados
    if ($linha = mysqli_fetch_array($resultado)) {
        $nome = $linha['nome'];
        $nacionalidade = $linha['nacionalidade'];
        $data_de_nascimento = $linha['data_de_nascimento'];
        $botao = "Salvar"; // Botão para editar
    } else {
        $id = 0;
        $nome = '';
        $nacionalidade = '';
        $data_de_nascimento = '';
        $botao = "Cadastrar"; // Botão para criar
    }
} else {
    // Caso não tenha ID, cria um novo autor
    $id = 0;
    $nome = '';
    $nacionalidade = '';
    $data_de_nascimento = '';
    $botao = "Cadastrar"; // Botão para criar
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do Autor</title>
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
        <h1 class="text-center"><?php echo ($id > 0) ? "Editar" : "Cadastrar"; ?> Autor</h1>
        <form action="../controle/autor.php" method="POST">
            <!-- Campo oculto para ID do autor -->
            <input type="hidden" name="idautor" value="<?php echo $id; ?>">

            <!-- Campo de Nome do Autor -->
            <div class="mb-4">
                <label for="nome" class="form-label">Nome do Autor:</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $nome; ?>" required>
            </div>

            <!-- Campo de Nacionalidade -->
            <div class="mb-4">
                <label for="nacionalidade" class="form-label">Nacionalidade:</label>
                <input type="text" id="nacionalidade" name="nacionalidade" class="form-control" value="<?php echo $nacionalidade; ?>" required>
            </div>

            <!-- Campo de Data de Nascimento -->
            <div class="mb-4">
                <label for="data_de_nascimento" class="form-label">Data de Nascimento:</label>
                <input type="date" id="data_de_nascimento" name="data_de_nascimento" class="form-control" value="<?php echo $data_de_nascimento; ?>" required>
            </div>

            <!-- Botão de Submit -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> <?php echo $botao; ?>
                </button>
            </div>
        </form>
    </div>

    <!-- Incluindo o script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
