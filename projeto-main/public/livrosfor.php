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
    <style>
        /* Reset Básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilo do Corpo */
        body {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            background: linear-gradient(135deg, #2193b0, #6dd5ed);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Container Principal */
        main {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            max-width: 700px;
            width: 100%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out;
            text-align: center;
        }

        /* Animação de Fade-In */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Título */
        h1 {
            font-size: 2rem;
            color: #2193b0;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        /* Link de Navegação */
        a {
            display: inline-block;
            margin-bottom: 20px;
            color: #6dd5ed;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Formulário */
        form {
            text-align: left;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Fieldset e Legend */
        fieldset {
            border: 2px solid #2193b0;
            border-radius: 8px;
            padding: 20px;
        }

        legend {
            font-size: 1.2rem;
            font-weight: bold;
            color: #6dd5ed;
            padding: 0 10px;
        }

        /* Labels */
        label {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 8px;
        }

        /* Inputs */
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s ease;
            background-color: #f9f9f9;
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        select:focus {
            border-color: #2193b0;
            outline: none;
            box-shadow: 0 0 5px rgba(33, 147, 176, 0.3);
        }

        /* Botões de Rádio */
        input[type="radio"] {
            margin-right: 10px;
            accent-color: #2193b0;
        }

        label[for="sim"],
        label[for="nao"] {
            display: inline-block;
            margin-right: 15px;
        }

        /* Botão de Enviar */
        .btn-submit {
            background: #2193b0;
            color: #fff;
            font-size: 1.1rem;
            font-weight: bold;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            text-align: center;
            width: 100%;
        }

        .btn-submit:hover {
            background: #176f7e;
            transform: translateY(-3px);
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        /* Responsividade */
        @media (max-width: 600px) {
            main {
                padding: 20px;
            }

            h1 {
                font-size: 1.8rem;
            }

            fieldset {
                padding: 15px;
            }

            label {
                font-size: 0.9rem;
            }

            input,
            select {
                font-size: 0.9rem;
            }

            .btn-submit {
                font-size: 1rem;
            }
        }
    </style>
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