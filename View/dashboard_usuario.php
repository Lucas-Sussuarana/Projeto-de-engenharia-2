<?php
require_once "../Conexao/Conexao.php";
require_once "../Controller/EquipamentoController.php";
require_once "../Controller/AluguelController.php";
require_once "../Controller/UsuarioController.php"; // Inclua o controlador de usuário aqui
session_start();

if (!isset($_SESSION['usuario']['id_USUARIO_COMUM'])) {
    header('Location: login_usuario.php');
    exit();
}

// Controlador de usuário para listar aluguéis
$controller = new UsuarioController();
$alugueis = $controller->listarAlugueisUsuario(); // Listar aluguéis do usuário logado

// Controlador de equipamento para listar os equipamentos disponíveis
$equipamentoController = new EquipamentoController();
$equipamentos = $equipamentoController->listar();

$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Usuário</title>
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
        <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']['nome_usuario']) ?>!</h1>

        <?php if ($msg): ?>
            <p style="color: green;"><?= htmlspecialchars($msg) ?></p>
        <?php endif; ?>

        <h2>Solicitar Aluguel de Equipamento</h2>
        
        <form action="../Controller/rota.php?acao=solicitarAluguel" method="post">
            <input type="hidden" name="id_usuario_aluguel" value="<?= $_SESSION['usuario']['id_USUARIO_COMUM'] ?>">
            
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
        <?php if (!empty($alugueis)): ?>
            <table>
               <tr>
                    <th>Equipamento</th>
                    <th>Data de Saída</th>
                    <th>Data de Devolução</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($alugueis as $aluguel): ?>
                    <tr>
                        <td><?= htmlspecialchars($aluguel['id_equip_aluguel']) ?></td>
                        <td><?= htmlspecialchars($aluguel['aluguel_data_saida']) ?></td>
                        <td><?= htmlspecialchars($aluguel['aluguel_data_devolucao']) ?></td>
                        <td><?= htmlspecialchars($aluguel['status_aluguel']) ?></td> <!-- Exibindo o status do aluguel -->
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Você não possui equipamentos alugados no momento.</p>
        <?php endif; ?>
    </div>
</body>
</html>
