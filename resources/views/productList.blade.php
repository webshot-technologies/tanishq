@extends('layouts.app')

@section('title', 'Product List')
@section('content')

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
                        <h2 class="accordion-header" id="headingMetal">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseMetal" aria-expanded="false"
                                aria-controls="collapseMetal">
                                Metal
                            </button>
                        </h2>
                        <div id="collapseMetal" class="accordion-collapse collapse  mt-3"
                            aria-labelledby="headingMetal" data-bs-parent="#sidebar-accordion">
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
                                    <input class="form-check-input" type="checkbox" value="Stainless Steel" id="checkStainlessSteel">
                                    <label class="form-check-label" for="checkStainlessSteel">Stainless Steel</label>
                                </div>
                                <!-- ... more types ... -->
                            </div>
                        </div>
                    </div>

                    <!-- Purity Accordion -->
                    <div class="accordion-item my-3">
                        <h2 class="accordion-header" id="headingPurity">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapsePurity" aria-expanded="false"
                                aria-controls="collapsePurity">
                                Purity
                            </button>
                        </h2>
                        <div id="collapsePurity" class="accordion-collapse collapse mt-3"
                            aria-labelledby="headingPurity" data-bs-parent="#sidebar-accordion">
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
                        <h2 class="accordion-header" id="headingOccasion">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOccasion" aria-expanded="false"
                                aria-controls="collapseOccasion">
                                Occasion
                            </button>
                        </h2>
                        <div id="collapseOccasion" class="accordion-collapse collapse  mt-3"
                            aria-labelledby="headingOccasion" data-bs-parent="#sidebar-accordion">
                            <div class="accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Bridal Wear" id="checkBridalWear">
                                    <label class="form-check-label" for="checkBridalWear">Bridal Wear</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Casual Wear" id="checkCasualWear">
                                    <label class="form-check-label" for="checkCasualWear">Casual Wear</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Modern Wear" id="checkModernWear">
                                    <label class="form-check-label" for="checkModernWear">Modern Wear</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Office Wear" id="checkOfficeWear">
                                    <label class="form-check-label" for="checkOfficeWear">Office Wear</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Traditional and Ethnic Wear" id="checkTraditionalEthnicWear">
                                    <label class="form-check-label" for="checkTraditionalEthnicWear">Traditional and Ethnic Wear</label>
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
                <div class="filter-bar container d-flex align-items-center mb-3">
                    <button class="filter-btn mr-2">
                        <img src="{{ asset('image/filter.svg') }}" class="mr-5" alt="">
                        Filter
                    </button>
                    <div class="input-wrapper ">
                        <input type="text" class="form-control search-input" placeholder="Search by SKU Code..." />
                    </div>
                </div>

              <div class="category-tabs my-5" id="category-tabs">
                    {{-- <button class="category-tab active" data-category="pendant-sets">Pendant Sets</button>
                    <button class="category-tab" data-category="chains">Chains</button>
                    <button class="category-tab" data-category="earrings">Earrings</button>
                    <button class="category-tab" data-category="necklaces">Necklaces</button>
                    <button class="category-tab" data-category="rings">Rings</button> --}}
             </div>

                <div id="product-grids-container">
                    <!-- Pendant Sets Grid (Active by default) -->
                </div>
                </div>

                    <div class="mt-auto text-center pt-4 fs-6 text-custom-dark text-dark-gray opacity-75">
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

            clearFiltersBtn.addEventListener('click', function() {
                // Reset filter form inputs
                const filterForm = sidebarOverlay.querySelector('.filter-options-container');
                filterForm.querySelectorAll('input').forEach(input => {
                    if (input.type === 'checkbox' || input.type === 'radio') input.checked = false;
                    if (input.type === 'range') input.value = input.min;
                });
                filterForm.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

                console.log('Filters cleared!');
                // You would typically make an API call to get unfiltered products here
            });

            applyFiltersBtn.addEventListener('click', function() {
                // Collect filter data and send to backend or filter on frontend
                console.log('Filters applied!');
                sidebarOverlay.classList.remove('active');
                // An AJAX call to filter products would go here
            });

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

            // 3. Heart Icon Functionality
            heartIcons.forEach(icon => {
                icon.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const svgPath = this.querySelector('.heart-svg path');
                    const isFavorited = svgPath.getAttribute('fill') === '#e74c3c';

                    // Toggle the heart color
                    svgPath.setAttribute('stroke', isFavorited ? '#ccc' : '#e74c3c');
                });
            });

            // 4. Search Functionality
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const activeGrid = document.querySelector('.product-grid-container.active');
                if (activeGrid) {
                    const productItems = activeGrid.querySelectorAll('.product-item-card');
                    productItems.forEach(item => {
                        const productId = item.querySelector('.product-item-id').textContent
                            .toLowerCase();
                        item.style.display = productId.includes(searchTerm) ? 'block' : 'none';
                    });
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const heartIcons = document.querySelectorAll('.heart-icon');

            heartIcons.forEach(icon => {
                icon.addEventListener('click', function(event) {
                    event.stopPropagation(); // Prevent triggering other click events

                    // Find the <path> element inside the SVG
                    const svgPath = this.querySelector('svg path');

                    // Check the current color and toggle it
                    const isFavorited = svgPath.getAttribute('fill') ===
                    '#e74c3c'; // Red color for favorited
                    svgPath.setAttribute('fill', isFavorited ? '#ccc' :
                    '#e74c3c'); // Toggle between gray and red
                });
            });
        });
    </script>
{{-- categor-tab  --}}
<script>

