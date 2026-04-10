<?php
$page_title = "Fit FeetUg - Premium Footwear for All";
include 'includes/header.php';

// Fetch products based on category and search
$category = $_GET['category'] ?? 'all';
$search = trim($_GET['search'] ?? '');

$query = "SELECT p.*, c.slug as category_slug FROM products p JOIN categories c ON p.category_id = c.id";
$conditions = [];
$params = [];

if ($category != 'all') {
    $conditions[] = "c.slug = ?";
    $params[] = $category;
}

if (!empty($search)) {
    $conditions[] = "(p.name LIKE ? OR p.description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$showAll = ($_GET['show'] ?? '') === 'all';
$query .= " ORDER BY p.id DESC" . ($showAll ? '' : ' LIMIT 32');
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get total count for "View All" link
$countQuery = "SELECT COUNT(*) FROM products p JOIN categories c ON p.category_id = c.id";
if (!empty($conditions)) {
    $countQuery .= " WHERE " . implode(" AND ", $conditions);
}
$countStmt = $pdo->prepare($countQuery);
$countStmt->execute($params);
$totalProducts = $countStmt->fetchColumn();
?>

<main>
    <!-- Premium Hero Section -->
    <section class="hero-section">
        <div class="container-wide">
            <div class="hero-grid">
                <div class="hero-content">
                    <span class="hero-tag">New Collection 2026</span>
                    <h1>Step into Excellence with Fit FeetUg</h1>
                    <p>Upgrade your footwear game with our curated selection of premium shoes for the whole family. Quality craftsmanship meets ultimate comfort.</p>
                    <div class="hero-btns">
                        <a href="index.php?category=men" class="btn btn-primary">Shop Men</a>
                        <a href="index.php?category=women" class="btn btn-outline">Shop Women</a>
                        <a href="index.php?category=children" class="btn btn-outline">Shop Children</a>
                    </div>
                </div>
                <div class="hero-image hero-carousel">
                    <div class="hero-slide active">
                        <img src="assets/hero-shoes.png" alt="Classic Sneaker">
                    </div>
                    <div class="hero-slide">
                        <img src="assets/hero-shoes.png" alt="Modern Shoes">
                    </div>
                    <div class="hero-glow"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Filter Bar -->
    <section class="filter-bar">
        <div class="container-wide">
            <div class="category-tabs">
                <a href="index.php?category=all" class="tab-item <?php echo $category == 'all' ? 'active' : ''; ?>">All Products</a>
                <a href="index.php?category=men" class="tab-item <?php echo $category == 'men' ? 'active' : ''; ?>">Men</a>
                <a href="index.php?category=women" class="tab-item <?php echo $category == 'women' ? 'active' : ''; ?>">Women</a>
                <a href="index.php?category=children" class="tab-item <?php echo $category == 'children' ? 'active' : ''; ?>">Children</a>
            </div>
        </div>
    </section>

    <!-- Product Grid -->
    <section class="products-section">
        <div class="container-wide">
            <div class="section-header">
                <div class="section-title">
                    <h2><?php echo $category == 'all' ? 'Our Collection' : ucfirst($category) . "'s Selection"; ?></h2>
                    <p>Showing <?php echo count($products); ?> of <?php echo $totalProducts; ?> premium styles found in Kampala</p>
                </div>
            </div>

            <div class="products-grid">
                <?php if (empty($products)): ?>
                    <div class="no-results">
                        <i class="fas fa-search"></i>
                        <h3>No shoes found</h3>
                        <p>Try matching another category or search term.</p>
                        <a href="index.php" class="btn btn-primary">Clear Filters</a>
                    </div>
                <?php else: ?>
                    <?php
                        $category_asset_order = [
                            'men' => 0,
                            'women' => 0,
                            'children' => 0,
                        ];
                        $product_asset_index = [];
                        foreach ($products as $productIndex => $productItem) {
                            $slug = $productItem['category_slug'];
                            if (isset($category_asset_order[$slug])) {
                                $product_asset_index[$productItem['id']] = $category_asset_order[$slug]++;
                            }
                        }
                    ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <div class="product-image" style="cursor:pointer">
                                <?php if ($product['id'] % 3 == 0): ?>
                                    <span class="product-badge">New Arrival</span>
                                <?php endif; ?>
                                <?php
                                    $fallback_img = 'assets/hero-shoes.png';
                                    $category_img_map = [
                                        'men' => 'assets/men%20shoes/61aEHFfSmxL._AC_SY695_.jpg',
                                        'women' => 'assets/women%20shoes/1111111111111.jpg',
                                        'children' => 'assets/Kids%20shoes/1.jpg',
                                    ];
                                    $men_assets = [
                                        'assets/men%20shoes/61aEHFfSmxL._AC_SY695_.jpg',
                                        'assets/men%20shoes/713Gs7cKmrL._AC_SY695_.jpg',
                                        'assets/men%20shoes/71ckahUDjSL._AC_SY695_.jpg',
                                        'assets/men%20shoes/71LACWqVmKL._AC_SY695_.jpg',
                                        'assets/men%20shoes/Classic%20Waterproof%20Leather%20Ankle%20Shoes%20for%20Men%201111111111.jpg',
                                        'assets/men%20shoes/Classy%20casual%20shoes%20men.jpg',
                                        'assets/men%20shoes/Nike%20Trainer%20Sneaker%20For%20Men.png',
                                        'assets/men%20shoes/M%20Nike%20PROMINA-Comet%20Blue.jpg',
                                        'assets/men%20shoes/High%20top%20sneakers%20for%20men.webp',
                                        'assets/men%20shoes/High-Top%20Canvas%20Shoes%20Men%27s%20Shoes%20Summer%20Breathable%20Men%27s.webp',
                                        'assets/men%20shoes/Lightweight%20Military%20Tactical%20Combat%20Boots%20Men%20Outdoor%20Hiking%20Desert%20Army%20Boots%20Breathable%20Male%20Jungle%20Shoes%20Man%20Side%20Zipper.jpg',
                                    ];
                                    $women_assets = [
                                        'assets/women%20shoes/1111111111111.jpg',
                                        'assets/women%20shoes/41WvHwoa8sL._AC_.jpg',
                                        'assets/women%20shoes/6105w00TAsL._AC_SX695_.jpg',
                                        'assets/women%20shoes/61BOt894PEL._SY695_.jpg',
                                        'assets/women%20shoes/71+ZFZ9i65L._AC_SY695_.jpg',
                                        'assets/women%20shoes/71PJ9JYRJ6L._AC_SY695_.jpg',
                                        'assets/women%20shoes/71yHPDLrGOL._AC_SY695_.jpg',
                                        'assets/women%20shoes/Black Ladies Formal Shoes.jpg',
                                        'assets/women%20shoes/Women\'s Sneakers.webp',
                                        'assets/women%20shoes/Vepose Women\'s Combat Ankle Boots Lace up Comfortable Short Booties Low Heel.jpg',
                                    ];
                                    $children_assets = [
                                        'assets/Kids%20shoes/1.jpg',
                                        'assets/Kids%20shoes/1.png',
                                        'assets/Kids%20shoes/2.png',
                                        'assets/Kids%20shoes/3.png',
                                        'assets/Kids%20shoes/4.png',
                                        'assets/Kids%20shoes/5.png',
                                        'assets/Kids%20shoes/6.png',
                                        'assets/Kids%20shoes/7.png',
                                        'assets/Kids%20shoes/8.png',
                                        'assets/Kids%20shoes/9.png',
                                        'assets/Kids%20shoes/10.jpg',
                                    ];
                                    $product_img_map = [
                                        'Silver Moon Boot' => 'assets/women10.svg',
                                        'Classic Loafers' => 'assets/men%20shoes/men1.jpg',
                                    ];
                                    $category_asset = $category_img_map[$product['category_slug']] ?? $fallback_img;
                                    $men_asset_count = count($men_assets);
                                    $women_asset_count = count($women_assets);
                                    $children_asset_count = count($children_assets);

                                    $product_position = $product_asset_index[$product['id']] ?? 0;
                                    if ($product['category_slug'] === 'men') {
                                        $img_src = $men_assets[$product_position % $men_asset_count];
                                    } elseif ($product['category_slug'] === 'women') {
                                        $img_src = $women_assets[$product_position % $women_asset_count];
                                    } elseif ($product['category_slug'] === 'children') {
                                        $img_src = $children_assets[$product_position % $children_asset_count];
                                    } elseif (isset($product_img_map[$product['name']])) {
                                        $img_src = $product_img_map[$product['name']];
                                    } elseif (!empty($product['image'])) {
                                        if (strpos($product['image'], 'http') === 0) {
                                            $is_remote_unsplash = strpos($product['image'], 'images.unsplash.com') !== false;
                                            $img_src = $product['image'];
                                        } elseif (strpos($product['image'], 'assets/') === 0) {
                                            $img_src = $product['image'];
                                        } else {
                                            $img_src = 'assets/' . ltrim($product['image'], '/');
                                        }
                                    } else {
                                        $img_src = $category_asset;
                                    }
                                    $is_svg = substr($img_src, -4) === '.svg';
                                ?>
                                <img src="<?php echo $img_src; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>"
                                     class="product-img <?php echo $is_svg ? 'product-img-svg' : ''; ?>"
                                     onerror="if (this.src !== '<?php echo $fallback_img; ?>') { this.onerror = null; this.src = '<?php echo $fallback_img; ?>'; this.classList.remove('product-img-svg'); }">
                            </div>
                            <div class="product-info">
                                <span class="product-cat"><?php echo htmlspecialchars($product['category_slug']); ?></span>
                                <h3 class="product-name" title="<?php echo htmlspecialchars($product['name']); ?>">
                                    <?php echo htmlspecialchars($product['name']); ?>
                                </h3>
                                <div class="product-price-row">
                                    <span class="price">UGX <?php echo number_format($product['price']); ?></span>
                                    <form method="POST" action="cart.php">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                                        <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                                        <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($img_src); ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" name="add_to_cart" class="add-btn" title="Add to Cart">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php if ($totalProducts > 32): ?>
            <div style="text-align:center; margin-top: 2.5rem;">
                <a href="index.php?category=<?php echo htmlspecialchars($category); ?>&show=all" class="btn btn-primary" style="padding: 0.9rem 2.5rem; font-size: 1.05rem;">View All <?php echo $totalProducts; ?> Products</a>
            </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<!-- Product Zoom Modal -->
<div id="product-zoom" class="zoom-overlay">
    <button class="zoom-close" aria-label="Close">&times;</button>
    <div class="zoom-body">
        <div class="zoom-img-wrap">
            <img id="zoom-img" src="" alt="">
        </div>
        <div class="zoom-details">
            <span class="zoom-cat" id="zoom-cat"></span>
            <h2 id="zoom-name"></h2>
            <p class="zoom-price" id="zoom-price"></p>
            <form method="POST" action="cart.php" id="zoom-form">
                <input type="hidden" name="product_id" id="zoom-pid">
                <input type="hidden" name="product_name" id="zoom-pname">
                <input type="hidden" name="product_price" id="zoom-pprice">
                <input type="hidden" name="product_image" id="zoom-pimg">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" name="add_to_cart" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Add to Cart</button>
            </form>
        </div>
    </div>
</div>

<style>
/* Page specific layout adjustments */
.filter-bar {
    background-image: linear-gradient(180deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.95) 100%), url('assets/hero-shoes.png');
    background-repeat: no-repeat;
    background-position: right center;
    background-size: 220px auto;
    border-bottom: 1px solid var(--border);
    padding: 25px 0;
    position: sticky;
    top: 110px;
    z-index: 900;
}
.tab-item:hover, .tab-item.active { color: var(--primary); border-bottom-color: var(--accent); }

