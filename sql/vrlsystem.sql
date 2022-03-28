-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Mar-2022 às 14:47
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `manyminds`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `colaborador_id` int(11) NOT NULL,
  `colaborador_nome` varchar(100) NOT NULL,
  `colaborador_nick` varchar(20) NOT NULL,
  `colaborador_login` varchar(30) NOT NULL,
  `colaborador_senha` varchar(32) NOT NULL,
  `colaborador_tipo` varchar(10) NOT NULL,
  `colaborador_status` tinyint(1) NOT NULL DEFAULT 1,
  `colaborador_datatime_criado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `colaboradores`
--

INSERT INTO `colaboradores` (`colaborador_id`, `colaborador_nome`, `colaborador_nick`, `colaborador_login`, `colaborador_senha`, `colaborador_tipo`, `colaborador_status`, `colaborador_datatime_criado`) VALUES
(1, 'Admin', 'Admin', 'adm', 'f4d6aa9c6385f0c4614dbfa11410150f', 'master', 1, '2022-03-23 16:42:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `pedido_id` int(11) NOT NULL,
  `pedido_status` varchar(10) NOT NULL,
  `pedido_colaborador` int(11) NOT NULL,
  `pedido_fornecedor` int(11) NOT NULL,
  `pedido_total` decimal(10,2) NOT NULL,
  `pedido_obs` text NOT NULL,
  `pedido_dataHora` datetime NOT NULL DEFAULT current_timestamp(),
  `pedido_dataHoraFin` datetime DEFAULT NULL,
  `pedido_dataHoraEnt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_produtos`
--

CREATE TABLE `pedido_produtos` (
  `pedido_produto_id` int(11) NOT NULL,
  `pedido_produto_pedido` int(11) NOT NULL,
  `pedido_produto_produto` int(11) NOT NULL,
  `pedido_produto_descricao` varchar(100) NOT NULL,
  `pedido_produto_codigo` int(11) NOT NULL,
  `pedido_produto_quant` decimal(10,4) NOT NULL,
  `pedido_produto_preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `produto_id` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `produto_status` tinyint(1) NOT NULL,
  `produto_descricao` varchar(100) NOT NULL,
  `produto_preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`colaborador_id`),
  ADD UNIQUE KEY `usuario_email` (`colaborador_login`),
  ADD UNIQUE KEY `usuario_login` (`colaborador_login`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedido_id`),
  ADD KEY `restricao_colaborador` (`pedido_colaborador`),
  ADD KEY `restricao_fornecedor` (`pedido_fornecedor`);

--
-- Índices para tabela `pedido_produtos`
--
ALTER TABLE `pedido_produtos`
  ADD PRIMARY KEY (`pedido_produto_id`),
  ADD KEY `retricao_pedido` (`pedido_produto_pedido`),
  ADD KEY `retricao_produto` (`pedido_produto_produto`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`produto_id`),
  ADD UNIQUE KEY `produto_cod` (`produto_cod`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `colaborador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `pedido_produtos`
--
ALTER TABLE `pedido_produtos`
  MODIFY `pedido_produto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `restricao_colaborador` FOREIGN KEY (`pedido_colaborador`) REFERENCES `colaboradores` (`colaborador_id`),
  ADD CONSTRAINT `restricao_fornecedor` FOREIGN KEY (`pedido_fornecedor`) REFERENCES `colaboradores` (`colaborador_id`);

--
-- Limitadores para a tabela `pedido_produtos`
--
ALTER TABLE `pedido_produtos`
  ADD CONSTRAINT `retricao_pedido` FOREIGN KEY (`pedido_produto_pedido`) REFERENCES `pedidos` (`pedido_id`),
  ADD CONSTRAINT `retricao_produto` FOREIGN KEY (`pedido_produto_produto`) REFERENCES `produtos` (`produto_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
