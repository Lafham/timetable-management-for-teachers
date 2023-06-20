-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2022 at 04:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `assurer`
--

CREATE TABLE `assurer` (
  `Prof` varchar(255) NOT NULL,
  `Num_Module` int(11) NOT NULL,
  `Num_Semestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assurertype`
--

CREATE TABLE `assurertype` (
  `Prof` varchar(255) NOT NULL,
  `num_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contenir`
--

CREATE TABLE `contenir` (
  `Num_Module` int(11) NOT NULL,
  `Num_Type` int(11) NOT NULL,
  `Nombre_Heure` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `nom_departement` varchar(255) NOT NULL,
  `responsable` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `Nom_Complet` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Telephone` varchar(10) NOT NULL,
  `Civilite` varchar(10) NOT NULL,
  `Grade` varchar(10) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`Nom_Complet`, `Email`, `Telephone`, `Civilite`, `Grade`, `id_users`) VALUES
('mohamed', 'mohmed@gmail.com', '0611570999', 'Homme', 'PES', 1),
('mouad guedad', 'mouad@gmail.com', '000000', 'Homme', 'PES', 2),
('tarik agouti', 'tarik@gmail.com', '000000', 'Homme', 'PES', 4);

-- --------------------------------------------------------

--
-- Table structure for table `enseigner`
--

CREATE TABLE `enseigner` (
  `Professeur` varchar(255) NOT NULL,
  `Num_Module` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `Nom` varchar(120) NOT NULL,
  `Type_de_formation` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Responsable` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `Grade` varchar(10) NOT NULL,
  `Nombre_heure` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`Grade`, `Nombre_heure`) VALUES
('PA', 256),
('PES', 448),
('PH', 257.7);

-- --------------------------------------------------------

--
-- Table structure for table `intervenir`
--

CREATE TABLE `intervenir` (
  `Professeur` varchar(255) NOT NULL,
  `Nom_filiere` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `num` int(11) NOT NULL,
  `Nom_Module` varchar(255) NOT NULL,
  `Nom_filiere` varchar(255) NOT NULL,
  `Responsable` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role_administratif`
--

CREATE TABLE `role_administratif` (
  `num` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `nombre_heure` varchar(255) NOT NULL,
  `professeur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `semestre`
--

CREATE TABLE `semestre` (
  `Num_Semestre` int(11) NOT NULL,
  `Nom_Semestre` varchar(255) NOT NULL,
  `Nom_Session` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semestre`
--

INSERT INTO `semestre` (`Num_Semestre`, `Nom_Semestre`, `Nom_Session`) VALUES
(1, 'S1', 'Automne'),
(2, 'S2', 'Printemps'),
(3, 'S3', 'Automne'),
(4, 'S4', 'Printemps'),
(5, 'S5', 'Automne'),
(6, 'S6', 'Printemps');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL COMMENT 'role_id',
  `role` varchar(255) DEFAULT NULL COMMENT 'role_text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `role`) VALUES
(1, 'Chef departement'),
(2, 'Chef filiere'),
(3, 'Enseignant');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `roleid` tinyint(4) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `username`, `email`, `password`, `mobile`, `roleid`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'mohamed lafham', 'mohamed', 'med@gmail.com', 'med lafham 123', '0611570999', 1, 0, '2022-06-12 11:35:15', '2022-06-12 11:35:15'),
(2, 'mouad guedad', 'mouad', 'mouad@gmail.com', 'mouad123', '0666666666', 2, 0, '2022-06-12 11:41:08', '2022-06-12 11:41:08'),
(3, 'jihad zahir', 'jihad', 'jihad@gmail.com', 'jihad123', '000000', 3, 0, '2022-06-12 11:44:05', '2022-06-12 11:44:05'),
(4, 'tarik agouti', 'tarik', 'tarik@gmail.com', 'tarik123', '000000', 3, 0, '2022-06-12 11:45:14', '2022-06-12 11:45:14'),
(36, 'el hassan abdelwahed', 'abdelwahed', 'abdelwahed@gmail.com', 'abdelwahed123', '999999', 2, 1, '2022-06-12 11:50:13', '2022-06-12 11:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `type_enseignement`
--

CREATE TABLE `type_enseignement` (
  `numero` int(11) NOT NULL,
  `label` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type_enseignement`
--

INSERT INTO `type_enseignement` (`numero`, `label`) VALUES
(1, 'Cours'),
(2, 'TD'),
(3, 'TP');

-- --------------------------------------------------------

--
-- Table structure for table `_session`
--

CREATE TABLE `_session` (
  `Nom_Session` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_session`
--

INSERT INTO `_session` (`Nom_Session`) VALUES
('Automne'),
('Printemps');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assurer`
--
ALTER TABLE `assurer`
  ADD PRIMARY KEY (`Prof`,`Num_Module`,`Num_Semestre`),
  ADD KEY `Num_Module` (`Num_Module`),
  ADD KEY `Num_Semestre` (`Num_Semestre`);

--
-- Indexes for table `assurertype`
--
ALTER TABLE `assurertype`
  ADD PRIMARY KEY (`Prof`,`num_type`),
  ADD KEY `num_type` (`num_type`);

--
-- Indexes for table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`Num_Module`,`Num_Type`),
  ADD KEY `Num_Type` (`Num_Type`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respoDep` (`responsable`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`Email`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `ff_grade` (`Grade`);

--
-- Indexes for table `enseigner`
--
ALTER TABLE `enseigner`
  ADD PRIMARY KEY (`Professeur`,`Num_Module`),
  ADD KEY `module` (`Num_Module`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`Nom`),
  ADD KEY `resp` (`Responsable`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`Grade`);

--
-- Indexes for table `intervenir`
--
ALTER TABLE `intervenir`
  ADD PRIMARY KEY (`Professeur`,`Nom_filiere`),
  ADD KEY `Nom_filiere` (`Nom_filiere`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`num`),
  ADD KEY `nom_filiere` (`Nom_filiere`),
  ADD KEY `respo` (`Responsable`);

--
-- Indexes for table `role_administratif`
--
ALTER TABLE `role_administratif`
  ADD PRIMARY KEY (`num`),
  ADD KEY `prof` (`professeur`);

--
-- Indexes for table `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`Num_Semestre`),
  ADD KEY `nom_session` (`Nom_Session`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_enseignement`
--
ALTER TABLE `type_enseignement`
  ADD PRIMARY KEY (`numero`);

--
-- Indexes for table `_session`
--
ALTER TABLE `_session`
  ADD PRIMARY KEY (`Nom_Session`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `role_administratif`
--
ALTER TABLE `role_administratif`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semestre`
--
ALTER TABLE `semestre`
  MODIFY `Num_Semestre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'role_id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `type_enseignement`
--
ALTER TABLE `type_enseignement`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assurer`
--
ALTER TABLE `assurer`
  ADD CONSTRAINT `assurer_ibfk_1` FOREIGN KEY (`Prof`) REFERENCES `enseignant` (`Email`),
  ADD CONSTRAINT `assurer_ibfk_2` FOREIGN KEY (`Num_Module`) REFERENCES `module` (`num`),
  ADD CONSTRAINT `assurer_ibfk_3` FOREIGN KEY (`Num_Semestre`) REFERENCES `semestre` (`Num_Semestre`);

--
-- Constraints for table `assurertype`
--
ALTER TABLE `assurertype`
  ADD CONSTRAINT `assurertype_ibfk_1` FOREIGN KEY (`num_type`) REFERENCES `type_enseignement` (`numero`),
  ADD CONSTRAINT `assurertype_ibfk_2` FOREIGN KEY (`Prof`) REFERENCES `enseignant` (`Email`);

--
-- Constraints for table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_ibfk_1` FOREIGN KEY (`Num_Module`) REFERENCES `module` (`num`),
  ADD CONSTRAINT `contenir_ibfk_2` FOREIGN KEY (`Num_Type`) REFERENCES `type_enseignement` (`numero`);

--
-- Constraints for table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `respoDep` FOREIGN KEY (`responsable`) REFERENCES `enseignant` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `enseignant_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `ff_grade` FOREIGN KEY (`Grade`) REFERENCES `grade` (`Grade`);

--
-- Constraints for table `enseigner`
--
ALTER TABLE `enseigner`
  ADD CONSTRAINT `mail` FOREIGN KEY (`Professeur`) REFERENCES `enseignant` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module` FOREIGN KEY (`Num_Module`) REFERENCES `module` (`num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `resp` FOREIGN KEY (`Responsable`) REFERENCES `enseignant` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `intervenir`
--
ALTER TABLE `intervenir`
  ADD CONSTRAINT `intervenir_ibfk_1` FOREIGN KEY (`Professeur`) REFERENCES `enseignant` (`Email`),
  ADD CONSTRAINT `intervenir_ibfk_2` FOREIGN KEY (`Nom_filiere`) REFERENCES `filiere` (`Nom`);

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `nom_filiere` FOREIGN KEY (`Nom_filiere`) REFERENCES `filiere` (`Nom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respo` FOREIGN KEY (`Responsable`) REFERENCES `enseignant` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_administratif`
--
ALTER TABLE `role_administratif`
  ADD CONSTRAINT `prof` FOREIGN KEY (`professeur`) REFERENCES `enseignant` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `semestre`
--
ALTER TABLE `semestre`
  ADD CONSTRAINT `nom_session` FOREIGN KEY (`Nom_Session`) REFERENCES `_session` (`Nom_Session`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
