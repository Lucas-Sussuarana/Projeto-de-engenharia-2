<?php

class Aluguel {
    private $idaluguel;
    private $id_usuario;
    private $id_equipamento;
    private $data_saida;
    private $data_devolucao;
    private $obs;
    private $status; // Novo campo para status (aprovado/recusado)

    public function __construct($id_usuario, $id_equipamento, $data_saida, $data_devolucao, $obs) {
        $this->id_usuario = $id_usuario;
        $this->id_equipamento = $id_equipamento;
        $this->data_saida = $data_saida;
        $this->data_devolucao = $data_devolucao;
        $this->obs = $obs;
        $this->status = 'pendente'; // Definir como pendente inicialmente
    }

    // Getters e setters
    public function getIdAluguel() {
        return $this->idaluguel;
    }

    public function setIdAluguel($idaluguel) {
        $this->idaluguel = $idaluguel;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getIdEquipamento() {
        return $this->id_equipamento;
    }

    public function setIdEquipamento($id_equipamento) {
        $this->id_equipamento = $id_equipamento;
    }

    public function getDataSaida() {
        return $this->data_saida;
    }

    public function setDataSaida($data_saida) {
        $this->data_saida = $data_saida;
    }

    public function getDataDevolucao() {
        return $this->data_devolucao;
    }

    public function setDataDevolucao($data_devolucao) {
        $this->data_devolucao = $data_devolucao;
    }

    public function getObs() {
        return $this->obs;
    }

    public function setObs($obs) {
        $this->obs = $obs;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    // Método para salvar aluguel no banco de dados
    public function salvar($conn) {
        $sql = "INSERT INTO aluguel (
                    id_usuario_aluguel, 
                    id_equip_aluguel, 
                    obs_aluguel, 
                    aluguel_data_saida, 
                    aluguel_data_devolucao,
                    status_aluguel
                ) VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $this->id_usuario);
        $stmt->bindParam(2, $this->id_equipamento);
        $stmt->bindParam(3, $this->obs);
        $stmt->bindParam(4, $this->data_saida);
        $stmt->bindParam(5, $this->data_devolucao);
        $stmt->bindParam(6, $this->status); // O status é "pendente" inicialmente
        $stmt->execute();
    
        $this->idaluguel = $conn->lastInsertId();
    }

    // Método para listar todas as solicitações de aluguel
    public static function listarAlugueis($conn) {
        $sql = "SELECT * FROM aluguel";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Aluguel');
    }

    // Método para listar apenas as solicitações pendentes
    public static function listarSolicitacoesPendentes($conn) {
        $sql = "SELECT * FROM aluguel WHERE status_aluguel = 'pendente'";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para atualizar o status de uma solicitação de aluguel
    public static function atualizarStatus($conn, $id_aluguel, $novo_status) {
        $sql = "UPDATE aluguel SET status_aluguel = ? WHERE idaluguel = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $novo_status);
        $stmt->bindParam(2, $id_aluguel);
        $stmt->execute();
    }

    // Método para listar todos os alugueis de um usuário específico
    public static function listarAlugueisPorUsuario($conn, $id_usuario) {
        $sql = "SELECT * FROM aluguel WHERE id_usuario_aluguel = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id_usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Novo método: listar equipamentos emprestados (com detalhes do solicitante e equipamento)
    public static function listarEquipamentosEmprestados($conn) {
        $sql = "
            SELECT * FROM aluguel WHERE status_aluguel = 'aprovado';
";
        
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