.no-results { grid-column: 1 / -1; text-align: center; padding: 100px 0; }
.no-results i { font-size: 4rem; color: #cbd5e1; margin-bottom: 20px; }
.no-results h3 { font-size: 1.5rem; color: var(--primary); margin-bottom: 10px; }

/* Product Zoom Modal */
.zoom-overlay {
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(15,23,42,0.75);
    backdrop-filter: blur(8px);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.35s ease, visibility 0.35s ease;
}

.zoom-overlay.open {
    opacity: 1;
    visibility: visible;
}

.zoom-close {
    position: absolute;
    top: 24px;
    right: 32px;
    background: none;
    border: none;
    font-size: 2.4rem;
    color: #fff;
    cursor: pointer;
    z-index: 10;
    line-height: 1;
}

.zoom-body {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 40px;
    background: var(--white);
    border-radius: 28px;
    max-width: 860px;
    width: 92%;
    overflow: hidden;
    box-shadow: 0 40px 100px rgba(0,0,0,0.3);
    transform: scale(0.85);
    transition: transform 0.4s cubic-bezier(0.22,1,0.36,1);
}

.zoom-overlay.open .zoom-body {
    transform: scale(1);
}

.zoom-img-wrap {
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 380px;
}

.zoom-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.zoom-details {
    padding: 40px 36px 40px 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.zoom-cat {
    color: var(--accent);
    font-weight: 700;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-bottom: 10px;
}

.zoom-details h2 {
    font-size: 1.8rem;
    color: var(--primary);
    margin-bottom: 14px;
}

.zoom-price {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--primary);
    margin-bottom: 28px;
}

@media (max-width: 768px) {
    .zoom-body { grid-template-columns: 1fr; }
    .zoom-details { padding: 24px; }
    .zoom-img-wrap { min-height: 260px; }
}
</style>

<?php include 'includes/footer.php'; ?>