document.addEventListener('DOMContentLoaded', function() {
    const tabsContainer = document.getElementById('category-tabs');
    const gridsContainer = document.getElementById('product-grids-container');
    let categories = [];

    // Store wishlist items (using localStorage for persistence)
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || {};

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

            let selectedIdx = 0;
            if (selectedCategory) {
                const idx = categories.findIndex(cat => cat.categoryKey === selectedCategory);
                if (idx !== -1) selectedIdx = idx;
            }

            categories.forEach((category, idx) => {
                const btn = document.createElement('button');
                btn.className = 'category-tab' + (idx === selectedIdx ? ' active' : '');
                btn.dataset.category = category.categoryKey;
                btn.textContent = category.categoryLabel;
                tabsContainer.appendChild(btn);
            });

            // Fetch products for the selected category by default
            if (categories.length > 0) {
                fetchAndRenderProducts(categories[selectedIdx].categoryKey);
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
        gridsContainer.innerHTML = '<div class="text-center py-5"><img src="{{ asset('/image/logo.png') }}" alt="Loading..." style="width:60px;height:60px;" /></div>';

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

            let html = '<div class="row">';
            products.forEach(product => {
                const productId = product.productId || product.sku;
                const isWishlisted = wishlist[productId] || false;

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
                                        data-product-id="${productId}">
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
                                    <button class="btn  " style="border:2px solid #8a2323;color:#8a2323;font-weight:500;"><a class="base-color text-decoration-none" href="/product/${product.productId}?category=${categoryKey}"> View Details </a></button>
                                    <button class="btn btn-outline-secondary try-on-btn" data-sku="${product.variants?.[0]?.variantSku || ''}" style="background:#8a2323;color:#fff;font-weight:500;">Try it on</button>
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
                html += `<li class="page-item${i === currentPage ? ' active' : ''}"><a class="base-color page-link h-100" href="#" style="font-size:14px;" data-page="${i}">${i}</a></li>`;
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
            attachWishlistListeners();

            // Attach Try On button listeners
            document.querySelectorAll('.try-on-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const sku = this.getAttribute('data-sku');
                    // Load Mirrar SDK if not loaded
                    if (!window.mirrarUILoaded) {
                        const script = document.createElement('script');
                        script.src = "https://cdn.mirrar.com/general/scripts/mirrar-ui.js";
                        script.onload = () => {
                            window.mirrarUILoaded = true;
                            initMirrarUI(sku, { brandId: "2df975fa-c1b8-45a1-a7c0-f94d9a9becd8" });
                        };
                        document.body.appendChild(script);
                    } else {
                        initMirrarUI(sku, { brandId: "2df975fa-c1b8-45a1-a7c0-f94d9a9becd8" });
                    }
                });
            });

            // Pagination click handler
            const paginationLinks = gridsContainer.querySelectorAll('.pagination .page-link');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const page = parseInt(this.getAttribute('data-page'));
                    if (!isNaN(page) && page > 0 && page <= totalPages && page !== currentPage) {
                        fetchAndRenderProducts(categoryKey, page);
                    }
                });
            });
        })
        .catch(() => {
            gridsContainer.innerHTML = '<div class="text-center py-5 text-danger">Failed to load products.</div>';
        });
    }

    // Function to attach event listeners to wishlist buttons
    function attachWishlistListeners() {
        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.dataset.productId;
                const borderHeart = this.querySelector('.border-heart');
                const fillHeart = this.querySelector('.fill-heart');

                // Toggle wishlist state
                wishlist[productId] = !wishlist[productId];

                // Update UI
                if (wishlist[productId]) {
                    borderHeart.style.display = 'none';
                    fillHeart.style.display = 'inline';
                } else {
                    borderHeart.style.display = 'inline';
                    fillHeart.style.display = 'none';
                }

                // Save to localStorage
                localStorage.setItem('wishlist', JSON.stringify(wishlist));
            });
        });
    }
});
</script>

@endpush
