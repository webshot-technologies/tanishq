@extends('layouts.app')

@section('title', 'Product List')
@section('content')

    <!-- Include wishlist manager -->
    <script src="{{ asset('js/wishlist-manager.js') }}"></script>
    <!-- Wishlist Notification Popup -->
    <div id="wishlist-popup" style="position:fixed;bottom:30px;left:30px;z-index:9999;background:#fff;border-radius:8px;box-shadow:0 2px 12px rgba(0,0,0,0.15);color:#222;display:none;align-items:center;gap:10px;font-size:16px;opacity:0;transform:translateX(-60px);transition:opacity 0.4s cubic-bezier(.4,0,.2,1),transform 0.4s cubic-bezier(.4,0,.2,1);">
        <span id="wishlist-popup-icon"></span>
        <span id="wishlist-popup-msg"></span>
    </div>
    @php

        // dd(session('user_id'));
    @endphp
    {{-- New sidebar filter section --}}
    <div class="sidebar-filter-overlay" id="sidebar-filter-overlay">
        <div class="sidebar-filter-content">
            <div class="sidebar-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">Filter By</h5>
                <button type="button" class="close-sidebar-btn" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <hr>



            <div class="info-box">
                <div class="title">
                    <span class="icon">i</span>
                    Filters Not Configured
                </div>
                <div class="description">
                    Filter functionality is not available in this demo. All search results are displayed without filtering.
                </div>
            </div>
            <div class="filter-options-container">
                {{-- This is where your filter options will go, as per the screenshot --}}


                <div class="filter-group">
                    <!-- Metal Accordion -->
                    <div class="accordion-item my-3">
                        <h2 class="accordion-header d-flex justify-between" id="headingMetal">
                            <button class="accordion-button collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseMetal" aria-expanded="false" aria-controls="collapseMetal">
                                <span class="d-block">
                                Metal
                                </span>

                                <img src="{{ asset('image/arrow.png') }}" alt="arrow" class="accordion-arrow ms-2 d-block" >

                            </button>
                            {{-- <img src={{asset('image/arrow.png')}} style="width:8px" alt="Metal" class="accordion-image"> --}}
                        </h2>
                        <div id="collapseMetal" class="accordion-collapse collapse  mt-3" aria-labelledby="headingMetal"
                            data-bs-parent="#sidebar-accordion">
                            <div class="accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Gold" id="checkGold">
                                    <label class="form-check-label" for="checkGold">Gold</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Silver" id="checkSilver">
                                    <label class="form-check-label" for="checkSilver">Silver</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Platinum" id="checkPlatinum">
                                    <label class="form-check-label" for="checkPlatinum">Platinum</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Titanium" id="checkTitanium">
                                    <label class="form-check-label" for="checkTitanium">Titanium</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Stainless Steel"
                                        id="checkStainlessSteel">
                                    <label class="form-check-label" for="checkStainlessSteel">Stainless Steel</label>
                                </div>
                                <!-- ... more types ... -->
                            </div>
                        </div>
                    </div>

                    <!-- Purity Accordion -->
                    <div class="accordion-item my-3">
                        <h2 class="accordion-header d-flex justify-between" id="headingPurity">
                            <button class="accordion-button collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapsePurity" aria-expanded="false" aria-controls="collapsePurity">
                               <span class="d-block">
                                Purity
                        </span>
                                <img src={{asset('image/arrow.png')}} style="width:8px" alt="Metal" class="accordion-arrow ms-2 d-block">
                            </button>

                        </h2>
                        <div id="collapsePurity" class="accordion-collapse collapse mt-3" aria-labelledby="headingPurity"
                            data-bs-parent="#sidebar-accordion">
                            <div class="accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="14" id="check14">
                                    <label class="form-check-label" for="check14">14</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="18" id="check18">
                                    <label class="form-check-label" for="check18">18</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="22" id="check22">
                                    <label class="form-check-label" for="check22">22</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="95" id="check95">
                                    <label class="form-check-label" for="check95">95</label>
                                </div>
                                <!-- ... more types ... -->
                            </div>
                        </div>
                    </div>
                    <!-- Occasion Accordion -->
                    <div class="accordion-item my-3">
                        <h2 class="accordion-header d-flex justify-content-between" id="headingOccasion">
                            <button class="accordion-button collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOccasion" aria-expanded="false"
                                aria-controls="collapseOccasion">
                                <span class="d-block">
                                    Occasion
                                </span>
                                <img src="{{ asset('image/arrow.png') }}" alt="arrow" class="accordion-arrow ms-2 d-block" >
                            </button>

                        </h2>
                        <div id="collapseOccasion" class="accordion-collapse collapse  mt-3"
                            aria-labelledby="headingOccasion" data-bs-parent="#sidebar-accordion">
                            <div class="accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Bridal Wear"
                                        id="checkBridalWear">
                                    <label class="form-check-label" for="checkBridalWear">Bridal Wear</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Casual Wear"
                                        id="checkCasualWear">
                                    <label class="form-check-label" for="checkCasualWear">Casual Wear</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Modern Wear"
                                        id="checkModernWear">
                                    <label class="form-check-label" for="checkModernWear">Modern Wear</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Office Wear"
                                        id="checkOfficeWear">
                                    <label class="form-check-label" for="checkOfficeWear">Office Wear</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Traditional and Ethnic Wear"
                                        id="checkTraditionalEthnicWear">
                                    <label class="form-check-label" for="checkTraditionalEthnicWear">Traditional and
                                        Ethnic Wear</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                {{-- ... and so on for Gender, Purity, Occasion, etc. --}}
            </div>

            <div class="sidebar-footer d-flex justify-content-between mt-auto">
                {{-- <button class="btn btn-link clear-filters-btn">Clear Filters</button>
                <button class="btn btn-dark apply-filters-btn">Show Results (2,740)</button> --}}
            </div>
        </div>
    </div>

    {{-- Main content wrapper for blur effect --}}
    <div class="main-content-wrapper" id="main-content-wrapper">
        <section class="product-listing-section">
            <div class="container mb-4">
                <h2 class="section-title text-center">Shop by Categories</h2>
                <p class="section-subtitle text-center">Browse through your favorite products. We've got them all</p>
            </div>

            <div class="container">
                <div class="filter-bar container d-flex align-items-center justify-content-between mb-3">
    <button class="filter-btn mr-2">
        <img src="{{ asset('image/filter.svg') }}" class="mr-2" alt="">
        Filter
    </button>

    <!-- Search Wrapper -->
    {{-- <div class="search-wrapper">
        <input type="text" class="search-input" placeholder="Search by SKU Code, Product Name..." />
        <button class="search-btn ">
<svg height="32" fill="#42210b" viewBox="0 0 24 24" width="32" xmlns="http://www.w3.org/2000/svg"><g id="Layer_2" data-name="Layer 2"><path d="m12 23.5a11.5 11.5 0 1 1 11.5-11.5 11.5131 11.5131 0 0 1 -11.5 11.5zm0-22a10.5 10.5 0 1 0 10.5 10.5 10.5118 10.5118 0 0 0 -10.5-10.5z"/></g><g id="Layer_3" data-name="Layer 3"><path fill="000" d="m17 17.5a.5.5 0 0 0 .3535-.8535l-2.213-2.2135a4.8265 4.8265 0 0 0 1.11-3.058 4.875 4.875 0 1 0 -4.875 4.875 4.8273 4.8273 0 0 0 3.0585-1.11l2.213 2.2134a.4981.4981 0 0 0 .353.1466zm-9.5-6.125a3.875 3.875 0 1 1 6.6281 2.7215c-.0057.0052-.0132.0069-.0187.0124s-.0073.0131-.0125.0188a3.8712 3.8712 0 0 1 -6.5969-2.7527z"/></g></svg>
        </button>
    </div> --}}
