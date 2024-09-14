<?php

class Rezerwacje {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Dodanie nowej rezerwacji
    public function dodajRezerwacje($uzytkownik_id, $wydarzenie_id, $status) {
        $sql = "INSERT INTO Rezerwacje (uzytkownik_id, wydarzenie_id, status, data_rezerwacji) VALUES (:uzytkownik_id, :wydarzenie_id, :status, SYSDATE)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':uzytkownik_id', $uzytkownik_id);
        $stmt->bindParam(':wydarzenie_id', $wydarzenie_id);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    // Pobieranie wszystkich rezerwacji
    public function pobierzRezerwacje() {
        $sql = "SELECT * FROM Rezerwacje";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Pobieranie wszystkich rezerwacji dla danego użytkownika
    public function pobierzRezerwacjeDlaUzytkownika($uzytkownik_id) {
        $sql = "SELECT r.wydarzenie_id, r.data_rezerwacji, r.status, w.nazwa 
                FROM Rezerwacje r
                JOIN Wydarzenia w ON r.wydarzenie_id = w.wydarzenie_id
                WHERE r.uzytkownik_id = :uzytkownik_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':uzytkownik_id', $uzytkownik_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Pobieranie rezerwacji po ID rezerwacji
    public function pobierzRezerwacjePoID($rezerwacja_id) {
        $sql = "SELECT * FROM Rezerwacje WHERE rezerwacja_id = :rezerwacja_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':rezerwacja_id', $rezerwacja_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Pobieranie rezerwacji na podstawie adresu e-mail użytkownika
    public function pobierzRezerwacjePoEmail($email) {
        $sql = "SELECT r.wydarzenie_id, r.data_rezerwacji, r.status, w.nazwa
                FROM Rezerwacje r
                JOIN Wydarzenia w ON r.wydarzenie_id = w.wydarzenie_id
                JOIN Uzytkownicy u ON r.uzytkownik_id = u.uzytkownik_id
                WHERE u.email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
