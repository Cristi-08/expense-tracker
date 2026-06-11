<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'php/save_data.php';

$lang = $_COOKIE['lang'] ?? 'ro';
$translations = [
    'ro' => ['dashboard' => 'Panou principal', 'add' => 'Adauga', 'logout' => 'Deconectare', 'balance' => 'Sold curent', 'transactions' => 'Tranzactii', 'amount' => 'Suma (lei)', 'category' => 'Categorie', 'type' => 'Tip', 'date' => 'Data', 'description' => 'Descriere (optional)', 'income' => 'Venit', 'expense' => 'Cheltuiala', 'no_transactions' => 'Nu ai adaugat inca nicio tranzactie.', 'success' => 'Tranzactia a fost adaugata.', 'show_all' => 'Vezi toate tranzactiile', 'show_less' => 'Arata mai putine'],
    'en' => ['dashboard' => 'Dashboard', 'add' => 'Add', 'logout' => 'Logout', 'balance' => 'Current balance', 'transactions' => 'Transactions', 'amount' => 'Amount (lei)', 'category' => 'Category', 'type' => 'Type', 'date' => 'Date', 'description' => 'Description (optional)', 'income' => 'Income', 'expense' => 'Expense', 'no_transactions' => 'No transactions yet.', 'success' => 'Transaction added.', 'show_all' => 'Show all transactions', 'show_less' => 'Show less']
];
$t = $translations[$lang];

$user_id   = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$eroare    = '';
$succes    = '';

