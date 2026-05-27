<?php
// Ziua 2 - primul script PHP

$nume = "Expense Tracker";
$data = date("d.m.Y");

echo "<h2>Aplicatia: " . $nume . "</h2>";
echo "<p>Data: " . $data . "</p>";

$categorii = ["Mancare", "Transport", "Sanatate", "Altele"];

echo "<ul>";
foreach ($categorii as $cat) {
    echo "<li>" . $cat . "</li>";
}
echo "</ul>";
?>
