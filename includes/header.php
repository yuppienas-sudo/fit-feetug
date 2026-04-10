<?php
require_once __DIR__ . '/../config/database.php';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Fit FeetUg - Premium Footwear Uganda'; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header class="main-header">
    <div class="top-announcement">
        <div class="container-wide">
            <p><i class="fas fa-truck-fast"></i> FREE DELIVERY ON ORDERS OVER UGX 150,000</p>
            <div class="top-links">
                <a href="#"><i class="fas fa-location-dot"></i> Store Locator</a>
                <a href="faqs.php"><i class="fas fa-headset"></i> Support</a>
            </div>
        </div>
    </div>
    
    <div class="nav-container">
        <div class="container-wide">
            <div class="header-content">
                <a href="index.php" class="logo">
                   <img src="assets/logo.png" alt="Fit FeetUg" class="logo-icon">
                   <span class="logo-text"><span class="logo-fit">FIT</span><span class="logo-feet">FEET</span><span class="logo-ug">UG</span></span>
                </a>
                
                <nav class="desktop-nav">
                    <ul class="nav-menu">
                        <li><a href="index.php" class="<?php echo $current_page == 'index.php' && !isset($_GET['category']) ? 'active' : ''; ?>">Home</a></li>
                        <li class="has-dropdown">
                            <a href="#" class="<?php echo isset($_GET['category']) ? 'active' : ''; ?>">Shop <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="index.php?category=men">Men's Collection</a></li>
                                <li><a href="index.php?category=women">Women's Collection</a></li>
                                <li><a href="index.php?category=children">Children's Collection</a></li>
                            </ul>
                        </li>
                        <li><a href="about.php" class="<?php echo $current_page == 'about.php' ? 'active' : ''; ?>">About Us</a></li>
                        <li><a href="contact.php" class="<?php echo $current_page == 'contact.php' ? 'active' : ''; ?>">Contact</a></li>
                        <li><a href="faqs.php" class="<?php echo $current_page == 'faqs.php' ? 'active' : ''; ?>">FAQs</a></li>
                    </ul>
                </nav>
                
                <div class="header-actions">
                    <div class="search-wrapper">
                        <form action="index.php" method="GET">
                            <input type="text" name="search" placeholder="Search shoes..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    
                    <div class="action-icons">
                        <button class="action-btn search-toggle" title="Search"><i class="fas fa-search"></i></button>
                        
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="admin_dashboard.php" class="action-btn" title="Dashboard"><i class="fas fa-gauge-high"></i></a>
                            <a href="logout.php" class="action-btn" title="Logout"><i class="fas fa-sign-out-alt"></i></a>
                        <?php else: ?>
                            <a href="login.php" class="action-btn login-btn" title="Login"><i class="fas fa-user-circle"></i> <span>Login</span></a>
                        <?php endif; ?>
                        
                        <a href="cart.php" class="action-btn cart-trigger">
                            <i class="fas fa-shopping-bag"></i>
                            <span class="cart-badge">
                                <?php echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0; ?>
                            </span>
                        </a>

                        <button class="mobile-nav-toggle" aria-label="Toggle Menu">
                            <span class="hamburger"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Overlay -->
    <div class="mobile-nav-overlay">
        <div class="mobile-nav-content">
            <ul class="mobile-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php?category=men">Men's Collection</a></li>
                <li><a href="index.php?category=women">Women's Collection</a></li>
                <li><a href="index.php?category=children">Children's Collection</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="faqs.php">FAQs</a></li>
            </ul>
            <div class="mobile-nav-footer">
                <p>Support: +256 700 123456</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </div>
</header>
