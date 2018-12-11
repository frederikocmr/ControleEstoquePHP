-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 11-Dez-2018 às 03:15
-- Versão do servidor: 5.7.23
-- versão do PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `controleestoque`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo_produto`
--

DROP TABLE IF EXISTS `grupo_produto`;
CREATE TABLE IF NOT EXISTS `grupo_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupo_produto`
--

INSERT INTO `grupo_produto` (`id`, `nome`, `descricao`) VALUES
(28, 'Vasilha', 'vasilha de aluminio'),
(29, 'lÃ¡pis', 'lÃ¡pis rosa'),
(30, 'lÃ¡pis', 'lÃ¡pis rosa'),
(31, 'lÃ¡pis', 'lÃ¡pis rosa'),
(32, 'lÃ¡pis', 'lÃ¡pis rosa'),
(33, 'lÃ¡pis', 'lÃ¡pis rosa'),
(34, 'lÃ¡pis', 'lÃ¡pis rosa'),
(35, 'lÃ¡pis', 'lÃ¡pis rosa'),
(36, 'lÃ¡pis', 'lÃ¡pis rosa'),
(37, 'teste', '1256sss'),
(38, 'teste', '1256sss'),
(39, 'teste', '1256sss'),
(40, 'teste', '1256sss'),
(41, 'teste', '1256sss'),
(42, 'teste', '1256sss'),
(43, 'teste', '1256sss'),
(44, 'teste', '1256sss'),
(45, '', ''),
(46, '', ''),
(47, '', ''),
(48, '', ''),
(49, '', ''),
(50, '', ''),
(51, '', ''),
(52, '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_grupo` (`id_grupo`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `descricao`, `id_grupo`) VALUES
(1, 'Camisa', 'Camisa rosa com bolso', 2),
(2, 'Blusa', 'Blusa laranja decote', 1),
(3, 'CalÃ§a', 'CalÃ§a preta com ziper', 3),
(4, 'oios', 'sasdsd', 31),
(5, 'tese', 'sdasd', 44);

-- --------------------------------------------------------

--
-- Estrutura da tabela `secao`
--

DROP TABLE IF EXISTS `secao`;
CREATE TABLE IF NOT EXISTS `secao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`,`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='Tabela de Usuários';

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `password`) VALUES
(1, 'admin', 'admin@admin.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e'),
(7, 'fred', 'fred@email.com', 'user', '570a90bfbf8c7eab5dc5d4e26832d5b1'),
(8, 'anna', 'anna@email.com', 'user', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'urubu', 'urubu@enasi.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e'),
(10, 'Anna Lara', 'annalara1426@gmail.com', 'user', 'e10adc3949ba59abbe56e057f20f883e');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
