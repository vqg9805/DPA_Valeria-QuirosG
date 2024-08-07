<?php
require_once 'db/Database.php';
require_once 'controllers/MarcaController.php';
require_once 'controllers/PrendaController.php';
require_once 'controllers/VentaController.php';

$db = new Database();
$conn = $db->getConnection();

$marcaController = new MarcaController($conn);
$prendaController = new PrendaController($conn);
$ventaController = new VentaController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['resource'])) {
    switch ($_GET['resource']) {
        case 'marcas':
            $marcaController->handleRequest();
            break;
        case 'prendas':
            $prendaController->handleRequest();
            break;
        case 'ventas':
            $ventaController->handleRequest();
            break;
        default:
            echo json_encode(['message' => 'Resource not found']);
    }
}
?>
