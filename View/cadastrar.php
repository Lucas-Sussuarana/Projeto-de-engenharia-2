<!-- views/cadastrar_equipamento.php -->
<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login_adm.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Equipamento</title>
</head>
<body>
    <h1>Cadastrar Equipamento</h1>
    <form action="../Controller/rota.php?acao=cadEquipamento" method="POST">
        <label for="nome">Nome do Equipamento:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="tipo">Tipo do Equipamento:</label>
        <input type="text" id="tipo" name="tipo" required><br>

        <label for="status">Status do Equipamento:</label>
        <input type="text" id="status" name="status" required><br>

        <label for="patrimonio">Número de Patrimônio:</label>
        <input type="text" id="patrimonio" name="patrimonio" required><br>

        <label for="obs">Observações:</label>
        <textarea id="obs" name="obs"></textarea><br>

        <label for="id_adm">ID do Administrador:</label>
        <input type="text" id="id_adm" name="id_adm" required><br>

        <label for="data_entrada">Data de Entrada:</label>
        <input type="date" id="data_entrada" name="data_entrada" required><br>


        <button type="submit">Cadastrar Equipamento</button>
    </form>

    <button onclick="window.location.href='adm.php'">Voltar para o Painel do Administrador</button>
</body>
</html>
