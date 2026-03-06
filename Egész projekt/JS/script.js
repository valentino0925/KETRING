// ==============================================================================
// KETRING JAVASCRIPT - Kliens oldali funkciók
// ==============================================================================
// Ez a fájl tartalmazza a frontend JavaScript logikát:
// - Téma váltás (dark/light mode)
// - Parallax effektus
// - Kosár kezelés
// - Mobil menü
// ==============================================================================

// ==============================================================================
// 1. TÉMA (DARK/LIGHT MODE) KEZELÉS
// ==============================================================================

/**
 * initTheme() - Inicializálja a témát az oldal betöltésekor
 * Először ellenőrzi a localStorage-t, majd a rendszer beállításokat
 * A téma megmarad böngésző bezárás után is (localStorage)
 */
function initTheme() {
    const savedTheme = localStorage.getItem('theme');                    // Elmentett téma
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches; // Rendszer beállítás
    
    // Ha nincs mentett téma és a rendszer sötét, akkor sötét mód
    // Egyébként a mentett témát használja (vagylight ha nincs)
    if (savedTheme === 'light' || (!savedTheme && !prefersDark)) {
        setLightTheme();
    } else {
        setDarkTheme();
    }
}

/**
 * setDarkTheme() - Sötét mód beállítása
 * Az egész oldal stílusát átállítja sötét színvilágra
 * CSS class-okat és inline style-okat használ
 */
function setDarkTheme() {
    // HTML root és localStorage frissítése
    document.documentElement.classList.add('dark');
    document.documentElement.classList.remove('light');
    localStorage.setItem('theme', 'dark');
    updateThemeIcons();
    
    // Body és fő tartalom - fekete háttér, fehér szöveg
    document.body.classList.remove('bg-white');
    document.body.classList.add('bg-black', 'text-white');
    
    // Main content (fő tartalom)
    const mainContent = document.getElementById('mainContent');
    if (mainContent) {
        mainContent.classList.remove('bg-white', 'text-black');
        mainContent.classList.add('bg-black', 'text-white');
    }
    
    // Header (fejléc) - fekete háttér, sötét szegély
    const header = document.querySelector('header');
    if (header) {
        header.classList.remove('bg-white', 'border-zinc-200');
        header.classList.add('bg-black', 'border-zinc-800');
    }
    
    // Nav linkek (navigációs linkek) - fehér szín
    document.querySelectorAll('nav a').forEach(link => {
        link.classList.remove('text-black', 'hover:text-zinc-600');
        link.classList.add('text-white', 'hover:text-zinc-400');
    });
    
    // Logo - fehér szín
    const logo = document.querySelector('header h1');
    if (logo) {
        logo.classList.remove('text-black');
        logo.classList.add('text-white');
    }
    
    // Header gombok (téma, kosár, keresés)
    document.querySelectorAll('#themeToggle, button[onclick*="toggleCart"], button[onclick*="toggleSearch"]').forEach(btn => {
        btn.classList.remove('text-black', 'hover:text-zinc-600');
        btn.classList.add('text-white', 'hover:text-zinc-400');
    });
    
    // Termék kártyák - sötét háttér
    document.querySelectorAll('.product-card').forEach(card => {
        card.classList.remove('bg-zinc-100', 'border-zinc-300');
        card.classList.add('bg-zinc-900/50', 'border-zinc-800');
    });
    
    // Szűrő gombok
    document.querySelectorAll('.filter-btn').forEach(btn => {
        if (!btn.classList.contains('bg-white')) {
            btn.classList.remove('bg-zinc-100', 'text-black', 'border-zinc-300');
            btn.classList.add('bg-transparent', 'text-zinc-400', 'border-zinc-700');
        }
    });
    
    // Kereső input mezők
    document.querySelectorAll('input[type="text"], input[type="search"], input[type="email"]').forEach(input => {
        input.classList.remove('bg-zinc-100', 'border-zinc-300', 'text-black');
        input.classList.add('bg-zinc-900/50', 'border-zinc-700', 'text-white');
    });
    
    // Szekciók (sections)
    document.querySelectorAll('section').forEach(section => {
        if (!section.classList.contains('parallax')) {
            section.classList.remove('bg-zinc-100');
            section.classList.add('bg-black');
        }
    });
    
    // Footer (lábléc) - sötét
    const footer = document.querySelector('footer');
    if (footer) {
        footer.classList.remove('bg-zinc-100', 'border-zinc-300');
        footer.classList.add('bg-black', 'border-zinc-800');
    }
    
    // Parallax háttérkép - invertálás eltávolítása (sötét módban)
    const parallaxImg = document.querySelector('.parallax-bg img');
    if (parallaxImg) {
        parallaxImg.style.filter = 'none';
    }
    
    // Kosár oldalsáv
    const cartSidebar = document.getElementById('cartSidebar');
    if (cartSidebar) {
        cartSidebar.classList.remove('bg-white', 'border-zinc-300');
        cartSidebar.classList.add('bg-zinc-950', 'border-zinc-800');
    }
    
    // Rólunk szekció
    const aboutSection = document.getElementById('about');
    if (aboutSection) {
        aboutSection.classList.remove('bg-zinc-100');
        aboutSection.classList.add('bg-zinc-950', 'border-zinc-800');
    }
    
    // Hero szekció (nagy fejléc) - sötét színátmenet
    const heroSection = document.querySelector('.bg-gradient-to-b');
    if (heroSection) {
        heroSection.classList.remove('from-zinc-100', 'via-zinc-50', 'to-white');
        heroSection.classList.add('from-zinc-950', 'via-zinc-900', 'to-black');
    }
}

