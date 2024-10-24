<?php
session_start();
require_once "../Model/Usuario.php";
require_once "../Model/Equipamento.php";
require_once "../Model/Administrador.php";
require_once "AdministradorController.php";
require_once "EquipamentoController.php"; 
require_once "UsuarioController.php"; 
require_once "AluguelController.php"; 

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

$administradorController = new AdministradorController();
$equipamentoController = new EquipamentoController(); 
$usuarioController = new UsuarioController();
$aluguelController = new AluguelController(); 

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

    case "listarSolicitacoes":
        // Chama a função para listar solicitações de aluguel pendentes
        $solicitacoesPendentes = $administradorController->listarSolicitacoesPendentes();
        // Aqui você pode redirecionar para uma view que exibe as solicitações, se necessário
        break;

    case "atualizarStatus":
        // Chama a função para atualizar o status do aluguel
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_aluguel = $_POST['idaluguel'];
            $status = $_POST['status'];
            $id_adm_aluguel = $_SESSION['admin']['id_usuario_administrador ']; // Supondo que você tenha isso na sessão
            $administradorController->atualizarStatusAluguel($id_aluguel, $status, $id_adm_aluguel);
        }
        break;

    // Rotas para Equipamentos
    case "cadEquipamento":
        // Redireciona para o formulário de cadastro de equipamentos (view)
        header('Location: ../View/cadastrar.php');
        break;

    case "salvarEquipamento":
        // Chama a função de salvar do controlador de equipamentos
        $equipamentoController->cadastrar(); // Chama a função "cadastrar" definida no controlador
        break;

    case "listarEquipamentos":
        // Chama a função para listar equipamentos
        $equipamentoController->listar();
        break;

    // Rotas para Usuários
    case "cadUsuario":
        // Redireciona para o formulário de cadastro de usuários (view)
        header('Location: ../View/cad_usuario.php');
        break;

    case "cadastrarUsuario":
        // Chama a função de cadastro do controlador de usuários
        $usuarioController->cadastrar();
        break;

    case "loginUsuario":
        // Redireciona para o formulário de login de usuários (view)
        header('Location: ../View/login_usuario.php');
        break;

    case "logarUsuario":
        // Chama a função de login do controlador de usuários
        $usuarioController->login();
        break;

    // Rotas para Aluguel de Equipamentos
    case "solicitarAluguel":
        // Chama a função para solicitar aluguel de equipamento
        $aluguelController->solicitarAluguel();
        break;

    case "listarAlugados":
        // Chama a função para listar equipamentos alugados pelo usuário
        $equipamentosAlugados = $aluguelController->listarAlugados($_SESSION['usuario']['idusuario']);
        break;

    default:
        echo "Ação não reconhecida.";
        break;
}
?>
