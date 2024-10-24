<?php
require_once "../Model/Administrador.php";
require_once "../Controller/EquipamentoController.php";
require_once "../Controller/AluguelController.php"; // Incluindo o controlador de aluguel
require_once "../Controller/AdministradorController.php";
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login_adm.php'); 
    exit();
}

$equipamentoController = new EquipamentoController();
$aluguelController = new AluguelController(); // Instanciando o controlador de aluguel

// Listando todos os equipamentos
$equipamentos = $equipamentoController->listar();

// Listando todas as requisições de aluguel pendentes
$solicitacoesPendentes = $aluguelController->listarSolicitacoesPendentes();

// Listando todos os equipamentos emprestados
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

        <h2>Requisições de Aluguel Pendentes</h2>
        <table>
            <tr>
                <th>ID Usuário</th>
                <th>ID Equipamento</th>
                <th>Observações</th>
                <th>Data de Saída</th>
                <th>Data de Devolução</th>
                <th>Status</th>
            </tr>
            <?php if (!empty($solicitacoesPendentes)): ?>
                <?php foreach ($solicitacoesPendentes as $solicitacao): ?>
                    <tr>
                        <td><?= htmlspecialchars($solicitacao['id_usuario_aluguel']) ?></td>
                        <td><?= htmlspecialchars($solicitacao['id_equip_aluguel']) ?></td>
                        <td><?= htmlspecialchars($solicitacao['obs_aluguel']) ?></td>
                        <td><?= htmlspecialchars($solicitacao['aluguel_data_saida']) ?></td>
                        <td><?= htmlspecialchars($solicitacao['aluguel_data_devolucao']) ?></td>
                        <td>
                            <form method="post" action="../Controller/rota.php?acao=atualizarStatus">
                                <input type="hidden" name="idaluguel" value="<?= htmlspecialchars($solicitacao['idaluguel']) ?>">
                                <select name="status">
                                    <option value="aprovado">Aprovar</option>
                                    <option value="recusado">Recusar</option>
                                </select>
                                <button type="submit">Atualizar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
 <td colspan="6">Não há requisições de aluguel no momento.</td>
                </tr>
            <?php endif; ?>
        </table>

        <!-- Tabela de Equipamentos Emprestados -->
        <h2>Equipamentos Emprestados</h2>
        <table>
            <tr>
                <th>ID Equipamento</th>
                <th>Nome do Equipamento</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
            <?php if (!empty($equipamentosEmprestados)): ?>
                <?php foreach ($equipamentosEmprestados as $equipamento): ?>
                    <tr>
                        <td><?= htmlspecialchars($equipamento['id_equipamento']) ?></td>
                        <td><?= htmlspecialchars($equipamento['nome_equipamento']) ?></td>
                        <td><?= htmlspecialchars($equipamento['quantidade']) ?></td>
                        <td>
                            <!-- Botão "Detalhes" que mostra informações adicionais -->
                            <button onclick="mostrarDetalhes(<?= htmlspecialchars(json_encode($equipamento)) ?>)">Detalhes</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Não há equipamentos emprestados no momento.</td>
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

        <script>
            function mostrarDetalhes(equipamento) {
                alert("Solicitante: " + equipamento.solicitante + "\n" +
                      "Tipo de Equipamento: " + equipamento.tipo_equipamento + "\n" +
                      "Quantidade: " + equipamento.quantidade);
            }
        </script>

    </div>
</body>
</html>

Se precisar de mais ajuda ou detalhes, fique à vontade para perguntar!