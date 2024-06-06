Descripción del Proyecto:
El proyecto consiste en diseñar e implementar una base de datos para una tienda de ropa. Esta base de datos almacenará información sobre las marcas de ropa disponibles, las prendas en inventario y las transacciones de venta realizadas en la tienda.

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
