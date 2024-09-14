<?php
include '../includes/db.php';
include '../includes/Rezerwacje.php';
include '../includes/Uzytkownicy.php'; // Zakładamy, że klasa Uzytkownicy istnieje

$rezerwacje = new Rezerwacje($conn);
$uzytkownicy = new Uzytkownicy($conn);

// Sprawdź, czy użytkownik wpisał e-mail
$email = isset($_POST['email']) ? $_POST['email'] : null;
$lista_rezerwacji = [];

if ($email) {
    // Pobierz użytkownika na podstawie e-maila
    $uzytkownik = $uzytkownicy->pobierzUzytkownikaPoEmail($email);
    
    // Sprawdź, czy użytkownik istnieje, zanim pobierzesz jego rezerwacje
    if ($uzytkownik && isset($uzytkownik['uzytkownik_id'])) {
        // Pobierz rezerwacje dla użytkownika
        $lista_rezerwacji = $rezerwacje->pobierzRezerwacjeDlaUzytkownika($uzytkownik['uzytkownik_id']);
    } else {
        echo "<p class='text-danger'>Nie znaleziono użytkownika o podanym adresie e-mail.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twoje Rezerwacje</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet"> <!-- Dołącz styl CSS -->
</head>
<body>

    <!-- Nawigacja -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">System Rezerwacji Biletów</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Strona główna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_event.php">Dodaj Wydarzenie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="your_reservations.php">Twoje Rezerwacje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_panel.php">Panel Administracyjny</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <h1 class="my-4 text-center">Twoje Rezerwacje</h1>

        <!-- Formularz do wpisania e-maila -->
        <form method="POST" action="" class="mb-4">
            <div class="mb-3">
                <label for="email" class="form-label">Wprowadź swój e-mail, aby zobaczyć rezerwacje:</label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="Twój adres e-mail">
            </div>
            <button type="submit" class="btn btn-primary w-100">Pokaż rezerwacje</button>
        </form>

        <!-- Wyświetlanie rezerwacji -->
        <div class="row">
            <?php if ($email && count($lista_rezerwacji) > 0): ?>
                <?php foreach ($lista_rezerwacji as $rezerwacja): ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Wydarzenie: <?php echo htmlspecialchars($rezerwacja['nazwa']); ?></h5>
                            <p class="card-text">
                                <strong>Wydarzenie ID:</strong> <?php echo htmlspecialchars($rezerwacja['wydarzenie_id']); ?><br>
                                <strong>Data rezerwacji:</strong> <?php echo htmlspecialchars($rezerwacja['data_rezerwacji']); ?><br>
                                <strong>Status:</strong> <?php echo htmlspecialchars($rezerwacja['status']); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php elseif ($email): ?>
                <p class="text-center text-warning">Brak rezerwacji dla podanego e-maila.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer bg-dark text-white text-center py-3">
        <div class="container">
            &copy; 2024 System Rezerwacji Biletów. Wszystkie prawa zastrzeżone.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
