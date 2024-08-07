<?php
// src/controllers/VentaController.php
class VentaController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function handleRequest() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->getVentas();
                break;
            case 'POST':
                $this->createVenta();
                break;
            case 'PUT':
                $this->updateVenta();
                break;
            case 'DELETE':
                $this->deleteVenta();
                break;
            default:
                echo json_encode(['message' => 'Method not allowed']);
        }
    }

    private function getVentas() {
        $query = "SELECT * FROM Venta";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($ventas);
    }

    private function createVenta() {
        $data = json_decode(file_get_contents("php://input"));
        $query = "INSERT INTO Venta (id_prenda, cantidad, fecha) VALUES (:id_prenda, :cantidad, :fecha)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_prenda", $data->id_prenda);
        $stmt->bindParam(":cantidad", $data->cantidad);
        $stmt->bindParam(":fecha", $data->fecha);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Venta created']);
        } else {
            echo json_encode(['message' => 'Venta not created']);
        }
    }

    private function updateVenta() {
        $data = json_decode(file_get_contents("php://input"));
        $query = "UPDATE Venta SET id_prenda = :id_prenda, cantidad = :cantidad, fecha = :fecha WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_prenda", $data->id_prenda);
        $stmt->bindParam(":cantidad", $data->cantidad);
        $stmt->bindParam(":fecha", $data->fecha);
        $stmt->bindParam(":id", $data->id);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Venta updated']);
        } else {
            echo json_encode(['message' => 'Venta not updated']);
        }
    }

    private function deleteVenta() {
        $data = json_decode(file_get_contents("php://input"));
        $query = "DELETE FROM Venta WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $data->id);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Venta deleted']);
        } else {
            echo json_encode(['message' => 'Venta not deleted']);
        }
    }
}
?>