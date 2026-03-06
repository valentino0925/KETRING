<?php
require_once 'config.php';
requireAdmin();

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        try {
            switch ($_POST['action']) {
                case 'add_product':
                    $name = trim($_POST['name'] ?? '');
                    $description = trim($_POST['description'] ?? '');
                    $price = floatval($_POST['price'] ?? 0);
                    $discount_price = !empty($_POST['discount_price']) ? floatval($_POST['discount_price']) : null;
                    $category_id = intval($_POST['category_id'] ?? 1);
                    $stock = intval($_POST['stock'] ?? 0);
                    $image = trim($_POST['image'] ?? 'https://placehold.co/400x400/1a1a1a/white?text=Termék');
                    
                    if (empty($name) || $price <= 0) {
                        $message = 'A termék neve és ára kötelező!';
                        $messageType = 'error';
                    } else {
                        $stmt = $pdo->prepare("INSERT INTO products (name, description, price, discount_price, category_id, stock, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $stmt->execute([$name, $description, $price, $discount_price, $category_id, $stock, $image]);
                        $message = 'Termék sikeresen hozzáadva!';
                        $messageType = 'success';
                    }
                    break;
                    
                case 'delete_product':
                    $product_id = intval($_POST['product_id'] ?? 0);
                    if ($product_id > 0) {
                        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
                        $stmt->execute([$product_id]);
                        $message = 'Termék sikeresen törölve!';
                        $messageType = 'success';
                    }
                    break;
                    
                case 'update_discount':
                    $product_id = intval($_POST['product_id'] ?? 0);
                    $discount_price = !empty($_POST['discount_price']) ? floatval($_POST['discount_price']) : null;
                    
                    if ($product_id > 0) {
                        $stmt = $pdo->prepare("UPDATE products SET discount_price = ? WHERE id = ?");
                        $stmt->execute([$discount_price, $product_id]);
                        $message = 'Akció sikeresen frissítve!';
                        $messageType = 'success';
                    }
                    break;
                    
                case 'delete_user':
                    $user_id = intval($_POST['user_id'] ?? 0);
                    if ($user_id > 0 && $user_id != $_SESSION['user_id']) {
                        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ? AND role != 'admin'");
                        $stmt->execute([$user_id]);
                        $message = 'Felhasználó sikeresen törölve!';
                        $messageType = 'success';
                    } else {
                        $message = 'Nem törölheted magad vagy admin felhasználót!';
                        $messageType = 'error';
                    }
                    break;
            }
        } catch (Exception $e) {
            $message = 'Hiba történt: ' . $e->getMessage();
            $messageType = 'error';
        }
    }
}

