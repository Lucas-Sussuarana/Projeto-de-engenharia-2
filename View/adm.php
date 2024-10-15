<!-- views/admin_dashboard.php -->
<?php
require_once "../Model/Administrador.php";
require_once "../Controller/EquipamentoController.php"; // Incluindo o controlador de equipamentos
session_start();

if ($_SESSION['admin'] == null) {
    header('Location: login_adm.php'); 
    exit();
}

// Instanciando o controlador de equipamentos
$equipamentoController = new EquipamentoController();

// Listando todos os equipamentos
$equipamentos = $equipamentoController->listar();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1, h2 {
            color: #333;
        }
        button {
            margin: 5px;
            padding: 10px 15px;
            border: none;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Painel do Administrador</h1>

        <!-- Botões para cadastrar -->
        <div>
            <button onclick="window.location.href='../View/cadastrar.php'">Cadastrar Equipamentos</button>
            <button onclick="window.location.href='../View/cad_usuario.php'">Cadastrar Usuários</button>
        </div>

        <h2>Requisições de Aluguel</h2>
        <table>
            <tr>
                <th>ID Usuário</th>
                <th>ID Equipamento</th>
                <th>Observações</th>
                <th>Data de Saída</th>
                <th>Data de Devolução</th>
            </tr>
            <?php if (!empty($alugueis)): ?>
                <?php foreach ($alugueis as $aluguel): ?>
                    <tr>
                        <td><?= htmlspecialchars($aluguel['id_usuario_aluguel']) ?></td>
                        <td><?= htmlspecialchars($aluguel['id_equip_aluguel']) ?></td>
                        <td><?= htmlspecialchars($aluguel['obs_aluguel']) ?></td>
                        <td><?= htmlspecialchars($aluguel['aluguel_data_saida']) ?></td>
                        <td><?= htmlspecialchars($aluguel['aluguel_data_devolucao']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Não há requisições de aluguel no momento.</td>
                </tr>
            <?php endif; ?>
        </table>

        <h2>Lista de Equipamentos</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($equipamentos as $equipamento): ?>
                <tr>
                    <td><?= htmlspecialchars($equipamento->getId()) ?></td>
                    <td><?= htmlspecialchars($equipamento->getNome()) ?></td>
                    <td><?= htmlspecialchars($equipamento->getTipo()) ?></td>
                    <td><?= htmlspecialchars($equipamento->getStatus()) ?></td>
                    <td>
                        <button onclick="window.location.href='../Controller/EquipamentoController.php?acao=atualizar&id=<?= $equipamento->getId() ?>'">Atualizar</button>
                        <button onclick="if(confirm('Tem certeza que deseja remover este equipamento?')) { window.location.href='../Controller/EquipamentoController.php?acao=remover&id=<?= $equipamento->getId() ?>' }">Remover</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
