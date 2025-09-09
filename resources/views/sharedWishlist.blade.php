@extends('layouts.app')

<!-- DEBUG: Show CSRF token for troubleshooting -->


@section('title', 'Wishlist')
@section('content')


    <!-- Wishlist Notification Popup -->
    <div id="wishlist-popup"
        style="position:fixed;bottom:30px;left:30px;z-index:9999;min-width:max-content;max-width:320px;padding:16px 24px;background:#fff;border-radius:8px;box-shadow:0 2px 12px rgba(0,0,0,0.15);color:#222;display:none;align-items:center;gap:10px;font-size:16px;opacity:0;transform:translateX(-60px);transition:opacity 0.4s cubic-bezier(.4,0,.2,1),transform 0.4s cubic-bezier(.4,0,.2,1);">
        <span id="wishlist-popup-icon" style="font-size:22px;"></span>
        <span id="wishlist-popup-msg"></span>
    </div>
    <section class="" style="min-height:100vh; background-color: #fef9f7;">
        <div class="container py-4">
            @if (isset($wishlistOwner))
                <h1 class="section-title base-color text-center">{{ $wishlistOwner }} Wishlist</h1>
            @else
                <h1 class="section-title base-color text-center">My Wishlist</h1>
                <p class="section-subtitle text-center">Your favorite products are here</p>
            @endif

        </div>

        <div class="container py-4">
            <div class="d-flex mb-3">

                <button id="" class="btn explore-btn bg-color">
                    <a class="text-decoration-none text-white"
                        href="{{ route('shared.full.catalogue', ['username' => $user_slug, 'wishlist_id' => $shareId]) }}">
                        <i class="fa fa-share-alt"></i> Explore Catalogue
                    </a>
                </button>

            </div>

        </div>


        <div class="container">


            <div id="wishlist-grids-container">
                @if (empty($products) || count($products) === 0)
                    <div class="text-center py-5">No products found in wishlist.</div>
                @else
                    <div class="row">
                        @foreach ($products as $product)
                            @php
                                $imgSrc = !empty($product['variantThumbnails'])
                                    ? $product['variantThumbnails']
                                    : 'https://placehold.co/300x220?text=No+Image';
                                $sku = $product['sku'] ?? '';
                            @endphp
                            <div class="col-lg-3 col-md-4 col-6 mb-4 wishlist-product-card" data-sku="{{ $sku }}">
                                <div class="product-item-card">
                                    <div class="product-image-wrapper position-relative">
                                        <img src="{{ $imgSrc }}" class="default-image"
                                            alt="{{ $product['productCollection'] ?? '' }}">

                                        <div
                                            class="position-absolute top-0 end-0 m-2 p-0 border-0 bg-transparent d-flex flex-column">
                                            <button class="wishlist-btn my-1  border-0 bg-transparent"
                                                style="z-index:2;pointer-events:none;" aria-label="Remove from wishlist"
                                                data-product-sku="{{ $sku }}">
                                                <span class="wishlist-icon-wrapper">
                                                    <svg class="wishlist-heart-svg fill-heart" width="20" height="20"
                                                        viewBox="0 0 512.003 512.003">
                                                        <path style="fill:#8a2323;" d="M256.001,105.69c19.535-49.77,61.325-87.79,113.231-87.79c43.705,0,80.225,22.572,108.871,54.44
                                                        c39.186,43.591,56.497,139.193-15.863,209.24c-37.129,35.946-205.815,212.524-205.815,212.524S88.171,317.084,50.619,281.579
                                                        C-22.447,212.495-6.01,116.919,34.756,72.339c28.919-31.629,65.165-54.44,108.871-54.44
                                                        C195.532,17.899,236.466,55.92,256.001,105.69" />
                                                    </svg>
                                                </span>
                                            </button>
                                            <!-- Like/Dislike Icons -->
                                            <button class="like-btn my-1 wishlist-btn" data-action="like"
                                                style="background:none;border:none;cursor:pointer;">
                                                <!-- Created with Inkscape (http://www.inkscape.org/) -->

                                              <svg id="Line_copy" height="20" viewBox="0 0 64 64" width="20" xmlns="http://www.w3.org/2000/svg" data-name="Line copy"><path d="m56.71045 26.64844a6.8354 6.8354 0 0 0 -5.33645-1.59278c-1.46435.15332-3.49658.36622-5.45507.56153a3.00565 3.00565 0 0 1 -2.5962-1.02246 2.96361 2.96361 0 0 1 -.64257-2.69825 42.54654 42.54654 0 0 0 1.47267-8.18948c0-3.291 0-9.416-8.43408-9.416a1.00065 1.00065 0 0 0 -.89648.55664c-.03418.06933-3.47168 7.0039-7.21729 13.17187a26.55934 26.55934 0 0 1 -11.69238 10.01272 5.87035 5.87035 0 0 0 -1.01172-1.3125 6.25823 6.25823 0 0 0 -4.5083-1.87891 6.39034 6.39034 0 0 0 -6.39258 6.37305v20.54a6.38348 6.38348 0 0 0 12.544 1.67191 9.71813 9.71813 0 0 0 5.79492 3.93457 83.12592 83.12592 0 0 0 18.001 2.35645 34.82632 34.82632 0 0 0 8.60938-.95606 10.80359 10.80359 0 0 0 7.189-6.47265c2.85535-7.17188 6.72645-20.04004.57215-25.63965zm-41.94434 25.10547a4.38306 4.38306 0 0 1 -8.76611 0v-20.54a4.388 4.388 0 0 1 4.39258-4.373 4.28957 4.28957 0 0 1 3.09961 1.29883 4.15258 4.15258 0 0 1 .99951 1.56826l.01269.03418a4.29084 4.29084 0 0 1 .26172 1.47168zm39.51612-.21191a8.794 8.794 0 0 1 -5.833 5.28223c-8.04639 2.08105-19.52979.00781-25.66358-1.41406a7.82386 7.82386 0 0 1 -6.01953-7.59473v-16.60157a6.25552 6.25552 0 0 0 -.13818-1.3086c.02539-.01172.05127-.02441.07715-.03613a28.55986 28.55986 0 0 0 12.60741-10.80859c3.165-5.21094 6.10986-10.958 7.01758-12.75684 5.82275.24414 5.82275 4.041 5.82275 7.40332a42.79093 42.79093 0 0 1 -1.415 7.71192 5.00717 5.00717 0 0 0 5.3833 6.1875c1.9585-.19434 3.99463-.40723 5.46192-.5625a4.84811 4.84811 0 0 1 3.78174 1.083c5.45894 4.96875 1.06001 18.03418-1.08256 23.41505z" fill="rgb(0,0,0)"/></svg>
                                            </button>

                                            <button class="dislike-btn my-1 wishlist-btn " data-action="dislike"
                                                style="background:none;border:none;cursor:pointer;">
                                                <svg id="Line_copy" height="20" viewBox="0 0 64 64" width="20" xmlns="http://www.w3.org/2000/svg" data-name="Line copy" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs"><g width="100%" height="100%" transform="matrix(-1,0,0,-1,63.99134540557861,64.01125717163086)"><path d="m56.71045 26.64844a6.8354 6.8354 0 0 0 -5.33645-1.59278c-1.46435.15332-3.49658.36622-5.45507.56153a3.00565 3.00565 0 0 1 -2.5962-1.02246 2.96361 2.96361 0 0 1 -.64257-2.69825 42.54654 42.54654 0 0 0 1.47267-8.18948c0-3.291 0-9.416-8.43408-9.416a1.00065 1.00065 0 0 0 -.89648.55664c-.03418.06933-3.47168 7.0039-7.21729 13.17187a26.55934 26.55934 0 0 1 -11.69238 10.01272 5.87035 5.87035 0 0 0 -1.01172-1.3125 6.25823 6.25823 0 0 0 -4.5083-1.87891 6.39034 6.39034 0 0 0 -6.39258 6.37305v20.54a6.38348 6.38348 0 0 0 12.544 1.67191 9.71813 9.71813 0 0 0 5.79492 3.93457 83.12592 83.12592 0 0 0 18.001 2.35645 34.82632 34.82632 0 0 0 8.60938-.95606 10.80359 10.80359 0 0 0 7.189-6.47265c2.85535-7.17188 6.72645-20.04004.57215-25.63965zm-41.94434 25.10547a4.38306 4.38306 0 0 1 -8.76611 0v-20.54a4.388 4.388 0 0 1 4.39258-4.373 4.28957 4.28957 0 0 1 3.09961 1.29883 4.15258 4.15258 0 0 1 .99951 1.56826l.01269.03418a4.29084 4.29084 0 0 1 .26172 1.47168zm39.51612-.21191a8.794 8.794 0 0 1 -5.833 5.28223c-8.04639 2.08105-19.52979.00781-25.66358-1.41406a7.82386 7.82386 0 0 1 -6.01953-7.59473v-16.60157a6.25552 6.25552 0 0 0 -.13818-1.3086c.02539-.01172.05127-.02441.07715-.03613a28.55986 28.55986 0 0 0 12.60741-10.80859c3.165-5.21094 6.10986-10.958 7.01758-12.75684 5.82275.24414 5.82275 4.041 5.82275 7.40332a42.79093 42.79093 0 0 1 -1.415 7.71192 5.00717 5.00717 0 0 0 5.3833 6.1875c1.9585-.19434 3.99463-.40723 5.46192-.5625a4.84811 4.84811 0 0 1 3.78174 1.083c5.45894 4.96875 1.06001 18.03418-1.08256 23.41505z" fill="#000000" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/></g></svg>


                                            </button>
                                        </div>

                                    </div>
                                    <div class="product-item-body">
                                        <p class="product-item-id base-color">{{ $product['productTitle'] ?? '' }}</p>
                                        <div class="product-item-buttons">
                                            <button class="btn "
                                                style="border:2px solid #8a2323;color:#8a2323;font-weight:500;">
                                                <a class="base-color text-decoration-none"
                                                    href="/product/{{ $product['sku'] }}?category={{ $product['categoryKey'] ?? '' }}">View
                                                    Details</a>
                                            </button>

                                            <button id="tryOnButton" class="btn btn-outline-secondary try-on-btn"
                                                data-sku="{{ $product['sku'] }}"
                                                style="border:2px solid #8a2323;background:#8a2323;color:#fff;font-weight:500;">Try
                                                On</button>
                                            {{-- <button class="btn btn-outline-secondary try-on-btn" data-sku="{{ $product['sku'] }}" style="border:2px solid #8a2323;background:#8a2323;color:#fff;font-weight:500;">Try On</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>


            <div>


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
                        @endphp
                        <div class="col-lg-3 col-md-4 col-6 mb-4 wishlist-product-card" data-sku="{{ $sku }}">
                            <div class="product-item-card">
                                <div class="product-image-wrapper position-relative">
                                    <img src="{{ $imgSrc }}" class="default-image"
                                        alt="{{ $product['productCollection'] ?? '' }}">

                                    <div
                                        class="position-absolute top-0 end-0 m-2 p-0 border-0 bg-transparent d-flex flex-column">

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




        </div>
        <div class="mt-auto text-center py-4 fs-6 fw-200 text-custom-dark text-dark-gray opacity-75">
            &copy; Powered By <a href="https://www.mirrar.com/" class="base-color"> mirrAR</a>


        </div>


        <!-- Authentication Modal -->
        <div id="auth-modal"
            style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.5);z-index:9999;align-items:center;justify-content:center;">
            <div class="otp-modal-content" style="position:relative;">
                <div class="otp-right w-100">
                <button type="button" id="auth-modal-close"
                    style="position:absolute;top:12px;right:16px;background:none;border:none;font-size:28px;line-height:1;z-index:10;cursor:pointer;"
                    aria-label="Close Auth Modal">&times;</button>
                <form id="auth-form" method="POST" action="{{ route('user.create') }}">
                    @csrf

                    <h5 class="mb-3">Login </h5>
                    <div class="mb-2">
                        <input type="text" id="auth-name" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" id="auth-phone" class="form-control" placeholder="Phone (10 digits)"
                            maxlength="10" required>
                    </div>
                    <div id="auth-error" class="text-danger small mb-2"></div>
                    <button type="submit" class="otp-btn w-100 mt-3">Send OTP</button>
                </form>
            </div>
            </div>
        </div>


        <!-- OTP Modal -->
        <div id="otp-modal"
            style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.5);z-index:9999;align-items:center;justify-content:center;">
            <div class="otp-modal-content" style="position:relative;">
                <button type="button" id="otp-modal-close"
                    style="position:absolute;top:12px;right:16px;background:none;border:none;font-size:28px;line-height:1;z-index:10;cursor:pointer;"
                    aria-label="Close OTP Modal">&times;</button>
              <div class="otp-right">

                    <h4 class="otp-heading">Verify with OTP</h4>
                    <p>Sent to <span id="otp-phone-number">+91 •••• ••••••</span></p>

                     <div class="d-flex gap-2 mb-2 otp-inputs">
                    <input type="text" maxlength="1" class="otp-box" data-index="1"
                        style="width:2rem;text-align:center;">
                    <input type="text" maxlength="1" class="otp-box" data-index="2"
                        style="width:2rem;text-align:center;">
                    <input type="text" maxlength="1" class="otp-box" data-index="3"
                        style="width:2rem;text-align:center;">
                    <input type="text" maxlength="1" class="otp-box" data-index="4"
                        style="width:2rem;text-align:center;">
                    <input type="text" maxlength="1" class="otp-box" data-index="5"
                        style="width:2rem;text-align:center;">
                    <input type="text" maxlength="1" class="otp-box" data-index="6"
                        style="width:2rem;text-align:center;">
                </div>

                    <div id="otp-error" class="otp-error"></div>


                    <div class="otp-loading" style="display:none;">
                        <div class="otp-spinner"></div>
                        <span>Verifying OTP...</span>
                    </div>

                    <div class="otp-success" style="display:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                        Verified successfully!
                    </div>

                    <p class="otp-timer">Resend OTP in <span id="otp-timer">02:00</span></p>

                    <button id="verify-otp-btn" class=" otp-btn w-100">Verify OTP</button>

                <div id="recaptcha-container" class="d-none"></div>

                    {{-- <p class="otp-terms">
                        By continuing, I agree to <a href="#">Terms of Use</a> & <a href="#">Privacy
                            Policy</a>
                    </p> --}}
                </div>




            </div>
        </div>
        <style>
            .copied-effect {
                background: #8a2323 !important;
                color: #fff !important;
                transform: scale(1.1);
                transition: all 0.3s;
            }
        </style>
        <script src="https://www.gstatic.com/firebasejs/10.9.0/firebase-app-compat.js"></script>
        <script src="https://www.gstatic.com/firebasejs/10.9.0/firebase-firestore-compat.js"></script>
        <script src="https://www.gstatic.com/firebasejs/10.9.0/firebase-auth-compat.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                                copyImg.src = "{{ asset('image/copy.png') }}";
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
            // Firebase and Mirrar SDK logic
            document.addEventListener('DOMContentLoaded', function() {
                // Mirrar Try On button logic (unchanged)
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
                document.querySelectorAll('.try-on-btn').forEach(btn => {
                    btn.disabled = true;
                });
                const mirrarScript = document.createElement('script');
                mirrarScript.src = "https://cdn.mirrar.com/general/scripts/mirrar-ui.js";
                mirrarScript.onload = function() {
                    mirrarReady = true;
                    enableTryOnButtons();
                };
                document.body.appendChild(mirrarScript);

                // --- Firebase OTP & reCAPTCHA logic ---
                // Ensure meta tag for CSRF exists in <head> of your layout:
                // <meta name="csrf-token" content="{{ csrf_token() }}">

                // Initialize Firebase FIRST before any firebase.auth() or firebase.firestore() calls
                const firebaseConfig = {
                    apiKey: 'AIzaSyBqLtJbDYe-X-5a-d2BLc-su-X9GlxclQ0',
                    authDomain: 'localhost',
                    projectId: 'user-wishlist',
                    storageBucket: 'user-wishlist.firebasestorage.app',
                    messagingSenderId: '718283592432',
                    appId: '1:718283592432:web:ec986b729c43ae39872835',
                    measurementId: 'G-MJRQ18F8Z4',
                };
                if (!firebase.apps.length) {
                    firebase.initializeApp(firebaseConfig);
                }
                const auth = firebase.auth();
                let confirmationResult = null;
                let recaptchaVerifier = null;

                // OTP modal logic
                var otpInputs = document.querySelectorAll('.otp-box');
                var verifyBtn = document.getElementById('verify-otp-btn');
                otpInputs.forEach((input, idx) => {
                    input.addEventListener('input', function(e) {
                        if (this.value && !/^\d$/.test(this.value)) {
                            this.value = '';
                            return;
                        }
                        if (this.value && idx < otpInputs.length - 1) {
                            otpInputs[idx + 1].focus();
                        }
                        const allFilled = Array.from(otpInputs).every(inp => inp.value.length === 1);
                        verifyBtn.disabled = !allFilled;
                    });
                    input.addEventListener('keydown', function(e) {
                        if (e.key === 'Backspace' && this.value === '' && idx > 0) {
                            otpInputs[idx - 1].focus();
                        }
                    });
                });

                function getOTP() {
                    return Array.from(otpInputs).map(inp => inp.value).join('');
                }

                // Auth form submit
                document.getElementById('auth-form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const name = document.getElementById('auth-name').value.trim();
                    const phone = document.getElementById('auth-phone').value.trim();
                    if (!name) {
                        document.getElementById('auth-error').textContent = 'Name required.';
                        return;
                    }
                    if (!/^\d{10}$/.test(phone)) {
                        document.getElementById('auth-error').textContent = 'Enter valid 10-digit phone.';
                        return;
                    }
                    document.getElementById('auth-error').textContent = '';
                    hideAuthModal();
                    showOTPModal();
                    // Initialize reCAPTCHA verifier only once
                    if (!window.recaptchaVerifier) {
                        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                            'size': 'invisible',
                            'callback': (response) => {
                                console.log('reCAPTCHA solved, proceed with OTP verification.');
                            },
                            'expired-callback': () => {
                                console.log('reCAPTCHA expired, please try again.');
                            }
                        });
                    }
                    const fullPhone = '+91' + phone;
                    auth.signInWithPhoneNumber(fullPhone, window.recaptchaVerifier)
                        .then(function(result) {
                            confirmationResult = result;
                            window.confirmationResult = result;
                        }).catch(function(error) {
                            console.log('reCAPTCHA error:', error);
                            document.getElementById('otp-error').textContent = 'OTP send error.';
                        });
                });


                // OTP timer logic
                let otpTimer = null;
                let otpTimeLeft = 120;

                function startOTPTimer() {
                    clearInterval(otpTimer);
                    otpTimeLeft = 120;
                    updateTimerDisplay();
                    otpTimer = setInterval(() => {
                        otpTimeLeft--;
                        updateTimerDisplay();
                        if (otpTimeLeft <= 0) {
                            clearInterval(otpTimer);
                        }
                    }, 1000);
                }

                function updateTimerDisplay() {
                    const timerEl = document.getElementById('otp-timer');
                    if (timerEl) {
                        const minutes = Math.floor(otpTimeLeft / 60);
                        const seconds = otpTimeLeft % 60;
                        timerEl.textContent =
                            `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    }
                }
            });
            </script>


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
                                copyBtn.innerHTML =
                                    '<img src="{{ asset('image/copy.png') }}" style="width:30px" alt="Copy">';
                                setTimeout(() => {
                                    copyBtn.innerHTML =
                                        '<img src="{{ asset('image/copy.png') }}" style="width:30px" alt="Copy">';
                                }, 1500);
                            } catch (err) {
                                copyBtn.innerHTML =
                                    '<img src="{{ asset('image/copy.png') }}" style="width:30px" alt="Copy">';
                            }
                        });
                    }

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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Like/Dislike logic with authentication and OTP
                let isAuthenticated = false;
                let userId = null;
                // If user_id exists in session, set isAuthenticated true
                @if (session('user_id'))
                    isAuthenticated = true;
                    userId = '{{ session('user_id') }}';
                @endif
                document.querySelectorAll('.like-btn, .dislike-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        if (!isAuthenticated) {
                            showAuthModal();
                            window.pendingAction = this.getAttribute('data-action');
                            window.pendingBtn = this;
                            return;
                        }
                        handleLikeDislike(this);
                    });
                });

                function handleLikeDislike(btn) {
                    // Like/dislike API integration
                    const action = btn.getAttribute('data-action');
                    console.log('action', action);
                    const card = btn.closest('.product-item-card');
                    const likeBtn = card.querySelector('.like-btn');
                    const dislikeBtn = card.querySelector('.dislike-btn');
                    const sku = btn.closest('.wishlist-product-card').getAttribute('data-sku');
                    console.log(sku);
                    const userId = "{{ session('user_id') }}";
                    const ownerId = "{{ $ownerId }}"
                    console.log(ownerId);
                    if (action === 'like' && ownerId && sku) {
                        fetch('/users/' + ownerId + '/wishlist/items/like', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content')
                                },
                                body: JSON.stringify({
                                    sku: sku
                                })
                            })
                            .then(res => res.json())
                            .then(response => {
                                console.log('Like API response:', response);
                                // Optionally show popup or update UI
                            })
                            .catch(error => {
                                console.error('Like API error:', error);
                            });
                    }
                    if (action === 'dislike' && ownerId && sku) {
                        fetch('/users/' + ownerId + '/wishlist/items/dislike', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content')
                                },
                                body: JSON.stringify({
                                    sku: sku
                                })
                            })
                            .then(res => res.json())
                            .then(response => {
                                console.log('Dislike API response:', response);
                                // Optionally show popup or update UI
                            })
                            .catch(error => {
                                console.error('Dislike API error:', error);
                            });
                    }
                    // SVGs for selected/unselected states
                    const likeSelectedSVG = `<svg id="Glyph" height="20" viewBox="0 0 64 64" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs"><g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)"><g fill="rgb(0,0,0)"><path d="m56.71588 26.64856a6.90936 6.90936 0 0 0 -5.33-1.6l-1.61.17c-1.19.13-2.53.27-3.85.4a2.98168 2.98168 0 0 1 -2.6-1.03 2.95185 2.95185 0 0 1 -.64-2.69 43.28241 43.28241 0 0 0 1.47-8.19c0-3.29 0-9.42-8.43005-9.42a1.01208 1.01208 0 0 0 -.9.56c-.03.07-3.47 7-7.22 13.17a25.64458 25.64458 0 0 1 -9.6 8.95c.09.21.18.42.26.63995a6.77 6.77 0 0 1 .35 1.30005 7.4175 7.4175 0 0 1 .16 1.55v20.54a8.93837 8.93837 0 0 1 -.19 1.8 8.57389 8.57389 0 0 1 -.76 2.11 9.57177 9.57177 0 0 0 4.52 2.45c7.71 1.78 18.59 3.47 26.61 1.4a10.85148 10.85148 0 0 0 7.19-6.46c2.85002-7.18003 6.72001-20.05002.57005-25.65z" fill="#8a2323" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/><path d="m14.88586 25.94855a6.28991 6.28991 0 0 0 -4.49-1.86 6.391 6.391 0 0 0 -6.39 6.37v20.54a6.3867 6.3867 0 0 0 6.38 6.39 6.38459 6.38459 0 0 0 6.39-6.39v-20.54a6.37783 6.37783 0 0 0 -.39-2.17 6.04215 6.04215 0 0 0 -1.5-2.34z" fill="#8a2323" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/></g></g></svg>
`;
                    const likeUnselectedSVG = `<svg id="Line_copy" height="20" viewBox="0 0 64 64" width="20" xmlns="http://www.w3.org/2000/svg" data-name="Line copy"><path d="m56.71045 26.64844a6.8354 6.8354 0 0 0 -5.33645-1.59278c-1.46435.15332-3.49658.36622-5.45507.56153a3.00565 3.00565 0 0 1 -2.5962-1.02246 2.96361 2.96361 0 0 1 -.64257-2.69825 42.54654 42.54654 0 0 0 1.47267-8.18948c0-3.291 0-9.416-8.43408-9.416a1.00065 1.00065 0 0 0 -.89648.55664c-.03418.06933-3.47168 7.0039-7.21729 13.17187a26.55934 26.55934 0 0 1 -11.69238 10.01272 5.87035 5.87035 0 0 0 -1.01172-1.3125 6.25823 6.25823 0 0 0 -4.5083-1.87891 6.39034 6.39034 0 0 0 -6.39258 6.37305v20.54a6.38348 6.38348 0 0 0 12.544 1.67191 9.71813 9.71813 0 0 0 5.79492 3.93457 83.12592 83.12592 0 0 0 18.001 2.35645 34.82632 34.82632 0 0 0 8.60938-.95606 10.80359 10.80359 0 0 0 7.189-6.47265c2.85535-7.17188 6.72645-20.04004.57215-25.63965zm-41.94434 25.10547a4.38306 4.38306 0 0 1 -8.76611 0v-20.54a4.388 4.388 0 0 1 4.39258-4.373 4.28957 4.28957 0 0 1 3.09961 1.29883 4.15258 4.15258 0 0 1 .99951 1.56826l.01269.03418a4.29084 4.29084 0 0 1 .26172 1.47168zm39.51612-.21191a8.794 8.794 0 0 1 -5.833 5.28223c-8.04639 2.08105-19.52979.00781-25.66358-1.41406a7.82386 7.82386 0 0 1 -6.01953-7.59473v-16.60157a6.25552 6.25552 0 0 0 -.13818-1.3086c.02539-.01172.05127-.02441.07715-.03613a28.55986 28.55986 0 0 0 12.60741-10.80859c3.165-5.21094 6.10986-10.958 7.01758-12.75684 5.82275.24414 5.82275 4.041 5.82275 7.40332a42.79093 42.79093 0 0 1 -1.415 7.71192 5.00717 5.00717 0 0 0 5.3833 6.1875c1.9585-.19434 3.99463-.40723 5.46192-.5625a4.84811 4.84811 0 0 1 3.78174 1.083c5.45894 4.96875 1.06001 18.03418-1.08256 23.41505z" fill="rgb(0,0,0)"/></svg>

`;
                    const dislikeSelectedSVG = `<svg id="Glyph" height="20" viewBox="0 0 64 64" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs"><g width="100%" height="100%" transform="matrix(-1,0,0,-1,63.9999942779541,63.99995994567871)"><g fill="rgb(0,0,0)"><path d="m56.71588 26.64856a6.90936 6.90936 0 0 0 -5.33-1.6l-1.61.17c-1.19.13-2.53.27-3.85.4a2.98168 2.98168 0 0 1 -2.6-1.03 2.95185 2.95185 0 0 1 -.64-2.69 43.28241 43.28241 0 0 0 1.47-8.19c0-3.29 0-9.42-8.43005-9.42a1.01208 1.01208 0 0 0 -.9.56c-.03.07-3.47 7-7.22 13.17a25.64458 25.64458 0 0 1 -9.6 8.95c.09.21.18.42.26.63995a6.77 6.77 0 0 1 .35 1.30005 7.4175 7.4175 0 0 1 .16 1.55v20.54a8.93837 8.93837 0 0 1 -.19 1.8 8.57389 8.57389 0 0 1 -.76 2.11 9.57177 9.57177 0 0 0 4.52 2.45c7.71 1.78 18.59 3.47 26.61 1.4a10.85148 10.85148 0 0 0 7.19-6.46c2.85002-7.18003 6.72001-20.05002.57005-25.65z" fill="#8a2323" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/><path d="m14.88586 25.94855a6.28991 6.28991 0 0 0 -4.49-1.86 6.391 6.391 0 0 0 -6.39 6.37v20.54a6.3867 6.3867 0 0 0 6.38 6.39 6.38459 6.38459 0 0 0 6.39-6.39v-20.54a6.37783 6.37783 0 0 0 -.39-2.17 6.04215 6.04215 0 0 0 -1.5-2.34z" fill="#8a2323" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/></g></g></svg>


`;
                    const dislikeUnselectedSVG = `   <svg id="Line_copy" height="20" viewBox="0 0 64 64" width="20" xmlns="http://www.w3.org/2000/svg" data-name="Line copy" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs"><g width="100%" height="100%" transform="matrix(-1,0,0,-1,63.99134540557861,64.01125717163086)"><path d="m56.71045 26.64844a6.8354 6.8354 0 0 0 -5.33645-1.59278c-1.46435.15332-3.49658.36622-5.45507.56153a3.00565 3.00565 0 0 1 -2.5962-1.02246 2.96361 2.96361 0 0 1 -.64257-2.69825 42.54654 42.54654 0 0 0 1.47267-8.18948c0-3.291 0-9.416-8.43408-9.416a1.00065 1.00065 0 0 0 -.89648.55664c-.03418.06933-3.47168 7.0039-7.21729 13.17187a26.55934 26.55934 0 0 1 -11.69238 10.01272 5.87035 5.87035 0 0 0 -1.01172-1.3125 6.25823 6.25823 0 0 0 -4.5083-1.87891 6.39034 6.39034 0 0 0 -6.39258 6.37305v20.54a6.38348 6.38348 0 0 0 12.544 1.67191 9.71813 9.71813 0 0 0 5.79492 3.93457 83.12592 83.12592 0 0 0 18.001 2.35645 34.82632 34.82632 0 0 0 8.60938-.95606 10.80359 10.80359 0 0 0 7.189-6.47265c2.85535-7.17188 6.72645-20.04004.57215-25.63965zm-41.94434 25.10547a4.38306 4.38306 0 0 1 -8.76611 0v-20.54a4.388 4.388 0 0 1 4.39258-4.373 4.28957 4.28957 0 0 1 3.09961 1.29883 4.15258 4.15258 0 0 1 .99951 1.56826l.01269.03418a4.29084 4.29084 0 0 1 .26172 1.47168zm39.51612-.21191a8.794 8.794 0 0 1 -5.833 5.28223c-8.04639 2.08105-19.52979.00781-25.66358-1.41406a7.82386 7.82386 0 0 1 -6.01953-7.59473v-16.60157a6.25552 6.25552 0 0 0 -.13818-1.3086c.02539-.01172.05127-.02441.07715-.03613a28.55986 28.55986 0 0 0 12.60741-10.80859c3.165-5.21094 6.10986-10.958 7.01758-12.75684 5.82275.24414 5.82275 4.041 5.82275 7.40332a42.79093 42.79093 0 0 1 -1.415 7.71192 5.00717 5.00717 0 0 0 5.3833 6.1875c1.9585-.19434 3.99463-.40723 5.46192-.5625a4.84811 4.84811 0 0 1 3.78174 1.083c5.45894 4.96875 1.06001 18.03418-1.08256 23.41505z" fill="#000000" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/></g></svg>
`;

                    // Toggle SVGs
                    if (action === 'like') {
                        if (likeBtn) likeBtn.innerHTML = likeSelectedSVG;
                        if (dislikeBtn) dislikeBtn.innerHTML = dislikeUnselectedSVG;
                    } else {
                        if (likeBtn) likeBtn.innerHTML = likeUnselectedSVG;
                        if (dislikeBtn) dislikeBtn.innerHTML = dislikeSelectedSVG;
                    }
                    // Optionally, send dislike to backend here
                }
                // Auth Modal
                function showAuthModal() {
                    document.getElementById('auth-modal').style.display = 'flex';
                }

                function hideAuthModal() {
                    document.getElementById('auth-modal').style.display = 'none';
                }
                // OTP Modal
                function showOTPModal() {
                    document.getElementById('otp-modal').style.display = 'flex';
                    document.getElementById('otp-phone-number').textContent = document.getElementById('auth-phone')
                        .value;
                    document.querySelector('.otp-box[data-index="1"]').focus();
                    startOTPTimer();
                }

                function hideOTPModal() {
                    document.getElementById('otp-modal').style.display = 'none';
                }
 function getOTP() {
                    return Array.from(otpInputs).map(inp => inp.value).join('');
                }
                // Initialize Firebase FIRST before any firebase.auth() or firebase.firestore() calls
                const firebaseConfig = {
                    apiKey: 'AIzaSyBqLtJbDYe-X-5a-d2BLc-su-X9GlxclQ0',
                    authDomain: 'localhost',
                    projectId: 'user-wishlist',
                    storageBucket: 'user-wishlist.firebasestorage.app',
                    messagingSenderId: '718283592432',
                    appId: '1:718283592432:web:ec986b729c43ae39872835',
                    measurementId: 'G-MJRQ18F8Z4',
                };
                if (!firebase.apps.length) {
                    firebase.initializeApp(firebaseConfig);
                }
                const auth = firebase.auth();
                const db = firebase.firestore();
                let confirmationResult = null;

                // Auth form submit
                document.getElementById('auth-form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const name = document.getElementById('auth-name').value.trim();
                    const phone = document.getElementById('auth-phone').value.trim();
                    if (!name) {
                        document.getElementById('auth-error').textContent = 'Name required.';
                        return;
                    }
                    if (!/^\d{10}$/.test(phone)) {
                        document.getElementById('auth-error').textContent = 'Enter valid 10-digit phone.';
                        return;
                    }
                    document.getElementById('auth-error').textContent = '';
                    hideAuthModal();
                    showOTPModal();
                    // Initialize reCAPTCHA verifier once on page load
                    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                        'size': 'invisible',
                        'callback': (response) => {
                            console.log('reCAPTCHA solved, proceed with OTP verification.');
                        },
                        'expired-callback': () => {
                            console.log('reCAPTCHA expired, please try again.');
                        }
                    });
                    const fullPhone = '+91' + phone;
                    auth.signInWithPhoneNumber(fullPhone, window.recaptchaVerifier)
                        .then(function(result) {
                            confirmationResult = result;
                            window.confirmationResult = result;
                        }).catch(function(error) {
                            console.log('reCAPTCHA error:', error);
                            document.getElementById('otp-error').textContent = 'OTP send error.';
                        });
                });

                // OTP verify (single handler, prevent duplicate AJAX)
                    var otpInputs = document.querySelectorAll('.otp-box');
                var verifyBtn = document.getElementById('verify-otp-btn');
                verifyBtn.addEventListener('click', function() {
                    if (window.otpVerifiedCalled) return;
                    window.otpVerifiedCalled = true;
                    verifyBtn.disabled = true;
                    var otp = getOTP();
                    if (otp.length !== 6 || !confirmationResult) {
                        document.getElementById('otp-error').textContent = 'Please enter a valid 6-digit OTP.';
                        window.otpVerifiedCalled = false;
                        verifyBtn.disabled = false;
                        return;
                    }
                    document.querySelector('.otp-loading').style.display = 'block';
                    confirmationResult.confirm(otp)
                        .then(async function(result) {
                            isAuthenticated = true;
                            userId = result.user.uid;
                            const name = document.getElementById('auth-name').value.trim();
                            const phone = result.user.phoneNumber;
                            const idToken = await result.user.getIdToken();
                            const refreshToken = result.user.refreshToken;
                            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                            const ownername = '{{ $user_slug }}';
                            const owneruserid = "{{ $ownerId }}";
                            const shareId = "{{ $shareId }}";
                            fetch("{{ route('user.create') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrf
                                },
                                body: JSON.stringify({
                                    username: name,
                                    phoneno: phone,
                                    idToken: idToken,
                                    ownername: ownername,
                                    owneruserid: owneruserid,
                                    refreshToken: refreshToken,
                                    shareId: shareId
                                })
                            })
                            .then(res => {
                                const contentType = res.headers.get('content-type');
                                if (!res.ok) {
                                    return res.text().then(text => { throw new Error(text); });
                                }
                                if (contentType && contentType.indexOf('application/json') !== -1) {
                                    return res.json();
                                } else {
                                    return res.text().then(text => { throw new Error(text); });
                                }
                            })
                            .then(data => {
                                document.querySelector('.otp-loading').style.display = 'none';
                                document.querySelector('.otp-success').style.display = 'block';
                                document.querySelector('.otp-inputs').style.opacity = '0.5';
                                verifyBtn.style.display = 'none';
                                setTimeout(() => {
                                    hideOTPModal();
                                }, 1200);
                            })
                            .catch(function(error) {
                                document.querySelector('.otp-loading').style.display = 'none';
                                document.getElementById('otp-error').textContent =
                                    'User creation failed or server error. ' + error.message;
                                window.otpVerifiedCalled = false;
                                verifyBtn.disabled = false;
                            });
                        })
                        .catch(function(error) {
                            document.querySelector('.otp-loading').style.display = 'none';
                            document.getElementById('otp-error').textContent =
                                'Invalid OTP. Please try again.' + error;
                            window.otpVerifiedCalled = false;
                            verifyBtn.disabled = false;
                        });
                });

                // OTP timer logic
                let otpTimer = null;
                let otpTimeLeft = 120;

                function startOTPTimer() {
                    clearInterval(otpTimer);
                    otpTimeLeft = 120;
                    updateTimerDisplay();
                    otpTimer = setInterval(() => {
                        otpTimeLeft--;
                        updateTimerDisplay();
                        if (otpTimeLeft <= 0) {
                            clearInterval(otpTimer);
                            // Enable resend button if you have one
                        }
                    }, 1000);
                }

                function updateTimerDisplay() {
                    const timerEl = document.getElementById('otp-timer');
                    if (timerEl) {
                        const minutes = Math.floor(otpTimeLeft / 60);
                        const seconds = otpTimeLeft % 60;
                        timerEl.textContent =
                            `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    }
                }

            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var authModal = document.getElementById('auth-modal');
                var authCloseBtn = document.getElementById('auth-modal-close');
                var otpModal = document.getElementById('otp-modal');
                var otpCloseBtn = document.getElementById('otp-modal-close');
                if (authCloseBtn) {
                    authCloseBtn.onclick = function() {
                        authModal.style.display = 'none';
                    };
                }

                if (otpCloseBtn) {
                    otpCloseBtn.onclick = function() {
                        otpModal.style.display = 'none';
                    };
                }
            });
        </script>


    @endsection