if (isset($_GET['succes']) && $_GET['succes'] == 1) {
    $succes = $t['success'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $actiune = $_POST['actiune'] ?? '';

    if ($actiune === 'sterge') {
        $id = $_POST['id'] ?? '';
        stergeCheltuiala($id, $user_id);
        header('Location: dashboard.php');
        exit;
    }

    $suma      = trim($_POST['suma']      ?? '');
    $categorie = trim($_POST['categorie'] ?? '');
    $descriere = trim($_POST['descriere'] ?? '');
    $data      = trim($_POST['data']      ?? '');
    $tip       = trim($_POST['tip']       ?? '');

    if ($suma === '' || !is_numeric($suma) || (float)$suma <= 0) {
        $eroare = 'Suma trebuie sa fie un numar pozitiv.';
    } elseif ($data === '') {
        $eroare = 'Data este obligatorie.';
    } else {
        salveazaCheltuiala($user_id, $suma, $categorie, $descriere, $data, $tip);
        header('Location: dashboard.php?succes=1');
        exit;
    }
}

$tranzactii = getCheltuieliUser($user_id);
$total_tranzactii = count($tranzactii);

$sold = 0;
foreach ($tranzactii as $tr) {
    $sold += ($tr['tip'] === 'Venit') ? $tr['suma'] : -$tr['suma'];
}
$sold_class = $sold >= 0 ? 'balance-pos' : 'balance-neg';
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $t['dashboard'] ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
    <div class="container header-inner">
        <a href="dashboard.php" class="logo">ExpenseTracker</a>
        <nav class="page-nav">
            <a href="contact.php" style="color: #888888;">Contact</a>
            &nbsp;
            <a href="profile.php" class="text-green" style="color: #22c55e; font-weight: 600; margin-right: 12px;"><?= htmlspecialchars($user_name) ?></a>
        </nav>
    </div>
</header>

<div class="page-wrap">

    <div class="balance-card">
        <div class="balance-label"><?= $t['balance'] ?></div>
        <div class="balance-value <?= $sold_class ?>"><?= number_format($sold, 2) ?> lei</div>
    </div>

    <?php if ($eroare): ?>
        <div class="alert alert-error"><?= htmlspecialchars($eroare) ?></div>
    <?php endif; ?>
    <?php if ($succes): ?>
        <div class="alert alert-success" id="alert-succes"><?= htmlspecialchars($succes) ?></div>
    <?php endif; ?>

    <div class="card" style="margin-bottom:32px;">
        <p class="section-title">Adauga tranzactie</p>
        <form method="POST" class="quick-add">
            <div class="quick-add-row">
                <div class="form-group">
                    <label><?= $t['amount'] ?></label>
                    <input type="text" name="suma" inputmode="decimal" placeholder="0.00" required>
                </div>
                <div class="form-group">
                    <label><?= $t['category'] ?></label>
                    <select name="categorie" id="categorie-select">
                        <option value="Mancare">Mancare</option>
                        <option value="Transport">Transport</option>
                        <option value="Sanatate">Sanatate</option>
                        <option value="Distractie">Distractie</option>
                        <option value="Utilitati">Utilitati</option>
                        <option value="Altele">Altele</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><?= $t['type'] ?></label>
                    <select name="tip" id="tip-select">
                        <option value="Cheltuiala"><?= $t['expense'] ?></option>
                        <option value="Venit"><?= $t['income'] ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label><?= $t['date'] ?></label>
                    <input type="date" name="data" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <button type="submit" class="btn btn-accent"><?= $t['add'] ?></button>
            </div>
            <div class="form-group quick-add-desc">
                <input type="text" name="descriere" placeholder="<?= $t['description'] ?>">
            </div>
        </form>
    </div>

    <p class="section-title"><?= $t['transactions'] ?></p>

    <?php if (empty($tranzactii)): ?>
        <div class="card" style="text-align:center;padding:32px;">
            <span class="muted"><?= $t['no_transactions'] ?></span>
        </div>
    <?php else: ?>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th><?= $t['date'] ?></th>
                        <th>Descriere</th>
                        <th><?= $t['category'] ?></th>
                        <th><?= $t['type'] ?></th>
                        <th><?= $t['amount'] ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; foreach (array_reverse($tranzactii) as $tr): $i++; ?>
                        <tr<?= $i > 5 ? ' class="extra-row"' : '' ?>>
                            <td class="muted"><?= htmlspecialchars($tr['data']) ?></td>
                            <td><?= htmlspecialchars($tr['descriere'] ?: '—') ?></td>
                            <td><?= htmlspecialchars($tr['categorie']) ?></td>
                            <td class="muted"><?= $tr['tip'] === 'Venit' ? $t['income'] : $t['expense'] ?></td>
                            <td class="<?= $tr['tip'] === 'Venit' ? 'text-green' : 'text-red' ?>">
                                <?= number_format($tr['suma'], 2) ?> lei
                            </td>
                            <td>
                                <form method="POST" class="delete-form">
                                    <input type="hidden" name="actiune" value="sterge">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($tr['id']) ?>">
                                    <button type="submit" class="delete-btn" title="Sterge" aria-label="Sterge">&times;</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if ($total_tranzactii > 5): ?>
            <button id="toggle-transactions" type="button" class="btn btn-secondary" style="margin-top:16px;" data-expanded="0" data-show-all="<?= htmlspecialchars($t['show_all'] . ' (' . $total_tranzactii . ')') ?>" data-show-less="<?= htmlspecialchars($t['show_less']) ?>"><?= htmlspecialchars($t['show_all']) ?> (<?= $total_tranzactii ?>)</button>
        <?php endif; ?>
    <?php endif; ?>

</div>

<script src="js/script.js"></script>
<script>
const tipSelect = document.getElementById('tip-select');
const categorieSelect = document.getElementById('categorie-select');

const categoriiCheltuiala = ['Mancare', 'Transport', 'Sanatate', 'Distractie', 'Utilitati', 'Altele'];
const categoriiVenit = ['Salariu', 'Freelance', 'Afaceri', 'Altele'];

function updateCategorii() {
    const tip = tipSelect.value;
    const categorii = tip === 'Venit' ? categoriiVenit : categoriiCheltuiala;
    categorieSelect.innerHTML = '';
    categorii.forEach(cat => {
        const option = document.createElement('option');
        option.value = cat;
        option.textContent = cat;
        categorieSelect.appendChild(option);
    });
}

tipSelect.addEventListener('change', updateCategorii);
updateCategorii();

const alertSucces = document.getElementById('alert-succes');
if (alertSucces) {
    setTimeout(function () {
        alertSucces.classList.add('fade-out');
        setTimeout(function () {
            alertSucces.remove();
        }, 400);
    }, 3000);
}

const toggleBtn = document.getElementById('toggle-transactions');
if (toggleBtn) {
    const extraRows = document.querySelectorAll('.extra-row');
    toggleBtn.addEventListener('click', function () {
        const expanded = toggleBtn.dataset.expanded === '1';
        extraRows.forEach(row => row.classList.toggle('show', !expanded));
        toggleBtn.textContent = expanded ? toggleBtn.dataset.showAll : toggleBtn.dataset.showLess;
        toggleBtn.dataset.expanded = expanded ? '0' : '1';
    });
}
</script>

</body>
</html>
