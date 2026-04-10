<?php
$page_title = 'About Us - Fit FeetUg';
include 'includes/header.php';
?>

<main class="page-content py-20">
    <div class="container-wide">
        <!-- Hero -->
        <div class="about-hero text-center mb-16">
            <span class="hero-tag">Our Story</span>
            <h1 class="mb-6">Uganda's Shoe Destination</h1>
            <p class="max-w-3xl mx-auto text-lg text-muted">
                Fit FeetUg was born in Kampala with one goal: to make premium, stylish, and comfortable footwear available to every Ugandan. Launched in 2026 by a group of local entrepreneurs, we saw a gap in the market — great shoes were often scattered across specialty stores, and online options lacked consistency in sizing, quality, and customer care.
            </p>
        </div>

        <div class="about-grid grid grid-cols-2 gap-12 items-center mb-20">
            <div class="about-image">
                <img src="assets/hero-shoes.png" alt="Premium Shoes" class="rounded-3xl shadow-xl">
            </div>
            <div class="about-text">
                <h2 class="mb-6">Built Around Local Style</h2>
                <p class="mb-4 text-black">From our headquarters on Nasser Road, we blend local taste with international shoe standards. Our customers enjoy a curated selection of footwear that combines durability, comfort, and on-trend design.</p>
                <p class="text-black">Whether you need formal wear for work, sneakers for the weekend, or reliable shoes for everyday life, Fit FeetUg delivers a simple, dependable shopping experience.</p>
            </div>
        </div>

        <div class="why-us-grid grid grid-cols-3 gap-8 mb-20">
            <div class="feature-card p-10 bg-white rounded-3xl border border-slate-100 shadow-sm">
                <div class="icon-box mb-5 text-4xl text-accent"><i class="fas fa-shoe-prints"></i></div>
                <h3 class="mb-3">Curated Selection</h3>
                <p class="text-muted">A handpicked range of footwear for men, women, and children, chosen for quality, comfort, and style.</p>
            </div>
            <div class="feature-card p-10 bg-white rounded-3xl border border-slate-100 shadow-sm">
                <div class="icon-box mb-5 text-4xl text-accent"><i class="fas fa-map-marker-alt"></i></div>
                <h3 class="mb-3">Local Delivery</h3>
                <p class="text-muted">Fast delivery across Kampala and beyond, with reliable service and flexible payment options.</p>
            </div>
            <div class="feature-card p-10 bg-white rounded-3xl border border-slate-100 shadow-sm">
                <div class="icon-box mb-5 text-4xl text-accent"><i class="fas fa-headset"></i></div>
                <h3 class="mb-3">Trusted Support</h3>
                <p class="text-muted">Dedicated customer care for easy returns, size guidance, and order support from our Kampala team.</p>
            </div>
        </div>

        <!-- Mission / Vision / Values -->
        <div class="mission-vision-grid grid grid-cols-3 gap-8">
            <div class="mission-card p-10 bg-white rounded-3xl border border-slate-100 shadow-sm">
                <div class="icon-box mb-6 text-3xl text-accent"><i class="fas fa-bullseye"></i></div>
                <h3 class="mb-4">Our Mission</h3>
                <p class="text-muted">To make stylish, comfortable, and durable footwear accessible to everyone in Uganda through a trusted retail experience.</p>
            </div>
            <div class="vision-card p-10 bg-primary text-white rounded-3xl shadow-sm">
                <div class="icon-box mb-6 text-3xl text-accent"><i class="fas fa-eye"></i></div>
                <h3 class="mb-4">Our Vision</h3>
                <p class="opacity-80">To become the most loved footwear brand in East Africa, known for quality, honesty, and exceptional customer care.</p>
            </div>
            <div class="value-card p-10 bg-white rounded-3xl border border-slate-100 shadow-sm">
                <div class="icon-box mb-6 text-3xl text-accent"><i class="fas fa-heart"></i></div>
                <h3 class="mb-4">Our Values</h3>
                <p class="text-muted">We stand for trust, convenience, quality, and a joyful shopping experience for every customer.</p>
            </div>
        </div>

        <!-- Team -->
        <div class="team-section mt-20">
            <div class="section-header text-center mb-12">
                <span class="hero-tag">Meet the Team</span>
                <h2>Passionate People Behind Fit FeetUg</h2>
                <p class="max-w-3xl mx-auto text-lg text-muted">Our dedicated team brings together local market expertise, footwear know-how, and customer-first service to deliver the best shopping experience.</p>
            </div>

            <div class="team-grid grid grid-cols-4 gap-8">
                <div class="team-card p-10 bg-white rounded-3xl border border-slate-100 shadow-sm text-center">
                    <div class="team-avatar mb-5">AB</div>
                    <h4>Angela Bwanga</h4>
                    <p class="text-muted">Founder & CEO</p>
                </div>
                <div class="team-card p-10 bg-white rounded-3xl border border-slate-100 shadow-sm text-center">
                    <div class="team-avatar mb-5">RM</div>
                    <h4>Richard Mukasa</h4>
                    <p class="text-muted">Operations Lead</p>
                </div>
                <div class="team-card p-10 bg-white rounded-3xl border border-slate-100 shadow-sm text-center">
                    <div class="team-avatar mb-5">SS</div>
                    <h4>Sarah Ssekandi</h4>
                    <p class="text-muted">Customer Experience</p>
                </div>
                <div class="team-card p-10 bg-white rounded-3xl border border-slate-100 shadow-sm text-center">
                    <div class="team-avatar mb-5">KM</div>
                    <h4>Kevin Mutesi</h4>
                    <p class="text-muted">Logistics Manager</p>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.py-20 { padding: 120px 0; }
