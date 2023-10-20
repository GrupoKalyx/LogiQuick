-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema logiquickbd
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema logiquickbd
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `logiquickbd` DEFAULT CHARACTER SET utf8 ;
USE `logiquickbd` ;

-- -----------------------------------------------------
-- Table `logiquickbd`.`almacenes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`almacenes` (
  `idAlmacen` INT(11) NOT NULL,
  `calle` VARCHAR(45) NULL DEFAULT NULL,
  `departamento` VARCHAR(45) NULL DEFAULT NULL,
  `localidad` VARCHAR(45) NULL DEFAULT NULL,
  `num` INT(11) NULL DEFAULT NULL,
  `lat` VARCHAR(16) NULL DEFAULT NULL,
  `lng` VARCHAR(16) NULL DEFAULT NULL,
  PRIMARY KEY (`idAlmacen`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`conductores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`conductores` (
  `ci` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `telefono` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ci`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`camioneros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`camioneros` (
  `ci` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `telefono` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ci`),
  
    FOREIGN KEY (`ci`)
    REFERENCES `logiquickbd`.`conductores` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`vehiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`vehiculos` (
  `matricula` VARCHAR(45) NOT NULL,
  `disponibilidad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`matricula`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`camiones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`camiones` (
  `matricula` VARCHAR(45) NOT NULL,
  `disponibilidad` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`matricula`),
 
    FOREIGN KEY (`matricula`)
    REFERENCES `logiquickbd`.`vehiculos` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`conducen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`conducen` (
  `matricula` VARCHAR(45) NOT NULL,
  `fecha_llegada` DATE NULL DEFAULT NULL,
  `fecha_salida` DATE NULL DEFAULT NULL,
  `ci` INT(11) NOT NULL,
  PRIMARY KEY (`matricula`, `ci`),
 
    FOREIGN KEY (`ci`)
    REFERENCES `logiquickbd`.`camioneros` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`matricula`)
    REFERENCES `logiquickbd`.`camiones` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`deliverys`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`deliverys` (
  `ci` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `telefono` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ci`),
 
    FOREIGN KEY (`ci`)
    REFERENCES `logiquickbd`.`conductores` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`paquetes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`paquetes` (
  `numBulto` INT(11) NOT NULL AUTO_INCREMENT,
  `fechaLlegadaQc` DATE NULL DEFAULT NULL,
  `fechaEntrega` DATE NULL DEFAULT NULL,
  `calle` VARCHAR(45) NULL DEFAULT NULL,
  `localidad` VARCHAR(45) NULL DEFAULT NULL,
  `departamento` VARCHAR(45) NULL DEFAULT NULL,
  `num` INT(11) NULL DEFAULT NULL,
  `gmailCliente` VARCHAR(45) NULL DEFAULT NULL,
  `idRastreo` INT(11) NULL DEFAULT NULL,
  `lat` VARCHAR(16) NULL DEFAULT NULL,
  `lng` VARCHAR(16) NULL DEFAULT NULL,
  PRIMARY KEY (`numBulto`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`pick_ups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`pick_ups` (
  `matricula` VARCHAR(45) NOT NULL,
  `disponibilidad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`matricula`),
 
    FOREIGN KEY (`matricula`)
    REFERENCES `logiquickbd`.`vehiculos` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`entregan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`entregan` (
  `fecha_llegada` DATE NOT NULL,
  `fecha_salida` DATE NULL DEFAULT NULL,
  `matricula` VARCHAR(45) NOT NULL,
  `numBulto` INT(11) NOT NULL,
  PRIMARY KEY (`numBulto`, `matricula`),
 
    FOREIGN KEY (`numBulto`)
    REFERENCES `logiquickbd`.`paquetes` (`numBulto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`matricula`)
    REFERENCES `logiquickbd`.`pick_ups` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`lotes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`lotes` (
  `idLote` INT(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idLote`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Rutas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Rutas` (
  `numRuta` INT NOT NULL,
  `departamento` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`numRuta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Almacen-Rutas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Almacen-Rutas` (
  `idAlmacen` INT NOT NULL,
  `numRuta` INT NOT NULL,
  PRIMARY KEY (`idAlmacen`, `numRuta`),
 
    FOREIGN KEY (`idAlmacen`)
    REFERENCES `logiquickbd`.`almacenes` (`idAlmacen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`numRuta`)
    REFERENCES `logiquickbd`.`Rutas` (`numRuta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`lotes-Almacen-Rutas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`lotes-Almacen-Rutas` (
  `idLote` INT NOT NULL,
  `idAlmacen` INT NOT NULL,
  `numRuta` INT NOT NULL,
  PRIMARY KEY (`idLote`, `idAlmacen`, `numRuta`),
 
    FOREIGN KEY (`idLote`)
    REFERENCES `logiquickbd`.`lotes` (`idLote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`idAlmacen`)
    REFERENCES `logiquickbd`.`Almacen-Rutas` (`idAlmacen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`numRuta`)
    REFERENCES `logiquickbd`.`Almacen-Rutas` (`numRuta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`llevan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`llevan` (
  `matricula` VARCHAR(45) NOT NULL,
  `idLote` INT(11) NOT NULL,
  `idAlmacen` INT NOT NULL,
  `numRuta` INT NOT NULL,
  `fecha_salida` DATE NULL DEFAULT NULL,
  `fecha_llegada` DATE NULL DEFAULT NULL,
  
    FOREIGN KEY (`matricula`)
    REFERENCES `logiquickbd`.`camiones` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`idLote`)
    REFERENCES `logiquickbd`.`lotes-Almacen-Rutas` (`idLote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`idAlmacen`)
    REFERENCES `logiquickbd`.`lotes-Almacen-Rutas` (`idAlmacen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  
    FOREIGN KEY (`numRuta`)
    REFERENCES `logiquickbd`.`lotes-Almacen-Rutas` (`numRuta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`lotean`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`lotean` (
  `numBulto` INT(11) NOT NULL,
  `idLote` INT(11) NOT NULL,
  PRIMARY KEY (`numBulto`, `idLote`),
 
    FOREIGN KEY (`numBulto`)
    REFERENCES `logiquickbd`.`paquetes` (`numBulto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`idLote`)
    REFERENCES `logiquickbd`.`lotes` (`idLote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`manejan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`manejan` (
  `matricula` VARCHAR(45) NOT NULL,
  `fecha_llegada` DATE NULL DEFAULT NULL,
  `fecha_salida` DATE NULL DEFAULT NULL,
  `ci` INT(11) NOT NULL,
  PRIMARY KEY (`matricula`, `ci`),
 
    FOREIGN KEY (`matricula`)
    REFERENCES `logiquickbd`.`pick_ups` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  
    FOREIGN KEY (`ci`)
    REFERENCES `logiquickbd`.`deliverys` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`usuarios` (
  `ci` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `tipo` VARCHAR(45) NULL DEFAULT NULL,
  `contrasenia` VARCHAR(45) NULL DEFAULT NULL,
  `token` VARCHAR(128) NULL,
  `tokenExp` INT(11) NULL,
  PRIMARY KEY (`ci`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logiquickbd`.`van`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`van` (
  `idLote` INT(11) NOT NULL,
  `idAlmacen` INT(11) NOT NULL,
  PRIMARY KEY (`idLote`, `idAlmacen`),
  
    FOREIGN KEY (`idLote`)
    REFERENCES `logiquickbd`.`lotean` (`idLote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`idAlmacen`)
    REFERENCES `logiquickbd`.`almacenes` (`idAlmacen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
