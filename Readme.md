                                                                PARTE I PROYECTO
Descripción del Proyecto:
El proyecto consiste en diseñar e implementar un sistema para una tienda de ropa, que permita que todo el proceso sea automatizado, y que sea un control de prendas dentro de la tienda de ropa.
Estructura de la Base de Datos:
Tabla Marcas:

Campos: idmarca (clave primaria), nombre, modelo, coleccion.
Almacenará información sobre las marcas de ropa disponibles, como el nombre de la marca, el modelo y la colección.
Tabla Prendas:

Campos: idPrenda (clave primaria), nombre, marca_id (clave foránea de la tabla Marcas), stock, talla, precio, idInventario (clave foránea de la tabla Inventario).
Almacenará detalles sobre las prendas de ropa disponibles en la tienda, incluyendo el nombre de la prenda, el stock disponible, la talla, el precio, etc.
Tabla Ventas:

Campos: id (clave primaria), id_prenda (clave foránea de la tabla Prendas), cantidad, fecha.
Registrará todas las transacciones de venta realizadas en la tienda de ropa, incluyendo detalles como la prenda vendida, la cantidad vendida y la fecha de la transacción.
Tabla Inventario:

Campos: idInventario (clave primaria), idPrenda (clave foránea de la tabla Prendas), cantidad_disponible.
Mantendrá un registro detallado del stock disponible de cada prenda en la tienda.


Integrantes: Valeria Quirós González
![alt text](https://github.com/vqg9805/DPA_Valeria-QuirosG/issues/1#issue-2337090476"Diagrama")

                                                                       PARTE II PROYECTO

Marcas
Obtener todas las marcas

Método: GET
URL: http://localhost:8080/tiendakali/public/index.php?resource=marcas
Descripción: Recupera una lista de todas las marcas en la base de datos.

Agregar una nueva marca
Método: POST
URL: http://localhost:8080/tiendakali/public/index.php?resource=marcas
Cuerpo:
json
{
  "nombre": "",
  "modelo": "",
  "coleccion": ""
}
Descripción: Crea una nueva marca con los detalles proporcionados.

Actualizar una marca existente
Método: PUT
URL: http://localhost:8080/tiendakali/public/index.php?resource=marcas
Cuerpo:
json
{
  "id": "",
  "nombre": "",
  "modelo": "",
  "coleccion": ""
}
Descripción: Actualiza los detalles de una marca existente identificada por el ID.

Eliminar una marca
Método: DELETE
URL: http://localhost:8080/tiendakali/public/index.php?resource=marcas
Cuerpo:
json

{
  "id": ""
}
Descripción: Elimina una marca identificada por el ID.


Prendas
Obtener todas las prendas
Método: GET
URL: http://localhost:8080/tiendakali/public/index.php?resource=prendas
Descripción: Recupera una lista de todas las prendas en la base de datos.

Agregar una nueva prenda
Método: POST
URL: http://localhost:8080/tiendakali/public/index.php?resource=prendas
Cuerpo:
json
{
  "nombre": "",
  "marca_id": "",
  "stock": "",
  "talla": "",
  "precio": ""
}
Descripción: Crea una nueva prenda con los detalles proporcionados, vinculada a una marca específica mediante marca_id.

Actualizar una prenda existente
Método: PUT
URL: http://localhost:8080/tiendakali/public/index.php?resource=prendas
Cuerpo:
json
{
  "id": "",
  "nombre": "",
  "marca_id": "",
  "stock": "",
  "talla": "",
  "precio": ""
}
Descripción: Actualiza los detalles de una prenda existente identificada por el ID.

Eliminar una prenda
Método: DELETE
URL: http://localhost:8080/tiendakali/public/index.php?resource=prendas
Cuerpo:
json
{
  "id": ""
}
Descripción: Elimina una prenda identificada por el ID.

Ventas

Obtener todas las ventas
Método: GET
URL: http://localhost:8080/tiendakali/public/index.php?resource=ventas
Descripción: Recupera una lista de todas las ventas realizadas.

Agregar una nueva venta
Método: POST
URL: http://localhost:8080/tiendakali/public/index.php?resource=ventas
Cuerpo:
json
{
  "id_prenda": "",
  "cantidad": "",
  "fecha": ""
}
Descripción: Registra una nueva venta para una prenda específica con la cantidad vendida y la fecha de la venta.

Actualizar una venta existente
Método: PUT
URL: http://localhost:8080/tiendakali/public/index.php?resource=ventas
Cuerpo:
json
{
  "id": "",
  "id_prenda": "",
  "cantidad": "",
  "fecha": ""
}
Descripción: Actualiza los detalles de una venta existente identificada por el ID.

Eliminar una venta
Método: DELETE
URL: http://localhost:8080/tiendakali/public/index.php?resource=ventas
Cuerpo:
json
{
  "id": ""
}
Descripción: Elimina una venta identificada por el ID.

Reportes
Todas las marcas que tienen al menos una venta
Método: GET
URL: http://localhost:8080/tiendakali/public/index.php?resource=marcas&action=conVentas
Descripción: Obtiene una lista de todas las marcas que tienen al menos una venta registrada.

Prendas vendidas y su cantidad restante en stock
Método: GET
URL: http://localhost:8080/tiendakali/public/index.php?resource=prendas&action=vendidasConStock
Descripción: Recupera una lista de las prendas vendidas junto con la cantidad restante en stock.

Listado de las 5 marcas más vendidas y su cantidad de ventas
Método: GET
URL: http://localhost:8080/tiendakali/public/index.php?resource=marcas&action=top5MasVendidas
Descripción: Obtiene un listado de las 5 marcas más vendidas, junto con la cantidad de ventas correspondientes.

