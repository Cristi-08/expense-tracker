<?php
// Preia actiunea trimisa din formular
$actiune = $_POST['actiune'] ?? '';

// ============================================================
// INREGISTRARE
// ============================================================
if ($actiune === 'register') {

    // Preia si curata datele din formular
    $nume   = trim($_POST['nume']   ?? '');
    $email  = trim($_POST['email']  ?? '');
    $parola = trim($_POST['parola'] ?? '');

    // Validare: campuri goale
    if ($nume === '' || $email === '' || $parola === '') {
        header('Location: ../register.php?eroare=Toate+campurile+sunt+obligatorii');
        exit;
    }

    // Validare: format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../register.php?eroare=Adresa+de+email+nu+este+valida');
        exit;
    }

    // Validare: parola minim 6 caractere
    if (strlen($parola) < 6) {
        header('Location: ../register.php?eroare=Parola+trebuie+sa+aiba+minim+6+caractere');
        exit;
    }

    // Calea catre fisierul cu utilizatori
    $fisier = '../data/users.json';

    // Citeste utilizatorii existenti din JSON
    $continut    = file_get_contents($fisier);
    $utilizatori = json_decode($continut, true);

    // Daca fisierul era gol sau invalid, initializam un array gol
    if (!is_array($utilizatori)) {
        $utilizatori = [];
    }

    // Verifica daca emailul este deja inregistrat
    foreach ($utilizatori as $user) {
        if ($user['email'] === $email) {
            header('Location: ../register.php?eroare=Email+deja+inregistrat');
            exit;
        }
    }

    // Construieste utilizatorul nou
    $user_nou = [
        'id'                => uniqid(),
        'nume'              => $nume,
        'email'             => $email,
        'parola'            => password_hash($parola, PASSWORD_DEFAULT),
        'data_inregistrare' => date('Y-m-d H:i:s')
    ];

    // Adauga utilizatorul in lista si salveaza fisierul
    $utilizatori[] = $user_nou;
    file_put_contents($fisier, json_encode($utilizatori, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Redirecteaza cu mesaj de succes
    header('Location: ../register.php?succes=1');
    exit;
}

// ============================================================
// LOGIN (va fi implementat mai tarziu)
// ============================================================
if ($actiune === 'login') {
    $email = trim($_POST['email'] ?? '');
    echo "Incercare login cu emailul: " . htmlspecialchars($email);
}
?>
