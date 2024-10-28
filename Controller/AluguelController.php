<?php
require_once "../Model/Aluguel.php";
require_once "../Conexao/Conexao.php";

class AluguelController {
    private $db;

    public function __construct() {
        $this->db = Conexao::getConexao();
    }

    public function solicitarAluguel() {
        session_start(); // Inicia a sessão se não estiver ativa

        // Verifica se o usuário está logado
        if (!isset($_SESSION['usuario'])) {
            echo "Usuário não logado.";
            return;
        }

        // Obtém o ID do usuário logado
        $id_usuario = $_SESSION['usuario']['id_USUARIO_COMUM'];

        // Verifica se os campos obrigatórios foram enviados
        if (!isset($_POST['id_equip_aluguel']) || !isset($_POST['aluguel_data_devolucao'])) {
            echo "Dados incompletos.";
            return;
        }

        // Atribui os valores dos campos do formulário
        $id_equipamento = $_POST['id_equip_aluguel'];
        $data_devolucao = $_POST['aluguel_data_devolucao'];
        $obs = isset($_POST['obs_aluguel']) ? $_POST['obs_aluguel'] : '';

        // Cria um novo objeto Aluguel e define os valores
        $aluguel = new Aluguel(
            $id_usuario,
            $id_equipamento,
            date('Y-m-d'), // Data de saída
            $data_devolucao,
            $obs
        );

        // Salva a solicitação de aluguel no banco de dados
        try {
            $aluguel->salvar($this->db);
            header("Location: ../View/dashboard_usuario.php"); // Atualize o caminho conforme necessário
            exit(); //
        } catch (Exception $e) {
            echo "Erro ao solicitar aluguel: " . $e->getMessage();
        }
    }
    public function listarSolicitacoesPendentes() {
        return Aluguel::listarSolicitacoesPendentes($this->db);
    }
    public function atualizarStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_aluguel = $_POST['id_aluguel'];
            $status = $_POST['status'];

            try {
                Aluguel::atualizarStatus($this->db, $id_aluguel, $status);
                echo "Status atualizado com sucesso!";
            } catch (Exception $e) {
                echo "Erro ao atualizar o status: " . $e->getMessage();
            }
        }
    }
    
}
