<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanishq - Rivaah</title>

    <!-- Laravel CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts & Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap');

        body {
            font-family: 'Playfair Display', serif;
        }

        .bg-custom-light {
            background-color: #fcf8f8;
        }

        .text-custom-dark {
            color: #300708;
        }

        .border-custom-dark {
            border-color: #300708 !important;
        }

        .btn-custom {
            background-color: #300708;
            color: #fff;
            border-radius: 50px;
            padding: 12px 32px;
            transition: background-color 0.3s ease-in-out;
        }

        .form-select.border-bottom {
            border-top: none;
            border-left: none;
            border-right: none;
            border-radius: 0;
            background-color: transparent;
        }

        .category-card {
            cursor: pointer;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 1rem;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, background-color 0.3s ease;
            text-align: center;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .category-card.active {
            background-color: #300708;
            color: #fff;
            border-color: #300708;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body class="bg-custom-light vh-100 d-flex align-items-center justify-content-center p-4">
    <div class="container h-100">
        <div class="row g-0 justify-content-center h-100">
            <div class="col-12 col-xl-10 card shadow-lg rounded-4 overflow-hidden h-100">
                <div class="row g-0 h-100">
                    <!-- LEFT: Step Section -->
                    <div id="step-section-container" class="col-lg-6 p-0 h-100">
                        <!-- Step 1 Content -->
                        <div class="d-flex flex-column justify-content-between bg-custom-light p-4 p-md-5 h-100">
                            <div class="my-auto text-custom-dark">
                                <!-- Logo and Headline -->
                                <div class="mb-4 d-none d-lg-block">
                                    <div class="d-flex flex-column align-items-start">
                                        <img src="https://placehold.co/100x40/fcf8f8/5c3e3e?text=TANISHQ" class="mb-2" alt="Tanishq Logo">
                                        <span class="fs-6 tracking-widest text-uppercase">Presents</span>
                                        <h1 class="display-5 fw-bold mt-1">RIVAAH</h1>
                                        <span class="fs-6 tracking-wide text-uppercase">Wedding Jewellery</span>
                                    </div>
                                </div>

                                <!-- Step 1 Form -->
                                <form id="step1-form">
                                    <div class="d-flex align-items-baseline mb-4">
                                        <h2 class="display-4 fw-bold me-3">My dream</h2>
                                        <select class="form-select form-select-lg border-bottom border-custom-dark text-custom-dark" required>
                                            <option selected disabled>Tamil</option>
                                            <option>English</option>
                                            <option>Hindi</option>
                                            <option>Bengali</option>
                                        </select>
                                    </div>
                                    <div class="d-flex align-items-baseline mb-5">
                                        <select class="form-select form-select-lg border-bottom border-custom-dark text-custom-dark me-3" required>
                                            <option selected disabled>Mehendi</option>
                                            <option>Sangeet</option>
                                            <option>Haldi</option>
                                            <option>Wedding</option>
                                        </select>
                                        <h2 class="display-4 fw-bold">checklist.</h2>
                                    </div>
                                    <button type="submit" class="btn border border-2 rounded-5 btn-custom">Let’s Find My Perfect Look!</button>
                                </form>
                            </div>

                            <div class="mt-auto text-center pt-4 fs-6 text-custom-dark opacity-75">
                                &copy; Titan Company Limited
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT: Image -->
                    <div class="col-lg-6 d-none d-lg-block p-0 h-100">
                        <img src="{{ asset('image/input-form.webp') }}" alt="Wedding jewelry on hands" class="img-fluid w-100 h-100 object-fit-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Template for Step 2 -->
    <template id="step2-template">
        <div class="d-flex flex-column justify-content-between bg-custom-light p-4 p-md-5 h-100">
            <div class="my-auto text-custom-dark">
                <h2 class="display-4 fw-bold mb-4">Jewellery For Tamil Style Mehendi Ceremony</h2>
                <div class="d-flex justify-content-center">
                    <div class="category-card text-center p-3 mx-2" data-category="gown"><h5 class="fw-bold mb-0">Gown</h5></div>
                    <div class="category-card text-center p-3 mx-2" data-category="lehenga"><h5 class="fw-bold mb-0">Lehenga</h5></div>
                    <div class="category-card text-center p-3 mx-2 active" data-category="saree"><h5 class="fw-bold mb-0">Saree</h5></div>
                </div>

                <div id="jewelry-checklist-section" style="display:none;" class="mt-5">
                    <h3 class="display-6 fw-bold mb-3">Saree Checklist</h3>
                    <p class="text-muted">Click on the jewellery you want to explore</p>
                    <div class="row">
                        <div class="col-md-6 d-flex flex-column justify-content-center">
                            <div id="checklist-items"></div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center position-relative">
                            <img src="https://placehold.co/300x400/fcf8f8/5c3e3e?text=Model+Base" alt="Model" class="img-fluid" id="model-base">
                            <div id="jewelry-overlay" class="position-absolute" style="top: 0; left: 0;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-auto text-center pt-4 fs-6 text-custom-dark opacity-75">
                &copy; Titan Company Limited
            </div>
        </div>
    </template>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            const jewelryItems = [
                { id: 'forehead-pendant', name: 'Forehead Pendant' },
                { id: 'ear-rings', name: 'Ear Rings' },
                { id: 'choker-necklace', name: 'Choker Necklace' },
                { id: 'short-necklace', name: 'Short Necklace' },
                { id: 'long-necklace', name: 'Long Necklace' },
                { id: 'waist-belt', name: 'Waist Belt' },
                { id: 'multiple-bangles', name: 'Multiple Bangles' }
            ];

            $('#step1-form').on('submit', function (e) {
                e.preventDefault();
                const step2Html = $('#step2-template').html();
                $('#step-section-container').html(step2Html);
                bindStep2Events();
            });

            function bindStep2Events() {
                $('.category-card').on('click', function () {
                    $('.category-card').removeClass('active');
                    $(this).addClass('active');

                    const category = $(this).data('category');
                    if (category === 'saree') {
                        $('#checklist-items').empty();
                        jewelryItems.forEach(item => {
                            const html = `
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="${item.id}">
                                    <label class="form-check-label" for="${item.id}">${item.name}</label>
                                </div>
                            `;
                            $('#checklist-items').append(html);
                        });
                        $('#jewelry-checklist-section').fadeIn();
                    } else {
                        $('#jewelry-checklist-section').fadeOut();
                    }
                });

                $(document).on('change', '#checklist-items input[type="checkbox"]', function () {
                    const id = $(this).attr('id');
                    const isChecked = $(this).is(':checked');
                    if (isChecked) {
                        const overlayHtml = `<img id="overlay-${id}" src="https://placehold.co/300x400/5c3e3e/ffffff?text=${id}" class="position-absolute" style="top: 0; left: 0;">`;
                        $('#jewelry-overlay').append(overlayHtml);
                    } else {
                        $(`#overlay-${id}`).remove();
                    }
                });
            }
        });
    </script>
</body>
</html>
