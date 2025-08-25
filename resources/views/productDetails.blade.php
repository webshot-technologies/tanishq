@extends('layouts.app')

@section('title', 'Product Choose')

@section('content')
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
    body: JSON.stringify({ product_code: productId, limit: 10000 })
    })
    .then(res => res.json())
    .then(data => {
        const products = data.data || [];
        console.log(products);

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
                        <p><strong>Product id:</strong> ${product.productId || '-'}</p>
                          <p><strong>Gender:</strong> ${product.variants?.[0]?.variantInventory?.gender || '-'}</p>
                          <p><strong>SKU ID:</strong> ${product.variants?.[0]?.variantSku || '-'}</p>
                    </div>
                </div>
            </div>
              <div class="row mt-4 col-md-8 mx-auto">
            <div class="col-6">
                <button id="wishlistBtn" class="btn btn-outline-custom w-100 d-flex align-items-center justify-content-center" style="border:2px solid #8a2323;color:#8a2323;font-weight:500;">
                    <span id="wishlistBtnIcon" style="margin-right:8px;font-size:20px;">&#9825;</span>
                    <span id="wishlistBtnText">Add to Wishlist</span>
                </button>
            </div>
            <div class="col-6">
                <button id="tryOnButton" class="btn w-100" style="background:#8a2323;color:#fff;font-weight:500;">Try it on</button>
            </div>
        </div>
        </div>
        </div>
        `;

        // Attach event listener after rendering
        setTimeout(() => {
            // Wishlist button logic
            const wishlistBtn = document.getElementById('wishlistBtn');
            const wishlistBtnIcon = document.getElementById('wishlistBtnIcon');
            const wishlistBtnText = document.getElementById('wishlistBtnText');
            const sku = product.variants?.[0]?.variantSku || '';
            const userId = "{{ session('user_id') }}";
            const idToken = "{{ session('id_token') }}";
            let isWishlisted = false;
            // Always start as not wishlisted
            function updateWishlistBtnUI() {
                if (isWishlisted) {
                    wishlistBtnIcon.innerHTML = '&#10084;'; // filled heart
                    wishlistBtnText.textContent = 'Remove from Wishlist';
                } else {
                    wishlistBtnIcon.innerHTML = '&#9825;'; // border heart
                    wishlistBtnText.textContent = 'Add to Wishlist';
                }
            }
            updateWishlistBtnUI();
            function showWishlistPopup(type, sku) {
                const popup = document.getElementById('wishlist-popup');
                const icon = document.getElementById('wishlist-popup-icon');
                const msg = document.getElementById('wishlist-popup-msg');
                if (type === 'add') {
                    icon.innerHTML = '❤️';
                    msg.textContent = `Added to wishlist! SKU: ${sku}`;
                } else if (type === 'remove') {
                    icon.innerHTML = '🗑️';
                    msg.textContent = `Removed from wishlist! SKU: ${sku}`;
                } else {
                    icon.innerHTML = '';
                    msg.textContent = '';
                }
                popup.style.display = 'flex';
                setTimeout(() => {
                    popup.style.opacity = '1';
                    popup.style.transform = 'translateX(0)';
                }, 10);
                setTimeout(() => {
                    popup.style.opacity = '0';
                    popup.style.transform = 'translateX(-60px)';
                    setTimeout(() => {
                        popup.style.display = 'none';
                    }, 400);
                }, 2000);
            }
            wishlistBtn.addEventListener('click', function() {
                if (!userId || !idToken || !sku) {
                    alert('Please log in to manage wishlist items');
                    return;
                }
                const method = isWishlisted ? 'DELETE' : 'POST';
                const url = `/users/${userId}/wishlist`;
                // Toggle UI immediately
                isWishlisted = !isWishlisted;
                updateWishlistBtnUI();
                showWishlistPopup(method === 'POST' ? 'add' : 'remove', sku);
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
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || `Failed to ${method === 'POST' ? 'add to' : 'remove from'} wishlist`)
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    // Update localStorage
                    let wishlist = [];
                    try {
                        wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
                    } catch (e) {}
                    if (method === 'POST') {
                        if (!wishlist.includes(sku)) wishlist.push(sku);
                    } else {
                        wishlist = wishlist.filter(id => id !== sku);
                    }
                    localStorage.setItem('wishlist', JSON.stringify(wishlist));
                })
                .catch(error => {
                    // Revert UI on error
                    isWishlisted = !isWishlisted;
                    updateWishlistBtnUI();
                    alert('Error: ' + error.message);
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
