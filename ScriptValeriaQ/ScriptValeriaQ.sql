-- a. Creación de la base de datos
CREATE DATABASE TiendaRopa;

-- Usar la base de datos creada
USE TiendaRopa;

-- b. Creación de las tablas
CREATE TABLE Marcas (
    idmarca INT IDENTITY PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    modelo VARCHAR(100) NOT NULL,
    coleccion VARCHAR(100) NOT NULL
);

CREATE TABLE Prendas (
    idPrenda INT IDENTITY PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    marca_id INT,
    stock INT NOT NULL,
    talla VARCHAR(10) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    idInventario INT, 
    FOREIGN KEY (marca_id) REFERENCES Marcas(idmarca)
);

CREATE TABLE Venta (
    id INT IDENTITY PRIMARY KEY,
    id_prenda INT,
    cantidad INT NOT NULL,
    fecha DATE NOT NULL,
    FOREIGN KEY (id_prenda) REFERENCES Prendas(idPrenda)
);

CREATE TABLE Inventario (
    idInventario INT IDENTITY PRIMARY KEY,
    idPrenda INT,
    cantidad_disponible INT NOT NULL,
    FOREIGN KEY (idPrenda) REFERENCES Prendas(idPrenda)
);

-- d. Inserción de datos de ejemplo a las tablas
INSERT INTO Marcas (nombre, modelo, coleccion) VALUES 
('Nike', 'Air Max', 'Sportswear'),
('Marca2', 'Modelo2', 'Coleccion2'),
('Marca3', 'Modelo3', 'Coleccion3'),
('Marca4', 'Modelo4', 'Coleccion4'),
('Marca5', 'Modelo5', 'Coleccion5');

INSERT INTO Marcas (nombre, modelo, coleccion) VALUES 
('Zara', 'Camisa Slim Fit', 'Primavera-Verano'),
('H&M', 'Jeans Skinny', 'Otoño-Invierno'),
('Levis', '501', 'Denim'),
('Gucci', 'Ace', 'Luxury'),
('Mango', 'Blazer Clásico', 'Elegance');



INSERT INTO Prendas (nombre, marca_id, stock, talla, precio) VALUES 
('Camisa Slim Fit', 1, 100, 'M', 20000),
('Jeans Skinny', 2, 150, '32', 49000),
('501', 3, 75, '30x32', 50000),
('Ace', 4, 120, '40', 70000),
('Blazer Clásico', 5, 200, 'L', 450000);

INSERT INTO Venta (id_prenda, cantidad, fecha) VALUES 
(1, 10, '2023-06-01'),
(2, 5, '2023-06-01'),
(3, 2, '2023-06-02'),
(1, 3, '2023-06-02'),
(4, 1, '2023-06-03'),
(5, 20, '2023-06-03');

INSERT INTO Inventario (idPrenda, cantidad_disponible) VALUES 
(1, 90),
(2, 145),
(3, 73),
(4, 119),
(5, 180);

-- e. Eliminación de algún dato
DELETE FROM Venta WHERE id = 2;

-- f. Actualización de algún dato
UPDATE Prendas SET precio = 24.99 WHERE idPrenda = 1;

-- g. Consulta (select de los datos)
SELECT * FROM Marcas;
SELECT * FROM Prendas;
SELECT * FROM Venta;

-- I. Obtener la lista de todas las marcas que tienen al menos una venta
CREATE VIEW MarcasConVentas AS
SELECT DISTINCT M.nombre
FROM Marcas M
JOIN Prendas P ON M.idmarca = P.marca_id
JOIN Venta V ON P.idPrenda = V.id_prenda;

-- II. Obtener prendas vendidas y su cantidad restante en stock
CREATE VIEW PrendasVendidasConStock AS
SELECT P.nombre, 
       I.cantidad_disponible AS stock_actual,
       SUM(V.cantidad) AS total_vendido
FROM Prendas P
JOIN Venta V ON P.idPrenda = V.id_prenda
JOIN Inventario I ON P.idInventario = I.idInventario
GROUP BY P.nombre, I.cantidad_disponible;

-- III. Obtener listado de las 5 marcas más vendidas y su cantidad de ventas
CREATE VIEW Top5MarcasMasVendidas AS
SELECT TOP 5 M.nombre, SUM(V.cantidad) AS total_vendido
FROM Marcas M
JOIN Prendas P ON M.idmarca = P.marca_id
JOIN Venta V ON P.idPrenda = V.id_prenda
GROUP BY M.nombre
ORDER BY total_vendido DESC;

-- Verificación de las vistas
SELECT * FROM MarcasConVentas;
SELECT * FROM PrendasVendidasConStock;
SELECT * FROM Top5MarcasMasVendidas;