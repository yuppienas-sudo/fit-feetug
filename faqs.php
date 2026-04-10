<?php
$page_title = 'Frequently Asked Questions - Fit FeetUg';
include 'includes/header.php';
?>

<main class="page-content py-20">
    <div class="container-wide">
        <div class="faq-header text-center mb-16">
            <span class="hero-tag">Support Center</span>
            <h1>Frequently Asked Questions</h1>
            <p class="text-muted">Quick answers about delivery, payments, returns, and ordering from Fit FeetUg.</p>
        </div>

        <div class="faq-container max-w-4xl mx-auto">
            <!-- Category: Delivery -->
            <div class="faq-section mb-12">
                <h2 class="mb-6"><i class="fas fa-truck text-accent mr-3"></i> Shipping & Delivery</h2>
                <div class="faq-list grid gap-4">
                    <div class="faq-item p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
                        <div class="faq-question flex justify-between items-center cursor-pointer">
                            <h3 class="text-lg">How long does delivery take in Kampala?</h3>
                            <i class="fas fa-plus transition-transform"></i>
                        </div>
                        <div class="faq-answer mt-4 text-muted border-t pt-4">
                            For orders within Kampala, we offer express delivery within **24 to 48 hours**. Orders placed before 10 AM often arrive the same day!
                        </div>
                    </div>
                    
                    <div class="faq-item p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
                        <div class="faq-question flex justify-between items-center cursor-pointer">
                            <h3 class="text-lg">Do you deliver upcountry?</h3>
                            <i class="fas fa-plus transition-transform"></i>
                        </div>
                        <div class="faq-answer mt-4 text-muted border-t pt-4">
                            Yes, we deliver to all major towns in Uganda including Jinja, Mbarara, Gulu, Lira, Soroti, Hoima, Arua and Mbale. Upcountry delivery typically takes **3 to 5 business days**.
                        </div>
                    </div>
                    
                    <div class="faq-item p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
                        <div class="faq-question flex justify-between items-center cursor-pointer">
                            <h3 class="text-lg">How can I track my order?</h3>
                            <i class="fas fa-plus transition-transform"></i>
                        </div>
                        <div class="faq-answer mt-4 text-muted border-t pt-4">
                            Once your order is confirmed, we will send a tracking link to your email or phone. You can also track your order anytime on our <a href="track-order.php">Track Order</a> page, or contact our support team at <a href="mailto:info@fitfeetug.com">info@fitfeetug.com</a> for live delivery updates.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category: Payments -->
            <div class="faq-section mb-12">
                <h2 class="mb-6"><i class="fas fa-credit-card text-accent mr-3"></i> Payment Methods</h2>
                <div class="faq-list grid gap-4">
                    <div class="faq-item p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
                        <div class="faq-question flex justify-between items-center cursor-pointer">
                            <h3 class="text-lg">What payment methods do you accept?</h3>
                            <i class="fas fa-plus transition-transform"></i>
                        </div>
                        <div class="faq-answer mt-4 text-muted border-t pt-4">
                            We accept **MTN MoMo**, **Airtel Money**, **Visa / Mastercard**, and **Cash on Delivery** for orders within Kampala. All card payments are processed securely, and mobile money payments are confirmed immediately.
                        </div>
                    </div>
                    <div class="faq-item p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
                        <div class="faq-question flex justify-between items-center cursor-pointer">
                            <h3 class="text-lg">Is my payment information secure?</h3>
                            <i class="fas fa-plus transition-transform"></i>
                        </div>
                        <div class="faq-answer mt-4 text-muted border-t pt-4">
                            Yes. Card payments are processed through secure payment providers with SSL encryption. We never store your full card details on our servers.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category: Returns -->
            <div class="faq-section mb-12">
                <h2 class="mb-6"><i class="fas fa-rotate text-accent mr-3"></i> Returns & Exchanges</h2>
                <div class="faq-list grid gap-4">
                    <div class="faq-item p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
                        <div class="faq-question flex justify-between items-center cursor-pointer">
                            <h3 class="text-lg">Can I exchange shoes if they don't fit?</h3>
                            <i class="fas fa-plus transition-transform"></i>
                        </div>
                        <div class="faq-answer mt-4 text-muted border-t pt-4">
                            Absolutely! We offer a **7-day exchange policy**. The shoes must be unworn and in their original packaging. Simply contact us or visit our Nasser Road store.
                        </div>
                    </div>
                    <div class="faq-item p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
                        <div class="faq-question flex justify-between items-center cursor-pointer">
                            <h3 class="text-lg">How do I start a return or exchange?</h3>
                            <i class="fas fa-plus transition-transform"></i>
                        </div>
                        <div class="faq-answer mt-4 text-muted border-t pt-4">
                            Contact our support team at <a href="mailto:info@fitfeetug.com">info@fitfeetug.com</a> or visit our showroom with your order details. We will guide you through the return process and issue an exchange or refund quickly.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.max-w-4xl { max-width: 56rem; }
.border-t { border-top: 1px solid var(--border); }
.pt-4 { padding-top: 16px; }

/* Accordion Specific CSS */
.faq-answer { display: none; }
.faq-item.active .faq-answer { display: block; }
.faq-item.active .faq-question i { transform: rotate(45deg); color: var(--accent); }
.faq-item.active { border-color: var(--accent); }

.transition-transform { transition: transform 0.3s ease; }
</style>

<?php include 'includes/footer.php'; ?>
