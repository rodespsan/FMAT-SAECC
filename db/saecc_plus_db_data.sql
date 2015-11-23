-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2015 at 07:46 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `saeccxp`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(175) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`) VALUES
(1, 'Computación'),
(2, 'Matemáticas'),
(3, 'Otra');

-- --------------------------------------------------------

--
-- Table structure for table `assignation`
--

CREATE TABLE IF NOT EXISTS `assignation` (
`id` int(10) unsigned NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `equipment_id` int(10) unsigned NOT NULL,
  `location` varchar(45) NOT NULL,
  `room_id` int(10) unsigned NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `duration` int(10) unsigned NOT NULL COMMENT 'el tiempo se guardará en segundos y se convertirá a horas según la vista de usuario',
  `purpose` varchar(170) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('administrator', '1', 1447892934);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('administrator', 1, NULL, NULL, NULL, 1447892934, 1447892934);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
`id` int(10) unsigned NOT NULL,
  `client_id` varchar(30) NOT NULL COMMENT 'Puede ser matrícula, clave de empleado o e-mail',
  `first_name` varchar(175) NOT NULL,
  `last_name` varchar(175) NOT NULL,
  `client_type_id` int(10) unsigned NOT NULL,
  `discipline_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `client_id`, `first_name`, `last_name`, `client_type_id`, `discipline_id`, `active`) VALUES
