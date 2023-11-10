-- Informacion de Quick Carry---------------------------------------------------------------------
INSERT INTO `almacenes` (`idAlmacen`, `calle`, `departamento`, `localidad`, `num`, `lat`, `lng`) 
VALUES ('0', 'Baltimore', 'Montevideo', 'Peñarol', ' 1651', '-34.83001', '-56.19339');
-------------------------------------------------------------------------------------------------

-- Ruta 0 para envios de CRECOM a Quick Carry-----------------------------------------------------
INSERT INTO `rutas` (`numRuta`, `departamentos`) 
VALUES ('0', 'Montevideo');
-------------------------------------------------------------------------------------------------

-- Asignando Quick Carry a la RUta 0--------------------------------------------------------------
INSERT INTO `almacen_rutas` (`idAlmacen`, `numRuta`) 
VALUES ('0', '0');
-------------------------------------------------------------------------------------------------

-- Insertando paquetes----------------------------------------------------------------------------
INSERT INTO `paquetes`(`numBulto`, `fechaCreacion`, `fechaEntrega`, `calle`, `localidad`, `departamento`, `num`, `gmailCliente`, `idRastreo`, `lat`, `lng`) 
VALUES ('1', NOW(), NULL, 'S. Borrazas','Tala','Canelones','47','supergmail@gmail.com','889296133','-34.35','-55.76667');

INSERT INTO `paquetes`(`numBulto`, `fechaCreacion`, `fechaEntrega`, `calle`, `localidad`, `departamento`, `num`, `gmailCliente`, `idRastreo`, `lat`, `lng`) 
VALUES ('2', NOW(), NULL, 'S. Borrazas','Tala','Canelones','47','supergmail@gmail.com','889296134','-34.35','-55.76667');

INSERT INTO `paquetes`(`numBulto`, `fechaCreacion`, `fechaEntrega`, `calle`, `localidad`, `departamento`, `num`, `gmailCliente`, `idRastreo`, `lat`, `lng`) 
VALUES ('3', NOW(), NULL, 'S. Borrazas','Tala','Canelones','47','supergmail@gmail.com','889296135','-34.35','-55.76667');
-------------------------------------------------------------------------------------------------

-- Creando un lote 1 para los anteriores paquetes-------------------------------------------------
INSERT INTO `lotes` (`idLote`) 
VALUES (1);
-------------------------------------------------------------------------------------------------

-- Ahora el lote va a un Quick Carry-----------------------------------------------------------------
INSERT INTO `lotes_almacen_rutas` (`idLote`, `idAlmacen`, `numRuta`) 
VALUES ('1', '0', '0');
-------------------------------------------------------------------------------------------------

-- Creando un camion--------------------------------------------------------------
INSERT INTO `vehiculos`(`matricula`, `disponibilidad`) 
VALUES ('STP 1234', 'enAlmacen');

INSERT INTO `camiones`(`matricula`, `disponibilidad`) 
VALUES ('STP 1234', 'enAlmacen');
-------------------------------------------------------------------------------------------------

-- Asignando el lote a un camion--------------------------------------------------------------
INSERT INTO `conducen` (`matricula`, `fecha_llegada`, `fecha_salida`, `ci`) 
VALUES ('STP 1234', NULL, NULL, '83021834');
-------------------------------------------------------------------------------------------------

-- Insertando el usuario de un camionero--------------------------------------------------------------
INSERT INTO `usuarios`(`ci`, `nombre`, `tipo`, `contrasenia`) 
VALUES (83021834,'Carlos Lopez','Camionero','cymacoRepuestos');

INSERT INTO `conductores`(`ci`, `nombre`, `telefono`) 
VALUES (83021834, 'Carlos', 9666666);

INSERT INTO `camioneros`(`ci`, `nombre`, `telefono`) 
VALUES (83021834, 'Carlos', 9666666);
-----------------------------------------------------------------------------------------------------

-- Asignando al camionero al camion--------------------------------------------------------------
INSERT INTO `conducen` (`matricula`, `fecha_llegada`, `fecha_salida`, `ci`) 
VALUES ('STP 1234', NULL, NULL, '83021834');
-------------------------------------------------------------------------------------------------
