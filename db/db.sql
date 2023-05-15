DROP DATABASE IF EXISTS adrenaline_ollie;
CREATE DATABASE adrenaline_ollie;
USE adrenaline_ollie;

CREATE TABLE ADMINISTRADORES(
    NOMBRE VARCHAR(50) NOT NULL,
    EMAIL VARCHAR(50) NOT NULL,
    CONTRASENA VARCHAR(50) NOT NULL,
    PRIMARY KEY(NOMBRE)
);

CREATE TABLE Producto (
  ID_producto INT NOT NULL AUTO_INCREMENT,
  Img_producto VARCHAR(50) NOT NULL,
  Nombre_producto VARCHAR(50) NOT NULL,
  Tipo_producto VARCHAR(50) NOT NULL,
  PRIMARY KEY (ID_producto)
);

CREATE TABLE Marca (
  ID_marca INT NOT NULL AUTO_INCREMENT,
  ID_producto INT NOT NULL,
  Marca VARCHAR(50) NOT NULL,
  Descripcion VARCHAR(255),
  PRIMARY KEY (ID_marca),
  FOREIGN KEY (ID_producto) REFERENCES Producto(ID_producto)
);

CREATE TABLE Precio (
  ID_precio INT NOT NULL AUTO_INCREMENT,
  ID_producto INT NOT NULL,
  Precio_unitario DECIMAL(10,2) NOT NULL,
  Cantidad_disponible INT NOT NULL DEFAULT 0, -- Se agrega la cláusula DEFAULT para establecer un valor inicial para la columna
  PRIMARY KEY (ID_precio),
  FOREIGN KEY (ID_producto) REFERENCES Producto(ID_producto)
);

CREATE TABLE Cliente (
  Correo_electronico_cliente VARCHAR(100) NOT NULL UNIQUE,
  Nombre_cliente VARCHAR(50) NOT NULL,
  Apellido_cliente VARCHAR(50) NOT NULL,
  Telefono VARCHAR(15) NOT NULL,
  Direccion VARCHAR(255) NOT NULL,
  CONTRASENA VARCHAR(255) NOT NULL,
  PRIMARY KEY (Correo_electronico_cliente)
);

CREATE TABLE Pedido (
  ID_PEDIDO INT NOT NULL AUTO_INCREMENT,
  ID_producto INT NOT NULL,
  Correo_electronico_cliente VARCHAR(255) NOT NULL,
  Cantidad INT NOT NULL,
  Precio_unitario DECIMAL(10,2) NOT NULL,
  Fecha_pedido DATE NOT NULL,
  PRIMARY KEY (ID_PEDIDO),
  FOREIGN KEY (ID_producto) REFERENCES Producto(ID_producto),
  FOREIGN KEY (Correo_electronico_cliente) REFERENCES Cliente(Correo_electronico_cliente)
);
--  DELIMITER //

-- CREATE TRIGGER disminuir_stock
-- AFTER INSERT ON Pedido
-- FOR EACH ROW
-- BEGIN
--   DECLARE stock_actual INT;
--   SELECT Cantidad_disponible INTO stock_actual FROM Precio WHERE ID_producto = NEW.ID_producto;
--   IF stock_actual >= NEW.Cantidad THEN
--     UPDATE Precio SET Cantidad_disponible = stock_actual - NEW.Cantidad WHERE ID_producto = NEW.ID_producto;
--   END IF;
-- END

--  //

--  DELIMITER ; 





-- Insertar datos de ejemplo en la tabla ADMINISTRADORES
INSERT INTO ADMINISTRADORES (NOMBRE, EMAIL, CONTRASENA)
VALUES 
('admin1', 'admin1@example.com', 'contrasena1'),
('admin2', 'admin2@example.com', 'contrasena2'),
('admin3', 'admin3@example.com', 'contrasena3');

