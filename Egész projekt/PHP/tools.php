<?php
// ==============================================================================
// ESZKÖZÖK OLDAL - tools.php
// ==============================================================================
// Ez az oldal a termékek szűrésére és keresésére szolgál
// GET paraméterek: category (kategória szűrés), search (keresés)
// ==============================================================================

require_once 'config.php';

// --- GET PARAMÉTEREK KEZELÉSE ---
// category: kategória szűrés (pl. ?category=piercings)
// search: keresés (pl. ?search=acél)
$category = $_GET['category'] ?? 'all';   // Alapértelmezett: összes
$search = $_GET['search'] ?? '';           // Alapértelmezett: üres

// --- DINAMIKUS SQL LEKÉRDEZÉS ÉPÍTÉS ---
// A lekérdezés attól függ, milyen szűrőket adott meg a felhasználó
$sql = "SELECT p.*, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        WHERE 1=1";  // 1=1 mindig igaz, könnyű további AND feltételeket adni
$params = [];

// Ha van kategória szűrés (nem "all")
if ($category !== 'all') {
    $sql .= " AND c.slug = ?";      // SQL: AND categories.slug = ?
    $params[] = $category;            // Paraméter értéke
}

// Ha van keresési feltétel
if (!empty($search)) {
    $sql .= " AND (p.name LIKE ? OR p.description LIKE ?)"; // Név VAGY leírásban keres
    $params[] = "%$search%";        // LIKE paraméter %-kel a részleges egyezéshez
    $params[] = "%$search%";
}

// Rendezés: legújabb termékek elől
$sql .= " ORDER BY p.id DESC";

// --- ADATBÁZIS LEKÉRDEZÉS ---
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();      // Összes termék lekérése

// Kategóriák lekérése a szűrő listához
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>
<!DOCTYPE html>
<html lang="hu" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eszközök - KetRing</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        .dark body { background-color: oklch(0.145 0 0); }
    </style>
</head>
<body class="bg-black text-white min-h-screen">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-black border-b border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl tracking-[0.2em] uppercase text-white font-bold">
                        <a href="index.php">Ketring</a>
                    </h1>
                </div>
                <nav class="hidden md:flex items-center gap-8">
                    <a href="index.php" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Főoldal</a>
                    <a href="tools.php" class="text-sm text-white hover:text-white transition-colors uppercase tracking-wider">Eszközök</a>
                    <a href="contact.php" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Kapcsolat</a>
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
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl uppercase tracking-wider mb-2">Eszközök</h1>
            <p class="text-zinc-400 mb-8">Professzionális piercing eszközök és kellékek</p>
            
            <!-- Search Bar -->
            <form method="GET" class="mb-8">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Keresés..." class="w-full px-4 py-3 pl-12 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="hidden" name="category" value="<?php echo $category; ?>">
                    <button type="submit" class="bg-white text-black hover:bg-zinc-200 px-6 py-3 rounded-lg uppercase tracking-wider font-medium transition-colors">
                        Keresés
                    </button>
                </div>
            </form>
            
            <!-- Category Filters -->
            <div class="mb-8 flex flex-wrap gap-3">
                <a href="?category=all&search=<?php echo urlencode($search); ?>" 
                   class="filter-btn px-6 py-2 uppercase tracking-wider text-sm border transition-all <?php echo $category === 'all' ? 'bg-white text-black border-white' : 'bg-transparent text-zinc-400 border-zinc-700'; ?>">
                    Összes
                </a>
                <?php foreach ($categories as $cat): ?>
                    <a href="?category=<?php echo $cat['slug']; ?>&search=<?php echo urlencode($search); ?>" 
                       class="filter-btn px-6 py-2 uppercase tracking-wider text-sm border transition-all <?php echo $category === $cat['slug'] ? 'bg-white text-black border-white' : 'bg-transparent text-zinc-400 border-zinc-700'; ?>">
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            
            <!-- Products Grid -->
            <?php if (count($products) > 0): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($products as $product): ?>
                        <div class="product-card bg-zinc-900/50 border border-zinc-800 rounded-lg overflow-hidden hover:border-zinc-600 transition-colors" data-category="<?php echo $product['category_name']; ?>">
                            <div class="aspect-square relative overflow-hidden bg-zinc-800">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-full object-cover">
                                <?php if ($product['discount_price']): ?>
                                    <span class="absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 uppercase tracking-wider">
                                        -<?php echo round((1 - $product['discount_price'] / $product['price']) * 100); ?>%
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <h3 class="text-white uppercase tracking-wider text-sm mb-2"><?php echo htmlspecialchars($product['name']); ?></h3>
                                <p class="text-zinc-400 text-xs mb-3"><?php echo htmlspecialchars(substr($product['description'] ?? '', 0, 60)); ?>...</p>
                                <div class="flex items-center justify-between">
                                    <?php if ($product['discount_price']): ?>
                                        <div>
                                            <span class="text-red-400 font-bold"><?php echo number_format($product['discount_price'], 0, ',', ' '); ?> Ft</span>
                                            <span class="text-zinc-500 text-sm line-through ml-2"><?php echo number_format($product['price'], 0, ',', ' '); ?> Ft</span>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-white font-bold"><?php echo number_format($product['price'], 0, ',', ' '); ?> Ft</span>
                                    <?php endif; ?>
                                    <button onclick="addToCart(<?php echo $product['id']; ?>)" class="bg-white text-black hover:bg-zinc-200 px-3 py-1 text-xs uppercase tracking-wider transition-colors">
                                        Kosár
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <p class="text-zinc-400">Nincs találat a keresésedre.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-8 px-4 border-t border-zinc-800">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-zinc-500 text-sm">© 2026 Ketring. Minden jog fenntartva.</p>
        </div>
    </footer>
    
    <script>
        // Simple cart functionality
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        
        function addToCart(productId) {
            const existing = cart.find(item => item.id === productId);
            if (existing) {
                existing.quantity++;
            } else {
                cart.push({ id: productId, quantity: 1 });
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            alert('Termék hozzáadva a kosárhoz!');
        }
    </script>
</body>
</html>
