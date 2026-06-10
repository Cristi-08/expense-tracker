<?php
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
    <title>ExpenseTracker</title>
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
            <a href="register.php" class="btn btn-ghost-accent nav-cta">Incepe gratuit</a>
        </nav>
        <div class="header-controls">
            <button class="theme-toggle" id="theme-toggle" type="button" aria-label="Schimba tema">🌙</button>
            <button id="lang-btn" type="button" class="lang-btn">RO</button>
        </div>
    </div>
</header>

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <span class="badge">Gratuit pentru totdeauna</span>
            <h1>Controleaza-ti<br>cheltuielile.</h1>
            <p>Adauga tranzactii, urmareste soldul si intelege unde se duc banii tai.</p>
            <div class="hero-actions">
                <a href="register.php" class="btn btn-accent">Creeaza cont</a>
                <a href="#cum-functioneaza" class="btn btn-secondary">Vezi cum functioneaza</a>
            </div>
            <div class="hero-preview">
                <div class="hero-stat">
                    <span>Sold curent</span>
                    <span class="text-green">+4.250 lei</span>
                </div>
                <div class="hero-stat">
                    <span>Cheltuieli luna</span>
                    <span>1.840 lei</span>
                </div>
                <div class="hero-stat">
                    <span>Venituri luna</span>
                    <span>6.090 lei</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="how-it-works" id="cum-functioneaza">
    <div class="container">
        <h2 class="section-heading">Simplu de folosit</h2>
        <p class="section-subtitle">Trei pasi si esti gata.</p>
        <div class="steps-grid">
            <div class="step-card">
                <span class="step-number">01</span>
                <h3>Creeaza cont</h3>
                <p>Inregistrare in 30 de secunde, fara date bancare.</p>
            </div>
            <div class="step-card">
                <span class="step-number">02</span>
                <h3>Adauga tranzactii</h3>
                <p>Cheltuieli si venituri pe 6 categorii predefinite.</p>
            </div>
            <div class="step-card">
                <span class="step-number">03</span>
                <h3>Urmareste soldul</h3>
                <p>Soldul se calculeaza automat in timp real.</p>
            </div>
        </div>
    </div>
</section>

<section class="features">
    <div class="container">
        <h2 class="section-heading">Tot ce ai nevoie</h2>
        <div class="features-grid">
            <div class="feature-card">
                <h3>Categorii multiple</h3>
                <p>Mancare, Transport, Sanatate, Distractie, Utilitati, Altele</p>
            </div>
            <div class="feature-card">
                <h3>Sold in timp real</h3>
                <p>Calculat automat din toate tranzactiile</p>
            </div>
            <div class="feature-card">
                <h3>Istoric complet</h3>
                <p>Toate tranzactiile intr-un singur loc</p>
            </div>
            <div class="feature-card">
                <h3>Dark mode</h3>
                <p>Interfata intunecata pentru confort vizual</p>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container footer-inner">
        <span class="muted">&copy; 2026 ExpenseTracker</span>
        <div class="footer-links">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="contact.php">Contact</a>
        </div>
    </div>
</footer>

<script src="js/script.js"></script>
</body>
</html>