$products = $pdo->query("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC")->fetchAll();
$users = $pdo->query("SELECT * FROM users ORDER BY id DESC")->fetchAll();
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>
<!DOCTYPE html>
<html lang="hu" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - KetRing</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-black text-white min-h-screen">

    <header class="fixed top-0 left-0 right-0 z-50 bg-black border-b border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-4">
                    <h1 class="text-2xl tracking-[0.2em] uppercase text-white font-bold">Ketring</h1>
                    <span class="px-3 py-1 bg-red-600 text-white text-xs uppercase tracking-wider">Admin</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="index.php" class="text-zinc-400 hover:text-white text-sm uppercase tracking-wider">Főoldal</a>
                    <span class="text-zinc-400">|</span>
                    <span class="text-zinc-400 text-sm"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <a href="logout.php" class="text-red-400 hover:text-red-300 text-sm uppercase tracking-wider">Kijelentkezés</a>
                </div>
            </div>
        </div>
    </header>

    <main class="pt-20 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <?php if ($message): ?>
                <div class="mb-6 p-4 rounded-lg <?php echo $messageType === 'success' ? 'bg-green-900/50 text-green-400 border border-green-800' : 'bg-red-900/50 text-red-400 border border-red-800'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <div class="flex flex-wrap gap-2 mb-8 border-b border-zinc-800 pb-4">
                <button onclick="showTab('products')" class="tab-btn px-6 py-2 uppercase tracking-wider text-sm border bg-white text-black border-white" data-tab="products">
                    Termékek
                </button>
                <button onclick="showTab('add-product')" class="tab-btn px-6 py-2 uppercase tracking-wider text-sm border bg-transparent text-zinc-400 border-zinc-700" data-tab="add-product">
                    Termék hozzáadása
                </button>
                <button onclick="showTab('users')" class="tab-btn px-6 py-2 uppercase tracking-wider text-sm border bg-transparent text-zinc-400 border-zinc-700" data-tab="users">
                    Felhasználók
                </button>
            </div>

            <div id="products-tab" class="tab-content">
                <h2 class="text-2xl uppercase tracking-wider mb-6">Termékek kezelése</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-zinc-800">
                                <th class="py-3 px-4 text-left text-xs uppercase tracking-wider text-zinc-400">ID</th>
                                <th class="py-3 px-4 text-left text-xs uppercase tracking-wider text-zinc-400">Név</th>
                                <th class="py-3 px-4 text-left text-xs uppercase tracking-wider text-zinc-400">Ár</th>
                                <th class="py-3 px-4 text-left text-xs uppercase tracking-wider text-zinc-400">Akció</th>
                                <th class="py-3 px-4 text-left text-xs uppercase tracking-wider text-zinc-400">Készlet</th>
                                <th class="py-3 px-4 text-left text-xs uppercase tracking-wider text-zinc-400">Műveletek</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                            <tr class="border-b border-zinc-800">
                                <td class="py-3 px-4"><?php echo $product['id']; ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($product['name']); ?></td>
                                <td class="py-3 px-4">
                                    <?php if ($product['discount_price']): ?>
                                        <span class="text-red-400"><?php echo number_format($product['discount_price'], 0, ',', ' '); ?> Ft</span>
                                        <span class="text-zinc-500 line-through ml-2"><?php echo number_format($product['price'], 0, ',', ' '); ?> Ft</span>
                                    <?php else: ?>
                                        <?php echo number_format($product['price'], 0, ',', ' '); ?> Ft
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 px-4">
                                    <form method="POST" class="flex gap-2">
                                        <input type="hidden" name="action" value="update_discount">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <input type="number" name="discount_price" placeholder="Akciós ár" value="<?php echo $product['discount_price']; ?>" class="w-24 px-2 py-1 bg-zinc-900 border border-zinc-700 text-white text-sm">
                                        <button type="submit" class="px-3 py-1 bg-yellow-600 hover:bg-yellow-500 text-white text-xs uppercase">Ment</button>
                                    </form>
                                </td>
                                <td class="py-3 px-4"><?php echo $product['stock']; ?></td>
                                <td class="py-3 px-4">
                                    <form method="POST" onsubmit="return confirm('Biztosan törlöd ezt a terméket?');">
                                        <input type="hidden" name="action" value="delete_product">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-500 text-white text-xs uppercase">Törlés</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="add-product-tab" class="tab-content hidden">
                <h2 class="text-2xl uppercase tracking-wider mb-6">Új termék hozzáadása</h2>
                <form method="POST" class="max-w-2xl space-y-6">
                    <input type="hidden" name="action" value="add_product">
                    
                    <div>
                        <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Termék neve *</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white">
                    </div>
                    
                    <div>
                        <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Leírás</label>
                        <textarea name="description" rows="4" class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Ár (Ft) *</label>
                            <input type="number" name="price" required min="1" class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white">
                        </div>
                        <div>
                            <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Akciós ár (Ft)</label>
                            <input type="number" name="discount_price" min="0" class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Készlet</label>
                            <input type="number" name="stock" min="0" value="0" class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white">
                        </div>
                        <div>
                            <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Kategória</label>
                            <select name="category_id" class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white">
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm uppercase tracking-wider text-zinc-400 mb-2">Kép URL</label>
                        <input type="url" name="image" placeholder="https://..." class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-700 rounded-lg text-white focus:outline-none focus:border-white">
                    </div>
                    
                    <button type="submit" class="bg-white text-black hover:bg-zinc-200 px-8 py-3 rounded-lg uppercase tracking-wider font-medium transition-colors">
                        Termék hozzáadása
                    </button>
                </form>
            </div>

            <div id="users-tab" class="tab-content hidden">
                <h2 class="text-2xl uppercase tracking-wider mb-6">Felhasználók kezelése</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-zinc-800">
                                <th class="py-3 px-4 text-left text-xs uppercase tracking-wider text-zinc-400">ID</th>
                                <th class="py-3 px-4 text-left text-xs uppercase tracking-wider text-zinc-400">Felhasználónév</th>
                                <th class="py-3 px-4 text-left text-xs uppercase tracking-wider text-zinc-400">Email</th>
                                <th class="py-3 px-4 text-left text-xs uppercase tracking-wider text-zinc-400">Szerepkör</th>
                                <th class="py-3 px-4 text-left text-xs uppercase tracking-wider text-zinc-400">Regisztrálva</th>
                                <th class="py-3 px-4 text-left text-xs uppercase tracking-wider text-zinc-400">Műveletek</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr class="border-b border-zinc-800">
                                <td class="py-3 px-4"><?php echo $user['id']; ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($user['username']); ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($user['email']); ?></td>
                                <td class="py-3 px-4">
                                    <?php if ($user['role'] === 'admin'): ?>
                                        <span class="px-2 py-1 bg-red-600 text-white text-xs uppercase">Admin</span>
                                    <?php else: ?>
                                        <span class="px-2 py-1 bg-zinc-700 text-white text-xs uppercase">User</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 px-4 text-zinc-400"><?php echo date('Y-m-d', strtotime($user['created_at'])); ?></td>
                                <td class="py-3 px-4">
                                    <?php if ($user['role'] !== 'admin' && $user['id'] != $_SESSION['user_id']): ?>
                                        <form method="POST" onsubmit="return confirm('Biztosan törlöd ezt a felhasználót?');">
                                            <input type="hidden" name="action" value="delete_user">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                            <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-500 text-white text-xs uppercase">Törlés</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-zinc-500 text-xs">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        function showTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });
            
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-white', 'text-black', 'border-white');
                btn.classList.add('bg-transparent', 'text-zinc-400', 'border-zinc-700');
            });

            document.getElementById(tabName + '-tab').classList.remove('hidden');
   
            const activeBtn = document.querySelector(`[data-tab="${tabName}"]`);
            activeBtn.classList.remove('bg-transparent', 'text-zinc-400', 'border-zinc-700');
            activeBtn.classList.add('bg-white', 'text-black', 'border-white');
        }
    </script>
</body>
</html>
