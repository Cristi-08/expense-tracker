<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$fisier  = __DIR__ . '/data/users.json';
$utilizatori = json_decode(file_get_contents($fisier), true) ?: [];

// Gaseste indexul utilizatorului curent
$idx = null;
foreach ($utilizatori as $i => $u) {
    if ($u['id'] === $user_id) { $idx = $i; break; }
}

$user   = $utilizatori[$idx];
$eroare = '';
$succes = '';

$lang = $_COOKIE['lang'] ?? 'ro';
$translations = [
    'ro' => ['dashboard' => 'Panou principal', 'add' => 'Adauga', 'logout' => 'Deconectare', 'balance' => 'Sold curent', 'transactions' => 'Tranzactii', 'amount' => 'Suma (lei)', 'category' => 'Categorie', 'type' => 'Tip', 'date' => 'Data', 'description' => 'Descriere (optional)', 'income' => 'Venit', 'expense' => 'Cheltuiala', 'no_transactions' => 'Nu ai adaugat inca nicio tranzactie.', 'success' => 'Tranzactia a fost adaugata.'],
    'en' => ['dashboard' => 'Dashboard', 'add' => 'Add', 'logout' => 'Logout', 'balance' => 'Current balance', 'transactions' => 'Transactions', 'amount' => 'Amount (lei)', 'category' => 'Category', 'type' => 'Type', 'date' => 'Date', 'description' => 'Description (optional)', 'income' => 'Income', 'expense' => 'Expense', 'no_transactions' => 'No transactions yet.', 'success' => 'Transaction added.']
];
$t = $translations[$lang];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parola_curenta  = $_POST['parola_curenta']  ?? '';
    $parola_noua     = $_POST['parola_noua']     ?? '';
    $parola_confirma = $_POST['parola_confirma'] ?? '';

    if (!password_verify($parola_curenta, $user['parola'])) {
        $eroare = 'Parola curenta este incorecta.';
    } elseif (strlen($parola_noua) < 6) {
        $eroare = 'Parola noua trebuie sa aiba minim 6 caractere.';
    } elseif ($parola_noua !== $parola_confirma) {
        $eroare = 'Parolele noi nu coincid.';
    } else {
        $utilizatori[$idx]['parola'] = password_hash($parola_noua, PASSWORD_DEFAULT);
        file_put_contents($fisier, json_encode($utilizatori, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $succes = 'Parola a fost schimbata cu succes.';
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
    <div class="container header-inner">
        <a href="dashboard.php" class="logo">ExpenseTracker</a>
        <nav class="page-nav">
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php" class="btn btn-outline" style="padding:5px 14px;font-size:0.85rem;"><?= $t['logout'] ?></a>
        </nav>
        <div class="header-controls">
            <button class="theme-toggle" id="theme-toggle" type="button" aria-label="Schimba tema">🌙</button>
            <button id="lang-btn" type="button" class="lang-btn">RO</button>
        </div>
    </div>
</header>

<div class="form-wrap">
    <div class="form-box">
        <h1>Profil</h1>

        <div class="profile-field">
            <div class="label">Nume</div>
            <div class="value"><?= htmlspecialchars($user['nume']) ?></div>
        </div>
        <div class="profile-field">
            <div class="label">Email</div>
            <div class="value"><?= htmlspecialchars($user['email']) ?></div>
        </div>

        <div class="profile-divider"></div>
        <p class="section-title">Schimba parola</p>

        <?php if ($eroare): ?>
            <div class="alert alert-error"><?= htmlspecialchars($eroare) ?></div>
        <?php endif; ?>
        <?php if ($succes): ?>
            <div class="alert alert-success"><?= htmlspecialchars($succes) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Parola curenta</label>
                <input type="password" name="parola_curenta" required>
            </div>
            <div class="form-group">
                <label>Parola noua</label>
                <input type="password" name="parola_noua" placeholder="Minim 6 caractere" required>
            </div>
            <div class="form-group">
                <label>Confirma parola noua</label>
                <input type="password" name="parola_confirma" required>
            </div>
            <button type="submit" class="btn btn-accent btn-full">Salveaza parola</button>
        </form>

        <p class="form-link"><a href="dashboard.php">&larr; Inapoi la dashboard</a></p>
    </div>
</div>

<script src="js/script.js"></script>
</body>
</html>
