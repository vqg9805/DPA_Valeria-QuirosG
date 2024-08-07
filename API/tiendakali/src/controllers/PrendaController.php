<?php
class PrendaController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : '';

        if ($action == 'vendidasYStock') {
            $this->getPrendasVendidasConStock();
        } else {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if (isset($_GET['id'])) {
                        $this->getPrenda($_GET['id']);
                    } else {
                        $this->getAllPrendas();
                    }
                    break;
                case 'POST':
                    $this->createPrenda();
                    break;
                case 'PUT':
                    $this->updatePrenda();
                    break;
                case 'DELETE':
                    $this->deletePrenda();
                    break;
                default:
                    echo json_encode(['message' => 'Method not allowed']);
            }
        }
    }

    public function getAllPrendas() {
        $query = "SELECT * FROM Prendas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    public function getPrenda($id) {
        $query = "SELECT * FROM Prendas WHERE idPrenda = :idPrenda";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idPrenda', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    public function getPrendasVendidasConStock() {
        $query = "SELECT * FROM PrendasVendidasConStock";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    public function createPrenda() {
        $data = json_decode(file_get_contents('php://input'), true);
        $query = "INSERT INTO Prendas (nombre, marca_id, idInventario) VALUES (:nombre, :marca_id, :idInventario)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':marca_id', $data['marca_id']);
        $stmt->bindParam(':idInventario', $data['idInventario']);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Prenda created successfully']);
        } else {
            echo json_encode(['message' => 'Error creating prenda']);
        }
    }

    public function updatePrenda() {
        $data = json_decode(file_get_contents('php://input'), true);
        $query = "UPDATE Prendas SET nombre = :nombre, marca_id = :marca_id, idInventario = :idInventario WHERE idPrenda = :idPrenda";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':marca_id', $data['marca_id']);
        $stmt->bindParam(':idInventario', $data['idInventario']);
        $stmt->bindParam(':idPrenda', $data['idPrenda']);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Prenda updated successfully']);
        } else {
            echo json_encode(['message' => 'Error updating prenda']);
        }
    }

    public function deletePrenda() {
        $idPrenda = isset($_GET['idPrenda']) ? $_GET['idPrenda'] : '';
        $query = "DELETE FROM Prendas WHERE idPrenda = :idPrenda";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idPrenda', $idPrenda);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Prenda deleted successfully']);
        } else {
            echo json_encode(['message' => 'Error deleting prenda']);
        }
    }
}
