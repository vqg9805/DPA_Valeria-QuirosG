<?php
class ReportController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    private function getMarcasConVentas() {
        $query = "SELECT * FROM MarcasConVentas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Obtener prendas vendidas con stock restante
    public function prendasVendidasConStock()
    {
        $query = "SELECT * FROM PrendasVendidasConStock";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    // Obtener top 5 marcas más vendidas
    public function top5MarcasMasVendidas()
    {
        $query = "SELECT * FROM Top5MarcasMasVendidas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }
}
?>
