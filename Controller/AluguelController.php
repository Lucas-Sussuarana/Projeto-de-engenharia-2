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

        // Verifique se o usuário está logado
        if (!isset($_SESSION['usuario'])) {
            echo "Usuário não logado.";
            return;
        }

        $id_usuario = $_SESSION['usuario'];

        if (!isset($_POST['id_equipamento']) || !isset($_POST['data_devolucao'])) {
            echo "Dados incompletos.";
            return;
        }
        $id_equipamento = $_POST['id_equipamento'];
        $data_devolucao = $_POST['data_devolucao'];
        $obs = isset($_POST['obs']) ? $_POST['obs'] : '';

        $aluguel = new Aluguel();
        $aluguel->setId_usuario($id_usuario);
        $aluguel->setId_equipamento($id_equipamento);
        $aluguel->setAluguel_data_saida(date('Y-m-d')); // Data de saída atual
        $aluguel->setAluguel_data_devolucao($data_devolucao);
        $aluguel->setObs_aluguel($obs);

        $aluguel->salvarAluguel($this->db);

        echo "Aluguel solicitado com sucesso!";
    }

    
}
