-- -----------------------------------------------------
-- Schema logiquickbd
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `logiquickbd` DEFAULT CHARACTER SET utf8 ;
USE `logiquickbd`;

-- -----------------------------------------------------
-- Table `Vehiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Vehiculos` (
  `matricula` VARCHAR(45) NOT NULL,
  `disponibilidad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`matricula`));

-- -----------------------------------------------------
-- Table `Pick_ups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Pick_ups` (
  `matricula` VARCHAR(45) NOT NULL,
  `disponibilidad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`matricula`),
    FOREIGN KEY (`matricula`)
    REFERENCES `Vehiculos` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- -----------------------------------------------------
-- Table `Camiones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Camiones` (
  `matricula` VARCHAR(45) NOT NULL,
  `disponibilidad` VARCHAR(45) NULL,
  PRIMARY KEY (`matricula`),
    FOREIGN KEY (`matricula`)
    REFERENCES `Vehiculos` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `Conductores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Conductores` (
  `ci` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `telefono` INT NULL,
  PRIMARY KEY (`ci`));

-- -----------------------------------------------------
-- Table `Deliverys`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Deliverys` (
  `ci` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `telefono` INT NULL,
  PRIMARY KEY (`ci`),
    FOREIGN KEY (`ci`)
    REFERENCES `Conductores` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- -----------------------------------------------------
-- Table `Manejan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Manejan` (
  `matricula` VARCHAR(45) NOT NULL,
  `fecha_llegada` DATE NULL,
  `fecha_salida` DATE NULL,
  `ci` INT NOT NULL,
  PRIMARY KEY (`matricula`, `ci`),
    FOREIGN KEY (`matricula`)
    REFERENCES `Pick_ups` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`ci`)
    REFERENCES `Deliverys` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- -----------------------------------------------------
-- Table `Camionero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Camionero` (
  `ci` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `telefono` INT NULL,
  PRIMARY KEY (`ci`),
    FOREIGN KEY (`ci`)
    REFERENCES `Conductores` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- -----------------------------------------------------
-- Table `Conducen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Conducen` (
  `matricula` VARCHAR(45) NOT NULL,
  `fecha_llegada` DATE NULL,
  `fecha_salida` DATE NULL,
  `ci` INT NOT NULL,
  PRIMARY KEY (`matricula`, `ci`),
    FOREIGN KEY (`ci`)
    REFERENCES `Camionero` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`matricula`)
    REFERENCES `Camiones` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- -----------------------------------------------------
-- Table `Paquetes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Paquetes` (
  `id_Paquete` INT NOT NULL AUTO_INCREMENT,
  `fecha_entrega` DATE NULL,
  `calle` VARCHAR(45) NULL,
  `localidad` VARCHAR(45) NULL,
  `departamento` VARCHAR(45) NULL,
  `N_puerta` INT NULL,
  `gmail_cliente` VARCHAR(45) NULL,
  `id_Rastreo` INT NULL,
  `coordenadas` VARCHAR(32) NULL,
  `fecha_llegada_QC` DATE NULL,
  PRIMARY KEY (`id_Paquete`));

-- -----------------------------------------------------
-- Table `Lotes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Lotes` (
  `id_Lote` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_Lote`));

-- -----------------------------------------------------
-- Table `Entregan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Entregan` (
  `fecha_llegada` DATE NOT NULL,
  `fecha_salida` DATE NULL,
  `matricula` VARCHAR(45) NOT NULL,
  `id_Paquete` INT NOT NULL,
  PRIMARY KEY (`id_Paquete`, `matricula`),
    FOREIGN KEY (`id_Paquete`)
    REFERENCES `Paquetes` (`id_Paquete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`matricula`)
    REFERENCES `Pick_ups` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `Lotean`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Lotean` (
  `id_Paquete` INT NOT NULL,
  `id_Lote` INT NOT NULL,
  PRIMARY KEY (`id_Paquete`, `id_Lote`),
    FOREIGN KEY (`id_Paquete`)
    REFERENCES `Paquetes` (`id_Paquete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`id_Lote`)
    REFERENCES `Lotes` (`id_Lote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- -----------------------------------------------------
-- Table `llevan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`llevan` (
  `matricula` VARCHAR(45) NOT NULL,
  `id_Lote` INT NOT NULL,
  `id_Paquete` INT NOT NULL,
  `fecha_salida` DATE NULL,
  `fecha_llegada` DATE NULL,
  PRIMARY KEY (`matricula`, `id_Paquete`, `id_Lote`),
    FOREIGN KEY (`id_Paquete`)
    REFERENCES `Lotean` (`id_Paquete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`id_Lote`)
    REFERENCES `Lotean` (`id_Lote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`matricula`)
    REFERENCES `Camiones` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `Almacenes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Almacenes` (
  `num_Almacen` INT NOT NULL,
  `calle` VARCHAR(45) NULL,
  `departamento` VARCHAR(45) NULL,
  `localidad` VARCHAR(45) NULL,
  `N_puerta` INT NULL,
  `coordenadas` VARCHAR(32) NULL,
  PRIMARY KEY (`num_Almacen`));

-- -----------------------------------------------------
-- Table `Van`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Van` (
  `id_Lote` INT NOT NULL,
  `id_Paquete` INT NOT NULL,
  `num_Almacen` INT NOT NULL,
  PRIMARY KEY (`id_Lote`, `id_Paquete`, `num_Almacen`),
    FOREIGN KEY (`id_Lote`)
    REFERENCES `Lotean` (`id_Lote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`id_Paquete`)
    REFERENCES `Lotean` (`id_Paquete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`num_Almacen`)
    REFERENCES `Almacenes` (`num_Almacen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- -----------------------------------------------------
-- Table `Usuarios`
-- -----------------------------------------------------
 CREATE TABLE IF NOT EXISTS `logiquickbd`.`Usuarios` (
  `ci` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `tipo` VARCHAR(45) NULL,
  PRIMARY KEY (`ci`));

-- -----------------------------------------------------
-- Table `Logins`
-- -----------------------------------------------------
 CREATE TABLE IF NOT EXISTS `logiquickbd`.`Logins` (
  `idLogin` INT NOT NULL,
  `contrasenia` VARCHAR(45) NULL,
  PRIMARY KEY (`idLogin`));    
 
-- -----------------------------------------------------
-- Table `tokens`
-- -----------------------------------------------------
 CREATE TABLE IF NOT EXISTS `logiquickbd`.`tokens` (
  `idToken` INT NOT NULL,
  `ci` INT NULL,
  PRIMARY KEY (`idToken`));    