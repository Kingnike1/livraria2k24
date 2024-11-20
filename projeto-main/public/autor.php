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
     <link rel="stylesheet" href="./css/cadastro.css">
</head>

<body>
    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php"><i class="fas fa-home"></i> Página Inicial</a>
        </div>
    </nav>

    <div class="container">
    <h1><?php echo ($id > 0) ? "Editar" : "Cadastrar"; ?> Autor</h1>
    <form action="../controle/autor.php" method="POST">
        <input type="hidden" name="idautor" value="<?php echo $id; ?>">

        <div class="mb-4">
            <label for="nome" class="form-label">Nome do Autor:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $nome; ?>" required>
        </div>

        <div class="mb-4">
            <label for="nacionalidade" class="form-label">Nacionalidade:</label>
            <input type="text" id="nacionalidade" name="nacionalidade" class="form-control" value="<?php echo $nacionalidade; ?>" required>
        </div>

        <div class="mb-4">
            <label for="data_de_nascimento" class="form-label">Data de Nascimento:</label>
            <input type="date" id="data_de_nascimento" name="data_de_nascimento" class="form-control" value="<?php echo $data_de_nascimento; ?>" required>
        </div>

        <button type="submit" class="btn">
            <i class="fas fa-save"></i> <?php echo $botao; ?>
        </button>
    </form>
</div>


    <!-- Incluindo o script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
