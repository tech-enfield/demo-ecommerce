@extends('layouts.app')
@section('content')
<div class="cart-container">


    <section class="breadcrumb-section">
        <div class="container-fluid">
            <div class="breadcrumb-content">
                <!-- LEFT SIDE TEXT -->
                <div class="breadcrumb-left">
                    <h1 id="breadcrumbTitle">Cart</h1>
                    <ul class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li id="breadcrumbCategory">Cart</li>
                    </ul>

                </div>

                <!-- RIGHT SIDE IMAGE -->
                <div class="breadcrumb-right">
                    <img src="{{ asset('assets/img/aaa.png') }}" alt="Laptop Banner">
                </div>
            </div>
        </div>
    </section>

    <!-- Header -->
    <div class="cart-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h2 mb-2">Your Shopping Cart</h1>
                <p class="mb-0 opacity-75">Review your items and proceed to checkout</p>
            </div>
            <div class="d-flex align-items-center">
                <i class="fas fa-shopping-cart fa-2x me-3"></i>
                <div class="text-end">
                    <div class="h4 mb-0 cart-item-count">0 items</div>
                    <small>in your cart</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Cart Items Section -->
        <div class="col-lg-8">
            <div id="cart-items-container">
                <!-- Cart items will be loaded here -->
            </div>

            <!-- Continue Shopping & Actions -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="#" class="btn btn-outline-secondary" id="continue-shopping">
                    <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                </a>
                <div>
                    <button class="btn btn-outline-danger me-2" id="clear-cart">
                        <i class="fas fa-trash me-2"></i> Clear Cart
                    </button>
                    <button class="btn btn-primary" id="update-cart">
                        <i class="fas fa-sync-alt me-2"></i> Update Cart
                    </button>
                </div>
            </div>

            <!-- Related Products -->
            <div class="mt-5">
                <h4 class="mb-4">You might also like</h4>
                <div class="row" id="related-products">
                    <!-- Related products will be loaded here -->
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card summary-card">
                <div class="card-header">
                    <i class="fas fa-receipt me-2"></i> Order Summary
                </div>
                <div class="card-body">
                    <div class="summary-details mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span class="fw-semibold" id="subtotal">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span id="shipping">$5.99</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax (8%)</span>
                            <span id="tax">$0.00</span>
                        </div>
                        <div id="discount-container" class="d-none">
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>Discount</span>
                                <span id="discount">-$0.00</span>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="h5">Total</span>
                            <span class="h4 text-primary" id="total">$0.00</span>
                        </div>
                        <div id="savings-container" class="savings-badge text-center d-none">
                            <i class="fas fa-piggy-bank me-2"></i>
                            You save <span id="savings">$0.00</span>
                        </div>
                    </div>

                   

                    <!-- Checkout Button -->
                    <button class="btn btn-checkout w-100 mb-3" id="checkout-btn">
                        <i class="fas fa-lock me-2"></i> Proceed to Checkout
                    </button>

                    <!-- Payment Methods -->
                    <div class="text-center mb-3">
                        <small class="text-muted d-block mb-2">We accept</small>
                        <div class="payment-methods">
                            <i class="fab fa-cc-visa text-primary"></i>
                            <i class="fab fa-cc-mastercard text-danger"></i>
                            <i class="fab fa-cc-amex text-info"></i>
                            <i class="fab fa-cc-paypal text-primary"></i>
                            <i class="fab fa-cc-apple-pay"></i>
                        </div>
                    </div>

                    <!-- Security Badge -->
                    <div class="text-center">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt me-1"></i>
                            256-bit SSL Secure Checkout
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div id="toast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            <i class="fas fa-check-circle me-2"></i>
            <span id="toast-message">Item added to cart!</span>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Cart Data Storage
    class CartManager {
        constructor() {
            this.cartKey = 'shopping_cart';
            this.promoKey = 'applied_promo';
            this.products = this.getSampleProducts();
            this.loadCart();
            this.setupEventListeners();
            this.renderCart();
            this.renderRelatedProducts();
            this.updateSummary();
            this.setupBreadcrumbListeners();
        }

        getSampleProducts() {
            return [{
                    id: 1,
                    name: 'Classic Cotton T-Shirt',
                    description: 'Soft, breathable cotton t-shirt for everyday wear',
                    price: 24.99,
                    originalPrice: 29.99,
                    image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400&h=400&fit=crop',
                    category: 'Clothing',
                    stock: 15,
                    rating: 4.5,
                    color: 'Black',
                    size: 'M'
                },
                {
                    id: 2,
                    name: 'Premium Denim Jeans',
                    description: 'Slim-fit denim jeans with stretch comfort',
                    price: 89.99,
                    originalPrice: 99.99,
                    image: 'https://images.unsplash.com/photo-1542272604-787c3835535d?w-400&h=400&fit=crop',
                    category: 'Clothing',
                    stock: 8,
                    rating: 4.8,
                    color: 'Blue',
                    size: '32'
                },
                {
                    id: 3,
                    name: 'Wireless Bluetooth Headphones',
                    description: 'Noise-cancelling over-ear headphones',
                    price: 199.99,
                    originalPrice: 249.99,
                    image: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=400&fit=crop',
                    category: 'Electronics',
                    stock: 12,
                    rating: 4.7,
                    color: 'Black',
                    warranty: '1 year'
                },
                {
                    id: 4,
                    name: 'Smart Watch Series 5',
                    description: 'Fitness tracking and smart notifications',
                    price: 299.99,
                    originalPrice: 349.99,
                    image: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&h=400&fit=crop',
                    category: 'Electronics',
                    stock: 5,
                    rating: 4.9,
                    color: 'Silver',
                    warranty: '2 years'
                }
            ];
        }

        getRelatedProducts() {
            return [{
                    id: 5,
                    name: 'Running Shoes',
                    description: 'Lightweight running shoes with cushioning',
                    price: 79.99,
                    image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&h=400&fit=crop',
                    category: 'Footwear',
                    stock: 20,
                    rating: 4.6
                },
                {
                    id: 6,
                    name: 'Backpack',
                    description: 'Water-resistant laptop backpack',
                    price: 49.99,
                    image: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400&h=400&fit=crop',
                    category: 'Accessories',
                    stock: 25,
                    rating: 4.4
                },
                {
                    id: 7,
                    name: 'Coffee Mug Set',
                    description: 'Ceramic mugs with heat-resistant coating',
                    price: 34.99,
                    image: 'https://images.unsplash.com/photo-1514228742587-6b1558fcf93a?w=400&h=400&fit=crop',
                    category: 'Home',
                    stock: 50,
                    rating: 4.3
                },
                {
                    id: 8,
                    name: 'Desk Lamp',
                    description: 'LED desk lamp with adjustable brightness',
                    price: 44.99,
                    image: 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=400&h=400&fit=crop',
                    category: 'Home',
                    stock: 18,
                    rating: 4.5
                }
            ];
        }

        loadCart() {
            const cartData = localStorage.getItem(this.cartKey);
            this.cart = cartData ? JSON.parse(cartData) : [{
                    id: 1,
                    productId: 1,
                    quantity: 2,
                    price: 24.99,
                    name: 'Classic Cotton T-Shirt',
                    image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400&h=400&fit=crop',
                    color: 'Black',
                    size: 'M'
                },
                {
                    id: 2,
                    productId: 2,
                    quantity: 1,
                    price: 89.99,
                    name: 'Premium Denim Jeans',
                    image: 'https://images.unsplash.com/photo-1542272604-787c3835535d?w-400&h=400&fit=crop',
                    color: 'Blue',
                    size: '32'
                }
            ];
            this.appliedPromo = localStorage.getItem(this.promoKey);
        }

        saveCart() {
            localStorage.setItem(this.cartKey, JSON.stringify(this.cart));
            this.updateCartCount();
        }

        updateCartCount() {
            const totalItems = this.cart.reduce((sum, item) => sum + item.quantity, 0);
            const itemText = `${totalItems} ${totalItems === 1 ? 'item' : 'items'}`;
            document.querySelector('.cart-item-count').textContent = itemText;
            document.getElementById('breadcrumb-cart-count').textContent = itemText;
            return totalItems;
        }

        getProductById(id) {
            return this.products.find(p => p.id === id) || this.getRelatedProducts().find(p => p.id === id);
        }

        addToCart(productId, quantity = 1) {
            const product = this.getProductById(productId);
            if (!product) return false;

            const existingItem = this.cart.find(item => item.productId === productId);

            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                this.cart.push({
                    id: Date.now(),
                    productId: product.id,
                    quantity: quantity,
                    price: product.price,
                    name: product.name,
                    image: product.image,
                    color: product.color || 'Default',
                    size: product.size || 'One Size'
                });
            }

            this.saveCart();
            this.renderCart();
            this.updateSummary();
            this.showToast('Item added to cart!');
            return true;
        }

        updateQuantity(itemId, newQuantity) {
            if (newQuantity < 1) {
                this.removeFromCart(itemId);
                return;
            }

            const item = this.cart.find(item => item.id === itemId);
            if (item) {
                item.quantity = newQuantity;
                this.saveCart();
                this.renderCart();
                this.updateSummary();
            }
        }

        removeFromCart(itemId) {
            this.cart = this.cart.filter(item => item.id !== itemId);
            this.saveCart();
            this.renderCart();
            this.updateSummary();
            this.showToast('Item removed from cart');
        }

        clearCart() {
            if (this.cart.length === 0) return;

            if (confirm('Are you sure you want to clear your cart?')) {
                this.cart = [];
                this.appliedPromo = null;
                localStorage.removeItem(this.promoKey);
                this.saveCart();
                this.renderCart();
                this.updateSummary();
                this.showToast('Cart cleared successfully');
            }
        }

        applyPromoCode(code) {
            const promoMessage = document.getElementById('promo-message');
            const validPromoCodes = {
                'SAVE10': 10,
                'SAVE20': 20,
                'WELCOME15': 15
            };

            code = code.toUpperCase();

            if (validPromoCodes[code]) {
                this.appliedPromo = {
                    code,
                    discount: validPromoCodes[code]
                };
                localStorage.setItem(this.promoKey, JSON.stringify(this.appliedPromo));
                promoMessage.innerHTML = `<span class="text-success"><i class="fas fa-check-circle me-1"></i> Promo code applied! ${this.appliedPromo.discount}% off</span>`;
                this.updateSummary();
                this.showToast('Promo code applied!');
            } else {
                promoMessage.innerHTML = `<span class="text-danger"><i class="fas fa-times-circle me-1"></i> Invalid promo code</span>`;
            }
        }

        calculateTotals() {
            const subtotal = this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const shipping = subtotal > 100 ? 0 : 5.99;
            const tax = subtotal * 0.08;

            let discount = 0;
            if (this.appliedPromo) {
                discount = subtotal * (this.appliedPromo.discount / 100);
            }

            const total = subtotal + shipping + tax - discount;
            const totalSavings = this.cart.reduce((sum, item) => {
                const product = this.getProductById(item.productId);
                if (product && product.originalPrice) {
                    return sum + ((product.originalPrice - product.price) * item.quantity);
                }
                return sum;
            }, 0) + discount;

            return {
                subtotal: Math.round(subtotal * 100) / 100,
                shipping: Math.round(shipping * 100) / 100,
                tax: Math.round(tax * 100) / 100,
                discount: Math.round(discount * 100) / 100,
                total: Math.round(total * 100) / 100,
                totalSavings: Math.round(totalSavings * 100) / 100
            };
        }

        updateSummary() {
            const totals = this.calculateTotals();

            document.getElementById('subtotal').textContent = `$${totals.subtotal.toFixed(2)}`;
            document.getElementById('shipping').textContent = totals.shipping === 0 ? 'FREE' : `$${totals.shipping.toFixed(2)}`;
            document.getElementById('tax').textContent = `$${totals.tax.toFixed(2)}`;
            document.getElementById('total').textContent = `$${totals.total.toFixed(2)}`;

            const discountContainer = document.getElementById('discount-container');
            const savingsContainer = document.getElementById('savings-container');

            if (totals.discount > 0) {
                document.getElementById('discount').textContent = `-$${totals.discount.toFixed(2)}`;
                discountContainer.classList.remove('d-none');
            } else {
                discountContainer.classList.add('d-none');
            }

            if (totals.totalSavings > 0) {
                document.getElementById('savings').textContent = `$${totals.totalSavings.toFixed(2)}`;
                savingsContainer.classList.remove('d-none');
            } else {
                savingsContainer.classList.add('d-none');
            }

            // Update cart count
            this.updateCartCount();
        }

        renderCart() {
            const container = document.getElementById('cart-items-container');

            if (this.cart.length === 0) {
                container.innerHTML = `
                        <div class="empty-cart">
                            <div class="empty-cart-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h3 class="mb-3">Your cart is empty</h3>
                            <p class="text-muted mb-4">Looks like you haven't added any items to your cart yet.</p>
                            <button class="btn btn-primary btn-lg" id="start-shopping">
                                <i class="fas fa-shopping-bag me-2"></i> Start Shopping
                            </button>
                        </div>
                    `;
                document.getElementById('start-shopping')?.addEventListener('click', () => {
                    this.showToast('Check out our products below!');
                });
                return;
            }

            let html = '';
            this.cart.forEach(item => {
                const product = this.getProductById(item.productId);
                const itemTotal = item.price * item.quantity;
                const originalTotal = product?.originalPrice ? product.originalPrice * item.quantity : null;

                html += `
                        <div class="card cart-item">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-2 col-3">
                                        <img src="${item.image}" alt="${item.name}" class="img-fluid product-image">
                                    </div>
                                    <div class="col-md-4 col-9">
                                        <h5 class="mb-1">${item.name}</h5>
                                        <p class="text-muted small mb-2">${product?.description || 'Premium quality product'}</p>
                                        <div class="d-flex gap-2">
                                            ${item.color ? `<span class="badge bg-light text-dark">${item.color}</span>` : ''}
                                            ${item.size ? `<span class="badge bg-light text-dark">Size: ${item.size}</span>` : ''}
                                        </div>
                                        ${product?.rating ? `
                                            <div class="mt-2">
                                                <small class="text-warning">
                                                    ${'★'.repeat(Math.floor(product.rating))}${'☆'.repeat(5-Math.floor(product.rating))}
                                                </small>
                                                <small class="text-muted ms-1">${product.rating}</small>
                                            </div>
                                        ` : ''}
                                    </div>
                                    <div class="col-md-3 col-6 mt-3 mt-md-0">
                                        <div class="d-flex align-items-center justify-content-md-center">
                                            <div class="quantity-controls">
                                                <button class="quantity-btn minus-btn" data-id="${item.id}">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="number" class="quantity-input" value="${item.quantity}" min="1" max="${product?.stock || 10}" data-id="${item.id}">
                                                <button class="quantity-btn plus-btn" data-id="${item.id}">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <small class="text-muted d-block text-center mt-2">
                                            ${product?.stock || 10} in stock
                                        </small>
                                    </div>
                                    <div class="col-md-2 col-4 mt-3 mt-md-0 text-end">
                                        <div class="h5 mb-1">$${itemTotal.toFixed(2)}</div>
                                        ${originalTotal ? `
                                            <div class="text-muted text-decoration-line-through small">
                                                $${originalTotal.toFixed(2)}
                                            </div>
                                            <span class="badge-discount">
                                                Save $${(originalTotal - itemTotal).toFixed(2)}
                                            </span>
                                        ` : `
                                            <div class="text-muted small">$${item.price.toFixed(2)} each</div>
                                        `}
                                    </div>
                                    <div class="col-md-1 col-2 mt-3 mt-md-0 text-end">
                                        <button class="btn btn-link text-danger cart-item-actions remove-btn" data-id="${item.id}" title="Remove">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
            });

            container.innerHTML = html;
            this.setupCartItemListeners();
        }

        renderRelatedProducts() {
            const container = document.getElementById('related-products');
            const products = this.getRelatedProducts();

            let html = '';
            products.forEach(product => {
                html += `
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm product-card">
                                <img src="${product.image}" class="card-img-top" alt="${product.name}" style="height: 150px; object-fit: cover;">
                                <div class="card-body">
                                    <h6 class="card-title">${product.name}</h6>
                                    <p class="card-text small text-muted">${product.description}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="h6 mb-0">$${product.price.toFixed(2)}</span>
                                        <button class="btn btn-sm btn-outline-primary add-related-btn" data-id="${product.id}">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
            });

            container.innerHTML = html;

            // Add event listeners to related product buttons
            document.querySelectorAll('.add-related-btn').forEach(button => {
                button.addEventListener('click', (e) => {
                    const productId = parseInt(e.target.closest('.add-related-btn').dataset.id);
                    this.addToCart(productId);
                });
            });
        }

        setupBreadcrumbListeners() {
            // Home link
            document.querySelector('.breadcrumb-item a[href="#"]').addEventListener('click', (e) => {
                e.preventDefault();
                this.showToast('Navigating to Home', 'info');
            });

            // Shop link
            document.querySelectorAll('.breadcrumb-item a[href="#"]')[1].addEventListener('click', (e) => {
                e.preventDefault();
                this.showToast('Navigating to Shop', 'info');
            });

            // Products link
            document.querySelectorAll('.breadcrumb-item a[href="#"]')[2].addEventListener('click', (e) => {
                e.preventDefault();
                this.showToast('Navigating to Products', 'info');
            });

            // Mobile back button
            document.querySelector('.breadcrumb-back')?.addEventListener('click', (e) => {
                e.preventDefault();
                this.showToast('Going back to shop', 'info');
            });
        }

        setupCartItemListeners() {
            // Quantity minus buttons
            document.querySelectorAll('.minus-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const itemId = parseInt(e.target.closest('.minus-btn').dataset.id);
                    const input = e.target.closest('.quantity-controls').querySelector('.quantity-input');
                    const newQuantity = parseInt(input.value) - 1;
                    this.updateQuantity(itemId, newQuantity);
                });
            });

            // Quantity plus buttons
            document.querySelectorAll('.plus-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const itemId = parseInt(e.target.closest('.plus-btn').dataset.id);
                    const input = e.target.closest('.quantity-controls').querySelector('.quantity-input');
                    const newQuantity = parseInt(input.value) + 1;
                    this.updateQuantity(itemId, newQuantity);
                });
            });

            // Quantity input changes
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', (e) => {
                    const itemId = parseInt(e.target.dataset.id);
                    const newQuantity = parseInt(e.target.value);
                    if (!isNaN(newQuantity)) {
                        this.updateQuantity(itemId, newQuantity);
                    }
                });
            });

            // Remove buttons
            document.querySelectorAll('.remove-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const itemId = parseInt(e.target.closest('.remove-btn').dataset.id);
                    this.removeFromCart(itemId);
                });
            });
        }

        setupEventListeners() {
            // Clear cart button
            document.getElementById('clear-cart')?.addEventListener('click', () => {
                this.clearCart();
            });

            // Update cart button
            document.getElementById('update-cart')?.addEventListener('click', () => {
                this.showToast('Cart updated successfully');
            });

            // Apply promo code
            document.getElementById('apply-promo')?.addEventListener('click', () => {
                const promoCode = document.getElementById('promo-code').value.trim();
                if (promoCode) {
                    this.applyPromoCode(promoCode);
                }
            });

            // Enter key for promo code
            document.getElementById('promo-code')?.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const promoCode = document.getElementById('promo-code').value.trim();
                    if (promoCode) {
                        this.applyPromoCode(promoCode);
                    }
                }
            });

            // Checkout button
            document.getElementById('checkout-btn')?.addEventListener('click', () => {
                if (this.cart.length === 0) {
                    this.showToast('Your cart is empty', 'warning');
                    return;
                }

                const totals = this.calculateTotals();
                alert(`Proceeding to checkout!\n\nTotal: $${totals.total.toFixed(2)}\n\nThis is a demo. In a real app, you would be redirected to payment.`);
                this.showToast('Proceeding to checkout...', 'info');
            });

            // Continue shopping
            document.getElementById('continue-shopping')?.addEventListener('click', (e) => {
                e.preventDefault();
                this.showToast('Continue browsing our products!', 'info');
                document.getElementById('related-products').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        }

        showToast(message, type = 'success') {
            const toastEl = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');

            // Remove existing classes
            toastEl.classList.remove('text-bg-success', 'text-bg-warning', 'text-bg-info', 'text-bg-danger');

            // Add new class based on type
            switch (type) {
                case 'warning':
                    toastEl.classList.add('text-bg-warning');
                    break;
                case 'info':
                    toastEl.classList.add('text-bg-info');
                    break;
                case 'danger':
                    toastEl.classList.add('text-bg-danger');
                    break;
                default:
                    toastEl.classList.add('text-bg-success');
            }

            toastMessage.textContent = message;

            // Show toast
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    }

    // Initialize cart when page loads
    document.addEventListener('DOMContentLoaded', () => {
        window.cartManager = new CartManager();

        // Load any previously applied promo code
        const savedPromo = localStorage.getItem('applied_promo');
        if (savedPromo) {
            const promo = JSON.parse(savedPromo);
            document.getElementById('promo-code').value = promo.code;
            cartManager.applyPromoCode(promo.code);
        }
    });
</script>
@endsection