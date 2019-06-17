-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17-Jun-2019 às 11:45
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
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `material_standards`
--

CREATE TABLE `material_standards` (
  `ID_MATERIAL` int(10) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `MAXIMUM_COST` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `material_standards`
--

INSERT INTO `material_standards` (`ID_MATERIAL`, `NAME`, `MAXIMUM_COST`) VALUES
(1, 'Caneta', '0.05'),
(2, 'LÃ¡pis', '0.10'),
(3, 'Teclado', '15.00'),
(4, 'Mouse', '10.00'),
(5, 'Abajur', '50.00'),
(6, 'Caixa de som', '30.00'),
(7, 'Computador', '150.00'),
(8, 'Max Bomb Plus', '199.99'),
(9, 'Apontador', '0.00'),
(10, 'ColÃ¡geno', '55.50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `purchased`
--

CREATE TABLE `purchased` (
  `ID_PURCHASED` int(10) NOT NULL,
  `ID_MATERIAL` int(10) NOT NULL,
  `ID_SUPPLIER` int(10) NOT NULL,
  `UNIT_COST` decimal(19,2) NOT NULL,
  `QUANTITY` int(10) NOT NULL,
  `PURCHASE_DATE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `purchased`
--

INSERT INTO `purchased` (`ID_PURCHASED`, `ID_MATERIAL`, `ID_SUPPLIER`, `UNIT_COST`, `QUANTITY`, `PURCHASE_DATE`) VALUES
(3, 1, 1, '0.05', 1, '2018-06-15 17:06:38'),
(4, 2, 1, '0.05', 50, '2017-06-15 17:06:38'),
(5, 3, 1, '0.05', 50, '2017-06-15 17:06:38'),
(6, 3, 5, '0.05', 10, '2018-06-15 17:06:38'),
(7, 3, 5, '0.07', 10, '2018-06-15 17:06:38'),
(8, 3, 5, '0.05', 10, '2018-06-15 17:06:38'),
(9, 3, 5, '0.08', 10, '2018-06-15 17:06:38'),
(10, 3, 5, '0.08', 10, '2018-06-15 17:06:38'),
(11, 3, 5, '0.08', 10, '2018-06-15 17:06:38'),
(12, 4, 5, '0.08', 10, '2018-06-15 17:06:38'),
(13, 4, 5, '0.08', 30, '2018-06-15 17:06:38'),
(14, 1, 5, '0.01', 30, '2018-06-15 17:06:38'),
(15, 3, 5, '0.07', 30, '2018-06-15 17:06:38'),
(16, 3, 5, '0.07', 30, '2018-06-15 17:06:38'),
(17, 3, 5, '0.07', 30, '2018-06-15 18:06:38'),
(18, 1, 5, '0.01', 30, '2018-06-15 18:06:38'),
(19, 2, 5, '0.03', 30, '2018-06-15 18:06:38'),
(20, 2, 5, '0.03', 30, '2018-06-15 18:06:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `supplier`
--

CREATE TABLE `supplier` (
  `ID_SUPPLIER` int(10) NOT NULL,
  `NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `supplier`
--

INSERT INTO `supplier` (`ID_SUPPLIER`, `NAME`) VALUES
(1, 'Kalunga'),
(2, 'Americanas'),
(3, 'Livrarias Curitiba'),
(4, 'Distribuidora de papeis'),
(5, 'Forros LTDA'),
(6, 'Pedras'),
(7, 'Cafeteria'),
(8, 'Boulevard Frios'),
(9, 'Chars Frios'),
(10, 'Max Steel'),
(11, 'Televisor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `material_standards`
--
ALTER TABLE `material_standards`
  ADD PRIMARY KEY (`ID_MATERIAL`);

--
-- Indexes for table `purchased`
--
ALTER TABLE `purchased`
  ADD PRIMARY KEY (`ID_PURCHASED`),
  ADD KEY `ID_SUPPLIER` (`ID_SUPPLIER`),
  ADD KEY `ID_MATERIAL` (`ID_MATERIAL`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID_SUPPLIER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchased`
--
ALTER TABLE `purchased`
  MODIFY `ID_PURCHASED` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `purchased`
--
ALTER TABLE `purchased`
  ADD CONSTRAINT `purchased_ibfk_1` FOREIGN KEY (`ID_SUPPLIER`) REFERENCES `supplier` (`ID_SUPPLIER`),
  ADD CONSTRAINT `purchased_ibfk_2` FOREIGN KEY (`ID_MATERIAL`) REFERENCES `material_standards` (`ID_MATERIAL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
