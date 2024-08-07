<?php
require_once '../src/controllers/MarcaController.php';
require_once '../src/controllers/PrendaController.php';
require_once '../src/controllers/VentaController.php';

// Conexión a la base de datos
$dsn = 'mysql:host=localhost;dbname=tiendakali';
$username = 'root';
$password = '';
$options = [];

try {
    $conn = new PDO($dsn, $username, $password, $options);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

$resource = isset($_GET['resource']) ? $_GET['resource'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($resource) {
    case 'marcas':
        $controller = new MarcaController($conn);
        if ($action == 'conVentas') {
            $controller->getMarcasConVentas();
        } elseif ($action == 'top5MasVendidas') {
            $controller->getTop5MarcasMasVendidas();
        } else {
            $controller->handleRequest();
        }
        break;
    case 'prendas':
        $controller = new PrendaController($conn);
        if ($action == 'vendidasYStock') {
            $controller->getPrendasVendidasConStock();
        } else {
            $controller->handleRequest();
        }
        break;
    case 'ventas':
        $controller = new VentaController($conn);
        $controller->handleRequest();
        break;
    default:
        echo json_encode(['message' => 'Resource not found']);
        exit;
}