</div>

                <div class="category-tabs my-5" id="category-tabs">

                        @php
                            $allCategories = [
                                'chains' => 'Chains',
                                'earrings' => 'Earrings',
                                'necklaces' => 'Necklaces',
                                'rings' => 'Rings',
                                'pendants' => 'Pendants',
                                'bracelets' => 'Bracelets',
                                'mangalsutras' => 'Mangalsutras',
                                'sets' => 'Sets',
                            ];
                            $showCategories = isset($categoryPresence) && is_array($categoryPresence) && count($categoryPresence) > 0
                                ? $categoryPresence
                                : array_keys($allCategories);
                        @endphp
                        @foreach ($showCategories as $catKey)
                            @if(isset($allCategories[$catKey]))
                                <button class="category-tab" data-category="{{ $catKey }}"  onclick="posthog.capture('category-selected', { category: '{{ $catKey }}', page: 'plp' })">{{ $allCategories[$catKey] }}</button>
                            @endif
                        @endforeach
                    </div>

                <div id="product-grids-container">
                    <!-- Pendant Sets Grid (Active by default) -->
                </div>
            </div>

            <div class="mt-auto text-center fw-200 pt-4 fs-6 text-custom-dark text-dark-gray opacity-75">
                &copy; Powered By <a href="https://www.mirrar.com/" class="base-color"> mirrAR</a>


            </div>

        </section>
    </div>


