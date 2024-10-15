<?php

require_once "../Model/Usuario.php";
require_once "../Conexao/Conexao.php";
require_once "../Excecoes/AutenticarException.php";

class UsuarioController {
    private $db;

    public function __construct() {
        $this->db = Conexao::getConexao(); // Ajuste conforme sua configuração de conexão
    }

    // Função para cadastrar um novo usuário
    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario(
                $_POST['nome_usuario'],
                $_POST['email_usuario'],
                $_POST['cpf_usuario'],
                $_POST['contato_usuario'],
                $_POST['senha_usuario'],
                $_POST['data_nasc_usuario'],
                $_POST['setor_usuario'],
                $_POST['cargo_usuario']
            );
            
            try {
                // Salvar usuário no banco de dados
                $usuario->cadastrar($this->db);

                // Redireciona para a tela de login
                header('Location: ../View/login_usuario.php');
                exit();
            } catch (Exception $e) {
                echo "Erro ao cadastrar usuário: " . $e->getMessage();
            }
        }
    }

    // Função para login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email_usuario'];
            $senha = $_POST['senha_usuario'];

            $usuario = Usuario::login($this->db, $email, $senha);

            if ($usuario) {
                // Iniciar sessão e armazenar dados do usuário logado
                session_start();
                $_SESSION['usuario'] = $usuario;
                header('Location: ../View/dashboard_usuario.php'); // Redireciona para o painel do usuário
                exit();
            } else {
                echo "Credenciais inválidas.";
            }
        }
    }

    // Função para listar os equipamentos alugados pelo usuário
    public function listarEquipamentosAlugados() {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $idUsuario = $_SESSION['usuario']['id_usuario'];
            return Usuario::listarEquipamentosAlugados($this->db, $idUsuario);
        }
        return [];
    }

    public function solicitarAluguel() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $equipamentos = $_POST['id_equipamento']; // Array de IDs dos equipamentos
            $obs = $_POST['obs_aluguel'];
            $data_saida = $_POST['data_saida'];
            $data_devolucao = $_POST['data_devolucao'];
    
            try {
                // Para cada equipamento selecionado, cria uma nova solicitação de aluguel
                foreach ($equipamentos as $id_equipamento) {
                    // Instanciando o aluguel
                    $aluguel = new Aluguel($id_usuario, $id_equipamento, $obs, $data_saida, $data_devolucao);
                    $aluguel->solicitarAluguel($this->db);
                }
    
                // Redireciona ou exibe uma mensagem de sucesso
                header('Location: ../View/dashboard_usuario.php'); // Redirecionar para a página de dashboard do usuário
                exit();
            } catch (Exception $e) {
                echo "Erro ao solicitar aluguel: " . $e->getMessage();
            }
        }
    }
    
}

?>