.mb-16 { margin-bottom: 80px; }
.mb-20 { margin-bottom: 100px; }
.max-w-3xl { max-width: 48rem; }
.mx-auto { margin-left: auto; margin-right: auto; }
.text-lg { font-size: 1.15rem; }
.grid { display: grid; }
.grid-cols-2 { grid-template-columns: repeat(2, 1fr); }
.grid-cols-3 { grid-template-columns: repeat(3, 1fr); }
.gap-12 { gap: 48px; }
.gap-8 { gap: 32px; }
.items-center { align-items: center; }
.rounded-3xl { border-radius: 1.5rem; }
.shadow-xl { box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); }
.p-10 { padding: 40px; }
.about-hero { padding-bottom: 32px; }
.about-hero .hero-tag { display: inline-block; margin-bottom: 14px; color: #800000; font-size: 0.85rem; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase; }
.about-hero h1 { font-size: clamp(2.4rem, 4vw, 3.4rem); line-height: 1.05; margin-bottom: 1rem; }
.about-hero p { color: #000; line-height: 1.8; margin: 0 auto; }
.about-grid { align-items: center; gap: 60px; }
.about-image { max-width: 520px; width: 100%; }
.about-text { max-width: 620px; }
.about-text h2 { color: #111827; }
.about-text p { color: #000; }
.about-image img { width: 100%; max-width: 420px; display: block; margin: 0 auto; }
.feature-card h3, .mission-card h3, .vision-card h3, .value-card h3 { color: var(--primary); }
.about-hero p, .about-text p, .feature-card p, .mission-card p, .value-card p, .team-card p { color: #000; }
.vision-card p { color: rgba(255,255,255,0.85); }
.why-us-grid { grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
.mission-vision-grid { grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }

.team-section .section-header h2 { font-size: 2rem; margin-top: 12px; margin-bottom: 10px; }
.team-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 32px; margin-top: 20px; }
.team-card { transition: transform 0.25s ease, box-shadow 0.25s ease; }
.team-card:hover { transform: translateY(-5px); box-shadow: 0 25px 50px rgba(0,0,0,0.08); }
.team-avatar {
    width: 90px;
    height: 90px;
    margin: 0 auto 20px;
    overflow: hidden;
    border-radius: 50%;
    border: 2px solid rgba(128,0,0,0.18);
}
.team-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.team-card h4 { margin-bottom: 8px; color: var(--primary); }
.team-card p { color: #64748b; }

@media (max-width: 1024px) {
    .grid-cols-3 { grid-template-columns: 1fr; }
    .team-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 768px) {
    .grid-cols-2 { grid-template-columns: 1fr; }
    .team-grid { grid-template-columns: 1fr; }
}
</style>

<?php include 'includes/footer.php'; ?>
