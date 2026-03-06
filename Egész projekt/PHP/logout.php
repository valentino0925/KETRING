<?php
// ==============================================================================
// KIJELENTKEZÉS - logout.php
// ==============================================================================
// Ez a fájl végzi a kijelentkezést:
// 1. Elindítja a session-t (hogy elérhető legyen)
// 2. Megsemmisíti a session-t (törli a bejelentkezési adatokat)
// 3. Átirányítja a felhasználót a főoldalra
// ==============================================================================

// Session indítása (hogy elérhessük a session változókat)
session_start();

// Session semmisítése - törli az összes session változót
// Ez kijelentkezteti a felhasználót
session_destroy();

// Átirányítás a főoldalra
header('Location: index.php');
exit;
