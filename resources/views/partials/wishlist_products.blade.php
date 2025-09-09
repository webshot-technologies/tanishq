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
                        <div class="position-absolute top-0 end-0 m-2 p-0 border-0 bg-transparent d-flex flex-column">
                            <button class="wishlist-btn top-0 end-0 m1-2 p-0 border-0 bg-transparent"
                                style="z-index:2;"
                                aria-label="Remove from wishlist"
                                data-product-sku="{{ $sku }}">
                                <span class="wishlist-icon-wrapper">
                                    <svg class="wishlist-heart-svg fill-heart" width="20" height="20" viewBox="0 0 512.003 512.003">
                                        <path style="fill:#8a2323;" d="M256.001,105.69c19.535-49.77,61.325-87.79,113.231-87.79c43.705,0,80.225,22.572,108.871,54.44
                                            c39.186,43.591,56.497,139.193-15.863,209.24c-37.129,35.946-205.815,212.524-205.815,212.524S88.171,317.084,50.619,281.579
                                            C-22.447,212.495-6.01,116.919,34.756,72.339c28.919-31.629,65.165-54.44,108.871-54.44
                                            C195.532,17.899,236.466,55.92,256.001,105.69"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="product-item-body">
                        <p class="product-item-id base-color">{{ $product['productTitle'] ?? '' }}</p>
                        <div class="product-item-buttons">
                            <button class="btn " style="border:2px solid #8a2323;color:#8a2323;font-weight:500;">
                                <a class="base-color text-decoration-none" href="/product/{{ $product['sku'] }}?category={{ $product['categoryKey'] ?? '' }}">View Details</a>
                            </button>
                            <button id="tryOnButton" class="btn btn-outline-secondary try-on-btn" data-sku="{{ $product['sku'] }}" style="border:2px solid #8a2323;background:#8a2323;color:#fff;font-weight:500;">Try On</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
