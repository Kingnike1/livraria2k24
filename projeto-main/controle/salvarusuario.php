<?php
// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];

    // Verifica se as senhas coincidem
    if ($senha !== $confirma_senha) {
        die("As senhas não coincidem!");
    }

    // Criptografa a senha
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    // Conecta ao banco de dados
    require_once "./conexao.php";

    // Lógica de inserção
    $sql = "INSERT INTO usuario (email, senha) 
            VALUES ('$email', '$senha_criptografada')";

    // Executa a query
    if (mysqli_query($conexao, $sql)) {
        // Redireciona para a página de login após o cadastro
        header("Location: ../public/home.php");
    } else {
        // Exibe uma mensagem de erro caso a execução falhe
        echo "Erro: " . mysqli_error($conexao);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
}
?>
