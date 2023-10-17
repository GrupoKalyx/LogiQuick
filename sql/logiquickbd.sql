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
-- Table `Camioneros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Camioneros` (
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
    REFERENCES `Camioneros` (`ci`)
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
  `numBulto` INT NOT NULL AUTO_INCREMENT,
  `fechaLlegadaQc`DATE NULL,
  `fechaEntrega` DATE NULL,
  `calle` VARCHAR(45) NULL,
  `localidad` VARCHAR(45) NULL,
  `departamento` VARCHAR(45) NULL,
  `num` INT NULL,
  `gmailCliente` VARCHAR(45) NULL,
  `idRastreo` INT NULL,
  `lat` VARCHAR(16) NULL,
  `lng` VARCHAR(16) NULL,
  PRIMARY KEY (`numBulto`));

-- -----------------------------------------------------
-- Table `Lotes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Lotes` (
  `idLote` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idLote`));

-- -----------------------------------------------------
-- Table `Entregan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Entregan` (
  `fecha_llegada` DATE NOT NULL,
  `fecha_salida` DATE NULL,
  `matricula` VARCHAR(45) NOT NULL,
  `numBulto` INT NOT NULL,
  PRIMARY KEY (`numBulto`, `matricula`),
    FOREIGN KEY (`numBulto`)
    REFERENCES `Paquetes` (`numBulto`)
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
  `numBulto` INT NOT NULL,
  `idLote` INT NOT NULL,
  PRIMARY KEY (`numBulto`, `idLote`),
    FOREIGN KEY (`numBulto`)
    REFERENCES `Paquetes` (`numBulto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`idLote`)
    REFERENCES `Lotes` (`idLote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- -----------------------------------------------------
-- Table `llevan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`llevan` (
  `matricula` VARCHAR(45) NOT NULL,
  `idLote` INT NOT NULL,
  `numBulto` INT NOT NULL,
  `fecha_salida` DATE NULL,
  `fecha_llegada` DATE NULL,
  PRIMARY KEY (`matricula`, `numBulto`, `idLote`),
    FOREIGN KEY (`numBulto`)
    REFERENCES `Lotean` (`numBulto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`idLote`)
    REFERENCES `Lotean` (`idLote`)
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
  `idAlmacen` INT NOT NULL,
  `calle` VARCHAR(45) NULL,
  `departamento` VARCHAR(45) NULL,
  `localidad` VARCHAR(45) NULL,
  `num` INT NULL,
  `lat` VARCHAR(16) NULL,
  `lng` VARCHAR(16) NULL,
  PRIMARY KEY (`idAlmacen`));

-- -----------------------------------------------------
-- Table `Van`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Van` (
  `idLote` INT NOT NULL,
  `idAlmacen` INT NOT NULL,
  PRIMARY KEY (`idLote`, `idAlmacen`),
    FOREIGN KEY (`idLote`)
    REFERENCES `Lotean` (`idLote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`idAlmacen`)
    REFERENCES `Almacenes` (`idAlmacen`)
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
  `ci` INT NULL,
  `token` VARCHAR(128) NOT NULL,
  `tokenExp` int(11) NOT NULL,
  PRIMARY KEY (`ci`));