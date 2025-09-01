@extends('layouts.app')

@section('title', 'Wishlist')
@section('content')

    <!-- Debug: Show session user info -->
    @if(session('user_id'))
    @php
        // dd(session()->all());


        @endphp
        <div style="background:#e7f7e7;color:#222;padding:10px;margin-bottom:10px;border:1px solid #8a2323;">
            <strong>Session User Info:</strong><br>
            User ID: {{ session('user_id') }}<br>
            ID Token: {{ session('id_token') }}<br>
            Refresh Token: {{ session('refresh_token') }}<br>
            Username: {{ session('username') }}
        </div>
    @else
        <div style="background:#fbe7e7;color:#222;padding:10px;margin-bottom:10px;border:1px solid #8a2323;">
            <strong>No user session found.</strong>
        </div>
    @endif
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

                                          <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512">
  <g>
    <!-- Thumbs up style shape only, border removed -->
    <path d="M347.861 218.803h-25.444c16.446-28.293 21.18-55.293 12.164-73.569-6.608-13.396-19.856-20.772-37.304-20.772-5.063 0-9.626 3.055-11.557 7.735-11.836 28.71-41.981 69.492-71.228 97.803-4.875-9.641-14.872-16.271-26.394-16.271h-38.576c-16.301 0-29.563 13.262-29.563 29.563v114.685c0 16.301 13.262 29.563 29.563 29.563h38.576c8.586 0 16.326-3.682 21.732-9.547 7.374 5.981 16.588 9.547 26.58 9.547h97.134c21.437 0 38.524-17.243 43.534-43.928l14.317-76.267c2.116-11.271-.968-22.601-8.685-31.9-8.646-10.422-21.673-16.642-34.849-16.642zm-155.2 139.173c0 2.474-2.089 4.563-4.563 4.563h-38.576c-2.473 0-4.563-2.089-4.563-4.563v-114.685c0-2.474 2.089-4.563 4.563-4.563h38.576c2.474 0 4.563 2.089 4.563 4.563zm174.163-95.246-14.317 76.267c-.738 3.932-5.121 23.541-18.963 23.541h-97.134c-10.338 0-18.749-9.525-18.749-21.234v-80.456c33.186-27.958 69.915-74.558 87.259-110.415 5.108 1.541 6.573 4.51 7.24 5.86 5.557 11.265-.601 38.034-23.122 67.402-2.896 3.776-3.396 8.869-1.291 13.137s6.451 6.97 11.21 6.97h48.903c5.649 0 11.776 2.984 15.609 7.604 2.04 2.457 4.277 6.416 3.355 11.324z"
          fill="#000000"/>
  </g>
