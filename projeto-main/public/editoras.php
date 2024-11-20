<?php
require_once "../controle/verificalogado.php";
require_once "../controle/conexao.php"; // Conexão com o banco de dados

// Verifica se existe um ID de editora na URL (edição de uma editora existente)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM editora WHERE ideditora = $id";
    $resultado = mysqli_query($conexao, $sql);

    // Se encontrou a editora, preenche as variáveis com os dados
    if ($linha = mysqli_fetch_array($resultado)) {
        $nome = $linha['nome'];
        $localidade = $linha['localidade'];
        $botao = "Salvar"; // Botão para editar
    } else {
        $id = 0;
        $nome = '';
        $localidade = '';
        $botao = "Cadastrar"; // Botão para criar
    }
} else {
    // Caso não tenha ID, cria uma nova editora
    $id = 0;
    $nome = '';
    $localidade = '';
    $botao = "Cadastrar"; // Botão para criar
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro da Editora</title>
    <!-- Link do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluindo o Font Awesome para ícones -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/cadastro.css">

</head>
<body>
    <div class="container mt-4">
        <a href="home.php" class="btn-back"><i class="fas fa-home"></i> Página inicial</a>
        
        <h1><?php echo ($id > 0) ? "Editar" : "Cadastrar"; ?> Editora</h1>

        <!-- Formulário para cadastrar ou editar a editora -->
        <form action="../controle/editora.php" method="POST">
            <!-- Campo oculto para ID da editora -->
            <input type="hidden" name="ideditora" value="<?php echo $id; ?>">

            <!-- Campo de nome da editora -->
            <div class="form-group mb-3">
                <label for="nome_ed">Nome da Editora:</label>
                <input type="text" id="nome_ed" name="nome_ed" class="form-control" placeholder="Nome da editora" value="<?php echo $nome; ?>" required>
            </div>

            <!-- Campo de localidade -->
            <div class="form-group mb-3">
                <label for="loc_ed">Localidade da Empresa:</label>
                <input type="text" id="loc_ed" name="loc_ed" class="form-control" placeholder="Localidade da empresa" value="<?php echo $localidade; ?>" required>
            </div>

            <!-- Botão de envio -->
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> <?php echo $botao; ?>
            </button>
        </form>
    </div>

    <!-- Scripts do Bootstrap e Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
