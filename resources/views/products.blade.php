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
                        <li><input type="checkbox" class="filter-checkbox" data-filter="type" value="gaming"> Gaming</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="type" value="student"> Student</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="type" value="business"> Business</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="type" value="ultrabook"> Ultrabook</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="type" value="editing"> Editing / Creative</li>
                    </ul>
                </div>
                <hr>
                <!-- Processor Series -->
                <div class="filter-box">
                    <h4 class="filter-title">Processor Series <span class="clear-filter">Clear</span></h4>
                    <ul class="filter-list">
                        <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series" value="i3"> Intel Core i3</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series" value="i5"> Intel Core i5</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series" value="i7"> Intel Core i7</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series" value="i9"> Intel Core i9</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series" value="ryzen3"> AMD Ryzen 3</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series" value="ryzen5"> AMD Ryzen 5</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series" value="ryzen7"> AMD Ryzen 7</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="processor-series" value="ryzen9"> AMD Ryzen 9</li>
                    </ul>
                </div>
                <hr>
                <!-- Display Size -->
                <div class="filter-box">
                    <h4 class="filter-title">Display Size <span class="clear-filter">Clear</span></h4>
                    <ul class="filter-list">
                        <li><input type="checkbox" class="filter-checkbox" data-filter="display" value="13.3"> 13.3"</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="display" value="14"> 14"</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="display" value="15.6"> 15.6"</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="display" value="16"> 16"</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="display" value="17"> 17"</li>
                    </ul>
                </div>
                <hr>
                <!-- SSD Storage -->
                <div class="filter-box">
                    <h4 class="filter-title">SSD <span class="clear-filter">Clear</span></h4>
                    <ul class="filter-list">
                        <li><input type="checkbox" class="filter-checkbox" data-filter="ssd" value="256"> 256GB SSD</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="ssd" value="512"> 512GB SSD</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="ssd" value="1024"> 1TB SSD</li>
                        <li><input type="checkbox" class="filter-checkbox" data-filter="ssd" value="2048"> 2TB SSD</li>
                    </ul>
                </div>
                <hr>
                <!-- Clear All Filters Button -->
                <button class="red-theme-btn" id="clearAllFilters" style="width: 100%; margin-top: 10px;">Clear All Filters</button>
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
                    <h2>Laptops <span id="productCount">(36 products)</span></h2>
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
                            <option value="default">Sort by: Featured</option>
                            <option value="price-low">Price (Low to High)</option>
                            <option value="price-high">Price (High to Low)</option>
                            <option value="newest">Newest First</option>
                            <option value="rating">Best Rated</option>
                        </select>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="product-grid" id="productGrid">
                    <!-- Product cards will be generated dynamically -->
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
    // Product Data - 36 Products (3 pages of 12 each)
    const products = [
        // Page 1 Products
        {
            id: 1,
            name: "HP Pavilion 15",
            category: "laptop",
            description: "HP Pavilion 15 | Ryzen 5 5600H | 16GB RAM | 512GB SSD",
            price: 78000,
            image: "https://images.unsplash.com/photo-1603302576837-37561b2e2302?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["Ryzen 5", "16GB RAM", "512GB SSD", "15.6\" Display"],
            type: "student",
            processor: "ryzen5",
            display: 15.6,
            ssd: 512,
            rating: 4.2
        },
        {
            id: 2,
            name: "Dell G15 Gaming",
            category: "laptop",
            description: "Dell G15 Gaming | i7-12700H | RTX 3050 | 16GB RAM | 1TB SSD",
            price: 125000,
            image: "https://images.unsplash.com/photo-1602080858428-57174f9431cf?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i7 12th Gen", "RTX 3050", "16GB RAM", "1TB SSD", "15.6\" Display"],
            type: "gaming",
            processor: "i7",
            display: 15.6,
            ssd: 1024,
            rating: 4.5
        },
        {
            id: 3,
            name: "MacBook Air M2",
            category: "laptop",
            description: "Apple MacBook Air M2 | 8GB RAM | 256GB SSD | 13.6\" Retina",
            price: 115000,
            image: "https://images.unsplash.com/photo-1517336714731-489689fd1ca8?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["Apple M2", "8GB RAM", "256GB SSD", "13.6\" Retina"],
            type: "ultrabook",
            processor: "apple",
            display: 13.6,
            ssd: 256,
            rating: 4.7
        },
        {
            id: 4,
            name: "Lenovo ThinkPad X1",
            category: "laptop",
            description: "Lenovo ThinkPad X1 Carbon | i7-1260P | 16GB RAM | 1TB SSD",
            price: 155000,
            image: "https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i7 12th Gen", "16GB RAM", "1TB SSD", "14\" Display", "Fingerprint"],
            type: "business",
            processor: "i7",
            display: 14,
            ssd: 1024,
            rating: 4.4
        },
        {
            id: 5,
            name: "ASUS ROG Strix G17",
            category: "laptop",
            description: "ASUS ROG Strix G17 | Ryzen 7 6800H | RTX 3060 | 16GB RAM",
            price: 145000,
            image: "https://images.unsplash.com/photo-1593640408182-31c70c8268f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["Ryzen 7", "RTX 3060", "16GB RAM", "1TB SSD", "17.3\" Display"],
            type: "gaming",
            processor: "ryzen7",
            display: 17.3,
            ssd: 1024,
            rating: 4.6
        },
        {
            id: 6,
            name: "Acer Swift 3",
            category: "laptop",
            description: "Acer Swift 3 | i5-1240P | 8GB RAM | 512GB SSD | 14\" Display",
            price: 65000,
            image: "https://images.unsplash.com/photo-1541807084-5c52b6b3adef?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i5 12th Gen", "8GB RAM", "512GB SSD", "14\" Display"],
            type: "student",
            processor: "i5",
            display: 14,
            ssd: 512,
            rating: 4.0
        },
        {
            id: 7,
            name: "MSI Creator Z16",
            category: "laptop",
            description: "MSI Creator Z16 | i9-12900H | RTX 3060 | 32GB RAM | 2TB SSD",
            price: 235000,
            image: "https://images.unsplash.com/photo-1491933382434-500287f9b54b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i9 12th Gen", "RTX 3060", "32GB RAM", "2TB SSD", "16\" Display"],
            type: "editing",
            processor: "i9",
            display: 16,
            ssd: 2048,
            rating: 4.8
        },
        {
            id: 8,
            name: "HP Victus 16",
            category: "laptop",
            description: "HP Victus 16 | Ryzen 5 5600H | RTX 3050 | 8GB RAM | 512GB SSD",
            price: 85000,
            image: "https://images.unsplash.com/photo-1603302576837-37561b2e2302?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["Ryzen 5", "RTX 3050", "8GB RAM", "512GB SSD", "16.1\" Display"],
            type: "gaming",
            processor: "ryzen5",
            display: 16.1,
            ssd: 512,
            rating: 4.3
        },
        {
            id: 9,
            name: "Dell XPS 13",
            category: "laptop",
            description: "Dell XPS 13 | i7-1250U | 16GB RAM | 1TB SSD | 13.4\" OLED",
            price: 165000,
            image: "https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i7 12th Gen", "16GB RAM", "1TB SSD", "13.4\" OLED"],
            type: "ultrabook",
            processor: "i7",
            display: 13.4,
            ssd: 1024,
            rating: 4.7
        },
        {
            id: 10,
            name: "Lenovo Legion 5",
            category: "laptop",
            description: "Lenovo Legion 5 | Ryzen 7 5800H | RTX 3060 | 16GB RAM | 1TB SSD",
            price: 135000,
            image: "https://images.unsplash.com/photo-1593640408182-31c70c8268f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["Ryzen 7", "RTX 3060", "16GB RAM", "1TB SSD", "15.6\" Display"],
            type: "gaming",
            processor: "ryzen7",
            display: 15.6,
            ssd: 1024,
            rating: 4.5
        },
        {
            id: 11,
            name: "ASUS ZenBook 14",
            category: "laptop",
            description: "ASUS ZenBook 14 | i5-1235U | 8GB RAM | 512GB SSD | 14\" OLED",
            price: 75000,
            image: "https://images.unsplash.com/photo-1491933382434-500287f9b54b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i5 12th Gen", "8GB RAM", "512GB SSD", "14\" OLED"],
            type: "ultrabook",
            processor: "i5",
            display: 14,
            ssd: 512,
            rating: 4.2
        },
        {
            id: 12,
            name: "Acer Predator Helios",
            category: "laptop",
            description: "Acer Predator Helios 300 | i7-12700H | RTX 3070 Ti | 16GB RAM",
            price: 175000,
            image: "https://images.unsplash.com/photo-1593640408182-31c70c8268f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i7 12th Gen", "RTX 3070 Ti", "16GB RAM", "1TB SSD", "15.6\" Display"],
            type: "gaming",
            processor: "i7",
            display: 15.6,
            ssd: 1024,
            rating: 4.6
        },
        // Page 2 Products
        {
            id: 13,
            name: "HP Omen 16",
            category: "laptop",
            description: "HP Omen 16 | i9-13900HX | RTX 4070 | 32GB RAM | 2TB SSD",
            price: 225000,
            image: "https://images.unsplash.com/photo-1603302576837-37561b2e2302?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i9 13th Gen", "RTX 4070", "32GB RAM", "2TB SSD", "16.1\" QHD"],
            type: "gaming",
            processor: "i9",
            display: 16.1,
            ssd: 2048,
            rating: 4.8
        },
        {
            id: 14,
            name: "Lenovo Yoga 9i",
            category: "laptop",
            description: "Lenovo Yoga 9i | i7-1360P | 16GB RAM | 1TB SSD | 14\" 4K",
            price: 185000,
            image: "https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i7 13th Gen", "16GB RAM", "1TB SSD", "14\" 4K", "2-in-1"],
            type: "ultrabook",
            processor: "i7",
            display: 14,
            ssd: 1024,
            rating: 4.6
        },
        {
            id: 15,
            name: "ASUS TUF F15",
            category: "laptop",
            description: "ASUS TUF F15 | i5-12500H | RTX 3050 | 16GB RAM | 512GB SSD",
            price: 95000,
            image: "https://images.unsplash.com/photo-1593640408182-31c70c8268f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i5 12th Gen", "RTX 3050", "16GB RAM", "512GB SSD", "15.6\" FHD"],
            type: "gaming",
            processor: "i5",
            display: 15.6,
            ssd: 512,
            rating: 4.3
        },
        {
            id: 16,
            name: "Dell Inspiron 14",
            category: "laptop",
            description: "Dell Inspiron 14 | Ryzen 7 5825U | 16GB RAM | 512GB SSD",
            price: 72000,
            image: "https://images.unsplash.com/photo-1602080858428-57174f9431cf?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["Ryzen 7", "16GB RAM", "512GB SSD", "14\" Display"],
            type: "student",
            processor: "ryzen7",
            display: 14,
            ssd: 512,
            rating: 4.1
        },
        {
            id: 17,
            name: "MSI Katana GF66",
            category: "laptop",
            description: "MSI Katana GF66 | i7-12650H | RTX 4060 | 16GB RAM | 1TB SSD",
            price: 145000,
            image: "https://images.unsplash.com/photo-1491933382434-500287f9b54b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i7 12th Gen", "RTX 4060", "16GB RAM", "1TB SSD", "15.6\" FHD"],
            type: "gaming",
            processor: "i7",
            display: 15.6,
            ssd: 1024,
            rating: 4.5
        },
        {
            id: 18,
            name: "Acer Nitro 5",
            category: "laptop",
            description: "Acer Nitro 5 | Ryzen 7 6800H | RTX 3060 | 16GB RAM | 1TB SSD",
            price: 125000,
            image: "https://images.unsplash.com/photo-1541807084-5c52b6b3adef?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["Ryzen 7", "RTX 3060", "16GB RAM", "1TB SSD", "15.6\" FHD"],
            type: "gaming",
            processor: "ryzen7",
            display: 15.6,
            ssd: 1024,
            rating: 4.4
        },
        {
            id: 19,
            name: "MacBook Pro 16",
            category: "laptop",
            description: "Apple MacBook Pro 16 | M2 Pro | 16GB RAM | 512GB SSD",
            price: 245000,
            image: "https://images.unsplash.com/photo-1517336714731-489689fd1ca8?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["Apple M2 Pro", "16GB RAM", "512GB SSD", "16.2\" Liquid Retina"],
            type: "editing",
            processor: "apple",
            display: 16.2,
            ssd: 512,
            rating: 4.9
        },
        {
            id: 20,
            name: "Lenovo IdeaPad 3",
            category: "laptop",
            description: "Lenovo IdeaPad 3 | Ryzen 5 5500U | 8GB RAM | 256GB SSD",
            price: 45000,
            image: "https://images.unsplash.com/photo-1593640408182-31c70c8268f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["Ryzen 5", "8GB RAM", "256GB SSD", "15.6\" Display"],
            type: "student",
            processor: "ryzen5",
            display: 15.6,
            ssd: 256,
            rating: 3.9
        },
        {
            id: 21,
            name: "ASUS Vivobook 16",
            category: "laptop",
            description: "ASUS Vivobook 16 | i5-1240P | 8GB RAM | 512GB SSD",
            price: 58000,
            image: "https://images.unsplash.com/photo-1491933382434-500287f9b54b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i5 12th Gen", "8GB RAM", "512GB SSD", "16\" Display"],
            type: "student",
            processor: "i5",
            display: 16,
            ssd: 512,
            rating: 4.0
        },
        {
            id: 22,
            name: "HP EliteBook 840",
            category: "laptop",
            description: "HP EliteBook 840 | i7-1355U | 16GB RAM | 1TB SSD",
            price: 135000,
            image: "https://images.unsplash.com/photo-1603302576837-37561b2e2302?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i7 13th Gen", "16GB RAM", "1TB SSD", "14\" Display", "Fingerprint"],
            type: "business",
            processor: "i7",
            display: 14,
            ssd: 1024,
            rating: 4.5
        },
        {
            id: 23,
            name: "MSI Stealth 14",
            category: "laptop",
            description: "MSI Stealth 14 | i7-13620H | RTX 4060 | 16GB RAM | 1TB SSD",
            price: 175000,
            image: "https://images.unsplash.com/photo-1491933382434-500287f9b54b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i7 13th Gen", "RTX 4060", "16GB RAM", "1TB SSD", "14\" QHD"],
            type: "gaming",
            processor: "i7",
            display: 14,
            ssd: 1024,
            rating: 4.6
        },
        {
            id: 24,
            name: "Dell Alienware m16",
            category: "laptop",
            description: "Dell Alienware m16 | i9-13900HX | RTX 4080 | 32GB RAM | 2TB SSD",
            price: 325000,
            image: "https://images.unsplash.com/photo-1602080858428-57174f9431cf?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i9 13th Gen", "RTX 4080", "32GB RAM", "2TB SSD", "16\" QHD"],
            type: "gaming",
            processor: "i9",
            display: 16,
            ssd: 2048,
            rating: 4.9
        },
        // Page 3 Products
        {
            id: 25,
            name: "Lenovo ThinkBook 14",
            category: "laptop",
            description: "Lenovo ThinkBook 14 | i5-1335U | 16GB RAM | 512GB SSD",
            price: 75000,
            image: "https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i5 13th Gen", "16GB RAM", "512GB SSD", "14\" Display"],
            type: "business",
            processor: "i5",
            display: 14,
            ssd: 512,
            rating: 4.3
        },
        {
            id: 26,
            name: "ASUS ROG Zephyrus G14",
            category: "laptop",
            description: "ASUS ROG Zephyrus G14 | Ryzen 9 7940HS | RTX 4060 | 16GB RAM",
            price: 185000,
            image: "https://images.unsplash.com/photo-1593640408182-31c70c8268f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["Ryzen 9", "RTX 4060", "16GB RAM", "1TB SSD", "14\" QHD"],
            type: "gaming",
            processor: "ryzen9",
            display: 14,
            ssd: 1024,
            rating: 4.7
        },
        {
            id: 27,
            name: "Acer Chromebook Spin",
            category: "laptop",
            description: "Acer Chromebook Spin 713 | i5-1235U | 8GB RAM | 256GB SSD",
            price: 55000,
            image: "https://images.unsplash.com/photo-1541807084-5c52b6b3adef?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i5 12th Gen", "8GB RAM", "256GB SSD", "13.5\" 2K", "Chrome OS"],
            type: "student",
            processor: "i5",
            display: 13.5,
            ssd: 256,
            rating: 4.1
        },
        {
            id: 28,
            name: "HP Spectre x360",
            category: "laptop",
            description: "HP Spectre x360 | i7-1355U | 16GB RAM | 1TB SSD | 13.5\" OLED",
            price: 165000,
            image: "https://images.unsplash.com/photo-1603302576837-37561b2e2302?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i7 13th Gen", "16GB RAM", "1TB SSD", "13.5\" OLED", "2-in-1"],
            type: "ultrabook",
            processor: "i7",
            display: 13.5,
            ssd: 1024,
            rating: 4.6
        },
        {
            id: 29,
            name: "MSI Prestige 14",
            category: "laptop",
            description: "MSI Prestige 14 | i7-1360P | 16GB RAM | 1TB SSD | 14\" 4K",
            price: 145000,
            image: "https://images.unsplash.com/photo-1491933382434-500287f9b54b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i7 13th Gen", "16GB RAM", "1TB SSD", "14\" 4K", "Content Creation"],
            type: "editing",
            processor: "i7",
            display: 14,
            ssd: 1024,
            rating: 4.5
        },
        {
            id: 30,
            name: "Dell Latitude 5440",
            category: "laptop",
            description: "Dell Latitude 5440 | i5-1345U | 16GB RAM | 512GB SSD",
            price: 85000,
            image: "https://images.unsplash.com/photo-1602080858428-57174f9431cf?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i5 13th Gen", "16GB RAM", "512GB SSD", "14\" Display", "Business"],
            type: "business",
            processor: "i5",
            display: 14,
            ssd: 512,
            rating: 4.3
        },
        {
            id: 31,
            name: "ASUS ExpertBook B9",
            category: "laptop",
            description: "ASUS ExpertBook B9 | i7-1365U | 32GB RAM | 2TB SSD",
            price: 195000,
            image: "https://images.unsplash.com/photo-1491933382434-500287f9b54b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i7 13th Gen", "32GB RAM", "2TB SSD", "14\" Display", "Ultra-light"],
            type: "business",
            processor: "i7",
            display: 14,
            ssd: 2048,
            rating: 4.7
        },
        {
            id: 32,
            name: "Lenovo Legion Slim 7",
            category: "laptop",
            description: "Lenovo Legion Slim 7 | Ryzen 9 7940HS | RTX 4070 | 32GB RAM",
            price: 215000,
            image: "https://images.unsplash.com/photo-1593640408182-31c70c8268f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["Ryzen 9", "RTX 4070", "32GB RAM", "2TB SSD", "16\" WQXGA"],
            type: "gaming",
            processor: "ryzen9",
            display: 16,
            ssd: 2048,
            rating: 4.8
        },
        {
            id: 33,
            name: "Acer ConceptD 7",
            category: "laptop",
            description: "Acer ConceptD 7 | i9-13900H | RTX 4080 | 64GB RAM | 4TB SSD",
            price: 385000,
            image: "https://images.unsplash.com/photo-1541807084-5c52b6b3adef?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i9 13th Gen", "RTX 4080", "64GB RAM", "4TB SSD", "16\" 4K"],
            type: "editing",
            processor: "i9",
            display: 16,
            ssd: 4096,
            rating: 4.9
        },
        {
            id: 34,
            name: "HP Envy 17",
            category: "laptop",
            description: "HP Envy 17 | i7-1360P | 32GB RAM | 2TB SSD | 17.3\" 4K",
            price: 185000,
            image: "https://images.unsplash.com/photo-1603302576837-37561b2e2302?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i7 13th Gen", "32GB RAM", "2TB SSD", "17.3\" 4K", "Creative Work"],
            type: "editing",
            processor: "i7",
            display: 17.3,
            ssd: 2048,
            rating: 4.6
        },
        {
            id: 35,
            name: "MSI Cyborg 15",
            category: "laptop",
            description: "MSI Cyborg 15 | i7-13620H | RTX 4050 | 16GB RAM | 1TB SSD",
            price: 125000,
            image: "https://images.unsplash.com/photo-1491933382434-500287f9b54b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i7 13th Gen", "RTX 4050", "16GB RAM", "1TB SSD", "15.6\" FHD"],
            type: "gaming",
            processor: "i7",
            display: 15.6,
            ssd: 1024,
            rating: 4.4
        },
        {
            id: 36,
            name: "ASUS ProArt StudioBook",
            category: "laptop",
            description: "ASUS ProArt StudioBook 16 | i913900H | RTX 4070 | 64GB RAM",
            price: 295000,
            image: "https://images.unsplash.com/photo-1491933382434-500287f9b54b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
            specs: ["i9 13th Gen", "RTX 4070", "64GB RAM", "4TB SSD", "16\" OLED"],
            type: "editing",
            processor: "i9",
            display: 16,
            ssd: 4096,
            rating: 4.9
        }
    ];

    // ===== CATEGORY HANDLING =====
    const urlParams = new URLSearchParams(window.location.search);
    const activeCategory = urlParams.get('category') || 'laptop';

    const categoryMap = {
        laptop: "Laptops",
        pc: "Desktop PCs",
        printer: "Printers",
        accessory: "Accessories"
    };

    // Update breadcrumb & heading
    document.getElementById('breadcrumbTitle').textContent = categoryMap[activeCategory];
    document.getElementById('breadcrumbCategory').textContent = categoryMap[activeCategory];
    document.querySelector('.top-bar h2').innerHTML =
        `${categoryMap[activeCategory]} <span id="productCount"></span>`;

    // Hide laptop filters for non-laptop
    if (activeCategory !== 'laptop') {
        document.getElementById('laptopFilters').style.display = 'none';
    }


    // Shopping Cart & Wishlist State
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

    // DOM Elements
    const productGrid = document.getElementById('productGrid');
    const viewGridBtn = document.querySelector('.view-grid');
    const viewListBtn = document.querySelector('.view-list');
    const sortSelect = document.getElementById('sortSelect');
    const priceSlider = document.getElementById('priceSlider');
    const minPriceInput = document.getElementById('minPrice');
    const maxPriceInput = document.getElementById('maxPrice');
    const applyPriceFilterBtn = document.getElementById('applyPriceFilter');
    const clearAllFiltersBtn = document.getElementById('clearAllFilters');
    const productCount = document.getElementById('productCount');
    const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
    const resetPriceBtn = document.querySelector('.reset-price');
    const clearFilterBtns = document.querySelectorAll('.clear-filter');
    const paginationContainer = document.getElementById('pagination');
    const cartSummaryBar = document.getElementById('cartSummaryBar');
    const cartCountElement = document.getElementById('cartCount');
    const cartTotalElement = document.getElementById('cartTotal');
    const wishlistCountElement = document.getElementById('wishlistCount');
    const notificationToast = document.getElementById('notificationToast');
    const notificationTitle = document.getElementById('notificationTitle');
    const notificationMessage = document.getElementById('notificationMessage');
    const closeNotificationBtn = document.querySelector('.close-notification');

    // Pagination Variables
    const productsPerPage = 12;
    let currentPage = 1;
    let filteredProducts = products.filter(
        product => product.category === activeCategory
    );

    let currentView = 'grid';
    const initialMinPrice = 20000;
    const initialMaxPrice = 200000;
    const initialSliderValue = 50000;

    // Function to scroll to top of products section
    function scrollToProductsTop() {
        const productsSection = document.querySelector('.products-page');
        if (productsSection) {
            productsSection.scrollIntoView({
                behavior: 'smooth'
            });
        }
    }

    // Update cart and wishlist summary
    function updateCartSummary() {
        const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
        const cartTotal = cart.reduce((total, item) => total + (item.price * item.quantity), 0);

        cartCountElement.textContent = cartCount;
        cartTotalElement.textContent = cartTotal.toLocaleString();
        wishlistCountElement.textContent = wishlist.length;

        // Show/hide cart summary bar
        if (cartCount > 0 || wishlist.length > 0) {
            cartSummaryBar.style.display = 'flex';
        } else {
            cartSummaryBar.style.display = 'none';
        }

        // Save to localStorage
        localStorage.setItem('cart', JSON.stringify(cart));
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
    }

    // Show notification
    function showNotification(type, title, message) {
        notificationToast.className = `notification-toast ${type}`;
        notificationTitle.textContent = title;
        notificationMessage.textContent = message;

        // Update icon based on type
        const icon = notificationToast.querySelector('.notification-icon i');
        if (type === 'success') {
            icon.className = 'fas fa-check-circle';
        } else if (type === 'warning') {
            icon.className = 'fas fa-exclamation-circle';
        }

        notificationToast.classList.add('show');

        // Auto hide after 5 seconds
        setTimeout(() => {
            hideNotification();
        }, 5000);
    }

    // Hide notification
    function hideNotification() {
        notificationToast.classList.remove('show');
    }

    // Add to cart function
    function addToCart(product) {
        const existingItem = cart.find(item => item.id === product.id);

        if (existingItem) {
            existingItem.quantity += 1;
            showNotification('success', 'Cart Updated', `${product.name} quantity increased to ${existingItem.quantity}`);
        } else {
            cart.push({
                ...product,
                quantity: 1
            });
            showNotification('success', 'Added to Cart', `${product.name} has been added to your cart`);
        }

        updateCartSummary();
    }

    // Toggle wishlist function
    function toggleWishlist(product) {
        const index = wishlist.findIndex(item => item.id === product.id);

        if (index === -1) {
            wishlist.push(product);
            showNotification('success', 'Added to Wishlist', `${product.name} has been added to your wishlist`);
            return true; // Added to wishlist
        } else {
            wishlist.splice(index, 1);
            showNotification('warning', 'Removed from Wishlist', `${product.name} has been removed from your wishlist`);
            return false; // Removed from wishlist
        }
    }

    // Render products for current page
    function renderProducts() {
        productGrid.innerHTML = '';

        if (filteredProducts.length === 0) {
            productGrid.innerHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                        <h3>No products found</h3>
                        <p>Try adjusting your filters to find what you're looking for.</p>
                    </div>
                `;
            productCount.textContent = `(0 products)`;
            renderPagination();
            return;
        }

        // Calculate start and end index for current page
        const startIndex = (currentPage - 1) * productsPerPage;
        const endIndex = startIndex + productsPerPage;
        const productsToShow = filteredProducts.slice(startIndex, endIndex);

        productsToShow.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'product-card';
            productCard.dataset.id = product.id;

            // Check if product is in wishlist
            const isInWishlist = wishlist.some(item => item.id === product.id);
            const wishlistClass = isInWishlist ? 'add-to-wishlist active' : 'add-to-wishlist';
            const wishlistIcon = isInWishlist ? '♥' : '♡';

            productCard.innerHTML = `
                    <img src="${product.image}" alt="${product.name}">
                    <div class="card-content">
                        <h4 class="product-title">${product.name}</h4>
                        <p class="product-desc">${product.description}</p>
                        <div class="product-specs">
                            ${product.specs.map(spec => `<span>${spec}</span>`).join('')}
                        </div>
                        <p class="product-price">₹ ${product.price.toLocaleString()}</p>

                        <!-- CHANGED: Replaced View Details with Add to Cart and Add to Wishlist -->
                        <div class="product-buttons">
                            <button class="add-to-cart-button" data-product-id="${product.id}">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="${wishlistClass} wishlist" data-product-id="${product.id}">
                                ${wishlistIcon}
                            </button>
                        </div>
                    </div>
                `;

            productGrid.appendChild(productCard);
        });

        // Update product count with pagination info
        const totalProducts = filteredProducts.length;
        const showingStart = startIndex + 1;
        const showingEnd = Math.min(endIndex, totalProducts);
        productCount.textContent = `(${totalProducts} products)`;

        renderPagination();
    }

    // Render pagination buttons
    function renderPagination() {
        const totalProducts = filteredProducts.length;
        const totalPages = Math.ceil(totalProducts / productsPerPage);

        paginationContainer.innerHTML = '';

        if (totalPages <= 1) return;

        // Previous button
        const prevButton = document.createElement('button');
        prevButton.innerHTML = '<i class="fas fa-chevron-left"></i>';
        prevButton.disabled = currentPage === 1;
        prevButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                renderProducts();
                scrollToProductsTop();
            }
        });
        paginationContainer.appendChild(prevButton);

        // Page buttons
        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        if (endPage - startPage + 1 < maxVisiblePages) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }

        // First page button if needed
        if (startPage > 1) {
            const firstButton = document.createElement('button');
            firstButton.textContent = '1';
            firstButton.addEventListener('click', () => {
                currentPage = 1;
                renderProducts();
                scrollToProductsTop();
            });
            paginationContainer.appendChild(firstButton);

            if (startPage > 2) {
                const ellipsis = document.createElement('span');
                ellipsis.textContent = '...';
                ellipsis.style.padding = '10px 16px';
                paginationContainer.appendChild(ellipsis);
            }
        }

        // Page number buttons
        for (let i = startPage; i <= endPage; i++) {
            const pageButton = document.createElement('button');
            pageButton.textContent = i;
            if (i === currentPage) {
                pageButton.classList.add('active');
            }
            pageButton.addEventListener('click', () => {
                currentPage = i;
                renderProducts();
                scrollToProductsTop();
            });
            paginationContainer.appendChild(pageButton);
        }

        // Last page button if needed
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                const ellipsis = document.createElement('span');
                ellipsis.textContent = '...';
                ellipsis.style.padding = '10px 16px';
                paginationContainer.appendChild(ellipsis);
            }

            const lastButton = document.createElement('button');
            lastButton.textContent = totalPages;
            lastButton.addEventListener('click', () => {
                currentPage = totalPages;
                renderProducts();
                scrollToProductsTop();
            });
            paginationContainer.appendChild(lastButton);
        }

        // Next button
        const nextButton = document.createElement('button');
        nextButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
        nextButton.disabled = currentPage === totalPages;
        nextButton.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                renderProducts();
                scrollToProductsTop();
            }
        });
        paginationContainer.appendChild(nextButton);

        // Page info
        const pageInfo = document.createElement('span');
        pageInfo.className = 'page-info';
        pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
        paginationContainer.appendChild(pageInfo);
    }

    // Filter products based on selected filters
    function filterProducts() {
        const minPrice = parseInt(minPriceInput.value) || initialMinPrice;
        const maxPrice = parseInt(maxPriceInput.value) || initialMaxPrice;

        // Validate price range
        if (minPrice > maxPrice) {
            alert("Minimum price cannot be greater than maximum price");
            minPriceInput.value = Math.min(minPrice, maxPrice);
            maxPriceInput.value = Math.max(minPrice, maxPrice);
            return;
        }

        // Get all checked filter values by category
        const selectedTypes = Array.from(document.querySelectorAll('input[data-filter="type"]:checked'))
            .map(cb => cb.value);
        const selectedProcessorSeries = Array.from(document.querySelectorAll('input[data-filter="processor-series"]:checked'))
            .map(cb => cb.value);
        const selectedDisplays = Array.from(document.querySelectorAll('input[data-filter="display"]:checked'))
            .map(cb => parseFloat(cb.value));
        const selectedSSDs = Array.from(document.querySelectorAll('input[data-filter="ssd"]:checked'))
            .map(cb => parseInt(cb.value));

        filteredProducts = products.filter(product => {
            if (product.category !== activeCategory) return false;
            // Price filter
            if (product.price < minPrice || product.price > maxPrice) return false;

            // Type filter
            if (selectedTypes.length > 0 && !selectedTypes.includes(product.type)) return false;

            // Processor series filter
            if (selectedProcessorSeries.length > 0 && !selectedProcessorSeries.includes(product.processor)) return false;

            // Display size filter
            if (selectedDisplays.length > 0) {
                const displayMatch = selectedDisplays.some(size => {
                    return Math.abs(product.display - size) < 0.5;
                });
                if (!displayMatch) return false;
            }

            // SSD filter
            if (selectedSSDs.length > 0 && !selectedSSDs.includes(product.ssd)) return false;

            return true;
        });

        // Reset to page 1 when filtering
        currentPage = 1;

        // Sort products
        sortProducts();
        renderProducts();
    }

    // Sort products
    function sortProducts() {
        const sortValue = sortSelect.value;

        switch (sortValue) {
            case 'price-low':
                filteredProducts.sort((a, b) => a.price - b.price);
                break;
            case 'price-high':
                filteredProducts.sort((a, b) => b.price - a.price);
                break;
            case 'newest':
                // Simulating newest by id (higher id = newer)
                filteredProducts.sort((a, b) => b.id - a.id);
                break;
            case 'rating':
                filteredProducts.sort((a, b) => b.rating - a.rating);
                break;
            default:
                // Default sorting (featured)
                filteredProducts.sort((a, b) => a.id - b.id);
        }
    }

    // Event Listeners
    document.addEventListener('click', function(e) {
        // Add to cart button
        if (e.target.classList.contains('add-to-cart') || e.target.closest('.add-to-cart')) {
            const button = e.target.classList.contains('add-to-cart') ? e.target : e.target.closest('.add-to-cart');
            const productId = parseInt(button.getAttribute('data-product-id'));
            const product = products.find(p => p.id === productId);

            if (product) {
                addToCart(product);
            }
        }

        // Add to wishlist button
        if (e.target.classList.contains('add-to-wishlist') || e.target.closest('.add-to-wishlist')) {
            const button = e.target.classList.contains('add-to-wishlist') ? e.target : e.target.closest('.add-to-wishlist');
            const productId = parseInt(button.getAttribute('data-product-id'));
            const product = products.find(p => p.id === productId);

            if (product) {
                const wasAdded = toggleWishlist(product);

                // Update button state
                if (wasAdded) {
                    button.classList.add('active');
                    button.innerHTML = '♥';
                } else {
                    button.classList.remove('active');
                    button.innerHTML = '♡';
                }

                updateCartSummary();
            }
        }
    });

    // Update price inputs when slider changes
    priceSlider.addEventListener('input', function() {
        minPriceInput.value = this.value;
    });

    // Apply price filter when apply button is clicked
    applyPriceFilterBtn.addEventListener('click', filterProducts);

    // Apply filter when enter key is pressed in price inputs
    minPriceInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') filterProducts();
    });

    maxPriceInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') filterProducts();
    });

    // Reset price filter to initial values
    resetPriceBtn.addEventListener('click', function() {
        minPriceInput.value = initialMinPrice;
        maxPriceInput.value = initialMaxPrice;
        priceSlider.value = initialSliderValue;
        filterProducts();
    });

    // Clear individual filter sections
    clearFilterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filterBox = this.closest('.filter-box');
            const checkboxes = filterBox.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(cb => cb.checked = false);
            filterProducts();
        });
    });

    // Sort change
    sortSelect.addEventListener('change', filterProducts);

    // Filter checkbox change
    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', filterProducts);
    });

    // Clear all filters
    clearAllFiltersBtn.addEventListener('click', function() {
        // Reset price
        minPriceInput.value = initialMinPrice;
        maxPriceInput.value = initialMaxPrice;
        priceSlider.value = initialSliderValue;

        // Uncheck all filter checkboxes
        filterCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

        // Reset sort
        sortSelect.value = 'default';

        // Reset filters and render
        filteredProducts = products.filter(
            product => product.category === activeCategory
        );

        currentPage = 1;
        sortProducts();
        renderProducts();
    });

    // View toggle
    viewGridBtn.addEventListener('click', function() {
        if (currentView === 'list') {
            productGrid.classList.remove('list-view');
            viewGridBtn.classList.add('active');
            viewListBtn.classList.remove('active');
            currentView = 'grid';
        }
    });

    viewListBtn.addEventListener('click', function() {
        if (currentView === 'grid') {
            productGrid.classList.add('list-view');
            viewListBtn.classList.add('active');
            viewGridBtn.classList.remove('active');
            currentView = 'list';
        }
    });

    // Close notification button
    closeNotificationBtn.addEventListener('click', hideNotification);

    // Initialize the page
    document.addEventListener('DOMContentLoaded', function() {
        updateCartSummary();
        renderProducts();
    });
</script>

@endsection
