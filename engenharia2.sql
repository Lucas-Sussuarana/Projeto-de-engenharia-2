-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/10/2024 às 04:19
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `engenharia2`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluguel`
--

CREATE TABLE `aluguel` (
  `idaluguel` int(11) NOT NULL,
  `id_usuario_aluguel` int(11) NOT NULL,
  `id_adm_aluguel` int(11) DEFAULT NULL,
  `id_equip_aluguel` int(11) NOT NULL,
  `obs_aluguel` varchar(45) NOT NULL,
  `aluguel_data_saida` date NOT NULL,
  `aluguel_data_devolucao` date NOT NULL,
  `status_aluguel` varchar(45) DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluguel`
--

INSERT INTO `aluguel` (`idaluguel`, `id_usuario_aluguel`, `id_adm_aluguel`, `id_equip_aluguel`, `obs_aluguel`, `aluguel_data_saida`, `aluguel_data_devolucao`, `status_aluguel`) VALUES
(16, 40, NULL, 0, 'quebrou', '2024-10-23', '2024-10-23', 'aprovado'),
(17, 40, NULL, 0, 'quebrou', '2024-10-23', '2024-10-21', 'pendente'),
(18, 40, NULL, 0, 'quebrou', '2024-10-23', '2024-10-23', 'aprovado'),
(19, 40, NULL, 0, 'quebrou', '2024-10-23', '2024-10-29', 'pendente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `idequipamento` int(11) NOT NULL,
  `nome_equipamento` varchar(45) NOT NULL,
  `tipo_equipamento` varchar(45) NOT NULL,
  `status_equipamento` tinyint(4) NOT NULL,
  `patrimonio_equipamento` varchar(45) NOT NULL,
  `obs_equipamento` varchar(45) NOT NULL,
  `id_adm_alteracao` int(11) NOT NULL,
  `data_entrada` date NOT NULL,
  `data_saida` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `equipamentos`
--

INSERT INTO `equipamentos` (`idequipamento`, `nome_equipamento`, `tipo_equipamento`, `status_equipamento`, `patrimonio_equipamento`, `obs_equipamento`, `id_adm_alteracao`, `data_entrada`, `data_saida`) VALUES
(21, 'monitor', 'computador', 0, '656565', 'ok', 1, '2024-09-30', '2024-09-30'),
(22, 'monitor', 'computador', 0, '656565', 'ok', 1, '2024-09-30', '2024-09-30'),
(23, 'monitor', 'computador', 0, '656565', 'ok', 1, '2024-09-30', '2024-09-30'),
(24, 'monitor', 'computador', 0, '656565', 'ok', 1, '2024-09-30', '2024-09-30'),
(25, 'monitor', 'computador', 0, '656565', 'ok', 1, '2024-09-30', '2024-09-30'),
(26, 'teclado', 'computador', 0, '656565', 'esta funcional', 1, '2024-09-30', '2024-09-30'),
(27, 'teclado', 'computador', 0, '656565', 'ok', 1, '2024-10-01', '2024-10-02'),
(28, 'mouse', 'computador', 0, '656564', 'ok', 1, '2024-10-15', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario_administrador`
--

CREATE TABLE `usuario_administrador` (
  `id_usuario_administrador` int(11) NOT NULL,
  `nome_administrador` varchar(45) NOT NULL,
  `email_administrador` varchar(45) NOT NULL,
  `cpf_administrador` varchar(45) NOT NULL,
  `senha_administrador` varchar(256) NOT NULL,
  `data_nasc_administrador` date NOT NULL,
  `contato_administrador` varchar(45) NOT NULL,
  `cargo_administrador` varchar(45) NOT NULL,
  `setor_administrador` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario_administrador`
--

INSERT INTO `usuario_administrador` (`id_usuario_administrador`, `nome_administrador`, `email_administrador`, `cpf_administrador`, `senha_administrador`, `data_nasc_administrador`, `contato_administrador`, `cargo_administrador`, `setor_administrador`) VALUES
(1, 'Ana Silva', 'ana.silva@email.com', '211.111.111-11', 'senha321', '1985-06-11', '(11) 99999-2222', 'Gerente', 'TI'),
(2, 'Bruno Souza', 'bruno.souza@email.com', '222.333.222-22', 'senha321', '1990-03-16', '(11) 98888-3333', 'Supervisor', 'Recursos Humanos'),
(3, 'Carla Silva', 'carla.silva@email.com', '333.444.333-33', 'senha321', '1982-12-21', '(11) 97777-4444', 'Coordenadora', 'Administração'),
(4, 'Diego Mendes', 'diego.mendes@email.com', '444.555.444-44', 'senha321', '1994-08-09', '(11) 96666-5555', 'Líder de Equipe', 'Servicos gerais'),
(5, 'Elisa Costa', 'elisa.costa@email.com', '555.666.555-55', 'senha321', '1989-11-26', '(11) 95555-6666', 'Diretora', 'TI'),
(6, 'brendo', '123@gmail.com', '12345678912', '$2y$10$sfWhQ/pyqZaVVfuP10bnQ.34d1ci4OyQHH5ImT', '2024-09-30', '68991615105210', 'Gerente', 'TI'),
(7, 'brendo', '321@gmail.com', '12345678912', '$2y$10$gPSYOsm9zeDkOjxckrkduuy/cVqnh58HB9enWV', '2024-09-30', '68991615105210', 'Gerente', 'TI'),
(8, 'brendo', '321@gmail.com', '12345678912', '$2y$10$RkoCqud/gBS9SIgOy7Dh7uKkfdrBoNyNPcgkJ.Be25Q60pSmPWpTW', '2024-09-30', '68991615105210', 'Gerente', 'TI'),
(9, 'brendos', 'abc@gmail.com', '12345678912', '$2y$10$7TdGjU40Tee0Nu9WN4V.sui8Pjxf11/RNZDmh0EW88Xkz8vQ4Y5P6', '2024-09-30', '68991615105210', 'Gerente', 'TI'),
(10, 'brendos', 'abc@gmail.com', '12345678912', '$2y$10$gEiWmV7ETp72RqYba1A8D.cVdjDrjDgASWi.TaBPDdrLH5LgeZ9om', '2024-09-30', '68991615105210', 'Gerente', 'TI'),
(11, 'teste', 'teste@gmail.com', '061.174.482-10', '$2y$10$ka0zwXF7BiwJUKD6cIv6KezqKAIcg6PQK8JUig24/7ePQJJLXyosm', '2024-10-02', '(55) 55555-5555', 'teste', 'teste'),
(12, 'LUCASBAITOLA', 'LUCAS@gmail.com', '183.072.802-49', '$2y$10$quZaay7M0Cipax8NL5AhjuxCY9tCWAVy6Rw5zX.PopqPKDuvSL.ea', '2024-10-01', '(55) 55555-5555', 'faxineiro', 'rh'),
(13, 'teste', 'teste1@gmail.com', '613.122.255-05', '$2y$10$eYZoxziAqcruHL7OVGzm8uvBfvmTO.DmvtmiWVrU.Ij95Ak47hPrC', '2024-10-09', '(68) 99161-5105', 'Gerente', 'TI');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario_comum`
--

CREATE TABLE `usuario_comum` (
  `id_USUARIO_COMUM` int(11) NOT NULL,
  `nome_usuario` varchar(45) NOT NULL,
  `email_usuario` varchar(45) NOT NULL,
  `cpf_usuario` varchar(45) NOT NULL,
  `contato_usuario` varchar(45) NOT NULL,
  `senha_usuario` varchar(256) NOT NULL,
  `data_nasc_usuario` date NOT NULL,
  `setor_usuario` varchar(45) NOT NULL,
  `cargo_usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario_comum`
--

INSERT INTO `usuario_comum` (`id_USUARIO_COMUM`, `nome_usuario`, `email_usuario`, `cpf_usuario`, `contato_usuario`, `senha_usuario`, `data_nasc_usuario`, `setor_usuario`, `cargo_usuario`) VALUES
(1, 'Ana Souza', 'ana.souza@email.com', '111.111.111-11', '(11) 99999-1111', 'senha123', '1985-06-10', 'TI', 'Assistente'),
(2, 'Bruno Lima', 'bruno.lima@email.com', '222.222.222-22', '(11) 98888-2222', 'senha123', '1990-03-15', 'Recursos Humanos', 'Técnico Administrativo'),
(3, 'Carla Mendes', 'carla.mendes@email.com', '333.333.333-33', '(11) 97777-3333', 'senha123', '1982-12-20', 'Administração', 'Assistente'),
(4, 'Diego Costa', 'diego.costa@email.com', '444.444.444-44', '(11) 96666-4444', 'senha123', '1994-08-08', 'Servicos gerais', 'Assistente'),
(5, 'Elisa Martins', 'elisa.martins@email.com', '555.555.555-55', '(11) 95555-5555', 'senha123', '1989-11-25', 'TI', 'Suporte'),
(6, 'Fábio Oliveira', 'fabio.oliveira@email.com', '666.666.666-66', '(11) 94444-6666', 'senha123', '1995-02-19', 'Recursos Humanos', 'Gerente'),
(7, 'Gabriela Freitas', 'gabriela.freitas@email.com', '777.777.777-77', '(11) 93333-7777', 'senha123', '1987-09-12', 'Administração', 'Técnico Administrativo'),
(8, 'Henrique Silva', 'henrique.silva@email.com', '888.888.888-88', '(11) 92222-8888', 'senha123', '1993-07-14', 'Servicos gerais', 'Suporte'),
(9, 'Isabela Santos', 'isabela.santos@email.com', '999.999.999-99', '(11) 91111-9999', 'senha123', '1984-01-30', 'TI', 'Assistente'),
(10, 'João Ribeiro', 'joao.ribeiro@email.com', '101.101.101-01', '(11) 91010-1010', 'senha123', '1991-06-05', 'Recursos Humanos', 'Gerente'),
(11, 'Karina Lopes', 'karina.lopes@email.com', '202.202.202-02', '(11) 92020-2020', 'senha123', '1983-10-21', 'Administração', 'Técnico Administrativo'),
(12, 'Lucas Ferreira', 'lucas.ferreira@email.com', '303.303.303-03', '(11) 93030-3030', 'senha123', '1996-04-18', 'Servicos gerais', 'Suporte'),
(13, 'Mariana Gomes', 'mariana.gomes@email.com', '404.404.404-04', '(11) 94040-4040', 'senha123', '1992-03-07', 'TI', 'Assistente'),
(14, 'Nicolas Rocha', 'nicolas.rocha@email.com', '505.505.505-05', '(11) 95050-5050', 'senha123', '1990-12-16', 'Recursos Humanos', 'Gerente'),
(15, 'Olivia Almeida', 'olivia.almeida@email.com', '606.606.606-06', '(11) 96060-6060', 'senha123', '1988-02-22', 'Administração', 'Técnico Administrativo'),
(16, 'Pedro Cardoso', 'pedro.cardoso@email.com', '707.707.707-07', '(11) 97070-7070', 'senha123', '1986-11-04', 'Servicos gerais', 'Suporte'),
(17, 'Quenia Castro', 'quenia.castro@email.com', '808.808.808-08', '(11) 98080-8080', 'senha123', '1991-05-25', 'TI', 'Assistente'),
(18, 'Rafael Cunha', 'rafael.cunha@email.com', '909.909.909-09', '(11) 99090-9090', 'senha123', '1994-08-30', 'Recursos Humanos', 'Gerente'),
(19, 'Sofia Araújo', 'sofia.araujo@email.com', '010.010.010-10', '(11) 91010-0101', 'senha123', '1993-09-13', 'Administração', 'Técnico Administrativo'),
(20, 'Thiago Barros', 'thiago.barros@email.com', '111.111.111-12', '(11) 91111-0111', 'senha123', '1997-12-06', 'Servicos gerais', 'Suporte'),
(21, 'Ursula Rezende', 'ursula.rezende@email.com', '121.121.121-13', '(11) 92121-0121', 'senha123', '1987-07-21', 'TI', 'Assistente'),
(22, 'Vinícius Ramos', 'vinicius.ramos@email.com', '131.131.131-14', '(11) 93131-0131', 'senha123', '1992-10-18', 'Recursos Humanos', 'Gerente'),
(23, 'Wagner Santana', 'wagner.santana@email.com', '141.141.141-15', '(11) 94141-0141', 'senha123', '1996-04-26', 'Administração', 'Técnico Administrativo'),
(24, 'Xênia Assis', 'xenia.assis@email.com', '151.151.151-16', '(11) 95151-0151', 'senha123', '1995-05-02', 'Servicos gerais', 'Suporte'),
(25, 'Yago Morais', 'yago.morais@email.com', '161.161.161-17', '(11) 96161-0161', 'senha123', '1984-02-14', 'TI', 'Assistente'),
(26, 'Zélia Duarte', 'zelia.duarte@email.com', '171.171.171-18', '(11) 97171-0171', 'senha123', '1993-01-29', 'Recursos Humanos', 'Gerente'),
(27, 'Arthur Nogueira', 'arthur.nogueira@email.com', '181.181.181-19', '(11) 98181-0181', 'senha123', '1990-03-19', 'Administração', 'Técnico Administrativo'),
(28, 'Beatriz Lima', 'beatriz.lima@email.com', '191.191.191-20', '(11) 99191-0191', 'senha123', '1986-06-09', 'Servicos gerais', 'Suporte'),
(29, 'Caio Sousa', 'caio.sousa@email.com', '202.202.202-21', '(11) 90202-0202', 'senha123', '1997-11-17', 'TI', 'Assistente'),
(30, 'Daniel Oliveira', 'daniel.oliveira@email.com', '212.212.212-22', '(11) 91212-0212', 'senha123', '1988-12-30', 'Recursos Humanos', 'Gerente'),
(31, 'brendo1', 'brendo1@gmail.com', '89974856523', '6899999999', '$2y$10$USYfejUkLvXXSilCnIV9H.l/9z6QjBXLBKlcZG', '2024-10-09', 'RH', 'agente'),
(32, 'brendo2', 'brendo2@gmail.com', '89974856523', '6899999999', '$2y$10$4OO4LCXixwK1wmO8ZT0V4O4KA.2zDzLRUtTix0OgmPsirtbLAhQw2', '2024-10-09', 'RH', 'agente'),
(33, 'brendo', 'teste@gmail.com', '89974856523', '6899999999', '$2y$10$zLqAstbPQKC5tr0We7XGq.nsXqDJ3HyqmFWzg23WSzGaLWAxZ5mb6', '2024-10-12', 'RH', 'agente'),
(34, 'silva', 'teste1@gmail.com', '89974856523', '6899999999', '$2y$10$/1kylHRLbm9TBAgXP5okMuoPcZdK2B9DfJNfJt1zCVJU.3ZBgtUK2', '2024-10-14', 'RH', 'agente'),
(35, 'silva1', 'teste2@gmail.com', '89974856523', '6899999999', '$2y$10$10vMdBeiEBgT453WSxT4K.4c9r2X5TVLvR4R4MJstC1qcuEzxTFuO', '2024-10-14', 'RH', 'agente'),
(36, 'brendo', 'teste3@gmail.com', '89974856523', '6899999999', '$2y$10$O/H/4Ej3.53iC0XD0kMNjOuD.DdotfOYw2B1LtoqhzvQ6Ak8th2zm', '2024-10-14', 'RH', 'agente'),
(37, 'brendos', 'teste4@gmail.com', '89974856523', '6899999999', '$2y$10$PAJS8gnWh.hgHzkLe9.bxeW7pldNX9zc7j.gKcW9AkGOMjJBb80U6', '2024-10-14', 'RH', 'agente'),
(38, 'brendos', 'teste4@gmail.com', '89974856523', '6899999999', '$2y$10$FNNjI5xz9UOvETwJsRHES.wsOqZvw8ISN1w6wY5OL6xh8rNiJ80dq', '2024-10-14', 'RH', 'agente'),
(39, 'pedro', 'pedro@gmail.com', '89974856523', '6899999999', '$2y$10$b2GdPbmFjHLp7CvygNHn0.057ir4tLTJ5BMaLZYltVsanvs1qXam2', '2024-10-14', 'RH', 'agente'),
(40, 'brendo', 'brendo@gmail.com', '000000000000000', '626261261', '$2y$10$/IBE6v/9e49GKi.19C8UG.iJYqltRd8n91Lwfg8tsGYJSwiL/RyUC', '2024-10-22', 'ti', 'gerente');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluguel`
--
ALTER TABLE `aluguel`
  ADD PRIMARY KEY (`idaluguel`);

--
-- Índices de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`idequipamento`);

--
-- Índices de tabela `usuario_administrador`
--
ALTER TABLE `usuario_administrador`
  ADD PRIMARY KEY (`id_usuario_administrador`);

--
-- Índices de tabela `usuario_comum`
--
ALTER TABLE `usuario_comum`
  ADD PRIMARY KEY (`id_USUARIO_COMUM`),
  ADD UNIQUE KEY `id_USUARIO_COMUM_UNIQUE` (`id_USUARIO_COMUM`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluguel`
--
ALTER TABLE `aluguel`
  MODIFY `idaluguel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `idequipamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `usuario_administrador`
--
ALTER TABLE `usuario_administrador`
  MODIFY `id_usuario_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `usuario_comum`
--
ALTER TABLE `usuario_comum`
  MODIFY `id_USUARIO_COMUM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
