
INSERT INTO Datos_Clientes VALUES (NULL,"1314145", "KAI@gmail.com");

Insert into clientes VALUES ("12345678B","HA","JK");


INSERT INTO Datos_Clientes VALUES (NULL,"13331551", "KAy@gmail.com");

Insert into clientes VALUES ("11111111B","HA","JK");


INSERT INTO Datos_Clientes_Y_Clientes VALUES (1, "12345678B");

INSERT INTO Datos_Clientes_Y_Clientes VALUES (2, "11111111B");



INSERT INTO Aviones VALUES ("131B", 3, "2007-07-21", 100, 13);

INSERT INTO Estado_aviones VALUES (NULL,True);

INSERT INTO Estado_aviones_Y_Aviones VALUES (1,"131B");



INSERT INTO vuelos VALUES (NULL, "131B", "12345678B", 100.4);

INSERT INTO Destinos VALUES (NULL, "Medellin", "Ciudad de Mexico", "2007-03-20", "2007,03-11");

INSERT INTO Destinos_Y_Vuelos VALUES (1,1);


SELECT * from clientes;

SELECT * from Datos_Clientes;

SELECT * FROM Datos_Clientes_Y_Clientes;


SELECT cod_datos_cliente FROM Datos_Clientes ORDER BY cod_datos_cliente desc LIMIT 1;
SELECT dni FROM Clientes ORDER BY DNI desc LIMIT 1;

INSERT INTO Datos_clientes_Y_Clientes SELECT D.cod_datos_cliente,"dad" FROM Datos_Clientes D ORDER BY cod_datos_cliente desc LIMIT 1;

            DELETE FROM Datos_clientes_y_clientes where cod_datos_cliente = 16 AND dni_cliente = dacada;

DELETE Datos_Clientes_Y_Clientes FROM Datos_Clientes_Y_Clientes D
JOIN clientes C ON D.dni_cliente = C.DNI;