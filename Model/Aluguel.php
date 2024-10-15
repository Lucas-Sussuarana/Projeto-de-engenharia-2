<?php

class Aluguel {
    private $idaluguel;
    private $id_usuario;
    private $id_equipamento;
    private $data_saida;
    private $data_devolucao;
    private $obs;
    
    public function __construct($id_usuario, $id_equipamento, $data_saida, $data_devolucao, $obs) {
        $this->id_usuario = $id_usuario;
        $this->id_equipamento = $id_equipamento;
        $this->data_saida = $data_saida;
        $this->data_devolucao = $data_devolucao;
        $this->obs = $obs;
    }


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

    public function salvarAluguel($conn) {
        $sql = "INSERT INTO aluguel (
                    id_usuario_aluguel, 
                    id_adm_aluguel, 
                    id_equip_aluguel, 
                    obs_aluguel, 
                    aluguel_data_saida, 
                    aluguel_data_devolucao
                ) VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
    
        $stmt->bindParam(1, $this->id_usuario);
        $stmt->bindParam(2, $this->id_adm_aluguel);
        $stmt->bindParam(3, $this->id_equipamento);
        $stmt->bindParam(4, $this->obs_aluguel);
        $stmt->bindParam(5, $this->aluguel_data_saida);
        $stmt->bindParam(6, $this->aluguel_data_devolucao);
        $stmt->execute();
    
        $this->idaluguel = $conn->lastInsertId();
    }
    
    
    
        public static function listarAlugueis($conn) {
            $sql = "SELECT * FROM aluguel";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Aluguel');
        }
    
    }
    ?>
    