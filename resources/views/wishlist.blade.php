@extends('layouts.app')

@section('title', 'Wishlist')
@section('content')
    <!-- Include wishlist manager -->
    <script src="{{ asset('js/wishlist-manager.js') }}"></script>
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


<div  class="container d-flex justify-content-between mt-4 mb-2">

      <div class="d-flex mb-3">

                <button id="" class="btn explore-btn bg-color">
                    <a class="text-decoration-none text-white"
                        href="{{ route('product.list') }}">
                        <i class="fa fa-share-alt"></i> Explore Catalogue
                    </a>
                </button>

            </div>


    <div class="d-flex justify-content-end mb-3">
        @if(!empty($products) && count($products) > 0 && !empty(session('user_id')))
            <button id="share-wishlist-btn" class="btn bg-color">
                <i class="fa fa-share-alt"></i> Share Wishlist
            </button>
        @endif
    </div>
    <!-- Share Modal -->
    <div class="modal fade" id="shareWishlistModal" tabindex="-1" aria-labelledby="shareWishlistModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title " id="shareWishlistModalLabel">Share Wishlist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="d-flex justify-content-center gap-3 mb-3">
                            <button id="shareMyselfBtn" class="btn  explore-btn bg-color">Share Myself</button>
                            <button id="shareOthersBtn" class="btn  explore-btn bg-color">Share Others</button>
                        </div>
                        <div id="shareEmailForm" style="display:none;" class="mb-3">
                            <div class="d-flex flex-row gap-3">
                                <input type="text" id="shareOtherFullName" class="form-control mb-2 w-50" placeholder="Enter recipient's full name">
                                <input type="email" id="shareOtherEmail" class="form-control mb-2 w-50" placeholder="Enter recipient's email">
                            </div>
                            <button id="sendOtherEmailBtn" class="btn explore-btn bg-color w-100">Send Email</button>
                        </div>
                        <div id="shareStatusMsg" class="mb-2 text-success" style="display:none;"></div>
                        <div id="shareDefaultOptions">
                              {{-- <p>Share your wishlist on:</p> --}}
                              @php
                                  $shareUrl = null;

                                  if (!empty(session('user_id')) && !empty(session('id_token'))) {
                                      $shareUrl = url('/wishlist/share/'. $username . '/' . $shareId);
                                  }
                              @endphp
                              @if($shareUrl)
                              <div class="d-flex justify-content-center gap-3">
                                  <a href="https://wa.me/?text={{ urlencode($shareUrl) }}" target="_blank" class="btn ">
                                      <img src="{{asset('image/whatsapp.png')}}" style="width:30px" alt="">
                                  </a>
                                  <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" class="btn ">
                                      <img src="{{asset('image/facebook.png')}}" style="width:30px" alt="">
                                  </a>
                                  <a href="https://www.instagram.com/?url={{ urlencode($shareUrl) }}" target="_blank" class="btn ">
                                      <img src="{{asset('image/instagram.png')}}" style="width:30px" alt="">
                                  </a>
                                  {{-- <a href="mailto:?subject=My Wishlist&body={{ urlencode($shareUrl) }}" class="btn ">
                                      <img src="{{asset('image/gmail.png')}}" style="width:30px" alt="">
                                  </a> --}}
                                  <button class="border-0 bg-transparent p-0" type="button" id="copy-share-link" title="Copy link">
                                      <img id="copy-share-link-img" src="{{asset('image/copy.png')}}" style="width:30px; cursor:pointer;" alt="Copy">
                                  </button>
                                  <input type="text" id="share-link-input" value="{{ $shareUrl }}" tabindex="-1" style="position:absolute;left:-9999px;opacity:0;">
                              </div>
                              @else
                              <div class="alert alert-warning">Unable to generate share link.</div>
                              @endif
                        </div>
                    </div>
                </div>
            </div>


            {{-- @else
            <div class="alert alert-warning">Unable to generate share link.</div>
            @endif --}}
          {{-- </div>
        </div>
      </div> --}}

    </div>

