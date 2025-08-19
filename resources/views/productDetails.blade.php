@extends('layouts.app')

@section('title', 'Product Choose')

@section('content')


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
        const product = products.find(p => p.productId == productId) || {};
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
                <button class="btn btn-outline-custom w-100 d-flex align-items-center justify-content-center" style="border:2px solid #8a2323;color:#8a2323;font-weight:500;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#8a2323" viewBox="0 0 24 24" style="margin-right:8px;"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    Wishlist
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
