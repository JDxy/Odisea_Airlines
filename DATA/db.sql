DROP DATABASE  IF EXISTS ODISEA_AIRLINE;
CREATE DATABASE  ODISEA_AIRLINE;
USE ODISEA_AIRLINE;

CREATE TABLE Clientes (
    Dni VARCHAR(9) PRIMARY KEY,
    Nombre VARCHAR(255),
    Apellidos VARCHAR(255)
);

CREATE TABLE Datos_Clientes (
    cod_datos_cliente INTEGER PRIMARY KEY AUTO_INCREMENT,
    NumeroTelefono VARCHAR(255),
    Contrasena VARCHAR(255),
    Email VARCHAR(255)
);

CREATE TABLE Datos_Clientes_Y_Clientes(
    Dni_cliente VARCHAR(9),
    cod_datos_cliente INT,
    PRIMARY KEY (Dni_cliente, cod_datos_cliente)

);

ALTER TABLE Datos_Clientes_Y_Clientes ADD FOREIGN KEY (cod_datos_cliente) REFERENCES Datos_Clientes(cod_datos_cliente);
ALTER TABLE Datos_Clientes_Y_Clientes ADD FOREIGN KEY (Dni_cliente) REFERENCES Clientes(Dni); 


CREATE TABLE Aviones (
    Matricula VARCHAR(255) PRIMARY KEY,
    AnosServicio INT,
    UltimoMantenimiento DATE,
    CantidadTotalPasajeros INT,
    CapacidadDisponible INT
);

CREATE TABLE Estado_aviones(
    cod_estado_avion INTEGER PRIMARY KEY AUTO_INCREMENT, 
    Estado boolean default false
);

CREATE TABLE Estado_aviones_Y_Aviones(
    cod_estado_avion INTEGER,
    Matricula_avion VARCHAR(255),
    PRIMARY KEY (cod_estado_avion, Matricula_avion)
);

ALTER TABLE Estado_aviones_Y_Aviones ADD FOREIGN KEY (cod_estado_avion) REFERENCES Estado_aviones(cod_estado_avion);
ALTER TABLE Estado_aviones_Y_Aviones ADD FOREIGN KEY (Matricula_avion) REFERENCES Aviones(Matricula); 


CREATE TABLE Vuelos (
    IdVuelos INT PRIMARY KEY AUTO_INCREMENT,
    Matricula_avion VARCHAR(255),
    Dni_cliente VARCHAR(9)

);

CREATE TABLE Destinos (
    cod_Destino INT PRIMARY KEY AUTO_INCREMENT,
    Destino VARCHAR(255),
    Origen VARCHAR(255),
    Fecha_llegada DATE,
    Fecha_salida DATE,
    Precio DECIMAL(10,2)
);

CREATE TABLE Destinos_Y_Vuelos (
    IdVuelos INT,
    cod_Destino INT
);

CREATE TABLE Administradores (
    cod_admin INT PRIMARY KEY AUTO_INCREMENT,
    Contrasena VARCHAR(255)
);

ALTER TABLE Destinos_Y_Vuelos ADD FOREIGN KEY (cod_Destino) REFERENCES Destinos (cod_Destino);
ALTER TABLE Destinos_Y_Vuelos ADD FOREIGN KEY (IdVuelos) REFERENCES Vuelos (IdVuelos);

ALTER TABLE Vuelos ADD FOREIGN KEY (Matricula_avion) REFERENCES Aviones(Matricula);
ALTER TABLE Vuelos ADD FOREIGN KEY (Dni_cliente) REFERENCES Clientes(Dni);
