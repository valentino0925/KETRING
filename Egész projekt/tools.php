<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-black text-white transition-colors duration-300">
    <header class="fixed top-0 left-0 right-0 z-50 bg-black border-b border-zinc-800 dark:bg-black dark:border-zinc-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      
      <!-- Logo -->
      <div class="flex items-center">
        <h1 class="text-2xl tracking-[0.2em] uppercase text-white font-bold">
          Ketring
        </h1>
      </div>

      <!-- Asztali Navigáció -->
      <nav class="hidden md:flex items-center gap-8">
        <a href="#piercings" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Piercingek</a>
        <a href="#tools" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Eszközök</a>
        <a href="#accessories" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Kellékek</a>
        <a href="#about" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Rólam</a>
      </nav>

      <!-- Kosár és Theme Toggle -->
      <div class="flex items-center gap-4">
        <!-- Theme Toggle -->
        <button id="themeToggle" class="p-2 text-white hover:text-zinc-400 transition-colors" aria-label="Toggle theme">
          <!-- Sun ikon (light mode-ra, darkban látszik) -->
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
          <!-- Moon ikon (dark mode-ra, lightban látszik) -->
          <svg id="moonIcon" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
          </svg>
        </button>

        <!-- Kosár gomb -->
        <button onclick="toggleCart(true)" class="relative p-2 text-white hover:text-zinc-400 transition-colors">
          <svg xmlns="http://www.w3.org/width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="8" cy="21" r="1"></circle>
            <circle cx="19" cy="21" r="1"></circle>
            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.1-5.38a1 1 0 0 0-1-1.21H5.75"></path>
          </svg>
          <!-- Kosár számláló (JS kezeli) -->
          <span id="cartCount" class="hidden absolute -top-1 -right-1 bg-white text-black text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center">
            0
          </span>
        </button>

        <!-- Mobil menü váltógomb -->
        <button onclick="toggleMobileMenu()" class="md:hidden p-2 text-white">
          <!-- Menu ikon -->
          <svg id="menuIcon" xmlns="http://www.w3.org/width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="4" x2="20" y1="12" y2="12"></line>
            <line x1="4" x2="20" y1="6" y2="6"></line>
            <line x1="4" x2="20" y1="18" y2="18"></line>
          </svg>
          <!-- X ikon (alapértelmezetten rejtve) -->
          <svg id="closeIcon" class="hidden" xmlns="http://www.w3.org/width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobil Menü Lista (alapértelmezetten rejtve) -->
    <div id="mobileMenu" class="hidden md:hidden py-4 border-t border-zinc-800">
      <nav class="flex flex-col gap-4">
        <a href="#piercings" onclick="toggleMobileMenu()" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Piercingek</a>
        <a href="#tools" onclick="toggleMobileMenu()" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Eszközök</a>
        <a href="#accessories" onclick="toggleMobileMenu()" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Kiegészítők</a>
        <a href="#about" onclick="toggleMobileMenu()" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Rólam</a>
      </nav>
    </div>
  </div>
</header>

<!-- fejléc -->
    <section class="relative min-h-[60vh] flex items-center justify-center bg-gradient-to-b from-zinc-950 via-zinc-900 to-black border-b border-zinc-800 overflow-hidden">
        <!-- Parallax Background -->
        <div id="parallaxBg" class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/80 via-zinc-900/60 to-black/90 z-10"></div>
            <!-- Placeholder pattern - can be replaced with actual image -->
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, currentColor 1px, transparent 0); background-size: 32px 32px;"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <div class="inline-block mb-4 px-4 py-2 border border-zinc-700 bg-zinc-900/50">
                <span class="text-zinc-400 text-xs uppercase tracking-[0.3em]">Est. 2026</span>
            </div>
            <h1 class="text-5xl sm:text-7xl md:text-8xl uppercase tracking-wider mb-6 text-white">
                Ketring
            </h1>
            <p class="text-lg sm:text-xl text-zinc-400 mb-8 max-w-2xl mx-auto tracking-wide">
                Szia
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
  <!-- Shop Now Gomb -->
        <button onclick="scrollToProducts()"m class="rounded-xl flex items-center justify-center bg-white text-black hover:bg-zinc-200 px-4 h-12 uppercase tracking-wider transition-colors duration-200 font-medium">
                Vásárlás
        <svg xmlns="http://www.w3.org/width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2">
            <path d="M5 12h14"></path>
            <path d="m12 5 7 7-7 7"></path>
        </svg>
        </button>

  <!-- Learn More Gomb -->
            <button  class="border border-zinc-700 text-white hover:bg-zinc-900 px-8 h-12 uppercase tracking-wider transition-colors duration-200 font-medium">
                TÖBB
            </button>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-zinc-700 to-transparent"></div>
