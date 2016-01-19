-- MySQL Script generated by MySQL Workbench
-- 01/18/16 17:46:26
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema default_schema
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `area`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `area` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(175) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;

INSERT INTO `area` (`id`, `name`) VALUES
(1, 'Computación'),
(2, 'Matemáticas'),
(3, 'Otra');

-- -----------------------------------------------------
-- Table `school`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `school` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(175) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;

INSERT INTO `school` (`id`, `name`) VALUES
(3, 'Facultad de Ingeniería'),
(2, 'Facultad de Ingeniería Química'),
(1, 'Facultad de Matemáticas');

-- -----------------------------------------------------
-- Table `discipline`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `discipline` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `school_id` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(175) NOT NULL,
  `short_name` VARCHAR(20) NOT NULL,
  `area_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_discipline_area1_idx` (`area_id` ASC),
  INDEX `fk_discipline_school1_idx` (`school_id` ASC),
  CONSTRAINT `fk_discipline_area1`
    FOREIGN KEY (`area_id`)
    REFERENCES `area` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_discipline_school1`
    FOREIGN KEY (`school_id`)
    REFERENCES `school` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;

INSERT INTO `discipline` (`id`, `school_id`, `name`, `short_name`, `area_id`) VALUES
(1, 1, 'Licenciatura en Matemáticas', 'LM', 2),
(2, 1, 'Licenciatura en Enseñanza de las Matemáticas', 'LEM', 2),
(3, 1, 'Licenciatura en Actuaría', 'LA', 2),
(4, 1, 'Licenciatura en Ciencias de la Computación', 'LCC', 1),
(5, 1, 'Licenciatura en Ingeniería de Software', 'LIS', 1),
(6, 1, 'Licenciatura en Ingeniería en Computación', 'LIC', 1),
(7, 3, 'Licenciatura en Ingeniería Civil', 'LI', 3),
(8, 2, 'Licenciatura en Ingeniería Química', 'LIQ', 3);

-- -----------------------------------------------------
-- Table `client_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `client_type` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `type_UNIQUE` (`type` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;

INSERT INTO `client_type` (`id`, `type`) VALUES
(2, 'Académico'),
(3, 'Administrativo'),
(1, 'Alumno'),
(4, 'Externo');

-- -----------------------------------------------------
-- Table `client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `client` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` VARCHAR(30) NOT NULL COMMENT 'Puede ser matrícula, clave de empleado o e-mail',
  `first_name` VARCHAR(175) NOT NULL,
  `last_name` VARCHAR(175) NOT NULL,
  `client_type_id` INT(10) UNSIGNED NOT NULL,
  `discipline_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `active` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_UNIQUE` (`client_id` ASC),
  INDEX `fk_client_user_type1_idx` (`client_type_id` ASC),
  INDEX `fk_client_discipline1_idx` (`discipline_id` ASC),
  CONSTRAINT `fk_client_discipline1`
    FOREIGN KEY (`discipline_id`)
    REFERENCES `discipline` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_client_user_type1`
    FOREIGN KEY (`client_type_id`)
    REFERENCES `client_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `room`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `room` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `available` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 48
DEFAULT CHARACTER SET = utf8;

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

-- -----------------------------------------------------
-- Table `equipment_status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipment_status` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) NOT NULL COMMENT 'Indica el estado en el que se encuentra el equipo que puede ser: almacenado, operativo, refacciones, descompuesto... ',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `status_UNIQUE` (`status` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;

INSERT INTO `equipment_status` (`id`, `status`) VALUES
(1, 'Activo'),
(7, 'Asignado'),
(2, 'Baja'),
(4, 'En Reparación'),
(5, 'Garantía'),
(8, 'Prestado'),
(6, 'Refacciones'),
(3, 'Resguardado');

-- -----------------------------------------------------
-- Table `equipment_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipment_type` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8;

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

-- -----------------------------------------------------
-- Table `location`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `location` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `location` VARCHAR(45) NOT NULL,
  `room_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_location_room1_idx` (`room_id` ASC),
  CONSTRAINT `fk_location_room1`
    FOREIGN KEY (`room_id`)
    REFERENCES `room` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipment` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `inventory` VARCHAR(30) NOT NULL,
  `description` VARCHAR(175) NOT NULL,
  `serial_number` VARCHAR(175) NOT NULL,
  `equipment_status_id` INT(10) UNSIGNED NOT NULL,
  `room_id` INT(10) UNSIGNED NOT NULL,
  `location_id` INT(10) UNSIGNED NULL COMMENT 'Registra la posición que se le asigna a un equipo en una sala o el nombre de una persona',
  `available` TINYINT(1) NOT NULL DEFAULT '1' COMMENT 'Este campo registra si un equipo va a estar disponible en una sala para asignarlo a un cliente',
  `type_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `computer_inventory_id_UNIQUE` (`inventory` ASC),
  INDEX `fk_computer_status1_idx` (`equipment_status_id` ASC),
  INDEX `fk_computer_room1_idx` (`room_id` ASC),
  INDEX `fk_equipment_equipment_type1_idx` (`type_id` ASC),
  INDEX `fk_equipment_location1_idx` (`location_id` ASC),
  CONSTRAINT `fk_computer_room1`
    FOREIGN KEY (`room_id`)
    REFERENCES `room` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_computer_status1`
    FOREIGN KEY (`equipment_status_id`)
    REFERENCES `equipment_status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipment_equipment_type1`
    FOREIGN KEY (`type_id`)
    REFERENCES `equipment_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipment_location1`
    FOREIGN KEY (`location_id`)
    REFERENCES `location` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `assignation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `assignation` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL,
  `client_id` INT(10) UNSIGNED NOT NULL,
  `room_id` INT(10) UNSIGNED NOT NULL,
  `location_id` INT(10) UNSIGNED NOT NULL,
  `equipment_id` INT(10) UNSIGNED NOT NULL,
  `purpose` VARCHAR(170) NULL,
  `duration` INT(10) UNSIGNED NOT NULL COMMENT 'el tiempo se guardará en segundos y se convertirá a horas según la vista de usuario',
  `start_time` TIME NOT NULL,
  `end_time` TIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_assignation_client1_idx` (`client_id` ASC),
  INDEX `fk_assignation_equipment1_idx` (`equipment_id` ASC),
  INDEX `fk_assignation_room1_idx` (`room_id` ASC),
  INDEX `fk_assignation_location1_idx` (`location_id` ASC),
  CONSTRAINT `fk_assignation_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `client` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assignation_equipment1`
    FOREIGN KEY (`equipment_id`)
    REFERENCES `equipment` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assignation_room1`
    FOREIGN KEY (`room_id`)
    REFERENCES `room` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assignation_location1`
    FOREIGN KEY (`location_id`)
    REFERENCES `location` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `auth_rule`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` VARCHAR(64) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `data` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `created_at` INT(11) NULL DEFAULT NULL,
  `updated_at` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`name`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `auth_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` VARCHAR(64) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `type` INT(11) NOT NULL,
  `description` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `rule_name` VARCHAR(64) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `data` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `created_at` INT(11) NULL DEFAULT NULL,
  `updated_at` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`name`),
  INDEX `rule_name` (`rule_name` ASC),
  INDEX `idx-auth_item-type` (`type` ASC),
  CONSTRAINT `auth_item_ibfk_1`
    FOREIGN KEY (`rule_name`)
    REFERENCES `auth_rule` (`name`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('administrator', 1, NULL, NULL, NULL, 1447892934, 1447892934),
('normaluser', 1, NULL, NULL, NULL, 1452113206, 1452113206),
('operator', 1, NULL, NULL, NULL, 1453157257, 1453157257);

-- -----------------------------------------------------
-- Table `auth_assignment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` VARCHAR(64) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `user_id` VARCHAR(64) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `created_at` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`),
  CONSTRAINT `auth_assignment_ibfk_1`
    FOREIGN KEY (`item_name`)
    REFERENCES `auth_item` (`name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('administrator', '1', 1447892934),
('normaluser', '2', 1452113206),
('normaluser', '3', 1452113206),
('normaluser', '4', 1452113206),
('operator', '5', 1453157257),
('operator', '6', 1453157257),
('operator', '7', 1453157257);

-- -----------------------------------------------------
-- Table `auth_item_child`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` VARCHAR(64) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `child` VARCHAR(64) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  PRIMARY KEY (`parent`, `child`),
  INDEX `child` (`child` ASC),
  CONSTRAINT `auth_item_child_ibfk_1`
    FOREIGN KEY (`parent`)
    REFERENCES `auth_item` (`name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2`
    FOREIGN KEY (`child`)
    REFERENCES `auth_item` (`name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `user` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(50) NOT NULL,
  `name` VARCHAR(175) NOT NULL,
  `password_hash` VARCHAR(175) NOT NULL,
  `auth_key` VARCHAR(128) NOT NULL,
  `access_token` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `access_token_UNIQUE` (`access_token` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;

INSERT INTO `user` (`id`, `user_name`, `name`, `password_hash`, `auth_key`, `access_token`) VALUES
(1, 'admin', 'RGH', '$2y$13$rzPu0zS5g21n8b8XqxBPlO6jEe.2qas2Da4sfGDzhoMM98j1.NNNK', 'u5FJzG0dqAdLGIGQJIrv4T5Jgvhvn_3Y', '8hss6WKuAnBJJykrYEsl941N1PDN3FYr'),
(2, 'UsuarioNormal1', 'usuarionormal1', '$2y$13$y8ekyKrQx4oEqGjB0o2eouGQkAapWOMoV6C4QNc/F4rZ9OkmDbUAO', 'tB8eOussHcH4V9LTUzEN9a2r-45mQ1hn', 'b4-xEo8l_85ymrnBWXMW0lGg5lhsLqWN'),
(3, 'UsuarioNormal2', 'usuarionormal2', '$2y$13$GcTzVtUl99cTjOrBfU1aLe6ng/aL49nGxeW5tD0x5U41foKP5e2qC', 'k-ZrKPjhpU4ivtXpZeY5vVojMIiCnEgD', 'EoiX-gS-UP-8Pfw2ANb3UHre8M_EQUSU'),
(4, 'UsuarioNormal3', 'usuarionormal3', '$2y$13$kBaNc0jpZMi8/6GzI9SomuCk6KQl75gkSHSdIvfYwLwZ3XrQxZbY.', 'CoJawZN4_G7jfcEGqH7aosbZFAuhkW7j', 'ivCrSRF2WvpbIt1198Y3Ctki0rEyMdp3'),
(5, 'Operador1', 'operdor1', '$2y$13$.W6a/qgp6t3nqgxU1fL.j.2tiNl/1DGMQImqfp4mSVfXTO.TnQUQK', 'oAAE58Byl99NJ0PnZ-OOfYEZxwxQIgC3', '753HpCEXDQfdf1GqdwV5wq31pLLPtx9D'),
(6, 'Operador2', 'operador2', '$2y$13$D7aiu1MgZPlYcJWOilGKvOXzZLcvkz0ERogOl.1.zK3AoI.wGlXsy', 'umTTrTeW_V8hW4Qd1txVbEkmiMJJDyqE', 'GwhSXFRzA6hxd2SfEyyH7k9Ojmuj1C4E'),
(7, 'Operador3', 'operador3', '$2y$13$3xGaRiQ111vssjunGOAyseEUfYqTbzDwXh.dTFjpzE37ZC02UM41u', 'Bb68juHYfwOaWat5H5xEOrhb1A6Ce3WT', 'w9aOJkTS6Dk29eXmZsncWyiPeETQvblT');

-- -----------------------------------------------------
-- Table `incident`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incident` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL,
  `equipment_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `room_id` INT(10) UNSIGNED NOT NULL,
  `description` TEXT NOT NULL,
  `solved` TINYINT(1) NOT NULL DEFAULT '0',
  `date_solved` DATETIME NULL DEFAULT NULL,
  `client_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `user_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_incident_equipment1_idx` (`equipment_id` ASC),
  INDEX `fk_incident_room1_idx` (`room_id` ASC),
  INDEX `fk_incident_client1_idx` (`client_id` ASC),
  INDEX `fk_incident_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_incident_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `client` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_incident_equipment1`
    FOREIGN KEY (`equipment_id`)
    REFERENCES `equipment` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_incident_room1`
    FOREIGN KEY (`room_id`)
    REFERENCES `room` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_incident_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `log_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `log_type` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(45) NOT NULL COMMENT 'indica el tipo de operación como: altas, bajas o cambios.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;

INSERT INTO `log_type` (`id`, `type`) VALUES
(1, 'Alta'),
(2, 'Baja'),
(3, 'Actualización');

-- -----------------------------------------------------
-- Table `log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `log` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(10) UNSIGNED NOT NULL,
  `date` DATETIME NOT NULL,
  `log_type_id` INT(10) UNSIGNED NOT NULL,
  `equipment_type` VARCHAR(45) NOT NULL,
  `inventory` VARCHAR(30) NOT NULL,
  `equipment_id` INT(10) UNSIGNED NOT NULL,
  `room_id` INT(10) UNSIGNED NOT NULL,
  `location` VARCHAR(45) NOT NULL,
  `equipment_status_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_log_equipment1_idx` (`equipment_id` ASC),
  INDEX `fk_log_status1_idx` (`equipment_status_id` ASC),
  INDEX `fk_log_user1_idx` (`user_id` ASC),
  INDEX `fk_log_log_type1_idx` (`log_type_id` ASC),
  CONSTRAINT `fk_log_equipment1`
    FOREIGN KEY (`equipment_id`)
    REFERENCES `equipment` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_log_type1`
    FOREIGN KEY (`log_type_id`)
    REFERENCES `log_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_status1`
    FOREIGN KEY (`equipment_status_id`)
    REFERENCES `equipment_status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `migration`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `migration` (
  `version` VARCHAR(180) NOT NULL,
  `apply_time` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`version`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1447890118);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