(1, '1111', 'aaaaa', 'ssssss', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_type`
--

CREATE TABLE IF NOT EXISTS `client_type` (
`id` int(10) unsigned NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_type`
--

INSERT INTO `client_type` (`id`, `type`) VALUES
(2, 'Académico'),
(3, 'Administrativo'),
(1, 'Alumno'),
(4, 'Externo');

-- --------------------------------------------------------

--
-- Table structure for table `discipline`
--

CREATE TABLE IF NOT EXISTS `discipline` (
`id` int(10) unsigned NOT NULL,
  `school_id` int(10) unsigned NOT NULL,
  `name` varchar(175) NOT NULL,
  `short_name` varchar(20) NOT NULL,
  `area_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discipline`
--

INSERT INTO `discipline` (`id`, `school_id`, `name`, `short_name`, `area_id`) VALUES
(1, 1, 'Licenciatura en Matemáticas', 'LM', 2),
(2, 1, 'Licenciatura en Enseñanza de las Matemáticas', 'LEM', 2),
(3, 1, 'Licenciatura en Actuaría', 'LA', 2),
(4, 1, 'Licenciatura en Ciencias de la Computación', 'LCC', 1),
(5, 1, 'Licenciatura en Ingeniería de Software', 'LIS', 1),
(6, 1, 'Licenciatura en Ingeniería en Computación', 'LIC', 1),
(7, 3, 'Licenciatura en Ingeniería Civil', 'LI', 3),
(8, 2, 'Licenciatura en Ingeniería Química', 'LIQ', 3);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE IF NOT EXISTS `equipment` (
`id` int(10) unsigned NOT NULL,
  `inventory` varchar(30) NOT NULL,
  `description` varchar(175) NOT NULL,
  `serial_number` varchar(175) NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `room_id` int(10) unsigned NOT NULL,
  `location` varchar(45) NOT NULL COMMENT 'Registra la posición que se le asigna a un equipo en una sala o el nombre de una persona',
  `available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Este campo registra si un equipo va a estar disponible en una sala para asignarlo a un cliente',
  `type_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_type`
--

CREATE TABLE IF NOT EXISTS `equipment_type` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipment_type`
--

INSERT INTO `equipment_type` (`id`, `name`) VALUES
(5, 'Bocina'),
(6, 'Disco Duro'),
(11, 'Duplicador de Video'),
(7, 'Impresora'),
(3, 'Laptop'),
(9, 'Mesa'),
(2, 'Monitor'),
(8, 'Pantalla'),
(1, 'PC'),
(10, 'Proyector de Acetatos'),
(13, 'Silla'),
(12, 'UPS'),
(4, 'Videoproyector');

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE IF NOT EXISTS `incident` (
`id` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `equipment_id` int(10) unsigned DEFAULT NULL,
  `room_id` int(10) unsigned NOT NULL,
  `description` text NOT NULL,
  `solved` tinyint(1) NOT NULL DEFAULT '0',
  `date_solved` datetime DEFAULT NULL,
  `client_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
`id` int(10) unsigned NOT NULL,
  `equipment_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `room_id` int(10) unsigned NOT NULL,
  `location` varchar(45) NOT NULL,
  `log_type_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_type`
--

CREATE TABLE IF NOT EXISTS `log_type` (
`id` int(10) unsigned NOT NULL,
  `type` varchar(45) NOT NULL COMMENT 'indica el tipo de operación como: altas, bajas o cambios.'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_type`
--

INSERT INTO `log_type` (`id`, `type`) VALUES
(1, 'Alta'),
(2, 'Baja'),
(3, 'Actualización');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1447890118);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`, `available`) VALUES
(1, 'CC6', 1),
(2, 'CC1', 0),
(3, 'CC3', 0),
(4, 'CC4', 0),
(5, 'CC5', 0),
(6, 'CC7', 0),
(7, 'CC8', 0),
(8, 'ASI', 0),
(9, 'Bodega', 0),
(10, 'CC9', 0),
(11, 'S. J. A', 0),
(12, 'S. J. Dirección', 0),
(13, 'S. J. E', 0),
(14, 'D5', 0),
(15, 'D7', 0),
(16, 'D8', 0),
(17, 'LMEC', 0),
(18, 'Recepción CC', 0),
(19, 'Edif. A', 0),
(20, 'Edif. E P. A.', 0),
(21, 'Edif. E P. B.', 0),
(22, 'Dirección', 0),
(23, 'LICOVIR', 0),
(24, 'C1', 0),
(25, 'C2', 0),
(26, 'C3', 0),
(27, 'C4', 0),
(28, 'C5', 0),
(29, 'C6', 0),
(30, 'C7', 0),
(31, 'C8', 0),
(32, 'C9', 0),
(33, 'C10', 0),
(34, 'D1', 0),
(35, 'D2', 0),
(36, 'D3', 0),
(37, 'D4', 0),
(38, 'D6', 0),
(39, 'F2', 0),
(40, 'H1', 0),
(41, 'H2', 0),
(42, 'H3', 0),
(43, 'H4', 0),
(44, 'H5', 0),
(45, 'H6', 0),
(46, 'H7', 0),
(47, 'H8', 0);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE IF NOT EXISTS `school` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(175) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `name`) VALUES
(3, 'Facultad de Ingeniería'),
(2, 'Facultad de Ingeniería Química'),
(1, 'Facultad de Matemáticas');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`id` int(10) unsigned NOT NULL,
  `status` varchar(45) NOT NULL COMMENT 'Indica el estado en el que se encuentra el equipo que puede ser: almacenado, operativo, refacciones, descompuesto... '
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Activo'),
(7, 'Asignado'),
(2, 'Baja'),
(4, 'En Reparación'),
(5, 'Garantía'),
(8, 'Prestado'),
(6, 'Refacciones'),
(3, 'Resguardado');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(10) unsigned NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `name` varchar(175) NOT NULL,
  `password_hash` varchar(175) NOT NULL,
  `auth_key` varchar(128) NOT NULL,
  `access_token` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `name`, `password_hash`, `auth_key`, `access_token`) VALUES
(1, 'admin', 'RGH', '$2y$13$5IeRyDfZfgYDl7tGDXs8OugSdBm2Dz.rx/J7P8Lg/80ZpY/YNvgd6', 'u5FJzG0dqAdLGIGQJIrv4T5Jgvhvn_3Y', '8hss6WKuAnBJJykrYEsl941N1PDN3FYr');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `assignation`
--
ALTER TABLE `assignation`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_assignation_client1_idx` (`client_id`), ADD KEY `fk_assignation_equipment1_idx` (`equipment_id`), ADD KEY `fk_assignation_room1_idx` (`room_id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
 ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
 ADD PRIMARY KEY (`name`), ADD KEY `rule_name` (`rule_name`), ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
 ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
 ADD PRIMARY KEY (`name`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user_UNIQUE` (`client_id`), ADD KEY `fk_client_user_type1_idx` (`client_type_id`), ADD KEY `fk_client_discipline1_idx` (`discipline_id`);

--
-- Indexes for table `client_type`
--
ALTER TABLE `client_type`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `type_UNIQUE` (`type`);

--
-- Indexes for table `discipline`
--
ALTER TABLE `discipline`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_discipline_area1_idx` (`area_id`), ADD KEY `fk_discipline_school1_idx` (`school_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `computer_inventory_id_UNIQUE` (`inventory`), ADD KEY `fk_computer_status1_idx` (`status_id`), ADD KEY `fk_computer_room1_idx` (`room_id`), ADD KEY `fk_equipment_equipment_type1_idx` (`type_id`);

--
-- Indexes for table `equipment_type`
--
ALTER TABLE `equipment_type`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `incident`
--
ALTER TABLE `incident`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_incident_equipment1_idx` (`equipment_id`), ADD KEY `fk_incident_room1_idx` (`room_id`), ADD KEY `fk_incident_client1_idx` (`client_id`), ADD KEY `fk_incident_user1_idx` (`user_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_log_equipment1_idx` (`equipment_id`), ADD KEY `fk_log_status1_idx` (`status_id`), ADD KEY `fk_log_user1_idx` (`user_id`), ADD KEY `fk_log_log_type1_idx` (`log_type_id`);

--
-- Indexes for table `log_type`
--
ALTER TABLE `log_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `status_UNIQUE` (`status`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `access_token_UNIQUE` (`access_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `assignation`
--
ALTER TABLE `assignation`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `client_type`
--
ALTER TABLE `client_type`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `discipline`
--
ALTER TABLE `discipline`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `equipment_type`
--
ALTER TABLE `equipment_type`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `incident`
--
ALTER TABLE `incident`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log_type`
--
ALTER TABLE `log_type`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignation`
--
ALTER TABLE `assignation`
ADD CONSTRAINT `fk_assignation_client1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_assignation_equipment1` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_assignation_room1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client`
--
ALTER TABLE `client`
ADD CONSTRAINT `fk_client_discipline1` FOREIGN KEY (`discipline_id`) REFERENCES `discipline` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_client_user_type1` FOREIGN KEY (`client_type_id`) REFERENCES `client_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `discipline`
--
ALTER TABLE `discipline`
ADD CONSTRAINT `fk_discipline_area1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_discipline_school1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
ADD CONSTRAINT `fk_computer_room1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_computer_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_equipment_equipment_type1` FOREIGN KEY (`type_id`) REFERENCES `equipment_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `incident`
--
ALTER TABLE `incident`
ADD CONSTRAINT `fk_incident_client1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_incident_equipment1` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_incident_room1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_incident_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
ADD CONSTRAINT `fk_log_equipment1` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_log_log_type1` FOREIGN KEY (`log_type_id`) REFERENCES `log_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_log_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_log_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
