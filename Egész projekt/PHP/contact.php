<?php
require_once 'config.php';

$message = '';
$messageType = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message_text = trim($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($subject) || empty($message_text)) {
        $message = 'Kérlek töltsd ki az összes mezőt!';
        $messageType = 'error';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Érvénytelen email cím!';
        $messageType = 'error';
    } else {

        $message = 'Köszönjük az üzeneteded! Hamarosan válaszolunk.';
        $messageType = 'success';
    }
}
?>
<!DOCTYPE html>
<html lang="hu" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapcsolat - KetRing</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-black text-white min-h-screen">

    <header class="fixed top-0 left-0 right-0 z-50 bg-black border-b border-zinc-800 dark:bg-black dark:border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl tracking-[0.2em] uppercase text-white font-bold">
                        <a href="index.php">Ketring</a>
                    </h1>
                </div>
                <nav class="hidden-center gap-8 md:flex items">
                    <a href="index.php" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Főoldal</a>
                    <a href="tools.php" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Eszközök</a>
                    <a href="contact.php" class="text-sm text-white hover:text-white transition-colors uppercase tracking-wider">Kapcsolat</a>
                    <?php if (isLoggedIn()): ?>
                        <?php if (isAdmin()): ?>
                            <a href="admin.php" class="text-sm text-red-400 hover:text-red-300 uppercase tracking-wider">Admin</a>
                        <?php endif; ?>
                        <span class="text-sm text-zinc-400"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <a href="logout.php" class="text-sm text-zinc-400 hover:text-white uppercase tracking-wider">Kijelentkezés</a>
                    <?php else: ?>
                        <a href="login.php" class="text-sm text-zinc-400 hover:text-white uppercase tracking-wider">Bejelentkezés</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>

    <main class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl uppercase tracking-wider mb-2 text-center">Kapcsolat</h1>
            <p class="text-zinc-400 text-center mb-12">Írj nekünk, és hamarosan válaszolunk!</p>
      
            <?php if ($message): ?>
                <div class="mb-8 p-4 rounded-lg <?php echo $messageType === 'success' ? 'bg-green-900/50 text-green-400 border border-green-800' : 'bg-red-900/50 text-red-400 border border-red-800'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Név *</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Email *</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white transition-colors">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Tárgy *</label>
                    <input type="text" name="subject" required class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white transition-colors">
                </div>
                
                <div>
                    <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Üzenet *</label>
                    <textarea name="message" rows="6" required class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white transition-colors resize-none"></textarea>
                </div>
                
                <button type="submit" class="bg-white text-black hover:bg-zinc-200 px-8 py-3 rounded-lg uppercase tracking-wider font-medium transition-colors">
                    Küldés
                </button>
            </form>
         
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 border border-zinc-800 bg-zinc-900/50 text-center">
                    <div class="w-12 h-12 mx-auto mb-4 flex items-center justify-center bg-zinc-800 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-white uppercase tracking-wider mb-2">Email</h3>
                    <p class="text-zinc-400 text-sm">info@ketring.hu</p>
                </div>
                <div class="p-6 border border-zinc-800 bg-zinc-900/50 text-center">
                    <div class="w-12 h-12 mx-auto mb-4 flex items-center justify-center bg-zinc-800 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="text-white uppercase tracking-wider mb-2">Telefon</h3>
                    <p class="text-zinc-400 text-sm">+36 30 123 4567</p>
                </div>
                <div class="p-6 border border-zinc-800 bg-zinc-900/50 text-center">
                    <div class="w-12 h-12 mx-auto mb-4 flex items-center justify-center bg-zinc-800 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-white uppercase tracking-wider mb-2">Cím</h3>
                    <p class="text-zinc-400 text-sm">Budapest, Magyarország</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-8 px-4 border-t border-zinc-800">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-zinc-500 text-sm">© 2026 Ketring. Minden jog fenntartva.</p>
        </div>
    </footer>
</body>
</html>
