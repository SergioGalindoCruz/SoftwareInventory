drop database IF EXISTS softwareinventory;
create database softwareinventory;
use softwareinventory;

create table rol (idrol int primary key auto_increment, rol varchar(20));
	insert into rol values
    (1, 'Administrador'),
    (2, 'Compra'),
    (3, 'Vendedor');
create table usuarios (idusuario int primary key, nombreempleado varchar(100), usuario varchar (100), contrasena  varchar (200), email varchar(100), idrol int);
	insert into usuarios values
	(1, 'pruebaadmin' , 'padmin', '21232f297a57a5a743894a0e4a801fc3', 'sergio.galindo.cruz@gmial.com', 1),
	(2, 'pruebacompra' , 'pcompra', '21232f297a57a5a743894a0e4a801fc3', 'sergio.galindo.cruz@gmial.com', 2),
	(3, 'pruebaventa' , 'pventa', '21232f297a57a5a743894a0e4a801fc3', 'sergio.galindo.cruz@gmial.com', 3);

create table clientes (idcliente int primary key, nombre varchar (100), direccion varchar (100), telefono int , email varchar (100));
	insert into clientes values
	(9, 'Publico General' , 'Calle 1 Carrera 1', 2999999, 'PublicoGeneral@notiene.com');
    
create table categorias (idcategoria int primary key auto_increment, nombre varchar (100));
	insert into categorias values
	(1, 'Categoria General');
    
create table proveedores (idproveedor int primary key, tipodocumento char(3),nombre varchar(100), contacto varchar(100), direccion varchar (100), telefono float, email varchar (100));
	insert into proveedores values
	(9, 'NIT', 'Proveedor General', 'Contacto General', 'Calle 1 Carrera 1', 2999999, 'ProveedorGeneral@notiene.com');
    
create table productos (idproducto int primary key auto_increment, codigobarras varchar(100), descripcion varchar (200), precioventa decimal(10,2), preciocosto decimal(10,2), stock int, idcategoria int, idproveedor int);
	insert into productos values
	(1 , 'ABC123', 'Productos General', 1, 1, 100, 1, 9);

CREATE TABLE `detallefactura` (
  `correlativo` int primary key auto_increment,
  `nofactura` int NOT NULL,
  `codproducto` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL
);

CREATE TABLE `detalle_temp` (
  `correlativo` int primary key auto_increment,
  `token_user` varchar(50) NOT NULL,
  `codproducto` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL
);
ALTER TABLE detalle_temp AUTO_INCREMENT = 17;

