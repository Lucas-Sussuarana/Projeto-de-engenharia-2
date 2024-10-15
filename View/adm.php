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
</head>
<body>
    <h1>Painel do Administrador</h1>

    <!-- Botões para cadastrar -->
    <button onclick="window.location.href='../View/cadastrar.php'">Cadastrar Equipamentos</button>
    <button onclick="window.location.href='../View/cad_usuario.php'">Cadastrar Usuários</button>

    <h2>Requisições de Aluguel</h2>
<table border="1">
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

    </div>

    <h2>Lista de Equipamentos</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Status</th>

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


</body>
</html>
