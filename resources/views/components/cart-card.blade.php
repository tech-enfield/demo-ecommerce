<div class="mini-cart">
    @forelse ($products as $item)
        <div class="mini-cart-item">
            <a href="{{ route('product', $item->slug) }}" class="mini-cart-link">

                <div class="mini-cart-img">
                    <img src="{{ count($item->images) > 0
                        ? asset('storage/' . $item->images[0]->path)
                        : asset('assets/img/featured-products/featured-product-1.webp') }}"
                        alt="{{ $item->product->name }}">
                </div>

                <div class="mini-cart-details">
                    <h6 class="mini-cart-title">
                        {{ $item->product->name }} - {{ $item->title }}
                    </h6>

                    @if ($item->on_sale)
                        <span class="mini-cart-old-price">Rs {{ $item->price }}</span>
                        <span class="mini-cart-price">Rs {{ $item->sale_price }}</span>
                    @else
                        <span class="mini-cart-price">Rs {{ $item->price }}</span>
                    @endif
                </div>

            </a>
        </div>
    @empty
        <p class="text-muted text-center">Your cart is empty</p>
    @endforelse
</div>
<style>
    .mini-cart {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .mini-cart-item {
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    .mini-cart-link {
        display: flex;
        gap: 12px;
        text-decoration: none;
        color: inherit;
    }

    .mini-cart-img img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 6px;
    }

    .mini-cart-details {
        flex: 1;
    }

    .mini-cart-title {
        font-size: 14px;
        margin: 0 0 5px;
        line-height: 1.3;
    }

    .mini-cart-price {
        font-weight: 600;
    }

    .mini-cart-old-price {
        text-decoration: line-through;
        color: red;
        font-size: 13px;
        margin-right: 6px;
    }
</style>
