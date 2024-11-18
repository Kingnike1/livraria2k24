<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./css/usuario.css">
</head>
<body>
    <form class="form" action="../controle/salvarusuario.php" method="post">
        <p class="title">Cadastro</p>
        <p class="message">Cadastre-se agora e tenha acesso completo ao nosso aplicativo.</p>
        <div class="flex">
            <label>
                <input class="input" type="text" name="firstname" placeholder="" required>
                <span>Primeiro Nome</span>
            </label>
            <label>
                <input class="input" type="text" name="lastname" placeholder="" required>
                <span>Último Nome</span>
            </label>
        </div>
        <label>
            <input class="input" type="email" name="email" placeholder="" required>
            <span>E-mail</span>
        </label>
        <label>
            <input class="input" type="password" name="senha" placeholder="" required>
            <span>Senha</span>
        </label>
        <label>
            <input class="input" type="password" name="confirma_senha" placeholder="" required>
            <span>Confirmar Senha</span>
        </label>
        <button class="submit" type="submit">Cadastrar</button>
        <p class="signin">Já tem uma conta? <a href="./index.php">Entrar</a></p>
    </form>
</body>
</html>
