<?php

class Wydarzenia {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Dodanie nowego wydarzenia
    public function dodajWydarzenie($nazwa, $data_wydarzenia, $miejsce, $opis) {
        $sql = "INSERT INTO Wydarzenia (nazwa, data_wydarzenia, miejsce, opis) VALUES (:nazwa, TO_DATE(:data_wydarzenia, 'YYYY-MM-DD'), :miejsce, :opis)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nazwa', $nazwa);
        $stmt->bindParam(':data_wydarzenia', $data_wydarzenia);
        $stmt->bindParam(':miejsce', $miejsce);
        $stmt->bindParam(':opis', $opis);
        return $stmt->execute();
    }

    // Pobieranie wszystkich wydarzeń
    public function pobierzWydarzenia() {
        try {
            $sql = "SELECT * FROM Wydarzenia";
            $stmt = $this->conn->prepare($sql);
    
            // Sprawdź, czy zapytanie się wykonuje
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        } catch (PDOException $e) {
            echo "Błąd PDO: " . $e->getMessage();
            return [];
        }
    }

    // Pobieranie wydarzenia po ID
    public function pobierzWydarzenie($id) {
        $sql = "SELECT * FROM Wydarzenia WHERE wydarzenie_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Aktualizacja wydarzenia
    public function aktualizujWydarzenie($id, $nazwa, $data_wydarzenia, $miejsce, $opis) {
        $sql = "UPDATE Wydarzenia SET nazwa = :nazwa, data_wydarzenia = TO_DATE(:data_wydarzenia, 'YYYY-MM-DD'), miejsce = :miejsce, opis = :opis WHERE wydarzenie_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nazwa', $nazwa);
        $stmt->bindParam(':data_wydarzenia', $data_wydarzenia);
        $stmt->bindParam(':miejsce', $miejsce);
        $stmt->bindParam(':opis', $opis);
        return $stmt->execute();
    }

    // Usuwanie wydarzenia
    public function usunWydarzenie($id) {
        $sql = "DELETE FROM Wydarzenia WHERE wydarzenie_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
