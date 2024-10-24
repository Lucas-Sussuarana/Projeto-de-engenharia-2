<?php

class Equipamento {
    private $id;
    private $nome_equipamento;
    private $tipo_equipamento;
    private $status_equipamento;
    private $patrimonio_equipamento;
    private $obs_equipamento;
    private $id_adm_alteracao;
    private $data_entrada;
    private $quantidade; // Adicionando o atributo de quantidade

    public function __construct($nome, $tipo, $status, $patrimonio, $obs, $id_adm, $data_entrada, $quantidade) {
        $this->nome_equipamento = $nome;
        $this->tipo_equipamento = $tipo;
        $this->status_equipamento = $status;
        $this->patrimonio_equipamento = $patrimonio;
        $this->obs_equipamento = $obs;
        $this->id_adm_alteracao = $id_adm;
        $this->data_entrada = $data_entrada;
        $this->quantidade = $quantidade; // Inicializando a quantidade
    }

    // Métodos GET e SET

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome_equipamento;
    }

    public function setNome($nome) {
        $this->nome_equipamento = $nome;
    }

    public function getTipo() {
        return $this->tipo_equipamento;
    }

    public function setTipo($tipo) {
        $this->tipo_equipamento = $tipo;
    }

    public function getStatus() {
        return $this->status_equipamento;
    }

    public function setStatus($status) {
        $this->status_equipamento = $status;
    }

    public function getPatrimonio() {
        return $this->patrimonio_equipamento;
    }

    public function setPatrimonio($patrimonio) {
        $this->patrimonio_equipamento = $patrimonio;
    }

    public function getObs() {
        return $this->obs_equipamento;
    }

    public function setObs($obs) {
        $this->obs_equipamento = $obs;
    }

    public function getIdAdmAlteracao() {
        return $this->id_adm_alteracao;
    }

    public function setIdAdmAlteracao($id_adm) {
        $this->id_adm_alteracao = $id_adm;
    }

    public function getDataEntrada() {
        return $this->data_entrada;
    }

    public function setDataEntrada($data_entrada) {
        $this->data_entrada = $data_entrada;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    // Método para cadastrar equipamento
    public function cadastrar($conn) {
        $sql = "INSERT INTO equipamentos (nome_equipamento, tipo_equipamento, status_equipamento, patrimonio_equipamento, obs_equipamento, id_adm_alteracao, data_entrada, quantidade)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $this->nome_equipamento);
        $stmt->bindParam(2, $this->tipo_equipamento);
        $stmt->bindParam(3, $this->status_equipamento);
        $stmt->bindParam(4, $this->patrimonio_equipamento);
        $stmt->bindParam(5, $this->obs_equipamento);
        $stmt->bindParam(6, $this->id_adm_alteracao);
        $stmt->bindParam(7, $this->data_entrada);
        $stmt->bindParam(8, $this->quantidade); // Adicionando quantidade ao bind
        $stmt->execute();
        $this->id = $conn->lastInsertId();
    }

    // Método para listar equipamentos
    public static function listarEquipamentos($conn) {
        $sql = "SELECT * FROM equipamentos"; 
        $stmt = $conn->query($sql);

        $equipamentos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $equipamento = new Equipamento(
                $row['nome_equipamento'],
                $row['tipo_equipamento'],
                $row['status_equipamento'],
                $row['patrimonio_equipamento'],
                $row['obs_equipamento'],
                $row['id_adm_alteracao'],
                $row['data_entrada'],
                $row['quantidade'] // Adicionando quantidade ao listar
            );
            $equipamentos[] = $equipamento;
        }

        return $equipamentos;
    }

    // Método para buscar equipamento por ID
    public static function buscarPorId($conn, $id) {
        $sql = "SELECT * FROM equipamentos WHERE idequipamentos = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetchObject('Equipamento');
    }

    // Método para atualizar equipamento
    public function atualizar($conn) {
        $sql = "UPDATE equipamentos SET 
                    nome_equipamento = ?, 
                    tipo_equipamento = ?, 
                    status_equipamento = ?, 
                    patrimonio_equipamento = ?, 
                    obs_equipamento = ?, 
                    id_adm_alteracao = ?, 
                    data_entrada = ?, 
                    quantidade = ? 
                WHERE idequipamentos = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $this->nome_equipamento);
        $stmt->bindParam(2, $this->tipo_equipamento);
        $stmt->bindParam(3, $this->status_equipamento);
        $stmt->bindParam(4, $this->patrimonio_equipamento);
        $stmt->bindParam(5, $this->obs_equipamento);
        $stmt->bindParam(6, $this->id_adm_alteracao);
        $stmt->bindParam(7, $this->data_entrada);
        $stmt->bindParam(8, $this->quantidade); // Atualizando quantidade
        $stmt->bindParam(9, $this->id);
        $stmt->execute();
    }

    // Método para remover equipamento
    public static function remover($conn, $id) {
        $sql = "DELETE FROM equipamentos WHERE idequipamentos = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }
}
?>
