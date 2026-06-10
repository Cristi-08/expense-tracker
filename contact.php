<?php
$trimis = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trimis = true;
}

$lang = $_COOKIE['lang'] ?? 'ro';
$translations = [
    'ro' => ['dashboard' => 'Panou principal', 'add' => 'Adauga', 'logout' => 'Deconectare', 'balance' => 'Sold curent', 'transactions' => 'Tranzactii', 'amount' => 'Suma (lei)', 'category' => 'Categorie', 'type' => 'Tip', 'date' => 'Data', 'description' => 'Descriere (optional)', 'income' => 'Venit', 'expense' => 'Cheltuiala', 'no_transactions' => 'Nu ai adaugat inca nicio tranzactie.', 'success' => 'Tranzactia a fost adaugata.'],
    'en' => ['dashboard' => 'Dashboard', 'add' => 'Add', 'logout' => 'Logout', 'balance' => 'Current balance', 'transactions' => 'Transactions', 'amount' => 'Amount (lei)', 'category' => 'Category', 'type' => 'Type', 'date' => 'Date', 'description' => 'Description (optional)', 'income' => 'Income', 'expense' => 'Expense', 'no_transactions' => 'No transactions yet.', 'success' => 'Transaction added.']
];
$t = $translations[$lang];
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
    <div class="container header-inner">
        <a href="index.php" class="logo">ExpenseTracker</a>
        <button class="hamburger" id="hamburger">
            <span></span><span></span><span></span>
        </button>
        <nav class="nav" id="nav">
            <a href="index.php">Acasa</a>
            <a href="contact.php">Contact</a>
            <a href="login.php" class="nav-login">Login</a>
            <a href="register.php" class="btn btn-accent nav-cta">Register</a>
        </nav>
        <div class="header-controls">
            <button class="theme-toggle" id="theme-toggle" type="button" aria-label="Schimba tema">🌙</button>
            <button id="lang-btn" type="button" class="lang-btn">RO</button>
        </div>
    </div>
</header>

<div class="form-wrap">
    <div class="form-box">
        <h1>Contact</h1>

        <?php if ($trimis): ?>
            <div class="alert alert-success">Mesajul a fost trimis!</div>
            <p class="form-link"><a href="index.php">Inapoi acasa</a></p>
        <?php else: ?>
            <form method="POST">
                <div class="form-group">
                    <label>Nume</label>
                    <input type="text" name="nume" placeholder="Numele tau" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="email@exemplu.com" required>
                </div>
                <div class="form-group">
                    <label>Mesaj</label>
                    <textarea name="mesaj" placeholder="Scrie mesajul tau..." required></textarea>
                </div>
                <button type="submit" class="btn btn-accent btn-full">Trimite</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<script src="js/script.js"></script>
</body>
</html>
