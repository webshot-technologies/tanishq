@extends('layouts.app')

@section('title', 'Product Choose')

@section('content')
    <!-- Include wishlist manager -->
    <script src="{{ asset('js/wishlist-manager.js') }}"></script>
    <!-- Wishlist Notification Popup -->
    <div id="wishlist-popup" style="position:fixed;bottom:30px;left:30px;z-index:9999;min-width:max-content;max-width:320px;padding:16px 24px;background:#fff;border-radius:8px;box-shadow:0 2px 12px rgba(0,0,0,0.15);color:#222;display:none;align-items:center;gap:10px;font-size:16px;opacity:0;transform:translateX(-60px);transition:opacity 0.4s cubic-bezier(.4,0,.2,1),transform 0.4s cubic-bezier(.4,0,.2,1);">
        <span id="wishlist-popup-icon" style="font-size:22px;"></span>
        <span id="wishlist-popup-msg"></span>
    </div>


<section class="section-productDetails min-h-100" style="min-height: 100vh;">
    <div class="container py-5">
        <div id="product-details-content">
            <div class="text-center py-5">
                <div class="spinner-border text-secondary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-auto text-center pt-4 fs-6 text-custom-dark text-dark-gray opacity-75">
                                                                     &copy; Powered By <a href="https://www.mirrar.com/" class="base-color"> mirrAR</a>


                                </div>
</section>