@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtn = document.querySelector('.filter-btn');
            const sidebarOverlay = document.getElementById('sidebar-filter-overlay');
            const closeSidebarBtn = document.querySelector('.close-sidebar-btn');
            const clearFiltersBtn = document.querySelector('.clear-filters-btn');
            const applyFiltersBtn = document.querySelector('.apply-filters-btn');
            const categoryTabs = document.querySelectorAll('.category-tab');
            const productGrids = document.querySelectorAll('.product-grid-container');
            const searchInput = document.querySelector('.search-input');
            const heartIcons = document.querySelectorAll('.heart-icon');

            // 1. Sidebar Functionality
            filterBtn.addEventListener('click', function() {
                sidebarOverlay.classList.add('active');
            });

            closeSidebarBtn.addEventListener('click', function() {
                sidebarOverlay.classList.remove('active');
            });

            // Close when clicking outside the sidebar content
            sidebarOverlay.addEventListener('click', function(event) {
                if (event.target.id === 'sidebar-filter-overlay') {
                    sidebarOverlay.classList.remove('active');
                }
            });

            const searchWrapper = document.querySelector('.search-wrapper');


            if (clearFiltersBtn) {
                clearFiltersBtn.addEventListener('click', function() {
                    // Reset filter form inputs
                    const filterForm = sidebarOverlay.querySelector('.filter-options-container');
                    filterForm.querySelectorAll('input').forEach(input => {
                        if (input.type === 'checkbox' || input.type === 'radio') input.checked = false;
                        if (input.type === 'range') input.value = input.min;
                    });
                    filterForm.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

                    // console.log('Filters cleared!');
                    // You would typically make an API call to get unfiltered products here
                });
            }

            if (applyFiltersBtn) {
                applyFiltersBtn.addEventListener('click', function() {
                    // Collect filter data and send to backend or filter on frontend
                    // console.log('Filters applied!');
                    sidebarOverlay.classList.remove('active');
                    // An AJAX call to filter products would go here
                });
            }

            // 2. Category Tabs Functionality
            categoryTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    categoryTabs.forEach(t => t.classList.remove('active'));
                    productGrids.forEach(grid => grid.classList.remove('active'));
                    this.classList.add('active');
                    const targetCategory = this.dataset.category;
                    const targetGrid = document.getElementById(`${targetCategory}-grid`);
                    if (targetGrid) {
                        targetGrid.classList.add('active');
                    }
                });
            });

            // 3. Initialize wishlist from backend data (for server-side pre-populated data)
            @if(isset($wishlistProductIds) && is_array($wishlistProductIds))
                const backendWishlistSkus = @json($wishlistProductIds);
                // Pre-populate localStorage if wishlist manager is not available yet
                if (!window.wishlistManager && backendWishlistSkus.length > 0) {
                    const existingWishlist = JSON.parse(localStorage.getItem('wishlist') || '{}');
                    backendWishlistSkus.forEach(sku => {
                        existingWishlist[sku] = true;
                    });
                    localStorage.setItem('wishlist', JSON.stringify(existingWishlist));
                }
            @endif

            // Function to sync UI with current wishlist state
            function syncWishlistUI() {
                document.querySelectorAll('.wishlist-btn').forEach(btn => {
                    const sku = btn.getAttribute('data-variant-sku') ||
                               btn.closest('.product-item-card')?.querySelector('.try-on-btn')?.getAttribute('data-sku');
                    const borderHeart = btn.querySelector('.border-heart');
                    const fillHeart = btn.querySelector('.fill-heart');

                    if (sku) {
                        const isWishlisted = window.wishlistManager ?
                            window.wishlistManager.isInWishlist(sku) : false;
                        updateHeartUI(borderHeart, fillHeart, isWishlisted);
                    }
                });
            }

            // Initial UI sync after a short delay to ensure wishlist manager is loaded
            setTimeout(syncWishlistUI, 100);

            // 4. Heart Icon Functionality
            // heartIcons.forEach(icon => {
            //     icon.addEventListener('click', function(event) {
            //         event.stopPropagation();
            //         const btn = this.closest('.wishlist-btn');
            //         const skuBtn = btn.closest('.product-item-card').querySelector('.try-on-btn');
            //         const sku = skuBtn ? skuBtn.getAttribute('data-sku') : null;
            //         const borderHeart = btn.querySelector('.border-heart');
            //         const fillHeart = btn.querySelector('.fill-heart');
            //         const isFavorited = fillHeart.style.display === 'inline';
            //         if (!sku) return;
            //         if (isFavorited) {
            //             // Remove from wishlist
            //             borderHeart.style.display = 'inline';
            //             fillHeart.style.display = 'none';
            //             wishlistSkus = wishlistSkus.filter(id => id !== sku);
            //         } else {
            //             // Add to wishlist
            //             borderHeart.style.display = 'none';
            //             fillHeart.style.display = 'inline';
            //             if (!wishlistSkus.includes(sku)) wishlistSkus.push(sku);
            //         }
            //         localStorage.setItem('wishlist', JSON.stringify(wishlistSkus));
            //     });
            // });

            // 5. Search Functionality (AJAX)

            const searchBtnEl = document.querySelector('.search-btn');
            searchBtnEl.addEventListener('click', function(e) {
                e.preventDefault();
                const searchTerm = searchInput.value.trim();
                if (!searchTerm) return;
                // Get active category
                const activeTab = document.querySelector('.category-tab.active');
                const categoryKey = activeTab ? activeTab.dataset.category : '';
                const gridsContainer = document.getElementById('product-grids-container');
                gridsContainer.innerHTML = '<div class="text-center py-5"><img src="{{ asset('/image/logo.png') }}" alt="Loading..." style="width:60px;height:60px;" /></div>';
                // AJAX call to fetch products by search
                fetch(`https://ar-api.mirrar.com/product/brand/2df975fa-c1b8-45a1-a7c0-f94d9a9becd8/categories/${encodeURIComponent(categoryKey)}/inventories`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        limit: 20,
                        product_code: searchTerm,
                        filter_field: {
                            page: 1,
                            isSetOnly: [false]
                        }
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const products = data.data || [];
                    if (products.length === 0) {
                        gridsContainer.innerHTML = '<div class="text-center py-5">No products found.</div>';
                        return;
                    }
                    let wishlistSkus = [];
                    if (window.wishlistManager) {
                        wishlistSkus = window.wishlistManager.getWishlistSkus();
                    }

                    let html = '<div class="row">';
                    products.forEach(product => {
                        const productId = product.productId || product.sku;
                        const variantSku = product.variants?.[0]?.variantSku || productId;
                        const isWishlisted = window.wishlistManager ?
                            window.wishlistManager.isInWishlist(variantSku) :
                            wishlistSkus.includes(variantSku);
                        let imgSrc = 'https://placehold.co/300x220?text=No+Image';
                        const variant = product.variants?.[0];
                        if (variant) {
                            if (variant.variantThumbnails && Object.values(variant.variantThumbnails).length > 0) {
                                imgSrc = Object.values(variant.variantThumbnails)[0];
                            } else if (variant.variantImageURLs && Object.values(variant.variantImageURLs).length > 0) {
                                imgSrc = Object.values(variant.variantImageURLs)[0];
                            }
                        }
                        html += `
                            <div class="col-lg-3 col-md-4 col-6 mb-4">
                                <div class="product-item-card">
                                    <div class="product-image-wrapper position-relative">
                                        <img src="${imgSrc}" class="default-image" alt="${product.productCollection}">
                                        <button class="wishlist-btn position-absolute top-0 end-0 m-2 p-0 border-0 bg-transparent"
                                                style="z-index:2;"
                                                aria-label="Add to wishlist"
                                                data-product-id="${productId}"
                                                data-variant-sku="${variantSku}"
                                                onclick="posthog.capture(${isWishlisted ? '\'remove_from_wishlist_clicked\'' : '\'add_to_wishlist_clicked\''}, {sku: '${variantSku}', category: '${categoryKey}'})">
                                            <span class="wishlist-icon-wrapper">
                                                <svg class="wishlist-heart-svg border-heart" width="20" height="20" viewBox="0 0 512.289 512.289"
                                                     style="${isWishlisted ? 'display:none;' : ''}">
                                                    <path d="M477.051,72.678c-32.427-36.693-71.68-55.467-111.787-55.467c-45.227,0-85.333,27.307-109.227,72.533
                                                        c-23.04-45.227-64-72.533-108.373-72.533c-40.96,0-78.507,18.773-111.787,55.467c-39.253,43.52-61.44,141.653,15.36,215.04
                                                        c35.84,33.28,197.12,203.093,198.827,204.8s3.413,2.56,5.973,2.56s5.12-0.853,6.827-3.413
                                                        c1.707-1.707,163.84-170.667,198.827-204.8C537.637,213.478,515.451,115.344,477.051,72.678z M448.891,275.771
                                                        c-31.573,29.867-162.987,167.253-192.853,198.827c-29.867-32.427-160.427-168.96-192.853-199.68
                                                        c-69.12-65.707-49.493-151.893-14.507-190.293c29.867-32.427,64-49.493,98.987-49.493c42.667,0,81.067,29.867,100.693,79.36
                                                        c0.853,2.56,4.267,5.12,7.68,5.12s6.827-2.56,7.68-5.12c19.627-48.64,58.027-79.36,101.547-79.36
                                                        c35.84,0,69.12,16.213,98.133,50.347C497.531,123.024,517.157,210.064,448.891,275.771z" fill="#111"/>
                                                </svg>
                                                <svg class="wishlist-heart-svg fill-heart" width="20" height="20" viewBox="0 0 512.003 512.003"
                                                     style="${isWishlisted ? '' : 'display:none;'}">
                                                    <path style="fill:#E8594B;" d="M256.001,105.69c19.535-49.77,61.325-87.79,113.231-87.79c43.705,0,80.225,22.572,108.871,54.44
                                                        c39.186,43.591,56.497,139.193-15.863,209.24c-37.129,35.946-205.815,212.524-205.815,212.524S88.171,317.084,50.619,281.579
                                                        C-22.447,212.495-6.01,116.919,34.756,72.339c28.919-31.629,65.165-54.44,108.871-54.44
                                                        C195.532,17.899,236.466,55.92,256.001,105.69"/>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="product-item-body">
                                        <p class="product-item-id base-color">${product.productTitle || ''}</p>
                                        <div class="product-item-buttons">
                                            <button class="btn" style="border:2px solid #8a2323;color:#8a2323;font-weight:500;" onclick="posthog.capture('view-details', {variantSku: '${product.variants?.[0]?.variantSku || ''}', categoryKey: '${categoryKey}'})">
                                                <a class="base-color text-decoration-none" href="/product/${product.variants?.[0]?.variantSku }?category=${categoryKey}"> View Details </a>
                                            </button>
                                            <button class="btn btn-outline-secondary try-on-btn" data-sku="${product.variants?.[0]?.variantSku || ''}" style="background:#8a2323;color:#fff;font-weight:500;" onclick="posthog.capture('try-on', {variantSku: '${product.variants?.[0]?.variantSku || ''}', category: '${categoryKey}', page:'plp'})">Try On</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    html += '</div>';
                    gridsContainer.innerHTML = html;

                    // Ensure wishlist manager is ready before attaching listeners to search results
                    if (window.wishlistManager) {
                        attachWishlistListeners();
                        setTimeout(() => {
                            updateAllWishlistButtons();
                        }, 100);
                    } else {
                        const waitForManagerSearch = () => {
                            if (window.wishlistManager) {
                                attachWishlistListeners();
                                setTimeout(() => {
                                    updateAllWishlistButtons();
                                }, 100);
                            } else {
                                setTimeout(waitForManagerSearch, 50);
                            }
                        };
                        waitForManagerSearch();
                    }
                })
                .catch(() => {
                    gridsContainer.innerHTML = '<div class="text-center py-5 text-danger">Failed to load products.</div>';
                });
            });

            // const searchBtnEl = document.querySelector('.search-btn');
            // searchBtnEl.addEventListener('click', function(e) {
            //     e.preventDefault();
            //     const searchTerm = searchInput.value.trim();
            //     if (!searchTerm) return;
            //     // Get active category
            //     const activeTab = document.querySelector('.category-tab.active');
            //     const categoryKey = activeTab ? activeTab.dataset.category : '';
            //     const gridsContainer = document.getElementById('product-grids-container');
            //     gridsContainer.innerHTML = '<div class="text-center py-5"><img src="{{ asset('/image/logo.png') }}" alt="Loading..." style="width:60px;height:60px;" /></div>';
            //     // AJAX call to fetch products by search
            //     fetch(`https://ar-api.mirrar.com/product/brand/2df975fa-c1b8-45a1-a7c0-f94d9a9becd8/categories/${encodeURIComponent(categoryKey)}/inventories`, {
            //         method: 'POST',
            //         headers: {
            //             'Content-Type': 'application/json',
            //         },
            //         body: JSON.stringify({
            //             limit: 20,
            //             product_code: searchTerm,
            //             filter_field: {
            //                 page: 1,
            //                 isSetOnly: [false]
            //             }
            //         })
            //     })
            //     .then(response => response.json())
            //     .then(data => {
            //         const products = data.data || [];
            //         if (products.length === 0) {
            //             gridsContainer.innerHTML = '<div class="text-center py-5">No products found.</div>';
            //             return;
            //         }
            //         let wishlistSkus = [];
            //         try {
            //             wishlistSkus = JSON.parse(localStorage.getItem('wishlist')) || [];
            //         } catch (e) {}
            //         let html = '<div class="row">';
            //         products.forEach(product => {
            //             const productId = product.productId || product.sku;
            //             const isWishlisted = wishlistSkus.includes(productId);
            //             let imgSrc = 'https://placehold.co/300x220?text=No+Image';
            //             const variant = product.variants?.[0];
            //             if (variant) {
            //                 if (variant.variantThumbnails && Object.values(variant.variantThumbnails).length > 0) {
            //                     imgSrc = Object.values(variant.variantThumbnails)[0];
            //                 } else if (variant.variantImageURLs && Object.values(variant.variantImageURLs).length > 0) {
            //                     imgSrc = Object.values(variant.variantImageURLs)[0];
            //                 }
            //             }
            //             html += `
            //                 <div class="col-lg-3 col-md-4 col-6 mb-4">
            //                     <div class="product-item-card">
            //                         <div class="product-image-wrapper position-relative">
            //                             <img src="${imgSrc}" class="default-image" alt="${product.productCollection}">
            //                             <button class="wishlist-btn position-absolute top-0 end-0 m-2 p-0 border-0 bg-transparent"
            //                                     style="z-index:2;"
            //                                     aria-label="Add to wishlist"
            //                                     data-product-id="${productId}">
            //                                 <span class="wishlist-icon-wrapper">
            //                                     <svg class="wishlist-heart-svg border-heart" width="20" height="20" viewBox="0 0 512.289 512.289"
            //                                          style="${isWishlisted ? 'display:none;' : ''}">
            //                                         <path d="M477.051,72.678c-32.427-36.693-71.68-55.467-111.787-55.467c-45.227,0-85.333,27.307-109.227,72.533
            //                                             c-23.04-45.227-64-72.533-108.373-72.533c-40.96,0-78.507,18.773-111.787,55.467c-39.253,43.52-61.44,141.653,15.36,215.04
            //                                             c35.84,33.28,197.12,203.093,198.827,204.8s3.413,2.56,5.973,2.56s5.12-0.853,6.827-3.413
            //                                             c1.707-1.707,163.84-170.667,198.827-204.8C537.637,213.478,515.451,115.344,477.051,72.678z M448.891,275.771
            //                                             c-31.573,29.867-162.987,167.253-192.853,198.827c-29.867-32.427-160.427-168.96-192.853-199.68
            //                                             c-69.12-65.707-49.493-151.893-14.507-190.293c29.867-32.427,64-49.493,98.987-49.493c42.667,0,81.067,29.867,100.693,79.36
            //                                             c0.853,2.56,4.267,5.12,7.68,5.12s6.827-2.56,7.68-5.12c19.627-48.64,58.027-79.36,101.547-79.36
            //                                             c35.84,0,69.12,16.213,98.133,50.347C497.531,123.024,517.157,210.064,448.891,275.771z" fill="#111"/>
            //                                     </svg>
            //                                     <svg class="wishlist-heart-svg fill-heart" width="20" height="20" viewBox="0 0 512.003 512.003"
            //                                          style="${isWishlisted ? '' : 'display:none;'}">
            //                                         <path style="fill:#E8594B;" d="M256.001,105.69c19.535-49.77,61.325-87.79,113.231-87.79c43.705,0,80.225,22.572,108.871,54.44
            //                                             c39.186,43.591,56.497,139.193-15.863,209.24c-37.129,35.946-205.815,212.524-205.815,212.524S88.171,317.084,50.619,281.579
            //                                             C-22.447,212.495-6.01,116.919,34.756,72.339c28.919-31.629,65.165-54.44,108.871-54.44
            //                                             C195.532,17.899,236.466,55.92,256.001,105.69"/>
            //                                     </svg>
            //                                 </span>
            //                             </button>
            //                         </div>
            //                         <div class="product-item-body">
            //                             <p class="product-item-id base-color">${product.productTitle || ''}</p>
            //                             <div class="product-item-buttons">
            //                                 <button class="btn  " style="border:2px solid #8a2323;color:#8a2323;font-weight:500;"><a class="base-color text-decoration-none" href="/product/${product.variants?.[0]?.variantSku }?category=${categoryKey}"> View Details </a></button>
            //                                 <button class="btn btn-outline-secondary try-on-btn" data-sku="${product.variants?.[0]?.variantSku || ''}" style="background:#8a2323;color:#fff;font-weight:500;">Try On</button>
            //                             </div>
            //                         </div>
            //                     </div>
            //                 </div>
            //             `;
            //         });
            //         html += '</div>';
            //         gridsContainer.innerHTML = html;
            //     })
            //     .catch(() => {
            //         gridsContainer.innerHTML = '<div class="text-center py-5 text-danger">Failed to load products.</div>';
            //     });
            // });

        });

        // document.addEventListener('DOMContentLoaded', function() {
        //     const heartIcons = document.querySelectorAll('.heart-icon');

        //     heartIcons.forEach(icon => {
        //         icon.addEventListener('click', function(event) {
        //             event.stopPropagation(); // Prevent triggering other click events

        //             // Find the <path> element inside the SVG
        //             const svgPath = this.querySelector('svg path');

        //             // Check the current color and toggle it
        //             const isFavorited = svgPath.getAttribute('fill') ===
        //                 '#e74c3c'; // Red color for favorited
        //             svgPath.setAttribute('fill', isFavorited ? '#ccc' :
        //                 '#e74c3c'); // Toggle between gray and red
        //         });
        //     });
        // });
    </script>
    {{-- categor-tab  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabsContainer = document.getElementById('category-tabs');
            const gridsContainer = document.getElementById('product-grids-container');
            const userId = "{{ session('user_id') }}";
            const idToken = "{{ session('id_token') }}";

            // Initialize wishlist manager
            if (typeof initWishlistManager === 'function') {
                window.wishlistManager = initWishlistManager({
                    userId: userId,
                    idToken: idToken,
                    syncEndpoint: '/wishlist/sync',
                    syncInterval: 300000 // 5 minutes
                });

                // Listen for wishlist update events
                document.addEventListener('wishlistUpdate', function(event) {
                    const { action, sku, isInWishlist } = event.detail;
                    // Update all visible buttons with this SKU
                    document.querySelectorAll(`[data-variant-sku="${sku}"]`).forEach(btn => {
                        const borderHeart = btn.querySelector('.border-heart');
                        const fillHeart = btn.querySelector('.fill-heart');
                        updateHeartUI(borderHeart, fillHeart, isInWishlist);
                    });
                });
            }

            let categories = [];

            // Get selected category from query param
            function getQueryParam(name) {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get(name);
            }
            const selectedCategory = getQueryParam('category');

            // Fetch categories and render tabs
            fetch('https://ar-api.mirrar.com/category/get/brand/2df975fa-c1b8-45a1-a7c0-f94d9a9becd8')
                .then(response => response.json())
                .then(data => {
                    categories = data.data || [];
                    tabsContainer.innerHTML = '';

                    // Get allowed categories from Blade (if present)
                    let allowedCategories = [];
                    @if(isset($categoryPresence) && is_array($categoryPresence) && count($categoryPresence) > 0)
                        allowedCategories = @json($categoryPresence);
                    @endif
                    // console.log(allowedCategories);
                    // Filter categories if allowedCategories is set
                    let filteredCategories = categories;
                    // console.log(categories);
                    if (allowedCategories.length > 0) {
                        filteredCategories = categories.filter(cat => allowedCategories.includes(cat.categoryKey));
                    }

                    let selectedIdx = 0;
                    if (selectedCategory) {
                        const idx = filteredCategories.findIndex(cat => cat.categoryKey === selectedCategory);
                        if (idx !== -1) selectedIdx = idx;
                    }

                    filteredCategories.forEach((category, idx) => {
                        const btn = document.createElement('button');
                        btn.className = 'category-tab' + (idx === selectedIdx ? ' active' : '');
                        btn.dataset.category = category.categoryKey;
                        btn.textContent = category.categoryLabel;
                        tabsContainer.appendChild(btn);
                    });

                    // Fetch products for the selected category by default
                    if (filteredCategories.length > 0) {
                        fetchAndRenderProducts(filteredCategories[selectedIdx].categoryKey);
                    }

                    // Tab switching logic
                    const tabBtns = tabsContainer.querySelectorAll('.category-tab');
                    tabBtns.forEach(tab => {
                        tab.addEventListener('click', function() {
                            tabBtns.forEach(t => t.classList.remove('active'));
                            this.classList.add('active');
                            fetchAndRenderProducts(this.dataset.category);
                        });
                    });
                });

            // Fetch and render products for a category

            function fetchAndRenderProducts(categoryKey, page = 1) {
                gridsContainer.innerHTML =
                    '<div class="text-center py-5"><img src="{{ asset('/image/logo.png') }}" alt="Loading..." style="width:60px;height:60px;" /></div>';

                fetch(`https://ar-api.mirrar.com/product/brand/2df975fa-c1b8-45a1-a7c0-f94d9a9becd8/categories/${encodeURIComponent(categoryKey)}/inventories`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            limit: 20,
                            product_code: "",
                            filter_field: {
                                page: page,
                                isSetOnly: [false]
                            }
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const products = data.data || [];
                        const total = data.total || 0;
                        const pageSize = 20;
                        const currentPage = page;
                        const totalPages = Math.ceil(total / pageSize) || (products.length === pageSize ? currentPage + 1 : currentPage);
                        if (products.length === 0) {
                            gridsContainer.innerHTML = '<div class="text-center py-5">No products found.</div>';
                            return;
                        }

                    // Get wishlist data from wishlist manager
                    let wishlistSkus = [];
                    if (window.wishlistManager) {
                        wishlistSkus = window.wishlistManager.getWishlistSkus();
                    }

                        let html = '<div class="row">';
                        products.forEach(product => {
                            const productId = product.productId || product.sku;
                            const variantSku = product.variants?.[0]?.variantSku || productId;
                            const isWishlisted = window.wishlistManager ?
                                window.wishlistManager.isInWishlist(variantSku) :
                                wishlistSkus.includes(variantSku);

                            let imgSrc = 'https://placehold.co/300x220?text=No+Image';
                            const variant = product.variants?.[0];
                            if (variant) {
                                if (variant.variantThumbnails && Object.values(variant.variantThumbnails).length > 0) {
                                    imgSrc = Object.values(variant.variantThumbnails)[0];
                                } else if (variant.variantImageURLs && Object.values(variant.variantImageURLs).length > 0) {
                                    imgSrc = Object.values(variant.variantImageURLs)[0];
                                }
                            }

                            html += `

                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="product-item-card">
                            <div class="product-image-wrapper position-relative">
                                <img src="${imgSrc}" class="default-image" alt="${product.productCollection}">
                                <button class="wishlist-btn position-absolute top-0 end-0 m-2 p-0 border-0 bg-transparent"
                                        style="z-index:2;"
                                        aria-label="Add to wishlist"
                                        data-product-id="${productId}"
                                        data-variant-sku="${variantSku}"
                                        onclick="posthog.capture(${isWishlisted ? '\'remove_from_wishlist_clicked\'' : '\'add_to_wishlist_clicked\''}, {sku: '${variantSku}', category: '${categoryKey}'})">
                                    <span class="wishlist-icon-wrapper">
                                        <svg class="wishlist-heart-svg border-heart" width="20" height="20" viewBox="0 0 512.289 512.289"
                                             style="${isWishlisted ? 'display:none;' : ''}">
                                            <path d="M477.051,72.678c-32.427-36.693-71.68-55.467-111.787-55.467c-45.227,0-85.333,27.307-109.227,72.533
                                                c-23.04-45.227-64-72.533-108.373-72.533c-40.96,0-78.507,18.773-111.787,55.467c-39.253,43.52-61.44,141.653,15.36,215.04
                                                c35.84,33.28,197.12,203.093,198.827,204.8s3.413,2.56,5.973,2.56s5.12-0.853,6.827-3.413
                                                c1.707-1.707,163.84-170.667,198.827-204.8C537.637,213.478,515.451,115.344,477.051,72.678z M448.891,275.771
                                                c-31.573,29.867-162.987,167.253-192.853,198.827c-29.867-32.427-160.427-168.96-192.853-199.68
                                                c-69.12-65.707-49.493-151.893-14.507-190.293c29.867-32.427,64-49.493,98.987-49.493c42.667,0,81.067,29.867,100.693,79.36
                                                c0.853,2.56,4.267,5.12,7.68,5.12s6.827-2.56,7.68-5.12c19.627-48.64,58.027-79.36,101.547-79.36
                                                c35.84,0,69.12,16.213,98.133,50.347C497.531,123.024,517.157,210.064,448.891,275.771z" fill="#111"/>
                                        </svg>
                                        <svg class="wishlist-heart-svg fill-heart" width="20" height="20" viewBox="0 0 512.003 512.003"
                                             style="${isWishlisted ? '' : 'display:none;'}">
                                            <path style="fill:#8a2323;" d="M256.001,105.69c19.535-49.77,61.325-87.79,113.231-87.79c43.705,0,80.225,22.572,108.871,54.44
                                                c39.186,43.591,56.497,139.193-15.863,209.24c-37.129,35.946-205.815,212.524-205.815,212.524S88.171,317.084,50.619,281.579
                                                C-22.447,212.495-6.01,116.919,34.756,72.339c28.919-31.629,65.165-54.44,108.871-54.44
                                                C195.532,17.899,236.466,55.92,256.001,105.69"/>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                            <div class="product-item-body">
                                <p class="product-item-id base-color">${product.productTitle || ''}</p>
                                <div class="product-item-buttons">
                                    <button class="btn" style="border:2px solid #8a2323;color:#8a2323;font-weight:500;" onclick="posthog.capture('view-details', {variantSku: '${product.variants?.[0]?.variantSku || ''}', categoryKey: '${categoryKey}'})">
                                        <a class="base-color text-decoration-none" href="/product/${product.variants?.[0]?.variantSku }?category=${categoryKey}"> View Details </a>
                                    </button>
                                    <button class="btn btn-outline-secondary try-on-btn" data-sku="${product.variants?.[0]?.variantSku || ''}" style="background:#8a2323;color:#fff;font-weight:500;" onclick="posthog.capture('try-on', {variantSku: '${product.variants?.[0]?.variantSku || ''}', categoryKey: '${categoryKey}', page:'plp'})">Try On</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                        });
                        html += '</div>';

                        // Pagination controls
                        html += `<div class="d-flex justify-content-center my-4">
                <nav aria-label="Product pagination">
                    <ul class="pagination">
                        <li class="page-item${currentPage === 1 ? ' disabled' : ''}">
                            <a class="page-link d-flex align-items-center h-100" href="#" data-page="${currentPage - 1}" aria-label="Previous">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#300708" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>
                            </a>
                        </li>`;
                        for (let i = 1; i <= totalPages; i++) {
                            html +=
                                `<li class="page-item${i === currentPage ? ' active' : ''}"><a class="base-color page-link h-100" href="#" style="font-size:14px;" data-page="${i}">${i}</a></li>`;
                        }
                        html += `<li class="page-item${currentPage === totalPages ? ' disabled' : ''}">
                            <a class="page-link h-100 d-flex align-items-center" href="#" data-page="${currentPage + 1}" aria-label="Next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#300708" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 14.354a.5.5 0 0 1 0-.708L10.293 8 4.646 2.354a.5.5 0 1 1 .708-.708l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708 0z"/></svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>`;

                        gridsContainer.innerHTML = html;

                        // Ensure wishlist manager is ready before attaching listeners
                        if (window.wishlistManager) {
                            attachWishlistListeners();
                            // Sync wishlist UI for newly loaded products
                            setTimeout(() => {
                                updateAllWishlistButtons();
                            }, 100);
                        } else {
                            // Wishlist manager not ready yet, wait and retry
                            const waitForManager = () => {
                                if (window.wishlistManager) {
                                    attachWishlistListeners();
                                    setTimeout(() => {
                                        updateAllWishlistButtons();
                                    }, 100);
                                } else {
                                    setTimeout(waitForManager, 50);
                                }
                            };
                            waitForManager();
                        }

                        // Attach Try On button listeners
                        document.querySelectorAll('.try-on-btn').forEach(btn => {
                            btn.addEventListener('click', function(e) {
                                e.preventDefault();
                                const sku = this.getAttribute('data-sku');
                                // Load Mirrar SDK if not loaded
                                if (!window.mirrarUILoaded) {
                                    const script = document.createElement('script');
                                    script.src =
                                        "https://cdn.mirrar.com/general/scripts/mirrar-ui.js";
                                    script.onload = () => {
                                        window.mirrarUILoaded = true;
                                        initMirrarUI(sku, {
                                            brandId: "2df975fa-c1b8-45a1-a7c0-f94d9a9becd8"
                                        });
                                    };
                                    document.body.appendChild(script);
                                } else {
                                    initMirrarUI(sku, {
                                        brandId: "2df975fa-c1b8-45a1-a7c0-f94d9a9becd8"
                                    });
                                }
                            });
                        });

                        // Pagination click handler
                        const paginationLinks = gridsContainer.querySelectorAll('.pagination .page-link');
                        paginationLinks.forEach(link => {
                            link.addEventListener('click', function(e) {
                                e.preventDefault();
                                const page = parseInt(this.getAttribute('data-page'));
                                if (!isNaN(page) && page > 0 && page <= totalPages && page !==
                                    currentPage) {
                                    fetchAndRenderProducts(categoryKey, page);
                                }
                            });
                        });
                    })
                    .catch(() => {
                        gridsContainer.innerHTML =
                            '<div class="text-center py-5 text-danger">Failed to load products.</div>';
                    });
            }

            // Wishlist notification popup
            function showWishlistPopup(type, sku) {
                const popup = document.getElementById('wishlist-popup');
                const icon = document.getElementById('wishlist-popup-icon');
                const msg = document.getElementById('wishlist-popup-msg');

                if (type === 'add') {
                    icon.innerHTML = "<svg class=\"wishlist-heart-svg fill-heart\" width=\"20\" height=\"20\" viewBox=\"0 0 512.003 512.003\" style=\"\">\n                                                    <path style=\"fill:#8a2323;\" d=\"M256.001,105.69c19.535-49.77,61.325-87.79,113.231-87.79c43.705,0,80.225,22.572,108.871,54.44\n                                                        c39.186,43.591,56.497,139.193-15.863,209.24c-37.129,35.946-205.815,212.524-205.815,212.524S88.171,317.084,50.619,281.579\n                                                        C-22.447,212.495-6.01,116.919,34.756,72.339c28.919-31.629,65.165-54.44,108.871-54.44\n                                                        C195.532,17.899,236.466,55.92,256.001,105.69\"/>\n                                                </svg>";
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

                const delay = type === 'error' ? 4000 : 2000; // Show errors longer
                setTimeout(() => {
                    popup.style.opacity = '0';
                    popup.style.transform = 'translateX(-60px)';
                    setTimeout(() => {
                        popup.style.display = 'none';
                    }, 400);
                }, delay);
            }

            // Function to attach event listeners to wishlist buttons
            function attachWishlistListeners() {
                document.querySelectorAll('.wishlist-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const productCard = this.closest('.product-item-card');
                        if (!productCard) {
                            console.warn('wishlist-btn not inside .product-item-card');
                            return;
                        }

                        // Get SKU from data attribute (more reliable)
                        const sku = this.getAttribute('data-variant-sku') ||
                                   productCard.querySelector('.try-on-btn')?.getAttribute('data-sku');

                        const borderHeart = this.querySelector('.border-heart');
                        const fillHeart = this.querySelector('.fill-heart');

                        if (!userId || !idToken || !sku) {
                            console.warn('Missing userId, idToken, or sku for wishlist API call');
                            return;
                        }

                        // Check current wishlist state using wishlist manager
                        const isCurrentlyWishlisted = window.wishlistManager ?
                            window.wishlistManager.isInWishlist(sku) :
                            fillHeart.style.display === 'inline';

                        const method = isCurrentlyWishlisted ? 'DELETE' : 'POST';
                        const action = isCurrentlyWishlisted ? 'remove' : 'add';
                        const url = `/users/${userId}/wishlist`;
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

                        // Optimistic update using wishlist manager
                        if (window.wishlistManager) {
                            if (action === 'add') {
                                window.wishlistManager.addToWishlist(sku);
                            } else {
                                window.wishlistManager.removeFromWishlist(sku);
                            }
                        }

                        // Update UI immediately
                        updateHeartUI(borderHeart, fillHeart, action === 'add');

                        // Get product data from card
                        const imgElem = productCard.querySelector('img.default-image');
                        const variantThumbnails = imgElem ? imgElem.src : '';
                        const categoryKey = document.querySelector('.category-tab.active')?.dataset.category || '';
                        const productTitle = productCard.querySelector('.product-item-id')?.textContent || '';

                        // Show popup notification
                        showWishlistPopup(action, sku);

                        // API call
                        fetch(url, {
                            method: method,
                            headers: {
                                'Authorization': 'Bearer ' + idToken,
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                sku: sku,
                                variantThumbnails: variantThumbnails,
                                categoryKey: categoryKey,
                                productTitle: productTitle,
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
                            // API call succeeded, wishlist manager already updated optimistically
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
                            updateHeartUI(borderHeart, fillHeart, action !== 'add');

                            // Show error popup (optional)
                            showWishlistPopup('error', sku);
                        });
                    });
                });
            }

            // Helper function to update heart UI
            function updateHeartUI(borderHeart, fillHeart, isWishlisted) {
                if (borderHeart && fillHeart) {
                    borderHeart.style.display = isWishlisted ? 'none' : 'inline';
                    fillHeart.style.display = isWishlisted ? 'inline' : 'none';
                }
            }

            // Helper function to update all visible wishlist buttons (used for sync)
            function updateAllWishlistButtons() {
                document.querySelectorAll('.wishlist-btn').forEach(btn => {
                    const sku = btn.getAttribute('data-variant-sku');
                    if (sku && window.wishlistManager) {
                        const isWishlisted = window.wishlistManager.isInWishlist(sku);
                        const borderHeart = btn.querySelector('.border-heart');
                        const fillHeart = btn.querySelector('.fill-heart');
                        updateHeartUI(borderHeart, fillHeart, isWishlisted);
                    }
                });
            }


        });
    </script>

@endpush
