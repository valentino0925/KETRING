<?php
// ==============================================================================
// KONFIGURÁCIÓS FÁJL - KetRing Webshop
// ==============================================================================
// Ez a fájl tartalmazza az adatbázis kapcsolat beállításait és az alapvető
// session/user függvényeket. Minden más PHP fájl ezt használja.
// ==============================================================================

// --- ADATBÁZIS KAPCSOLAT BEÁLLÍTÁSOK ---
// Ezeket az adatokat kell módosítani, ha más szerveren futtatod
define('DB_HOST', 'localhost');     // Az adatbázis szerver címe (általában localhost)
define('DB_USER', 'root');          // Az adatbázis felhasználóneve (XAMPP-nál: root)
define('DB_PASS', '');              // Az adatbázis jelszava (XAMPP-nál üres)
define('DB_NAME', 'ketring');       // Az adatbázis neve

// --- PDO ADATBÁZIS KAPCSOLAT LÉTREHOZÁSA ---
try {
    // PDO (PHP Data Objects) - modern és biztonságos adatbázis kapcsolat
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    
    // Hiba beállítások: Exception mode - hibákat dob exceptions-ként kezeljük
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Alapértelmezett fetch mode: ASSOC - asszociatív tömbként adja vissza az adatokat
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // Ha nem sikerül csatlakozni, meghal a script és kiírja a hibaüzenetet
    die("Adatbázis kapcsolódási hiba: " . $e->getMessage());
}

// --- SESSION INDÍTÁSA ---
// A session-t minden oldalon el kell indítani, hogy a bejelentkezés működjön
session_start();

// ==============================================================================
// FELHASZNÁLÓVAL KAPCSOLATOS FÜGGVÉNYEK
// ==============================================================================

/**
 * getCurrentUser() - A bejelentkezett felhasználó adatait adja vissza
 * @return array|null - Felhasználó adatai (id, username, role) vagy null
 */
function getCurrentUser() {
    if (isset($_SESSION['user_id'])) {
        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'role' => $_SESSION['role']
        ];
    }
    return null;
}

/**
 * isLoggedIn() - Ellenőrzi, hogy a felhasználó be van-e jelentkezve
 * @return bool - true ha bejelentkezett, false ha nem
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * isAdmin() - Ellenőrzi, hogy a felhasználó admin-e
 * @return bool - true ha admin, false ha nem
 */
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

/**
 * requireLogin() - Ha nincs bejelentkezve, átirányítja a login oldalra
 * Használata: olyan oldalakon, ahol bejelentkezés szükséges
 */
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

/**
 * requireAdmin() - Ha nem admin, átirányíti a főoldalra
 * Használata: az admin.php oldalon kötelező
 */
function requireAdmin() {
    if (!isAdmin()) {
        header('Location: index.php');
        exit;
    }
}
