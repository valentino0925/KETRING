<?php
require_once 'config.php';

$products = $pdo->query("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC")->fetchAll();
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>
<!DOCTYPE html>
<html lang="hu" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KetRing - Piercing és Ékszerek</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
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
        
        .light .parallax-bg {
            filter: invert(1) brightness(1.2);
        }
        
        .product-card {
            transition: all 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body class="bg-black text-white transition-colors duration-300">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-black border-b border-zinc-800 header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <h1 class="text-2xl tracking-[0.2em] uppercase text-white font-bold">
                        Ketring
                    </h1>
                </div>

                <!-- asztali navigáció -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="#piercings" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider nav-link">Piercingek</a>
                    <a href="tools.php" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider nav-link">Eszközök</a>
                    <a href="#accessories" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider nav-link">Kellékek</a>
                    <a href="#about" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider nav-link">Rólam</a>
                </nav>

                <!-- Cart and Theme Toggle -->
                <div class="flex items-center gap-4">
                    <!-- keresés gomb -->
                    <button onclick="toggleSearch()" class="p-2 text-white hover:text-zinc-400 transition-colors" aria-label="Keresés">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    <!-- Theme Toggle -->
                    <button id="themeToggle" class="p-2 text-white hover:text-zinc-400 transition-colors" aria-label="Toggle theme">
                        <!-- Sun icon (visible in dark mode) -->
                        <svg id="sunIcon" class="hidden w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="4"></circle>
                            <path d="M12 2v2"></path>
                            <path d="M12 20v2"></path>
                            <path d="m4.93 4.93 1.41 1.41"></path>
                            <path d="m17.66 17.66 1.41 1.41"></path>
                            <path d="M2 12h2"></path>
                            <path d="M20 12h2"></path>
                            <path d="m6.34 17.66-1.41 1.41"></path>
                            <path d="m19.07 4.93-1.41 1.41"></path>
                        </svg>
                        <!-- Moon icon (visible in light mode) -->
                        <svg id="moonIcon" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                        </svg>
                    </button>

                    <!-- Cart button -->
                    <button onclick="toggleCart(true)" class="relative p-2 text-white hover:text-zinc-400 transition-colors">
                        <svg xmlns="http://www.w3.org/width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="8" cy="21" r="1"></circle>
                            <circle cx="19" cy="21" r="1"></circle>
                            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.1-5.38a1 1 0 0 0-1-1.21H5.75"></path>
                        </svg>
                        <span id="cartCount" class="hidden absolute -top-1 -right-1 bg-white text-black text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center">0</span>
                    </button>

                    <!-- User Menu -->
                    <?php if (isLoggedIn()): ?>
                        <?php if (isAdmin()): ?>
                            <a href="admin.php" class="text-sm text-red-400 hover:text-red-300 uppercase tracking-wider">Admin</a>
                        <?php endif; ?>
                        <a href="logout.php" class="text-sm text-zinc-400 hover:text-white uppercase tracking-wider">Kijelentkezés</a>
                    <?php else: ?>
                        <a href="login.php" class="text-sm text-zinc-400 hover:text-white uppercase tracking-wider">Bejelentkezés</a>
                    <?php endif; ?>

                    <!-- Mobile menu toggle -->
                    <button onclick="toggleMobileMenu()" class="md:hidden p-2 text-white">
                        <svg id="menuIcon" xmlns="http://www.w3.org/width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="4" x2="20" y1="12" y2="12"></line>
                            <line x1="4" x2="20" y1="6" y2="6"></line>
                            <line x1="4" x2="20" y1="18" y2="18"></line>
                        </svg>
                        <svg id="closeIcon" class="hidden" xmlns="http://www.w3.org/width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Search Bar (Hidden by default) -->
            <div id="searchBar" class="hidden pb-4">
                <form action="tools.php" method="GET" class="flex gap-2">
                    <input type="text" name="search" placeholder="Termék keresése..." class="flex-1 px-4 py-2 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white">
                    <button type="submit" class="px-4 py-2 bg-white text-black rounded-lg uppercase tracking-wider text-sm">Keresés</button>
                </form>
            </div>

            <!-- Mobile Menu (hidden by default) -->
            <div id="mobileMenu" class="hidden md:hidden py-4 border-t border-zinc-800">
                <nav class="flex flex-col gap-4">
                    <a href="#piercings" onclick="toggleMobileMenu()" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Piercingek</a>
                    <a href="tools.php" onclick="toggleMobileMenu()" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Eszközök</a>
                    <a href="#accessories" onclick="toggleMobileMenu()" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Kiegészítők</a>
                    <a href="#about" onclick="toggleMobileMenu()" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Rólam</a>
                    <a href="contact.php" onclick="toggleMobileMenu()" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Kapcsolat</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section with Parallax -->
    <section class="relative min-h-[60vh] flex items-center justify-center bg-gradient-to-b from-zinc-950 via-zinc-900 to-black border-b border-zinc-800 overflow-hidden">
        <!-- Parallax Background -->
        <div id="parallaxBg" class="absolute inset-0 z-0 parallax-bg">
            <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/80 via-zinc-900/60 to-black/90 z-10"></div>
            <!-- Image background - will be inverted in light mode -->
            <img src="images/nevtelen.webp" alt="" class="absolute inset-0 w-full h-full object-cover opacity-30">
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <div class="inline-block mb-4 px-4 py-2 border border-zinc-700 bg-zinc-900/50">
                <span class="text-zinc-400 text-xs uppercase tracking-[0.3em]">Est. 2026</span>
            </div>
            <h1 class="text-5xl sm:text-7xl md:text-8xl uppercase tracking-wider mb-6 text-white">
                Ketring
            </h1>
            <p class="text-lg sm:text-xl text-zinc-400 mb-8 max-w-2xl mx-auto tracking-wide">
                Minőségi piercingek és kiegészítők
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <button onclick="scrollToProducts()" class="rounded-xl flex items-center justify-center bg-white text-black hover:bg-zinc-200 px-4 h-12 uppercase tracking-wider transition-colors duration-200 font-medium">
                    Vásárlás
                    <svg xmlns="http://www.w3.org/width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </button>
                <a href="#about" class="border border-zinc-700 text-white hover:bg-zinc-900 px-8 h-12 uppercase tracking-wider transition-colors duration-200 font-medium flex items-center justify-center">
                    TÖBB
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-zinc-700 to-transparent"></div>
    </section>

    <!-- Main Content -->
    <div id="mainContent" class="min-h-screen bg-black text-white transition-colors duration-300">
        <main class="pt-16">
            <!-- Products Section -->
            <section id="products" class="py-16 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Search bar for products -->
                    <div class="mb-8">
                        <form action="tools.php" method="GET" class="flex gap-2 max-w-md mx-auto">
                            <input type="text" name="search" placeholder="Keresés termékek között..." class="flex-1 px-4 py-2 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white">
                            <button type="submit" class="px-4 py-2 bg-white text-black rounded-lg uppercase tracking-wider text-sm">Keresés</button>
                        </form>
                    </div>

                    <!-- Category Filters -->
                    <div class="mb-12 flex flex-wrap gap-3 justify-center">
                        <button onclick="filterByCategory('all', this)" class="filter-btn px-6 py-2 uppercase tracking-wider text-sm border transition-all bg-white text-black border-white">összes</button>
                        <?php foreach ($categories as $cat): ?>
                            <button onclick="filterByCategory('<?php echo $cat['slug']; ?>', this)" class="filter-btn px-6 py-2 uppercase tracking-wider text-sm border transition-all bg-transparent text-zinc-400 border-zinc-700"><?php echo htmlspecialchars($cat['name']); ?></button>
                        <?php endforeach; ?>
                    </div>

                    <!-- Product Grid -->
                    <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?php foreach ($products as $product): ?>
                            <div class="product-card bg-zinc-900/50 border border-zinc-800 rounded-lg overflow-hidden hover:border-zinc-600 transition-colors" data-category="<?php echo $product['category_name']; ?>">
                                <div class="aspect-square relative overflow-hidden bg-zinc-800">
                                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-full object-cover">
                                    <?php if ($product['discount_price']): ?>
                                        <span class="absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 uppercase tracking-wider">
                                            -<?php echo round((1 - $product['discount_price'] / $product['price']) * 100); ?>%
                                        </span>
                                    <?php endif; ?>
                                    <?php if ($product['stock'] == 0): ?>
                                        <span class="absolute top-2 left-2 bg-zinc-600 text-white text-xs px-2 py-1 uppercase tracking-wider">Nincs készleten</span>
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
                </div>
            </section>
        </main>
    </div>

    <!-- About Section -->
    <section id="about" class="py-20 px-4 sm:px-6 lg:px-8 bg-zinc-950 border-t border-zinc-800">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl uppercase tracking-wider mb-6 text-white">
                Rólam
            </h2>
            <p class="text-zinc-400 text-lg mb-8 leading-relaxed">
                Szia! Én vagyok a KetRing alapítója. Szenvedélyem a piercing és az ékszerek világa. Célom, hogy minden vásárlónak a legjobb minőségű termékeket kínáljam versenyképes áron.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <div class="p-6 border border-zinc-800 bg-zinc-900/50">
                    <h3 class="text-white uppercase tracking-wider mb-3">Minőség</h3>
                    <p class="text-zinc-500 text-sm">Csak a legjobb minőségű anyagokat használjuk</p>
                </div>
                <div class="p-6 border border-zinc-800 bg-zinc-900/50">
                    <h3 class="text-white uppercase tracking-wider mb-3">Szakértelem</h3>
                    <p class="text-zinc-500 text-sm">Évek tapasztalata a piercing világában</p>
                </div>
                <div class="p-6 border border-zinc-800 bg-zinc-900/50">
                    <h3 class="text-white uppercase tracking-wider mb-3">Ügyfélszolgálat</h3>
                    <p class="text-zinc-500 text-sm">Mindig itt vagyunk, ha kérdésed van</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 px-4 sm:px-6 lg:px-8 border-t border-zinc-800">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <h3 class="text-2xl uppercase tracking-[0.2em] text-white mb-2">Ketring</h3>
                    <p class="text-zinc-500 text-sm">Minőségi piercingek és kiegészítők</p>
                </div>
                <div class="flex gap-8 text-sm">
                    <a href="terms.php" class="text-zinc-500 hover:text-white transition-colors uppercase tracking-wider">ÁSZF</a>
                    <a href="contact.php" class="text-zinc-500 hover:text-white transition-colors uppercase tracking-wider">Kapcsolat</a>
                    <a href="terms.php" class="text-zinc-500 hover:text-white transition-colors uppercase tracking-wider">Adatvédelem</a>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-zinc-900 text-center">
                <p class="text-zinc-600 text-xs uppercase tracking-wider">
                    © 2026 Ketring. Minden jog fenntartva.
                </p>
            </div>
        </div>
    </footer>

    <!-- Cart Sidebar -->
    <div id="cartSidebar" class="fixed inset-y-0 right-0 w-full sm:w-[400px] bg-zinc-950 border-l border-zinc-800 z-50 transform translate-x-full transition-transform duration-300 flex flex-col">
        <div class="flex items-center justify-between p-6 border-b border-zinc-800">
            <h2 class="text-xl uppercase tracking-wider text-white font-bold">Kosár</h2>
            <button onclick="toggleCart(false)" class="p-2 text-zinc-400 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        </div>
        <div id="cartItems" class="flex-1 overflow-y-auto p-6 space-y-4"></div>
        <div class="p-6 border-t border-zinc-800 bg-zinc-900/50">
            <div class="flex items-center justify-between mb-6">
                <span class="text-zinc-400 uppercase tracking-wider text-sm">Összesen</span>
                <span id="cartTotal" class="text-xl text-white font-bold">0 Ft</span>
            </div>
            <button class="w-full bg-white text-black hover:bg-zinc-200 uppercase tracking-wider h-12 font-bold transition-colors">
                Tovább
            </button>
        </div>
    </div>

    <!-- Cart Overlay -->
    <div id="cartOverlay" onclick="toggleCart(false)" class="fixed inset-0 bg-black/50 z-40 opacity-0 pointer-events-none transition-opacity duration-300"></div>

    <script src="script.js"></script>
    <script src="card.js"></script>
    <script>
        // Cart functionality
        let cartItems = JSON.parse(localStorage.getItem('cart') || '[]');
        
        function addToCart(productId) {
            const existing = cartItems.find(item => item.id === productId);
            if (existing) {
                existing.quantity++;
            } else {
                cartItems.push({ id: productId, quantity: 1 });
            }
            localStorage.setItem('cart', JSON.stringify(cartItems));
            updateCartUI();
            toggleCart(true);
        }
        
        function updateCartUI() {
            const cartCountEl = document.getElementById('cartCount');
            const count = cartItems.reduce((sum, item) => sum + item.quantity, 0);
            
            if (cartCountEl) {
                if (count > 0) {
                    cartCountEl.innerText = count;
                    cartCountEl.classList.remove('hidden');
                } else {
                    cartCountEl.classList.add('hidden');
                }
            }
            
            renderCartSidebar();
        }
        
        function renderCartSidebar() {
            const cartItemsEl = document.getElementById('cartItems');
            const cartTotalEl = document.getElementById('cartTotal');
            
            if (!cartItemsEl) return;
            
            if (cartItems.length === 0) {
                cartItemsEl.innerHTML = '<p class="text-zinc-400 text-center">A kosarad üres</p>';
                if (cartTotalEl) cartTotalEl.innerText = '0 Ft';
                return;
            }
            
            // In a real app, you'd fetch product details from PHP
            // For now, show basic cart
            let html = '';
            let total = 0;
            
            cartItems.forEach((item, index) => {
                html += `
                    <div class="flex items-center gap-4 p-4 bg-zinc-900/50 border border-zinc-800 rounded-lg">
                        <div class="flex-1">
                            <p class="text-white uppercase text-sm">Termék #${item.id}</p>
                            <p class="text-zinc-400 text-xs">Mennyiség: ${item.quantity}</p>
                        </div>
                        <button onclick="removeFromCart(${index})" class="text-red-400 hover:text-red-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                `;
            });
            
            cartItemsEl.innerHTML = html;
            if (cartTotalEl) cartTotalEl.innerText = total.toLocaleString() + ' Ft';
        }
        
        function removeFromCart(index) {
            cartItems.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cartItems));
            updateCartUI();
        }
        
        function toggleCart(show) {
            const sidebar = document.getElementById('cartSidebar');
            const overlay = document.getElementById('cartOverlay');
            
            if (show) {
                sidebar?.classList.remove('translate-x-full');
                overlay?.classList.remove('pointer-events-none', 'opacity-0');
            } else {
                sidebar?.classList.add('translate-x-full');
                overlay?.classList.add('pointer-events-none', 'opacity-0');
            }
        }
        
        function toggleSearch() {
            const searchBar = document.getElementById('searchBar');
            searchBar?.classList.toggle('hidden');
        }
        
        function filterByCategory(category, btn) {
            const cards = document.querySelectorAll('.product-card');
            
            // Update button styles
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('bg-white', 'text-black', 'border-white');
                b.classList.add('bg-transparent', 'text-zinc-400', 'border-zinc-700');
            });
            btn.classList.remove('bg-transparent', 'text-zinc-400', 'border-zinc-700');
            btn.classList.add('bg-white', 'text-black', 'border-white');
            
            cards.forEach(card => {
                if (category === 'all') {
                    card.style.display = 'block';
                } else {
                    if (card.dataset.category && card.dataset.category.toLowerCase().includes(category.toLowerCase())) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        }
        
        function scrollToProducts() {
            const element = document.getElementById('products');
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }
        
        // Initialize cart UI on load
        document.addEventListener('DOMContentLoaded', () => {
            updateCartUI();
        });
    </script>
</body>
</html>
