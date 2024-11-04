<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login_adm.html');
    exit();
}

// Captura o ID do administrador da sessão
$id_adm = $_SESSION['admin']['id_usuario_administrador']; // Altere conforme sua estrutura de sessão
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Equipamento</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(to right, #e2e2e2, #ffffff);
            color: #333;
        }
        h1 {
            color: #007BFF;
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"],
        textarea {
            width: calc(100% - 24px);
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="number"]:focus {
            border-color: #007BFF;
            outline: none;
        }
        select {
            width: calc(100% - 24px);
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        button {
            background-color: #007BFF;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s, transform 0.2s;
        }
        button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .back-button {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        .back-button:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Cadastrar Equipamento</h1>
    <form action="../Controller/rota.php?acao=salvarEquipamento" method="POST">
        <label for="nome">Nome do Equipamento:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="tipo">Tipo do Equipamento:</label>
        <select id="tipo" name="tipo" required>
            <option value="Desktop">Desktop</option>
            <option value="Periférico">Periférico</option>
            <option value="Notebook">Notebook</option>
            <option value="Outros">Outros</option>
        </select>

        <label for="status">Status do Equipamento:</label>
        <select id="status" name="status" required>
            <option value="Funcional">Funcional</option>
            <option value="Não funcional">Não funcional</option>
        </select>

        <label for="patrimonio">Número de Patrimônio:</label>
        <input type="text" id="patrimonio" name="patrimonio" required>

        <label for="obs">Observações:</label>
        <textarea id="obs" name="obs" rows="4"></textarea>

        <label for="id_adm">ID do Administrador:</label>
        <input type="text" id="id_adm" name="id_adm" value="<?php echo $id_adm; ?>" readonly required>

        <label for="data_entrada">Data de Entrada:</label>
        <input type="date" id="data_entrada" name="data_entrada" required>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" id="quantidade" required min="1">

        <button type="submit">Cadastrar Equipamento</button>
    </form>

    <a class="back-button" href="adm.php">Voltar para o Painel do Administrador</a>
</body>
</html>
