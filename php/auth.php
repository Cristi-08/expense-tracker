<?php
// Preia actiunea trimisa din formular
$actiune = $_POST['actiune'] ?? '';

// Actiunea de inregistrare
if ($actiune === 'register') {
    $nume  = $_POST['nume']  ?? '';
    $email = $_POST['email'] ?? '';

    echo "Datele primite: nume = " . htmlspecialchars($nume) . ", email = " . htmlspecialchars($email);
}

// Actiunea de login
if ($actiune === 'login') {
    $email = $_POST['email'] ?? '';

    echo "Incercare login cu emailul: " . htmlspecialchars($email);
}

// Daca nu s-a trimis nicio actiune cunoscuta
if ($actiune !== 'register' && $actiune !== 'login') {
    echo "Actiune necunoscuta.";
}
?>
