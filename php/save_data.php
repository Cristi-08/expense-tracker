<?php
function salveazaCheltuiala($user_id, $suma, $categorie, $descriere, $data, $tip) {
    $fisier = __DIR__ . '/../data/expenses.json';
    $lista  = json_decode(file_get_contents($fisier), true) ?: [];
    $lista[] = [
        'id'        => uniqid(),
        'user_id'   => $user_id,
        'suma'      => (float) $suma,
        'categorie' => $categorie,
        'descriere' => $descriere,
        'data'      => $data,
        'tip'       => $tip,
    ];
    file_put_contents($fisier, json_encode($lista, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function getCheltuieliUser($user_id) {
    $fisier = __DIR__ . '/../data/expenses.json';
    $lista  = json_decode(file_get_contents($fisier), true) ?: [];
    return array_values(array_filter($lista, fn($r) => $r['user_id'] === $user_id));
}

function stergeCheltuiala($id, $user_id) {
    $fisier = __DIR__ . '/../data/expenses.json';
    $lista  = json_decode(file_get_contents($fisier), true) ?: [];
    $lista  = array_values(array_filter($lista, fn($r) => !($r['id'] === $id && $r['user_id'] === $user_id)));
    file_put_contents($fisier, json_encode($lista, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
?>
