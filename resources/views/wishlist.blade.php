@extends('layouts.app')



@section('title', 'Wishlist')
@section('content')
    <!-- Wishlist Notification Popup -->
    <div id="wishlist-popup" style="position:fixed;bottom:30px;left:30px;z-index:9999;min-width:max-content;max-width:320px;padding:16px 24px;background:#fff;border-radius:8px;box-shadow:0 2px 12px rgba(0,0,0,0.15);color:#222;display:none;align-items:center;gap:10px;font-size:16px;opacity:0;transform:translateX(-60px);transition:opacity 0.4s cubic-bezier(.4,0,.2,1),transform 0.4s cubic-bezier(.4,0,.2,1);">
        <span id="wishlist-popup-icon" style="font-size:22px;"></span>
        <span id="wishlist-popup-msg"></span>
    </div>
<section class="" style="min-height:100vh; background-color: #fef9f7;" >
<div class="container py-4">
    @if(isset($wishlistOwner))
    <h1 class="section-title base-color text-center">{{ $wishlistOwner }} Wishlist</h1>
    @else
    <h1 class="section-title base-color text-center">My Wishlist</h1>
    <p class="section-subtitle text-center">Your favorite products are here</p>

@endif

</div>

<div class="container">

    @if(!$isShared )
    <div class="d-flex justify-content-end mb-3">
        @if(!empty($products) && count($products) > 0 && !empty(session('user_id')))
            <button id="share-wishlist-btn" class="btn btn-success">
                <i class="fa fa-share-alt"></i> Share Wishlist
            </button>
        @endif
    </div>
    <!-- Share Modal -->
    <div class="modal fade" id="shareWishlistModal" tabindex="-1" aria-labelledby="shareWishlistModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="shareWishlistModalLabel">Share Your Wishlist</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <p>Share your wishlist on:</p>
            @php
                $shareUrl = null;
                if (!empty(session('user_id')) && !empty(session('id_token'))) {
                    // Generate share URL from backend (controller should pass this ideally)
                    $shareUrl = url('/wishlist/share/'. $username . '/' . session('user_id') . '/' . $shareId);
                }
                // $shareUrl

            @endphp
            @if($shareUrl)
            <div class="d-flex justify-content-center gap-3">
                <a href="https://wa.me/?text={{ urlencode($shareUrl) }}" target="_blank" class="btn btn-outline-success">
                    {{-- <i class="fab fa-whatsapp"></i> WhatsApp --}}
                    <img src="{{asset('image/whatsapp.png')}}" style="width:50px" alt="">
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" class="btn btn-outline-primary">
                    {{-- <i class="fab fa-facebook"></i> Facebook --}}
                    <img src="{{asset('image/facebook.png')}}" style="width:50px" alt="">
                </a>
                <a href="https://www.instagram.com/?url={{ urlencode($shareUrl) }}" target="_blank" class="btn btn-outline-danger">
                    {{-- <i class="fab fa-instagram"></i> Instagram --}}
                    <img src="{{asset('image/instagram.png')}}" style="width:50px" alt="">
                </a>
                <a href="mailto:?subject=My Wishlist&body={{ urlencode($shareUrl) }}" class="btn btn-outline-dark">
                    {{-- <i class="fa fa-envelope"></i> Email --}}
                    <img src="{{asset('image/gmail.png')}}" style="width:50px" alt="">
                </a>
            </div>
            <div class="mt-3">
                <div class="input-group">
                    <input type="text" id="share-link-input" class="form-control" value="{{ $shareUrl }}" readonly onclick="this.select();">
                    <button class="border-none  " type="button" id="copy-share-link">
                        <img src="{{asset('image/copy.png')}}"  style="width:30px"  alt="">
                     </button>
                </div>
                <small class="text-muted">Copy and share this link anywhere</small>
            </div>
            @else
            <div class="alert alert-warning">Unable to generate share link.</div>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endif
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
    // Wishlist notification popup
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
    // Copy to clipboard functionality
    const copyBtn = document.getElementById('copy-share-link');
    const shareInput = document.getElementById('share-link-input');
    if (copyBtn && shareInput) {
        copyBtn.addEventListener('click', function() {
            shareInput.select();
            shareInput.setSelectionRange(0, 99999); // For mobile
            try {
                document.execCommand('copy');
                // Change button image to checkmark
                copyBtn.innerHTML = '<img src="{{ asset('image/copy.png') }}" style="width:30px" alt="Copy">';
                setTimeout(() => {
                    copyBtn.innerHTML = '<img src="{{ asset('image/copy.png') }}" style="width:30px" alt="Copy">';
                }, 1500);
            } catch (err) {
                copyBtn.innerHTML = '<img src="{{ asset('image/copy.png') }}" style="width:30px" alt="Copy">';
            }
        });
    }
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
                showWishlistPopup('remove', sku);
            })
            .catch(error => {
                alert('Error: ' + error.message);
            });
        });
    });

    // Share Wishlist button logic
    const shareBtn = document.getElementById('share-wishlist-btn');
    if (shareBtn) {
        shareBtn.addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('shareWishlistModal'));
            modal.show();
        });
    }
});
</script>
@endpush

</section>
@endsection