/**
 * setLightTheme() - Világos mód beállítása
 * Az egész oldal stílusát átállítja világos színvilágra
 */
function setLightTheme() {
    // HTML root és localStorage frissítése
    document.documentElement.classList.remove('dark');
    document.documentElement.classList.add('light');
    localStorage.setItem('theme', 'light');
    updateThemeIcons();
    
    // Body és fő tartalom - fehér háttér, fekete szöveg
    document.body.classList.remove('bg-black', 'text-white');
    document.body.classList.add('bg-white', 'text-black');
    
    // Main content
    const mainContent = document.getElementById('mainContent');
    if (mainContent) {
        mainContent.classList.remove('bg-black', 'text-white');
        mainContent.classList.add('bg-white', 'text-black');
    }
    
    // Header
    const header = document.querySelector('header');
    if (header) {
        header.classList.remove('bg-black', 'border-zinc-800');
        header.classList.add('bg-white', 'border-zinc-200');
    }
    
    // Nav linkek
    document.querySelectorAll('nav a').forEach(link => {
        link.classList.remove('text-white', 'hover:text-zinc-400');
        link.classList.add('text-black', 'hover:text-zinc-600');
    });
    
    // Logo
    const logo = document.querySelector('header h1');
    if (logo) {
        logo.classList.remove('text-white');
        logo.classList.add('text-black');
    }
    
    // Header gombok
    document.querySelectorAll('#themeToggle, button[onclick*="toggleCart"], button[onclick*="toggleSearch"]').forEach(btn => {
        btn.classList.remove('text-white', 'hover:text-zinc-400');
        btn.classList.add('text-black', 'hover:text-zinc-600');
    });
    
    // Termék kártyák - világos háttér
    document.querySelectorAll('.product-card').forEach(card => {
        card.classList.remove('bg-zinc-900/50', 'border-zinc-800');
        card.classList.add('bg-zinc-100', 'border-zinc-300');
    });
    
    // Szűrő gombok
    document.querySelectorAll('.filter-btn').forEach(btn => {
        if (!btn.classList.contains('bg-white')) {
            btn.classList.remove('bg-transparent', 'text-zinc-400', 'border-zinc-700');
            btn.classList.add('bg-zinc-100', 'text-black', 'border-zinc-300');
        }
    });
    
    // Kereső input mezők
    document.querySelectorAll('input[type="text"], input[type="search"], input[type="email"]').forEach(input => {
        input.classList.remove('bg-zinc-900/50', 'border-zinc-700', 'text-white');
        input.classList.add('bg-zinc-100', 'border-zinc-300', 'text-black');
    });
    
    // Szekciók
    document.querySelectorAll('section').forEach(section => {
        if (!section.classList.contains('parallax')) {
            section.classList.remove('bg-black');
            section.classList.add('bg-zinc-100');
        }
    });
    
    // Footer
    const footer = document.querySelector('footer');
    if (footer) {
        footer.classList.remove('bg-black', 'border-zinc-800');
        footer.classList.add('bg-zinc-100', 'border-zinc-300');
    }
    
    // Parallax háttérkép - invertálás világos módban (fekete képet fehérré teszi)
    const parallaxImg = document.querySelector('.parallax-bg img');
    if (parallaxImg) {
        parallaxImg.style.filter = 'invert(1) brightness(1.2)';
    }
    
    // Kosár oldalsáv
    const cartSidebar = document.getElementById('cartSidebar');
    if (cartSidebar) {
        cartSidebar.classList.remove('bg-zinc-950', 'border-zinc-800');
        cartSidebar.classList.add('bg-white', 'border-zinc-300');
    }
    
    // Rólunk szekció
    const aboutSection = document.getElementById('about');
    if (aboutSection) {
        aboutSection.classList.remove('bg-zinc-950', 'border-zinc-800');
        aboutSection.classList.add('bg-zinc-100', 'border-zinc-300');
    }
    
    // Hero szekció
    const heroSection = document.querySelector('.bg-gradient-to-b');
    if (heroSection) {
        heroSection.classList.remove('from-zinc-950', 'via-zinc-900', 'to-black');
        heroSection.classList.add('from-zinc-100', 'via-zinc-50', 'to-white');
    }
}

