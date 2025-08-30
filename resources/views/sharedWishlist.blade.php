@extends('layouts.app')

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

                                    <div class="position-absolute top-0 end-0 m-2 p-0 border-0 bg-transparent d-flex flex-column">
                                        <button
                                            class="wishlist-btn border-0 bg-transparent"
                                            style="z-index:2;pointer-events:none;"
                                            aria-label="Remove from wishlist" data-product-sku="{{ $sku }}">
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
                                        <button
                                            class="like-btn wishlist-btn"
                                            data-action="like" style="background:none;border:none;cursor:pointer;">
                                            <!-- Created with Inkscape (http://www.inkscape.org/) -->

                                            <svg version="1.1" id="svg9" xml:space="preserve" width="20"
                                                height="20" viewBox="0 0 682.66669 682.66669"
                                                xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                                                <defs id="defs13">
                                                    <clipPath clipPathUnits="userSpaceOnUse" id="clipPath23">
                                                        <path d="M 0,512 H 512 V 0 H 0 Z" id="path21" />
                                                    </clipPath>
                                                </defs>
                                                <g id="g15" transform="matrix(1.3333333,0,0,-1.3333333,0,682.66667)">
                                                    <g id="g17">
                                                        <g id="g19" clip-path="url(#clipPath23)">
                                                            <g id="g25" transform="translate(127.4668,39.0996)">
                                                                <path
                                                                    d="m 0,0 h -72.3 c -22.092,0 -40.167,18.076 -40.167,40.167 v 160.667 c 0,22.092 18.075,40.166 40.167,40.166 H 0"
                                                                    style="fill:none;stroke:#000000;stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                    id="path27" />
                                                            </g>
                                                            <g id="g29" transform="translate(456.8325,312.2334)">
                                                                <path
                                                                    d="m 0,0 h -152.633 v 120.499 c 0,22.092 -18.074,40.168 -40.166,40.168 h -32.133 c -22.092,0 -40.167,-18.076 -40.167,-40.168 V 48.2 l -64.267,-80.334 v -241 h 249.034 c 22.092,0 48.943,15.801 59.672,35.112 l 41.322,74.377 c 10.729,19.312 19.506,53.187 19.506,75.279 v 48.199 C 40.168,-18.075 22.092,0 0,0 Z"
                                                                    style="fill:none;stroke:#000000;stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                    id="path31" />
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>

                                        </button>

                                        <button
                                            class="dislike-btn wishlist-btn "
                                            data-action="dislike" style="background:none;border:none;cursor:pointer;">
                                            <svg width="20" height="20"
                                                enable-background="new 0 0 12 12" viewBox="0 0 12 12"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m9 1.125h-8.5c-.2070313 0-.375.1679688-.375.375v6c0 .2070313.1679688.375.375.375h3.7993164l1.2998047 1.9506836c.3237305.4916992.6899414 1.0493164 1.4008789 1.0493164h.5c.3774414 0 .7070313-.1567383.9038086-.4296875.2055664-.2856445.2490234-.6733398.1186523-1.0639648l-.5024414-1.5063477h2.4799805c.7583008 0 1.375-.6166992 1.3730469-1.4121094-.0546875-.5463867-.5991211-5.3378906-2.8730469-5.3378906zm-8.125.75h2.25v5.25h-2.25zm9.625 5.25h-3c-.1206055 0-.2338867.0581055-.3041992.1557617s-.0898438.2236328-.0517578.3378906l.6669922 2c.0527344.1591797.0473633.3007813-.0161133.3886719-.0737305.1025391-.2163086.1176758-.2949219.1176758h-.5c-.2573242 0-.4375-.2104492-.675293-.5629883-.0039062-.0068359-.0083007-.0131836-.0126953-.0200195l-.1665039-.25c-.0019531-.0029297-.0039062-.0053711-.0058594-.0083008l-1.3276367-1.9916992c-.0693359-.1044922-.1865234-.1669922-.3120117-.1669922h-.625v-5.25h5.125c1.3535156 0 2.0053711 3.4526367 2.125 4.625 0 .3447266-.2802734.625-.625.625z"
                                                    fill="rgb(0,0,0)" />
                                            </svg>
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
        </div>
        <div class="mt-auto text-center py-4 fs-6 fw-200 text-custom-dark text-dark-gray opacity-75">
            &copy; Powered By <a href="https://www.mirrar.com/" class="base-color"> mirrAR</a>


        </div>


          <!-- Authentication Modal -->
        <div id="auth-modal"
            style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.5);z-index:9999;align-items:center;justify-content:center;">
            <div style="background:#fff;padding:2rem;border-radius:12px;max-width:350px;width:100%;position:relative;">
                <button type="button" id="auth-modal-close"
                    style="position:absolute;top:12px;right:16px;background:none;border:none;font-size:28px;line-height:1;z-index:10;cursor:pointer;"
                    aria-label="Close Auth Modal">&times;</button>
                <form id="auth-form">
                    <h5 class="mb-3">Authenticate to Like/Dislike</h5>
                    <div class="mb-2">
                        <input type="text" id="auth-name" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" id="auth-phone" class="form-control" placeholder="Phone (10 digits)"
                            maxlength="10" required>
                    </div>
                    <div id="auth-error" class="text-danger small mb-2"></div>
                    <button type="submit" class="btn btn-primary w-100">Send OTP</button>
                </form>
            </div>
        </div>


         <!-- OTP Modal -->
        <div id="otp-modal"
            style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.5);z-index:9999;align-items:center;justify-content:center;">
            <div style="background:#fff;padding:2rem;border-radius:12px;max-width:350px;width:100%;position:relative;">
                <button type="button" id="otp-modal-close"
                    style="position:absolute;top:12px;right:16px;background:none;border:none;font-size:28px;line-height:1;z-index:10;cursor:pointer;"
                    aria-label="Close OTP Modal">&times;</button>
                <h5>Verify OTP</h5>
                <p>Sent to <span id="otp-phone-number"></span></p>
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
                <div id="otp-error" class="text-danger small mb-2"></div>
                <div class="otp-loading" style="display:none;">
                    <span>Verifying OTP...</span>
                </div>
                <div class="otp-success" style="display:none;">
                    <span class="text-success">Verified!</span>
                </div>
                <p class="otp-timer">Resend OTP in <span id="otp-timer">02:00</span></p>
                <button id="verify-otp-btn" class="btn btn-success w-100" disabled>Verify OTP</button>
                <div id="recaptcha-container" class="d-none"></div>
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
            let recaptchaVerifier;
            recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                'size': 'invisible',
                'callback': (response) => {
                    console.log('reCAPTCHA solved, proceed with OTP verification.');
                },
                'expired-callback': () => {
                    console.log('reCAPTCHA expired, please try again.');
                }
            });

            const auth = firebase.auth();
            let confirmationResult = null;
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
                const fullPhone = '+91' + phone;
                auth.signInWithPhoneNumber(fullPhone, recaptchaVerifier)
                    .then(function(result) {
                        confirmationResult = result;
                        console.log(confirmationResult);
                    }).catch(function(error) {
                        console.log(error);
                        document.getElementById('otp-error').textContent = 'OTP send error.';
                    });
            });
            document.getElementById('verify-otp-btn').addEventListener('click', function() {
                const otp = Array.from(document.querySelectorAll('.otp-box')).map(inp => inp.value).join('');
                if (otp.length !== 6 || !confirmationResult) {
                    document.getElementById('otp-error').textContent = 'Enter 6-digit OTP.';
                    return;
                }
                document.querySelector('.otp-loading').style.display = 'flex';
                confirmationResult.confirm(otp)
                    .then(async function(result) {
                        document.querySelector('.otp-loading').style.display = 'none';
                        document.querySelector('.otp-success').style.display = 'flex';
                        isAuthenticated = true;
                        userId = result.user.uid;
                        // AJAX call to create user
                        const name = document.getElementById('auth-name').value.trim();
                        const phone = document.getElementById('auth-phone').value.trim();
                        fetch('/api/create-user', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ name, phone, uid: userId })
                        });
                        setTimeout(() => {
                            hideOTPModal();
                            if (window.pendingBtn) handleLikeDislike(window.pendingBtn);
                        }, 1000);
                    })
                    .catch(function(error) {
                        document.querySelector('.otp-loading').style.display = 'none';
                        document.getElementById('otp-error').textContent = 'Invalid OTP.';
                    });
            });
            // OTP timer logic (same as welcome.blade.php)
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
                    timerEl.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                }
            }
        });
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
                    const action = btn.getAttribute('data-action');
                    const card = btn.closest('.product-item-card');
                    card.querySelectorAll('.like-btn .like-icon').forEach(icon => icon.style.stroke = '#888');
                    card.querySelectorAll('.dislike-btn .dislike-icon').forEach(icon => icon.style.stroke = '#888');
                    if (action === 'like') {
                        btn.querySelector('.like-icon').style.stroke = 'green';
                    } else {
                        btn.querySelector('.dislike-icon').style.stroke = 'red';
                    }
                    // Optionally, send like/dislike to backend here
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

                const firebaseConfig = {
            apiKey: 'AIzaSyBqLtJbDYe-X-5a-d2BLc-su-X9GlxclQ0',
            authDomain: 'localhost',
            projectId: 'user-wishlist',
            storageBucket: 'user-wishlist.firebasestorage.app',
            messagingSenderId: '718283592432',
            appId: '1:718283592432:web:ec986b729c43ae39872835',
            measurementId: 'G-MJRQ18F8Z4',
        }

        firebase.initializeApp(firebaseConfig);
        const auth = firebase.auth(); // Use a consistent auth variable
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
                    // Send OTP using Firebase
                    // window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                    //     size: 'invisible'
                    // });
