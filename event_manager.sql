-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Dez-2022 às 01:12
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `event_manager`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `events`
--

CREATE TABLE `events` (
  `eventsId` int(11) NOT NULL,
  `eventName` text NOT NULL,
  `eventType` text NOT NULL,
  `eventCapacity` int(11) NOT NULL,
  `eventCountry` text NOT NULL,
  `eventSchedule` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `events`
--

INSERT INTO `events` (`eventsId`, `eventName`, `eventType`, `eventCapacity`, `eventCountry`, `eventSchedule`) VALUES
(1, 'Beach Party', 'Religious', 15000, 'Portugal', 'January 15th'),
(2, 'Beach Party', 'Festival', 75000, 'Portugal', 'February 10th'),
(3, 'TomorrowLand', 'Festival', 100000, 'Germany', 'December 15th');

-- --------------------------------------------------------

--
-- Estrutura da tabela `signups`
--

CREATE TABLE `signups` (
  `SignupsId` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `eventId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `signups`
--

INSERT INTO `signups` (`SignupsId`, `userID`, `eventId`) VALUES
(1, 1, 1),
(3, 9, 1),
(4, 1, 3),
(5, 7, 3),
(7, 7, 1),
(10, 8, 1),
(11, 6, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(128) NOT NULL,
  `userEmail` varchar(128) NOT NULL,
  `userUID` varchar(128) NOT NULL,
  `userAge` int(64) NOT NULL,
  `userCountry` varchar(64) NOT NULL,
  `userGender` varchar(64) NOT NULL,
  `userPassword` varchar(128) NOT NULL,
  `userAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`userID`, `userName`, `userEmail`, `userUID`, `userAge`, `userCountry`, `userGender`, `userPassword`, `userAdmin`) VALUES
(1, 'Bruno', 'ispg2020@ispgaya.pt', 'Bruno', 20, 'Portugal', 'Male', '$2y$10$yetwVRt61wHmVXWMxsh0PuR0./bpObmAxccVxoGVhWbKDbSbM8lvq', 1),
(6, 'Miguel', 'aga502@gmail.com', 'teste', 25, 'Portugal', 'Male', '$2y$10$0V9DFUI/kCmwvm7wuNouGuvM4K1m4ZyrHe/YYMxRkydwb7zES7LCG', 1),
(7, 'Mia', 'mia@gmail.com', 'mia', 25, 'France', 'Female', '$2y$10$7K2ydOZgF.WEiMb04eQgE.GGh6LXtOtxpKFzI7nK7ynl2WAmftmkq', 1),
(8, 'Joana', 'joana@gmail.com', 'joana', 23, 'Spain', 'Female', '$2y$10$AekYLp82.MtJB3rM68FyAOiVZzPgL6FiMhn/8qi4KkWTeM2hLfNhS', 1),
(9, 'Rodrigo', 'Rodrigo@gmail.com', 'rodrigo', 19, 'USA', 'Male', '$2y$10$rJE5lfbAjOzsxAI8brHGy.eQqcfilz2Yjrx9nYfGNsdbJcDDM0HTW', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventsId`);

--
-- Índices para tabela `signups`
--
ALTER TABLE `signups`
  ADD PRIMARY KEY (`SignupsId`),
  ADD KEY `userId` (`userID`),
  ADD KEY `eventId` (`eventId`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `events`
--
ALTER TABLE `events`
  MODIFY `eventsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `signups`
--
ALTER TABLE `signups`
  MODIFY `SignupsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `signups`
--
ALTER TABLE `signups`
  ADD CONSTRAINT `signups_ibfk_1` FOREIGN KEY (`eventId`) REFERENCES `events` (`eventsId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `signups_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `signups_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
