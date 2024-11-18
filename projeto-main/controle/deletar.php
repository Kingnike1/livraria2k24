<?php
require_once "./conexao.php";

// Verifica se os parâmetros necessários foram passados pela URL
if (isset($_GET['tabela'], $_GET['campo'], $_GET['loc'], $_GET['id'])) {
    $tabela =  $_GET['tabela'];
    $campo =  $_GET['campo'];
    $loc =  $_GET['loc'];
    $id = (int) $_GET['id']; // Garantir que $id seja um inteiro

    // Prepara a consulta de deletação
    $sql = "DELETE FROM $tabela WHERE $campo = $id";

    // Executa a consulta
    if (mysqli_query($conexao, $sql)) {
        // Se a deleção for bem-sucedida, redireciona para a página de listagem
        header("Location: ../public/$loc");
    } else {
        // Caso ocorra um erro, pode-se redirecionar para uma página de erro ou exibir uma mensagem
        echo "Erro ao excluir o registro.";
    }
} else {
    // Se os parâmetros não foram passados corretamente, redireciona para a página de listagem
    header("Location: ../public/$loc");
}

mysqli_close($conexao); // Fechar a conexão com o banco de dados
?>
