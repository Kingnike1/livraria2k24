<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Livros</title>
    <!-- Link para o Bootstrap (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJRBCkT9q9zYq1zN4r5drKK9lfkVVVhxRZoOPjcjqwSoPQcklmPknDL3ESzM" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilo.css">
</head>

<body>
    <div class="container my-4">
        <h1 class="text-center text-primary mb-4">Lista de Livros</h1>

        <div class="mb-3">
            <a href="home.php" class="btn btn-secondary">Página Inicial</a>
        </div>

        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Gênero</th>
                    <th>Título</th>
                    <th>Disponível</th>
                    <th>Idioma</th>
                    <th>Data de Publicação</th>
                    <th>Autor</th>
                    <th>Editora</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "../controle/conexao.php";
                $campo = 'idlivro';
                $tabela = 'livro';
                $loc = 'livrosql.php';

                // Consulta SQL para obter os livros
                $sql = "SELECT 
                            livro.idlivro, livro.titulo, livro.genero, livro.idioma, livro.data_de_publicacao, livro.disponivel, 
                            editora.nome AS editora_nome, 
                            autor.nome AS autor_nome
                        FROM livro
                        JOIN editora ON livro.editora_ideditora = editora.ideditora
                        JOIN autor ON livro.autor_idautor = autor.idautor";

                $resultados = mysqli_query($conexao, $sql);

                while ($linha = mysqli_fetch_array($resultados)) {
                    $idlivro = $linha['idlivro'];
                    $titulo = $linha['titulo'];
                    $genero = $linha['genero'];
                    $idioma = $linha['idioma'];
                    $data_publicacao = $linha['data_de_publicacao'];
                    $disponivel = $linha['disponivel'];
                    $editora_nome = $linha['editora_nome']; // Nome da editora
                    $autor_nome = $linha['autor_nome']; // Nome do autor

                    echo "<tr>";
                    echo "<td>{$idlivro}</td>";
                    echo "<td>{$titulo}</td>";
                    echo "<td>{$genero}</td>";
                    echo "<td>{$idioma}</td>";
                    echo "<td>{$data_publicacao}</td>";
                    echo "<td>{$disponivel}</td>";
                    echo "<td>{$editora_nome}</td>";
                    echo "<td>{$autor_nome}</td>";
                    echo "<td>
             <a href='../controle/deletar.php?id={$idlivro}&campo={$campo}&tabela={$tabela}&loc={$loc}' class='btn btn-danger btn-sm'>Deletar</a>
         </td>";
                    echo "<td>
             <a href='livrosfor.php?id={$linha['idlivro']}' class='btn btn-warning btn-sm'>Editar</a>
         </td>";
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>

    <!-- Link do Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-TfX0JP2Uom6MIyZ4mGs2kjyR8RR5+9MwXwJXZ7hmltX5b4kb4D7TZB+5di9gU8Qm" crossorigin="anonymous"></script>
</body>

</html>