<?php
require_once 'config/database.php';

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add to cart
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $image = $_POST['product_image'] ?? '';
    $quantity = (int)$_POST['quantity'];
    
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$id] = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'image' => $image
        ];
    }
    header("Location: cart.php");
    exit();
}

// Remove from cart
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit();
}

// Update quantities
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $id => $qty) {
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id]['quantity'] = $qty;
        }
    }
    header("Location: cart.php");
    exit();
}

// Calculate total
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

$page_title = 'Your Cart - Fit FeetUg';
include 'includes/header.php';
?>

<main class="page-content py-10">
    <div class="container-wide">
        <div class="section-title mb-8">
            <h2><i class="fas fa-shopping-bag"></i> Your Shopping Cart</h2>
            <p>Review your selection before heading to checkout.</p>
        </div>
        
        <?php if (empty($_SESSION['cart'])): ?>
            <div class="empty-cart-state text-center py-16">
                <i class="fas fa-shopping-cart text-6xl text-slate-200 mb-6"></i>
                <p class="text-xl mb-8">Your cart is currently empty.</p>
                <a href="index.php" class="btn btn-primary">Discover Shoes</a>
            </div>
        <?php else: ?>
            <div class="cart-layout">
                <div class="cart-items">
                    <form method="POST" id="cart-form">
                        <table class="premium-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th class="text-right">Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                                <tr>
                                    <td>
                                        <div class="item-detail item-with-image">
                                            <?php if (!empty($item['image'])): ?>
                                            <div class="cart-thumb">
                                                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                                            </div>
                                            <?php endif; ?>
                                            <div>
                                                <strong><?php echo htmlspecialchars($item['name']); ?></strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td>UGX <?php echo number_format($item['price']); ?></td>
                                    <td>
                                        <div class="qty-control">
                                            <input type="number" name="quantity[<?php echo $id; ?>]" value="<?php echo $item['quantity']; ?>" min="0">
                                        </div>
                                    </td>
                                    <td class="text-right"><strong>UGX <?php echo number_format($item['price'] * $item['quantity']); ?></strong></td>
                                    <td class="text-right">
                                        <a href="?remove=<?php echo $id; ?>" class="remove-item"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="cart-actions mt-6">
                            <button type="submit" name="update_cart" class="btn btn-outline">Update Cart</button>
                        </div>
                    </form>
                </div>
                
                <div class="cart-summary">
                    <div class="summary-card">
                        <h3>Order Summary</h3>
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>UGX <?php echo number_format($total); ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Delivery</span>
                            <span class="<?php echo $total > 150000 ? 'text-success' : ''; ?>">
                                <?php echo $total > 150000 ? 'FREE' : 'UGX 10,000'; ?>
                            </span>
                        </div>
                        <hr>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span>UGX <?php echo number_format($total + ($total > 150000 ? 0 : 10000)); ?></span>
                        </div>
                        <a href="checkout.php" class="btn btn-primary w-full mt-6 text-center">Proceed to Checkout</a>
                        <p class="trust-note mt-4"><i class="fas fa-shield-halved"></i> Secure checkout powered by Fit FeetUg</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<style>
.py-10 { padding: 80px 0; }
.py-16 { padding: 120px 0; }
.text-center { text-align: center; }
.mb-8 { margin-bottom: 40px; }
.mt-6 { margin-top: 30px; }
.mt-4 { margin-top: 20px; }
.w-full { width: 100%; }

.premium-table { width: 100%; border-collapse: collapse; }
.premium-table th { text-align: left; padding: 15px; border-bottom: 2px solid var(--border); color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; }
.premium-table td { padding: 25px 15px; border-bottom: 1px solid var(--border); }
.text-right { text-align: right; }

.item-detail { display: flex; align-items: center; gap: 16px; }
.item-detail .cart-thumb { width: 80px; min-width: 80px; height: 80px; border-radius: 18px; overflow: hidden; border: 1px solid var(--border); background: #f8fafc; display: flex; align-items: center; justify-content: center; }
.item-detail .cart-thumb img { width: 100%; height: 100%; object-fit: cover; }

.remove-item { color: #cbd5e1; font-size: 1.2rem; }
.remove-item:hover { color: var(--error); }

.cart-layout { display: grid; grid-template-columns: 1fr 380px; gap: 40px; }

.summary-card { background: var(--white); border-radius: 20px; padding: 30px; border: 1px solid var(--border); position: sticky; top: 180px; }
.summary-card h3 { margin-bottom: 25px; color: var(--primary); }
.summary-row { display: flex; justify-content: space-between; margin-bottom: 15px; font-weight: 500; }
.summary-row.total { font-size: 1.5rem; color: var(--primary); font-weight: 800; margin-top: 15px; }
.summary-card hr { border: none; border-top: 1px solid var(--border); margin: 20px 0; }

.trust-note { font-size: 0.8rem; color: var(--text-muted); text-align: center; }
.text-success { color: var(--success); font-weight: 700; }

.qty-control input { width: 60px; padding: 8px; border: 1px solid var(--border); border-radius: 8px; text-align: center; }

@media (max-width: 1024px) {
    .cart-layout { grid-template-columns: 1fr; }
    .summary-card { position: static; }
}
</style>

<?php include 'includes/footer.php'; ?>