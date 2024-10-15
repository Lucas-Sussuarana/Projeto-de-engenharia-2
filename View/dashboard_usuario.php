<?php
require_once "../Conexao/Conexao.php";
require_once "../Controller/EquipamentoController.php";
require_once "../Controller/AluguelController.php";
session_start();


if (!isset($_SESSION['usuario'])) {
    header('Location: login_usuario.php');
    exit();
}

$equipamentoController = new EquipamentoController();
$aluguelController = new AluguelController();

$equipamentos = $equipamentoController->listar();

$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Usuário</title>
</head>
<body>
    <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']['nome_usuario']) ?>!</h1>

    <?php if ($msg): ?>
        <p style="color: green;"><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>

    <h2>Solicitar Aluguel de Equipamento</h2>
    
    <form action="../Controller/rota.php?acao=solicitarAluguel" method="post">
        <input type="hidden" name="id_usuario_aluguel" value="<?= $_SESSION['usuario']['idusuario'] ?>">
    <label for="equipamento">Selecione o Equipamento:</label>

        <select name="id_equip_aluguel" id="equipamento" required>
            <option value="">Selecione um equipamento</option>
            <?php foreach ($equipamentos as $equipamento): ?>
                <option value="<?= htmlspecialchars($equipamento->getId()) ?>">
                    <?= htmlspecialchars($equipamento->getNome()) ?> - <?= htmlspecialchars($equipamento->getTipo()) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <label for="obs_aluguel">Observações:</label>
        <input type="text" name="obs_aluguel" id="obs_aluguel" placeholder="Especifique o motivo do aluguel" required>
        
        <label for="data_saida">Data de Saída:</label>
        <input type="date" name="aluguel_data_saida" id="data_saida" required>
        
        <label for="data_devolucao">Data de Devolução:</label>
        <input type="date" name="aluguel_data_devolucao" id="data_devolucao" required>
        
        <button type="submit">Solicitar Aluguel</button>
    </form>

    <h2>Seus Equipamentos Alugados</h2>
    <?php if (!empty($equipamentosAlugados)): ?>
        <ul>
            <?php foreach ($equipamentosAlugados as $aluguel): ?>
                <li>
                    Equipamento: <?= htmlspecialchars($aluguel['nome_equipamento']) ?> | 
                    Data de Saída: <?= htmlspecialchars($aluguel['aluguel_data_saida']) ?> | 
                    Data de Devolução: <?= htmlspecialchars($aluguel['aluguel_data_devolucao']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Você não possui equipamentos alugados no momento.</p>
    <?php endif; ?>
</body>
</html>
