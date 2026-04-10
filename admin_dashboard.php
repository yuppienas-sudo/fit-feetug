<?php
require_once 'config/database.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch some stats
$order_count = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$product_count = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$total_revenue = $pdo->query("SELECT SUM(total_amount) FROM orders")->fetchColumn();

// Fetch recent orders
$recent_orders = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 5")->fetchAll();

$page_title = 'Admin Dashboard - Fit FeetUg';
include 'includes/header.php';
?>

<main class="admin-dashboard py-16">
    <div class="container-wide">
        <div class="dashboard-header mb-10">
            <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h1>
            <p>Here's what's happening with Fit FeetUg today.</p>
        </div>
        
        <div class="stats-grid mb-12">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
                <div class="stat-info">
                    <h3><?php echo $order_count; ?></h3>
                    <p>Total Orders</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-shoe-prints"></i></div>
                <div class="stat-info">
                    <h3><?php echo $product_count; ?></h3>
                    <p>Total Products</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-money-bill-wave"></i></div>
                <div class="stat-info">
                    <h3>UGX <?php echo number_format($total_revenue ?? 0); ?></h3>
                    <p>Total Revenue</p>
                </div>
            </div>
        </div>
        
        <div class="dashboard-content">
            <div class="recent-orders">
                <div class="section-title mb-6">
                    <h2>Recent Orders</h2>
                </div>
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_orders as $order): ?>
                        <tr>
                            <td>#<?php echo $order['id']; ?></td>
                            <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                            <td>UGX <?php echo number_format($order['total_amount']); ?></td>
                            <td><span class="status-badge <?php echo $order['order_status']; ?>"><?php echo ucfirst($order['order_status']); ?></span></td>
                            <td><?php echo date('M d, Y', strtotime($order['created_at'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($recent_orders)): ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px;">No orders found yet.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<style>
.stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
.stat-card { background: var(--white); padding: 30px; border-radius: 20px; box-shadow: var(--shadow); display: flex; align-items: center; gap: 20px; }
.stat-icon { width: 60px; height: 60px; background: rgba(212, 175, 55, 0.1); border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--accent); }
.stat-info h3 { font-size: 1.8rem; color: var(--primary); }
.stat-info p { color: var(--text-muted); font-size: 0.9rem; }

.status-badge { padding: 4px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
.status-badge.pending { background: #fef3c7; color: #92400e; }
.status-badge.completed { background: #d1fae5; color: #065f46; }
</style>

<?php include 'includes/footer.php'; ?>
