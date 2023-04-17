-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07-Fev-2018 às 17:56
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suporte_personalizado`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamados`
--

CREATE TABLE `chamados` (
  `id` int(11) NOT NULL,
  `pergunta` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chamados`
--

INSERT INTO `chamados` (`id`, `pergunta`, `email`, `token`) VALUES
(10, 'Olá, estou com problemas de acesso.', 'contato@dankicode.com', 'e7e53245c17f685a6b5c30049c59b98c'),
(11, 'Olá, estou com um problema no meu código HTML. Pode me ajudar?', 'contato@dankicode.com', '4405f51862b18945e685b9f810a4b2ac');

-- --------------------------------------------------------

--
-- Estrutura da tabela `interacao_chamado`
--

CREATE TABLE `interacao_chamado` (
  `id` int(11) NOT NULL,
  `id_chamado` varchar(255) NOT NULL,
  `mensagem` text NOT NULL,
  `admin` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `interacao_chamado`
--

INSERT INTO `interacao_chamado` (`id`, `id_chamado`, `mensagem`, `admin`, `status`) VALUES
(7, 'e7e53245c17f685a6b5c30049c59b98c', 'Você precisa fazer o seguinte: ', 1, 1),
(8, 'e7e53245c17f685a6b5c30049c59b98c', 'Ainda não consegui...', -1, 1),
(9, 'e7e53245c17f685a6b5c30049c59b98c', 'Ok, o que você não conseguiu?', 1, 1),
(10, 'e7e53245c17f685a6b5c30049c59b98c', 'Eu não consegui fazer aquilo...', -1, 1),
(11, 'e7e53245c17f685a6b5c30049c59b98c', 'Okay, agora você vai fazer novamente.', 1, 1),
(12, '4405f51862b18945e685b9f810a4b2ac', 'Sim, o que você precisa?', 1, 1),
(13, '4405f51862b18945e685b9f810a4b2ac', 'Eu preciso arrumar meu erro!', -1, 1),
(14, '4405f51862b18945e685b9f810a4b2ac', 'Okay, qual seu erro?', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chamados`
--
ALTER TABLE `chamados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interacao_chamado`
--
ALTER TABLE `interacao_chamado`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chamados`
--
ALTER TABLE `chamados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `interacao_chamado`
--
ALTER TABLE `interacao_chamado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
