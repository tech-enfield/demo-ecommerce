@extends('layouts.app')
@section('content')
    <!-- Banners -->
    <div class="banner">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($banners as $index => $banner)
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}"
                        aria-label="Slide {{ $index + 1 }}"
                        @if ($index == 0) class="active" aria-current="true" @endif></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach ($banners as $index => $banner)
                    <div class="carousel-item @if ($index == 0) active @endif">
                        <a href="{{ $base_url . $banner->hyper_link }}" target="__blank">
                            <img src="{{ asset('storage/' . $banner->path) }}" class="banner-img"
                                title="{{ $banner->title }}">
                        </a>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Deals -->
    <div class="deals mt-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <a href="assets/img/deal1.jpg" class="glightbox" data-gallery="gallery1">
                        <img src="{{ asset('assets/img/deal1.jpg') }}" class="deals-img">
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="assets/img/deal2.jpg" class="glightbox" data-gallery="gallery1">
                        <img src="{{ asset('assets/img/deal2.jpg') }}" class="deals-img">
                    </a>
                </div>

                <div class="col-lg-3">
                    <a href="assets/img/deal4.jpg" class="glightbox" data-gallery="gallery1">
                        <img src="{{ asset('assets/img/deal4.jpg') }}" class="deals-img">
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="assets/img/deal3.jpg" class="glightbox" data-gallery="gallery1">
                        <img src="{{ asset('assets/img/deal3.jpg') }}" class="deals-img">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop by Category -->
    <div class="category mt-30 pt-50">
        <div class="container-fluid">
            <h2>Shop by Category</h2>
            <div class="swiper categorySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="category-img">
                            <img src="{{ asset('assets/img/categories/laptops.jpg') }}" alt="Category 1">
                        </div>
                        <p>Laptops</p>
                    </div>
                    <div class="swiper-slide">
                        <div class="category-img">
                            <img src="{{ asset('assets/img/categories/mobile-phones.webp') }}" alt="Category 2">
                        </div>
                        <p>Mobile Phones</p>
                    </div>
                    <div class="swiper-slide">
                        <div class="category-img">
                            <img src="{{ asset('assets/img/categories/pcs.webp') }}" alt="Category 3">
                        </div>
                        <p>PC's</p>
                    </div>
                    <div class="swiper-slide">
                        <div class="category-img">
                            <img src="{{ asset('assets/img/categories/smartwatches.webp') }}" alt="Category 4">
                        </div>
                        <p>Smartwatches</p>
                    </div>
                    <div class="swiper-slide">
                        <div class="category-img">
                            <img src="{{ asset('assets/img/categories/earbuds.webp') }}" alt="Category 6">
                        </div>
                        <p>Earbuds</p>
                    </div>
                    <div class="swiper-slide">
                        <div class="category-img">
                            <img src="{{ asset('assets/img/categories/tablets.webp') }}" alt="Category 7">
                        </div>
                        <p>Tablets</p>
                    </div>
                    <div class="swiper-slide">
                        <div class="category-img">
                            <img src="{{ asset('assets/img/categories/pccomponents.webp') }}" alt="Category 8">
                        </div>
                        <p>PC Components</p>
                    </div>
                    <div class="swiper-slide">
                        <div class="category-img">
                            <img src="{{ asset('assets/img/categories/monitors.webp') }}" alt="Category 9">
                        </div>
                        <p>Monitor's</p>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>

        </div>
    </div>
    </div>

    <!-- Brands Scroller -->
    <div class="scroll-wrapper">
        <div class="container-fluid">
            <div class="scroll-container">
                <div class="scroll-text">
                    <span><img src="{{ asset('assets/img/brands/samsung.jpg') }}" alt=""></span>
                    <span><img src="{{ asset('assets/img/brands/lenovo.jpg') }}" alt=""></span>
                    <span><img src="{{ asset('assets/img/brands/asus.jpg') }}" alt=""></span>
                    <span><img src="{{ asset('assets/img/brands/hp.jpg') }}" alt=""></span>
                    <span><img src="{{ asset('assets/img/brands/acer.jpg') }}" alt=""></span>
                    <span><img src="{{ asset('assets/img/brands/dell.jpg') }}" alt=""></span>
                    <span><img src="{{ asset('assets/img/brands/apple.jpg') }}" alt=""></span>
                    <span><img src="{{ asset('assets/img/brands/samsung.jpg') }}" alt=""></span>
                    <span><img src="{{ asset('assets/img/brands/lenovo.jpg') }}" alt=""></span>
                    <span><img src="{{ asset('assets/img/brands/asus.jpg') }}" alt=""></span>
                    <span><img src="{{ asset('assets/img/brands/hp.jpg') }}" alt=""></span>
                    <span><img src="{{ asset('assets/img/brands/acer.jpg') }}" alt=""></span>
                    <span><img src="{{ asset('assets/img/brands/dell.jpg') }}" alt=""></span>
                    <span><img src="{{ asset('assets/img/brands/apple.jpg') }}" alt=""></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="featured-products pt-50 pb-50">
        <div class="container-fluid">
            <div class="featured-products-top">
                <h2>Featured Products</h2>
                <button class="theme-btn">View All</button>
            </div>
            <div class="featured-products-bottom">
                <div class="swiper featuredProductsSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($featured_products as $index => $item)
                            <div class="swiper-slide">
                                <div class="featured-product-card">
                                    <a href="{{ route('product', $item->slug) }}">
                                        <div class="featured-product-card-img">
                                            {{-- <a href="assets/img/featured-products/featured-product-1.webp" class="glightbox-single"> --}}
                                            <img src="{{ count($item->images) > 0 ? asset('storage/' . $item->images[0]->path) : asset('assets/img/featured-products/featured-product-1.webp') }}"
                                                alt="{{ count($item->images) > 0 ? $item->images[0]->alt : 'Laptop in Store9Nepal' }}"
                                                title="{{ count($item->images) > 0 ? $item->images[0]->alt : 'Product in Store9Nepal' }}">
                                            {{-- </a> --}}
                                        </div>
                                        <h4 class="featured-product-title">
                                            {{ $item->product->name . ' - ' . $item->title }}</h4>
                                        <p class="featured-product-description">{{ $item->product->short_description }}
                                        </p>
                                        @if ($item->on_sale == 1)
                                            <h6 class="featured-old-price"
                                                style="text-decoration:line-through; color: red;">Rs
                                                <span>{{ $item->price }}</span>
                                            </h6>
                                            <h5 class="featured-product-price">Rs <span>{{ $item->sale_price }}</span>
                                            </h5>
                                        @else
                                            <h5 class="featured-product-price">Rs <span>{{ $item->price }}</span></h5>
                                        @endif
                                        <div class="rating">

                                            @php
                                                $rating = $item->rating->rating;
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($rating >= 1)
                                                    <i class="bi bi-star-fill"></i>
                                                @elseif($rating > 0 && $rating < 1)
                                                    <i class="bi bi-star-half"></i>
                                                @else
                                                    <i class="bi bi-star"></i>
                                                @endif
                                                @php
                                                    $rating--;
                                                @endphp
                                            @endfor

                                            <span>({{ $item->rating->count }})</span>
                                        </div>
                                    </a>
                                    <div class="featured-products-buttons">
                                        @guest
                                            <button class="add-to-cart-button guestAddToCart"
                                                data-item-id="{{ $item->id }}">Add To Cart</button>
                                        @else
                                            <button class="add-to-cart-button userAddToCart"
                                                data-item-id="{{ $item->id }}">Add To Cart</button>
                                        @endguest
                                        <button class="buy-now-button">Buy Now</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
                <script>
                    function updateCartCount() {
                        let cart = JSON.parse(localStorage.getItem('cart')) || [];
                        $('#guestCartCount').text(cart.length);
                    }
                    $(document).ready(function() {
                        updateCartCount();
                        $('.guestAddToCart').on('click', function() {
                            let itemId = $(this).data('item-id');

                            let cart = JSON.parse(localStorage.getItem('cart')) || [];

                            // prevent duplicates (optional)
                            if (!cart.includes(itemId)) {
                                cart.push(itemId);
                            }

                            localStorage.setItem('cart', JSON.stringify(cart));

                            updateCartCount();
                        });

                        $('.userAddToCart').on('click', function() {
                            console.log('clickedd');
                        });

                        $('.guestCartCount').html()
                    });
                </script>

            </div>
        </div>
    </div>

    <section class="laptop-banner">
        <div class="banner-overlay"></div>
        <div class="container banner-flex">
            <!-- LEFT SIDE IMAGE -->
            <div class="banner-left">
                <img src="{{ asset('assets/img/laptop.png') }}" alt="Laptop">
            </div>
            <!-- RIGHT SIDE CONTENT -->
            <div class="banner-right">
                <h2>Upgrade Your Work & Creativity</h2>
                <p>Powerful performance, sleek design, and unmatched efficiency for everyday use.</p>
                <div class="banner-buttons">
                    <a href="#" class="buy-now-button">BUY NOW</a>
                    <a href="#" class="theme-btn">VIEW COLLECTIONS</a>
                </div>
            </div>
        </div>
    </section>


    <!-- Best Sellers -->
    <div class="best-seller pt-50 pb-50">
        <div class="container-fluid">
            <div class="best-seller-top">
                <h2>Best Selling</h2>
                <button class="theme-btn">View All</button>
            </div>
            <div class="best-seller-bottom">
                <div class="swiper bestSellerSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($best_sellings as $index => $item)
                            <div class="swiper-slide">
                                <div class="best-seller-card">
                                    {{-- <span class="badge">Best Seller</span> --}}
                                    <div class="best-seller-card-img">
                                        <a href="{{ count($item->images) > 0 ? asset('storage/' . $item->images[0]->path) : asset('assets/img/featured-products/featured-product-1.webp') }}"
                                            class="glightbox-single"><img
                                                src="{{ asset('assets/img/best-sellers/best-seller-1.webp') }}"
                                                alt="Product">
                                        </a>
                                    </div>
                                    <h4 class="product-name">{{ $item->product->name . ' - ' . $item->title }}</h4>
                                    <p class="featured-product-description">{{ $item->product->short_description }}</p>
                                    @if ($item->on_sale == 1)
                                        <h6 class="featured-old-price" style="text-decoration:line-through; color: red;">
                                            Rs <span>{{ $item->price }}</span></h6>
                                        <h5 class="featured-product-price">Rs <span>{{ $item->sale_price }}</span></h5>
                                    @else
                                        <h5 class="featured-product-price">Rs <span>{{ $item->price }}</span></h5>
                                    @endif

                                    <div class="rating">

                                        @php
                                            $rating = $item->rating->rating;
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($rating >= 1)
                                                <i class="bi bi-star-fill"></i>
                                            @elseif($rating > 0 && $rating < 1)
                                                <i class="bi bi-star-half"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                            @php
                                                $rating--;
                                            @endphp
                                        @endfor

                                        <span>({{ $item->rating->count }})</span>
                                    </div>
                                    <button class="add-to-cart-button">Add to Cart</button>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="swiper-slide">
                        <div class="best-seller-card">
                            <span class="badge">Best Seller</span>
                            <div class="best-seller-card-img">
                                <a href="assets/img/best-sellers/best-seller-1.webp" class="glightbox-single"><img src="{{ asset('assets/img/best-sellers/best-seller-1.webp') }}" alt="Product">
                                </a>
                            </div>
                            <p class="product-name">Gaming Laptop XYZ</p>
                            <div class="price">
                                <span class="new">Rs. 85,000</span>
                                <span class="old">Rs. 95,000</span>
                                <span class="off">10% OFF</span>
                            </div>
                            <div class="rating">⭐⭐⭐⭐☆ (120)</div>
                            <button class="add-to-cart-button">Add to Cart</button>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="best-seller-card">
                            <span class="badge">Best Seller</span>
                            <div class="best-seller-card-img">
                                <a href="assets/img/best-sellers/best-seller-2.webp" class="glightbox-single"><img src="{{ asset('assets/img/best-sellers/best-seller-2.webp') }}" alt="Product">
                                </a>
                            </div>
                            <p class="product-name">Gaming Laptop XYZ</p>
                            <div class="price">
                                <span class="new">Rs. 85,000</span>
                                <span class="old">Rs. 95,000</span>
                                <span class="off">10% OFF</span>
                            </div>
                            <div class="rating">⭐⭐⭐⭐☆ (120)</div>
                            <button class="add-to-cart-button">Add to Cart</button>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="best-seller-card">
                            <span class="badge">Best Seller</span>
                            <div class="best-seller-card-img">
                                <a href="assets/img/best-sellers/best-seller-3.webp" class="glightbox-single"><img src="{{ asset('assets/img/best-sellers/best-seller-3.webp') }}" alt="Product">
                                </a>
                            </div>
                            <p class="product-name">Gaming Laptop XYZ</p>
                            <div class="price">
                                <span class="new">Rs. 85,000</span>
                                <span class="old">Rs. 95,000</span>
                                <span class="off">10% OFF</span>
                            </div>
                            <div class="rating">⭐⭐⭐⭐☆ (120)</div>
                            <button class="add-to-cart-button">Add to Cart</button>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="best-seller-card">
                            <span class="badge">Best Seller</span>
                            <div class="best-seller-card-img">
                                <a href="assets/img/best-sellers/best-seller-4.webp" class="glightbox-single"><img src="{{ asset('assets/img/best-sellers/best-seller-4.webp') }}" alt="Product">
                                </a>
                            </div>
                            <p class="product-name">Gaming Laptop XYZ</p>
                            <div class="price">
                                <span class="new">Rs. 85,000</span>
                                <span class="old">Rs. 95,000</span>
                                <span class="off">10% OFF</span>
                            </div>
                            <div class="rating">⭐⭐⭐⭐☆ (120)</div>
                            <button class="add-to-cart-button">Add to Cart</button>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="best-seller-card">
                            <span class="badge">Best Seller</span>
                            <div class="best-seller-card-img">
                                <a href="assets/img/best-sellers/best-seller-5.webp" class="glightbox-single"><img src="{{ asset('assets/img/best-sellers/best-seller-5.webp') }}" alt="Product">
                                </a>
                            </div>
                            <p class="product-name">Gaming Laptop XYZ</p>
                            <div class="price">
                                <span class="new">Rs. 85,000</span>
                                <span class="old">Rs. 95,000</span>
                                <span class="off">10% OFF</span>
                            </div>
                            <div class="rating">⭐⭐⭐⭐☆ (120)</div>
                            <button class="add-to-cart-button">Add to Cart</button>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="best-seller-card">
                            <span class="badge">Best Seller</span>
                            <div class="best-seller-card-img">
                                <a href="assets/img/best-sellers/best-seller-6.webp" class="glightbox-single"><img src="{{ asset('assets/img/best-sellers/best-seller-6.webp') }}" alt="Product">
                                </a>
                            </div>
                            <p class="product-name">Gaming Laptop XYZ</p>
                            <div class="price">
                                <span class="new">Rs. 85,000</span>
                                <span class="old">Rs. 95,000</span>
                                <span class="off">10% OFF</span>
                            </div>
                            <div class="rating">⭐⭐⭐⭐☆ (120)</div>
                            <button class="add-to-cart-button">Add to Cart</button>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="best-seller-card">
                            <span class="badge">Best Seller</span>
                            <div class="best-seller-card-img">
                                <a href="assets/img/best-sellers/best-seller-7.webp" class="glightbox-single"><img src="{{ asset('assets/img/best-sellers/best-seller-7.webp') }}" alt="Product">
                                </a>
                            </div>
                            <p class="product-name">Gaming Laptop XYZ</p>
                            <div class="price">
                                <span class="new">Rs. 85,000</span>
                                <span class="old">Rs. 95,000</span>
                                <span class="off">10% OFF</span>
                            </div>
                            <div class="rating">⭐⭐⭐⭐☆ (120)</div>
                            <button class="add-to-cart-button">Add to Cart</button>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="best-seller-card">
                            <span class="badge">Best Seller</span>
                            <div class="best-seller-card-img">
                                <a href="assets/img/best-sellers/best-seller-1.webp" class="glightbox-single"><img src="{{ asset('assets/img/best-sellers/best-seller-1.webp') }}" alt="Product">
                                </a>
                            </div>
                            <p class="product-name">Gaming Laptop XYZ</p>
                            <div class="price">
                                <span class="new">Rs. 85,000</span>
                                <span class="old">Rs. 95,000</span>
                                <span class="off">10% OFF</span>
                            </div>
                            <div class="rating">⭐⭐⭐⭐☆ (120)</div>
                            <button class="add-to-cart-button">Add to Cart</button>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="best-seller-card">
                            <span class="badge">Best Seller</span>
                            <div class="best-seller-card-img">
                                <a href="assets/img/best-sellers/best-seller-2.webp" class="glightbox-single"><img src="{{ asset('assets/img/best-sellers/best-seller-2.webp') }}" alt="Product">
                                </a>
                            </div>
                            <p class="product-name">Gaming Laptop XYZ</p>
                            <div class="price">
                                <span class="new">Rs. 85,000</span>
                                <span class="old">Rs. 95,000</span>
                                <span class="off">10% OFF</span>
                            </div>
                            <div class="rating">⭐⭐⭐⭐☆ (120)</div>
                            <button class="add-to-cart-button">Add to Cart</button>
                        </div>
                    </div> --}}
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Section -->
    <section class="middle-video">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('assets/video/laptop-video.mp4') }}" type="video/mp4">
        </video>
        <div class="video-content">
            <h2>Upgrade Your Tech Today</h2>
            <p>Discover the latest laptops with unbeatable performance and style.</p>
            <a href="#shop" class="buy-now-button">Shop Now</a>
        </div>
    </section>

    <!-- Gaming Zone -->
    <div class="gaming-zone pt-50 pb-50">
        <!-- 🔥 Video Background -->
        <video class="video-bg" autoplay muted loop playsinline>
            <source src="{{ asset('assets/img/gaming-zone/gaming-bg.mp4') }}" type="video/mp4">
        </video>
        <div class="container-fluid">
            <h2>Gaming Zone</h2>
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="gaming-zone-left">
                        <div class="gaming-zone-left-img">
                            <a href="assets/img/gaming-zone/gaming-pc.jpg" class="glightbox-single">
                                <img src="{{ asset('assets/img/gaming-zone/gaming-pc.jpg') }}" alt="">
                            </a>
                        </div>
                        <h4>Build Your Dream PC</h4>
                        <h6>Pick your processor, graphics card, storage, and more — your build, your way.</h6>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="gaming-zone-right">
                        <div class="row">
                            <div class="col-lg-6 gaming-zone-right-item1">
                                <div class="gaming-zone-right-img">
                                    <a href="assets/img/gaming-zone/gaming-mouse.jpg" class="glightbox"
                                        data-gallery="gallery-2">
                                        <img src="{{ asset('assets/img/gaming-zone/gaming-mouse.jpg') }}" alt="">
                                    </a>
                                </div>
                                <h5>Gaming Mouse RGB</h5>
                                <p>Rs. 2000</p>
                            </div>
                            <div class="col-lg-6 gaming-zone-right-item2">
                                <div class="gaming-zone-right-img">
                                    <a href="assets/img/gaming-zone/mechanical-keyboard.jpg" class="glightbox"
                                        data-gallery="gallery-2">
                                        <img src="{{ asset('assets/img/gaming-zone/mechanical-keyboard.jpg') }}"
                                            alt="">
                                    </a>
                                </div>
                                <h5>Mechanical Keyboard</h5>
                                <p>Rs. 2000</p>
                            </div>
                            <div class="col-lg-6 gaming-zone-right-item3">
                                <div class="gaming-zone-right-img">
                                    <a href="assets/img/gaming-zone/gaming-headset.webp" class="glightbox"
                                        data-gallery="gallery-2">
                                        <img src="{{ asset('assets/img/gaming-zone/gaming-headset.webp') }}"
                                            alt="">
                                    </a>
                                </div>
                                <h5>Gaming Headset</h5>
                                <p>Rs. 2000</p>
                            </div>
                            <div class="col-lg-6 gaming-zone-right-item4">
                                <div class="gaming-zone-right-img">
                                    <a href="assets/img/gaming-zone/webcam.jpg" class="glightbox"
                                        data-gallery="gallery-2">
                                        <img src="{{ asset('assets/img/gaming-zone/webcam.jpg') }}" alt="">
                                    </a>
                                </div>
                                <h5>Webcam</h5>
                                <p>Rs. 2000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="electronics-section">
        <div class="container-fluid">
            <div class="electronics-container">
                <!-- LEFT BANNER (MOBILE) -->
                <div class="electronics-banner left">
                    <div class="electronics-text">
                        <h2>Laptop Accessories</h2>
                        <p>Keyboards, Mouse, Bags & More</p>
                        <a href="#" class="white-bg-button">Shop Accessories</a>
                    </div>

                    <div class="electronics-image">
                        <img src="{{ asset('assets/img/gaming-accessories.png') }} " alt="Laptop Accessories">
                    </div>

                </div>
                <!-- RIGHT BANNER (LAPTOP) -->
                <div class="electronics-banner right">
                    <div class="electronics-image">
                        <img src="{{ asset('assets/img/aa.png') }} " alt="Laptop">
                    </div>
                    <div class="electronics-text">
                        <h2>Powerful Laptops</h2>
                        <p>Work, Game & Create</p>
                        <a href="#" class="white-bg-button">Explore</a>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- Accessories -->
    <div class="accessories pt-50 pb-50">
        <div class="container-fluid">
            <h2>Accessories</h2>
            <div class="swiper accessoriesSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/gaming-headset.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/gaming-headset.webp') }}"
                                        alt="Gaming Headset">
                                </a>
                            </div>
                            <h4 class="accessories-title">Gaming Headset</h4>
                            <p class="accessories-description">High-quality sound with noise cancellation.</p>
                            <h5 class="accessories-price">Rs <span>3500</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/gaming-mouse.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/gaming-mouse.webp') }}"
                                        alt="Gaming Mouse">
                                </a>
                            </div>
                            <h4 class="accessories-title">Gaming Mouse</h4>
                            <p class="accessories-description">RGB lighting and adjustable DPI.</p>
                            <h5 class="accessories-price">Rs <span>2500</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/mechanical-keyboard.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/mechanical-keyboard.webp') }}"
                                        alt="Mechanical Keyboard">
                                </a>
                            </div>
                            <h4 class="accessories-title">Mechanical Keyboard</h4>
                            <p class="accessories-description">Blue switches with RGB effects.</p>
                            <h5 class="accessories-price">Rs <span>4500</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/usb-hub.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/usb-hub.webp') }}" alt="USB Hub">
                                </a>
                            </div>
                            <h4 class="accessories-title">USB 3.0 Hub</h4>
                            <p class="accessories-description">Fast 4-port USB connectivity.</p>
                            <h5 class="accessories-price">Rs <span>1200</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/laptop-stand.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/laptop-stand.webp') }}"
                                        alt="Laptop Stand">
                                </a>
                            </div>
                            <h4 class="accessories-title">Laptop Stand</h4>
                            <p class="accessories-description">Adjustable aluminum cooling stand.</p>
                            <h5 class="accessories-price">Rs <span>1800</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/mousepad.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/mousepad.webp') }}" alt="Gaming Mousepad">
                                </a>
                            </div>
                            <h4 class="accessories-title">Gaming Mousepad</h4>
                            <p class="accessories-description">Large anti-slip mousepad for precision.</p>
                            <h5 class="accessories-price">Rs <span>700</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/speaker.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/speaker.webp') }}"
                                        alt="Portable Speakers">
                                </a>
                            </div>
                            <h4 class="accessories-title">Portable Speakers</h4>
                            <p class="accessories-description">Compact speakers with deep bass.</p>
                            <h5 class="accessories-price">Rs <span>2200</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/laptopfan.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/laptopfan.webp') }}"
                                        alt="Laptop Cooling Pad">
                                </a>
                            </div>
                            <h4 class="accessories-title">Laptop Cooling Pad</h4>
                            <p class="accessories-description">Dual fan cooling pad for laptops.</p>
                            <h5 class="accessories-price">Rs <span>1600</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/webcam.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/webcam.webp') }}" alt="HD Webcam">
                                </a>
                            </div>
                            <h4 class="accessories-title">HD Webcam</h4>
                            <p class="accessories-description">1080p webcam ideal for meetings.</p>
                            <h5 class="accessories-price">Rs <span>3000</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/router.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/router.webp') }}" alt="WiFi Router">
                                </a>
                            </div>
                            <h4 class="accessories-title">WiFi Router</h4>
                            <p class="accessories-description">High-speed dual-band wireless router.</p>
                            <h5 class="accessories-price">Rs <span>3500</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/ssd.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/ssd.webp') }}" alt="SSD Enclosure">
                                </a>
                            </div>
                            <h4 class="accessories-title">SSD Enclosure</h4>
                            <p class="accessories-description">USB 3.1 NVMe SSD enclosure.</p>
                            <h5 class="accessories-price">Rs <span>2000</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/hdmi.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/hdmi.webp') }}" alt="HDMI Cable">
                                </a>
                            </div>
                            <h4 class="accessories-title">HDMI Cable</h4>
                            <p class="accessories-description">4K high-speed HDMI cable.</p>
                            <h5 class="accessories-price">Rs <span>600</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/typec.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/typec.webp') }}" alt="USB-C Adapter">
                                </a>
                            </div>
                            <h4 class="accessories-title">USB-C Adapter</h4>
                            <p class="accessories-description">Fast Type-C to USB converter.</p>
                            <h5 class="accessories-price">Rs <span>400</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/powerbank.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/powerbank.webp') }}" alt="Power Bank">
                                </a>
                            </div>
                            <h4 class="accessories-title">Power Bank</h4>
                            <p class="accessories-description">10000mAh fast-charging power bank.</p>
                            <h5 class="accessories-price">Rs <span>2500</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="accessories-card">
                            <div class="accessories-card-img">
                                <a href="assets/img/accessories/earbuds.webp" class="glightbox-single">
                                    <img src="{{ asset('assets/img/accessories/earbuds.webp') }}" alt="Wireless Earbuds">
                                </a>
                            </div>
                            <h4 class="accessories-title">Wireless Earbuds</h4>
                            <p class="accessories-description">Premium sound with long battery life.</p>
                            <h5 class="accessories-price">Rs <span>3200</span></h5>
                            <div class="accessories-buttons">
                                <button class="add-to-cart-button">Add To Cart</button>
                                <button class="buy-now-button">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </div>

    <section class="tech-featured-section">
        <div class="container-fluid tech-wrapper">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <!-- Left Single Laptop Image -->
                    <div class="tech-left">
                        <img src="{{ asset('assets/img/laptop-left.png') }}" alt="Laptop Left">
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Center Content -->
                    <div class="tech-content">
                        <h2>Ultimate Gaming PCs</h2>
                        <p>
                            Dominate every battlefield with ultra-fast processors, high-FPS graphics,
                            advanced cooling, and unbeatable performance engineered for pro-level gaming.
                            Experience smooth gameplay, zero lag, and true next-gen power.
                        </p>
                        <a href="#" class="white-bg-button">Shop Now</a>
                    </div>

                </div>
                <div class="col-lg-4">
                    <!-- Right Laptop Image -->
                    <div class="tech-right">
                        <img src="{{ asset('assets/img/laptop-right.png') }}" alt="Laptop Right">
                    </div>
                </div>
            </div>






        </div>
    </section>




    <!-- Blogs -->
    <div class="blogs pt-50 pb-50">
        <div class="container-fluid">
            <div class="blogs-top">
                <h2>Our Latest Blogs</h2>
                <div class="blog-nav">
                    <div class="swiper-button-prev custom-prev"></div>
                    <div class="swiper-button-next custom-next"></div>
                </div>
            </div>
            <div class="blogs-bottom">
                <div class="swiper blogSwiper">
                    <div class="swiper-wrapper">
                        <!-- Blog Card -->
                        <div class="swiper-slide">
                            <div class="blog-card">
                                <div class="blog-card-img">
                                    <img src={{ asset('assets/img/blogs/electronics-guide.webp') }} class="blog-img"
                                        alt="Blog Image">
                                </div>
                                <div class="blog-content">
                                    <h4 class="blog-category">Electronics Guide</h4>
                                    <h5 class="blog-heading">Top 5 Laptops for Students in 2025</h5>
                                    <p class="blog-excerpt">A quick guide to help you choose the perfect laptop for study,
                                        work, and entertainment.</p>
                                    <a href="#" class="blog-read">Read Blog →</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog-card">
                                <div class="blog-card-img">
                                    <img src={{ asset('assets/img/blogs/laptop-guides.webp') }} class="blog-img"
                                        alt="">
                                </div>
                                <div class="blog-content">
                                    <h4 class="blog-category">Laptop Tips</h4>
                                    <h5 class="blog-heading">How to Increase Your Laptop Speed Instantly</h5>
                                    <p class="blog-excerpt">Simple upgrades and settings that can boost your laptop
                                        performance within minutes.</p>
                                    <a href="#" class="blog-read">Read Blog →</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog-card">
                                <div class="blog-card-img">
                                    <img src={{ asset('assets/img/blogs/smartphone-guides.webp') }} class="blog-img"
                                        alt="">
                                </div>
                                <div class="blog-content">
                                    <h4 class="blog-category">Smartphone Guide</h4>
                                    <h5 class="blog-heading">Best Phones Under NPR 25,000 in 2025</h5>
                                    <p class="blog-excerpt">Our top picks for budget smartphones with great performance and
                                        features.</p>
                                    <a href="#" class="blog-read">Read Blog →</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog-card">
                                <div class="blog-card-img">
                                    <img src={{ asset('assets/img/blogs/gaming-setup.webp') }} class="blog-img"
                                        alt="">
                                </div>
                                <div class="blog-content">
                                    <h4 class="blog-category">Gaming Setup</h4>
                                    <h5 class="blog-heading">Top Gaming Accessories You Must Have</h5>
                                    <p class="blog-excerpt">From RGB keyboards to premium gaming mice — upgrade your gaming
                                        experience.</p>
                                    <a href="#" class="blog-read">Read Blog →</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog-card">
                                <div class="blog-card-img">
                                    <img src={{ asset('assets/img/blogs/tech-updates.webp') }} class="blog-img"
                                        alt="">
                                </div>
                                <div class="blog-content">
                                    <h4 class="blog-category">Tech Updates</h4>
                                    <h5 class="blog-heading">Latest Gadget Releases of 2025</h5>
                                    <p class="blog-excerpt">A quick look at the newest phones, laptops, and accessories
                                        entering the market.</p>
                                    <a href="#" class="blog-read">Read Blog →</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog-card">
                                <div class="blog-card-img">
                                    <img src={{ asset('assets/img/blogs/home-tech.webp') }} class="blog-img"
                                        alt="">
                                </div>
                                <div class="blog-content">
                                    <h4 class="blog-category">Home Tech</h4>
                                    <h5 class="blog-heading">How to Build a Smart Home on a Budget</h5>
                                    <p class="blog-excerpt">Affordable smart gadgets to upgrade your home without spending
                                        too much.</p>
                                    <a href="#" class="blog-read">Read Blog →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>

    <section class="promo-banner">
        <div class="promo-container">

            <!-- Left Image -->
            <div class="promo-img left">
                <img src="{{ asset('assets/img/woman-holding-laptop.png') }}" alt="">
            </div>

            <!-- Center Content -->
            <div class="promo-content">
                <h2>Go portable, Get productive</h2>
                <p>
                    Work smarter anywhere with ultra-light laptops built for speed, multitasking,
                    and all-day performance.
                </p>
                <h5>
                    Stay connected, stay powerful — upgrade with confidence.
                </h5>
                <a href="#" class="theme-btn">Shop now</a>
            </div>


            <!-- Right Image -->
            <div class="promo-img right">
                <img src="{{ asset('assets/img/man-holding-laptop.png') }}" alt="">

            </div>

        </div>
    </section>



    <!-- Contact Us -->
    <div class="contact-us pt-50 pb-50">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="contact-us-left">
                        <div class="map-container" style="border-radius: 10px; overflow: hidden;">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.399044877207!2d85.32024947611366!3d27.70496302559544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1900418c62d5%3A0xdfd16c6905fd27d0!2sStore%209%20Nepal!5e0!3m2!1sen!2snp!4v1763977175399!5m2!1sen!2snp"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-us-right">
                        <h3 class="mb-3">Get in Touch</h3>
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" placeholder="Enter your name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" placeholder="Enter your email">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Enter your phone">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Subject</label>
                                    <input type="text" class="form-control" placeholder="Enter subject">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" rows="5" placeholder="Write your message"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="theme-btn ms-1">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Benifits -->
    <div class="benifits pb-50">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 benifits-item1">
                    <div class="benifits-inner align-items-center">
                        <img src="{{ asset('assets/img/benifit-icons/free-shipping.png') }}" alt="">
                        <div class="benifits-inner-text">
                            <h3>Free Shipping</h3>
                            <p>Enjoy free shipping on all orders across Nepal — fast, reliable, and hassle-free delivery to
                                your doorstep.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 benifits-item2">
                    <div class="benifits-inner align-items-center">
                        <img src="{{ asset('assets/img/benifit-icons/100%-genuine.png') }}" alt="">
                        <div class="benifits-inner-text">
                            <h3>100% Genuine</h3>
                            <p>Enjoy 100% genuine and original products — trusted quality, verified sources, and guaranteed
                                authenticity on every purchase.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 benifits-item3">
                    <div class="benifits-inner align-items-center">
                        <img src="{{ asset('assets/img/benifit-icons/easy-return.png') }}" alt="">
                        <div class="benifits-inner-text">
                            <h3>Easy Return Policy</h3>
                            <p>Enjoy a 7-day easy return policy — simple, hassle-free, and designed to give you complete
                                confidence while shopping.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 benifits-item4">
                    <div class="benifits-inner align-items-center">
                        <img src="{{ asset('assets/img/benifit-icons/secure-payment.png') }}" alt="">
                        <div class="benifits-inner-text">
                            <h3>Secure Payment</h3>
                            <p>Shop without hesitation — enjoy a smooth, secure, and customer-friendly experience from
                                browsing to checkout.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 benifits-item5">
                    <div class="benifits-inner align-items-center">
                        <img src="{{ asset('assets/img/benifit-icons/warrenty.png') }}" alt="">
                        <div class="benifits-inner-text">
                            <h3>Warranty Assurance</h3>
                            <p>Warranty on selected products — offering trusted coverage, reliable support, and peace of
                                mind with every eligible purchase.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 benifits-item6">
                    <div class="benifits-inner align-items-center">
                        <img src="{{ asset('assets/img/benifit-icons/best-price.png') }}" alt="">
                        <div class="benifits-inner-text">
                            <h3>Best Price Guarantee</h3>
                            <p>Competitive prices on all products — enjoy great value, fair deals, and budget-friendly
                                options every time you shop with us.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div style="display: none;" id="cartOverlap">
        @include('components.cart-card', ['carts' => $carts])
    </div> --}}
{{-- @include('components.cart-card') --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var categorySwiper = new Swiper(".categorySwiper", {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 6,
                    spaceBetween: 50,
                },
            },
        });
    </script>
    <script>
        var featuredProducts = new Swiper(".featuredProductsSwiper", {
            slidesPerView: 1, // default for very small screens
            spaceBetween: 20,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                576: { // small screens
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: { // tablets
                    slidesPerView: 3,
                    spaceBetween: 25,
                },
                992: { // desktops
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                1200: { // large desktops
                    slidesPerView: 5,
                    spaceBetween: 40,
                },
            },
        });
    </script>
    <script>
        var bestSellerSwiper = new Swiper(".bestSellerSwiper", {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 6,
                    spaceBetween: 30,
                },
            },
        });
    </script>

    <script>
        var accessoriesSwiper = new Swiper(".accessoriesSwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                576: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 25,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                1200: {
                    slidesPerView: 5,
                    spaceBetween: 40,
                },
            },
        });
    </script>
    <script>
        var blogSwiper = new Swiper(".blogSwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".custom-next",
                prevEl: ".custom-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                576: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        const lightbox = GLightbox({
            selector: '.glightbox'
        });
    </script>
    <script>
        const singleLightbox = GLightbox({
            selector: '.glightbox-single',
            loop: false,
            touchNavigation: false,
            draggable: false,
            keyboardNavigation: false,
            openEffect: "zoom",
            closeEffect: "fade",
            slideEffect: "none",
            autoplayVideos: false,
            moreText: '', // removes "read more"
            svg: {
                next: '', // remove next arrow
                prev: '' // remove prev arrow
            }
        });
    </script>
@endsection
