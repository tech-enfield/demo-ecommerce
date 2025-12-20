    <!-- Top nav -->
    <div class="top-nav">
        <div class="top-nav-left">
            <p>About Us</p>
            <p> | </p>
            <p>Privacy Policy</p>
        </div>
        <div class="top-nav-right">
            <p>Contact Us</p>
            <p> | </p>
            <p>Store Location</p>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <!-- logo -->
            <a class="" href="@if(!request()->url() === '/') {{ route('home') }} @endif">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="logo" />
            </a>
            <!-- Search Bar -->
            <div class="flex-grow-1 mx-4">
                <form class="search-bar d-flex align-items-center" id="searchForm">
                    <input type="text" class="search-input" placeholder="What you are looking for?" name="search"
                        id="searchInput">
                    <button type="submit" class="search-icon">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
            <!-- Cart & Account -->
            <div class="d-flex align-items-center gap-4">
                @guest
                    <button id="guestCartBtn" class="d-flex align-items-center nav-link-custom">
                        <i class="bi bi-cart3 fs-4 me-1"></i>
                        <span>My Cart</span>
                        <span id="guestCartCount"></span>
                    </button>
                    <a href="#" class="d-flex align-items-center nav-link-custom me-5">
                        <i class="bi bi-person-circle fs-4 me-1"></i>
                        <span>My Account</span>
                    </a>
                @else
                    <button id="userCartBtn" class="d-flex align-items-center nav-link-custom">
                        <i class="bi bi-cart3 fs-4 me-1"></i>
                        <span>My Cart</span>
                        <span id="userCartCount"></span>
                    </button>
                    <a href="#" class="d-flex align-items-center nav-link-custom me-5">
                        <i class="bi bi-person-circle fs-4 me-1"></i>
                        <span>{{ auth()->user()->name }}</span>
                    </a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Bottom nav -->
    <div class="bottom-nav">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="#">All categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Laptops</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Mobile Phones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Accessories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Desktops & PCs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Home & Office Solutions</a>
            </li>
        </ul>
    </div>
    <div id="test"></div>
    {{-- <div id="cartOverlap" style="display: none;">
        <aside>
            <!-- Cart Overlay -->
            <div id="cartOverlay" class="cart-overlay"></div>

            <!-- Cart Sidebar -->
            <div id="cartSidebar" class="cart-sidebar">
                <div class="cart-header">
                    <h5>Your Cart</h5>
                    <button id="closeCartBtn">✕</button>
                </div>

                <div class="cart-body" id="cartItems">
                    <p class="empty-cart">Your cart is empty</p>
                </div>

                <div class="cart-footer">
                    <a href="/cart" class="view-cart-btn">View Cart</a>
                </div>
            </div>
            <style>
                .cart-toggle-btn {
                    position: fixed;
                    top: 40%;
                    right: 0;
                    background: #111;
                    color: #fff;
                    border: none;
                    padding: 12px 15px;
                    cursor: pointer;
                    z-index: 1001;
                }

                .cart-toggle-btn span {
                    background: red;
                    padding: 2px 6px;
                    border-radius: 50%;
                    font-size: 12px;
                }

                .cart-overlay {
                    position: fixed;
                    inset: 0;
                    background: rgba(0, 0, 0, 0.4);
                    display: none;
                    z-index: 1000;
                }

                .cart-sidebar {
                    position: fixed;
                    top: 0;
                    right: -380px;
                    width: 360px;
                    height: 100%;
                    background: #fff;
                    z-index: 1002;
                    display: flex;
                    flex-direction: column;
                    transition: right 0.3s ease;
                }

                .cart-sidebar.active {
                    right: 0;
                }

                .cart-header {
                    padding: 15px;
                    border-bottom: 1px solid #eee;
                    display: flex;
                    justify-content: space-between;
                }

                .cart-body {
                    flex: 1;
                    padding: 15px;
                    overflow-y: auto;
                }

                .cart-item {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 12px;
                }

                .cart-footer {
                    padding: 15px;
                    border-top: 1px solid #eee;
                }

                .view-cart-btn {
                    display: block;
                    background: #111;
                    color: #fff;
                    text-align: center;
                    padding: 10px;
                    text-decoration: none;
                }
            </style>

        </aside>

    </div> --}}
    <script>
        $(document).ready(function() {
            // let form = $('#searchForm');
            $('#searchForm').on('submit', function(e) {
                e.preventDefault(); // ✅ Prevent the normal form submission

                let searchValue = $('#searchInput').val().trim(); // ✅ Grab value at submit time
                let url = `${encodeURIComponent(searchValue)}`;

                window.location.href = url; // ✅ Redirect to the proper URL
            });

            $('#guestCartBtn').on('click', function() {
                let cart = JSON.parse(localStorage.getItem('cart')) || [];

                if (cart.length === 0) {
                    console.log('Cart is empty');
                    return;
                }

                $.ajax({
                    url: '/getcarts',
                    method: 'POST', // use POST for data
                    data: {
                        ids: cart, // this becomes ids[]
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);

                        $('#cartOverlap').css('display', 'block');
                        $('#test').html(response);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
