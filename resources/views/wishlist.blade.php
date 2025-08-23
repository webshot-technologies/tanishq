@extends('layouts.app')



@section('title', 'Wishlist')
@section('content')
<section class="" style="min-height:100vh; background-color: #fef9f7;" >
<div class="container py-4">
    <h1 class="section-title base-color text-center">My Wishlist</h1>
    <p class="section-subtitle text-center">Your favorite products are here</p>
</div>

<div class="container">
    <div class="d-flex justify-content-end mb-3">
        @if(!empty($products) && count($products) > 0)
            <button id="clear-all-wishlist" class="btn btn-danger">Clear All</button>
        @endif
    </div>
    <div id="wishlist-grids-container">
        @if(empty($products) || count($products) === 0)
            <div class="text-center py-5">No products found in wishlist.</div>
        @else
            <div class="row">
                @foreach($products as $product)
                    @php
                        $imgSrc = !empty($product['variantThumbnails']) ? $product['variantThumbnails'] : 'https://placehold.co/300x220?text=No+Image';
                        $sku = $product['sku'] ?? '';
                    @endphp
                    <div class="col-lg-3 col-md-4 col-6 mb-4 wishlist-product-card" data-sku="{{ $sku }}">
                        <div class="product-item-card">
                            <div class="product-image-wrapper position-relative">
                                <img src="{{ $imgSrc }}" class="default-image" alt="{{ $product['productCollection'] ?? '' }}">
                                <button class="wishlist-btn position-absolute top-0 end-0 m-2 p-0 border-0 bg-transparent"
                                        style="z-index:2;"
                                        aria-label="Remove from wishlist"
                                        data-product-sku="{{ $sku }}">
                                    <span class="wishlist-icon-wrapper">
                                        <svg class="wishlist-heart-svg fill-heart" width="20" height="20" viewBox="0 0 512.003 512.003">
                                            <path style="fill:#E8594B;" d="M256.001,105.69c19.535-49.77,61.325-87.79,113.231-87.79c43.705,0,80.225,22.572,108.871,54.44
                                                c39.186,43.591,56.497,139.193-15.863,209.24c-37.129,35.946-205.815,212.524-205.815,212.524S88.171,317.084,50.619,281.579
                                                C-22.447,212.495-6.01,116.919,34.756,72.339c28.919-31.629,65.165-54.44,108.871-54.44
                                                C195.532,17.899,236.466,55.92,256.001,105.69"/>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                            <div class="product-item-body">
                                <p class="product-item-id base-color">{{ $product['productTitle'] ?? '' }}</p>
                                <div class="product-item-buttons">
                                    <button class="btn w-100" style="border:2px solid #8a2323;color:#8a2323;font-weight:500;">
                                        <a class="base-color text-decoration-none" href="/product/${product.productId}?category=${categoryKey}">View Details</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
  <div class="mt-auto text-center py-4 fs-6 text-custom-dark text-dark-gray opacity-75">
                                                                        &copy; Powered By <a href="https://www.mirrar.com/" class="base-color"> mirrAR</a>


                                    </div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Remove product from wishlist
    document.querySelectorAll('.wishlist-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const card = this.closest('.wishlist-product-card');
            const sku = this.getAttribute('data-product-sku');
            if (!sku) return;
            // Send AJAX request to remove from wishlist
            fetch(`/users/${"{{ session('user_id') }}"}/wishlist`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + "{{ session('id_token') }}",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                },
                body: JSON.stringify({ sku: sku })
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to remove from wishlist');
                return response.json();
            })
            .then(() => {
                card.style.display = 'none';
            })
            .catch(error => {
                alert('Error: ' + error.message);
            });
        });
    });

    // Clear all wishlist
    const clearAllBtn = document.getElementById('clear-all-wishlist');
    if (clearAllBtn) {
        clearAllBtn.addEventListener('click', function() {
            const cards = document.querySelectorAll('.wishlist-product-card');
            const skus = Array.from(cards).map(card => card.getAttribute('data-sku')).filter(Boolean);
            if (skus.length === 0) return;
            Promise.all(skus.map(sku => {
                return fetch(`/users/${"{{ session('user_id') }}"}/wishlist`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + "{{ session('id_token') }}",
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    body: JSON.stringify({ sku: sku })
                })
                .then(response => response.ok ? response.json() : null);
            })).then(() => {
                cards.forEach(card => card.style.display = 'none');
            });
        });
    }
});
</script>
@endpush

</section>
@endsection

