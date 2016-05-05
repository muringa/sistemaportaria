-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05-Maio-2016 às 18:09
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_portaria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `guardas`
--

CREATE TABLE IF NOT EXISTS `guardas` (
  `rg` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `entrada` time NOT NULL,
  `saida` time NOT NULL,
  `Senha` varchar(255) NOT NULL,
  PRIMARY KEY (`rg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `visitantes`
--

CREATE TABLE IF NOT EXISTS `visitantes` (
  `rg` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`rg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `visitas`
--

CREATE TABLE IF NOT EXISTS `visitas` (
  `numero` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `nomeVisitante` varchar(255) NOT NULL,
  `rgVisitante` varchar(255) NOT NULL,
  `rgGuarda` varchar(255) NOT NULL,
  `entrada` time NOT NULL,
  `saida` timestamp NOT NULL,
  `instituicao` varchar(255) NOT NULL,
  `observacao` varchar(255) NOT NULL,
  PRIMARY KEY (`numero`),
  KEY `rgVisitante` (`rgVisitante`,`rgGuarda`),
  KEY `rgGuarda` (`rgGuarda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `visitas_ibfk_2` FOREIGN KEY (`rgGuarda`) REFERENCES `guardas` (`rg`),
  ADD CONSTRAINT `visitas_ibfk_1` FOREIGN KEY (`rgVisitante`) REFERENCES `visitantes` (`rg`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