// Initialize reCAPTCHA verifier once on page load
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
            'size': 'invisible',
            'callback': (response) => {
                console.log('reCAPTCHA solved, proceed with OTP verification.');
                // reCAPTCHA solved, you can now proceed
            },
            'expired-callback': () => {
                console.log('reCAPTCHA expired, please try again.');
                // reCAPTCHA expired, re-render
            }
        });

                    const fullPhone = '+91' + phone;
                    console.log(fullPhone);
                    auth.signInWithPhoneNumber(fullPhone, window.recaptchaVerifier)
                        .then(function(result) {
                            window.confirmationResult = result;
console.log(window.confirmationResult);
                        }).catch(function(error) {
                            console.log(error);
                            document.getElementById('otp-error').textContent = 'OTP send error.';
                        });
                });
                // OTP verify
                document.getElementById('verify-otp-btn').addEventListener('click', function() {
                    const otp = Array.from(document.querySelectorAll('.otp-box')).map(inp => inp.value).join(
                    '');
                    if (otp.length !== 6 || !window.confirmationResult) {
                        document.getElementById('otp-error').textContent = 'Enter 6-digit OTP.';
                        return;
                    }
                    document.querySelector('.otp-loading').style.display = 'flex';
                    window.confirmationResult.confirm(otp)
                        .then(async function(result) {
                            document.querySelector('.otp-loading').style.display = 'none';
                            document.querySelector('.otp-success').style.display = 'flex';
                            isAuthenticated = true;
                            userId = result.user.uid;
                            // AJAX call to create user
                            const name = document.getElementById('auth-name').value.trim();
                            const phone = document.getElementById('auth-phone').value.trim();
                            fetch('/api/create-user', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    name,
                                    phone,
                                    uid: userId
                                })
                            });
                            setTimeout(() => {
                                hideOTPModal();
                                if (window.pendingBtn) handleLikeDislike(window.pendingBtn);
                            }, 1000);
                        })
                        .catch(function(error) {
                            document.querySelector('.otp-loading').style.display = 'none';
                            document.getElementById('otp-error').textContent = 'Invalid OTP.';
                        });
                });
                // OTP timer logic (same as welcome.blade.php)
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

        <script>

        </script>
    @endsection