<script>
    const productId = @json($id);

    const categoryKey = @json($category);
    const detailsContainer = document.getElementById('product-details-content');

    fetch(`https://ar-api.mirrar.com/product/brand/2df975fa-c1b8-45a1-a7c0-f94d9a9becd8/categories/${categoryKey}/inventories`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ product_code: productId, limit: 1 })
    })
    .then(res => res.json())
    .then(data => {
        const products = data.data || [];


        const product = products.find(p =>  p.variants?.[0]?.variantSku == productId) || {};
        if (!product.productTitle) {
            detailsContainer.innerHTML = '<div class="text-danger text-center py-5">Product not found.</div>';
            return;
        }

        // Images
        let mainImg = 'https://placehold.co/400x300?text=No+Image';
        let thumbnails = [];
        const variant = product.variants && product.variants[0];
        if (variant) {
            if (variant.variantThumbnails && Object.values(variant.variantThumbnails).length > 0) {
                thumbnails = Object.values(variant.variantThumbnails);
            } else if (variant.variantImageURLs && Object.values(variant.variantImageURLs).length > 0) {
                thumbnails = Object.values(variant.variantImageURLs);
            }
            if (thumbnails.length > 0) mainImg = thumbnails[0];
        }

        let thumbsHtml = '';
        thumbnails.forEach((src, i) => {
            thumbsHtml += `<img src="${src}" class="img-thumbnail thumb-img" alt="Thumb ${i+1}" onclick="document.getElementById('mainImage').src='${src}'">`;
        });

        detailsContainer.innerHTML = `
        <div class="container">
        <div class="row g-4">
            <div class="col-md-8 mx-auto text-center">
                <img id="mainImage" src="${mainImg}" class="img-fluid productDetails_img rounded shadow-sm" alt="Product Image">
            </div>
            <div class="col-md-8 mx-auto mt-4">
                <h4 class="mb-3 fw-bold">${product.productTitle || ''}</h4>
                <div class="row g-3">
                    <div class="col-sm-6">
                       <p><strong>Brand:</strong> Tanishq</p>
                        <p><strong>Product Collection:</strong> ${product.productCollection || '-'}</p>

                          <p><strong>Gender:</strong> ${product.variants?.[0]?.variantInventory?.gender || '-'}</p>
                          <p><strong>SKU ID:</strong> ${product.variants?.[0]?.variantSku || '-'}</p>
                    </div>
                </div>
            </div>
              <div class="row mt-4 col-md-8 mx-auto" >
            <div class="col-sm-6 col-12 mb-3" >


                <button id="wishlistBtn" class="btn btn-outline-custom w-100 d-flex align-items-center justify-content-center" style="border:2px solid #8a2323;color:#8a2323;font-weight:500;"
                onclick="posthog.capture('add_to_wishlist_clicked', {sku: '${product.variants?.[0]?.variantSku || ''}', category: '${categoryKey}'})">

                    <span id="wishlistBtnIcon" style="margin-right:8px;font-size:20px;">
                        <svg class="wishlist-heart-svg border-heart" style="margin-top:-3px" width="18" height="18" viewBox="0 0 512.289 512.289" style="display:inline;">
                            <path d="M477.051,72.678c-32.427-36.693-71.68-55.467-111.787-55.467c-45.227,0-85.333,27.307-109.227,72.533
                                c-23.04-45.227-64-72.533-108.373-72.533c-40.96,0-78.507,18.773-111.787,55.467c-39.253,43.52-61.44,141.653,15.36,215.04
                                c35.84,33.28,197.12,203.093,198.827,204.8s3.413,2.56,5.973,2.56s5.12-0.853,6.827-3.413
                                c1.707-1.707,163.84-170.667,198.827-204.8C537.637,213.478,515.451,115.344,477.051,72.678z M448.891,275.771
                                c-31.573,29.867-162.987,167.253-192.853,198.827c-29.867-32.427-160.427-168.96-192.853-199.68
                                c-69.12-65.707-49.493-151.893-14.507-190.293c29.867-32.427,64-49.493,98.987-49.493c42.667,0,81.067,29.867,100.693,79.36
                                c0.853,2.56,4.267,5.12,7.68,5.12s6.827-2.56,7.68-5.12c19.627-48.64,58.027-79.36,101.547-79.36
                                c35.84,0,69.12,16.213,98.133,50.347C497.531,123.024,517.157,210.064,448.891,275.771z" fill="#42210b"/>
                        </svg>
                        <svg class="wishlist-heart-svg fill-heart" style="margin-top:-3px" width="18" height="18" viewBox="0 0 512.003 512.003" style="display:none;">
                            <path style="fill:#8a2323;" d="M256.001,105.69c19.535-49.77,61.325-87.79,113.231-87.79c43.705,0,80.225,22.572,108.871,54.44
                                c39.186,43.591,56.497,139.193-15.863,209.24c-37.129,35.946-205.815,212.524-205.815,212.524S88.171,317.084,50.619,281.579
                                C-22.447,212.495-6.01,116.919,34.756,72.339c28.919-31.629,65.165-54.44,108.871-54.44
                                C195.532,17.899,236.466,55.92,256.001,105.69"/>
                        </svg>
                    </span>
                    <span id="wishlistBtnText"> Wishlist</span>
                </button>
            </div>
            <div class="col-sm-6 col-12 " >
                <button id="tryOnButton" class="btn w-100" onclick="posthog.capture('try-on', {sku: '${product.variants?.[0]?.variantSku || ''}', category: '${categoryKey}'})"> Try on</button>
            </div>
        </div>
        </div>
        </div>
        `;

        // Old duplicate logic removed - now handled by enhanced wishlist manager below
        // Initialize wishlist manager
        const userId = "{{ session('user_id') }}";
        const idToken = "{{ session('id_token') }}";

        if (typeof initWishlistManager === 'function') {
            window.wishlistManager = initWishlistManager({
                userId: userId,
                idToken: idToken,
                syncEndpoint: '/wishlist/sync',
                syncInterval: 300000 // 5 minutes
            });
        }

        setTimeout(() => {
            // Enhanced wishlist button logic with wishlist manager
            const wishlistBtn = document.getElementById('wishlistBtn');
            const wishlistBtnIcon = document.getElementById('wishlistBtnIcon');
            const wishlistBtnText = document.getElementById('wishlistBtnText');
            const sku = product.variants?.[0]?.variantSku || '';

            function updateWishlistBtnUI(isWishlisted) {
                const borderHeart = wishlistBtnIcon.querySelector('.border-heart');
                const fillHeart = wishlistBtnIcon.querySelector('.fill-heart');
                if (isWishlisted) {
                    if (borderHeart) borderHeart.style.display = 'none';
                    if (fillHeart) fillHeart.style.display = 'inline';
                    wishlistBtnText.textContent = 'Remove from Wishlist';
                } else {
                    if (borderHeart) borderHeart.style.display = 'inline';
                    if (fillHeart) fillHeart.style.display = 'none';
                    wishlistBtnText.textContent = 'Add to Wishlist';
                }
            }

            // Wait for wishlist manager to be ready and sync initial state
            const initializeWishlistUI = () => {
                if (window.wishlistManager && sku) {
                    const isWishlisted = window.wishlistManager.isInWishlist(sku);
                    updateWishlistBtnUI(isWishlisted);
                } else {
                    setTimeout(initializeWishlistUI, 100);
                }
            };
            initializeWishlistUI();
            // Enhanced wishlist popup function
            function showWishlistPopup(type, sku) {
                const popup = document.getElementById('wishlist-popup');
                const icon = document.getElementById('wishlist-popup-icon');
                const msg = document.getElementById('wishlist-popup-msg');

                if (type === 'add') {
                    icon.innerHTML = "<svg class=\"wishlist-heart-svg fill-heart\" width=\"20\" height=\"20\" viewBox=\"0 0 512.003 512.003\" style=\"\">\n                                        <path style=\"fill:#8a2323;\" d=\"M256.001,105.69c19.535-49.77,61.325-87.79,113.231-87.79c43.705,0,80.225,22.572,108.871,54.44\n                                            c39.186,43.591,56.497,139.193-15.863,209.24c-37.129,35.946-205.815,212.524-205.815,212.524S88.171,317.084,50.619,281.579\n                                            C-22.447,212.495-6.01,116.919,34.756,72.339c28.919-31.629,65.165-54.44,108.871-54.44\n                                            C195.532,17.899,236.466,55.92,256.001,105.69\"/>\n                                    </svg>";
                    msg.textContent = `Added to wishlist! SKU: ${sku}`;
                    popup.style.background = '#fff';
                    popup.style.color = '#222';
                } else if (type === 'remove') {
                    icon.innerHTML = '🗑️';
                    msg.textContent = `Removed from wishlist! SKU: ${sku}`;
                    popup.style.background = '#fff';
                    popup.style.color = '#222';
                } else if (type === 'error') {
                    icon.innerHTML = '⚠️';
                    msg.textContent = `Error updating wishlist! SKU: ${sku}`;
                    popup.style.background = '#f8d7da';
                    popup.style.color = '#721c24';
                } else {
                    icon.innerHTML = '';
                    msg.textContent = '';
                }

                popup.style.display = 'flex';
                setTimeout(() => {
                    popup.style.opacity = '1';
                    popup.style.transform = 'translateX(0)';
                }, 10);

                const delay = type === 'error' ? 4000 : 2000;
                setTimeout(() => {
                    popup.style.opacity = '0';
                    popup.style.transform = 'translateX(-60px)';
                    setTimeout(() => {
                        popup.style.display = 'none';
                    }, 400);
                }, delay);
            }
            // Enhanced wishlist click handler with wishlist manager
            wishlistBtn.addEventListener('click', function(e) {
                e.preventDefault();

                if (!userId || !idToken || !sku) {
                    window.location.href = '/';
                    return;
                }

                // Check current wishlist state from manager
                const isCurrentlyWishlisted = window.wishlistManager ?
                    window.wishlistManager.isInWishlist(sku) : false;

                const method = isCurrentlyWishlisted ? 'DELETE' : 'POST';
                const action = isCurrentlyWishlisted ? 'remove' : 'add';
                const url = `/users/${userId}/wishlist`;

                // Optimistic update using wishlist manager
                if (window.wishlistManager) {
                    if (action === 'add') {
                        window.wishlistManager.addToWishlist(sku);
                    } else {
                        window.wishlistManager.removeFromWishlist(sku);
                    }
                }

                // Update UI immediately
                updateWishlistBtnUI(!isCurrentlyWishlisted);

                // Show popup immediately
                showWishlistPopup(action, sku);

                // API call
                fetch(url, {
                    method: method,
                    headers: {
                        'Authorization': 'Bearer ' + idToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    body: JSON.stringify({
                        sku: sku,
                        variantThumbnails: mainImg,
                        categoryKey: categoryKey,
                        productTitle: product.productTitle || '',
                    })
                })
                .then(response => {
                    const success = response.ok;
                    if (!success) {
                        throw new Error(`Failed to ${action} wishlist item`);
                    }
                    return response.json();
                })
                .then(data => {
                    // API call succeeded
                    if (window.wishlistManager) {
                        window.wishlistManager.handleApiResponse(sku, action, true);
                    }
                })
                .catch(error => {
                    console.error('Wishlist API error:', error);

                    // Revert optimistic update on error
                    if (window.wishlistManager) {
                        window.wishlistManager.handleApiResponse(sku, action, false);
                    }

                    // Revert UI changes
                    updateWishlistBtnUI(isCurrentlyWishlisted);
                    showWishlistPopup('error', sku);
                });
            });
            const tryOnButton = document.getElementById('tryOnButton');
            if (tryOnButton) {
                tryOnButton.addEventListener('click', function() {
                    // Load the SDK only when button is clicked
                    const script = document.createElement('script');
                    script.src = "https://cdn.mirrar.com/general/scripts/mirrar-ui.js";
                    script.onload = () => {
                        const options = {
                            brandId: "2df975fa-c1b8-45a1-a7c0-f94d9a9becd8",
                        };
                        const sku = product.variants?.[0]?.variantSku || '';
                        initMirrarUI(sku, options);
                    };
                    document.body.appendChild(script);
                });
            }
        }, 0);
    })
    .catch(() => {
        detailsContainer.innerHTML = '<div class="text-danger text-center py-5">Failed to load product details.</div>';
    });
</script>
<script>
document.getElementById('tryOnButton').addEventListener('click', function() {
  // Load the SDK only when button is clicked
  const script = document.createElement('script');
  script.src = "https://cdn.mirrar.com/general/scripts/mirrar-ui.js";

  script.onload = () => {
    // Replace with your actual brandId and product SKU
    const options = {
      brandId: "2df975fa-c1b8-45a1-a7c0-f94d9a9becd8",
      // Add any other options you need
    };

    // Replace 'YOUR_PRODUCT_SKU' with the actual product code
    // Use the actual variant SKU from the product data
    const sku = window.selectedProductSku || '';
    initMirrarUI(sku, options);
  };

  document.body.appendChild(script);
});
</script>

<style>
    .section-productDetails {
        background:#fef9f7;
    }
    .thumb-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        cursor: pointer;
        border-radius: 4px;
    }
    .thumb-img:hover {
        border: 2px solid #000;
    }
</style>
@endsection
