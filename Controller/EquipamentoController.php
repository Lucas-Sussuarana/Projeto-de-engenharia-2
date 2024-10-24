<?php

require_once "../Excecoes/AutenticarException.php";
require_once "../Conexao/Conexao.php";
require_once "../Model/Equipamento.php";

class EquipamentoController {
    private $db;

    public function __construct() {
        $this->db = Conexao::getConexao(); // Ajuste conforme seu arquivo de conexão
    }

    // Função para cadastrar um novo equipamento
    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $equipamento = new Equipamento(
                $_POST['nome'],
                $_POST['tipo'],
                $_POST['status'],
                $_POST['patrimonio'],
                $_POST['obs'],
                $_POST['id_adm'],
                $_POST['data_entrada'],
                $_POST['quantidade'] // Adicionando o campo quantidade
            );

            try {
                // Salvar equipamento no banco de dados
                $equipamento->cadastrar($this->db);

                // Redireciona para o painel do administrador
                header('Location: ../View/adm.php');
                exit();
            } catch (Exception $e) {
                echo "Erro ao cadastrar equipamento: " . $e->getMessage();
            }
        }
    }

    // Função para listar equipamentos
    public function listar() {
        return Equipamento::listarEquipamentos($this->db);
    }

    // Função para remover equipamento
    public function remover($id) {
        try {
            Equipamento::remover($this->db, $id);
            header('Location: ../View/adm.php'); // Redireciona após remoção
            exit();
        } catch (Exception $e) {
            echo "Erro ao remover equipamento: " . $e->getMessage();
        }
    }

    // Função para atualizar equipamento
    public function atualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $equipamento = Equipamento::buscarPorId($this->db, $id);
            if ($equipamento) {
                $equipamento->setNome($_POST['nome']);
                $equipamento->setTipo($_POST['tipo']);
                $equipamento->setStatus($_POST['status']);
                $equipamento->setPatrimonio($_POST['patrimonio']);
                $equipamento->setObs($_POST['obs']);
                $equipamento->setIdAdmAlteracao($_POST['id_adm']);
                $equipamento->setDataEntrada($_POST['data_entrada']);
                $equipamento->setQuantidade($_POST['quantidade']); // Adicionando o campo quantidade

                try {
                    $equipamento->atualizar($this->db);
                    header('Location: ../View/adm.php'); // Redireciona após atualização
                    exit();
                } catch (Exception $e) {
                    echo "Erro ao atualizar equipamento: " . $e->getMessage();
                }
            }
        }
    }
}
?>
