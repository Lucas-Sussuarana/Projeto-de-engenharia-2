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
    
            // Chama o método login da classe Usuario
            $usuario = Usuario::login($this->db, $email, $senha);
    
            if ($usuario) {
                // Iniciar a sessão e armazenar os dados do usuário logado
                session_start();
                
                // Armazenando os dados do usuário na sessão
                $_SESSION['usuario'] = [
                    'id_USUARIO_COMUM' => $usuario['id_USUARIO_COMUM'],
                    'nome_usuario' => $usuario['nome_usuario'],
                    'email_usuario' => $usuario['email_usuario'],
                ];
    
                // Redireciona para o dashboard do usuário
                header('Location: ../View/dashboard_usuario.php');
                exit();
            } else {
                echo "Credenciais inválidas.";
            }
        }
    }
    
    
    public function listarAlugueisUsuario() {
        
        // Obtém o ID do usuário logado
        $id_usuario = $_SESSION['usuario']['id_USUARIO_COMUM'];

        // Busca os aluguéis do usuário
        $alugueis = Aluguel::listarAlugueisPorUsuario($this->db, $id_usuario);

        return $alugueis;
    }

    public function solicitarAluguel() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_POST['id_USUARIO_COMUM'];
            $equipamentos = $_POST['idequipamento']; // Array de IDs dos equipamentos
            $obs = $_POST['obs_aluguel'];
            $data_saida = $_POST['data_saida'];
            $data_devolucao = $_POST['data_devolucao'];
    
            try {
                // Para cada equipamento selecionado, cria uma nova solicitação de aluguel
                foreach ($equipamentos as $idequipamento) {
                    // Instanciando o aluguel
                    $aluguel = new Aluguel($id_usuario, $idequipamento, $obs, $data_saida, $data_devolucao);
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
