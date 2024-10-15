<!-- views/login_usuario.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
</head>
<body>
    <h1>Login de Usuário</h1>
    <form action="../Controller/rota.php?acao=logarUsuario" method="POST">
        <label for="email_usuario">Email:</label>
        <input type="email" name="email_usuario" id="email_usuario" required>
        
        <label for="senha_usuario">Senha:</label>
        <input type="password" name="senha_usuario" id="senha_usuario" required>
        
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
