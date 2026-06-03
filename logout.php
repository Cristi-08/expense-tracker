<?php
// Porneste sesiunea pentru a o putea distruge
session_start();

// Sterge toate datele din sesiune
session_destroy();

// Redirecteaza catre pagina principala
header('Location: index.php');
exit;
?>
