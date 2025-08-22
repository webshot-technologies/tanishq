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

        #otp-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        #otp-modal .modal-content {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
        }
    </style>

</head>

<body>

    <div class="container px-0">

        <!-- STEP 1 -->
        <div class="step-container active   mx-auto " id="step1" style="height: 100vh;">
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
                                    <form id="step1-form" class="mt-5">
                                        <div class="d-flex  mb-5 align-items-baseline">
                                            <span class="me-3 mb-0 text-nowrap">My Dream</span>
                                            <select
                                                class="form-select border-bottom border-custom-dark text-custom-dark py-0"
                                                required id="language-select">
                                                <option selected>Tamil</option>
                                                <option>Telugu</option>
                                                <option>Gujarati</option>
                                                <option>Bengali</option>
                                                <option>Odia</option>
                                                <option>Bihar</option>
                                                <option>UP</option>
                                                <option>Marwari</option>
                                                <option>Pubjabi</option>
                                                <option>Odia</option>
                                                <option>Marathi</option>
                                                <option>Kannada</option>
                                                <option>Jat</option>
                                                <option>Rajput</option>
                                                <option>Assamese</option>
                                                <option>Manipuri</option>
                                                <option>Malayalee</option>
                                                <option>Kumoani</option>
                                                <option>Muslim</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-baseline mb-5">
                                            <select
                                                class="form-select border-bottom border-custom-dark text-custom-dark me-3 py-0"
                                                required id="event-select">
                                                <option selected>Mehendi</option>
                                                <option>Engagement</option>
                                                <option>Sangeet</option>
                                                <option>Haldi</option>
                                                <option>Cocktail</option>
                                                <option>Reception</option>
                                                <option>Wedding</option>
                                            </select>
                                            <span class="mb-0">Checklist</span>
                                        </div>

                                        <button type="submit" class="btn border border-2 rounded-5 btn-custom">Choose
                                            My
                                            Look</button>
                                    </form>
                                </div>

                                <div class="mt-4 text-center pt-4 fs-6 text-custom-dark opacity-75">
                                    &copy; Powered by <a href="https://www.mirrar.com/" class="base-color"> mirrAR</a>
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
                        <span class="fw-normal fs-1 base-color mb-5 light-font">
                            Jewellery For <span id="dynamic-language">Tamil</span> Style
                            <span id="dynamic-event">Mehendi</span> Ceremony
                        </span>

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

                        <div id="lehanga-details" class="detail-section active">
                            <h3 class="text-center fw-semibold mt-4">Lehanga Checklist</h3>
                            <p class="text-center light-weight text-dark-gray mb-3 text-muted">Click on the jewellery you want to explore</p>
                            <div class="animated-image-container position-relative">
                                <img src="{{ asset('image/lehnga.png') }}" class="img-fluid outfit-img"
                                    alt="Lehanga Model">

                                <div class="jewellery-item lehanga-hair-jewellery">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="hair-jewellery-cb" name="jewellery_pieces"
                                            value="hair-jewellery" class="jewellery-checkbox">
                                        <label for="hair-jewellery-cb">Hair Jewellery</label>
                                    </div>
                                </div>

                                <div class="jewellery-item lehanga-forehead-pendant">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="forehead-pendant-cb" name="jewellery_pieces"
                                            value="forehead-pendant" class="jewellery-checkbox">
                                        <label for="forehead-pendant-cb">Forehead Pendant</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item lehanga-earrings-stud">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">

                                    <div class="jewellery-input">
                                        <input type="checkbox" id="earrings-stud-cb" name="jewellery_pieces"
                                            value="earrings-stud" class="jewellery-checkbox">
                                        <label for="earrings-stud-cb">Earrings - Stud</label>
                                    </div>
                                </div>

                                <div class="jewellery-item lehanga-earrings-drops">
                                    <img src="{{ asset('image/right-line.png') }}"  class="right-img" alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="earrings-drops-cb" name="jewellery_pieces"
                                            value="earrings-drops" class="jewellery-checkbox">
                                        <label for="earrings-drops-cb">Earrings - Drops</label>
                                    </div>
                                </div>

                                <div class="jewellery-item lehanga-ear-loops">
                                    <img src="{{ asset('image/right-line.png') }}"  class="right-img" alt="">

                                    <div class="jewellery-input">
                                        <input type="checkbox" id="ear-loops-cb" name="jewellery_pieces"
                                            value="ear-loops" class="jewellery-checkbox">
                                        <label for="ear-loops-cb">Ear Loops</label>
                                    </div>
                                </div>

                                <div class="jewellery-item lehanga-nose-pin">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="nose-pin-cb" name="jewellery_pieces"
                                            value="nose-pin" class="jewellery-checkbox">
                                        <label for="nose-pin-cb">Nose Pin</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item lehanga-choker-necklace">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="choker-necklace-cb" name="jewellery_pieces"
                                            value="choker-necklace" class="jewellery-checkbox">
                                        <label for="choker-necklace-cb">Choker Necklace</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item lehanga-short-necklace">
                                    <img src="{{ asset('image/right-line.png') }}"  class="right-img" alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="short-necklace-cb" name="jewellery_pieces"
                                            value="short-necklace" class="jewellery-checkbox">
                                        <label for="short-necklace-cb">Short Necklace</label>
                                    </div>
                                </div>

                                <div class="jewellery-item lehanga-long-necklace">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="long-necklace-cb" name="jewellery_pieces"
                                            value="long-necklace" class="jewellery-checkbox">
                                        <label for="long-necklace-cb">Long Necklace</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item lehanga-multiple-bangles">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="multiple-bangles-cb" name="jewellery_pieces"
                                            value="multiple-bangles" class="jewellery-checkbox">
                                        <label for="multiple-bangles-cb">Multiple Bangles</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item lehanga-bracelet">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="bracelet-cb" name="jewellery_pieces"
                                            value="bracelet" class="jewellery-checkbox">
                                        <label for="bracelet-cb">Bracelet</label>
                                    </div>
                                </div>

                                <div class="jewellery-item lehanga-single-bangle">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="single-bangle-cb" name="jewellery_pieces"
                                            value="single-bangle" class="jewellery-checkbox">
                                        <label for="single-bangle-cb">Single Bangle</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item lehanga-rings">
                                    <img src="{{ asset('image/right-line.png') }}" alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="rings-cb" name="jewellery_pieces" value="rings"
                                            class="jewellery-checkbox">
                                        <label for="rings-cb">Rings</label>
                                    </div>
                                </div>

                                <div class="jewellery-item lehanga-waist-belt">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="waist-belt-cb" name="jewellery_pieces"
                                            value="waist-belt" class="jewellery-checkbox">
                                        <label for="waist-belt-cb">Waist Belt</label>
                                    </div>
                                </div>

                                <div class="jewellery-item lehanga-anklet">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="anklet-cb" name="jewellery_pieces" value="anklet"
                                            class="jewellery-checkbox">
                                        <label for="anklet-cb">Anklet</label>
                                    </div>
                                </div>

                                <div class="jewellery-item lehanga-toe-ring">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="toe-ring-cb" name="jewellery_pieces"
                                            value="toe-ring" class="jewellery-checkbox">
                                        <label for="toe-ring-cb">Toe Ring</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="gown-details" class="detail-section active">
                            <h3 class="text-center fw-semibold mt-4">Gown Checklist</h3>
                            <p class="text-center light-weight text-dark-gray mb-3 text-muted">Click on the jewellery you want to explore</p>
                            <div class="animated-image-container position-relative">
                                <img src="{{ asset('image/gown.png') }}" class="img-fluid outfit-img"
                                    alt="Lehanga Model">

                                <div class="jewellery-item gown-hair-jewellery">
                                    <img src="{{ asset('image/pointers/right-short.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="hair-jewellery-cb" name="jewellery_pieces"
                                            value="hair-jewellery" class="jewellery-checkbox">
                                        <label for="hair-jewellery-cb">Hair Jewellery</label>
                                    </div>
                                </div>

                                <div class="jewellery-item gown-forehead-pendant">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="forehead-pendant-cb" name="jewellery_pieces"
                                            value="forehead-pendant" class="jewellery-checkbox">
                                        <label for="forehead-pendant-cb">Forehead Pendant</label>
                                    </div>
                                    <img src="{{ asset('image/pointers/left-short.png') }}" alt="">
                                </div>

                                <div class="jewellery-item gown-earrings-stud">
                                    <img src="{{ asset('image/pointers/right-mid.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="earrings-stud-cb" name="jewellery_pieces"
                                            value="earrings-stud" class="jewellery-checkbox">
                                        <label for="earrings-stud-cb">Earrings - Stud</label>
                                    </div>
                                </div>

                                <div class="jewellery-item gown-earrings-drops">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="earrings-drops-cb" name="jewellery_pieces"
                                            value="earrings-drops" class="jewellery-checkbox">
                                        <label for="earrings-drops-cb">Earrings - Drops</label>
                                    </div>
                                    <img src="{{ asset('image/pointers/left-short.png') }}" alt="">
                                </div>

                                <div class="jewellery-item gown-choker-necklace">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="choker-necklace-cb" name="jewellery_pieces"
                                            value="choker-necklace" class="jewellery-checkbox">
                                        <label for="choker-necklace-cb">Choker Necklace</label>
                                    </div>
                                    <img src="{{ asset('image/pointers/left-short.png') }}" alt="">
                                </div>

                                <div class="jewellery-item gown-ear-loops">
                                    <img src="{{ asset('image/pointers/right-short-strt.png') }}"  class="right-img" alt="">

                                    <div class="jewellery-input">
                                        <input type="checkbox" id="ear-loops-cb" name="jewellery_pieces"
                                            value="ear-loops" class="jewellery-checkbox">
                                        <label for="ear-loops-cb">Ear Loops</label>
                                    </div>
                                </div>

                                <div class="jewellery-item gown-nose-pin">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="nose-pin-cb" name="jewellery_pieces"
                                            value="nose-pin" class="jewellery-checkbox">
                                        <label for="nose-pin-cb">Nose Pin</label>
                                    </div>
                                    <img src="{{ asset('image/pointers/left-long.png') }}" alt="">
                                </div>


                                <div class="jewellery-item gown-short-necklace">
                                    <img src="{{ asset('image/pointers/right-mid-strt.png') }}"  class="right-img" alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="short-necklace-cb" name="jewellery_pieces"
                                            value="short-necklace" class="jewellery-checkbox">
                                        <label for="short-necklace-cb">Short Necklace</label>
                                    </div>
                                </div>

                                <div class="jewellery-item gown-long-necklace">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="long-necklace-cb" name="jewellery_pieces"
                                            value="long-necklace" class="jewellery-checkbox">
                                        <label for="long-necklace-cb">Long Necklace</label>
                                    </div>
                                    <img src="{{ asset('image/pointers/left-long.png') }}" alt="">
                                </div>

                                <div class="jewellery-item gown-multiple-bangles">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="multiple-bangles-cb" name="jewellery_pieces"
                                            value="multiple-bangles" class="jewellery-checkbox">
                                        <label for="multiple-bangles-cb">Multiple Bangles</label>
                                    </div>
                                    <img src="{{ asset('image/pointers/left-mid.png') }}" alt="">
                                </div>

                                <div class="jewellery-item gown-bracelet">
                                    <img src="{{ asset('image/pointers/right-mid.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="bracelet-cb" name="jewellery_pieces"
                                            value="bracelet" class="jewellery-checkbox">
                                        <label for="bracelet-cb">Bracelet</label>
                                    </div>
                                </div>

                                <div class="jewellery-item gown-single-bangle">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="single-bangle-cb" name="jewellery_pieces"
                                            value="single-bangle" class="jewellery-checkbox">
                                        <label for="single-bangle-cb">Single Bangle</label>
                                    </div>
                                    <img src="{{ asset('image/pointers/left-mid-strt.png') }}" alt="">
                                </div>

                                <div class="jewellery-item gown-rings">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="rings-cb" name="jewellery_pieces" value="rings"
                                            class="jewellery-checkbox">
                                        <label for="rings-cb">Rings</label>
                                    </div>
                                    <img src="{{ asset('image/pointers/left-short.png') }}" alt="">

                                </div>

                                <div class="jewellery-item gown-waist-belt">
                                    <img src="{{ asset('image/pointers/right-short.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="waist-belt-cb" name="jewellery_pieces"
                                            value="waist-belt" class="jewellery-checkbox">
                                        <label for="waist-belt-cb">Waist Belt</label>
                                    </div>
                                </div>

                                <div class="jewellery-item gown-anklet">
                                    <img src="{{ asset('image/pointers/right-long.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="anklet-cb" name="jewellery_pieces" value="anklet"
                                            class="jewellery-checkbox">
                                        <label for="anklet-cb">Anklet</label>
                                    </div>
                                </div>

                                <div class="jewellery-item gown-toe-ring">
                                    <img src="{{ asset('image/pointers/right-mid.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="toe-ring-cb" name="jewellery_pieces"
                                            value="toe-ring" class="jewellery-checkbox">
                                        <label for="toe-ring-cb">Toe Ring</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="saree-details" class="detail-section active">
                            <h3 class="text-center fw-semibold mt-4">Saree Checklist</h3>
                            <p class="text-center light-weight text-dark-gray mb-3 text-muted">Click on the jewellery you want to explore</p>
                            <div class="animated-image-container position-relative">
                                <img src="{{ asset('image/saree.png') }}" class="img-fluid outfit-img"
                                    alt="Lehanga Model">

                                <div class="jewellery-item hair-jewellery">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="hair-jewellery-cb" name="jewellery_pieces"
                                            value="hair-jewellery" class="jewellery-checkbox">
                                        <label for="hair-jewellery-cb">Hair Jewellery</label>
                                    </div>
                                </div>

                                <div class="jewellery-item forehead-pendant">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="forehead-pendant-cb" name="jewellery_pieces"
                                            value="forehead-pendant" class="jewellery-checkbox">
                                        <label for="forehead-pendant-cb">Forehead Pendant</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item earrings-stud">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">

                                    <div class="jewellery-input">
                                        <input type="checkbox" id="earrings-stud-cb" name="jewellery_pieces"
                                            value="earrings-stud" class="jewellery-checkbox">
                                        <label for="earrings-stud-cb">Earrings - Stud</label>
                                    </div>
                                </div>

                                <div class="jewellery-item earrings-drops">
                                    <img src="{{ asset('image/right-line.png') }}"  class="right-img" alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="earrings-drops-cb" name="jewellery_pieces"
                                            value="earrings-drops" class="jewellery-checkbox">
                                        <label for="earrings-drops-cb">Earrings - Drops</label>
                                    </div>
                                </div>

                                <div class="jewellery-item ear-loops">
                                    <img src="{{ asset('image/right-line.png') }}"  class="right-img" alt="">

                                    <div class="jewellery-input">
                                        <input type="checkbox" id="ear-loops-cb" name="jewellery_pieces"
                                            value="ear-loops" class="jewellery-checkbox">
                                        <label for="ear-loops-cb">Ear Loops</label>
                                    </div>
                                </div>

                                <div class="jewellery-item nose-pin">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="nose-pin-cb" name="jewellery_pieces"
                                            value="nose-pin" class="jewellery-checkbox">
                                        <label for="nose-pin-cb">Nose Pin</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item choker-necklace">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="choker-necklace-cb" name="jewellery_pieces"
                                            value="choker-necklace" class="jewellery-checkbox">
                                        <label for="choker-necklace-cb">Choker Necklace</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item short-necklace">
                                    <img src="{{ asset('image/right-line.png') }}"  class="right-img" alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="short-necklace-cb" name="jewellery_pieces"
                                            value="short-necklace" class="jewellery-checkbox">
                                        <label for="short-necklace-cb">Short Necklace</label>
                                    </div>
                                </div>

                                <div class="jewellery-item long-necklace">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="long-necklace-cb" name="jewellery_pieces"
                                            value="long-necklace" class="jewellery-checkbox">
                                        <label for="long-necklace-cb">Long Necklace</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item multiple-bangles">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="multiple-bangles-cb" name="jewellery_pieces"
                                            value="multiple-bangles" class="jewellery-checkbox">
                                        <label for="multiple-bangles-cb">Multiple Bangles</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item bracelet">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="bracelet-cb" name="jewellery_pieces"
                                            value="bracelet" class="jewellery-checkbox">
                                        <label for="bracelet-cb">Bracelet</label>
                                    </div>
                                </div>

                                <div class="jewellery-item single-bangle">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="single-bangle-cb" name="jewellery_pieces"
                                            value="single-bangle" class="jewellery-checkbox">
                                        <label for="single-bangle-cb">Single Bangle</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item rings">
                                    <img src="{{ asset('image/right-line.png') }}" alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="rings-cb" name="jewellery_pieces" value="rings"
                                            class="jewellery-checkbox">
                                        <label for="rings-cb">Rings</label>
                                    </div>
                                </div>

                                <div class="jewellery-item waist-belt">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="waist-belt-cb" name="jewellery_pieces"
                                            value="waist-belt" class="jewellery-checkbox">
                                        <label for="waist-belt-cb">Waist Belt</label>
                                    </div>
                                </div>

                                <div class="jewellery-item anklet">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="anklet-cb" name="jewellery_pieces" value="anklet"
                                            class="jewellery-checkbox">
                                        <label for="anklet-cb">Anklet</label>
                                    </div>
                                </div>

                                <div class="jewellery-item toe-ring">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="toe-ring-cb" name="jewellery_pieces"
                                            value="toe-ring" class="jewellery-checkbox">
                                        <label for="toe-ring-cb">Toe Ring</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="anarkali-details" class="detail-section active">
                            <h3 class="text-center fw-semibold mt-4">Anarkali Checklist</h3>
                            <p class="text-center light-weight text-dark-gray mb-3 text-muted">Click on the jewellery you want to explore</p>
                            <div class="animated-image-container position-relative">
                                <img src="{{ asset('image/anarkali.png') }}" class="img-fluid outfit-img"
                                    alt="Lehanga Model">

                                <div class="jewellery-item hair-jewellery">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="hair-jewellery-cb" name="jewellery_pieces"
                                            value="hair-jewellery" class="jewellery-checkbox">
                                        <label for="hair-jewellery-cb">Hair Jewellery</label>
                                    </div>
                                </div>

                                <div class="jewellery-item forehead-pendant">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="forehead-pendant-cb" name="jewellery_pieces"
                                            value="forehead-pendant" class="jewellery-checkbox">
                                        <label for="forehead-pendant-cb">Forehead Pendant</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item earrings-stud">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">

                                    <div class="jewellery-input">
                                        <input type="checkbox" id="earrings-stud-cb" name="jewellery_pieces"
                                            value="earrings-stud" class="jewellery-checkbox">
                                        <label for="earrings-stud-cb">Earrings - Stud</label>
                                    </div>
                                </div>

                                <div class="jewellery-item earrings-drops">
                                    <img src="{{ asset('image/right-line.png') }}"  class="right-img" alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="earrings-drops-cb" name="jewellery_pieces"
                                            value="earrings-drops" class="jewellery-checkbox">
                                        <label for="earrings-drops-cb">Earrings - Drops</label>
                                    </div>
                                </div>

                                <div class="jewellery-item ear-loops">
                                    <img src="{{ asset('image/right-line.png') }}"  class="right-img" alt="">

                                    <div class="jewellery-input">
                                        <input type="checkbox" id="ear-loops-cb" name="jewellery_pieces"
                                            value="ear-loops" class="jewellery-checkbox">
                                        <label for="ear-loops-cb">Ear Loops</label>
                                    </div>
                                </div>

                                <div class="jewellery-item nose-pin">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="nose-pin-cb" name="jewellery_pieces"
                                            value="nose-pin" class="jewellery-checkbox">
                                        <label for="nose-pin-cb">Nose Pin</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item choker-necklace">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="choker-necklace-cb" name="jewellery_pieces"
                                            value="choker-necklace" class="jewellery-checkbox">
                                        <label for="choker-necklace-cb">Choker Necklace</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item short-necklace">
                                    <img src="{{ asset('image/right-line.png') }}"  class="right-img" alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="short-necklace-cb" name="jewellery_pieces"
                                            value="short-necklace" class="jewellery-checkbox">
                                        <label for="short-necklace-cb">Short Necklace</label>
                                    </div>
                                </div>

                                <div class="jewellery-item long-necklace">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="long-necklace-cb" name="jewellery_pieces"
                                            value="long-necklace" class="jewellery-checkbox">
                                        <label for="long-necklace-cb">Long Necklace</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item multiple-bangles">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="multiple-bangles-cb" name="jewellery_pieces"
                                            value="multiple-bangles" class="jewellery-checkbox">
                                        <label for="multiple-bangles-cb">Multiple Bangles</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item bracelet">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="bracelet-cb" name="jewellery_pieces"
                                            value="bracelet" class="jewellery-checkbox">
                                        <label for="bracelet-cb">Bracelet</label>
                                    </div>
                                </div>

                                <div class="jewellery-item single-bangle">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="single-bangle-cb" name="jewellery_pieces"
                                            value="single-bangle" class="jewellery-checkbox">
                                        <label for="single-bangle-cb">Single Bangle</label>
                                    </div>
                                    <img src="{{ asset('image/line.png') }}" alt="">
                                </div>

                                <div class="jewellery-item rings">
                                    <img src="{{ asset('image/right-line.png') }}" alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="rings-cb" name="jewellery_pieces" value="rings"
                                            class="jewellery-checkbox">
                                        <label for="rings-cb">Rings</label>
                                    </div>
                                </div>

                                <div class="jewellery-item waist-belt">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="waist-belt-cb" name="jewellery_pieces"
                                            value="waist-belt" class="jewellery-checkbox">
                                        <label for="waist-belt-cb">Waist Belt</label>
                                    </div>
                                </div>

                                <div class="jewellery-item anklet">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="anklet-cb" name="jewellery_pieces" value="anklet"
                                            class="jewellery-checkbox">
                                        <label for="anklet-cb">Anklet</label>
                                    </div>
                                </div>

                                <div class="jewellery-item toe-ring">
                                    <img src="{{ asset('image/right-line.png') }}" class="right-img"  alt="">
                                    <div class="jewellery-input">
                                        <input type="checkbox" id="toe-ring-cb" name="jewellery_pieces"
                                            value="toe-ring" class="jewellery-checkbox">
                                        <label for="toe-ring-cb">Toe Ring</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="gown-details" class="detail-section">
                            <h3 class="text-center fw-semibold base-color mt-4">Gown Checklist</h3>
                            <p class="text-center text-muted light-weight text-dark-gray">Click on the Jewellery Pieces you want to see</p>
                            <div class="animated-image-container position-relative">
                                <img src="{{ asset('image/gown.png') }}" class="img-fluid outfit-img" alt="Gown Model">

                            <div class="jewellery-item gown-hair-jewellery">
                                <input type="checkbox" id="gown-hair-jewellery-cb" name="jewellery_pieces"
                                    value="gown-hair-jewellery" class="jewellery-checkbox">
                                <label for="gown-hair-jewellery-cb">Hair Jewellery</label>
                            </div>

                            <div class="jewellery-item gown-earrings-stud">
                                <input type="checkbox" id="gown-earrings-stud-cb" name="jewellery_pieces"
                                    value="gown-earrings-stud" class="jewellery-checkbox">
                                <label for="gown-earrings-stud-cb">Earrings - Stud</label>
                            </div>

                            <div class="jewellery-item gown-earrings-drops">
                                <input type="checkbox" id="gown-earrings-drops-cb" name="jewellery_pieces"
                                    value="gown-earrings-drops" class="jewellery-checkbox">
                                <label for="gown-earrings-drops-cb">Earrings - Drops</label>
                            </div>

                            <div class="jewellery-item gown-ear-loop">
                                <input type="checkbox" id="gown-ear-loop-cb" name="jewellery_pieces"
                                    value="gown-ear-loop" class="jewellery-checkbox">
                                <label for="gown-ear-loop-cb">Ear Loop</label>
                            </div>

                            <div class="jewellery-item gown-nose-pin">
                                <input type="checkbox" id="gown-nose-pin-cb" name="jewellery_pieces"
                                    value="gown-nose-pin" class="jewellery-checkbox">
                                <label for="gown-nose-pin-cb">Nose Pin</label>
                            </div>

                            <div class="jewellery-item gown-choker-necklace">
                                <input type="checkbox" id="gown-choker-necklace-cb" name="jewellery_pieces"
                                    value="gown-choker-necklace" class="jewellery-checkbox">
                                <label for="gown-choker-necklace-cb">Choker Necklace</label>
                            </div>

                            <div class="jewellery-item gown-short-necklace">
                                <input type="checkbox" id="gown-short-necklace-cb" name="jewellery_pieces"
                                    value="gown-short-necklace" class="jewellery-checkbox">
                                <label for="gown-short-necklace-cb">Short Necklace</label>
                            </div>

                            <div class="jewellery-item gown-long-necklace">
                                <input type="checkbox" id="gown-long-necklace-cb" name="jewellery_pieces"
                                    value="gown-long-necklace" class="jewellery-checkbox">
                                <label for="gown-long-necklace-cb">Long Necklace</label>
                            </div>

                            <div class="jewellery-item gown-multiple-bangles">
                                <input type="checkbox" id="gown-multiple-bangles-cb" name="jewellery_pieces"
                                    value="gown-multiple-bangles" class="jewellery-checkbox">
                                <label for="gown-multiple-bangles-cb">Multiple Bangles</label>
                            </div>

                            <div class="jewellery-item gown-single-statement-bangle">
                                <input type="checkbox" id="gown-single-statement-bangle-cb" name="jewellery_pieces"
                                    value="gown-single-statement-bangle" class="jewellery-checkbox">
                                <label for="gown-single-statement-bangle-cb">Single Statement Bangle</label>
                            </div>

                            <div class="jewellery-item gown-rings">
                                <input type="checkbox" id="gown-rings-cb" name="jewellery_pieces" value="gown-rings"
                                    class="jewellery-checkbox">
                                <label for="gown-rings-cb">Rings</label>
                            </div>

                            <div class="jewellery-item gown-bracelet">
                                <input type="checkbox" id="gown-bracelet-cb" name="jewellery_pieces"
                                    value="gown-bracelet" class="jewellery-checkbox">
                                <label for="gown-bracelet-cb">Bracelet</label>
                            </div>
                        </div>
                    </div>

                    <div id="saree-details" class="detail-section">
                        <h3 class="text-center fw-semibold base-color mt-4">Saree Checklist</h3>
                        <p class="text-center text-muted light-weight text-dark-gray">Click on the Jewellery Pieces you want to see</p>
                        <div class="animated-image-container position-relative">
                            <img src="{{ asset('image/saree.png') }}" class="img-fluid outfit-img" alt="Saree Model">
                            <div class="jewellery-item saree-hair-jewellery">
                                <input type="checkbox" id="saree-hair-jewellery-cb" name="jewellery_pieces"
                                    value="saree-hair-jewellery" class="jewellery-checkbox">
                                <label for="saree-hair-jewellery-cb">Hair Jewellery</label>
                            </div>

                            <div class="jewellery-item saree-forehead-pendant">
                                <input type="checkbox" id="saree-forehead-pendant-cb" name="jewellery_pieces"
                                    value="saree-forehead-pendant" class="jewellery-checkbox">
                                <label for="saree-forehead-pendant-cb">Forehead Pendant</label>
                            </div>

                            <div class="jewellery-item saree-earrings-stud">
                                <input type="checkbox" id="saree-earrings-stud-cb" name="jewellery_pieces"
                                    value="saree-earrings-stud" class="jewellery-checkbox">
                                <label for="saree-earrings-stud-cb">Earrings - Stud</label>
                            </div>

                            <div class="jewellery-item saree-earrings-drops">
                                <input type="checkbox" id="saree-earrings-drops-cb" name="jewellery_pieces"
                                    value="saree-earrings-drops" class="jewellery-checkbox">
                                <label for="saree-earrings-drops-cb">Earrings - Drops</label>
                            </div>

                            <div class="jewellery-item saree-ear-loops">
                                <input type="checkbox" id="saree-ear-loops-cb" name="jewellery_pieces"
                                    value="saree-ear-loops" class="jewellery-checkbox">
                                <label for="saree-ear-loops-cb">Ear Loops</label>
                            </div>

                            <div class="jewellery-item saree-nose-pin">
                                <input type="checkbox" id="saree-nose-pin-cb" name="jewellery_pieces"
                                    value="saree-nose-pin" class="jewellery-checkbox">
                                <label for="saree-nose-pin-cb">Nose Pin</label>
                            </div>

                            <div class="jewellery-item saree-choker-necklace">
                                <input type="checkbox" id="saree-choker-necklace-cb" name="jewellery_pieces"
                                    value="saree-choker-necklace" class="jewellery-checkbox">
                                <label for="saree-choker-necklace-cb">Choker Necklace</label>
                            </div>

                            <div class="jewellery-item saree-short-necklace">
                                <input type="checkbox" id="saree-short-necklace-cb" name="jewellery_pieces"
                                    value="saree-short-necklace" class="jewellery-checkbox">
                                <label for="saree-short-necklace-cb">Short Necklace</label>
                            </div>

                            <div class="jewellery-item saree-long-necklace">
                                <input type="checkbox" id="saree-long-necklace-cb" name="jewellery_pieces"
                                    value="saree-long-necklace" class="jewellery-checkbox">
                                <label for="saree-long-necklace-cb">Long Necklace</label>
                            </div>

                            <div class="jewellery-item saree-waist-belt">
                                <input type="checkbox" id="saree-waist-belt-cb" name="jewellery_pieces"
                                    value="saree-waist-belt" class="jewellery-checkbox">
                                <label for="saree-waist-belt-cb">Waist Belt</label>
                            </div>

                            <div class="jewellery-item saree-multiple-bangles">
                                <input type="checkbox" id="saree-multiple-bangles-cb" name="jewellery_pieces"
                                    value="saree-multiple-bangles" class="jewellery-checkbox">
                                <label for="saree-multiple-bangles-cb">Multiple Bangles</label>
                            </div>

                            <div class="jewellery-item saree-bracelet">
                                <input type="checkbox" id="saree-bracelet-cb" name="jewellery_pieces"
                                    value="saree-bracelet" class="jewellery-checkbox">
                                <label for="saree-bracelet-cb">Bracelet</label>
                            </div>

                            <div class="jewellery-item saree-single-bangle">
                                <input type="checkbox" id="saree-single-bangle-cb" name="jewellery_pieces"
                                    value="saree-single-bangle" class="jewellery-checkbox">
                                <label for="saree-single-bangle-cb">Single Bangle</label>
                            </div>

                            <div class="jewellery-item saree-rings">
                                <input type="checkbox" id="saree-rings-cb" name="jewellery_pieces"
                                    value="saree-rings" class="jewellery-checkbox">
                                <label for="saree-rings-cb">Rings</label>
                            </div>

                            <div class="jewellery-item saree-anklet">
                                <input type="checkbox" id="saree-anklet-cb" name="jewellery_pieces"
                                    value="saree-anklet" class="jewellery-checkbox">
                                <label for="saree-anklet-cb">Anklet</label>
                            </div>

                            <div class="jewellery-item saree-toe-ring">
                                <input type="checkbox" id="saree-toe-ring-cb" name="jewellery_pieces"
                                    value="saree-toe-ring" class="jewellery-checkbox">
                                <label for="saree-toe-ring-cb">Toe Ring</label>
                            </div>
                        </div>
                    </div>
                    <div id="anarkali-details" class="detail-section">
                        <h3 class="text-center fw-semibold mt-4">Anarkali Checklist</h3>
                        <p class="text-center text-muted light-weight text-dark-gray">Click on the Jewellery Pieces you want to see</p>
                        <div class="animated-image-container position-relative">
                            <img src="{{ asset('image/anarkali.png') }}" class="img-fluid" alt="Anarkali Model">

                            <div class="jewellery-item saree-hair-jewellery">
                                <input type="checkbox" id="saree-hair-jewellery-cb" name="jewellery_pieces"
                                    value="saree-hair-jewellery" class="jewellery-checkbox">
                                <label for="saree-hair-jewellery-cb">Hair Jewellery</label>
                            </div>

                            <div class="jewellery-item saree-forehead-pendant">
                                <input type="checkbox" id="saree-forehead-pendant-cb" name="jewellery_pieces"
                                    value="saree-forehead-pendant" class="jewellery-checkbox">
                                <label for="saree-forehead-pendant-cb">Forehead Pendant</label>
                            </div>

                            <div class="jewellery-item saree-earrings-stud">
                                <input type="checkbox" id="saree-earrings-stud-cb" name="jewellery_pieces"
                                    value="saree-earrings-stud" class="jewellery-checkbox">
                                <label for="saree-earrings-stud-cb">Earrings - Stud</label>
                            </div>

                            <div class="jewellery-item saree-earrings-drops">
                                <input type="checkbox" id="saree-earrings-drops-cb" name="jewellery_pieces"
                                    value="saree-earrings-drops" class="jewellery-checkbox">
                                <label for="saree-earrings-drops-cb">Earrings - Drops</label>
                            </div>

                            <div class="jewellery-item saree-ear-loops">
                                <input type="checkbox" id="saree-ear-loops-cb" name="jewellery_pieces"
                                    value="saree-ear-loops" class="jewellery-checkbox">
                                <label for="saree-ear-loops-cb">Ear Loops</label>
                            </div>

                            <div class="jewellery-item saree-nose-pin">
                                <input type="checkbox" id="saree-nose-pin-cb" name="jewellery_pieces"
                                    value="saree-nose-pin" class="jewellery-checkbox">
                                <label for="saree-nose-pin-cb">Nose Pin</label>
                            </div>

                            <div class="jewellery-item saree-choker-necklace">
                                <input type="checkbox" id="saree-choker-necklace-cb" name="jewellery_pieces"
                                    value="saree-choker-necklace" class="jewellery-checkbox">
                                <label for="saree-choker-necklace-cb">Choker Necklace</label>
                            </div>

                            <div class="jewellery-item saree-short-necklace">
                                <input type="checkbox" id="saree-short-necklace-cb" name="jewellery_pieces"
                                    value="saree-short-necklace" class="jewellery-checkbox">
                                <label for="saree-short-necklace-cb">Short Necklace</label>
                            </div>

                            <div class="jewellery-item saree-long-necklace">
                                <input type="checkbox" id="saree-long-necklace-cb" name="jewellery_pieces"
                                    value="saree-long-necklace" class="jewellery-checkbox">
                                <label for="saree-long-necklace-cb">Long Necklace</label>
                            </div>

                            <div class="jewellery-item saree-waist-belt">
                                <input type="checkbox" id="saree-waist-belt-cb" name="jewellery_pieces"
                                    value="saree-waist-belt" class="jewellery-checkbox">
                                <label for="saree-waist-belt-cb">Waist Belt</label>
                            </div>

                            <div class="jewellery-item saree-multiple-bangles">
                                <input type="checkbox" id="saree-multiple-bangles-cb" name="jewellery_pieces"
                                    value="saree-multiple-bangles" class="jewellery-checkbox">
                                <label for="saree-multiple-bangles-cb">Multiple Bangles</label>
                            </div>

                            <div class="jewellery-item saree-bracelet">
                                <input type="checkbox" id="saree-bracelet-cb" name="jewellery_pieces"
                                    value="saree-bracelet" class="jewellery-checkbox">
                                <label for="saree-bracelet-cb">Bracelet</label>
                            </div>

                            <div class="jewellery-item saree-single-bangle">
                                <input type="checkbox" id="saree-single-bangle-cb" name="jewellery_pieces"
                                    value="saree-single-bangle" class="jewellery-checkbox">
                                <label for="saree-single-bangle-cb">Single Bangle</label>
                            </div>

                            <div class="jewellery-item saree-rings">
                                <input type="checkbox" id="saree-rings-cb" name="jewellery_pieces"
                                    value="saree-rings" class="jewellery-checkbox">
                                <label for="saree-rings-cb">Rings</label>
                            </div>

                            <div class="jewellery-item saree-anklet">
                                <input type="checkbox" id="saree-anklet-cb" name="jewellery_pieces"
                                    value="saree-anklet" class="jewellery-checkbox">
                                <label for="saree-anklet-cb">Anklet</label>
                            </div>

                            <div class="jewellery-item saree-toe-ring">
                                <input type="checkbox" id="saree-toe-ring-cb" name="jewellery_pieces"
                                    value="saree-toe-ring" class="jewellery-checkbox">
                                <label for="saree-toe-ring-cb">Toe Ring</label>
                            </div>
                        </div>
                    </div>
                    </div>


                </div>

                <div class=" col-12 col-xl-10 d-flex px-4 mx-auto justify-content-center my-4">

                    <button type="" onclick="nextStep(3)"
                        class="btn border-2 rounded-5 btn-custom">Choose
                        Create List</button>

                    {{-- <button class="btn btn-primary" onclick="nextStep(3)">Create List</button> --}}
                </div>
               <div class="mt-4 text-center pt-4 fs-6 text-custom-dark opacity-75">
                    &copy; Powered by <a href="https://www.mirrar.com/" class="base-color"> mirrAR</a>
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 3 -->
    <div class="step-container container " id="step3">
        <div class="row align-items-center container px-0 mx-auto">
            <div class="col-12 col-xl-10 py-4 text-center mx-auto d-flex align-items-center justify-content-center justify-normal position-relative">
                <!-- Back Button -->
                <button type="button" class="btn btn-link p-0 me-3 d-flex align-items-center position-absolute" onclick="prevStep(2)" style="left: 2rem; top: 50%; transform: translateY(-50%);">
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
            <div class="col-12 col-xl-10 card py-5 px-4 shadow-lg mx-auto rounded-4 justify-content-center mb-5 ">
                <div class="px-md-5">
                    <h4 class="text-custom-dark mb-4 fw-normal">Share My Jewellery Checklist To:</h4>
                    <form id="step3-form" method="POST" action="{{ route('productChoose') }}">
                        @csrf
                        <input type="hidden" name="language" id="hidden-language">
                        <input type="hidden" name="event" id="hidden-event">
                        <input type="hidden" name="outfit" id="hidden-outfit">
                        <input type="hidden" name="jewellery_pieces" id="hidden-jewellery-pieces">
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-normal">Name *</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Contact person’s name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="contactNumber" class="form-label fw-normal">Contact Number *</label>
                                <input type="tel" class="form-control" id="contactNumber" name="contactNumber"
                                    placeholder="Contact person's phone number" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-normal">Your E-mail ID *</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="you@example.com" required>
                            </div>
                            <div class="col-md-6">
                                <label for="weddingDate" class="form-label fw-normal">Choose your wedding date *</label>
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

                        <div class="d-flex gap-4">
                            <button type="submit"  name="recommended_products" class="btn border border-2 rounded-5 btn-custom">View Recommendation</button>
                            <button type="submit" name="full_catalogue" class="btn border border-2 rounded-5 btn-custom">View Full Catalogue</button>
                        </div>
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
                    &copy; Powered by <a href="https://www.mirrar.com/" class="base-color">mirrAR</a>
                </div>
            </div>
        </div>
        <!-- OTP Modal -->
        <div id="otp-modal">
            <div class="otp-modal-content">
                <div class="otp-right">
                    <h4 class="otp-heading">Verify with OTP</h4>
                    <p class="otp-text">Sent to <span id="otp-phone-number">+91 •••• ••••••</span></p>

                    <!-- OTP Input Boxes -->
                    <div class="otp-inputs">
                        <input type="text" maxlength="1" class="otp-box" data-index="1" onkeyup="handleOTPInput(this)" onfocus="this.select()" inputmode="numeric" pattern="[0-9]*">
                        <input type="text" maxlength="1" class="otp-box" data-index="2" onkeyup="handleOTPInput(this)" onfocus="this.select()" inputmode="numeric" pattern="[0-9]*">
                        <input type="text" maxlength="1" class="otp-box" data-index="3" onkeyup="handleOTPInput(this)" onfocus="this.select()" inputmode="numeric" pattern="[0-9]*">
                        <input type="text" maxlength="1" class="otp-box" data-index="4" onkeyup="handleOTPInput(this)" onfocus="this.select()" inputmode="numeric" pattern="[0-9]*">
                        <input type="text" maxlength="1" class="otp-box" data-index="5" onkeyup="handleOTPInput(this)" onfocus="this.select()" inputmode="numeric" pattern="[0-9]*">
                        <input type="text" maxlength="1" class="otp-box" data-index="6" onkeyup="handleOTPInput(this)" onfocus="this.select()" inputmode="numeric" pattern="[0-9]*">
                    </div>

                    <div id="otp-error" class="otp-error"></div>

                    <div class="otp-loading">
                        <div class="otp-spinner"></div>
                        <span>Verifying OTP...</span>
                    </div>

                    <div class="otp-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        Verified successfully!
                    </div>

                    <p class="otp-timer">Resend OTP in <span id="otp-timer">02:00</span></p>

                    <button id="verify-otp-btn" class="otp-btn" onclick="verifyOTP()">Verify OTP</button>

                    <p class="otp-terms">
                        By continuing, I agree to <a href="#">Terms of Use</a> & <a href="#">Privacy Policy</a>
                    </p>
                </div>
            </div>
        </div>
        <!-- reCAPTCHA container (hidden) -->
        <div id="recaptcha-container"></div>
    </div>


    <!-- Firebase SDKs -->
  <script src="https://www.gstatic.com/firebasejs/10.9.0/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.9.0/firebase-firestore-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.9.0/firebase-auth-compat.js"></script>
  <script>
    // Firebase config
    const firebaseConfig = {
        apiKey: "AIzaSyBqhJQGGD_bfWffc10t5Ia4pLx6ofKyoas",
        authDomain: "localhost", // Corrected
        projectId: "project101-d857d",
        storageBucket: "project101-d857d.firebasestorage.app",
        messagingSenderId: "237630463530",
        appId: "1:237630463530:web:fe124e4b765287aaa6ed53"
    };



    firebase.initializeApp(firebaseConfig);
    const auth = firebase.auth(); // Use a consistent auth variable
    const db = firebase.firestore();
    let confirmationResult = null;

    // Initialize reCAPTCHA verifier once on page load
    let recaptchaVerifier;
    document.addEventListener('DOMContentLoaded', function() {
        recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
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

        // Step 1 form submit
        const step1Form = document.getElementById('step1-form');
           if (step1Form) {
            step1Form.addEventListener('submit', function(e) {
                e.preventDefault();
                const languageSelect = document.getElementById('language-select');
                const eventSelect = document.getElementById('event-select');
                   console.log('Language Select:', languageSelect);
                const language = languageSelect.options[languageSelect.selectedIndex].text || 'Tamil';
                const event = eventSelect.options[eventSelect.selectedIndex].text || 'Mehendi';
                document.getElementById('dynamic-language').textContent = language;
                document.getElementById('dynamic-event').textContent = event;
                goToStep(2);
            });
        }

        setupOutfitCards();
        setupPhoneVerification();
    });

    // Step navigation functions
    function goToStep(stepNum) {
        document.querySelectorAll('.step-container').forEach(step => step.classList.remove('active'));
        const targetStep = document.getElementById('step' + stepNum);
        console.log('targetStep:', targetStep);
        if (targetStep) {
            targetStep.classList.add('active');
        }
    }

    function nextStep(stepNum) { goToStep(stepNum); }
    function prevStep(stepNum) { goToStep(stepNum); }

    // Outfit tablist logic (no change needed here)
    function setupOutfitCards() {
        document.querySelectorAll('.outfit-card').forEach(function(card) {
            card.addEventListener('click', function() {
                document.querySelectorAll('.outfit-card').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                document.querySelectorAll('.detail-section').forEach(section => section.style.display = 'none');
                const outfit = this.getAttribute('data-outfit');
                const detailsId = outfit + '-details';
                const detailsSection = document.getElementById(detailsId);
                if (detailsSection) {
                    detailsSection.style.display = 'block';
                }
            });
        });

        const defaultCard = document.querySelector('.outfit-card.active');
        if (defaultCard) {
            const outfit = defaultCard.getAttribute('data-outfit');
            document.querySelectorAll('.detail-section').forEach(section => section.style.display = 'none');
            const detailsSection = document.getElementById(outfit + '-details');
            if (detailsSection) {
                detailsSection.style.display = 'block';
            }
        }
    }

    // Phone number validation and OTP handling
    function setupPhoneVerification() {
        const step3Form = document.getElementById('step3-form');
        if (!step3Form) return;

        step3Form.addEventListener('submit', function(e) {
            e.preventDefault();

            let contactNumber = document.getElementById('contactNumber').value;
            console.log('Contact Number:', contactNumber);
            if (/^\d{10}$/.test(contactNumber)) {
                contactNumber = '+91' + contactNumber;
            }
             console.log('Formatted Contact Number:', contactNumber);
            if (!contactNumber.match(/^\+\d{10,15}$/)) {
                document.getElementById('otp-error').textContent = 'Please enter a valid phone number (e.g. +919876543210)';
                document.getElementById('otp-modal').style.display = 'none'; // Hide modal if invalid
                return;
            }

            document.getElementById('otp-modal').style.display = 'flex';
            console.log('Sending OTP to:', contactNumber);

            auth.signInWithPhoneNumber(contactNumber, recaptchaVerifier)
                .then(function(result) {
                    confirmationResult = result;
                    console.log('OTP sent successfully.');
                    console.log(confirmationResult);
                    document.getElementById('otp-error').textContent = ''; // Clear previous errors
                    console.log('OTP sent successfully.');
                }).catch(function(error) {
                    console.error("Error sending OTP:", error);
                    document.getElementById('otp-error').textContent = "Error: " + error.message;
                    // You might want to hide the modal here or allow resend
                });
        });

        // OTP verify button
        document.getElementById('verify-otp-btn').addEventListener('click', function() {
            const code = document.getElementById('otp-code').value;
            if (!code || !confirmationResult) {
                document.getElementById('otp-error').textContent = 'Please enter OTP code';
                return;
            }
            confirmationResult.confirm(code).then(function(result) {
                document.getElementById('otp-modal').style.display = 'none';
                document.getElementById('step3-form').submit();
            }).catch(function(error) {
                document.getElementById('otp-error').textContent = 'Invalid OTP. Try again.';
            });
        });
    }

    // OTP Verification Functions
    let otpTimer = null;
    let otpTimeLeft = 120; // 2 minutes in seconds

    // Handle OTP input and auto-focus
    function handleOTPInput(input) {
        const value = input.value;
        const index = parseInt(input.getAttribute('data-index'));

        // Only allow numbers
        if (value && !/^\d$/.test(value)) {
            input.value = '';
            return;
        }

        // Auto-focus to next input if a digit is entered
        if (value && index < 6) {
            const nextInput = document.querySelector(`.otp-box[data-index="${index + 1}"]`);
            if (nextInput) nextInput.focus();
        }

        // Handle backspace
        if (!value && index > 1) {
            const prevInput = document.querySelector(`.otp-box[data-index="${index - 1}"]`);
            if (prevInput) prevInput.focus();
        }

        // Auto-verify if all digits are entered
        if (index === 6 && value) {
            const otp = getOTP();
            if (otp.length === 6) {
                verifyOTP(otp);
            }
        }
    }

    // Get the full OTP from all input fields
    function getOTP() {
        let otp = '';
        for (let i = 1; i <= 6; i++) {
            const input = document.querySelector(`.otp-box[data-index="${i}"]`);
            if (input) otp += input.value;
        }
        return otp;
    }

    // Show/hide loading state
    function showLoading(show) {
        const loadingEl = document.querySelector('.otp-loading');
        const errorEl = document.getElementById('otp-error');
        const verifyBtn = document.getElementById('verify-otp-btn');

        if (show) {
            loadingEl.style.display = 'block';
            errorEl.textContent = '';
            verifyBtn.disabled = true;
        } else {
            loadingEl.style.display = 'none';
            verifyBtn.disabled = false;
        }
    }

    // Show success state and redirect
    function showSuccess() {
        const successEl = document.querySelector('.otp-success');
        successEl.style.display = 'block';

        // Hide other elements
        showLoading(false);
        document.querySelector('.otp-inputs').style.opacity = '0.5';
        document.getElementById('verify-otp-btn').style.display = 'none';

        // Redirect after a short delay
        setTimeout(() => {
            // Submit the form or redirect to next page
            const form = document.getElementById('step3-form');
            if (form) {
                form.submit();
            } else {
                // If no form, redirect to home or next step
                window.location.href = '/success'; // Update this URL as needed
            }
        }, 1000);
    }

    // Start OTP timer
    function startOTPTimer() {
        clearInterval(otpTimer);
        otpTimeLeft = 120; // Reset to 2 minutes
        updateTimerDisplay();

        otpTimer = setInterval(() => {
            otpTimeLeft--;
            updateTimerDisplay();

            if (otpTimeLeft <= 0) {
                clearInterval(otpTimer);
                // Enable resend button if you have one
                const resendBtn = document.getElementById('resend-otp');
                if (resendBtn) {
                    resendBtn.disabled = false;
                    resendBtn.textContent = 'Resend OTP';
                }
            }
        }, 1000);
    }

    // Update timer display
    function updateTimerDisplay() {
        const timerEl = document.getElementById('otp-timer');
        if (timerEl) {
            const minutes = Math.floor(otpTimeLeft / 60);
            const seconds = otpTimeLeft % 60;
            timerEl.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
    }

    // Verify OTP
    function verifyOTP(code = null) {
        const otp = code || getOTP();

        if (!otp || otp.length !== 6) {
            document.getElementById('otp-error').textContent = 'Please enter a valid 6-digit OTP';
            return;
        }

        showLoading(true);

        confirmationResult.confirm(otp)
            .then((result) => {
                // User signed in successfully
                showSuccess();
            })
            .catch((error) => {
                showLoading(false);
                document.getElementById('otp-error').textContent = 'Invalid OTP. Please try again.';
                // Clear OTP fields on error
                document.querySelectorAll('.otp-box').forEach(input => input.value = '');
                document.querySelector('.otp-box[data-index="1"]').focus();
            });
    }

    // Update phone number in OTP modal
    function updatePhoneNumber(phone) {
        if (!phone) return;
        const formatted = phone.replace(/(\d{2})(\d{4})(\d+)/, '+$1 $2 ••••');
        const phoneEl = document.getElementById('otp-phone-number');
        if (phoneEl) phoneEl.textContent = formatted;
    }

    // Initialize OTP modal
    function initOTPModal() {
        // Focus first OTP input when modal is shown
        const modal = document.getElementById('otp-modal');
        if (modal) {
            modal.addEventListener('shown.bs.modal', function () {
                const firstInput = document.querySelector('.otp-box[data-index="1"]');
                if (firstInput) firstInput.focus();
            });
        }

        // Add click handler for verify button
        const verifyBtn = document.getElementById('verify-otp-btn');
        if (verifyBtn) {
            verifyBtn.addEventListener('click', function() {
                verifyOTP();
            });
        }
    }

    // Call this when showing the OTP modal
    function showOTPModal(phoneNumber = '') {
        updatePhoneNumber(phoneNumber);
        document.getElementById('otp-modal').style.display = 'flex';
        document.querySelector('.otp-box[data-index="1"]').focus();
        startOTPTimer();
    }

    // Update the existing setupPhoneVerification function
    function setupPhoneVerification() {
        const step3Form = document.getElementById('step3-form');
        if (!step3Form) return;

        step3Form.addEventListener('submit', async function(e) {
            e.preventDefault();

            let contactNumber = document.getElementById('contactNumber').value.trim();

            // Format phone number
            if (/^\d{10}$/.test(contactNumber)) {
                contactNumber = '+91' + contactNumber;
            }

            // Validate phone number
            if (!contactNumber.match(/^\+\d{10,15}$/)) {
                document.getElementById('otp-error').textContent = 'Please enter a valid phone number (e.g. +919876543210)';
                return;
            }

            // Show OTP modal
            showOTPModal(contactNumber);

            try {
                // Send OTP
                confirmationResult = await auth.signInWithPhoneNumber(contactNumber, recaptchaVerifier);
                console.log('OTP sent successfully');
            } catch (error) {
                console.error("Error sending OTP:", error);
                document.getElementById('otp-error').textContent = "Error: " + error.message;
            }
        });
    }

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Your existing DOMContentLoaded code...

        // Initialize OTP modal
        initOTPModal();

        // Initialize reCAPTCHA verifier
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
            'size': 'invisible',
            'callback': (response) => {
                console.log('reCAPTCHA solved, proceed with OTP verification.');
            },
            'expired-callback': () => {
                console.log('reCAPTCHA expired, please try again.');
            }
        });

        // Initialize phone verification
        setupPhoneVerification();
    });
</script>
</body>

</html>
