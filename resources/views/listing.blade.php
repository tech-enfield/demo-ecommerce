@extends('layouts.app')
@section('content')
    <section class="breadcrumb-section">
        <div class="container-fluid">
            <div class="breadcrumb-content">
                <!-- LEFT SIDE TEXT -->
                <div class="breadcrumb-left">
                    <h1 id="breadcrumbTitle">Products</h1>
                    <ul class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li id="breadcrumbCategory">Products</li>
                    </ul>

                </div>

                <!-- RIGHT SIDE IMAGE -->
                <div class="breadcrumb-right">
                    <img src="{{ asset('assets/img/aaa.png') }}" alt="Laptop Banner">
                </div>
            </div>
        </div>
    </section>

    <section class="products-page">
        <div class="container-fluid">
            <div class="products-wrapper">
                <aside class="sidebar" id="laptopFilters">
                    <!-- Price Filter -->
                    <div class="filter-box">
                        <h4 class="filter-title">Price <span class="reset-price">Reset</span></h4>
                        <div class="price-filter">
                            <input type="range" min="20000" max="200000" value="50000" id="priceSlider">
                            <div class="price-inputs">
                                <input type="number" id="minPrice" value="20000">
                                <span>—</span>
                                <input type="number" id="maxPrice" value="200000">
                                <button class="theme-btn" id="applyPriceFilter">Apply</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- Laptop Type -->
                    <div class="filter-box">
                        <h4 class="filter-title">Laptop Type <span class="clear-filter">Clear</span></h4>
                        <ul class="filter-list">
                            <li><input type="checkbox" class="filter-checkbox" data-filter="type" value="gaming"> Gaming
                            </li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="type" value="student"> Student
                            </li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="type" value="business"> Business
                            </li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="type" value="ultrabook">
                                Ultrabook</li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="type" value="editing"> Editing /
                                Creative</li>
                        </ul>
                    </div>
                    <hr>
                    <!-- Processor Series -->
                    <div class="filter-box">
                        <h4 class="filter-title">Processor Series <span class="clear-filter">Clear</span></h4>
                        <ul class="filter-list">
                            <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series"
                                    value="i3"> Intel Core i3</li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series"
                                    value="i5"> Intel Core i5</li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series"
                                    value="i7"> Intel Core i7</li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series"
                                    value="i9"> Intel Core i9</li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series"
                                    value="ryzen3"> AMD Ryzen 3</li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series"
                                    value="ryzen5"> AMD Ryzen 5</li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series"
                                    value="ryzen7"> AMD Ryzen 7</li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series"
                                    value="ryzen9"> AMD Ryzen 9</li>
                        </ul>
                    </div>
                    <hr>
                    <!-- Display Size -->
                    <div class="filter-box">
                        <h4 class="filter-title">Display Size <span class="clear-filter">Clear</span></h4>
                        <ul class="filter-list">
                            <li><input type="checkbox" class="filter-checkbox" data-filter="display" value="13.3"> 13.3"
                            </li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="display" value="14"> 14"
                            </li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="display" value="15.6">
                                15.6"</li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="display" value="16"> 16"
                            </li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="display" value="17"> 17"
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <!-- SSD Storage -->
                    <div class="filter-box">
                        <h4 class="filter-title">SSD <span class="clear-filter">Clear</span></h4>
                        <ul class="filter-list">
                            <li><input type="checkbox" class="filter-checkbox" data-filter="ssd" value="256"> 256GB
                                SSD</li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="ssd" value="512"> 512GB
                                SSD</li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="ssd" value="1024"> 1TB SSD
                            </li>
                            <li><input type="checkbox" class="filter-checkbox" data-filter="ssd" value="2048"> 2TB SSD
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <!-- Clear All Filters Button -->
                    <button class="red-theme-btn" id="clearAllFilters" style="width: 100%; margin-top: 10px;">Clear All
                        Filters</button>
                </aside>

                <main class="products-content pb-50">
                    <!-- Shopping Cart & Wishlist Summary -->
                    <div class="cart-summary-bar" id="cartSummaryBar" style="display: none;">
                        <div class="cart-info">
                            <i class="fas fa-shopping-cart"></i>
                            <span id="cartCount">0</span> items in cart • ₹<span id="cartTotal">0</span>
                            <a href="/cart" class="view-cart-btn">View Cart</a>
                        </div>
                        <div class="wishlist-info">
                            <i class="fas fa-heart"></i>
                            <span id="wishlistCount">0</span> items in wishlist
                        </div>
                    </div>

                    <!-- Sorting & View Options -->
                    <div class="top-bar">
                        <h2>Laptops <span id="productCount"></span></h2>
                        <div class="sort-view">
                            <div class="view-options">
                                <button class="view-grid active" title="Grid View">
                                    <i class="fas fa-th"></i>
                                </button>
                                <button class="view-list" title="List View">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                            <select id="sortSelect">
                                <option value="" {{ request('sort') == null ? 'selected' : '' }}>Sort by: Featured
                                </option>
                                <option value="price-low-to-high"
                                    {{ request('sort') == 'price-low-to-high' ? 'selected' : '' }}>Price (Low to High)
                                </option>
                                <option value="price-high-to-low"
                                    {{ request('sort') == 'price-high-to-low' ? 'selected' : '' }}>Price (High to Low)
                                </option>
                                <option value="new-arrivals" {{ request('sort') == 'new-arrivals' ? 'selected' : '' }}>
                                    Newest First</option>
                                <option value="best-rated" {{ request('sort') == 'best-rated' ? 'selected' : '' }}>Best
                                    Rated</option>
                            </select>
                        </div>
                    </div>

                    <!-- Product Grid -->
                    <div class="product-grid" id="">
                        @include('components.product-cards', ['products' => $products])
                    </div>

                    <!-- Pagination -->
                    <div class="pagination" id="pagination">
                        <!-- Pagination buttons will be generated dynamically -->
                    </div>
                </main>
            </div>
        </div>
    </section>



    <div id="notificationToast" class="notification-toast">
        <div class="notification-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="notification-content">
            <h4 id="notificationTitle">Product Added</h4>
            <p id="notificationMessage">Product has been added to your cart</p>
        </div>
        <button class="close-notification">&times;</button>
    </div>

    <script>
        document.getElementById('sortSelect').addEventListener('change', function() {
            let sort = this.value;
            if (!sort) return; // do nothing if default option

            // Redirect to the same URL with sort query
            let baseUrl = "{{ request()->url() }}"; // Laravel helper for current URL without query
            window.location.href = `${baseUrl}?sort=${sort}`;
        });
    </script>
    <script>
let loading = false;

$(window).on('scroll', function () {
    if (loading) return;

    let marker = $('.pagination-marker').last();
    if (!marker.length) return;

    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 300) {
        loading = true;

        let nextUrl = marker.data('next-page-url');
        if (!nextUrl) return;

        $.ajax({
            url: nextUrl,
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (data) {
                $('.pagination-marker').remove(); // remove old marker
                $('.product-grid').append(data);
                loading = false;
            },
            error: function () {
                loading = false;
            }
        });
    }
});
</script>

@endsection
