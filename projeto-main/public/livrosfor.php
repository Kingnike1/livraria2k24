<?php
require_once "../controle/verificalogado.php";
require_once "../controle/conexao.php"; 

// Verifica se existe um ID de livro na URL (edição de um livro existente)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM livro WHERE idlivro = $id";
    $resultado = mysqli_query($conexao, $sql);

    // Se encontrou o livro, preenche as variáveis com os dados
    if ($linha = mysqli_fetch_array($resultado)) {
        $genero = $linha['genero'];
        $titulo = $linha['titulo'];
        $idioma = $linha['idioma'];
        $data_publi = $linha['data_de_publicacao'];
        $editora_id = $linha['editora_ideditora'];
        $autor_id = $linha['autor_idautor'];
        $disponivel = $linha['disponivel'];
        $botao = "Salvar"; // Botão para editar
    } else {
        $id = 0;
        $genero = '';
        $titulo = '';
        $idioma = '';
        $data_publi = '';
        $editora_id = '';
        $autor_id = '';
        $disponivel = '';
        $botao = "Cadastrar"; // Botão para criar
    }
} else {
    // Caso não tenha ID, cria um novo livro
    $id = 0;
    $genero = '';
    $titulo = '';
    $idioma = '';
    $data_publi = '';
    $editora_id = '';
    $autor_id = '';
    $disponivel = '';
    $botao = "Cadastrar"; // Botão para criar
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do Livro</title>
    <link rel="stylesheet" href="./css/cadastro.css">
</head>
<body>
    <main>
        <h1><?php echo ($id > 0) ? "Editar" : "Cadastrar"; ?> Livro</h1>
        <a href="home.php">Pagina inicial</a>

        <!-- Formulário de Cadastro de Livro -->
        <form action="../controle/livros.php" method="POST" class="form-cadastro">
            <fieldset>
                <legend>Dados do Livro</legend>
                
                <!-- Campo oculto para ID -->
                <input type="hidden" name="idlivro" value="<?php echo $id; ?>">

                <label for="genero">Gênero:</label>
                <input type="text" id="genero" name="genero" value="<?php echo $genero; ?>" required> <br><br>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>" required> <br><br>

                <label for="idioma">Idioma:</label>
                <input type="text" id="idioma" name="idioma" value="<?php echo $idioma; ?>" required> <br><br>

                <label for="data_publi">Data de Publicação:</label>
                <input type="date" id="data_publi" name="data_pu" value="<?php echo $data_publi; ?>" required> <br><br>

                <label for="editora">Editora:</label>
                <select name="editora" id="editora" required>
                    <?php
                    // Consulta para pegar todas as editoras
                    $sql = "SELECT ideditora, nome FROM editora";
                    $resultados = mysqli_query($conexao, $sql);

                    // Preenchendo a dropdown de editoras
                    while ($linha = mysqli_fetch_array($resultados)) {
                        $id_editora = $linha['ideditora'];
                        $nome_editora = $linha['nome'];
                        echo "<option value='$id_editora'" . ($id_editora == $editora_id ? " selected" : "") . ">$nome_editora</option>";
                    }
                    ?>
                </select> <br><br>

                <label for="autor">Autor:</label>
                <select name="autor" id="autor" required>
                    <?php
                    // Consulta para pegar todos os autores
                    $sql = "SELECT idautor, nome FROM autor";
                    $resultados = mysqli_query($conexao, $sql);

                    // Preenchendo a dropdown de autores
                    while ($linha = mysqli_fetch_array($resultados)) {
                        $id_autor = $linha['idautor'];
                        $nome_autor = $linha['nome'];
                        echo "<option value='$id_autor'" . ($id_autor == $autor_id ? " selected" : "") . ">$nome_autor</option>";
                    }
                    ?>
                </select> <br><br>

                <label>Disponível:</label><br>
                <input type="radio" name="disponivel" value="1" <?php echo ($disponivel == '1' ? 'checked' : ''); ?>> Sim <br>
                <input type="radio" name="disponivel" value="0" <?php echo ($disponivel == '0' ? 'checked' : ''); ?>> Não <br><br>

            </fieldset>

            <button type="submit" class="btn-submit"><?php echo $botao; ?></button>
        </form>
    </main>
</body>
</html>
