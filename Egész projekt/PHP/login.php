<?php
// ==============================================================================
// BEJELENTKEZÉS / REGISZTRÁCIÓ OLDAL - login.php
// ==============================================================================
// Funkciók:
// - Bejelentkezés meglévő fiókkal
// - Új felhasználó regisztrálása
// - Jelszó bcrypt hash-elés (biztonság)
// ==============================================================================

require_once 'config.php';

// Üzenet változók (hibák/sikeres üzenetek megjelenítéséhez)
$message = '';
$messageType = '';

// --- POST KÉRÉSEK KEZELÉSE ---
// Ha a felhasználó beküld egy űrlapot (bejelentkezés vagy regisztráció)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        // Beérkező adatok tisztítása
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        // --- BEJELENTKEZÉS LOGIKA ---
        if ($_POST['action'] === 'login') {
            // Ellenőrzés: kitöltötte-e a mezőket
            if (empty($username) || empty($password)) {
                $message = 'Kérlek töltsd ki az összes mezőt!';
                $messageType = 'error';
            } else {
                // Felhasználó keresése az adatbázisban (username VAGY email alapján)
                $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
                $stmt->execute([$username, $username]);
                $user = $stmt->fetch();
                
                // DEBUG: Ha nincs felhasználó, írd ki
                if (!$user) {
                    $message = 'Nincs ilyen felhasználó. Regisztrálj először!';
                    $messageType = 'error';
                }
                // Jelszó ellenőrzése (bcrypt hash összehasonlítás)
                elseif (password_verify($password, $user['password'])) {
                    // Sikeres bejelentkezés - session változók beállítása
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    
                    // Átirányítás a főoldalra
                    header('Location: index.php');
                    exit;
                } else {
                    $message = 'Hibás felhasználónév vagy jelszó!';
                    $messageType = 'error';
                }
            }
        }
        // --- REGISZTRÁCIÓ LOGIKA ---
        elseif ($_POST['action'] === 'register') {
            // Validáció: minden mező kitöltve?
            if (empty($username) || empty($email) || empty($password)) {
                $message = 'Kérlek töltsd ki az összes mezőt!';
                $messageType = 'error';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Email formátum ellenőrzése
                $message = 'Érvénytelen email cím!';
                $messageType = 'error';
            } else {
                // Ellenőrzés: már létezik-e ez a felhasználó/email?
                $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
                $stmt->execute([$username, $email]);
                
                if ($stmt->fetch()) {
                    // Már van ilyen felhasználó
                    $message = 'Ez a felhasználónév vagy email már foglalt!';
                    $messageType = 'error';
                } else {
                    // Új felhasználó létrehozása
                    // Jelszó hash-elése bcrypt-el (biztonságos!)
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    
                    // Admin kód ellenőrzése (titkos kód: "admin2026")
                    $adminCode = $_POST['admin_code'] ?? '';
                    $role = ($adminCode === 'admin2026') ? 'admin' : 'user';
                    
                    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
                    
                    if ($stmt->execute([$username, $email, $hashedPassword, $role])) {
                        if ($role === 'admin') {
                            $message = 'Sikeres admin regisztráció! Most már bejelentkezhetsz.';
                        } else {
                            $message = 'Sikeres regisztráció! Most már bejelentkezhetsz.';
                        }
                        $messageType = 'success';
                    } else {
                        $message = 'Hiba történt a regisztráció során!';
                        $messageType = 'error';
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="hu" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés - KetRing</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: system-ui, -apple-system, sans-serif;
        }
        .dark body {
            background-color: oklch(0.145 0 0);
        }
        :root {
            --bg-primary: oklch(0.98 0 0);
            --text-primary: oklch(0.2 0 0);
            --border-color: oklch(0.92 0 0);
        }
        .dark {
            --bg-primary: oklch(0.145 0 0);
            --text-primary: oklch(0.98 0 0);
            --border-color: oklch(0.3 0 0);
        }
        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-white dark:bg-black text-black dark:text-white transition-colors duration-300">
    <div class="w-full max-w-md p-8">
        <!-- Logo -->
        <div class="text-center mb-8">
            <h1 class="text-4xl tracking-[0.2em] uppercase font-bold">Ketring</h1>
        </div>
        
        <!-- Message -->
        <?php if ($message): ?>
            <div class="mb-6 p-4 rounded-lg <?php echo $messageType === 'success' ? 'bg-green-900/50 text-green-400 border border-green-800' : 'bg-red-900/50 text-red-400 border border-red-800'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <!-- Toggle Buttons -->
        <div class="flex mb-6 border-b border-zinc-700">
            <button onclick="showForm('login')" id="loginBtn" class="flex-1 py-3 text-center uppercase tracking-wider text-sm font-medium border-b-2 border-white text-white">
                Bejelentkezés
            </button>
            <button onclick="showForm('register')" id="registerBtn" class="flex-1 py-3 text-center uppercase tracking-wider text-sm font-medium border-b-2 border-transparent text-zinc-400">
                Regisztráció
            </button>
        </div>
        
        <!-- Login Form -->
        <form id="loginForm" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="login">
            <div>
                <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Felhasználónév vagy Email</label>
                <input type="text" name="username" class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white transition-colors">
            </div>
            <div>
                <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Jelszó</label>
                <input type="password" name="password" class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white transition-colors">
            </div>
            <button type="submit" class="w-full bg-white text-black hover:bg-zinc-200 py-3 rounded-lg uppercase tracking-wider font-medium transition-colors">
                Bejelentkezés
            </button>
        </form>
        
        <!-- Register Form -->
        <form id="registerForm" method="POST" class="space-y-4 hidden">
            <input type="hidden" name="action" value="register">
            <div>
                <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Felhasználónév</label>
                <input type="text" name="username" class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white transition-colors">
            </div>
            <div>
                <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Email</label>
                <input type="email" name="email" class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white transition-colors">
            </div>
            <div>
                <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Jelszó</label>
                <input type="password" name="password" class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white transition-colors">
            </div>
            <div>
                <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Admin kód (opcionális)</label>
                <input type="text" name="admin_code" placeholder="Ha admin szeretnél lenni" class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white transition-colors">
            </div>
            <button type="submit" class="w-full bg-white text-black hover:bg-zinc-200 py-3 rounded-lg uppercase tracking-wider font-medium transition-colors">
                Regisztráció
            </button>
        </form>
        
        <!-- Back to Home -->
        <div class="mt-6 text-center">
            <a href="index.php" class="text-zinc-400 hover:text-white text-sm uppercase tracking-wider transition-colors">
                ← Vissza a főoldalra
            </a>
        </div>
    </div>
    
    <script>
        function showForm(form) {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const loginBtn = document.getElementById('loginBtn');
            const registerBtn = document.getElementById('registerBtn');
            
            if (form === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                loginBtn.classList.add('border-white', 'text-white');
                loginBtn.classList.remove('border-transparent', 'text-zinc-400');
                registerBtn.classList.add('border-transparent', 'text-zinc-400');
                registerBtn.classList.remove('border-white', 'text-white');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                registerBtn.classList.add('border-white', 'text-white');
                registerBtn.classList.remove('border-transparent', 'text-zinc-400');
                loginBtn.classList.add('border-transparent', 'text-zinc-400');
                loginBtn.classList.remove('border-white', 'text-white');
            }
        }
    </script>
</body>
</html>
