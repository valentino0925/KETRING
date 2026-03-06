<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="hu" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Általános Szerződési Feltételek - KetRing</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-black text-white min-h-screen">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-black border-b border-zinc-800 dark:bg-black dark:border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl tracking-[0.2em] uppercase text-white font-bold">
                        <a href="index.php">Ketring</a>
                    </h1>
                </div>
                <nav class="hidden md:flex items-center gap-8">
                    <a href="index.php" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Főoldal</a>
                    <a href="tools.php" class="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">Eszközök</a>
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
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl uppercase tracking-wider mb-2 text-center">Általános Szerződési Feltételek</h1>
            <p class="text-zinc-400 text-center mb-12">Hatályos: 2026. január 1-től</p>
            
            <div class="prose prose-invert max-w-none space-y-8">
                <section class="p-6 border border-zinc-800 bg-zinc-900/30">
                    <h2 class="text-xl uppercase tracking-wider mb-4 text-white">1. Bevezetés</h2>
                    <p class="text-zinc-400 leading-relaxed">
                        A KetRing webáruházban (a továbbiakban: "Webáruház") történő vásárlás során az alábbi Általános Szerződési Feltételek (a továbbiakban: "ÁSZF") érvényesek. A Webáruház használatával Ön elfogadja az ÁSZF-ben foglaltakat. Kérjük, hogy vásárlás előtt figyelmesen olvassa el az ÁSZF-et.
                    </p>
                </section>

                <section class="p-6 border border-zinc-800 bg-zinc-900/30">
                    <h2 class="text-xl uppercase tracking-wider mb-4 text-white">2. Szolgáltató adatai</h2>
                    <ul class="text-zinc-400 space-y-2">
                        <li><strong class="text-white">Név:</strong> KetRing Kft.</li>
                        <li><strong class="text-white">Székhely:</strong> Budapest, Magyarország</li>
                        <li><strong class="text-white">Email:</strong> info@ketring.hu</li>
                        <li><strong class="text-white">Telefon:</strong> +36 30 123 4567</li>
                    </ul>
                </section>

                <section class="p-6 border border-zinc-800 bg-zinc-900/30">
                    <h2 class="text-xl uppercase tracking-wider mb-4 text-white">3. Rendelés menete</h2>
                    <p class="text-zinc-400 leading-relaxed mb-4">
                        A Webáruházban történő vásárláshoz regisztráció szükséges. A regisztrációt követően Ön a kosár funkció segítségével helyezheti termékeket a kosárba. A rendelés véglegesítéséhez kérjük, töltse ki a szükséges adatokat és kattintson a "Megrendelés" gombra.
                    </p>
                    <p class="text-zinc-400 leading-relaxed">
                        A rendelés leadásával Ön ajánlatot tesz a termék(ek) megvásárlására. A rendelésről automatikus visszaigazolást küldünk az Ön email címére.
                    </p>
                </section>

                <section class="p-6 border border-zinc-800 bg-zinc-900/30">
                    <h2 class="text-xl uppercase tracking-wider mb-4 text-white">4. Árak és fizetés</h2>
                    <p class="text-zinc-400 leading-relaxed mb-4">
                        A Webáruházban feltüntetett árak forintban (Ft) értendők és tartalmazzák az ÁFÁ-t. Fenntartjuk a jogot az árak módosítására, amelyek a Webáruházban történő megjelenéssel lépnek érvénybe.
                    </p>
                    <p class="text-zinc-400 leading-relaxed">
                        Fizetési módok: bankkártyás fizetés, átutalás, készpénz (személyes átvétel esetén).
                    </p>
                </section>

                <section class="p-6 border border-zinc-800 bg-zinc-900/30">
                    <h2 class="text-xl uppercase tracking-wider mb-4 text-white">5. Szállítás</h2>
                    <p class="text-zinc-400 leading-relaxed mb-4">
                        A szállítási költség a rendelés összértékétől függően változik. Ingyenes szállítás 20.000 Ft feletti rendelés esetén. A szállítási idő általában 3-5 munkanap.
                    </p>
                    <p class="text-zinc-400 leading-relaxed">
                        Személyes átvétel: Budapesten, előre egyeztetett időpontban lehetséges.
                    </p>
                </section>

                <section class="p-6 border border-zinc-800 bg-zinc-900/30">
                    <h2 class="text-xl uppercase tracking-wider mb-4 text-white">6. Elállási jog</h2>
                    <p class="text-zinc-400 leading-relaxed mb-4">
                        A fogyasztó a vásárlástól számított 14 napon belül indoklás nélkül elállhat. Az elállási jog gyakorlásához kérjük, küldjön emailt az info@ketring.hu címre.
                    </p>
                    <p class="text-zinc-400 leading-relaxed">
                        A termék visszaküldésének költsége a vásárlót terheli. A visszatérítést a termék visszaérkezését követő 14 napon belül teljesítjük.
                    </p>
                </section>

                <section class="p-6 border border-zinc-800 bg-zinc-900/30">
                    <h2 class="text-xl uppercase tracking-wider mb-4 text-white">7. Garancia és reklamáció</h2>
                    <p class="text-zinc-400 leading-relaxed mb-4">
                        A termékekre a hatályos jogszabályok szerinti garanciát vállalunk. Hibás termék esetén Ön kérheti a javítást, cserét vagy árleszállítást.
                    </p>
                    <p class="text-zinc-400 leading-relaxed">
                        Reklamációit az info@ketring.hu email címen vagy a Kapcsolat oldalon keresztül jelezheti.
                    </p>
                </section>

                <section class="p-6 border border-zinc-800 bg-zinc-900/30">
                    <h2 class="text-xl uppercase tracking-wider mb-4 text-white">8. Adatvédelem</h2>
                    <p class="text-zinc-400 leading-relaxed">
                        A Webáruház használata során megadott személyes adatokat bizalmasan kezeljük és csak a rendelés teljesítéséhez használjuk. Adatkezelési tájékoztatónk az Adatvédelem oldalon található. Az Ön adataihoz csak az Ön engedélyével férünk hozzá.
                    </p>
                </section>

                <section class="p-6 border border-zinc-800 bg-zinc-900/30">
                    <h2 class="text-xl uppercase tracking-wider mb-4 text-white">9. Sütik (Cookies)</h2>
                    <p class="text-zinc-400 leading-relaxed">
                        A Webáruház sütiket (cookies) használ a felhasználói élmény javítása érdekében. A sütik használatát a böngésző beállításaiban tilthatja le, azonban ez a Webáruház funkcionalitását korlátozhatja.
                    </p>
                </section>

                <section class="p-6 border border-zinc-800 bg-zinc-900/30">
                    <h2 class="text-xl uppercase tracking-wider mb-4 text-white">10. Záró rendelkezések</h2>
                    <p class="text-zinc-400 leading-relaxed mb-4">
                        Az ÁSZF-re a magyar jog az irányadó. A felek között esetlegesen felmerülő vitákat elsődlegesen békés úton, tárgyalással rendezik.
                    </p>
                    <p class="text-zinc-400 leading-relaxed">
                        Fenntartjuk a jogot az ÁSZF módosítására, amelyek a Webáruházban történő közzététellel lépnek érvénybe. A módosítások a már leadott rendelésekre nem vonatkoznak.
                    </p>
                </section>
            </div>

            <div class="mt-12 text-center">
                <a href="index.php" class="inline-block bg-white text-black hover:bg-zinc-200 px-8 py-3 rounded-lg uppercase tracking-wider font-medium transition-colors">
                    Vissza a főoldalra
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-8 px-4 border-t border-zinc-800">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-zinc-500 text-sm">© 2026 Ketring. Minden jog fenntartva.</p>
        </div>
    </footer>
</body>
</html>