/**
 * updateThemeIcons() - Frissíti a téma váltó ikonokat
 * Nap/Szellőhold ikon cseréje a themeToggle gombon
 */
function updateThemeIcons() {
    const sunIcon = document.getElementById('sunIcon');   // Nap ikon
    const moonIcon = document.getElementById('moonIcon'); // Hold ikon
    
    if (!sunIcon || !moonIcon) return;
    
    // Sötét módban: nap ikon látható, hold rejtett
    // Világos módban: hold ikon látható, nap rejtett
    if (document.documentElement.classList.contains('dark')) {
        sunIcon.classList.remove('hidden');
        moonIcon.classList.add('hidden');
    } else {
        sunIcon.classList.add('hidden');
        moonIcon.classList.remove('hidden');
    }
}

/**
 * toggleTheme() - Vált a téma között (dark <-> light)
 * Egyszerűen meghívja a megfelelő set függvényt
 */
function toggleTheme() {
    if (document.documentElement.classList.contains('dark')) {
        setLightTheme();
    } else {
        setDarkTheme();
    }
}

// ==============================================================================
// 2. PARALLAX EFFEKTUS
// ==============================================================================

/**
 * initParallax() - Parallax görgetési effektus inicializálása
 * A háttérkép lassabban mozog, mint a görgetés (mélységhatás)
 * GPU gyorsítás: translate3d használata
 */
function initParallax() {
    const parallaxBg = document.getElementById('parallaxBg');         // Háttér elem
    const heroSection = document.querySelector('section.relative.min-h-\\[60vh\\]'); // Hero szekció
    if (!parallaxBg || !heroSection) return;
    
    let ticking = false;
    
    // willChange: optimalizálás, hogy a böngésző előre kiszámítsa
    parallaxBg.style.willChange = 'transform';
    
    // Görgetés figyelése
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                const scrolled = window.pageYOffset;           // Görgetett pixel
                const heroTop = heroSection.offsetTop;        // Hero szekció teteje
                const heroHeight = heroSection.offsetHeight;  // Hero szekció magassága
                
                // Csak akkor alkalmazza a parallaxot, ha a hero szekció látható
                if (scrolled >= -window.innerHeight && scrolled <= heroTop + heroHeight) {
                    // translate3d - GPU gyorsítás a simább mozgásért
                    // 0.4-es szorzó = lassabb mozgás (mélységhatás)
                    parallaxBg.style.transform = `translate3d(0, ${scrolled * 0.4}px, 0)`;
                    
                    // Átlátszóság csökkentése görgetéskor
                    const opacity = Math.max(0, 1 - scrolled / heroHeight);
                    parallaxBg.style.opacity = opacity;
                }
                ticking = false;
            });
            ticking = true;
        }
    });
}

