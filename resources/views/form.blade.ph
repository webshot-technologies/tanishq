<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Multi-Step Jewellery Showcase</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #fef9f7;

        }

        .step-container {
            display: none;
            transition: all 0.3s ease;
        }

        .step-container.active {
            display: flex;
        }

        .step-image {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .step-btns {
            margin-top: 2rem;
        }

        .outfit-btn {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 12px 24px;
            margin-right: 10px;
            background: white;
            font-weight: bold;
        }

        .highlight {
            font-weight: bold;
            color: #42210b;
        }

        .heading-large {
            font-size: 3rem;
            line-height: 1.2;
        }

        .caption {
            color: #42210b;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .brand {
            font-weight: bold;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <div class="container px-0">

        <!-- STEP 1 -->
        <div class="step-container active  mx-auto " id="step1" style="height: 100vh;">
            <div class="row align-items-center my-4 mx-auto container ">
                <div class="col-12 col-xl-10 card px-0 shadow-lg mx-auto rounded-4 overflow-hidden h-100 ">
                    <div class="row g-0 h-100">
                        <!-- LEFT: Step Section -->
                        <div id="step-section-container" class="col-lg-6 p-0 banner-height">
                            <!-- Step 1 Content -->
                            <div class="d-flex flex-column justify-content-between bg-custom-light p-4 p-md-5 h-100">
                                <div class=" text-custom-dark">
                                    <!-- Logo and Headline -->
                                    <div class="mb-5 ">
                                        <div class="d-flex flex-column align-items-start">
                                            <a href="/"><img src="{{ asset('image/logo.png') }}"class="form-logo-img"
                                                class="mb-2" alt="Tanishq Logo"></a>

                                        </div>
                                    </div>

                                    <!-- Step 1 Form -->
                                    <form id="step1-form" class=" mt-5">
                                        <div class="d-flex  mb-5">
                                            <h2 class=" fw-semibold me-3 mb-0">My dream</h2>
                                            <select
                                                class="form-select w-50 form-select-lg border-bottom border-custom-dark text-custom-dark py-0"
                                                required id="language-select">
                                                <option selected>Tamil</option>
                                                <option>Telugu</option>
                                                <option>Gujarati</option>
                                                <option>Bengali</option>
                                                <option>Odia</option>
                                                <option>Bihar</option>
                                                <option>UP</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-baseline mb-5">
                                            <select
                                                class="form-select form-select-lg border-bottom border-custom-dark text-custom-dark me-3 py-0"
                                                required id="event-select">
                                                <option selected>Mehendi</option>
                                                <option>Engagement</option>
                                                <option>Sangeet</option>
                                                <option>Haldi</option>
                                                <option>Cocktail</option>
                                                <option>Reception</option>
                                                <option>Wedding</option>
                                            </select>
                                            <h2 class=" fw-semibold">checklist.</h2>
                                        </div>

                                        <button type="submit" class="btn border border-2 rounded-5 btn-custom">Choose
                                            My
                                            Look</button>
                                    </form>
                                </div>

                               <div class="mt-4 text-center pt-4 fs-6 text-custom-dark opacity-75">
                    &copy; Powered by <a href="https://www.mirrar.com/" class="base-color"> MIRRAR </a>
                </div>
                            </div>
                        </div>

                        <!-- RIGHT: Image -->
                        <div class="col-lg-6 col-12  p-0 banner-height">
                            <img src="{{ asset('image/banner-img.jpg') }}" alt="Wedding jewelry on hands"
                                class="img-fluid w-100 h-100 object-fit-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- STEP 2 -->
        <div id="step2" class="step-container  overflow-hidden" style="min-height: 100vh; width: 100%;">
            <div class="row align-items-center ">
                <div
                    class="col-12 col-xl-10 card py-4 px-4 border-0 bg-transparent mx-auto rounded-4 overflow-hidden">
                    <div class="text-center mb-4 d-flex align-items-center justify-content-center" style="gap: 1rem;">
                        <button type="button" class="btn btn-link p-0 me-3 d-flex align-items-center"
                            onclick="prevStep(1)" style="position: absolute; left: 2rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#300708"
                                class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                            </svg>
                            <span class="visually-hidden">Back</span>
                        </button>
                         <a href="/"><img src="{{ asset('image/logo.png') }}"class="form-logo-img mb-2"
                                                alt="Tanishq Logo"></a>
                        {{-- <h2 class="fw-bold">Jewellery For Tamil Style Mehendi Ceremony</h2> --}}
                    </div>

                    <div class="row text-center outfit-selection-row mt-4">
                        <h2 class="base-color heading-content mb-5 light-font">
                            Jewellery For <span id="dynamic-language">Tamil</span> Style
                            <span id="dynamic-event">Mehendi</span> Ceremony
                        </h2>

                        <!-- Scrollable Row -->
                        <div class="d-flex flex-wrap md-flex-nowrap overflow-auto px-3 w-100 ">

                            <!-- Card 1 -->
                            <div class="outfit-card-wrapper mb-3  px-2">
                                <div class="card outfit-card bg-transparent shadow-md" data-outfit="gown">
                                    <img src="{{ asset('image/gown.jpeg') }}" class="card-img-top outfit-img"
                                        alt="Gown">
                                    <div class="card-body">
                                        <h5 class="card-title fw-semibold">Gown</h5>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="outfit-card-wrapper  mb-3 px-2">
                                <div class="card outfit-card bg-transparent active shadow-md" data-outfit="lehanga">
                                    <img src="{{ asset('image/lahnga.jpeg') }}" class="card-img-top outfit-img"
                                        alt="Lehanga">
                                    <div class="card-body">
                                        <h5 class="card-title fw-semibold">Lehanga</h5>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="outfit-card-wrapper mb-3  px-2">
                                <div class="card outfit-card bg-transparent" data-outfit="saree">
                                    <img src="{{ asset('image/saree.jpeg') }}" class="card-img-top outfit-img"
                                        alt="Saree">
                                    <div class="card-body">
                                        <h5 class="card-title fw-semibold">Saree</h5>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="outfit-card-wrapper  mb-3 px-2">
                                <div class="card outfit-card bg-transparent" data-outfit="anarkali">
                                    <img src="{{ asset('image/anarkali.jpeg') }}" class="card-img-top outfit-img"
                                        alt="Anarkali">
                                    <div class="card-body">
                                        <h5 class="card-title fw-semibold">Anarkali</h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div id="outfit-details-container " class="mt-4 ">





                </div>

                <div class=" col-12 col-xl-10 d-flex px-4 mx-auto justify-content-center my-4">

                    <button type="" onclick="nextStep(3)"
                        class="btn border border-2 rounded-5 btn-custom">Choose
                        Create List</button>

                    {{-- <button class="btn btn-primary" onclick="nextStep(3)">Create List</button> --}}
                </div>
               <div class="mt-4 text-center pt-4 fs-6 text-custom-dark opacity-75">
                    &copy; Powered by <a href="https://www.mirrar.com/" class="base-color"> MIRRAR </a>
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 3 -->
    <div class="step-container container  " id="step3">
        <div class="row align-items-center  container px-0 mx-auto">
            <div
                class="col-12 col-xl-10 py-4 text-center mx-auto d-flex align-items-center justify-content-center justify-normal  position-relative">
                <!-- Back Button -->
                <button type="button" class="btn btn-link p-0 me-3 d-flex align-items-center position-absolute"
                    onclick="prevStep(2)" style="left: 2rem; top: 50%; transform: translateY(-50%);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#300708"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                    </svg>
                    <span class="visually-hidden">Back</span>
                </button>
               <a href="/"><img src="{{ asset('image/logo.png') }}"class="form-logo-img"
                                                class="mb-2" alt="Tanishq Logo"></a>
            </div>
            <div
                class="col-12 col-xl-10 card py-5 px-4 shadow-lg mx-auto rounded-4 justify-content-center mb-5 ">
                <div class="px-md-5">
                    <h4 class="text-custom-dark mb-4 fw-bold">Share my jewellery checklist to:</h4>
                    <form id="step3-form" method="POST" action="{{ route('productChoose') }}">
                        @csrf
                        <input type="hidden" name="language" id="hidden-language">
                        <input type="hidden" name="event" id="hidden-event">
                        <input type="hidden" name="outfit" id="hidden-outfit">
                        <input type="hidden" name="jewellery_pieces" id="hidden-jewellery-pieces">
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">Name *</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Please enter name of person of contact" required>
                            </div>
                            <div class="col-md-6">
                                <label for="contactNumber" class="form-label fw-bold">Contact Number *</label>
                                <input type="tel" class="form-control" id="contactNumber" name="contactNumber"
                                    placeholder="Collected to send SMS to link of checklist" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold">Your E-mail ID *</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Backup copy to be sent on email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="weddingDate" class="form-label fw-bold">Choose your wedding date *</label>
                                <input type="date" class="form-control" id="weddingDate" name="weddingDate"
                                    placeholder="mm/dd/yyyy" required>
                                <script>
                                    // Set min date to today for wedding date input
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var weddingDateInput = document.getElementById('weddingDate');
                                        if (weddingDateInput) {
                                            var today = new Date();
                                            var yyyy = today.getFullYear();
                                            var mm = String(today.getMonth() + 1).padStart(2, '0');
                                            var dd = String(today.getDate()).padStart(2, '0');
                                            var minDate = yyyy + '-' + mm + '-' + dd;
                                            weddingDateInput.setAttribute('min', minDate);
                                        }
                                    });
                                </script>
                                <script>
                                    // Persist wedding date value between steps using sessionStorage
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var weddingDateInput = document.getElementById('weddingDate');
                                        if (weddingDateInput) {
                                            // Restore from sessionStorage if available
                                            var savedDate = sessionStorage.getItem('weddingDate');
                                            if (savedDate) {
                                                weddingDateInput.value = savedDate;
                                            }
                                            weddingDateInput.addEventListener('change', function() {
                                                sessionStorage.setItem('weddingDate', this.value);
                                            });
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="form-check mb-4 d-flex justify-content-center px-0 ">
                            <input class="form-check-input " style="margin-right:5px" type="checkbox" value="1" id="receiveCall"
                                name="receiveCall">
                            <label class="form-check-label" for="receiveCall">
                                Receive call from store for follow-up.
                            </label>
                        </div>
                        <div class="form-check d-flex justify-content-center px-0">

                        <button type="submit"  name="recommended_products" class="btn border border-2 rounded-5 btn-custom">View Recommended Product</button>
                        <button type="submit" name="full_catalogue" class="btn border border-2 rounded-5 btn-custom">View Full Catalogue</button>
                        </div>
                    </form>
                </div>
                <div class=" text-center text-muted note-disclaimer small mt-4 px-md-5">
                    <p class="fw-bold text-dark mb-2 text-start">Note</p>
                    <p class="text-start b">Please be advised that this checklist does not obligate you to make purchases from Tanishq.
                        Information will only be saved in our store’s system for quick review when you revisit, until
                        your date of wedding</p>
                </div>
                <div class="mt-4 text-center pt-4 fs-6 text-custom-dark opacity-75">
                    &copy; Powered by <a href="https://www.mirrar.com/" class="base-color"> MIRRAR </a>
                </div>
            </div>
        </div>


    </div>


    <!-- Bootstrap JS + Custom JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Step navigation functions
        function goToStep(stepNum) {
            document.querySelectorAll('.step-container').forEach(step => step.classList.remove('active'));
            document.getElementById('step' + stepNum).classList.add('active');
        }

        function nextStep(stepNum) {
            goToStep(stepNum);
        }

        function prevStep(stepNum) {
            goToStep(stepNum);
        }

        // New function to handle outfit selection and checklist display
        function showOutfit(outfit) {
            // First, deactivate all outfit cards and checklist sections
            document.querySelectorAll('.outfit-card').forEach(card => card.classList.remove('active'));
            document.querySelectorAll('.detail-section').forEach(section => section.classList.remove('active'));

            // Then, activate the clicked outfit card and its corresponding checklist
            const selectedOutfitCard = document.querySelector(`.outfit-card[data-outfit="${outfit}"]`);
            const selectedChecklist = document.getElementById(`${outfit}-details`);

            if (selectedOutfitCard && selectedChecklist) {
                selectedOutfitCard.classList.add('active');
                selectedChecklist.classList.add('active');
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            // Add click event listeners to all outfit cards
            document.querySelectorAll('.outfit-card').forEach(card => {
                card.addEventListener('click', (event) => {
                    const outfit = card.getAttribute('data-outfit');
                    showOutfit(outfit);
                });
            });

            // Handle Step 1 form submission
            const step1Form = document.getElementById('step1-form');
            if (step1Form) {
                step1Form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Prevent default form submission

                    // Get selected language and event
                    const languageSelect = document.getElementById('language-select');
                    const eventSelect = document.getElementById('event-select');

                    const language = languageSelect.options[languageSelect.selectedIndex]?.text || 'Tamil';
                    const event = eventSelect.options[eventSelect.selectedIndex]?.text || 'Mehendi';

                    // Update Step 2 heading
                    document.getElementById('dynamic-language').textContent = language;
                    document.getElementById('dynamic-event').textContent = event;

                    // Go to step 2
                    nextStep(2);
                });
            }

            // Step 3 form submit handler
            const step3Form = document.getElementById('step3-form');
            if (step3Form) {
                step3Form.addEventListener('submit', function(e) {
                    // Get language and event from Step 1
                    const languageSelect = document.getElementById('language-select');
                    const eventSelect = document.getElementById('event-select');
                    const language = languageSelect.options[languageSelect.selectedIndex]?.text || 'Tamil';
                    const eventName = eventSelect.options[eventSelect.selectedIndex]?.text || 'Mehendi';

                    // Get selected outfit
                    const activeOutfit = document.querySelector('.outfit-card.active')?.getAttribute(
                        'data-outfit') || '';

                    // Get selected jewellery pieces
                    const selectedJewellery = Array.from(document.querySelectorAll(
                        'input[name="jewellery_pieces"]:checked')).map(cb => cb.value);

                    // Set hidden fields
                    document.getElementById('hidden-language').value = language;
                    document.getElementById('hidden-event').value = eventName;
                    document.getElementById('hidden-outfit').value = activeOutfit;
                    document.getElementById('hidden-jewellery-pieces').value = selectedJewellery.join(',');

                    // Form will submit normally from here
                });
            }
        });

        function getSelectedJewellery() {
            const selectedItems = [];
            document.querySelectorAll('input[name="jewellery_pieces"]:checked').forEach(checkbox => {
                selectedItems.push(checkbox.value);
            });
            return selectedItems;
        }
    </script>

</body>

</html>
