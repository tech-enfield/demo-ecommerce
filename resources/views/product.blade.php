@extends('layouts.app')
@section('content')
    <!-- Product Page -->
    <div class="container-fluid pt-50 pb-50">
        <div class="product-details">
            <div class="product-details-left">
                <!-- Main Image + Zoom Box wrapper -->
                <div class="image-wrapper">
                    @if(count($product->images)>0)
                            <img src="{{ asset('storage/' . $product->images[0]->path) }}" alt="{{ $product->images[0]->alt }}" title="{{ $product->images[0]->alt }}">
                            @else
                            <img src="{{ asset('assets/img/similar-products/sp-1.png') }}" alt="Product">
                            @endif
                    {{-- <img src="{{ asset('storage/' . $product->images[0]->path) }}" class="main-img"
                        alt="{{ $product->images[0]->alt }}"> --}}
                    {{-- <img src="{{ asset('assets/img/product/aceraspire5/aceraspire5-front.png') }}" class="main-img" alt="Product Image"> --}}
                    <div class="zoom-lens" id="zoom-lens"></div>
                </div>
                <!-- Thumbnail Images -->
                <div class="thumbnails">
                    @foreach ($product->images as $index => $item)
                        <img src="{{ asset('storage/' . $item->path) }}"
                            class="thumb @if ($index == 0) active @endif">
                    @endforeach
                    {{-- <img src="{{ asset('assets/img/product/aceraspire5/aceraspire5-front.png') }}" class="thumb active">
                <img src="{{ asset('assets/img/product/aceraspire5/aceraspire5-back.png') }}" class="thumb">
                <img src="{{ asset('assets/img/product/aceraspire5/aceraspire5-side.png') }}" class="thumb">
                <img src="{{ asset('assets/img/product/aceraspire5/aceraspire5-bothside.png') }}" class="thumb"> --}}
                </div>
            </div>
            <div class="product-details-right">
                <div class="zoom-preview" id="zoom-preview">
                    <div class="zoomed-image" id="zoomed-image"></div>
                </div>
                <p class="product-detail-category">Laptops</p>
                <h2 class="product-detail-title">{{ $product->product->name . ' - ' . $product->title }}</h2>
                <div class="product-detail-rating">
                    @php
                        $rating = $product->rating->rating;
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

                    <span>({{ $product->rating->count }} customer reviews)</span>
                    {{-- <span>(128 customer reviews)</span> --}}
                </div>
                {{-- <p class="product-detail-brand"><img src="{{ asset('assets/img/brands/acer.jpg') }}"> </p> --}}
                <p class="product-detail-stock">Availability: <span> @if($product->stock_status == 'in_stock') {{$product->stock_quantity}} in stock @else <span style="color: red;">{{$product->stock_status}}</span> @endif</span></p>
                <ul class="product-detail-features">
                    <li>14" Full HD IPS Display (1920 × 1080)</li>
                    <li>Intel Core i5 13th Gen Processor</li>
                    <li>8GB DDR4 RAM · 512GB NVMe SSD</li>
                    <li>Intel Iris Xe Graphics</li>
                    <li>Wi-Fi 6 · Bluetooth 5.2</li>
                    <li>Backlit Keyboard + HD Webcam</li>
                </ul>
                <p class="product-detail-desc">{{ $product->product->short_description }}</p>
                {{-- <p class="product-detail-desc">
                    The Acer Aspire 5 is a powerful and lightweight laptop designed for daily multitasking,
                    productivity, and entertainment. With a slim design, long battery life, and fast SSD storage,
                    it's perfect for students, professionals, and home users.
                </p> --}}
                {{-- <p class="product-detail-sku">SKU: ACER-A514-2024</p> --}}
                <div class="product-detail-price-section">
                    @if($product->on_sale == 1)
                    <span class="product-detail-price">NPR {{ $product->sale_price }}</span>
                    <span class="product-detail-old-price">NPR {{ $product->price }}</span>
                    @else
                    <span class="product-detail-price">NPR {{ $product->price }}</span>
                    @endif
                </div>
                <div class="product-detail-options">
                    <label>Color</label>
                    <select>
                        @foreach($product->colors as $index => $color)
                        <option value="{{$color->color_id}}">{{$color->color->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="product-detail-quantity-section">
                    <label>Quantity</label>
                    <div class="product-detail-qty-box">
                        <button class="product-detail-qty-btn"><i class="bi bi-dash-circle-fill"></i></button>
                        <input type="text" value="1">
                        <button class="product-detail-qty-btn"><i class="bi bi-plus-circle-fill"></i></button>
                    </div>
                </div>
                <button class="add-to-cart-button">Add to Cart</button>
            </div>

        </div>
    </div>


    <!-- Product Tabs Section -->
    <div class="container">
        <div class="product-tabs">
            <div class="tab-buttons">
                <button class="tab-btn active" data-tab="description">Description</button>
                <button class="tab-btn" data-tab="specification">Specification</button>
                <button class="tab-btn" data-tab="reviews">Reviews</button>
            </div>

            <div class="tab-content">

                <!-- DESCRIPTION -->
                <div id="description" class="tab-box active">
                    <h3>Description</h3>
                    <p>{{ $product->product->description }}</p>
                    {{-- <p>
                        The Acer Aspire 5 (2024) 14″ is designed for users who need a powerful,
                        lightweight laptop for daily productivity, coding, online work, multitasking,
                        entertainment, and portability. With a compact 14-inch IPS display,
                        the laptop delivers crisp visuals and comfortable viewing for long hours.
                    </p>
                    <br>
                    <p>
                        Powered by the 13th Gen Intel Core i5 processor and paired with fast NVMe SSD storage,
                        it ensures a smooth experience whether you're browsing, working on projects, coding
                        (Python, Django, JavaScript, React), running local servers like XAMPP, or handling
                        documents and multitasking.
                    </p>
                    <br>
                    <p>
                        Intel Iris Xe Graphics provides reliable performance for graphics tasks like light
                        designing, watching movies, or running front-end development previews. With a slim,
                        stylish build and long battery life, it’s perfect for students, developers,
                        professionals, and home users.
                    </p> --}}
                </div>

                <!-- SPECIFICATIONS -->
                <div id="specification" class="tab-box">
                    <h3>Full Specifications</h3>
                    <ul>
                        <li><strong>Model:</strong> Acer Aspire 5 (2024 Slim Series)</li>
                        <li><strong>Display:</strong> 14.0″ Full HD IPS (1920 × 1080) / some variants 1920 × 1200</li>
                        <li><strong>Processor:</strong> Intel Core i5-1335U (13th Gen) — 10 Cores, up to 4.6 GHz</li>
                        <li><strong>Cache:</strong> 12MB Intel Smart Cache</li>
                        <li><strong>RAM:</strong> 8GB or 16GB LPDDR5 (varies by variant)</li>
                        <li><strong>Storage:</strong> 512GB NVMe PCIe SSD</li>
                        <li><strong>Graphics:</strong> Intel Iris Xe Graphics</li>
                        <li><strong>Wireless:</strong> Wi-Fi 6, Bluetooth 5.2</li>
                        <li><strong>Webcam:</strong> HD 720p Built-in Webcam</li>
                        <li><strong>Audio:</strong> Stereo Speakers + Built-in Microphone</li>
                        <li><strong>Keyboard:</strong> Full-size (Backlit depends on variant)</li>
                        <li><strong>Ports:</strong>
                            <ul>
                                <li>USB Type-A (3.2 Gen)</li>
                                <li>USB Type-C Port</li>
                                <li>HDMI Port</li>
                                <li>3.5mm Audio Jack</li>
                            </ul>
                        </li>
                        <li><strong>Battery:</strong> 3-cell Lithium-Ion (Up to 5–7 hours depending on usage)</li>
                        <li><strong>Weight:</strong> Approx. 1.4 – 1.6 kg (depends on model)</li>
                        <li><strong>Suitable For:</strong> Programming, Office Work, Students, Entertainment, Web
                            Development</li>
                    </ul>
                </div>


                <!-- REVIEWS -->
                <div id="reviews" class="tab-box">
                    <h3>Customer Reviews</h3>

                    <div class="reviews-wrapper">

                        <!-- LEFT: REVIEW LIST -->
                        <div class="reviews-left">
                            <p>No reviews yet. Be the first to review this product!</p>
                        </div>

                        <!-- RIGHT: REVIEW FORM -->
                        <div class="reviews-right">
                            <h4>Write a Review</h4>

                            <form class="review-form">
                                <div class="form-group">
                                    <label>Your Name</label>
                                    <input type="text" placeholder="Enter your name">
                                </div>

                                <div class="form-group">
                                    <label>Your Rating</label>
                                    <div class="stars">
                                        <i onclick="setRating(1)" class="bi bi-star star"></i>
                                        <i onclick="setRating(2)" class="bi bi-star star"></i>
                                        <i onclick="setRating(3)" class="bi bi-star star"></i>
                                        <i onclick="setRating(4)" class="bi bi-star star"></i>
                                        <i onclick="setRating(5)" class="bi bi-star star"></i>
                                    </div>

                                    <h3 id="output">Rating is: 0/5</h3>

                                </div>

                                <div class="form-group">
                                    <label>Your Review</label>
                                    <textarea rows="4" placeholder="Write your review..."></textarea>
                                </div>

                                <button type="button" class="add-to-cart-button">Submit Review</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Similar Products Section -->
    <div class="similar-products pt-50 pb-50">
        <div class="container-fluid">
            <h2 class="section-title mb-4">Similar Products</h2>

            <div class="row">

                @foreach($similar_products as $index => $item)
                <div class="col-lg-2">
                    <div class="similar-product-card">
                        <div class="sp-image">
                            @if(count($item->images)>0)
                            <img src="{{ asset('storage/' . $item->images[0]->path) }}" alt="{{ $item->images[0]->alt }}" title="{{ $item->images[0]->alt }}">
                            @else
                            <img src="{{ asset('assets/img/similar-products/sp-1.png') }}" alt="Product">
                            @endif
                        </div>
                        <h4 class="sp-title">{{ $item->name }}</h4>
                        {{-- <h4 class="sp-title">{{ $item->product->name . ' - ' . $item->title }}</h4> --}}
                        <p>{{$item->product->short_description}}</p>
                        @if($item->on_sale == 1)
                            <h6 class="sp-old-price" style="text-decoration:line-through; color: red;">Rs <span>{{ $item->price }}</span></h6>
                            <h5 class="sp-price">Rs <span>{{ $item->sale_price}}</span></h5>
                        @else
                            <h5 class="sp-price">Rs <span>{{ $item->price}}</span></h5>
                        @endif

                         <div class="rating">
                            @php
                                $rating = $item->rating->rating;
                            @endphp
                            @for($i=1; $i<=5; $i++)
                            @if($rating >= 1)
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
            </div>
        </div>
    </div>

    <!-- You May Also Like Section -->
    <div class="you-may-like pt-50 pb-50">
        <div class="container-fluid">
            <h2 class="section-title mb-4">You May Also Like</h2>

            <div class="row g-4">

                <!-- Item 1 -->
                <div class="col-lg-3 col-md-6">
                    <div class="ym-product-card">
                        <div class="ym-image">
                            <img src="{{ asset('assets/img/gaming-laptop.png') }}" alt="Product">
                        </div>
                        <h4 class="ym-title">HP Pavilion 15</h4>
                        <p class="ym-desc">HP Pavilion 15 | Ryzen 5 | 16GB RAM | 512GB SSD</p>
                        <p class="ym-price">Rs. 78,000</p>
                        <button class="theme-btn">View Details</button>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="col-lg-3 col-md-6">
                    <div class="ym-product-card">
                        <div class="ym-image">
                            <img src="{{ asset('assets/img/gaming-laptop.png') }}" alt="Product">
                        </div>
                        <h4 class="ym-title">Lenovo Ideapad Slim 3</h4>
                        <p class="ym-desc">Intel Core i5 | 8GB RAM | 512GB SSD | 15.6" Display</p>
                        <p class="ym-price">Rs. 65,500</p>
                        <button class="theme-btn">View Details</button>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="col-lg-3 col-md-6">
                    <div class="ym-product-card">
                        <div class="ym-image">
                            <img src="{{ asset('assets/img/gaming-laptop.png') }}" alt="Product">
                        </div>
                        <h4 class="ym-title">Dell Inspiron 15</h4>
                        <p class="ym-desc">Core i5 12th Gen | 16GB RAM | 512GB SSD</p>
                        <p class="ym-price">Rs. 82,000</p>
                        <button class="theme-btn">View Details</button>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="col-lg-3 col-md-6">
                    <div class="ym-product-card">
                        <div class="ym-image">
                            <img src="{{ asset('assets/img/gaming-laptop.png') }}" alt="Product">
                        </div>
                        <h4 class="ym-title">Asus Vivobook 14</h4>
                        <p class="ym-desc">Ryzen 7 | 16GB RAM | 512GB SSD</p>
                        <p class="ym-price">Rs. 79,000</p>
                        <button class="theme-btn">View Details</button>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        // select main image
        const mainImg = document.querySelector(".main-img");

        // select all thumbnail images
        const thumbnails = document.querySelectorAll(".thumb");

        thumbnails.forEach(thumb => {
            thumb.addEventListener("click", function() {

                // change main image source
                mainImg.src = this.src;

                // remove active border from all
                thumbnails.forEach(t => t.classList.remove("active"));

                // add active border to clicked one
                this.classList.add("active");
            });
        });
    </script>
    <script>
        const qtyBtns = document.querySelectorAll(".product-detail-qty-btn");
        const qtyInput = document.querySelector(".product-detail-qty-box input");

        qtyBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                let value = parseInt(qtyInput.value);

                // Check if button contains the plus icon
                if (btn.querySelector(".bi-plus-circle-fill")) {
                    qtyInput.value = value + 1;
                }

                // Check if button contains the minus icon
                if (btn.querySelector(".bi-dash-circle-fill") && value > 1) {
                    qtyInput.value = value - 1;
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const imageWrapper = document.querySelector('.image-wrapper');
            const mainImage = document.querySelector('.main-img');
            const zoomLens = document.getElementById('zoom-lens');
            const zoomPreview = document.getElementById('zoom-preview');
            const zoomedImage = document.getElementById('zoomed-image');
            const thumbnails = document.querySelectorAll('.thumb');

            const zoomFactor = 2; // zoom strength

            function updateZoomImage() {
                zoomedImage.style.backgroundImage = `url(${mainImage.src})`;
                zoomedImage.style.backgroundSize =
                    `${mainImage.width * zoomFactor}px ${mainImage.height * zoomFactor}px`;
            }

            updateZoomImage();

            imageWrapper.addEventListener("mousemove", function(e) {

                const rect = mainImage.getBoundingClientRect();
                let x = e.clientX - rect.left;
                let y = e.clientY - rect.top;

                if (x < 0) x = 0;
                if (y < 0) y = 0;
                if (x > mainImage.width) x = mainImage.width;
                if (y > mainImage.height) y = mainImage.height;

                // Move lens
                zoomLens.style.left = `${x - zoomLens.offsetWidth / 2}px`;
                zoomLens.style.top = `${y - zoomLens.offsetHeight / 2}px`;

                // Convert mouse position to percentage for precise zoom
                const posX = (x / mainImage.width) * 100;
                const posY = (y / mainImage.height) * 100;

                zoomedImage.style.backgroundPosition = `${posX}% ${posY}%`;

            });

            imageWrapper.addEventListener("mouseenter", () => {
                zoomLens.style.display = "block";
                zoomPreview.style.display = "block";
            });

            imageWrapper.addEventListener("mouseleave", () => {
                zoomLens.style.display = "none";
                zoomPreview.style.display = "none";
            });


            // Thumbnail click
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {

                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add("active");

                    mainImage.src = this.src;

                    updateZoomImage();
                });
            });

        });
    </script>


    <script>
        document.querySelectorAll(".tab-btn").forEach(button => {
            button.addEventListener("click", () => {
                const tab = button.dataset.tab;

                // Remove active class from all buttons
                document.querySelectorAll(".tab-btn").forEach(btn =>
                    btn.classList.remove("active")
                );

                // Add to clicked button
                button.classList.add("active");

                // Hide all content boxes
                document.querySelectorAll(".tab-box").forEach(box =>
                    box.classList.remove("active")
                );

                // Show selected content
                document.getElementById(tab).classList.add("active");
            });
        });
    </script>
    <script>
        function setRating(rating) {
            let stars = document.querySelectorAll(".star");

            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove("bi-star");
                    star.classList.add("bi-star-fill");
                    star.style.color = "gold";
                } else {
                    star.classList.remove("bi-star-fill");
                    star.classList.add("bi-star");
                    star.style.color = "#ccc";
                }
            });

            document.getElementById("output").innerText = "Rating is: " + rating + "/5";
        }
    </script>
@endsection
