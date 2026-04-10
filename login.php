<?php
require_once 'config/database.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['user_role'] = $user['role'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}

$page_title = 'Login - Fit FeetUg';
include 'includes/header.php';
?>

<main class="login-page">
    <div class="container">
        <div class="login-card">
            <div class="login-header">
                <h2>Welcome Back</h2>
                <p>Sign in to your Fit FeetUg account</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form action="login.php" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="admin@fitfeetug.com" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>
                
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
                
                <button type="submit" class="btn btn-auth">Login to Account</button>
            </form>
            
            <div class="login-footer">
                <p>Don't have an account? <a href="#">Create account</a></p>
            </div>
            
            <div class="demo-credentials">
                <p><strong>Demo Credentials:</strong></p>
                <p>Email: admin@fitfeetug.com</p>
                <p>Password: admin123</p>
            </div>
        </div>
    </div>
</main>

<style>
/* Temporary inline styles until css/style.css is fully updated */
.login-page {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8fafc;
    padding: 40px 20px;
}
.login-card {
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.05);
    max-width: 450px;
    width: 100%;
}
.login-header { text-align: center; margin-bottom: 30px; }
.login-header h2 { font-family: 'Outfit', sans-serif; font-size: 2rem; color: #0f172a; }
.login-header p { color: #64748b; margin-top: 5px; }

.auth-form .form-group { margin-bottom: 20px; }
.auth-form label { display: block; margin-bottom: 8px; font-weight: 500; color: #334155; }
.input-wrapper { position: relative; }
.input-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
.input-wrapper input {
    width: 100%;
    padding: 12px 15px 12px 45px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s;
}
.input-wrapper input:focus { border-color: #0f172a; outline: none; box-shadow: 0 0 0 4px rgba(15, 23, 42, 0.05); }

.form-options { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; font-size: 0.9rem; }
.btn-auth {
    background: #0f172a;
    color: white;
    width: 100%;
    padding: 14px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    border: none;
    cursor: pointer;
    transition: transform 0.2s, background 0.2s;
}
.btn-auth:hover { background: #1e293b; transform: translateY(-1px); }
.btn-auth:active { transform: translateY(0); }

.alert-error {
    background: #fef2f2;
    color: #b91c1c;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 10px;
}
.demo-credentials {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e2e8f0;
    font-size: 0.85rem;
    color: #64748b;
    text-align: center;
}
</style>

<?php include 'includes/footer.php'; ?>
