<?php

class Uzytkownicy {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Dodanie nowego użytkownika i zwrócenie ID nowo dodanego użytkownika
    public function dodajUzytkownika($imie, $nazwisko, $email, $haslo) {
        try {
            // Użyj sekwencji do wygenerowania nowego ID
            $sql = "SELECT SEKWENCJA_UZYTKOWNICY.NEXTVAL AS new_id FROM dual";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $nowe_id = $row['NEW_ID']; // Nowy ID z sekwencji
            
            // Dodaj nowego użytkownika z wygenerowanym ID
            $sql = "INSERT INTO Uzytkownicy (uzytkownik_id, imie, nazwisko, email, haslo) VALUES (:id, :imie, :nazwisko, :email, :haslo)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $nowe_id);
            $stmt->bindParam(':imie', $imie);
            $stmt->bindParam(':nazwisko', $nazwisko);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':haslo', $haslo);
            $stmt->execute();
            
            return $nowe_id; // Zwracamy nowo wygenerowany ID
        } catch (PDOException $e) {
            echo "Błąd podczas dodawania użytkownika: " . $e->getMessage();
            return false;
        }
    }
    

    // Pobieranie wszystkich użytkowników
    public function pobierzUzytkownikow() {
        $sql = "SELECT * FROM Uzytkownicy";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Pobieranie użytkownika po ID
    public function pobierzUzytkownika($id) {
        $sql = "SELECT * FROM Uzytkownicy WHERE uzytkownik_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Pobieranie użytkownika po e-mailu
    public function pobierzUzytkownikaPoEmail($email) {
        try {
            $sql = "SELECT * FROM Uzytkownicy WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Zwraca dane użytkownika lub false
        } catch (PDOException $e) {
            echo "Błąd podczas pobierania użytkownika: " . $e->getMessage();
            return false;
        }
    }

    // Aktualizacja użytkownika
    public function aktualizujUzytkownika($id, $imie, $nazwisko, $email, $haslo) {
        $sql = "UPDATE Uzytkownicy SET imie = :imie, nazwisko = :nazwisko, email = :email, haslo = :haslo WHERE uzytkownik_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':imie', $imie);
        $stmt->bindParam(':nazwisko', $nazwisko);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':haslo', $haslo);
        return $stmt->execute();
    }

    // Usuwanie użytkownika
    public function usunUzytkownika($id) {
        $sql = "DELETE FROM Uzytkownicy WHERE uzytkownik_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