</svg>
                                        </button>

                                        <button
                                            class="dislike-btn wishlist-btn "
                                            data-action="dislike" style="background:none;border:none;cursor:pointer;">
                                         <svg id="Layer_1" enable-background="new 0 0 512 512" height="20" width="20" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs">
  <g width="100%" height="100%" transform="matrix(-1,0,0,-1,512,512)">
    <path d="M347.861 218.803h-25.444c16.446-28.293 21.18-55.293 12.164-73.569-6.608-13.396-19.856-20.772-37.304-20.772-5.063 0-9.626 3.055-11.557 7.735-11.836 28.71-41.981 69.492-71.228 97.803-4.875-9.641-14.872-16.271-26.394-16.271h-38.576c-16.301 0-29.563 13.262-29.563 29.563v114.685c0 16.301 13.262 29.563 29.563 29.563h38.576c8.586 0 16.326-3.682 21.732-9.547 7.374 5.981 16.588 9.547 26.58 9.547h97.134c21.437 0 38.524-17.243 43.534-43.928l14.317-76.267c2.116-11.271-.968-22.601-8.685-31.9-8.646-10.422-21.673-16.642-34.849-16.642zm-155.2 139.173c0 2.474-2.089 4.563-4.563 4.563h-38.576c-2.473 0-4.563-2.089-4.563-4.563v-114.685c0-2.474 2.089-4.563 4.563-4.563h38.576c2.474 0 4.563 2.089 4.563 4.563zm174.163-95.246-14.317 76.267c-.738 3.932-5.121 23.541-18.963 23.541h-97.134c-10.338 0-18.749-9.525-18.749-21.234v-80.456c33.186-27.958 69.915-74.558 87.259-110.415 5.108 1.541 6.573 4.51 7.24 5.86 5.557 11.265-.601 38.034-23.122 67.402-2.896 3.776-3.396 8.869-1.291 13.137s6.451 6.97 11.21 6.97h48.903c5.649 0 11.776 2.984 15.609 7.604 2.04 2.457 4.277 6.416 3.355 11.324z" fill="#000000"/>
  </g>
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
                    @csrf
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
                <button id="verify-otp-btn" class="btn btn-success w-100" >Verify OTP</button>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script><script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

            // OTP modal logic (all functions together)
            var otpInputs = document.querySelectorAll('.otp-box');
            var verifyBtn = document.getElementById('verify-otp-btn');
            otpInputs.forEach((input, idx) => {
                input.addEventListener('input', function(e) {
                    // Only allow numbers
                    if (this.value && !/^\d$/.test(this.value)) {
                        this.value = '';
                        return;
                    }
                    // Auto-move to next
                    if (this.value && idx < otpInputs.length - 1) {
                        otpInputs[idx + 1].focus();
                    }
                    // Enable verify button only if all filled
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

            function showLoading(show) {
                const loadingEl = document.querySelector('.otp-loading');
                const errorEl = document.getElementById('otp-error');
                if (show) {
                    loadingEl.style.display = 'block';
                    errorEl.textContent = '';
                    verifyBtn.disabled = true;
                } else {
                    loadingEl.style.display = 'none';
                    verifyBtn.disabled = false;
                }
            }

            function showSuccess() {
                const successEl = document.querySelector('.otp-success');
                successEl.style.display = 'block';
                showLoading(false);
                document.querySelector('.otp-inputs').style.opacity = '0.5';
                verifyBtn.style.display = 'none';
                setTimeout(() => {
                    hideOTPModal();
                    if (window.pendingBtn) handleLikeDislike(window.pendingBtn);
                }, 1000);
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
                const fullPhone = '+91' + phone;
                console.log('fullPhone', fullPhone);
                auth.signInWithPhoneNumber(fullPhone, recaptchaVerifier)
                    .then(function(result) {
                        confirmationResult = result;
                        window.confirmationResult = result;
                        console.log('OTP sent successfully');
                        console.log('window.confirmationResult:', window.confirmationResult);
                    }).catch(function(error) {
                        console.log(error);
                        document.getElementById('otp-error').textContent = 'OTP send error.';
                    });
            });

            // OTP verify (single handler, prevent duplicate AJAX)
            verifyBtn.addEventListener('click', function() {
                if (window.otpVerifiedCalled) return;
                window.otpVerifiedCalled = true;
                verifyBtn.disabled = true;
                var otp = getOTP();
                console.log('otp:', otp);
                if (otp.length !== 6 || !confirmationResult) {
                    document.getElementById('otp-error').textContent = 'Enter 6-digit OTP.';
                    window.otpVerifiedCalled = false;
                    verifyBtn.disabled = false;
                    return;
                }
                // showLoading(true);
                confirmationResult.confirm(otp)
                    .then(async function(result) {
                        // showSuccess();
                        isAuthenticated = true;
                        userId = result.user.uid;
                        const name = document.getElementById('auth-name').value.trim();
                        // Use verified phone number from Firebase user object
                        const phone = result.user.phoneNumber;
                        const idToken = await result.user.getIdToken();
                        // Static owner fields (replace with actual values if needed)
                        const ownername = 'staticOwnerName';
                        const owneruserid = 'staticOwnerUserId';
                        fetch('/user/create', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                username: name,
                                phoneno: phone,
                                idToken: idToken,
                                ownername: ownername,
                                owneruserid: owneruserid
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            // Optionally handle response
                            console.log('User created:', data);
                            // Show success message and close OTP modal
                            document.querySelector('.otp-success').style.display = 'block';
                            document.querySelector('.otp-inputs').style.opacity = '0.5';
                            verifyBtn.style.display = 'none';
                            setTimeout(() => {
                                hideOTPModal();
                                if (window.pendingBtn) handleLikeDislike(window.pendingBtn);
                            }, 1200);
                        });
                    .catch(function(error) {
                        // showLoading(false);
                        console.log('OTP verification error:', error);
                        document.getElementById('otp-error').textContent = 'Invalid OTP.';
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
                    timerEl.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                }
            }
        });
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
                // If user_id exists in session, set isAuthenticated true
                @if(session('user_id'))
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
                    const userId = "{{ session('user_id') }}";
                    const ownerId = "{{$ownerId}}"
                    console.log(ownerId);
                    if (action === 'like' && userId && sku) {
                        $.ajax({
                            url: '/users/' + ownerId + '/wishlist/items/like',
                            type: 'POST',
                            data: { sku: sku },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log('Like API response:', response);
                                // Optionally show popup or update UI
                            },
                            error: function(xhr) {
                                console.error('Like API error:', xhr);
                            }
                        });
                    }
                    // SVGs for selected/unselected states
                    const likeSelectedSVG = `<svg height="20" viewBox="0 0 426.66667 426.66667" width="20" xmlns="http://www.w3.org/2000/svg">
  <g>
    <!-- Removed the sky-blue circle -->
    <path d="m288 170.667969h-32c-5.882812-.019531-10.648438-4.785157-10.667969-10.667969 0-39.148438-.746093-50.558594-21.546875-52.90625-2.558594 56.640625-25.597656 71.679688-63.785156 73.8125v87.46875c5.609375 1.859375 10.871094 4.636719 15.574219 8.210938 10.71875 8.386718 24.1875 12.457031 37.757812 11.414062h64c17.652344-.050781 31.949219-14.347656 32-32v-74.667969c0-5.011719 0-10.664062-21.332031-10.664062zm0 0" fill="#c0c6cc"/>
    <path d="m117.332031 160h21.335938v128h-21.335938zm0 0" fill="#c0c6cc"/>
    <g fill="#fff">
      <path d="m288 149.332031h-21.332031c-.429688-36.480469-4.589844-64-53.335938-64-5.882812.019531-10.648437 4.785157-10.664062 10.667969 0 52.054688-13.121094 62.1875-42.667969 63.679688v-10.347657c-.015625-5.882812-4.78125-10.648437-10.667969-10.664062h-42.664062c-5.886719.015625-10.652344 4.78125-10.667969 10.664062v149.335938c.015625 5.882812 4.78125 10.648437 10.667969 10.664062h42.664062c5.886719-.015625 10.652344-4.78125 10.667969-10.664062v-6.722657c7.359375 2.453126 17.171875 17.386719 53.332031 17.386719h64c29.453125-.007812 53.324219-23.882812 53.335938-53.332031v-74.667969c0-21.226562-14.402344-32-42.667969-32zm-149.332031 138.667969h-21.335938v-128h21.335938zm170.664062-32c-.050781 17.652344-14.347656 31.949219-32 32h-64c-13.570312 1.042969-27.039062-3.027344-37.757812-11.414062-4.703125-3.574219-9.964844-6.351563-15.574219-8.210938v-87.46875c38.1875-2.132812 61.226562-17.171875 63.785156-73.8125 20.800782 2.347656 21.546875 13.757812 21.546875 52.90625.019531 5.882812 4.785157 10.648438 10.667969 10.667969h32c21.332031 0 21.332031 5.652343 21.332031 10.664062zm0 0"/>
    </g>
  </g>
</svg>
`;
                    const likeUnselectedSVG = ` <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512">
  <g>
    <!-- Thumbs up style shape only, border removed -->
    <path d="M347.861 218.803h-25.444c16.446-28.293 21.18-55.293 12.164-73.569-6.608-13.396-19.856-20.772-37.304-20.772-5.063 0-9.626 3.055-11.557 7.735-11.836 28.71-41.981 69.492-71.228 97.803-4.875-9.641-14.872-16.271-26.394-16.271h-38.576c-16.301 0-29.563 13.262-29.563 29.563v114.685c0 16.301 13.262 29.563 29.563 29.563h38.576c8.586 0 16.326-3.682 21.732-9.547 7.374 5.981 16.588 9.547 26.58 9.547h97.134c21.437 0 38.524-17.243 43.534-43.928l14.317-76.267c2.116-11.271-.968-22.601-8.685-31.9-8.646-10.422-21.673-16.642-34.849-16.642zm-155.2 139.173c0 2.474-2.089 4.563-4.563 4.563h-38.576c-2.473 0-4.563-2.089-4.563-4.563v-114.685c0-2.474 2.089-4.563 4.563-4.563h38.576c2.474 0 4.563 2.089 4.563 4.563zm174.163-95.246-14.317 76.267c-.738 3.932-5.121 23.541-18.963 23.541h-97.134c-10.338 0-18.749-9.525-18.749-21.234v-80.456c33.186-27.958 69.915-74.558 87.259-110.415 5.108 1.541 6.573 4.51 7.24 5.86 5.557 11.265-.601 38.034-23.122 67.402-2.896 3.776-3.396 8.869-1.291 13.137s6.451 6.97 11.21 6.97h48.903c5.649 0 11.776 2.984 15.609 7.604 2.04 2.457 4.277 6.416 3.355 11.324z"
          fill="#000000"/>
  </g>
</svg>`;
                    const dislikeSelectedSVG = `<svg height="20" viewBox="0 0 426.66667 426.66667" width="20" xmlns="http://www.w3.org/2000/svg">
  <g transform="matrix(-1,0,0,-1,426.66796875,426.66796875)">
    <!-- Removed sky-blue background and outer circle -->
    <path d="m288 170.667969h-32c-5.882812-.019531-10.648438-4.785157-10.667969-10.667969 0-39.148438-.746093-50.558594-21.546875-52.90625-2.558594 56.640625-25.597656 71.679688-63.785156 73.8125v87.46875c5.609375 1.859375 10.871094 4.636719 15.574219 8.210938 10.71875 8.386718 24.1875 12.457031 37.757812 11.414062h64c17.652344-.050781 31.949219-14.347656 32-32v-74.667969c0-5.011719 0-10.664062-21.332031-10.664062zm0 0" fill="#c0c6cc"/>
    <path d="m117.332031 160h21.335938v128h-21.335938zm0 0" fill="#c0c6cc"/>
    <g fill="#fff">
      <path d="m288 149.332031h-21.332031c-.429688-36.480469-4.589844-64-53.335938-64-5.882812.019531-10.648437 4.785157-10.664062 10.667969 0 52.054688-13.121094 62.1875-42.667969 63.679688v-10.347657c-.015625-5.882812-4.78125-10.648437-10.667969-10.664062h-42.664062c-5.886719.015625-10.652344 4.78125-10.667969 10.664062v149.335938c.015625 5.882812 4.78125 10.648437 10.667969 10.664062h42.664062c5.886719-.015625 10.652344-4.78125 10.667969-10.664062v-6.722657c7.359375 2.453126 17.171875 17.386719 53.332031 17.386719h64c29.453125-.007812 53.324219-23.882812 53.335938-53.332031v-74.667969c0-21.226562-14.402344-32-42.667969-32zm-149.332031 138.667969h-21.335938v-128h21.335938zm170.664062-32c-.050781 17.652344-14.347656 31.949219-32 32h-64c-13.570312 1.042969-27.039062-3.027344-37.757812-11.414062-4.703125-3.574219-9.964844-6.351563-15.574219-8.210938v-87.46875c38.1875-2.132812 61.226562-17.171875 63.785156-73.8125 20.800782 2.347656 21.546875 13.757812 21.546875 52.90625.019531 5.882812 4.785157 10.648438 10.667969 10.667969h32c21.332031 0 21.332031 5.652343 21.332031 10.664062zm0 0"/>
    </g>
  </g>
</svg>


`;
                    const dislikeUnselectedSVG = `  <svg id="Layer_1" enable-background="new 0 0 512 512" height="20" width="20" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs">
  <g width="100%" height="100%" transform="matrix(-1,0,0,-1,512,512)">
    <path d="M347.861 218.803h-25.444c16.446-28.293 21.18-55.293 12.164-73.569-6.608-13.396-19.856-20.772-37.304-20.772-5.063 0-9.626 3.055-11.557 7.735-11.836 28.71-41.981 69.492-71.228 97.803-4.875-9.641-14.872-16.271-26.394-16.271h-38.576c-16.301 0-29.563 13.262-29.563 29.563v114.685c0 16.301 13.262 29.563 29.563 29.563h38.576c8.586 0 16.326-3.682 21.732-9.547 7.374 5.981 16.588 9.547 26.58 9.547h97.134c21.437 0 38.524-17.243 43.534-43.928l14.317-76.267c2.116-11.271-.968-22.601-8.685-31.9-8.646-10.422-21.673-16.642-34.849-16.642zm-155.2 139.173c0 2.474-2.089 4.563-4.563 4.563h-38.576c-2.473 0-4.563-2.089-4.563-4.563v-114.685c0-2.474 2.089-4.563 4.563-4.563h38.576c2.474 0 4.563 2.089 4.563 4.563zm174.163-95.246-14.317 76.267c-.738 3.932-5.121 23.541-18.963 23.541h-97.134c-10.338 0-18.749-9.525-18.749-21.234v-80.456c33.186-27.958 69.915-74.558 87.259-110.415 5.108 1.541 6.573 4.51 7.24 5.86 5.557 11.265-.601 38.034-23.122 67.402-2.896 3.776-3.396 8.869-1.291 13.137s6.451 6.97 11.21 6.97h48.903c5.649 0 11.776 2.984 15.609 7.604 2.04 2.457 4.277 6.416 3.355 11.324z" fill="#000000"/>
  </g>
</svg>`;

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
                    document.getElementById('otp-phone-number').textContent = document.getElementById('auth-phone').value;
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
                var verifyBtn = document.getElementById('verify-otp-btn');
                verifyBtn.addEventListener('click', function() {
                    if (window.otpVerifiedCalled) return;
                    window.otpVerifiedCalled = true;
                    verifyBtn.disabled = true;
                    var otp = Array.from(document.querySelectorAll('.otp-box')).map(inp => inp.value).join('');
                    if (otp.length !== 6 || !confirmationResult) {
                        document.getElementById('otp-error').textContent = 'Enter 6-digit OTP.';
                        window.otpVerifiedCalled = false;
                        verifyBtn.disabled = false;
                        return;
                    }
                    // showLoading(true);
                    confirmationResult.confirm(otp)
                        .then(async function(result) {
                            // showSuccess();
                            console.log(result);
                            isAuthenticated = true;
                            userId = result.user.uid;
                            const name = document.getElementById('auth-name').value.trim();
                            const phone = result.user.phoneNumber;
                            const idToken = await result.user.getIdToken();
                            const refreshToken =  result.user.refreshToken;
                            console.log(phone, "auth-phone");
                            console.log(idToken);
                            // Static owner fields (replace with actual values if needed)
                            const ownername = 'staticOwnerName';
                            const owneruserid = 'staticOwnerUserId';
                            fetch('/user/create', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    username: name,
                                    phoneno: phone,
                                    idToken: idToken,
                                    ownername: ownername,
                                    owneruserid: owneruserid
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                console.log("line4")
                                // Optionally handle response
                                console.log('User created:', data);
                            });
                        })
                        .catch(function(error) {
                            // showLoading(false);
                            console.log('OTP verification error:', error);
                            document.getElementById('otp-error').textContent = 'Invalid OTP. Please try again.' + error;
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
                        timerEl.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
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
