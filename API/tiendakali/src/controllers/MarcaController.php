<?php
class MarcaController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : '';

        if ($action == 'conVentas') {
            $this->getMarcasConVentas();
        } elseif ($action == 'top5MasVendidas') {
            $this->getTop5MarcasMasVendidas();
        } else {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $this->getMarcas();
                    break;
                case 'POST':
                    $this->createMarca();
                    break;
                case 'PUT':
                    $this->updateMarca();
                    break;
                case 'DELETE':
                    $this->deleteMarca();
                    break;
                default:
                    echo json_encode(['message' => 'Method not allowed']);
            }
        }
    }

    public function getMarcas() {
        $query = "SELECT * FROM Marcas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    public function getMarcasConVentas() {
        $query = "SELECT * FROM MarcasConVentas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    public function getTop5MarcasMasVendidas() {
        $query = "SELECT * FROM Top5MarcasMasVendidas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    public function createMarca() {
        $data = json_decode(file_get_contents('php://input'), true);
        $query = "INSERT INTO Marcas (nombre) VALUES (:nombre)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $data['nombre']);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Marca created successfully']);
        } else {
            echo json_encode(['message' => 'Error creating marca']);
        }
    }

    public function updateMarca() {
        $data = json_decode(file_get_contents('php://input'), true);
        $query = "UPDATE Marcas SET nombre = :nombre WHERE idmarca = :idmarca";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':idmarca', $data['idmarca']);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Marca updated successfully']);
        } else {
            echo json_encode(['message' => 'Error updating marca']);
        }
    }

    public function deleteMarca() {
        $idmarca = isset($_GET['idmarca']) ? $_GET['idmarca'] : '';
        $query = "DELETE FROM Marcas WHERE idmarca = :idmarca";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idmarca', $idmarca);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Marca deleted successfully']);
        } else {
            echo json_encode(['message' => 'Error deleting marca']);
        }
    }
}
