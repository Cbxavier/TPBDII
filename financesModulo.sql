-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 26/11/2024 às 08:58
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `financesModulo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `telefone`, `endereco`, `created_at`, `updated_at`) VALUES
(3, 'João Silva', 'joao.silva@email.com', '1234567890', 'Rua A, 123', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(4, 'Maria Oliveira', 'maria.oliveira@email.com', '9876543210', 'Avenida B, 456', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(5, 'Carlos Pereira', 'carlos.pereira@email.com', '1122334455', 'Praça C, 789', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(6, 'Ana Souza', 'ana.souza@email.com', '6677889900', 'Rua D, 101', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(7, 'Pedro Costa', 'pedro.costa@email.com', '5544332211', 'Rua E, 202', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(8, 'Fernanda Lima', 'fernanda.lima@email.com', '2233445566', 'Avenida F, 303', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(9, 'Rafael Santos', 'rafael.santos@email.com', '3344556677', 'Rua G, 404', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(10, 'Juliana Almeida', 'juliana.almeida@email.com', '4455667788', 'Rua H, 505', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(11, 'Roberto Martins', 'roberto.martins@email.com', '5566778899', 'Avenida I, 606', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(12, 'Patrícia Rocha', 'patricia.rocha@email.com', '6677889900', 'Praça J, 707', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(13, 'Luiz Ferreira', 'luiz.ferreira@email.com', '7788990011', 'Rua K, 808', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(14, 'Sílvia Costa', 'silvia.costa@email.com', '8899001122', 'Avenida L, 909', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(15, 'Gustavo Pinto', 'gustavo.pinto@email.com', '9900112233', 'Rua M, 110', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(16, 'Letícia Souza', 'leticia.souza@email.com', '1231231234', 'Praça N, 210', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(17, 'Ricardo Almeida', 'ricardo.almeida@email.com', '2342342345', 'Rua O, 310', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(18, 'Simone Santos', 'simone.santos@email.com', '3453453456', 'Avenida P, 410', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(19, 'Bruna Rocha', 'bruna.rocha@email.com', '4564564567', 'Rua Q, 510', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(20, 'Marcelo Oliveira', 'marcelo.oliveira@email.com', '5675675678', 'Avenida R, 610', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(21, 'Tânia Martins', 'tania.martins@email.com', '6786786789', 'Praça S, 710', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(22, 'Vitor Costa', 'vitor.costa@email.com', '7897897890', 'Rua T, 810', '2024-11-26 07:33:12', '2024-11-26 07:33:12'),
(23, 'Davi Caputo', 'davi@gmail.com', '38998812771', 'Princesa Isabel', '2024-11-26 07:51:21', '2024-11-26 07:51:21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Contas`
--

