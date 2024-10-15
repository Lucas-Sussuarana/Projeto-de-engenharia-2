<!-- views/cadastro_usuario.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    <form action="../Controller/rota.php?acao=cadastrarUsuario"method="POST">
        <label for="nome_usuario">Nome:</label>
        <input type="text" name="nome_usuario" id="nome_usuario" required>
        
        <label for="email_usuario">Email:</label>
        <input type="email" name="email_usuario" id="email_usuario" required>
        
        <label for="cpf_usuario">CPF:</label>
        <input type="text" name="cpf_usuario" id="cpf_usuario" required>
        
        <label for="contato_usuario">Contato:</label>
        <input type="text" name="contato_usuario" id="contato_usuario" required>
        
        <label for="senha_usuario">Senha:</label>
        <input type="password" name="senha_usuario" id="senha_usuario" required>
        
        <label for="data_nasc_usuario">Data de Nascimento:</label>
        <input type="date" name="data_nasc_usuario" id="data_nasc_usuario" required>
        
        <label for="setor_usuario">Setor:</label>
        <input type="text" name="setor_usuario" id="setor_usuario" required>
        
        <label for="cargo_usuario">Cargo:</label>
        <input type="text" name="cargo_usuario" id="cargo_usuario" required>
        
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
