-- Informacion de Quick Carry---------------------------------------------------------------------
INSERT INTO `almacenes` (`idAlmacen`, `calle`, `departamento`, `localidad`, `num`, `lat`, `lng`) 
VALUES ('0', 'Baltimore', 'Montevideo', 'Peñarol', ' 1651', '-34.83001', '-56.19339');
-- -----------------------------------------------------------------------------------------------

-- Ruta 0 para envios de CRECOM a Quick Carry-----------------------------------------------------
INSERT INTO `rutas` (`numRuta`, `departamentos`) 
VALUES ('0', 'Montevideo');
-- -----------------------------------------------------------------------------------------------

-- Asignando Quick Carry a la RUta 0--------------------------------------------------------------
INSERT INTO `almacen_rutas` (`idAlmacen`, `numRuta`) 
VALUES ('0', '0');
-- -----------------------------------------------------------------------------------------------

-- Insertando paquetes----------------------------------------------------------------------------
INSERT INTO `paquetes`(`numBulto`, `fechaCreacion`, `fechaEntrega`, `calle`, `localidad`, `departamento`, `num`, `gmailCliente`, `idRastreo`, `lat`, `lng`) 
VALUES ('1', NOW(), NULL, 'S. Borrazas','Tala','Canelones','47','supergmail@gmail.com','889296133','-34.35','-55.76667');

INSERT INTO `paquetes`(`numBulto`, `fechaCreacion`, `fechaEntrega`, `calle`, `localidad`, `departamento`, `num`, `gmailCliente`, `idRastreo`, `lat`, `lng`) 
VALUES ('2', NOW(), NULL, 'S. Borrazas','Tala','Canelones','47','supergmail@gmail.com','889296134','-34.35','-55.76667');

INSERT INTO `paquetes`(`numBulto`, `fechaCreacion`, `fechaEntrega`, `calle`, `localidad`, `departamento`, `num`, `gmailCliente`, `idRastreo`, `lat`, `lng`) 
VALUES ('3', NOW(), NULL, 'S. Borrazas','Tala','Canelones','47','supergmail@gmail.com','889296135','-34.35','-55.76667');
-- -----------------------------------------------------------------------------------------------

-- Creando un lote 1 para los anteriores paquetes-------------------------------------------------
INSERT INTO `lotes` (`idLote`) 
VALUES (1);
-- -----------------------------------------------------------------------------------------------

-- Ahora el lote va a un Quick Carry-----------------------------------------------------------------
INSERT INTO `van` (`idLote`, `idAlmacen`, `numRuta`) 
VALUES ('1', '0', '0');
-- -----------------------------------------------------------------------------------------------

-- Creando un camion--------------------------------------------------------------
INSERT INTO `vehiculos`(`matricula`, `disponibilidad`) 
VALUES ('STP1234', 'enAlmacen');

INSERT INTO `camiones`(`matricula`, `disponibilidad`) 
VALUES ('STP1234', 'enAlmacen');
-- -----------------------------------------------------------------------------------------------

-- Asignando el lote a un camion--------------------------------------------------------------
INSERT INTO `llevan` (`matricula`, `fecha_llegada`, `fecha_salida`, `idLote`, `idAlmacen`, `numRuta`) 
VALUES ('STP1234', NULL, NULL, '1', '0', '0');
-- -----------------------------------------------------------------------------------------------

-- Insertando el usuario de un camionero--------------------------------------------------------------
INSERT INTO `usuarios`(`ci`, `nombre`, `tipo`, `contrasenia`) 
VALUES (83021834,'Carlos Lopez','Camionero','cymacoRepuestos');

INSERT INTO `conductores`(`ci`, `nombre`, `telefono`) 
VALUES (83021834, 'Carlos', 9666666);

INSERT INTO `camioneros`(`ci`, `nombre`, `telefono`) 
VALUES (83021834, 'Carlos', 9666666);
-- ---------------------------------------------------------------------------------------------------

-- Asignando al camionero al camion--------------------------------------------------------------
INSERT INTO `conducen` (`matricula`, `fecha_llegada`, `fecha_salida`, `ci`) 
VALUES ('STP1234', NULL, NULL, '83021834');
-- -----------------------------------------------------------------------------------------------





-- almacenes
INSERT INTO almacenes (idAlmacen, calle, departamento, localidad, num, lat, lng) 
VALUES 
(4, 'Avenida de los Suspiros', 'Rocha', 'Rocha', 101, '-34,4831', '-54,3350'),
(5, 'Rambla de Montevideo', 'Montevideo', 'Montevideo', 789, '-34,9076', '-56,2044'),
(6, 'Calle del Puerto', 'Colonia', 'Colonia', 456, '-34,4766', '-57,8430');

-- conductores
INSERT INTO conductores (ci, nombre, telefono) 
VALUES 
(111, 'Juan Conductor', 987654321),
(222, 'Ana Conductora', 123456789),
(333, 'Pedro Conductor', 111223344);

-- camioneros
INSERT INTO camioneros (ci, nombre, telefono) 
VALUES 
(111, 'Juan Camionero', 987654321),
(222, 'Ana Camionera', 123456789),
(333, 'Pedro Camionero', 111223344);

