<?php
require_once 'config/database.php';

if (empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit();
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

$shipping = $total > 150000 ? 0 : 10000;
$grand_total = $total + $shipping;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $payment_method = trim($_POST['payment_method'] ?? '');
    $valid_methods = ['Cash on Delivery', 'MTN MoMo', 'Airtel Money', 'Visa / Mastercard'];

    if (!$name || !$phone || !$address || !$payment_method) {
        $error = "Please complete all required shipping and payment fields.";
    } elseif (!in_array($payment_method, $valid_methods, true)) {
        $error = "Please choose a valid payment method.";
    }

    if (!isset($error)) {
        try {
            $pdo->beginTransaction();
        
            // Insert order
            $stmt = $pdo->prepare("INSERT INTO orders (customer_name, customer_email, customer_phone, customer_address, payment_method, total_amount) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $phone, $address, $payment_method, $grand_total]);
            $order_id = $pdo->lastInsertId();
        
            // Insert order items
            $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)");
            foreach ($_SESSION['cart'] as $item) {
                $stmt->execute([$order_id, $item['id'], $item['name'], $item['quantity'], $item['price']]);
            }
        
            $pdo->commit();
        
            // Clear cart and save order reference for tracking
            $_SESSION['cart'] = [];
            $_SESSION['order_success'] = true;
            $_SESSION['order_id'] = $order_id;
        
            header("Location: order-success.php");
            exit();
        } catch(Exception $e) {
            $pdo->rollBack();
            $error = "Order failed: " . $e->getMessage();
        }
    }
}

$page_title = 'Checkout - Fit FeetUg';
include 'includes/header.php';
?>

<main class="page-content py-16">
    <div class="container-wide">
        <div class="checkout-layout">
            <div class="checkout-main">
                <div class="checkout-header mb-10">
                    <h2>Shipping Details</h2>
                    <p>Provide your delivery information below</p>
                </div>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-error mb-6"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" class="premium-form">
                    <div class="form-section">
                        <h3>Personal Information</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" placeholder="Okot Bosco" required>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" placeholder="okot@example.com">
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="tel" name="phone" placeholder="+256 700 000000" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section mt-10">
                        <h3>Delivery Address</h3>
                        <div class="form-group">
                            <label>Full Address in Kampala / Region</label>
                            <textarea name="address" rows="3" placeholder="Apartment, Street Name, District" required></textarea>
                        </div>
                    </div>
                    
                    <div class="form-section mt-10">
                        <h3>Payment Method</h3>
                        <div class="payment-grid">
                            <label class="payment-card">
                                <input type="radio" name="payment_method" value="Cash on Delivery" checked required>
                                <div class="card-content">
                                    <i class="fas fa-hand-holding-dollar"></i>
                                    <span>Cash on Delivery</span>
                                </div>
                            </label>
                            <label class="payment-card">
                                <input type="radio" name="payment_method" value="MTN MoMo">
                                <div class="card-content">
                                    <img class="payment-card-logo" src="assets/MTN%20mom%20Logo.png" alt="MTN MoMo">
                                    <span>MTN MoMo</span>
                                </div>
                            </label>
                            <label class="payment-card">
                                <input type="radio" name="payment_method" value="Airtel Money">
                                <div class="card-content">
                                    <img class="payment-card-logo" src="assets/Airtel%20money%20logo.png" alt="Airtel Money">
                                    <span>Airtel Money</span>
                                </div>
                            </label>
                            <label class="payment-card">
                                <input type="radio" name="payment_method" value="Visa / Mastercard">
                                <div class="card-content">
                                    <img class="payment-card-logo" src="assets/visa-card-and-mastercard-logo-png-28.png" alt="Visa / Mastercard">
                                    <span>Visa / Mastercard</span>
                                </div>
                            </label>
                        </div>
                        <p class="payment-note">Choose the payment option you prefer. Mobile money payments are processed immediately, and card payments are secured with SSL encryption.</p>
                        <div id="payment-instructions" class="payment-instructions" style="display:none;">
                            <h4 id="payment-instructions-title">Payment Instructions</h4>
                            <p id="payment-instructions-text">Select a payment method to view details.</p>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-large mt-10 w-full">Complete Purchase</button>
                    <p class="secure-text text-center mt-4">
                        <i class="fas fa-lock"></i> All transactions are secure and encrypted.
                    </p>
                </form>
            </div>
            
            <div class="checkout-sidebar">
                <div class="order-summary-card">
                    <h3>Your Order</h3>
                    <div class="item-list">
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                        <div class="sum-item">
                            <div class="item-name">
                                <strong><?php echo htmlspecialchars($item['name']); ?></strong>
                                <span>Qty: <?php echo $item['quantity']; ?></span>
                            </div>
                            <div class="item-price">
                                UGX <?php echo number_format($item['price'] * $item['quantity']); ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="cost-summary mt-6">
                        <div class="cost-row">
                            <span>Subtotal</span>
                            <span>UGX <?php echo number_format($total); ?></span>
                        </div>
                        <div class="cost-row">
                            <span>Shipping</span>
                            <span class="<?php echo $shipping == 0 ? 'text-success' : ''; ?>">
                                <?php echo $shipping == 0 ? 'FREE' : 'UGX ' . number_format($shipping); ?>
                            </span>
                        </div>
                        <div class="cost-row grand-total">
                            <span>Total</span>
                            <span>UGX <?php echo number_format($grand_total); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.checkout-layout { display: grid; grid-template-columns: 1fr 400px; gap: 60px; }
