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

    // --- Cart Storage & Rendering ---
    const CART_KEY = 'fitfeetugCart';

    const parsePriceValue = text => {
        const value = text ? text.replace(/[^\d]/g, '') : '';
        return value ? parseInt(value, 10) : 0;
    };

    const cartStorage = () => {
        const stored = localStorage.getItem(CART_KEY);
        try {
            return stored ? JSON.parse(stored) : [];
        } catch {
            return [];
        }
    };

    const saveCart = cart => {
        localStorage.setItem(CART_KEY, JSON.stringify(cart));
    };

    const cartQuantity = cart => cart.reduce((sum, item) => sum + (item.quantity || 0), 0);

    const formatCurrency = amount => {
        return 'UGX ' + amount.toLocaleString('en-US');
    };

    const createProductId = (name, price) => {
        return (name || '').toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '') + '-' + price;
    };

    const updateCartBadge = () => {
        const count = cartQuantity(cartStorage());
        document.querySelectorAll('.cart-badge').forEach(badge => {
            badge.textContent = count;
            badge.style.display = count > 0 ? 'flex' : 'none';
        });
    };

    const addProductToCart = product => {
        const cart = cartStorage();
        const existing = cart.find(item => item.id === product.id);
        if (existing) {
            existing.quantity += 1;
        } else {
            cart.push(product);
        }
        saveCart(cart);
        updateCartBadge();
    };

    const getProductFromCard = card => {
        if (!card) return null;
        const name = card.querySelector('.product-name')?.textContent?.trim();
        const category = card.querySelector('.product-cat')?.textContent?.trim();
        const priceText = card.querySelector('.price')?.textContent?.trim();
        const price = parsePriceValue(priceText);
        const image = card.querySelector('.product-image img')?.getAttribute('src') || '';
        const id = createProductId(name, price);
        return name && price ? { id, name, category, price, image, quantity: 1 } : null;
    };

    const renderCartPage = () => {
        const cartArea = document.getElementById('cart-content');
        if (!cartArea) return;

        const cart = cartStorage();
        if (!cart.length) {
            cartArea.innerHTML = `
                <div class="cart-empty text-center p-16 bg-white rounded-3xl border border-slate-100 shadow-sm">
                    <i class="fas fa-shopping-basket fa-3x mb-6"></i>
                    <h2 class="mb-4">Your cart is empty</h2>
                    <p class="text-muted mb-8">Add your favorite shoes from the collection to start building your order.</p>
                    <a href="index.html" class="btn btn-primary">Start Shopping</a>
                </div>
            `;
            return;
        }

        const subtotal = cart.reduce((total, item) => total + item.price * item.quantity, 0);
        const itemsHtml = cart.map(item => `
            <tr>
                <td>
                    <div class="product-brief">
                        <img src="${item.image}" alt="${item.name}">
                        <div>
                            <div class="cart-item-title">${item.name}</div>
                            <div class="cart-item-cat">${item.category}</div>
                        </div>
                    </div>
                </td>
                <td>${formatCurrency(item.price)}</td>
                <td>${item.quantity}</td>
                <td>${formatCurrency(item.price * item.quantity)}</td>
                <td><button class="btn btn-outline cart-remove-btn" data-id="${item.id}">Remove</button></td>
            </tr>
        `).join('');

        cartArea.innerHTML = `
            <div class="cart-actions mb-8">
                <a href="index.html" class="btn btn-outline">Continue Shopping</a>
                <button class="btn btn-outline clear-cart-btn">Clear Cart</button>
            </div>
            <div class="cart-table-wrapper">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>${itemsHtml}</tbody>
                </table>
            </div>
            <div class="cart-summary">
                <div class="summary-box">
                    <div class="summary-row"><span>Subtotal</span><strong>${formatCurrency(subtotal)}</strong></div>
                    <div class="summary-row"><span>Shipping</span><span>Calculated at checkout</span></div>
                    <div class="summary-row"><span>Total</span><strong>${formatCurrency(subtotal)}</strong></div>
                    <a href="checkout.html" class="btn btn-primary w-full">Proceed to Checkout</a>
                </div>
            </div>
        `;
    };

    const renderCheckoutPage = () => {
        const checkoutArea = document.getElementById('checkout-content');
        if (!checkoutArea) return;

        const cart = cartStorage();
        if (!cart.length) {
            checkoutArea.innerHTML = `
                <div class="cart-empty text-center p-16 bg-white rounded-3xl border border-slate-100 shadow-sm">
                    <i class="fas fa-shopping-basket fa-3x mb-6"></i>
                    <h2 class="mb-4">No items in cart</h2>
                    <p class="text-muted mb-8">Your cart is empty. Add products first and then return here to complete checkout.</p>
                    <a href="index.html" class="btn btn-primary">Continue Shopping</a>
                </div>
            `;
            return;
        }

        const subtotal = cart.reduce((total, item) => total + item.price * item.quantity, 0);
        const itemsHtml = cart.map(item => `
            <div class="checkout-item py-4 border-b border-slate-100">
                <div class="flex justify-between items-center gap-4">
                    <div>
                        <div class="font-semibold">${item.name}</div>
                        <div class="text-muted text-sm">Qty: ${item.quantity}</div>
                    </div>
                    <div class="text-right">
                        <div>${formatCurrency(item.price * item.quantity)}</div>
                    </div>
                </div>
            </div>
        `).join('');

        checkoutArea.innerHTML = `
            <div class="checkout-grid grid lg:grid-cols-[1.6fr_1fr] gap-10">
                <div class="checkout-form-box p-10 bg-white rounded-3xl border border-slate-100 shadow-sm">
                    <h2 class="text-2xl font-semibold mb-6">Billing & Delivery</h2>
                    <form class="checkout-form grid gap-5">
                        <div class="form-group"><label>Full Name</label><input type="text" name="name" required placeholder="Your full name"></div>
                        <div class="form-group"><label>Phone Number</label><input type="tel" name="phone" required placeholder="+256 700 123456"></div>
                        <div class="form-group"><label>Delivery Address</label><input type="text" name="address" required placeholder="Your delivery address"></div>
                        <div class="form-group"><label>Payment Method</label><select name="payment" required>
                            <option value="">Select payment method</option>
                            <option value="mtn">MTN MoMo</option>
                            <option value="airtel">Airtel Money</option>
                            <option value="visa">Visa / Mastercard</option>
                            <option value="cod">Cash on Delivery</option>
                        </select></div>
                        <button type="submit" class="btn btn-primary w-full">Place Order</button>
                    </form>
                </div>
                <aside class="checkout-summary-box p-10 bg-white rounded-3xl border border-slate-100 shadow-sm">
                    <h2 class="text-2xl font-semibold mb-6">Order Summary</h2>
                    <div class="checkout-items mb-6">${itemsHtml}</div>
                    <div class="summary-row flex justify-between items-center py-3 border-t border-slate-100"><span>Subtotal</span><strong>${formatCurrency(subtotal)}</strong></div>
                    <div class="summary-row flex justify-between items-center py-3"><span>Shipping</span><span>Calculated later</span></div>
                    <div class="summary-row flex justify-between items-center py-3 text-lg font-semibold"><span>Total</span><strong>${formatCurrency(subtotal)}</strong></div>
                    <p class="text-muted text-sm mt-6">Your payment information is not stored. This demo checkout page confirms your order in the browser.</p>
                </aside>
            </div>
        `;
    };

    const removeItemFromCart = id => {
        const cart = cartStorage().filter(item => item.id !== id);
        saveCart(cart);
        updateCartBadge();
        renderCartPage();
    };

    const clearCart = () => {
        localStorage.removeItem(CART_KEY);
        updateCartBadge();
        renderCartPage();
    };

    document.body.addEventListener('click', e => {
        const addBtn = e.target.closest('.add-btn');
        if (addBtn) {
            e.preventDefault();
            const productCard = addBtn.closest('.product-card');
            const product = getProductFromCard(productCard);
            if (product) {
                addProductToCart(product);
                if (addBtn.getAttribute('href')) {
                    window.location.href = addBtn.getAttribute('href');
                }
            }
        }

        const removeBtn = e.target.closest('.cart-remove-btn');
        if (removeBtn) {
            removeItemFromCart(removeBtn.dataset.id);
        }

        const clearBtn = e.target.closest('.clear-cart-btn');
        if (clearBtn) {
            clearCart();
        }
    });

    document.body.addEventListener('submit', e => {
        const checkoutForm = e.target.closest('.checkout-form');
        if (!checkoutForm) return;
        e.preventDefault();

        if (!cartStorage().length) {
            alert('Your cart is empty. Add items before placing your order.');
            return;
        }

        alert('Thank you! Your order has been submitted.');
        clearCart();
        renderCheckoutPage();
    });

    updateCartBadge();
    renderCartPage();
    renderCheckoutPage();
});
