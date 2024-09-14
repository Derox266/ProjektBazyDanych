<?php
include '../includes/db.php';
include '../includes/Wydarzenia.php';

$wydarzenia = new Wydarzenia($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa = $_POST['nazwa'];
    $data_wydarzenia = $_POST['data_wydarzenia'];
    $miejsce = $_POST['miejsce'];
    $opis = $_POST['opis'];

    if ($wydarzenia->dodajWydarzenie($nazwa, $data_wydarzenia, $miejsce, $opis)) {
        $message = "Wydarzenie zostało dodane pomyślnie.";
    } else {
        $message = "Błąd podczas dodawania wydarzenia.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Wydarzenie</title>
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
                        <a class="nav-link active" aria-current="page" href="add_event.php">Dodaj Wydarzenie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="your_reservations.php">Twoje Rezerwacje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_panel.php">Panel Administracyjny</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <h1 class="my-4 text-center">Dodaj Nowe Wydarzenie</h1>

        <!-- Wiadomość po dodaniu wydarzenia -->
        <?php if (isset($message)): ?>
            <div class="alert alert-<?php echo ($message === "Wydarzenie zostało dodane pomyślnie.") ? 'success' : 'danger'; ?>" role="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- Formularz dodawania wydarzenia -->
        <form method="POST" action="add_event.php" class="bg-light p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="nazwa" class="form-label">Nazwa wydarzenia</label>
                <input type="text" class="form-control" id="nazwa" name="nazwa" required placeholder="Wprowadź nazwę wydarzenia">
            </div>
            <div class="mb-3">
                <label for="data_wydarzenia" class="form-label">Data wydarzenia</label>
                <input type="date" class="form-control" id="data_wydarzenia" name="data_wydarzenia" required>
            </div>
            <div class="mb-3">
                <label for="miejsce" class="form-label">Miejsce</label>
                <input type="text" class="form-control" id="miejsce" name="miejsce" required placeholder="Wprowadź miejsce wydarzenia">
            </div>
            <div class="mb-3">
                <label for="opis" class="form-label">Opis wydarzenia</label>
                <textarea class="form-control" id="opis" name="opis" rows="4" required placeholder="Wprowadź opis wydarzenia"></textarea>
            </div>
            <button type="submit" class="btn btn-success w-100">Dodaj wydarzenie</button>
        </form>
    </div>

    <footer class="footer bg-dark text-white text-center py-3">
        <div class="container">
            &copy; 2024 System Rezerwacji Biletów. Wszystkie prawa zastrzeżone.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
