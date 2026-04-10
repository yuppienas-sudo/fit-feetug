<?php
session_start();
if (!isset($_SESSION['order_success'])) {
    header("Location: index.php");
    exit();
}
unset($_SESSION['order_success']);

$page_title = 'Order Confirmation - Fit FeetUg';
include 'includes/header.php';
?>

<main class="page-content py-20 text-center">
    <div class="container">
        <div class="success-card">
            <div class="success-icon mb-6">
                <div class="ripple"></div>
                <i class="fas fa-check-circle"></i>
            </div>
            
            <h1 class="mb-4">Thank You for Your Order!</h1>
            <p class="text-lg text-muted mb-8">
                Your order was successfully placed. Our team in Kampala is already preparing your premium footwear for delivery.
            </p>
            
            <div class="order-info-box mb-10">
                <div class="info-row">
                    <i class="fas fa-truck"></i>
                    <span>Estimated Delivery: 24 - 48 Hours</span>
                </div>
                <div class="info-row">
                    <i class="fas fa-mobile-screen"></i>
                    <span>Confirmation SMS sent to your phone</span>
                </div>
                <?php if (isset($_SESSION['order_id'])): ?>
                <div class="info-row">
                    <i class="fas fa-receipt"></i>
                    <span>Order ID: #<?php echo htmlspecialchars($_SESSION['order_id']); ?></span>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="success-actions">
                <a href="index.php" class="btn btn-primary">Continue Shopping</a>
                <a href="track-order.php<?php echo isset($_SESSION['order_id']) ? '?order_id=' . urlencode($_SESSION['order_id']) : ''; ?>" class="btn btn-outline ml-4">Track Your Order</a>
            </div>
        </div>
    </div>
</main>

<style>
.py-20 { padding: 120px 0; }
.text-lg { font-size: 1.15rem; }
.ml-4 { margin-left: 15px; }

.success-card {
    max-width: 650px;
    margin: 0 auto;
    background: var(--white);
    padding: 60px 40px;
    border-radius: 30px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.05);
}

.success-icon {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0 auto 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.success-icon i {
    font-size: 5rem;
    color: var(--success);
    z-index: 2;
}

.ripple {
    position: absolute;
    width: 100%;
    height: 100%;
    background: var(--success);
    border-radius: 50%;
    opacity: 0.1;
    animation: ripple 2s infinite;
}

@keyframes ripple {
    0% { transform: scale(1); opacity: 0.2; }
    100% { transform: scale(2); opacity: 0; }
}

.order-info-box {
    background: var(--bg-light);
    border-radius: 15px;
    padding: 25px;
    display: inline-block;
    text-align: left;
}

.info-row {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 10px;
    font-weight: 600;
    color: var(--primary);
}

.info-row i { color: var(--accent); }
</style>

<?php include 'includes/footer.php'; ?>