// ==============================================================================
// 3. KOSÁR KEZELÉS (UI SZINKRONIZÁLÁS)
// ==============================================================================

/**
 * updateCartUI() - Frissíti a kosár megjelenítését
 * A kosár ikon melletti darabszámot és az oldalsáv tartalmát frissíti
 * Az index.php-ben definiált cartItems változót használja
 */
function updateCartUI() {
    const cartCountEl = document.getElementById('cartCount');
    if (!cartCountEl) return;

    // Összes darab kiszámítása a kosárból
    const count = cartItems.reduce((sum, item) => sum + item.quantity, 0);

    // Darabszám megjelenítése/elrejtése
    if (count > 0) {
        cartCountEl.innerText = count;
        cartCountEl.classList.remove('hidden');
    } else {
        cartCountEl.classList.add('hidden');
    }

    // Kosár oldalsáv frissítése, ha létezik a renderCartSidebar függvény
    if (typeof renderCartSidebar === 'function') {
        renderCartSidebar();
    }
}

// ==============================================================================
// 4. MOBIL MENÜ KEZELÉS
// ==============================================================================

/**
 * toggleMobileMenu() - Mobilos navigációs menü be/ki kapcsolása
 * A hamburger menü ikon és a legördülő menü között vált
 */
function toggleMobileMenu() {
    const menuContainer = document.getElementById('mobileMenu'); // Menü konténer
    const menuIcon = document.getElementById('menuIcon');        // Hamburger ikon
    const closeIcon = document.getElementById('closeIcon');      // X ikon
    
    // Állapot váltás
    mobileMenuOpen = !mobileMenuOpen;
    
    if (mobileMenuOpen) {
        // Menü megjelenítése
        menuContainer?.classList.remove('hidden');
        menuIcon?.classList.add('hidden');
        closeIcon?.classList.remove('hidden');
    } else {
        // Menü elrejtése
        menuContainer?.classList.add('hidden');
        menuIcon?.classList.remove('hidden');
        closeIcon?.classList.add('hidden');
    }
}

// ==============================================================================
// 5. GÖRKÉLY
// ==============================================================================

/**
 * scrollToProducts() - Görgetés a termékek szekcióhoz
 * smooth görgetéssel (animáltan) görget a #products elemhez
 */
function scrollToProducts() {
    const element = document.getElementById('products');
    if (element) {
        if (mobileMenuOpen) toggleMobileMenu(); // Menü bezárása görgetés előtt
        element.scrollIntoView({ behavior: 'smooth' });
    }
}

// ==============================================================================
// 6. INICIALIZÁLÁS - OLDAL BETÖLTÉSEKOR
// ==============================================================================

// DOMContentLoaded: akkor fut le, amikor a HTML betöltődött (CSS/JS még nem)
document.addEventListener('DOMContentLoaded', () => {
    initTheme();    // Téma beállítása
    initParallax(); // Parallax effektus indítása
    
    // Téma váltó gomb eseménykezelő hozzáadása
    const themeToggle = document.getElementById('themeToggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', toggleTheme);
    }
    
    // Rendszer téma változás figyelése (pl. Windows sötét mód bekapcsolása)
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        // Csak akkor vált, ha nincs elmentett téma a localStorage-ban
        if (!localStorage.getItem('theme')) {
            if (e.matches) {
                setDarkTheme();
            } else {
                setLightTheme();
            }
        }
    });
});
