-- -----------------------------------------------------
-- Schema logiquickbd
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `logiquickbd` DEFAULT CHARACTER SET utf8 ;
USE `logiquickbd` ;

-- -----------------------------------------------------
-- Table `logiquickbd`.`Vehiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Vehiculos` (
  `matricula` VARCHAR(45) NOT NULL,
  `disponibilidad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`matricula`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Pick_ups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Pick_ups` (
  `matricula` VARCHAR(45) NOT NULL,
  `disponibilidad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`matricula`),
    FOREIGN KEY (`matricula`)
    REFERENCES `logiquickbd`.`Vehiculos` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Camiones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Camiones` (
  `matricula` VARCHAR(45) NOT NULL,
  `disponibilidad` VARCHAR(45) NULL,
  PRIMARY KEY (`matricula`),
    FOREIGN KEY (`matricula`)
    REFERENCES `logiquickbd`.`Vehiculos` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Conductores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Conductores` (
  `ci` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `telefono` INT NULL,
  PRIMARY KEY (`ci`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Delivery`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Delivery` (
  `ci` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `telefono` INT NULL,
  PRIMARY KEY (`ci`),
    FOREIGN KEY (`ci`)
    REFERENCES `logiquickbd`.`Conductores` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Manejan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Manejan` (
  `matricula` INT NOT NULL,
  `fecha_llegada` DATE NULL,
  `fecha_salida` DATE NULL,
  `ci` INT NOT NULL,
  PRIMARY KEY (`matricula`, `ci`),
    FOREIGN KEY (`matricula`)
    REFERENCES `logiquickbd`.`Pick_ups` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`ci`)
    REFERENCES `logiquickbd`.`Delivery` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Camionero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Camionero` (
  `ci` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `telefono` INT NULL,
  PRIMARY KEY (`ci`),
    FOREIGN KEY (`ci`)
    REFERENCES `logiquickbd`.`Conductores` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Conducen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Conducen` (
  `matricula` INT NOT NULL,
  `fecha_llegada` DATE NULL,
  `fecha_salida` DATE NULL,
  `ci` INT NOT NULL,
  PRIMARY KEY (`matricula`, `ci`),
    FOREIGN KEY (`ci`)
    REFERENCES `logiquickbd`.`Camionero` (`ci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`matricula`)
    REFERENCES `logiquickbd`.`Camiones` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Paquetes`
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
  `fecha_llegada_QC` DATE NULL,
  PRIMARY KEY (`id_Paquete`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Lotes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Lotes` (
  `id_Lote` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_Lote`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Entregan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Entregan` (
  `fecha_llegada` DATE NOT NULL,
  `fecha_salida` DATE NULL,
  `matricula` VARCHAR(45) NOT NULL,
  `id_Paquete` INT NOT NULL,
  PRIMARY KEY (`id_Paquete`, `matricula`),
    FOREIGN KEY (`id_Paquete`)
    REFERENCES `logiquickbd`.`Paquetes` (`id_Paquete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY ()
    REFERENCES `logiquickbd`.`Pick_ups` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Lotean`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Lotean` (
  `id_Paquete` INT NOT NULL,
  `id_Lote` INT NOT NULL,
  PRIMARY KEY (`id_Paquete`, `id_Lote`),
    FOREIGN KEY (`id_Paquete`)
    REFERENCES `logiquickbd`.`Paquetes` (`id_Paquete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`id_Lote`)
    REFERENCES `logiquickbd`.`Lotes` (`id_Lote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`llevan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`llevan` (
  `matricula` VARCHAR(45) NOT NULL,
  `id_Lote` INT NOT NULL,
  `id_Paquete` INT NOT NULL,
  `fecha_salida` DATE NULL,
  `fecha_llegada` DATE NULL,
  PRIMARY KEY (`matricula`, `id_Paquete`, `id_Lote`),
    FOREIGN KEY (`id_Paquete`)
    REFERENCES `logiquickbd`.`Lotean` (`id_Paquete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`id_Lote`)
    REFERENCES `logiquickbd`.`Lotean` (`id_Lote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`matricula`)
    REFERENCES `logiquickbd`.`Camiones` (`matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Almacenes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Almacenes` (
  `num_Almacen` INT NOT NULL,
  `calle` VARCHAR(45) NULL,
  `departamento` VARCHAR(45) NULL,
  `localidad` VARCHAR(45) NULL,
  `N_puerta` INT NULL,
  PRIMARY KEY (`num_Almacen`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logiquickbd`.`Van`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logiquickbd`.`Van` (
  `id_Lote` INT NOT NULL,
  `id_Paquete` INT NOT NULL,
  `num_Almacen` INT NOT NULL,
  PRIMARY KEY (`id_Lote`, `id_Paquete`, `num_Almacen`),
    FOREIGN KEY (`id_Lote`)
    REFERENCES `logiquickbd`.`Lotean` (`id_Lote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`id_Paquete`)
    REFERENCES `logiquickbd`.`Lotean` (`id_Paquete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`num_Almacen`)
    REFERENCES `logiquickbd`.`Almacenes` (`num_Almacen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;