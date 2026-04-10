document.addEventListener('DOMContentLoaded', () => {
    console.log('Fit FeetUg - Premium Experience Initialized');

    // --- Hero Crossfade Slideshow ---
    const heroSlides = document.querySelectorAll('.hero-slide');
    if (heroSlides.length > 1) {
        let current = 0;
        setInterval(() => {
            const outgoing = heroSlides[current];
            current = (current + 1) % heroSlides.length;
            const incoming = heroSlides[current];

            // Outgoing: fade out with a slight zoom
            outgoing.classList.remove('active');
            outgoing.classList.add('fade-out');

            // Incoming: fade in
            incoming.classList.add('active');

            // Clean up fade-out class after transition ends
            setTimeout(() => {
                outgoing.classList.remove('fade-out');
            }, 1600);
        }, 5000);
    }

    // --- Mobile Navigation Logic ---
    const mobileToggle = document.querySelector('.mobile-nav-toggle');
    const mobileOverlay = document.querySelector('.mobile-nav-overlay');
    const body = document.body;

    // --- Product Zoom-Out Modal ---
    const zoomOverlay = document.getElementById('product-zoom');
    if (zoomOverlay) {
        document.querySelectorAll('.product-card .product-image').forEach(imgDiv => {
            imgDiv.addEventListener('click', (e) => {
                // Don't open modal if user clicked the add-to-cart button
                if (e.target.closest('.add-btn')) return;

                const card = imgDiv.closest('.product-card');
                const img = imgDiv.querySelector('img');
                const name = card.querySelector('.product-name')?.textContent?.trim() || '';
                const cat = card.querySelector('.product-cat')?.textContent?.trim() || '';
                const price = card.querySelector('.price')?.textContent?.trim() || '';
                const form = card.querySelector('form');

                document.getElementById('zoom-img').src = img ? img.src : '';
                document.getElementById('zoom-name').textContent = name;
                document.getElementById('zoom-cat').textContent = cat;
                document.getElementById('zoom-price').textContent = price;

                if (form) {
                    document.getElementById('zoom-pid').value = form.querySelector('[name=product_id]').value;
                    document.getElementById('zoom-pname').value = form.querySelector('[name=product_name]').value;
                    document.getElementById('zoom-pprice').value = form.querySelector('[name=product_price]').value;
                    document.getElementById('zoom-pimg').value = form.querySelector('[name=product_image]').value;
                }

                zoomOverlay.classList.add('open');
                body.classList.add('no-scroll');
            });
        });

        // Close zoom modal
        zoomOverlay.querySelector('.zoom-close').addEventListener('click', () => {
            zoomOverlay.classList.remove('open');
            body.classList.remove('no-scroll');
        });

        zoomOverlay.addEventListener('click', (e) => {
            if (e.target === zoomOverlay) {
                zoomOverlay.classList.remove('open');
                body.classList.remove('no-scroll');
            }
        });
    }

    if (mobileToggle && mobileOverlay) {
        mobileToggle.addEventListener('click', () => {
            mobileToggle.classList.toggle('active');
            mobileOverlay.classList.toggle('active');
            body.classList.toggle('no-scroll');
        });

        // Close menu on link click
        mobileOverlay.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileToggle.classList.remove('active');
                mobileOverlay.classList.remove('active');
                body.classList.remove('no-scroll');
            });
        });
    }

    // --- FAQ Accordion Logic ---
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            faqItems.forEach(i => i.classList.remove('active'));
            if (!isActive) item.classList.add('active');
        });
    });

    // --- Custom Success Modal Logic ---
    const contactForm = document.getElementById('contact-form');
    const successModal = document.getElementById('success-modal');
    const closeModal = document.querySelector('.close-modal');

    if (contactForm && successModal) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const btn = contactForm.querySelector('button');
            const originalText = btn.innerHTML;
            
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            btn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
                contactForm.reset();
                
                // Show custom modal
                successModal.classList.add('active');
                body.classList.add('no-scroll');
            }, 1200);
        });
    }

    if (closeModal && successModal) {
        closeModal.addEventListener('click', () => {
            successModal.classList.remove('active');
            body.classList.remove('no-scroll');
        });

        window.addEventListener('click', (e) => {
            if (e.target === successModal) {
                successModal.classList.remove('active');
                body.classList.remove('no-scroll');
            }
        });
    }

    // --- Scroll Reveal Animations ---
    const revealElements = document.querySelectorAll('.about-grid, .mission-vision-grid, .info-card, .faq-section');
    
    const revealOnScroll = () => {
        const triggerBottom = window.innerHeight * 0.85;
        revealElements.forEach(el => {
            const elTop = el.getBoundingClientRect().top;
            if (elTop < triggerBottom) {
                el.classList.add('revealed');
            }
        });
    };

    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll(); // Initial check

    // Header effects
    const header = document.querySelector('.main-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 80) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // --- Search Toggle ---
    const searchToggle = document.querySelector('.search-toggle');
    const searchWrapper = document.querySelector('.search-wrapper');
    if (searchToggle && searchWrapper) {
        searchToggle.addEventListener('click', () => {
            searchWrapper.classList.toggle('active');
            if (searchWrapper.classList.contains('active')) {
                searchWrapper.querySelector('input').focus();
            }
        });
    }
});
