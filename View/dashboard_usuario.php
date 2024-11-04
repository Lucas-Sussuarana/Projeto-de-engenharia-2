<?php
require_once "../Conexao/Conexao.php";
require_once "../Controller/EquipamentoController.php";
require_once "../Controller/AluguelController.php";
require_once "../Controller/UsuarioController.php";
session_start();

if (!isset($_SESSION['usuario']['id_USUARIO_COMUM'])) {
    header('Location: login_usuario.php');
    exit();
}

$controller = new UsuarioController();
$alugueis = $controller->listarAlugueisUsuario();

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
        /* Estilos gerais */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f0f2f5;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 900px;
            width: 100%;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #333;
            margin-bottom: 15px;
        }

        /* Estilos para o formulário */
        form {
            display: grid;
            gap: 20px;
            margin-bottom: 30px;
        }
        label {
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            font-size: 16px;
            transition: all 0.3s;
        }
        input:focus,
        select:focus {
            border-color: #007BFF;
            outline: none;
        }

        button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }

        .clear-button {
            background-color: #FF0000;
            color: white;
        }
        .clear-button:hover {
            background-color: #CC0000;
        }

        /* Estilos para tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .msg-success {
            color: #28a745;
            margin-bottom: 20px;
        }
        /* Responsividade */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            table, thead, tbody, th, td, tr {
                display: block;
                width: 100%;
            }
            th, td {
                text-align: right;
            }
            th::before, td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date().toISOString().split("T")[0];
            const dataSaida = document.getElementById("data_saida");
            const dataDevolucao = document.getElementById("data_devolucao");

            dataSaida.setAttribute("min", today);
            
            dataSaida.addEventListener("change", function() {
                dataDevolucao.setAttribute("min", dataSaida.value);
            });

            document.getElementById("clear-form").addEventListener("click", function(event) {
                event.preventDefault();
                document.querySelector("form").reset();
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']['nome_usuario']) ?>!</h1>
        <div style="text-align: right; margin-bottom: 20px;">
            <form action='../Controller/rota.php?acao=logout_usuario' method="post" style="display: inline;">
                <button type="submit" style="background-color: #dc3545; color: white; padding: 10px 20px; font-size: 16px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;">Sair</button>
            </form>
        </div>
        <?php if ($msg): ?>
            <p class="msg-success"><?= htmlspecialchars($msg) ?></p>
        <?php endif; ?>

        <h2>Solicitar Aluguel de Equipamento</h2>

<form id="aluguelForm" action="../Controller/rota.php?acao=solicitarAluguel" method="post">
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

    <label for="quantidade">Quantidade:</label>
    <input type="number" name="quantidade" id="quantidade" min="1" placeholder="Informe a quantidade desejada" required pattern="\d+" inputmode="numeric">

    <label for="obs_aluguel">Observações:</label>
    <input type="text" name="obs_aluguel" id="obs_aluguel" placeholder="Especifique o motivo do aluguel" required>

    <label for="data_saida">Data de Saída:</label>
    <input type="date" name="aluguel_data_saida" id="data_saida" required>

    <label for="data_devolucao">Data de Devolução:</label>
    <input type="date" name="aluguel_data_devolucao" id="data_devolucao" required>

    <button type="submit" onclick="confirmarDevolucao(this.form)">Solicitar Aluguel</button>
    <button type="button" id="clear-form" class="clear-button" onclick="limparCampos()">Limpar Campos</button>
</form>

<script>
    function limparCampos() {
        document.getElementById("aluguelForm").reset();
    }
</script>

        <h2>Seus Equipamentos Alugados</h2>
        
        <label for="items-per-page">Itens por página:</label>
        <select id="items-per-page" onchange="updatePagination(this.value)">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
        </select>

        <table id="alugados-table">
            <thead>
               <tr>
                    <th>Equipamento</th>
                    <th>Data de Saída</th>
                    <th>Data de Devolução</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alugueis as $aluguel): ?>
                    <tr>
                        <td data-label="Equipamento"><?= htmlspecialchars($aluguel['nome_equipamento']) ?></td>
                        <td data-label="Data de Saída"><?= htmlspecialchars($aluguel['aluguel_data_saida']) ?></td>
                        <td data-label="Data de Devolução"><?= htmlspecialchars($aluguel['aluguel_data_devolucao']) ?></td>
                        <td data-label="Status"><?= htmlspecialchars($aluguel['status_aluguel']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