CREATE TABLE `factura` (
  `nofactura` int primary key auto_increment,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario` int NOT NULL,
  `codcliente` int NOT NULL,
  `totalfactura` decimal(10,2) NOT NULL,
  `estado` int NOT NULL DEFAULT 1
);

CREATE TABLE `entradas` (
  `correlativo` int primary key auto_increment,
  `codproducto` int NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `cantidad` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `usuario_id` int NOT NULL
);

CREATE TABLE `configuracion` (
  `id` int primary key auto_increment,
  `dni` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `telefono` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `iva` decimal(10,2) NOT NULL
);
INSERT INTO `configuracion` (`id`, `dni`, `nombre`, `razon_social`, `telefono`, `email`, `direccion`, `iva`) VALUES
(1, 123456789, 'Software inventory', 'Software inventory', 2999999, 'Softwareinventory@Softwareinventory.com', 'Colombia - Bogotá', '1.19');


ALTER TABLE usuarios ADD CONSTRAINT FK_rol FOREIGN KEY (idrol) REFERENCES rol(idrol);
ALTER TABLE productos ADD CONSTRAINT FK_categorias FOREIGN KEY (idcategoria) REFERENCES categorias(idcategoria);
ALTER TABLE productos ADD CONSTRAINT FK_proveedores FOREIGN KEY (idproveedor) REFERENCES proveedores(idproveedor);
ALTER TABLE detallefactura ADD CONSTRAINT FK_productos FOREIGN KEY (codproducto) REFERENCES productos(idproducto);
ALTER TABLE detallefactura ADD CONSTRAINT FK_detallefactura_factura FOREIGN KEY (nofactura) REFERENCES factura(nofactura);
ALTER TABLE detalle_temp ADD CONSTRAINT FK_detalle_temp_productos FOREIGN KEY (codproducto) REFERENCES productos(idproducto);
ALTER TABLE factura ADD CONSTRAINT FK_clientes FOREIGN KEY (codcliente) REFERENCES clientes(idcliente);
ALTER TABLE entradas ADD CONSTRAINT FK_entradas_productos FOREIGN KEY (codproducto) REFERENCES productos(idproducto);
ALTER TABLE entradas ADD CONSTRAINT FK_entradas_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(idusuario);


DELIMITER $$

CREATE PROCEDURE `add_detalle_temp` (`codigo` INT, `cantidad` INT, `token_user` VARCHAR(50))  BEGIN
DECLARE precio_actual decimal(10,2);
SELECT precioventa INTO precio_actual FROM productos WHERE idproducto = codigo;
INSERT INTO detalle_temp(token_user, codproducto, cantidad, precio_venta) VALUES (token_user, codigo, cantidad, precio_actual);
SELECT tmp.correlativo, tmp.codproducto, p.descripcion, tmp.cantidad, tmp.precio_venta FROM detalle_temp tmp INNER JOIN productos p ON tmp.codproducto = p.idproducto WHERE tmp.token_user = token_user;
END$$

CREATE PROCEDURE `del_detalle_temp` (`id_detalle` INT, `token` VARCHAR(50))  BEGIN
DELETE FROM detalle_temp WHERE correlativo = id_detalle;
SELECT tmp.correlativo, tmp.codproducto, p.descripcion, tmp.cantidad, tmp.precio_venta FROM detalle_temp tmp INNER JOIN productos p ON tmp.codproducto = p.idproducto WHERE tmp.token_user = token;
END$$

CREATE PROCEDURE `procesar_venta` (IN `cod_usuario` INT, IN `cod_cliente` INT, IN `token` VARCHAR(50))  BEGIN
DECLARE factura INT;
DECLARE registros INT;
DECLARE total DECIMAL(10,2);
DECLARE nueva_existencia int;
DECLARE existencia_actual int;

DECLARE tmp_cod_producto int;
DECLARE tmp_cant_producto int;
DECLARE a int;
SET a = 1;

CREATE TEMPORARY TABLE tbl_tmp_tokenuser(
	id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cod_prod BIGINT,
    cant_prod int);
SET registros = (SELECT COUNT(*) FROM detalle_temp WHERE token_user = token);
IF registros > 0 THEN
INSERT INTO tbl_tmp_tokenuser(cod_prod, cant_prod) SELECT codproducto, cantidad FROM detalle_temp WHERE token_user = token;
INSERT INTO factura (usuario,codcliente) VALUES (cod_usuario, cod_cliente);
SET factura = LAST_INSERT_ID();

INSERT INTO detallefactura(nofactura,codproducto,cantidad,precio_venta) SELECT (factura) AS nofactura, codproducto, cantidad,precio_venta FROM detalle_temp WHERE token_user = token;
WHILE a <= registros DO
	SELECT cod_prod, cant_prod INTO tmp_cod_producto,tmp_cant_producto FROM tbl_tmp_tokenuser WHERE id = a;
    SELECT stock INTO existencia_actual FROM productos WHERE idproducto = tmp_cod_producto;
    SET nueva_existencia = existencia_actual - tmp_cant_producto;
    UPDATE productos SET stock = nueva_existencia WHERE idproducto = tmp_cod_producto;
    SET a=a+1;
END WHILE;
SET total = (SELECT SUM(cantidad * precio_venta) FROM detalle_temp WHERE token_user = token);
UPDATE factura SET totalfactura = total WHERE nofactura = factura;
DELETE FROM detalle_temp WHERE token_user = token;
TRUNCATE TABLE tbl_tmp_tokenuser;
SELECT * FROM factura WHERE nofactura = factura;
ELSE
SELECT 0;
END IF;
END$$

CREATE PROCEDURE `actualizar_precio_producto` (IN `n_cantidad` INT, IN `n_precio` DECIMAL(10,2), IN `codigo` INT)  BEGIN
DECLARE nueva_existencia int;
DECLARE nuevo_total decimal(10,2);
DECLARE nuevo_precio decimal(10,2);

DECLARE cant_actual int;
DECLARE pre_actual decimal(10,2);

DECLARE actual_existencia int;
DECLARE actual_precio decimal(10,2);

SELECT precioventa, stock INTO actual_precio, actual_existencia FROM productos WHERE idproducto = codigo;

SET nueva_existencia = actual_existencia + n_cantidad;
SET nuevo_total = n_precio;
SET nuevo_precio = nuevo_total;

UPDATE productos SET stock = nueva_existencia, precioventa = nuevo_precio WHERE idproducto = codigo;

SELECT nueva_existencia, nuevo_precio;
END$$

CREATE PROCEDURE `data` ()  BEGIN
DECLARE usuariosdata int;
DECLARE clientesdata int;
DECLARE proveedoresdata int;
DECLARE productosdata int;
DECLARE ventasdata int;
SELECT COUNT(*) INTO usuariosdata FROM usuarios;
SELECT COUNT(*) INTO clientesdata FROM clientes;
SELECT COUNT(*) INTO proveedoresdata FROM proveedores;
SELECT COUNT(*) INTO productosdata FROM productos;
SELECT COUNT(*) INTO ventasdata FROM factura WHERE fecha > CURDATE();
SELECT usuariosdata, clientesdata, proveedoresdata, productosdata, ventasdata;

END$$

DELIMITER ;