-- Insertar datos de ejemplo en la tabla Producto
INSERT INTO Producto (Img_producto, Nombre_producto, Tipo_producto)
VALUES
('../ASSETS/IMG/PRODUCTOS/tabla1.png', 'Tabla de Skateboard Krown', 'TABLA'),
('../ASSETS/IMG/PRODUCTOS/tabla2.png', 'Tabla de Skateboard Powell Peralta', 'TABLA'),
('../ASSETS/IMG/PRODUCTOS/trucks1.png', 'Trucks de Skateboard Independent Stage 11', 'TRUCKS'),
('../ASSETS/IMG/PRODUCTOS/trucks2.png', 'Trucks de Skateboard Thunder Hollow Lights', 'TRUCKS'),
('../ASSETS/IMG/PRODUCTOS/ruedas1.png', 'Ruedas de Skateboard Spitfire Formula Four', 'RUEDAS'),
('../ASSETS/IMG/PRODUCTOS/ruedas2.png', 'Ruedas de Skateboard Bones STF', 'RUEDAS'),
('../ASSETS/IMG/PRODUCTOS/rodamientos1.jpg', 'Rodamientos de Skateboard Bones Super Reds', 'RODAMIENTOS'),
('../ASSETS/IMG/PRODUCTOS/rodamientos2.jpg', 'Rodamientos de Skateboard Bronson Speed Co', 'RODAMIENTOS'),
('../ASSETS/IMG/PRODUCTOS/skate1.jpg', 'Skateboard Completo Krown', 'SKATE'),
('../ASSETS/IMG/PRODUCTOS/skate2.jpg', 'Skateboard Completo Powell Peralta', 'SKATE');


-- Insertar datos de ejemplo en la tabla Marca
INSERT INTO Marca (ID_producto, Marca, Descripcion)
VALUES
(1, 'Krown', 'Marca de tablas de skateboard'),
(2, 'Powell Peralta', 'Marca de tablas de skateboard'),
(3, 'Independent', 'Marca de trucks de skateboard'),
(4, 'Thunder', 'Marca de trucks de skateboard'),
(5, 'Spitfire', 'Marca de ruedas de skateboard'),
(6, 'Bones', 'Marca de ruedas de skateboard'),
(7, 'Bones', 'Marca de rodamientos de skateboard'),
(8, 'Bronson', 'Marca de rodamientos de skateboard'),
(9, 'Krown', 'Marca de skateboards completos'),
(10, 'Powell Peralta', 'Marca de skateboards completos');

-- Insertar datos de ejemplo en la tabla Precio
INSERT INTO Precio (ID_producto, Precio_unitario, Cantidad_disponible)
VALUES
(1, 50.00, 10),
(2, 70.00, 5),
(3, 35.00, 20),
(4, 50.00, 15),
(5, 40.00, 30),
(6, 45.00, 25),
(7, 25.00, 50),
(8, 30.00, 40),
(9, 100.00, 3),
(10, 120.00, 2);

-- Insertar datos de ejemplo en la tabla Cliente
INSERT INTO Cliente (Correo_electronico_cliente, Nombre_cliente, Apellido_cliente, Telefono, Direccion, CONTRASENA)
VALUES 
('cliente1@example.com', 'Juan', 'Pérez',  '123456789', 'Calle Falsa 123', 'contrasena1'),
('cliente2@example.com', 'María', 'Gómez',  '987654321', 'Avenida Siempre Viva 456', 'contrasena2'),
('cliente3@example.com', 'Pedro', 'Martínez', '456789123', 'Plaza Mayor 789', 'contrasena3');

-- Insertar datos de ejemplo en la tabla Pedido
INSERT INTO Pedido (ID_producto, Correo_electronico_cliente, Cantidad, Precio_unitario, Fecha_pedido)
VALUES 
(1, 'cliente1@example.com', 2, 10.50, '2023-04-30'),
(1, 'cliente1@example.com', 1, 5.99, '2023-05-01'),
(3, 'cliente3@example.com', 4, 7.75, '2023-05-01'),
(1, 'cliente1@example.com', 1, 5.99, '2023-05-01');


SELECT * FROM MARCA;
SELECT * FROM PRECIO;
SELECT * FROM Producto;
SELECT * FROM Pedido;
SELECT * FROM Cliente;