.checkout-main { background: var(--white); padding: 40px; border-radius: 24px; border: 1px solid var(--border); }
.form-section h3 { font-size: 1.25rem; color: var(--primary); margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid var(--border); }

.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.form-group label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem; color: #475569; }
.premium-form input, .premium-form textarea { width: 100%; padding: 12px 15px; border: 1px solid var(--border); border-radius: 12px; font-size: 1rem; }
.premium-form input:focus { border-color: var(--accent); outline: none; }

.payment-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; }
.payment-card { cursor: pointer; position: relative; }
.payment-card input { position: absolute; opacity: 0; }
.card-content { border: 2px solid var(--border); border-radius: 18px; padding: 24px 12px; text-align: center; transition: all 0.25s ease; background: #ffffff; }
.card-content:hover { transform: translateY(-3px); border-color: rgba(79, 70, 229, 0.25); }
.card-content img.payment-card-logo { display: block; margin: 0 auto 14px; max-height: 36px; width: auto; }
.card-content span { display: block; font-size: 0.95rem; font-weight: 700; color: #475569; }
.payment-note { margin-top: 12px; font-size: 0.9rem; color: #64748b; line-height: 1.6; }

.payment-card input:checked + .card-content { border-color: #800000; background: rgba(128, 0, 0, 0.08); }
.payment-card input:checked + .card-content i { color: #800000; }
.payment-card input:checked + .card-content span { color: #2b2a29; }

.payment-instructions { margin-top: 16px; padding: 18px 20px; border: 1px solid rgba(128, 0, 0, 0.18); background: rgba(128, 0, 0, 0.05); border-radius: 16px; color: #2b2a29; }
.payment-instructions h4 { margin: 0 0 8px; font-size: 1rem; color: #800000; }
.payment-instructions p { margin: 0; font-size: 0.95rem; line-height: 1.6; }

.order-summary-card { background: var(--bg-light); padding: 30px; border-radius: 20px; position: sticky; top: 180px; }
.order-summary-card h3 { margin-bottom: 25px; }
.sum-item { display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 0.95rem; }
.item-name span { display: block; font-size: 0.8rem; color: var(--text-muted); }

.cost-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-weight: 500; }
.grand-total { font-size: 1.5rem; font-weight: 800; color: var(--primary); margin-top: 15px; border-top: 1px solid #cbd5e1; padding-top: 15px; }

.btn-large { padding: 20px; font-size: 1.1rem; }
.secure-text { font-size: 0.85rem; color: var(--text-muted); }

@media (max-width: 1024px) {
    .checkout-layout { grid-template-columns: 1fr; }
    .form-grid { grid-template-columns: 1fr; }
    .order-summary-card { position: static; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentInputs = document.querySelectorAll('input[name="payment_method"]');
    const instructionsBlock = document.getElementById('payment-instructions');
    const instructionsTitle = document.getElementById('payment-instructions-title');
    const instructionsText = document.getElementById('payment-instructions-text');

    const instructions = {
        'Cash on Delivery': {
            title: 'Cash on Delivery',
            text: 'Pay the rider when your order arrives. No advance payment required for deliveries within Kampala.'
        },
        'MTN MoMo': {
            title: 'MTN MoMo Payment',
            text: 'Send payment to 0700 123 456 with your order reference. After payment, share the confirmation code by SMS or WhatsApp to our support number.'
        },
        'Airtel Money': {
            title: 'Airtel Money Payment',
            text: 'Send payment to 0777 123 456 with your order reference. After payment, share the confirmation code by SMS or WhatsApp to our support number.'
        },
        'Visa / Mastercard': {
            title: 'Visa / Mastercard',
            text: 'Our team will contact you with a secure payment link to complete the card transaction. Please keep your card details ready.'
        }
    };

    function updatePaymentInstruction() {
        const selected = document.querySelector('input[name="payment_method"]:checked');
        if (!selected) {
            instructionsBlock.style.display = 'none';
            return;
        }
        const message = instructions[selected.value] || {
            title: 'Payment Instructions',
            text: 'Select a payment option to see instructions.'
        };
        instructionsTitle.textContent = message.title;
        instructionsText.textContent = message.text;
        instructionsBlock.style.display = 'block';
    }

    paymentInputs.forEach(input => input.addEventListener('change', updatePaymentInstruction));
    updatePaymentInstruction();
});
</script>

<?php include 'includes/footer.php'; ?>