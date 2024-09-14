<?php
include '../includes/db.php'; // Połączenie z bazą danych
include '../includes/Rezerwacje.php'; // Klasa Rezerwacje
include '../includes/Uzytkownicy.php'; // Klasa Uzytkownicy

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wydarzenie_id = $_POST['wydarzenie_id'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $ilosc_miejsc = $_POST['ilosc_miejsc'];

    // Sprawdzenie, czy użytkownik już istnieje w bazie danych
    $uzytkownicy = new Uzytkownicy($conn);
    $uzytkownik = $uzytkownicy->pobierzUzytkownikaPoEmail($email);

    if (!$uzytkownik) {
        // Jeśli użytkownik nie istnieje, dodaj go do bazy danych
        $haslo = password_hash("haslo123", PASSWORD_DEFAULT); // Tymczasowe hasło
        $uzytkownik_id = $uzytkownicy->dodajUzytkownika($imie, $nazwisko, $email, $haslo);

        if (!$uzytkownik_id) {
            die("Błąd podczas dodawania użytkownika.");
        }
    } else {
        // Jeśli użytkownik istnieje, pobierz jego ID
        $uzytkownik_id = $uzytkownik['UZYTKOWNIK_ID'];
    }

    // Utwórz obiekt rezerwacji
    $rezerwacje = new Rezerwacje($conn);
    
    // Dodaj rezerwację do bazy danych
    if ($rezerwacje->dodajRezerwacje($uzytkownik_id, $wydarzenie_id, 'Zarezerwowane')) {
        echo "Rezerwacja dodana pomyślnie!";
    } else {
        echo "Błąd podczas dodawania rezerwacji.";
    }
}
?>