</div>

<div class="container">


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


                                <div
                                            class="position-absolute top-0 end-0 m-2 p-0 border-0 bg-transparent d-block flex-column">
                                            <button class="wishlist-btn  top-0 end-0 m1-2 p-0 border-0 bg-transparent"
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
                                            <!-- Like/Dislike Icons -->
                                            <div class="d-flex flex-column align-items-center"
                                                style="z-index:2;">


                                            @if($product['likesCount'] > 0 )
                                            <div class="position-relative">
                                                <button class="like-btn my-1 wishlist-btn px-0" data-action="like"
                                                    style="background:none;border:none;cursor:pointer;"
                                                    onmouseover="this.nextElementSibling.style.display='block'"
                                                    onmouseout="this.nextElementSibling.style.display='none'">
                                                    <svg id="Glyph" height="20" viewBox="0 0 64 64" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs"><g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)"><g fill="rgb(0,0,0)"><path d="m56.71588 26.64856a6.90936 6.90936 0 0 0 -5.33-1.6l-1.61.17c-1.19.13-2.53.27-3.85.4a2.98168 2.98168 0 0 1 -2.6-1.03 2.95185 2.95185 0 0 1 -.64-2.69 43.28241 43.28241 0 0 0 1.47-8.19c0-3.29 0-9.42-8.43005-9.42a1.01208 1.01208 0 0 0 -.9.56c-.03.07-3.47 7-7.22 13.17a25.64458 25.64458 0 0 1 -9.6 8.95c.09.21.18.42.26.63995a6.77 6.77 0 0 1 .35 1.30005 7.4175 7.4175 0 0 1 .16 1.55v20.54a8.93837 8.93837 0 0 1 -.19 1.8 8.57389 8.57389 0 0 1 -.76 2.11 9.57177 9.57177 0 0 0 4.52 2.45c7.71 1.78 18.59 3.47 26.61 1.4a10.85148 10.85148 0 0 0 7.19-6.46c2.85002-7.18003 6.72001-20.05002.57005-25.65z" fill="#8a2323" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/><path d="m14.88586 25.94855a6.28991 6.28991 0 0 0 -4.49-1.86 6.391 6.391 0 0 0 -6.39 6.37v20.54a6.3867 6.3867 0 0 0 6.38 6.39 6.38459 6.38459 0 0 0 6.39-6.39v-20.54a6.37783 6.37783 0 0 0 -.39-2.17 6.04215 6.04215 0 0 0 -1.5-2.34z" fill="#8a2323" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/></g></g></svg>
                                                </button>
                                                <span class="d-block text-center" style="font-size:10px; font-weight:500">{{$product['likesCount']}}</span>
                                                <!-- Hover box for likes -->
                                                <div class="position-absolute bg-white border rounded shadow-sm px-2 py-1" style="min-width:max-content; z-index:10; font-size:12px;left: -80px;
  top: -10px;">
                                                    <strong>Liked by:</strong><br>
                                                    @foreach($product['related']['likes'] ?? [] as $likeUser)
                                                        {{ $likeUser['username'] }}<br>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endif
                                               </div>

                                            <div class="d-flex flex-column align-items-center"
                                                style="z-index:2;">

                                              @if($product['dislikesCount'] > 0 )
                                              <div class="position-relative">
                                                  <button class="dislike-btn my-1 wishlist-btn px-0" data-action="dislike"
                                                      style="background:none;border:none;cursor:pointer;"
                                                      onmouseover="this.nextElementSibling.style.display='block'"
                                                      onmouseout="this.nextElementSibling.style.display='none'">
                                                      <svg id="Glyph" height="20" viewBox="0 0 64 64" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs"><g width="100%" height="100%" transform="matrix(-1,0,0,-1,63.9999942779541,63.99995994567871)"><g fill="rgb(0,0,0)"><path d="m56.71588 26.64856a6.90936 6.90936 0 0 0 -5.33-1.6l-1.61.17c-1.19.13-2.53.27-3.85.4a2.98168 2.98168 0 0 1 -2.6-1.03 2.95185 2.95185 0 0 1 -.64-2.69 43.28241 43.28241 0 0 0 1.47-8.19c0-3.29 0-9.42-8.43005-9.42a1.01208 1.01208 0 0 0 -.9.56c-.03.07-3.47 7-7.22 13.17a25.64458 25.64458 0 0 1 -9.6 8.95c.09.21.18.42.26.63995a6.77 6.77 0 0 1 .35 1.30005 7.4175 7.4175 0 0 1 .16 1.55v20.54a8.93837 8.93837 0 0 1 -.19 1.8 8.57389 8.57389 0 0 1 -.76 2.11 9.57177 9.57177 0 0 0 4.52 2.45c7.71 1.78 18.59 3.47 26.61 1.4a10.85148 10.85148 0 0 0 7.19-6.46c2.85002-7.18003 6.72001-20.05002.57005-25.65z" fill="#8a2323" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/><path d="m14.88586 25.94855a6.28991 6.28991 0 0 0 -4.49-1.86 6.391 6.391 0 0 0 -6.39 6.37v20.54a6.3867 6.3867 0 0 0 6.38 6.39 6.38459 6.38459 0 0 0 6.39-6.39v-20.54a6.37783 6.37783 0 0 0 -.39-2.17 6.04215 6.04215 0 0 0 -1.5-2.34z" fill="#8a2323" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/></g></g></svg>
                                                  </button>
                                                  <span class="d-block text-center" style="font-size:10px; font-weight:500">{{$product['dislikesCount']}}</span>
                                                  <!-- Hover box for dislikes -->
                                                  <div class="position-absolute  bg-white border rounded shadow-sm px-2 py-1" style="min-width:max-content; z-index:10; font-size:12px; left: -80px;
  top: -10px;">
                                                      <strong>Disliked by:</strong><br>
                                                      @foreach($product['related']['dislikes'] ?? [] as $dislikeUser)
                                                          {{ $dislikeUser['username'] }}<br>
                                                      @endforeach
                                                  </div>
                                              </div>
                                              @endif
                                               </div>


                                        </div>


                            </div>
                            <div class="product-item-body">
                                <p class="product-item-id base-color">{{ $product['productTitle'] ?? '' }}</p>
                                <div class="product-item-buttons">
                                    <button class="btn " style="border:2px solid #8a2323;color:#8a2323;font-weight:500;" onclick="posthog.capture('view-details', {sku: '{{ $product['sku'] }}', category: '{{ $product['categoryKey'] ?? '' }}'});">
                                        <a class="base-color text-decoration-none" href="/product/{{ $product['sku'] }}?category={{ $product['categoryKey'] ?? '' }}">View Details</a>
                                    </button>

                                     <button id="tryOnButton"  class="btn btn-outline-secondary try-on-btn" data-sku="{{ $product['sku'] }}" style="border:2px solid #8a2323;background:#8a2323;color:#fff;font-weight:500;" onclick="posthog.capture('try-on', {sku: '{{ $product['sku'] }}', category: '{{ $product['categoryKey'] ?? '' }}', page: 'wishlist'});">Try On</button>
                                {{-- <button class="btn btn-outline-secondary try-on-btn" data-sku="{{ $product['sku'] }}" style="border:2px solid #8a2323;background:#8a2323;color:#fff;font-weight:500;">Try On</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>


</div>
  {{-- Recommenedated product  --}}
          <div class="container">


                <div class="row mt-5">

                    <div class="container py-4">
                        <div class="d-flex mb-3">
                            <h3 class="text-base">
                                Recommendation Products
                            </h3>

                        </div>

                    </div>


                    @foreach ($recommendedProducts as $product)
                        @php
                            $imgSrc = !empty($product['variantThumbnails'])
                                ? $product['variantThumbnails']
                                : 'https://placehold.co/300x220?text=No+Image';
                            $sku = $product['skuId'] ?? '';
                            // dd($product);
                        @endphp
                        <div class="col-lg-3 col-md-4 col-6 mb-4 wishlist-product-card" data-sku="{{ $sku }}">
                            <div class="product-item-card">
                                <div class="product-image-wrapper position-relative">
                                    <!-- Recommender Username Top Left -->
                                    @if(!empty($product['recommenderUsername']))
                                    @php
                                        $firstName = explode(' ', $product['recommenderUsername'])[0];
                                    @endphp
                                    <div class="position-absolute top-0 recommend-btn start-0 m-md-2 px-2 py-1 bg-white rounded shadow-sm d-block" style="z-index:3;  color:#8a2323; font-weight:600;">
                                        Recommend by {{ $firstName }}
                                    </div>
                                    @endif
                                    <img src="{{ $imgSrc }}" class="default-image"
                                        alt="{{ $product['productCollection'] ?? '' }}">

                                       <div
                                            class="position-absolute top-0 end-0 m-2 p-0 border-0 bg-transparent d-flex flex-column">
                                            <button class="wishlist-btn top-0 end-0 m1-2 p-0 border-0 bg-transparent"
                                        style="z-index:2;"
                                        aria-label="Add to wishlist"
                                        data-product-sku="{{ $sku }}"
                                         data-variant-thumbnails="{{ $imgSrc }}"
                                                data-category-key="{{ $product['categoryKey'] ?? '' }}"
                                                data-product-title="{{ $product['productTitle'] ?? '' }}">
                                    <span class="wishlist-icon-wrapper">
                                        <svg class="wishlist-heart-svg border-heart" width="20" height="20" viewBox="0 0 512.289 512.289" style="display:inline;">
                                            <path d="M477.051,72.678c-32.427-36.693-71.68-55.467-111.787-55.467c-45.227,0-85.333,27.307-109.227,72.533
                                                c-23.04-45.227-64-72.533-108.373-72.533c-40.96,0-78.507,18.773-111.787,55.467c-39.253,43.52-61.44,141.653,15.36,215.04
                                                c35.84,33.28,197.12,203.093,198.827,204.8s3.413,2.56,5.973,2.56s5.12-0.853,6.827-3.413
                                                c1.707-1.707,163.84-170.667,198.827-204.8C537.637,213.478,515.451,115.344,477.051,72.678z M448.891,275.771
                                                c-31.573,29.867-162.987,167.253-192.853,198.827c-29.867-32.427-160.427-168.96-192.853-199.68
                                                c-69.12-65.707-49.493-151.893-14.507-190.293c29.867-32.427,64-49.493,98.987-49.493c42.667,0,81.067,29.867,100.693,79.36
                                                c0.853,2.56,4.267,5.12,7.68,5.12s6.827-2.56,7.68-5.12c19.627-48.64,58.027-79.36,101.547-79.36
                                                c35.84,0,69.12,16.213,98.133,50.347C497.531,123.024,517.157,210.064,448.891,275.771z" fill="#111"/>
                                        </svg>
                                        <svg class="wishlist-heart-svg fill-heart" width="20" height="20" viewBox="0 0 512.003 512.003" style="display:none;">
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
                                        <button class="btn "
                                            style="border:2px solid #8a2323;color:#8a2323;font-weight:500;">
                                            <a class="base-color text-decoration-none"
                                                href="/product/{{ $product['skuId'] }}?category={{ $product['categoryKey'] ?? '' }}">View
                                                Details</a>
                                        </button>

                                        <button id="tryOnButton" class="btn btn-outline-secondary try-on-btn"
                                            data-sku="{{ $product['skuId'] }}"
                                            style="border:2px solid #8a2323;background:#8a2323;color:#fff;font-weight:500;">Try
                                            On</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

@php
// dd(session('user_email'));
@endphp

  <div class="mt-auto text-center py-4 fs-6 fw-200 text-custom-dark text-dark-gray opacity-75">
 &copy; Powered By <a href="https://www.mirrar.com/" class="base-color"> mirrAR</a>


                                    </div>

                                    @php

                                    @endphp
<style>
.copied-effect {
  background: #8a2323 !important;
  color: #fff !important;
  transform: scale(1.1);
  transition: all 0.3s;
}

/* Show hover box only when parent is hovered */
.position-relative:hover > .position-absolute {
  display: block !important;
}
.position-absolute {
  display: none;
}
</style>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Share modal logic
    const shareMyselfBtn = document.getElementById('shareMyselfBtn');
    const shareOthersBtn = document.getElementById('shareOthersBtn');
    const shareEmailForm = document.getElementById('shareEmailForm');
    const sendOtherEmailBtn = document.getElementById('sendOtherEmailBtn');
    const shareOtherEmail = document.getElementById('shareOtherEmail');
    const shareOtherFullName = document.getElementById('shareOtherFullName');
    const shareStatusMsg = document.getElementById('shareStatusMsg');
    const shareDefaultOptions = document.getElementById('shareDefaultOptions');

    // Always show icon section
    if (shareDefaultOptions) {
        shareDefaultOptions.style.display = 'block';
    }
    // Hide email field by default
    if (shareEmailForm) {
        shareEmailForm.style.display = 'none';
    }

    if (shareMyselfBtn) {
        shareMyselfBtn.onclick = function() {
            if (shareEmailForm) shareEmailForm.style.display = 'none';
            if (shareDefaultOptions) shareDefaultOptions.style.display = 'none';
            if (shareStatusMsg) {
                shareStatusMsg.style.display = 'block';
                shareStatusMsg.textContent = 'Sending email to your registered email...';
            }
            // Send email to self via Bravo API
            fetch('/wishlist/send-email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    type: 'self',
                    shareUrl: document.getElementById('share-link-input').value,
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                shareStatusMsg.textContent = data.success ? 'Email sent to your email address!' : 'Failed to send email.';
                setTimeout(() => {
                    shareStatusMsg.style.display = 'none';
                    if (shareDefaultOptions) shareDefaultOptions.style.display = 'block';
                }, 2000);
            })
            .catch(() => {
                shareStatusMsg.textContent = 'Failed to send email.';
                setTimeout(() => {
                    shareStatusMsg.style.display = 'none';
                    if (shareDefaultOptions) shareDefaultOptions.style.display = 'block';
                }, 2000);
            });
        };
    }
        if (shareOthersBtn) {
            shareOthersBtn.onclick = function() {
                if (shareEmailForm) shareEmailForm.style.display = 'block';
                if (shareDefaultOptions) shareDefaultOptions.style.display = 'block';
                if (shareStatusMsg) shareStatusMsg.style.display = 'none';
            };
        }
    if (sendOtherEmailBtn) {
        sendOtherEmailBtn.onclick = function() {
            const email = shareOtherEmail.value.trim();
            const fullName = shareOtherFullName.value;
            console.log("fullname", fullName);
            if (!email || !email.match(/^\S+@\S+\.\S+$/)) {
                if (shareStatusMsg) {
                    shareStatusMsg.style.display = 'block';
                    shareStatusMsg.textContent = 'Please enter a valid email address.';
                }
                return;
            }
            if (shareStatusMsg) {
                shareStatusMsg.style.display = 'block';
                shareStatusMsg.textContent = 'Sending email...';
            }
            // Send email to other via Bravo API
            fetch('/wishlist/send-email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    type: 'other',
                    email: email,
                    shareUrl: document.getElementById('share-link-input').value,
                    fullname: fullName,
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log("data", data);
                shareStatusMsg.textContent = data.success ? 'Email sent!' : 'Failed to send email.';
                setTimeout(() => {
                    shareStatusMsg.style.display = 'none';
                    if (shareEmailForm) shareEmailForm.style.display = 'none';
                    if (shareDefaultOptions) shareDefaultOptions.style.display = 'block';
                }, 2000);
            })
            .catch(() => {
                shareStatusMsg.textContent = 'Failed to send email.';
                setTimeout(() => {
                    shareStatusMsg.style.display = 'none';
                    if (shareEmailForm) shareEmailForm.style.display = 'none';
                    if (shareDefaultOptions) shareDefaultOptions.style.display = 'block';
                }, 2000);
            });
        };
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyBtn = document.getElementById('copy-share-link');
    const copyImg = document.getElementById('copy-share-link-img');
    const shareInput = document.getElementById('share-link-input');
    if (copyBtn && shareInput && copyImg) {
        copyBtn.addEventListener('click', function() {
            // Copy logic
            if (navigator.clipboard) {
                navigator.clipboard.writeText(shareInput.value).then(function() {
                    copyImg.src = "{{ asset('image/checkmark.png') }}";
                    copyBtn.classList.add('copied-effect');
                    setTimeout(() => {
                        copyImg.src = "{{ asset('image/copy.png') }}";
                        copyBtn.classList.remove('copied-effect');
                    }, 1200);
                }, function() {
                    copyImg.src = "{{ asset('image/copy.png') }}";
                });
            } else {
                shareInput.style.display = 'block';
                shareInput.select();
                shareInput.setSelectionRange(0, 99999);
                try {
                    document.execCommand('copy');
                    copyImg.src = "{{ asset('image/facebook.png') }}";
                    copyBtn.classList.add('copied-effect');
                    setTimeout(() => {
                        copyImg.src = "{{ asset('image/copy.png') }}";
                        copyBtn.classList.remove('copied-effect');
                    }, 1200);
                } catch (err) {
                    copyImg.src = "{{ asset('image/copy.png') }}";
                }
                shareInput.style.display = '';
            }
        });
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mirrar Try On button logic (load SDK on page load, enable buttons after ready)
    let mirrarReady = false;
    function enableTryOnButtons() {
        document.querySelectorAll('.try-on-btn').forEach(btn => {
            btn.disabled = false;
            btn.addEventListener('click', function() {
                const sku = this.getAttribute('data-sku');
                if (!sku) {
                    alert('SKU not found for this product.');
                    return;
                }
                if (typeof initMirrarUI === 'function') {
                    const options = {
                        brandId: "2df975fa-c1b8-45a1-a7c0-f94d9a9becd8",
                    };
                    initMirrarUI(sku, options);
                } else {
                    alert('Try On feature is not available. Please reload the page.');
                }
            });
        });
    }
    // Disable buttons until SDK is ready
    document.querySelectorAll('.try-on-btn').forEach(btn => { btn.disabled = true; });
    // Load Mirrar SDK on page load
    const mirrarScript = document.createElement('script');
    mirrarScript.src = "https://cdn.mirrar.com/general/scripts/mirrar-ui.js";
    mirrarScript.onload = function() {
        mirrarReady = true;
        enableTryOnButtons();
    };
    document.body.appendChild(mirrarScript);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced wishlist notification popup
    function showWishlistPopup(type, sku) {
        const popup = document.getElementById('wishlist-popup');
        const icon = document.getElementById('wishlist-popup-icon');
        const msg = document.getElementById('wishlist-popup-msg');

        if (type === 'add') {
            icon.innerHTML = "<svg class=\"wishlist-heart-svg fill-heart\" width=\"20\" height=\"20\" viewBox=\"0 0 512.003 512.003\" style=\"\">\n                                <path style=\"fill:#8a2323;\" d=\"M256.001,105.69c19.535-49.77,61.325-87.79,113.231-87.79c43.705,0,80.225,22.572,108.871,54.44\n                                    c39.186,43.591,56.497,139.193-15.863,209.24c-37.129,35.946-205.815,212.524-205.815,212.524S88.171,317.084,50.619,281.579\n                                    C-22.447,212.495-6.01,116.919,34.756,72.339c28.919-31.629,65.165-54.44,108.871-54.44\n                                    C195.532,17.899,236.466,55.92,256.001,105.69\"/>\n                            </svg>";
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

        // Listen for wishlist update events to sync UI across all sections
        document.addEventListener('wishlistUpdate', function(event) {
            const { action, sku, isInWishlist } = event.detail;
            console.log('Wishlist update:', action, sku, isInWishlist);

            // Update all buttons with this SKU on the page (both wishlist and recommendations)
            document.querySelectorAll(`[data-product-sku="${sku}"]`).forEach(btn => {
                const borderHeart = btn.querySelector('.border-heart');
                const fillHeart = btn.querySelector('.fill-heart');
                updateHeartUI(borderHeart, fillHeart, isInWishlist);
            });
        });

            // On page load, sync all recommended product hearts with wishlist state
            setTimeout(() => {
                // Sync wishlist state for main wishlist products
                document.querySelectorAll('.wishlist-btn[data-product-sku]').forEach(btn => {
                    const sku = btn.getAttribute('data-product-sku');
                    const borderHeart = btn.querySelector('.border-heart');
                    const fillHeart = btn.querySelector('.fill-heart');
                    if (sku && window.wishlistManager) {
                        const isWishlisted = window.wishlistManager.isInWishlist(sku);
                        if (borderHeart && fillHeart) {
                            borderHeart.style.display = isWishlisted ? 'none' : 'inline';
                            fillHeart.style.display = isWishlisted ? 'inline' : 'none';
                        }
                    }
                });

                // Sync wishlist state for recommended products (border heart)
                document.querySelectorAll('.wishlist-btn[data-product-sku]').forEach(btn => {
                    const sku = btn.getAttribute('data-product-sku');
                    const borderHeart = btn.querySelector('.border-heart');
                    if (sku && window.wishlistManager && borderHeart) {
                        const isWishlisted = window.wishlistManager.isInWishlist(sku);
                        borderHeart.style.display = isWishlisted ? 'none' : 'inline';
                        // If you have a fillHeart for recommended, show it
                        const fillHeart = btn.querySelector('.fill-heart');
                        if (fillHeart) fillHeart.style.display = isWishlisted ? 'inline' : 'none';
                    }
                });
            }, 100);
    }

    // Helper function to update heart UI
    function updateHeartUI(borderHeart, fillHeart, isWishlisted) {
        if (borderHeart && fillHeart) {
            if (isWishlisted) {
                borderHeart.style.display = 'none';
                fillHeart.style.display = 'inline';
            } else {
                borderHeart.style.display = 'inline';
                fillHeart.style.display = 'none';
            }
        }
    }

    // Enhanced wishlist button functionality with new manager
    document.querySelectorAll('.wishlist-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const card = this.closest('.wishlist-product-card');
            const sku = this.getAttribute('data-product-sku');
            if (!sku) return;

            // Get heart elements
            const borderHeart = this.querySelector('.border-heart');
            const fillHeart = this.querySelector('.fill-heart');

            // Check current wishlist state from manager
            const isCurrentlyWishlisted = window.wishlistManager ?
                window.wishlistManager.isInWishlist(sku) :
                (fillHeart && fillHeart.style.display !== 'none');

            // Determine if this is an add or remove operation
            const isAddOperation = !isCurrentlyWishlisted;
            const dataVariantThumbnails = this.getAttribute('data-variant-thumbnails') || '';
            const variantThumbnails = dataVariantThumbnails || '';
            const categoryKey = this.getAttribute('data-category-key') || '';
            const productTitle = this.getAttribute('data-product-title') || '';

            if (isAddOperation) {
                // Add to wishlist (POST)

                // Optimistic update using wishlist manager
                if (window.wishlistManager) {
                    window.wishlistManager.addToWishlist(sku);
                }

                // Update UI immediately
                updateHeartUI(borderHeart, fillHeart, true);

                // Show popup immediately
                showWishlistPopup('add', sku);

                // API call
                fetch(`/users/${userId}/wishlist`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + idToken,
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
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
                        throw new Error('Failed to add to wishlist');
                    }
                    return response.json();
                })
                .then(() => {
                    // API call succeeded
                    if (window.wishlistManager) {
                        window.wishlistManager.handleApiResponse(sku, 'add', true);
                    }

                    // Clone the product card and prepend to wishlist grid
                    const wishlistContainer = document.getElementById('wishlist-grids-container');
                    if (wishlistContainer && card) {
                        const wishlistRow = wishlistContainer.querySelector('.row');
                        if (wishlistRow) {
                            const clonedCard = card.cloneNode(true);
                            const clonedBorderHeart = clonedCard.querySelector('.border-heart');
                            const clonedFillHeart = clonedCard.querySelector('.fill-heart');
                            if (clonedBorderHeart) clonedBorderHeart.style.display = 'none';
                            if (clonedFillHeart) clonedFillHeart.style.display = 'inline';
                            wishlistRow.appendChild(clonedCard);
                        }
                    }
                })
                .catch(error => {
                    console.error('Add to wishlist error:', error);

                    // Revert optimistic update on error
                    if (window.wishlistManager) {
                        window.wishlistManager.handleApiResponse(sku, 'add', false);
                    }

                    // Revert UI changes
                    updateHeartUI(borderHeart, fillHeart, false);
                    showWishlistPopup('error', sku);
                });
            } else {
                // Remove from wishlist (DELETE)

                // Optimistic update using wishlist manager
                if (window.wishlistManager) {
                    window.wishlistManager.removeFromWishlist(sku);
                }

                // Update UI immediately
                // If this is in the main wishlist section, hide the card
                // If this is in recommendations, just change heart
                const isInMainWishlist = card.closest('#wishlist-grids-container');
                if (isInMainWishlist) {
                    card.style.display = 'none';
                } else {
                    // This is in recommendations, just update heart
                    updateHeartUI(borderHeart, fillHeart, false);
                }

                // Show popup immediately
                showWishlistPopup('remove', sku);

                // API call
                fetch(`/users/${userId}/wishlist`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + idToken,
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    body: JSON.stringify({ sku: sku })
                })
                .then(response => {
                    const success = response.ok;
                    if (!success) {
                        throw new Error('Failed to remove from wishlist');
                    }
                    return response.json();
                })
                .then(() => {
                    // API call succeeded
                    if (window.wishlistManager) {
                        window.wishlistManager.handleApiResponse(sku, 'remove', true);
                    }
                    // Card is already hidden
                })
                .catch(error => {
                    console.error('Remove from wishlist error:', error);

                    // Revert optimistic update on error
                    if (window.wishlistManager) {
                        window.wishlistManager.handleApiResponse(sku, 'remove', false);
                    }

                    // Revert UI changes
                    const isInMainWishlist = card.closest('#wishlist-grids-container');
                    if (isInMainWishlist) {
                        card.style.display = 'block';
                    } else {
                        updateHeartUI(borderHeart, fillHeart, true);
                    }
                    showWishlistPopup('error', sku);
                });
            }
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

<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.copy-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      // Your copy logic here (if not already present)
      if (navigator.clipboard && btn.dataset.copy) {
        navigator.clipboard.writeText(btn.dataset.copy);
      }
      btn.classList.add('copied-effect');
      setTimeout(() => btn.classList.remove('copied-effect'), 700);
    });
  });
});
</script>

@endpush
@endsection


