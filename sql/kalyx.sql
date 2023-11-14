-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


-- -----------------------------------------------------
-- Table `almacenes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almacenes` (
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
-- Table `conductores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `conductores` (
  `ci` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `telefono` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ci`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `camioneros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `camioneros` (
  `ci` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `telefono` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ci`),
  
    FOREIGN KEY (`ci`)
    REFERENCES `conductores` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `vehiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vehiculos` (
  `matricula` VARCHAR(7) NOT NULL,
  `disponibilidad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`matricula`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `camiones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `camiones` (
  `matricula` VARCHAR(7) NOT NULL,
  `disponibilidad` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`matricula`),
 
    FOREIGN KEY (`matricula`)
    REFERENCES `vehiculos` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `conducen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `conducen` (
  `matricula` VARCHAR(7) NOT NULL,
  `fecha_llegada` DATETIME NULL DEFAULT NULL,
  `fecha_salida` DATETIME NULL DEFAULT NULL,
  `ci` INT(11) NOT NULL,
  PRIMARY KEY (`matricula`, `ci`),
 
    FOREIGN KEY (`ci`)
    REFERENCES `camioneros` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`matricula`)
    REFERENCES `camiones` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `deliverys`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deliverys` (
  `ci` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `telefono` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ci`),
 
    FOREIGN KEY (`ci`)
    REFERENCES `conductores` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `paquetes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `paquetes` (
  `numBulto` INT(11) NOT NULL AUTO_INCREMENT,
  `fechaCreacion` DATETIME NULL DEFAULT NULL,
  `fechaEntrega` DATETIME NULL DEFAULT NULL,
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
-- Table `pickups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pickups` (
  `matricula` VARCHAR(7) NOT NULL,
  `disponibilidad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`matricula`),
 
    FOREIGN KEY (`matricula`)
    REFERENCES `vehiculos` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entregan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `entregan` (
  `fecha_llegada` DATETIME NOT NULL,
  `fecha_salida` DATETIME NULL DEFAULT NULL,
  `matricula` VARCHAR(7) NOT NULL,
  `numBulto` INT(11) NOT NULL,
  PRIMARY KEY (`numBulto`, `matricula`),
 
    FOREIGN KEY (`numBulto`)
    REFERENCES `paquetes` (`numBulto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`matricula`)
    REFERENCES `pickups` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `lotes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lotes` (
  `idLote` INT(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idLote`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Rutas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rutas` (
  `numRuta` INT NOT NULL,
  `departamentos` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`numRuta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Almacen-Rutas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almacen_rutas` (
  `idAlmacen` INT NOT NULL,
  `numRuta` INT NOT NULL,
  PRIMARY KEY (`idAlmacen`, `numRuta`),
 
    FOREIGN KEY (`idAlmacen`)
    REFERENCES `almacenes` (`idAlmacen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`numRuta`)
    REFERENCES `Rutas` (`numRuta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lotes_almacen_rutas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lotes_almacen_rutas` (
  `idLote` INT NOT NULL,
  `idAlmacen` INT NOT NULL,
  `numRuta` INT NOT NULL,
  PRIMARY KEY (`idLote`, `idAlmacen`, `numRuta`),
 
    FOREIGN KEY (`idLote`)
    REFERENCES `lotes` (`idLote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`idAlmacen`)
    REFERENCES `Almacen_Rutas` (`idAlmacen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`numRuta`)
    REFERENCES `Almacen_Rutas` (`numRuta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `llevan` (
  `matricula` VARCHAR(7) NOT NULL,
  `idLote` INT(11) NOT NULL,
  `idAlmacen` INT NOT NULL,
  `numRuta` INT NOT NULL,
  `fecha_salida` DATETIME NULL DEFAULT NULL,
  `fecha_llegada` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`matricula`, `idLote`, `idAlmacen`, `numRuta`),
  
    FOREIGN KEY (`matricula`)
    REFERENCES `camiones` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`idLote`)
    REFERENCES `lotes_almacen_rutas` (`idLote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`idAlmacen`)
    REFERENCES `lotes_almacen_rutas` (`idAlmacen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  
    FOREIGN KEY (`numRuta`)
    REFERENCES `lotes_almacen_rutas` (`numRuta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `lotean`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lotean` (
  `numBulto` INT(11) NOT NULL,
  `idLote` INT(11) NOT NULL,
  PRIMARY KEY (`numBulto`, `idLote`),
 
    FOREIGN KEY (`numBulto`)
    REFERENCES `paquetes` (`numBulto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`idLote`)
    REFERENCES `lotes` (`idLote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `manejan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `manejan` (
  `matricula` VARCHAR(7) NOT NULL,
  `fecha_llegada` DATETIME NULL DEFAULT NULL,
  `fecha_salida` DATETIME NULL DEFAULT NULL,
  `ci` INT(11) NOT NULL,
  PRIMARY KEY (`matricula`, `ci`),
 
    FOREIGN KEY (`matricula`)
    REFERENCES `pickups` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  
    FOREIGN KEY (`ci`)
    REFERENCES `deliverys` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuarios` (
  `ci` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `tipo` VARCHAR(45) NULL DEFAULT NULL,
  `contrasenia` VARCHAR(45) NULL DEFAULT NULL,
  `token` VARCHAR(128) NULL,
  `tokenExp` INT(11) NULL,
  PRIMARY KEY (`ci`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
