<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do Administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .cadastro-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .cadastro-container h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="cadastro-container">
        <h2>Cadastro do Administrador</h2>
        <form id="Form" action="../Controller/rota.php?acao=cadastrar" method="POST">
            <div class="form-group">
                <label for="nome_administrador">Nome:</label>
                <input type="text" id="nome_administrador" name="nome_administrador" required>
            </div>
            <div class="form-group">
                <label for="email_administrador">E-mail:</label>
                <input type="email" id="email_administrador" name="email_administrador" required>
            </div>
            <div class="form-group">
                <label for="cpf_administrador">CPF:</label>
                <input type="text" id="cpf_administrador" name="cpf_administrador" maxlength="14" placeholder="000.000.000-00" required>
            </div>
            <div class="form-group">
                <label for="senha_administrador">Senha:</label>
                <input type="password" id="senha_administrador" name="senha_administrador" required>
            </div>
            <div class="form-group">
                <label for="data_nasc_administrador">Data de Nascimento:</label>
                <input type="date" id="data_nasc_administrador" name="data_nasc_administrador" required>
            </div>
            <div class="form-group">
                <label for="contato_administrador">Contato:</label>
                <input type="text" id="contato_administrador" name="contato_administrador" required>
            </div>
            <div class="form-group">
                <label for="cargo_administrador">Cargo:</label>
                <input type="text" id="cargo_administrador" name="cargo_administrador" required>
            </div>
            <div class="form-group">
                <label for="setor_administrador">Setor:</label>
                <input type="text" id="setor_administrador" name="setor_administrador" required>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
<script src="../Js/index.js"></script>
</html>
