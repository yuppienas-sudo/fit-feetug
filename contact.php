<?php
$page_title = 'Contact Us - Fit FeetUg';
$contact_success = '';
$contact_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $contact_error = 'Please fill in all fields and provide a valid email address.';
    } else {
        $_SESSION['contact_notice'] = 'Thank you for your message! We will get back to you within 24 hours.';
        header('Location: contact.php');
        exit();
    }
}

if (!empty($_SESSION['contact_notice'])) {
    $contact_success = $_SESSION['contact_notice'];
    unset($_SESSION['contact_notice']);
}

include 'includes/header.php';
?>

<main class="page-content py-20">
    <div class="container-wide">
        <div class="contact-header text-center mb-10">
            <span class="hero-tag">Get in Touch</span>
            <h1>We'd Love to Hear from You</h1>
            <p class="text-muted">Have a question about sizing, delivery, returns, or a special order? Our team is ready to help.</p>
        </div>

        <?php if ($contact_success || $contact_error): ?>
            <div class="alert <?php echo $contact_success ? 'alert-success' : 'alert-error'; ?> mb-10">
                <?php echo htmlspecialchars($contact_success ?: $contact_error); ?>
            </div>
        <?php endif; ?>

        <div class="contact-layout grid grid-cols-2 gap-16">
            <!-- Contact Info -->
            <div class="contact-info-section">
                <div class="info-cards grid gap-6">
                    <div class="info-card p-8 bg-white rounded-3xl border border-slate-100 shadow-sm flex items-start gap-5">
                        <div class="icon-box text-2xl text-accent"><i class="fas fa-location-dot"></i></div>
                        <div>
                            <h3 class="mb-2">Visit Our Store</h3>
                            <p class="text-muted">Plot 34, Nasser Road<br>Kampala, Uganda</p>
                            <div class="map-embed mt-4 rounded-xl overflow-hidden shadow-inner border border-slate-100">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7584143497886!2d32.58042457497298!3d0.3150596996818451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177dbc8019a3111f%3A0x89dc2d53bf1d2757!2sNasser%20Rd%2C%20Kampala!5e0!3m2!1sen!2sug!4v1712616000000!5m2!1sen!2sug" 
                                    width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-card p-8 bg-white rounded-3xl border border-slate-100 shadow-sm flex items-start gap-5">
                        <div class="icon-box text-2xl text-accent"><i class="fas fa-phone"></i></div>
                        <div>
                            <h3 class="mb-2">Call Us</h3>
                            <p class="text-muted">Sales: +256 700 119909<br>Support: +256 784567711</p>
                        </div>
                    </div>

                    <div class="info-card p-8 bg-white rounded-3xl border border-slate-100 shadow-sm flex items-start gap-5">
                        <div class="icon-box text-2xl text-accent"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h3 class="mb-2">Email Us</h3>
                            <p class="text-muted"><a href="mailto:info@fitfeetug.com">info@fitfeetug.com</a></p>
                        </div>
                    </div>
                </div>

                <div class="business-hours mt-10 p-8 bg-slate-50 rounded-3xl">
                    <h3 class="mb-4">Opening Hours</h3>
                    <div class="hours-row flex justify-between mb-2">
                        <span>Mon - Fri</span>
                        <span class="font-bold">08:00 AM - 07:00 PM</span>
                    </div>
                    <div class="hours-row flex justify-between mb-2">
                        <span>Saturday</span>
                        <span class="font-bold">09:00 AM - 05:00 PM</span>
                    </div>
                    <div class="hours-row flex justify-between">
                        <span>Sunday</span>
                        <span class="font-bold">Closed</span>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-section">
                <div class="form-container p-10 bg-white rounded-3xl border border-slate-100 shadow-lg">
                    <h2 class="mb-6">Send a Message</h2>
                    <form id="contact-form" class="premium-form" method="POST" action="contact.php">
                        <div class="form-grid grid grid-cols-2 gap-6 mb-6">
                            <div class="form-group">
                                <label>Your Name</label>
                                <input type="text" name="name" placeholder="Bosco Okot" required>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" placeholder="bosco@example.com" required>
                            </div>
                        </div>
                        <div class="form-group mb-6">
                            <label>Subject</label>
                            <select name="subject" required>
                                <option value="">Select a reason</option>
                                <option value="Product Inquiry">Product Inquiry</option>
                                <option value="Order Status">Order Status</option>
                                <option value="Returns & Exchanges">Returns & Exchanges</option>
                                <option value="Store Visit">Store Visit</option>
                                <option value="General Question">General Question</option>
                            </select>
                        </div>
                        <div class="form-group mb-8">
                            <label>Your Message</label>
                            <textarea name="message" rows="5" placeholder="How can we help you?" required></textarea>
                        </div>
                        <button type="submit" name="contact_submit" class="btn btn-primary w-full py-4 text-lg">
                            <i class="fas fa-paper-plane mr-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.contact-header .hero-tag {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 18px;
    border-radius: 999px;
    background: rgba(59, 130, 246, 0.12);
    color: var(--accent);
    font-size: 0.9rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
}

.contact-header h1 {
    font-size: clamp(2.4rem, 3vw, 3.6rem);
    line-height: 1.05;
    margin-top: 18px;
}

.alert {
    padding: 18px 22px;
    border-radius: 16px;
    font-weight: 600;
    max-width: 800px;
    margin: 0 auto 24px;
}

.alert-success {
    background: #ecfdf5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}

.alert-error {
    background: #fef2f2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

.contact-layout {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 40px;
}

.info-cards .info-card {
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.info-cards .info-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 40px -20px rgba(15, 23, 42, 0.3);
}

.icon-box {
    width: 52px;
    height: 52px;
    border-radius: 18px;
    background: rgba(59, 130, 246, 0.12);
    display: grid;
    place-items: center;
}

.icon-box i {
    color: var(--accent);
}

.info-card h3 {
    margin-bottom: 10px;
    font-size: 1.05rem;
}

.info-card a {
    color: inherit;
    text-decoration: none;
}

.info-card a:hover {
    text-decoration: underline;
}

.business-hours {
    background: rgba(241, 245, 249, 0.9);
}

.business-hours h3 {
    margin-bottom: 18px;
}

.hours-row {
    display: flex;
    justify-content: space-between;
    gap: 12px;
}

.form-container {
    min-height: 100%;
}

.premium-form .form-group label {
    display: block;
    margin-bottom: 10px;
    font-weight: 700;
    color: #0f172a;
}

.premium-form input,
.premium-form select,
.premium-form textarea {
    width: 100%;
    padding: 14px 16px;
    border: 1px solid rgba(148, 163, 184, 0.35);
    border-radius: 14px;
    background: #ffffff;
    transition: border-color 0.2s ease;
}

.premium-form input:focus,
.premium-form select:focus,
.premium-form textarea:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
}

.premium-form select {
    appearance: none;
    background-image: url('data:image/svg+xml,%3Csvg fill="%23647d8c" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/%3E%3C/svg%3E');
    background-repeat: no-repeat;
    background-position: right 16px center;
    background-size: 16px;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

@media (max-width: 1024px) {
    .contact-layout { grid-template-columns: 1fr; }
    .contact-header h1 { font-size: 2.5rem; }
}
</style>

<?php include 'includes/footer.php'; ?>
