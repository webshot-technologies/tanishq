@extends('layouts.app')

@section('title', 'Category List')

@section('content')
<section class="product-categories-section">
    <div class="container">
        <h2 class="section-title base-color light-font">Find Your Perfect Match</h2>
        <p class="section-subtitle">Shop by Categories</p>
        <div id="categories-row" class="row justify-content-center">
            <div id="categories-loading" class="text-center py-5">Loading categories...</div>
        </div>
    </div>
    <div class="mt-auto text-center pt-4 fs-6 text-custom-dark text-dark-gray opacity-75">
                    &copy; Powered By <a href="https://www.mirrar.com/" class="base-color"> mirrAR</a>
                </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Pass the Laravel asset base path to JS
    const assetBase = "{{ asset('image') }}/";

    fetch('https://ar-api.mirrar.com/category/get/brand/2df975fa-c1b8-45a1-a7c0-f94d9a9becd8')
        .then(response => response.json())
        .then(data => {
            const row = document.getElementById('categories-row');
            row.innerHTML = '';

            let categories = data.data;
            console.log(categories);
            if (!Array.isArray(categories)) {
                categories = data.categories || data.data || [];
            }
/// update categoryType to categoryKey to specfic image path
            if (Array.isArray(categories) && categories.length > 0) {
                categories.forEach(category => {
                    // If category.image exists, use local asset, else fallback
                    const img = category.categoryType
    ? assetBase + category.categoryLabel.toLowerCase().replace(/\s+/g, '') + '.webp'
    : 'https://placehold.co/300x300?text=No+Image';
                    row.innerHTML += `
                        <div class="col-md-3 col-6 mb-4">
                            <a href="/product/full-catalogue?category=${encodeURIComponent(category.categoryKey)}" class="text-decoration-none">
                                <div class="product-category-card">
                                    <img src="${img}" alt="${category.type || category.name}">
                                    <div class="product-category-card-body">
                                        <h3 class="product-category-card-title">${category.categoryLabel || category.categoryLabel	}</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    `;
                });
            } else {
                row.innerHTML = '<div class="text-center py-5">No categories found.</div>';
            }
        })
        .catch(() => {
            document.getElementById('categories-row').innerHTML = '<div class="text-center py-5 text-danger">Failed to load categories.</div>';
        });
});
</script>
@endsection
