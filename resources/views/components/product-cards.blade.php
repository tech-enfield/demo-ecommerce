@foreach ($products->items() as $index => $item)
    <div class="product-card">
        <div class="card-content">
            <div class="">
                <a href="{{ route('product', $item->slug) }}" style="color: inherit;">
                    @if (count($item->images) > 0)
                        <img src="{{ asset('storage/' . $item->images[0]->path) }}" alt="{{ $item->images[0]->alt }}"
                            title="{{ $item->images[0]->alt }}">
                    @else
                        <img src="{{ asset('assets/img/similar-products/sp-1.png') }}" alt="Product">
                    @endif
                    <h4 class="product-title">{{ $item->name }}</h4>
                    <p class="product-desc">{{ $item->short_description }}</p>
                    @if ($item->on_sale == 1)
                        <h6 class="sp-old-price" style="text-decoration:line-through; color: red;">Rs
                            <span>{{ $item->price }}</span>
                        </h6>
                        <h5 class="sp-price">Rs <span>{{ $item->sale_price }}</span></h5>
                    @else
                        <h5 class="sp-price">Rs <span>{{ $item->price }}</span></h5>
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
            </div>
            <!-- CHANGED: Replaced View Details with Add to Cart and Add to Wishlist -->
            <div class="product-buttons">
                <button class="add-to-cart-button">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
                <button class="add-to-wishlist wishlist">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-heart" viewBox="0 0 16 16">
                        <path
                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <style>
        .sp-price {
            color: var(--primary-color);
            font-size: 18px;
            font-weight: 700;
        }
    </style>
@endforeach
@if ($products->hasMorePages())
    <div class="pagination-marker" data-next-page-url="{{ $products->nextPageUrl() }}">
    </div>
@endif