CREATE TABLE `Contas` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `tipo` enum('pagar','receber') NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_vencimento` date NOT NULL,
  `status` enum('a_vencer','vencida','paga','recebida') DEFAULT 'a_vencer',
  `cliente_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Contas`
--

INSERT INTO `Contas` (`id`, `descricao`, `tipo`, `valor`, `data_vencimento`, `status`, `cliente_id`, `created_at`, `updated_at`) VALUES
(11, 'Pagamento de fatura 1', 'pagar', 150.00, '2024-12-05', 'a_vencer', 3, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(12, 'Recebimento de venda 1', 'receber', 320.00, '2024-12-10', 'a_vencer', 3, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(13, 'Pagamento de fatura 2', 'pagar', 200.50, '2024-12-12', 'vencida', 4, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(14, 'Recebimento de venda 2', 'receber', 400.00, '2024-12-15', 'a_vencer', 4, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(15, 'Pagamento de fatura 3', 'pagar', 250.75, '2024-12-20', 'a_vencer', 5, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(16, 'Recebimento de venda 3', 'receber', 600.00, '2024-12-25', 'paga', 5, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(17, 'Pagamento de fatura 4', 'pagar', 120.00, '2024-12-30', 'vencida', 6, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(18, 'Recebimento de venda 4', 'receber', 150.00, '2025-01-01', 'a_vencer', 6, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(19, 'Pagamento de fatura 5', 'pagar', 180.00, '2025-01-05', 'a_vencer', 7, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(20, 'Recebimento de venda 5', 'receber', 275.00, '2025-01-10', 'a_vencer', 7, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(21, 'Pagamento de fatura 6', 'pagar', 310.00, '2025-01-15', 'paga', 8, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(22, 'Recebimento de venda 6', 'receber', 500.00, '2025-01-20', 'a_vencer', 8, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(23, 'Pagamento de fatura 7', 'pagar', 500.00, '2025-01-22', 'vencida', 9, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(24, 'Recebimento de venda 7', 'receber', 100.00, '2025-01-25', 'recebida', 9, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(25, 'Pagamento de fatura 8', 'pagar', 275.00, '2025-01-28', 'a_vencer', 10, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(26, 'Recebimento de venda 8', 'receber', 450.00, '2025-02-01', 'a_vencer', 10, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(27, 'Pagamento de fatura 9', 'pagar', 350.00, '2025-02-05', 'vencida', 11, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(28, 'Recebimento de venda 9', 'receber', 410.00, '2025-02-10', 'paga', 11, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(29, 'Pagamento de fatura 10', 'pagar', 220.00, '2025-02-12', 'a_vencer', 12, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(30, 'Recebimento de venda 10', 'receber', 375.00, '2025-02-15', 'a_vencer', 12, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(31, 'Pagamento de fatura 11', 'pagar', 150.50, '2025-02-18', 'vencida', 13, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(32, 'Recebimento de venda 11', 'receber', 320.00, '2025-02-20', 'a_vencer', 13, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(33, 'Pagamento de fatura 12', 'pagar', 130.00, '2025-02-23', 'a_vencer', 14, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(34, 'Recebimento de venda 12', 'receber', 480.00, '2025-02-25', 'a_vencer', 14, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(35, 'Pagamento de fatura 13', 'pagar', 180.00, '2025-02-28', 'vencida', 15, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(36, 'Recebimento de venda 13', 'receber', 300.00, '2025-03-01', 'a_vencer', 15, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(37, 'Pagamento de fatura 14', 'pagar', 250.00, '2025-03-05', 'paga', 16, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(38, 'Recebimento de venda 14', 'receber', 400.00, '2025-03-08', 'a_vencer', 16, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(39, 'Pagamento de fatura 15', 'pagar', 270.00, '2025-03-10', 'vencida', 17, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(40, 'Recebimento de venda 15', 'receber', 350.00, '2025-03-15', 'a_vencer', 17, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(41, 'Pagamento de fatura 16', 'pagar', 300.00, '2025-03-18', 'a_vencer', 18, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(42, 'Recebimento de venda 16', 'receber', 500.00, '2025-03-20', 'a_vencer', 18, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(43, 'Pagamento de fatura 17', 'pagar', 220.00, '2025-03-25', 'paga', 19, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(44, 'Recebimento de venda 17', 'receber', 350.00, '2025-03-28', 'recebida', 19, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(45, 'Pagamento de fatura 18', 'pagar', 280.00, '2025-04-01', 'vencida', 20, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(46, 'Recebimento de venda 18', 'receber', 400.00, '2025-04-03', 'paga', 20, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(47, 'Pagamento de fatura 19', 'pagar', 250.00, '2025-04-05', 'a_vencer', 21, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(48, 'Recebimento de venda 19', 'receber', 330.00, '2025-04-08', 'a_vencer', 21, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(49, 'Pagamento de fatura 20', 'pagar', 260.00, '2025-04-10', 'vencida', 22, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(50, 'Recebimento de venda 20', 'receber', 370.00, '2025-04-12', 'paga', 22, '2024-11-26 07:48:21', '2024-11-26 07:48:21'),
(51, 'Salário', 'pagar', 15000.00, '2024-11-30', 'a_vencer', 23, '2024-11-26 07:51:41', '2024-11-26 07:51:41');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `Contas`
--
ALTER TABLE `Contas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `Contas`
--
ALTER TABLE `Contas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `Contas`
--
ALTER TABLE `Contas`
  ADD CONSTRAINT `Contas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