</section>
    <div id="mainContent" class="min-h-screen bg-black text-white transition-colors duration-300">
  <!-- Itt hivatkozz a korábban elkészített Header-re -->
  
  <main class="pt-16">
    <!-- Ide jön a HeroSection -->

    <section id="products" class="py-16 px-4 sm:px-6 lg:px-8">
      <div class="max-w-7xl mx-auto">
        <!-- Kategória szűrők -->
        <div class="mb-12 flex flex-wrap gap-3 justify-center">
          <button onclick="filterByCategory('all', this)" class="filter-btn px-6 py-2 uppercase tracking-wider text-sm border transition-all bg-white text-black border-white">összes</button>
          <button onclick="filterByCategory('piercings', this)" class="filter-btn px-6 py-2 uppercase tracking-wider text-sm border transition-all bg-transparent text-zinc-400 border-zinc-700">piercingek</button>
          <button onclick="filterByCategory('tools', this)" class="filter-btn px-6 py-2 uppercase tracking-wider text-sm border transition-all bg-transparent text-zinc-400 border-zinc-700">eszközök</button>
          <button onclick="filterByCategory('accessories', this)" class="filter-btn px-6 py-2 uppercase tracking-wider text-sm border transition-all bg-transparent text-zinc-400 border-zinc-700">kiegészítők</button>
        </div>

        <!-- Termék rács -->
        <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"></div>
      </div>
    </section>
  </main>

  <!-- Itt hivatkozz a CartSidebar-ra -->
</div>
    <section id="about" class="py-20 px-4 sm:px-6 lg:px-8 bg-zinc-950 border-t border-zinc-800">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl uppercase tracking-wider mb-6 text-white">
                Rólam
            </h2>
            <p class="text-zinc-400 text-lg mb-8 leading-relaxed">
                Szia én én vagyok 
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <div class="p-6 border border-zinc-800 bg-zinc-900/50">
                    <h3 class="text-white uppercase tracking-wider mb-3">Minőség</h3>
                    <p class="text-zinc-500 text-sm">Kajak jo</p>
                </div>
                <div class="p-6 border border-zinc-800 bg-zinc-900/50">
                    <h3 class="text-white uppercase tracking-wider mb-3">Sok dildo</h3>
                    <p class="text-zinc-500 text-sm">nagyon sok</p>
                </div>
                <div class="p-6 border border-zinc-800 bg-zinc-900/50">
                    <h3 class="text-white uppercase tracking-wider mb-3">Tapasztalt támogatás</h3>
                    <p class="text-zinc-500 text-sm">Majd én beszuratom</p>
                </div>
            </div>
        </div>
    </section>

    

    <footer class="py-12 px-4 sm:px-6 lg:px-8 border-t border-zinc-800">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <h3 class="text-2xl uppercase tracking-[0.2em] text-white mb-2">Ketring</h3>
                    <p class="text-zinc-500 text-sm">Szia</p>
                </div>
                <div class="flex gap-8 text-sm">
                    <a href="http://" class="text-zinc-500 hover:text-white transition-colors uppercase tracking-wider">Adatvédelem</a>
                    <a href="http://" class="text-zinc-500 hover:text-white transition-colors uppercase tracking-wider">Kapcsolat</a>
                    <a href="http://" class="text-zinc-500 hover:text-white transition-colors uppercase tracking-wider">ÁSZF</a>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-zinc-900 text-center">
                <p class="text-zinc-600 text-xs uppercase tracking-wider">
                    © 2026 Ketring. Minden jog fenntartva.
                </p>
            </div>
        </div>
    </footer>

    

        <!-- A JavaScript ide fogja beszúrni a kártyákat -->
    </div>
    <!-- Cart Sidebar -->
    <div id="cartSidebar" class="fixed inset-y-0 right-0 w-full sm:w-[400px] bg-zinc-950 border-l border-zinc-800 z-50 transform translate-x-full transition-transform duration-300 flex flex-col">
        <!-- Cart Header -->
        <div class="flex items-center justify-between p-6 border-b border-zinc-800">
            <h2 class="text-xl uppercase tracking-wider text-white font-bold">Kosár</h2>
            <button onclick="toggleCart(false)" class="p-2 text-zinc-400 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Cart Items -->
        <div id="cartItems" class="flex-1 overflow-y-auto p-6 space-y-4">
            <!-- Items will be rendered here -->
        </div>

        <!-- Cart Footer -->
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
</body>
</html>
