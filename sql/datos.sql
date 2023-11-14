-- Informacion de Quick Carry---------------------------------------------------------------------
INSERT INTO almacenes (idAlmacen, calle, departamento, localidad, num, lat, lng) 
VALUES ('0', 'Baltimore', 'Montevideo', 'Peñarol', ' 1651', '-34.83001', '-56.19339');
-- -----------------------------------------------------------------------------------------------

-- Ruta 0 para envios de CRECOM a Quick Carry-----------------------------------------------------
INSERT INTO rutas (numRuta, departamentos) 
VALUES ('0', 'Montevideo');
-- -----------------------------------------------------------------------------------------------

-- Asignando Quick Carry a la RUta 0--------------------------------------------------------------
INSERT INTO almacen_rutas (idAlmacen, numRuta) 
VALUES ('0', '0');
-- -----------------------------------------------------------------------------------------------

-- Insertando el usuario de un camionero--------------------------------------------------------------
INSERT INTO `usuarios`(`ci`, `nombre`, `tipo`, `contrasenia`) 
VALUES 	(11111111,'root','Admin','root'),
		(83021834,'Carlos Lopez','Camionero','cymacoRepuestos'),
        (17878836,'Jasinto viera','Camionero','Buquebus'),
		(51111367,'Maria Pia','Delivery','UESdelivery'),
        (56472367,'Susana Gimenez','Delivery','DACVHI'),
		(16142527,'Juan Carlos','Central', 'CentroJuan'),
        (15673459,'Agustin arolas','Central', 'ArolasAg'),
        (08945643,'Enzo Guido','Externo', 'guido22'),
        (76875748,'Enzo palermo','Secundario', 'exaculir23');
        
-- almacenes
INSERT INTO almacenes (idAlmacen, calle, departamento, localidad, num, lat, lng) 
VALUES 
(4, 'Avenida de los Suspiros', 'Rocha', 'Rocha', 101, '-34,4831', '-54,3350'),
(5, 'Rambla de Montevideo', 'Montevideo', 'Montevideo', 789, '-34,9076', '-56,2044'),
(6, 'Calle del Puerto', 'Colonia', 'Colonia', 456, '-34,4766', '-57,8430');
-- vehiculos
INSERT INTO vehiculos (matricula, disponibilidad) 
VALUES 
('STP1235', 'Disponible'),
('STP1234', 'Disponible'),
('STL0987', 'En servicio'),
('STP7654', 'En mantenimiento');
-- Rutas
INSERT INTO rutas (numRuta, departamentos) 
VALUES 
(1, 'Montevideo,Canelones'),
(2, 'Canelones,Maldonado'),
(3, 'Maldonado,Montevideo');
-- paquetes----
INSERT INTO `paquetes`(`numBulto`, `fechaCreacion`, `fechaEntrega`, `calle`, `localidad`, `departamento`, `num`, `gmailCliente`, `idRastreo`, `lat`, `lng`) 
VALUES ('1', NOW(), NULL, 'S. Borrazas','Tala','Canelones','47','supergmail@gmail.com','889296133','-34.35','-55.76667');

INSERT INTO `paquetes`(`numBulto`, `fechaCreacion`, `fechaEntrega`, `calle`, `localidad`, `departamento`, `num`, `gmailCliente`, `idRastreo`, `lat`, `lng`) 
VALUES ('2', NOW(), NULL, 'S. Borrazas','Tala','Canelones','47','supergmail@gmail.com','889296134','-34.35','-55.76667');

INSERT INTO `paquetes`(`numBulto`, `fechaCreacion`, `fechaEntrega`, `calle`, `localidad`, `departamento`, `num`, `gmailCliente`, `idRastreo`, `lat`, `lng`) 
VALUES ('3', NOW(), NULL, 'S. Borrazas','Tala','Canelones','47','supergmail@gmail.com','889296135','-34.35','-55.76667');
-- -----------------------------------------------------------------------------------------------
-- lotes
INSERT INTO lotes (idLote) 
VALUES 
(1),
(2),
(3);
-- Vehiculos Camiones --
INSERT INTO `camiones`(`matricula`, `disponibilidad`) 
VALUES ('STP1234', 'enAlmacen'),('STP7654', 'enAlmacen');
-- V pickups ---
INSERT INTO `pickups`(`matricula`, `disponibilidad`) 
VALUES ('STP1235', 'enAlmacen');
-- Usuarios Conductor --
INSERT INTO `conductores`(`ci`, `nombre`, `telefono`) 
VALUES (83021834, 'Carlos', 9666666), (51111367, 'Maria pia', 987654321);
-- Uusarion Camioneros --
INSERT INTO `camioneros`(`ci`, `nombre`, `telefono`) 
VALUES (83021834, 'Carlos', 9666666);
-- Usuarios Delivery --
INSERT INTO deliverys (ci, nombre, telefono) 
VALUES 
(51111367, 'Maria pia', 987654321);
-- Manejan --
 INSERT INTO manejan (matricula, fecha_llegada, fecha_salida, ci) 
VALUES 
('STP1235', '2023-11-10 08:00:00', '2023-11-10 17:00:00', 51111367);

-- COnducen --
INSERT INTO `conducen` (`matricula`, `fecha_llegada`, `fecha_salida`, `ci`) 
VALUES ('STP1234', NULL, NULL, '83021834');

-- lootean -- 
INSERT INTO lotean (numBulto, idLote) 
VALUES 
(1, 1),
(2, 2),
(3, 3);
 -- almacen_rutas --
INSERT INTO Almacen_Rutas (idAlmacen, numRuta) 
VALUES 
(4, 1),
(5, 2),
(6, 3);
-- lotes-Almacen-Rutas --
INSERT INTO lotes_Almacen_Rutas (idLote, idAlmacen, numRuta) 
VALUES 
(1, 4, 1),
(2, 5, 2),
(3, 6, 3);
-- llevan --
INSERT INTO llevan (matricula, idLote, idAlmacen, numRuta, fecha_salida, fecha_llegada) VALUES
('STP1234', 1, 4, 1, '2023-01-01 08:00:00','2023-011-01 08:00:00'),
('STP7654', 2, 5, 2, '2023-01-02 09:00:00', '2023-11-01 08:00:00');
-- entregan --
   
INSERT INTO entregan (fecha_llegada, fecha_salida, matricula, numBulto) VALUES
('2023-11-01 08:00:00', '2023-01-01 16:00:00', 'STP1235', 1);


   