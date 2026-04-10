<?php
require_once 'config/database.php';

$order = null;
$items = [];
$error = null;
$order_id = trim($_GET['order_id'] ?? '');
$search_phone = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = trim($_POST['order_id'] ?? '');
    $search_phone = trim($_POST['customer_phone'] ?? '');

    if (!$order_id || !$search_phone) {
        $error = 'Please enter your Order ID and phone number to track your order.';
    } else {
        $stmt = $pdo->prepare('SELECT * FROM orders WHERE id = ? AND customer_phone = ? LIMIT 1');
        $stmt->execute([$order_id, $search_phone]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            $error = 'No matching order was found. Please verify your Order ID and phone number.';
        } else {
            $stmt = $pdo->prepare('SELECT * FROM order_items WHERE order_id = ?');
            $stmt->execute([$order['id']]);
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}

$page_title = 'Track Your Order - Fit FeetUg';
include 'includes/header.php';
?>

<main class="page-content py-20">
    <div class="container-wide">
        <div class="track-card">
            <div class="track-header text-center mb-10">
                <h1>Track Your Order</h1>
                <p class="text-muted">Enter your order details below to see the latest status and delivery estimate.</p>
            </div>

            <form method="POST" class="track-form">
                <?php if ($error): ?>
                    <div class="alert alert-error mb-6"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Order ID</label>
                        <input type="text" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>" placeholder="e.g. 1234" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="customer_phone" value="<?php echo htmlspecialchars($search_phone); ?>" placeholder="+256 700 123456" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-large mt-6">Track Order</button>
            </form>

            <?php if ($order): ?>
                <div class="status-panel mt-12">
                    <h2>Order #<?php echo htmlspecialchars($order['id']); ?></h2>
                    <div class="status-row">
                        <span>Status:</span>
                        <span class="status-badge <?php echo htmlspecialchars($order['order_status']); ?>"><?php echo ucfirst(htmlspecialchars($order['order_status'])); ?></span>
                    </div>
                    <div class="status-row">
                        <span>Placed On:</span>
                        <span><?php echo date('F j, Y H:i', strtotime($order['created_at'])); ?></span>
                    </div>
                    <div class="status-row">
                        <span>Payment:</span>
                        <span><?php echo htmlspecialchars($order['payment_method']); ?></span>
                    </div>
                    <div class="status-row">
                        <span>Total:</span>
                        <span>UGX <?php echo number_format($order['total_amount']); ?></span>
                    </div>

                    <div class="tracking-note mt-6">
                        <?php if ($order['order_status'] === 'pending'): ?>
                            Your order is being prepared. We will notify you by phone or SMS once it is dispatched.
                        <?php elseif ($order['order_status'] === 'completed' || $order['order_status'] === 'shipped'): ?>
                            Your order has been dispatched and is on its way. Expect delivery soon.
                        <?php else: ?>
                            Our team is processing your order. We will update you with the next delivery milestone shortly.
                        <?php endif; ?>
                    </div>

                    <div class="item-list mt-8">
                        <h3>Items in your order</h3>
                        <?php foreach ($items as $item): ?>
                            <div class="track-item">
                                <span><?php echo htmlspecialchars($item['product_name']); ?></span>
                                <span>Qty: <?php echo (int) $item['quantity']; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<style>
.track-card {
    max-width: 920px;
    margin: 0 auto;
    background: var(--white);
    padding: 40px;
    border-radius: 28px;
    border: 1px solid var(--border);
    box-shadow: 0 18px 45px rgba(0,0,0,0.06);
}
.track-header h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
}
.track-header p {
    color: var(--text-muted);
}
.track-form .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
.track-form .form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #475569;
}
.track-form .form-group input {
    width: 100%;
    padding: 14px 16px;
    border: 1px solid var(--border);
    border-radius: 14px;
    font-size: 1rem;
}
.status-panel {
    background: var(--bg-light);
    border-radius: 20px;
    padding: 28px;
    margin-top: 24px;
}
.status-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
    font-weight: 600;
    color: var(--primary);
}
.status-badge {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 0.85rem;
    text-transform: uppercase;
}
.status-badge.pending { background: #fef3c7; color: #92400e; }
.status-badge.completed, .status-badge.shipped { background: #d1fae5; color: #065f46; }
.status-badge.cancelled { background: #fee2e2; color: #991b1b; }
.tracking-note {
    margin-top: 16px;
    color: #475569;
    font-size: 1rem;
    line-height: 1.7;
}
.item-list h3 {
    margin-bottom: 16px;
    color: var(--primary);
}
.track-item {
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid rgba(216,202,191,0.5);
    padding: 12px 0;
    color: #475569;
}
</style>

<?php include 'includes/footer.php'; ?>
