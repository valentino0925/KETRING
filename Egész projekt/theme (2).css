-- ==============================================================================
-- KetRing ADATBÁZIS SETUP
-- ==============================================================================
-- Futtatás: phpMyAdmin-ban vagy MySQL parancssorból
-- Ez a fájl hozza létre az egész adatbázis struktúrát és a minta adatokat
-- ==============================================================================

-- 1. ADATBÁZIS LÉTREHOZÁSA
-- Ha nem létezik, létrehozza a "ketring" nevű adatbázist
-- és kiválasztja használatra
CREATE DATABASE IF NOT EXISTS ketring;
USE ketring;

-- ==============================================================================
-- 2. USERS (FELHASZNÁLÓK) TÁBLA
-- ==============================================================================
-- Itt tároljuk a regisztrált felhasználók adatait
-- role: 'user' = normál felhasználó, 'admin' = adminisztrátor
-- password: bcrypt hash-olt jelszó (biztonságos tárolás)
-- ==============================================================================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,           -- Egyedi azonosító (auto increment)
    username VARCHAR(50) NOT NULL UNIQUE,         -- Felhasználónév (kötelező, egyedi)
    email VARCHAR(100) NOT NULL UNIQUE,          -- Email cím (kötelező, egyedi)
    password VARCHAR(255) NOT NULL,              -- Jelszó (hash-olt, nem plaintext!)
    role ENUM('user', 'admin') DEFAULT 'user',   -- Szerepkör: user vagy admin
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Létrehozás időpontja
);

-- ==============================================================================
-- 3. CATEGORIES (KATEGÓRIÁK) TÁBLA
-- ==============================================================================
-- A termékek kategorizálására szolgál (pl. Piercingek, Eszközök, Kellékek)
-- slug: URL-barát név (pl. "piercings" -> /?category=piercings)
-- ==============================================================================
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,       -- Pl: "Piercingek"
    slug VARCHAR(50) NOT NULL UNIQUE  -- Pl: "piercings" (URL-hez)
);

-- ==============================================================================
-- 4. PRODUCTS (TERMÉKEK) TÁBLA
-- ==============================================================================
-- A webshopban kapható termékek adatai
-- category_id: külső kulcs a categories táblára (kapcsolat)
-- discount_price: ha null, nincs akció; ha van érték, az akciós ár
-- stock: készlet mennyiség (0 = nincs készleten)
-- ==============================================================================
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,           -- Termék neve
    description TEXT,                      -- Leírás (opcionális)
    price DECIMAL(10,2) NOT NULL,         -- Normál ár (Ft)
    discount_price DECIMAL(10,2) DEFAULT NULL, -- Akciós ár (ha van)
    category_id INT,                      -- Kategória ID (foreign key)
    stock INT DEFAULT 0,                  -- Készlet darabszám
    image VARCHAR(255),                   -- Kép URL
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) -- Kapcsolat a kategóriákkal
);

-- ==============================================================================
-- 5. TESZT ADATOK - ADMIN FELHASZNÁLÓ
-- ==============================================================================
-- Default admin hozzáadása
-- Jelszó: "admin123" (bcrypt hash: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi)
-- Bejelentkezéshez: username: admin, password: admin123
-- ==============================================================================
INSERT INTO users (username, email, password, role) VALUES 
('admin', 'admin@ketring.hu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- ==============================================================================
-- 6. TESZT ADATOK - KATEGÓRIÁK
-- ==============================================================================
-- Alapértelmezett kategóriák a webshophoz
-- ==============================================================================
INSERT INTO categories (name, slug) VALUES 
('Piercingek', 'piercings'),
('Eszközök', 'tools'),
('Kellékek', 'accessories');

-- ==============================================================================
-- 7. TESZT ADATOK - Minta TERMÉKEK
-- ==============================================================================
-- Néhány minta termék a webshop megjelenítéséhez
-- category_id 1 = Piercingek, 2 = Eszközök, 3 = Kellékek
-- ==============================================================================
INSERT INTO products (name, description, price, discount_price, category_id, stock, image) VALUES
('Acél piercing', 'Minőségi rozsdamentes acél piercing', 2500, NULL, 1, 50, 'https://placehold.co/400x400/1a1a1a/white?text=Piercing+1'),
('Arany piercing', '14 karátos arany piercing', 15000, 12000, 1, 20, 'https://placehold.co/400x400/1a1a1a/white?text=Piercing+2'),
('Titanium piercing', 'Orvosi minőségű titanium piercing', 4500, NULL, 1, 35, 'https://placehold.co/400x400/1a1a1a/white?text=Piercing+3'),
('Fülbevaló', 'Elegáns fülbevaló', 8000, 6500, 1, 25, 'https://placehold.co/400x400/1a1a1a/white?text=Fülbevaló'),
('Piercing tű', 'Steril piercing tű', 800, NULL, 2, 100, 'https://placehold.co/400x400/1a1a1a/white?text=Piercing+tű'),
('Fertőtlenítő', 'Antiszeptikus fertőtlenítő', 1200, 900, 2, 50, 'https://placehold.co/400x400/1a1a1a/white?text=Fertőtlenítő'),
('Csipesz', 'Precision csipesz', 2500, NULL, 2, 30, 'https://placehold.co/400x400/1a1a1a/white?text=Csipesz'),
('Markoló', 'Piercing markoló eszköz', 4500, NULL, 2, 15, 'https://placehold.co/400x400/1a1a1a/white?text=Markoló'),
('Tároló doboz', 'Steril tároló doboz', 1500, NULL, 3, 40, 'https://placehold.co/400x400/1a1a1a/white?text=Tároló'),
('Gyűrű', 'Decens gyűrű', 3500, NULL, 3, 45, 'https://placehold.co/400x400/1a1a1a/white?text=Gyűrű');