-- vehiculos
INSERT INTO vehiculos (matricula, disponibilidad) 
VALUES 
('ABC123', 'Disponible'),
('DEF456', 'En servicio'),
('GHI789', 'En mantenimiento');

-- camiones
INSERT INTO camiones (matricula, disponibilidad) 
VALUES 
('ABC123', 'Disponible'),
('DEF456', 'En servicio'),
('GHI789', 'En mantenimiento');

-- conducen
INSERT INTO conducen (matricula, fecha_llegada, fecha_salida, ci) 
VALUES 
('ABC123', '2023-11-09 08:00:00', '2023-11-09 17:00:00', 111),
('DEF456', '2023-11-09 09:30:00', '2023-11-09 18:30:00', 222),
('GHI789', '2023-11-09 10:45:00', '2023-11-09 19:45:00', 333);

-- deliverys
INSERT INTO deliverys (ci, nombre, telefono) 
VALUES 
(111, 'Juan Delivery', 987654321),
(222, 'Ana Delivery', 123456789),
(333, 'Pedro Delivery', 111223344);

-- paquetes
INSERT INTO paquetes (fechaCreacion, fechaEntrega, calle, localidad, departamento, num, gmailCliente, idRastreo, lat, lng) 
VALUES 
('2023-11-09 12:00:00', '2023-11-10 15:30:00', 'Calle X', 'Montevideo', 'Montevideo', 456, 'cliente@gmail.com', 123456, '-34,9087', '-56,1873'),
('2023-11-09 13:30:00', '2023-11-10 16:45:00', 'Calle Y', 'Canelones', 'Canelones', 789, 'otrocliente@gmail.com', 789012, '-34,5383', '-56,2844'),
('2023-11-09 14:45:00', '2023-11-10 18:00:00', 'Calle Z', 'Maldonado', 'Maldonado', 1011, 'cliente3@gmail.com', 345678, '-34,9064', '-54,9611');

-- pickups
INSERT INTO pickups (matricula, disponibilidad) 
VALUES 
('ABC123', 'Disponible'),
('DEF456', 'En servicio'),
('GHI789', 'En mantenimiento');

-- entregan
INSERT INTO entregan (fecha_llegada, fecha_salida, matricula, numBulto) 
VALUES 
('2023-11-10 08:30:00', '2023-11-10 17:30:00', 'ABC123', 1),
('2023-11-10 10:00:00', '2023-11-10 19:00:00', 'DEF456', 2),
('2023-11-10 11:15:00', '2023-11-10 20:15:00', 'GHI789', 3);

-- lotes
INSERT INTO lotes (idLote) 
VALUES 
(1),
(2),
(3);

-- Rutas
INSERT INTO rutas (numRuta, departamentos) 
VALUES 
(1, 'Montevideo,Canelones'),
(2, 'Canelones,Maldonado'),
(3, 'Maldonado,Montevideo');

-- Almacen-Rutas
INSERT INTO Almacen_Rutas (idAlmacen, numRuta) 
VALUES 
(1, 1),
(2, 2),
(3, 3);

-- lotes-Almacen-Rutas
INSERT INTO van (idLote, idAlmacen, numRuta) 
VALUES 
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

-- llevan
INSERT INTO llevan (matricula, idLote, idAlmacen, numRuta, fecha_salida, fecha_llegada) 
VALUES 
('ABC123', 1, 1, 1, '2023-11-10 08:00:00', '2023-11-10 17:00:00'),
('DEF456', 2, 2, 2, '2023-11-10 09:30:00', '2023-11-10 18:30:00'),
('GHI789', 3, 3, 3, '2023-11-10 10:45:00', '2023-11-10 19:45:00');

-- lotean
INSERT INTO lotean (numBulto, idLote) 
VALUES 
(1, 1),
(2, 2),
(3, 3);

-- manejan
INSERT INTO manejan (matricula, fecha_llegada, fecha_salida, ci) 
VALUES 
('ABC123', '2023-11-10 08:00:00', '2023-11-10 17:00:00', 111),
('DEF456', '2023-11-10 09:30:00', '2023-11-10 18:30:00', 222),
('GHI789', '2023-11-10 10:45:00', '2023-11-10 19:45:00', 333);

-- usuarios
INSERT INTO usuarios (ci, nombre, tipo, contrasenia, token, tokenExp) 
VALUES 
(111, 'Juan Usuario', 'Cliente', 'contrasenia123', 'token123', 1636521600),
(222, 'Ana Usuario', 'Cliente', 'contrasenia456', 'token456', 1636521600),
(333, 'Pedro Usuario', 'Empleado', 'contrasenia789', 'token789', 1636521600);

-- van
INSERT INTO van (idLote, idAlmacen) 
VALUES 
(1, 1),
(2, 2),
(3, 3);

