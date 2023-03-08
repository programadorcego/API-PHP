-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 30/12/2022 às 13:48
-- Versão do servidor: 8.0.31
-- Versão do PHP: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mvcdb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

Drop Table IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `usuarios` CHANGE `name` `username` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL;
ALTER TABLE `usuarios` ADD `email` VARCHAR(100) NOT NULL AFTER `username`;

INSERT INTO `usuarios` (`username`, `email`, `password`) VALUES
('will', 'will@teste.com.br', MD5('11111111')),
('will2', 'will2@teste.com.br', MD5('11111111')),
('will3', 'will3@teste.com.br', MD5('11111111')),
('will4', 'will4@teste.com.br', MD5('11111111')),
('will5', 'will5@teste.com.br', MD5('11111111')),
('will6', 'will6@teste.com.br', MD5('11111111')),
('will7', 'will7@teste.com.br', MD5('11111111')),
('will8', 'will8@teste.com.br', MD5('11111111')),
('will9', 'will9@teste.com.br', MD5('11111111')),
('will10', 'will10@teste.com.br', MD5('11111111')),
('will11', 'will11@teste.com.br', MD5('11111111')),
('will12', 'will12@teste.com.br', MD5('11111111')),
('will13', 'will13@teste.com.br', MD5('11111111')),
('will14', 'will14@teste.com.br', MD5('11111111')),
('will15', 'will15@teste.com.br', MD5('11111111')),
('will16', 'will16@teste.com.br', MD5('11111111')),
('will17', 'will17@teste.com.br', MD5('11111111')),
('will18', 'will18@teste.com.br', MD5('11111111')),
('will19', 'will19@teste.com.br', MD5('11111111')),
('will20', 'will20@teste.com.br', MD5('11111111'));