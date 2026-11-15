<?php
if (PHP_SAPI !== 'cli') {
    exit('Uruchom w terminalu: php setup.php');
}

require 'baza.php';

$pdo->exec('CREATE TABLE IF NOT EXISTS uslugi (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nazwa TEXT NOT NULL,
    cena INTEGER NOT NULL,
    popularnosc INTEGER NOT NULL DEFAULT 0
)');

$pdo->exec('CREATE TABLE IF NOT EXISTS uzytkownicy (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    login TEXT NOT NULL UNIQUE,
    haslo_hash TEXT NOT NULL
)');

if ($pdo->query('SELECT COUNT(*) FROM uslugi')->fetchColumn() == 0) {
    $uslugi = [
        ['nazwa' => 'Przegląd podstawowy', 'cena' => 120, 'popularnosc' => 45],
        ['nazwa' => 'Przegląd sezonowy', 'cena' => 220, 'popularnosc' => 25],
        ['nazwa' => 'Wymiana dętki', 'cena' => 40, 'popularnosc' => 30],
        ['nazwa' => 'Centrowanie koła', 'cena' => 60, 'popularnosc' => 15],
        ['nazwa' => 'Wymiana łańcucha', 'cena' => 50, 'popularnosc' => 20],
    ];
    $z = $pdo->prepare('INSERT INTO uslugi (nazwa, cena, popularnosc) VALUES (:nazwa, :cena, :popularnosc)');
    foreach ($uslugi as $usluga) {
        $z->execute($usluga);
    }
}

if ($pdo->query('SELECT COUNT(*) FROM uzytkownicy')->fetchColumn() == 0) {
    $env = [];
    if (is_file(__DIR__ . '/.env')) {
        $linie = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES) ?: [];
        $linie = array_filter($linie, fn($linia) => !str_starts_with(trim($linia), '#'));
        $env = parse_ini_string(implode("\n", $linie)) ?: [];
    }
    $login = $env['ADMIN_LOGIN'] ?? 'admin';
    $haslo = $env['ADMIN_HASLO'] ?? '';

    if ($haslo === '') {
        exit("Uzupełnij ADMIN_HASLO w pliku .env (wzór: .env.example).\n");
    }

    $z = $pdo->prepare('INSERT INTO uzytkownicy (login, haslo_hash) VALUES (:login, :hash)');
    $z->execute(['login' => $login, 'hash' => password_hash($haslo, PASSWORD_DEFAULT)]);
}

echo "Baza gotowa.\n";