-- 1. *almacenes:*
--   sql
   INSERT INTO almacenes (idAlmacen, calle, departamento, localidad, num, lat, lng) VALUES
   (1, 'Avenida del Comercio', 'Montevideo', 'Pocitos', 123, '-34.9064', '-56.1523'),
   (2, 'Calle Uruguay', 'Canelones', 'Canelones', 456, '-34.5228', '-56.2777'),
   (3, 'Avenida Artigas', 'Maldonado', 'Maldonado', 789, '-34.9045', '-54.9583');
   

-- 2. *usuarios:*
--   sql
   INSERT INTO usuarios (ci, nombre, tipo, contrasenia, token, tokenExp) VALUES
   (111, 'Juan Pérez', 'Cliente', 'pass1', 'token1', 1600000000),
   (222, 'Ana Rodríguez', 'Conductor', 'pass2', 'token2', 1600000000),
   (333, 'Carlos López', 'Administrador', 'pass3', 'token3', 1600000000);
   

-- 3. *conductores:*
--   sql
   INSERT INTO conductores (ci, nombre, telefono) VALUES
   (222, 'Pedro Gómez', 2345678),
   (444, 'María Fernández', 3456789),
   (666, 'Laura Martínez', 4567890);
   

-- 4. *camioneros:*
--   sql
   INSERT INTO camioneros (ci, nombre, telefono) VALUES
   (222, 'Pedro Gómez', 2345678),
   (444, 'María Fernández', 3456789),
   (666, 'Laura Martínez', 4567890);
   

-- 5. *vehiculos:*
--   sql
   INSERT INTO vehiculos (matricula, disponibilidad) VALUES
   ('ABC123', 'Disponible'),
   ('XYZ789', 'En uso'),
   ('123ABC', 'Disponible');
   

-- 6. *camiones:*
--   sql
   INSERT INTO camiones (matricula, disponibilidad) VALUES
   ('ABC123', 'Disponible'),
   ('XYZ789', 'En uso'),
   ('123ABC', 'Disponible');
   

-- 7. *conducen:*
--   sql
   INSERT INTO conducen (matricula, fecha_llegada, fecha_salida, ci) VALUES
   ('ABC123', '2023-01-01 08:00:00', '2023-01-01 16:00:00', 222),
   ('XYZ789', '2023-01-02 09:00:00', '2023-01-02 17:00:00', 444),
   ('123ABC', '2023-01-03 10:00:00', '2023-01-03 18:00:00', 666);
   

-- 8. *pickups:*
--   sql
   INSERT INTO pickups (matricula, disponibilidad) VALUES
   ('ABC123', 'Disponible'),
   ('XYZ789', 'En uso'),
   ('123ABC', 'Disponible');
   

-- 9. *entregan:*
--   sql
   INSERT INTO entregan (fecha_llegada, fecha_salida, matricula, numBulto) VALUES
   ('2023-01-01 08:00:00', '2023-01-01 16:00:00', 'ABC123', 1),
   ('2023-01-02 09:00:00', '2023-01-02 17:00:00', 'XYZ789', 2),
   ('2023-01-03 10:00:00', '2023-01-03 18:00:00', '123ABC', 3);
   

-- 10. *paquetes:*
--   sql
   INSERT INTO paquetes (numBulto, fechaCreacion, fechaEntrega, calle, localidad, departamento, num, gmailCliente, idRastreo, lat, lng) VALUES
   (1, '2023-01-01 12:00:00', '2023-01-05 14:00:00', 'Calle 4', 'Punta del Este', 'Maldonado', 101, 'cliente1@gmail.com', 001, '-34.9671', '-54.9333'),
   (2, '2023-01-02 14:00:00', '2023-01-06 16:00:00', 'Calle 5', 'Ciudad de la Costa', 'Canelones', 202, 'cliente2@gmail.com', 002, '-34.8100', '-55.9030'),
   (3, '2023-01-03 16:00:00', '2023-01-07 18:00:00', 'Calle 6', 'Colonia del Sacramento', 'Colonia', 303, 'cliente3@gmail.com', 003, '-34.4628', '-57.8439');
   
-- 11. *lotes:*
--   sql
   INSERT INTO lotes (idLote) VALUES
   (1),
   (2),
   (3);
   

-- 12. *Rutas:*
--   sql
   INSERT INTO Rutas (numRuta, departamentos) VALUES
   (1, 'Montevideo, Canelones'),
   (2, 'Canelones, Maldonado'),
   (3, 'Maldonado, Montevideo');
   

-- 13. *Almacen_Rutas:*
--   sql
   INSERT INTO Almacen_Rutas (idAlmacen, numRuta) VALUES
   (1, 1),
   (2, 2),
   (3, 3);
   

-- 14. *van:*
--   sql
   INSERT INTO van (idLote, idAlmacen, numRuta) VALUES
   (1, 1, 1),
   (2, 2, 2),
   (3, 3, 3);
   

-- 15. *llevan:*
--  sql
   INSERT INTO llevan (matricula, idLote, idAlmacen, numRuta, fecha_salida, fecha_llegada) VALUES
   ('ABC123', 1, 1, 1, '2023-01-01 08:00:00', '2023-01-01 16:00:00'),
   ('XYZ789', 2, 2, 2, '2023-01-02 09:00:00', '2023-01-02 17:00:00');
