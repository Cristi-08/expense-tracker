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

// Ziua 3 - if si for - numere pare si impare

$numere = [3, 8, 15, 22, 7, 14, 9, 6, 11, 20];
$pare = 0;
$impare = 0;

echo "<h2>Ziua 3 - Par sau Impar</h2>";
echo "<ul>";

for ($i = 0; $i < count($numere); $i++) {
    if ($numere[$i] % 2 == 0) {
        $pare++;
        echo "<li>" . $numere[$i] . " - par</li>";
    } else {
        $impare++;
        echo "<li>" . $numere[$i] . " - impar</li>";
    }
}

echo "</ul>";
echo "<p>Pare: " . $pare . "</p>";
echo "<p>Impare: " . $impare . "</p>";
?>
