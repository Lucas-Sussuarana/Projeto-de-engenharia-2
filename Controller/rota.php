<?php

require_once "../Model/Administrador.php";
require_once "AdministradorController.php";
require_once "EquipamentoController.php"; // Incluindo o controlador de equipamentos

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

$administradorController = new AdministradorController();
$equipamentoController = new EquipamentoController(); // Instanciando o controlador de equipamentos

switch ($acao) {
    // Rotas para o Administrador
    case "cadastro":
        // Redireciona para o formulário de cadastro (view)
        header('Location: ../View/cad_adm.php');
        break;

    case "cadastrar":
        // Chama a função de cadastro do controlador
        $administradorController->cadastrar();
        break;

    case "login":
        // Redireciona para o formulário de login (view)
        header('Location: ../View/login_adm.php');
        break;

    case "logar":
        // Chama a função de login do controlador
        $administradorController->login();
        break;

    // Rotas para Equipamentos
    case "cadEquipamento":
        // Redireciona para o formulário de cadastro de equipamentos (view)
        $equipamentoController->cadastrar();
        break;

    case "salvarEquipamento":
        // Chama a função de salvar do controlador de equipamentos
        $equipamentoController->salvar();
        break;

    case "listarEquipamentos":
        // Chama a função para listar equipamentos
        $equipamentoController->listar();
        break;

    default:
        echo "Ação não reconhecida.";
        break;
}
?>
