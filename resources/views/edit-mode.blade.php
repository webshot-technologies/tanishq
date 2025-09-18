<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Mode - Jewellery Position Editor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #fef9f7;
        }

        .edit-mode-header {
            background: linear-gradient(135deg, #8a2323, #42210b);
            color: white;
            padding: 1rem 0;
        }

        .edit-mode-container {
            min-height: 100vh;
            padding: 2rem 0;
        }

        /* Model Selector Styles */
        .model-selector {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .model-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .model-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 3px solid transparent;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .model-card:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .model-card.active {
            border-color: #8a2323;
            transform: scale(1.02);
        }

        .model-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .model-card-content {
            padding: 1rem;
            text-align: center;
        }

        .model-card-title {
            font-weight: 600;
            color: #42210b;
            margin-bottom: 0.5rem;
        }

        .model-card-subtitle {
            font-size: 0.9rem;
            color: #666;
        }

        /* Jewellery Position Editor Styles */
        .position-editor {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .editor-content {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 2rem;
            align-items: start;
        }

        /* Image Container */
        .image-container {
            position: relative;
            display: inline-block;
            max-width: 100%;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .model-image {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 8px;
        }

        /* SVG for connecting lines */
        .connecting-lines-svg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 5;
        }

        .connecting-line {
            stroke: rgba(138, 35, 35, 0.6);
            stroke-width: 2;
            fill: none;
            stroke-dasharray: 5,5;
        }

        /* Jewellery Position Dots - Fixed positions */
        .jewellery-position {
            position: absolute;
            width: 8px;
            height: 8px;
            background: rgba(138, 35, 35, 0.3);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 2px 8px rgba(138, 35, 35, 0.4);
            z-index: 15;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        /* Draggable Labels */
        .jewellery-label {
            position: absolute;
            z-index: 10;
            cursor: move;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 6px;
            padding: 4px 8px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            white-space: nowrap;
            user-select: none;
            transition: transform 0.1s ease;
        }

        .jewellery-label:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .jewellery-label.dragging {
            z-index: 20;
            transform: scale(1.1);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .jewellery-label input[type="checkbox"] {
            margin: 0 5px 0 0;
        }

        .jewellery-label label {
            margin: 0;
            font-size: 0.85rem;
            font-weight: 500;
            color: #42210b;
            cursor: move;
        }

        /* Controls Panel */
        .controls-panel {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            height: fit-content;
        }

        .controls-title {
            font-weight: 600;
            color: #42210b;
            margin-bottom: 1rem;
            border-bottom: 2px solid #8a2323;
            padding-bottom: 0.5rem;
        }

        /* Mobile simulation styles */
        .image-container.mobile-preview {
            max-width: 375px; /* iPhone width */
            margin: 0 auto;
        }

        .image-container.mobile-preview .model-image {
            width: 100%;
            height: auto;
        }

        /* Ensure SVG lines work in mobile preview */
        .image-container.mobile-preview .connecting-lines-svg {
            width: 100%;
            height: 100%;
        }

        /* Adjust label sizes for mobile preview */
        .image-container.mobile-preview .jewellery-label {
            font-size: 0.7rem;
            padding: 2px 4px;
        }

        .image-container.mobile-preview .jewellery-position {
            width: 6px;
            height: 6px;
        }

        /* Ensure connecting lines are visible in mobile */
        .image-container.mobile-preview .connecting-line {
            stroke: rgba(138, 35, 35, 0.6);
            stroke-width: 1.5;
            fill: none;
            stroke-dasharray: 3,3;
        }

        .jewellery-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .jewellery-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .jewellery-list li:last-child {
            border-bottom: none;
        }

        .jewellery-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .jewellery-toggle input[type="checkbox"] {
            margin: 0;
        }

        .jewellery-toggle label {
            margin: 0;
            font-size: 0.9rem;
            color: #42210b;
            cursor: pointer;
        }

        .visibility-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ccc;
            transition: background 0.3s ease;
        }

        .visibility-indicator.visible {
            background: #28a745;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .editor-content {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .model-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 1rem;
            }
            
            .model-card img {
                height: 200px;
            }
        }

        /* Button styles */
        .btn-custom {
            background: linear-gradient(135deg, #8a2323, #42210b);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, #42210b, #8a2323);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(138, 35, 35, 0.3);
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="edit-mode-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto">
                    <a href="/" class="btn btn-light btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
                        </svg>
                        Back to Main App
                    </a>
                </div>
                <div class="col">
                    <h1 class="h3 mb-0 text-center">Jewellery Position Editor</h1>
                </div>
                <div class="col-auto">
                    <img src="{{ asset('image/logo.png') }}" alt="Tanishq Logo" style="height: 40px;">
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="edit-mode-container">
        <div class="container">
            <!-- Model Selector -->
            <div class="model-selector">
                <h2 class="text-center mb-3" style="color: #42210b;">Select Model to Edit</h2>
                <div class="model-grid" id="model-grid">
                    <!-- Models will be populated by JavaScript -->
                </div>
            </div>

            <!-- Position Editor -->
            <div class="position-editor">
                <h3 class="text-center mb-4" style="color: #42210b;">Edit Jewellery Positions</h3>
                <div class="editor-content">
                    <!-- Image Display -->
                    <div class="text-center">
                        <div class="image-container" id="jewellery-container">
                            <img src="" alt="Model" class="model-image" id="current-model-image">
                            
                            <!-- SVG for connecting lines -->
                            <svg class="connecting-lines-svg" id="connecting-lines">
                                <!-- Lines will be drawn here -->
                            </svg>
                            
                            <!-- Jewellery Position Dots -->
                            <div class="jewellery-position" data-type="forehead-pendant"></div>
                            <div class="jewellery-position" data-type="hair-jewellery"></div>
                            <div class="jewellery-position" data-type="earrings-stud"></div>
                            <div class="jewellery-position" data-type="earrings-drops"></div>
                            <div class="jewellery-position" data-type="ear-loops"></div>
                            <div class="jewellery-position" data-type="nose-pin"></div>
                            <div class="jewellery-position" data-type="choker-necklace"></div>
                            <div class="jewellery-position" data-type="short-necklace"></div>
                            <div class="jewellery-position" data-type="long-necklace"></div>
                            <div class="jewellery-position" data-type="multiple-bangles"></div>
                            <div class="jewellery-position" data-type="bracelet"></div>
                            <div class="jewellery-position" data-type="single-bangle"></div>
                            <div class="jewellery-position" data-type="rings"></div>
                            <div class="jewellery-position" data-type="waist-belt"></div>
                            <div class="jewellery-position" data-type="anklet"></div>
                            <div class="jewellery-position" data-type="toe-ring"></div>
                            
                            <!-- Draggable Labels -->
                            <div class="jewellery-label" data-type="forehead-pendant">
                                <input type="checkbox" id="edit-forehead-pendant" class="jewellery-checkbox" checked>
                                <label for="edit-forehead-pendant">Forehead Pendant</label>
                            </div>

                            <div class="jewellery-label" data-type="hair-jewellery">
                                <input type="checkbox" id="edit-hair-jewellery" class="jewellery-checkbox" checked>
                                <label for="edit-hair-jewellery">Hair Jewellery</label>
                            </div>

                            <div class="jewellery-label" data-type="earrings-stud">
                                <input type="checkbox" id="edit-earrings-stud" class="jewellery-checkbox" checked>
                                <label for="edit-earrings-stud">Earrings - Stud</label>
                            </div>

                            <div class="jewellery-label" data-type="earrings-drops">
                                <input type="checkbox" id="edit-earrings-drops" class="jewellery-checkbox" checked>
                                <label for="edit-earrings-drops">Earrings - Drops</label>
                            </div>

                            <div class="jewellery-label" data-type="ear-loops">
                                <input type="checkbox" id="edit-ear-loops" class="jewellery-checkbox" checked>
                                <label for="edit-ear-loops">Ear Loops</label>
                            </div>

                            <div class="jewellery-label" data-type="nose-pin">
                                <input type="checkbox" id="edit-nose-pin" class="jewellery-checkbox" checked>
                                <label for="edit-nose-pin">Nose Pin</label>
                            </div>

                            <div class="jewellery-label" data-type="choker-necklace">
                                <input type="checkbox" id="edit-choker-necklace" class="jewellery-checkbox" checked>
                                <label for="edit-choker-necklace">Choker Necklace</label>
                            </div>

                            <div class="jewellery-label" data-type="short-necklace">
                                <input type="checkbox" id="edit-short-necklace" class="jewellery-checkbox" checked>
                                <label for="edit-short-necklace">Short Necklace</label>
                            </div>

                            <div class="jewellery-label" data-type="long-necklace">
                                <input type="checkbox" id="edit-long-necklace" class="jewellery-checkbox" checked>
                                <label for="edit-long-necklace">Long Necklace</label>
                            </div>

                            <div class="jewellery-label" data-type="multiple-bangles">
                                <input type="checkbox" id="edit-multiple-bangles" class="jewellery-checkbox" checked>
                                <label for="edit-multiple-bangles">Multiple Bangles</label>
                            </div>

                            <div class="jewellery-label" data-type="bracelet">
                                <input type="checkbox" id="edit-bracelet" class="jewellery-checkbox" checked>
                                <label for="edit-bracelet">Bracelet</label>
                            </div>

                            <div class="jewellery-label" data-type="single-bangle">
                                <input type="checkbox" id="edit-single-bangle" class="jewellery-checkbox" checked>
                                <label for="edit-single-bangle">Single Bangle</label>
                            </div>

                            <div class="jewellery-label" data-type="rings">
                                <input type="checkbox" id="edit-rings" class="jewellery-checkbox" checked>
                                <label for="edit-rings">Rings</label>
                            </div>

                            <div class="jewellery-label" data-type="waist-belt">
                                <input type="checkbox" id="edit-waist-belt" class="jewellery-checkbox" checked>
                                <label for="edit-waist-belt">Waist Belt</label>
                            </div>

                            <div class="jewellery-label" data-type="anklet">
                                <input type="checkbox" id="edit-anklet" class="jewellery-checkbox" checked>
                                <label for="edit-anklet">Anklet</label>
                            </div>

                            <div class="jewellery-label" data-type="toe-ring">
                                <input type="checkbox" id="edit-toe-ring" class="jewellery-checkbox" checked>
                                <label for="edit-toe-ring">Toe Ring</label>
                            </div>
                        </div>
                    </div>

                    <!-- Controls Panel -->
                    <div class="controls-panel">
                        <h4 class="controls-title">Jewellery Controls</h4>
                        
                        <!-- Device Type Toggle -->
                        <div class="mb-3 p-3 border rounded">
                            <h6 class="mb-2">Device Preview</h6>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="device-type" id="device-desktop" value="desktop" checked>
                                <label class="btn btn-outline-primary" for="device-desktop">Desktop</label>
                                
                                <input type="radio" class="btn-check" name="device-type" id="device-mobile" value="mobile">
                                <label class="btn btn-outline-primary" for="device-mobile">Mobile</label>
                            </div>
                            <small class="text-muted d-block mt-1">Switch between desktop and mobile label positioning</small>
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-muted">Drag labels to reposition. Red dots show jewellery positions.</small>
                        </div>
                        <ul class="jewellery-list">
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-forehead-pendant" checked>
                                    <label for="toggle-forehead-pendant">Forehead Pendant</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-hair-jewellery" checked>
                                    <label for="toggle-hair-jewellery">Hair Jewellery</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-earrings-stud" checked>
                                    <label for="toggle-earrings-stud">Earrings - Stud</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-earrings-drops" checked>
                                    <label for="toggle-earrings-drops">Earrings - Drops</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-ear-loops" checked>
                                    <label for="toggle-ear-loops">Ear Loops</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-nose-pin" checked>
                                    <label for="toggle-nose-pin">Nose Pin</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-choker-necklace" checked>
                                    <label for="toggle-choker-necklace">Choker Necklace</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-short-necklace" checked>
                                    <label for="toggle-short-necklace">Short Necklace</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-long-necklace" checked>
                                    <label for="toggle-long-necklace">Long Necklace</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-multiple-bangles" checked>
                                    <label for="toggle-multiple-bangles">Multiple Bangles</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-bracelet" checked>
                                    <label for="toggle-bracelet">Bracelet</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-single-bangle" checked>
                                    <label for="toggle-single-bangle">Single Bangle</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-rings" checked>
                                    <label for="toggle-rings">Rings</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-waist-belt" checked>
                                    <label for="toggle-waist-belt">Waist Belt</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-anklet" checked>
                                    <label for="toggle-anklet">Anklet</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                            <li>
                                <div class="jewellery-toggle">
                                    <input type="checkbox" id="toggle-toe-ring" checked>
                                    <label for="toggle-toe-ring">Toe Ring</label>
                                </div>
                                <div class="visibility-indicator visible"></div>
                            </li>
                        </ul>
                        
                        <div class="mt-4 pt-3 border-top">
                            <button class="btn btn-custom w-100 mb-2" onclick="showAllJewellery()">Show All</button>
                            <button class="btn btn-outline-secondary w-100 mb-2" onclick="hideAllJewellery()">Hide All</button>
                            <button class="btn btn-info w-100 mb-2" onclick="debugRedrawLines()">Redraw Lines (Debug)</button>
                            <button class="btn btn-success w-100" onclick="savePositions()">Save Positions</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
    <script>
        // Community to model mapping (same as main app)
        const communityModelMapping = {
            'Tamil Bride': {
                slide1: { jpeg: 'bystate/telugu-saree.png', png: 'bystate/telugu-saree.png', alt: 'Tamil Saree', outfit: 'saree' },
                slide2: { jpeg: 'bystate/telugu-lehnga.png', png: 'bystate/telugu-lehnga.png', alt: 'Tamil Lehenga', outfit: 'lehnga' },
                slide3: { jpeg: 'bystate/tamil-gown.png', png: 'bystate/tamil-gown.png', alt: 'Tamil Gown', outfit: 'gown' },
                slide4: { jpeg: 'bystate/telugu-others.png', png: 'bystate/telugu-others.png', alt: 'Tamil Others', outfit: 'others' }
            },
            'Telugu Bride': {
                slide1: { jpeg: 'bystate/telugu-lehnga.png', png: 'bystate/telugu-lehnga.png', alt: 'Telugu Lehenga', outfit: 'lehnga' },
                slide2: { jpeg: 'bystate/telugu-saree.png', png: 'bystate/telugu-saree.png', alt: 'Telugu Saree', outfit: 'saree' },
                slide3: { jpeg: 'bystate/telugu-gown.png', png: 'bystate/telugu-gown.png', alt: 'Telugu Gown', outfit: 'gown' },
                slide4: { jpeg: 'bystate/telugu-others.png', png: 'bystate/telugu-others.png', alt: 'Telugu Others', outfit: 'others' }
            },
            'Gujarati Bride': {
                slide1: { jpeg: 'bystate/gujarati-lehnga.png', png: 'bystate/gujarati-lehnga.png', alt: 'Gujarati Lehenga', outfit: 'lehnga' },
                slide2: { jpeg: 'bystate/gujarati-gown.png', png: 'bystate/gujarati-gown.png', alt: 'Gujarati Gown', outfit: 'gown' },
                slide3: { jpeg: 'bystate/telugu-saree.png', png: 'bystate/telugu-saree.png', alt: 'Gujarati Saree', outfit: 'saree' },
                slide4: { jpeg: 'bystate/telugu-others.png', png: 'bystate/telugu-others.png', alt: 'Gujarati Others', outfit: 'others' }
            },
            'Bengali Bride': {
                slide1: { jpeg: 'bystate/bengali-saree.png', png: 'bystate/bengali-saree.png', alt: 'Bengali Saree', outfit: 'saree' },
                slide2: { jpeg: 'bystate/bengali-lehnga.png', png: 'bystate/bengali-lehnga.png', alt: 'Bengali Lehenga', outfit: 'lehnga' },
                slide3: { jpeg: 'bystate/gujarati-gown.png', png: 'bystate/gujarati-gown.png', alt: 'Bengali Gown', outfit: 'gown' },
                slide4: { jpeg: 'bystate/telugu-others.png', png: 'bystate/telugu-others.png', alt: 'Bengali Others', outfit: 'others' }
            },
            'Bihari Bride': {
                slide1: { jpeg: 'bystate/bihari-saree.png', png: 'bystate/bihari-saree.png', alt: 'Bihari Saree', outfit: 'saree' },
                slide2: { jpeg: 'bystate/bihari-lehnga.png', png: 'bystate/bihari-lehnga.png', alt: 'Bihari Lehenga', outfit: 'lehnga' },
                slide3: { jpeg: 'bystate/gujarati-gown.png', png: 'bystate/gujarati-gown.png', alt: 'Bihari Gown', outfit: 'gown' },
                slide4: { jpeg: 'bystate/telugu-others.png', png: 'bystate/telugu-others.png', alt: 'Bihari Others', outfit: 'others' }
            },
            'Marathi Bride': {
                slide1: { jpeg: 'bystate/marathi-saree.png', png: 'bystate/marathi-saree.png', alt: 'Marathi Saree', outfit: 'saree' },
                slide2: { jpeg: 'bystate/marathi-lehnga.png', png: 'bystate/marathi-lehnga.png', alt: 'Marathi Lehenga', outfit: 'lehnga' },
                slide3: { jpeg: 'bystate/gujarati-gown.png', png: 'bystate/gujarati-gown.png', alt: 'Marathi Gown', outfit: 'gown' },
                slide4: { jpeg: 'bystate/telugu-others.png', png: 'bystate/telugu-others.png', alt: 'Marathi Others', outfit: 'others' }
            },
            'Kannadiga Bride': {
                slide1: { jpeg: 'bystate/kannadiga-saree.png', png: 'bystate/kannadiga-saree.png', alt: 'Kannadiga Saree', outfit: 'saree' },
                slide2: { jpeg: 'bystate/kannadiga-lehnga.png', png: 'bystate/kannadiga-lehnga.png', alt: 'Kannadiga Lehenga', outfit: 'lehnga' },
                slide3: { jpeg: 'bystate/telugu-gown.png', png: 'bystate/telugu-gown.png', alt: 'Kannadiga Gown', outfit: 'gown' },
                slide4: { jpeg: 'bystate/telugu-others.png', png: 'bystate/telugu-others.png', alt: 'Kannadiga Others', outfit: 'others' }
            },
            'Jharkhand Bride': {
                slide1: { jpeg: 'bystate/jharkhand-lehnga.png', png: 'bystate/jharkhand-lehnga.png', alt: 'Jharkhand Lehenga', outfit: 'lehnga' },
                slide2: { jpeg: 'bystate/jharkhand-saree.png', png: 'bystate/jharkhand-saree.png', alt: 'Jharkhand Saree', outfit: 'saree' },
                slide3: { jpeg: 'bystate/jharkhand-gown.png', png: 'bystate/jharkhand-gown.png', alt: 'Jharkhand Gown', outfit: 'gown' },
                slide4: { jpeg: 'bystate/telugu-others.png', png: 'bystate/telugu-others.png', alt: 'Jharkhand Others', outfit: 'others' }
            },
            'UP Bride': {
                slide1: { jpeg: 'bystate/up-lehnga.png', png: 'bystate/up-lehnga.png', alt: 'UP Lehenga', outfit: 'lehnga' },
                slide2: { jpeg: 'bystate/telugu-saree.png', png: 'bystate/telugu-saree.png', alt: 'UP Saree', outfit: 'saree' },
                slide3: { jpeg: 'bystate/gujarati-gown.png', png: 'bystate/gujarati-gown.png', alt: 'UP Gown', outfit: 'gown' },
                slide4: { jpeg: 'bystate/telugu-others.png', png: 'bystate/telugu-others.png', alt: 'UP Others', outfit: 'others' }
            }
        };

        let currentModels = [];
        let currentModelData = null;
        let jewelleryPositions = {};
        let labelPositions = {}; // Store custom label positions
        let currentDeviceType = 'desktop'; // Track current device type
        let isDragging = false;
        let dragElement = null;
        let dragOffset = { x: 0, y: 0 };

        // Initialize the edit mode
        document.addEventListener('DOMContentLoaded', async function() {
            // Load jewellery position data first
            await loadJewelleryPositions();
            
            // Load saved label positions
            await loadLabelPositions();
            
            // Generate model grid for all communities
            generateModelGrid();
            
            // Set up jewellery toggle controls
            setupJewelleryControls();
            
            // Setup drag functionality
            setupDragFunctionality();
            
            // Setup device type switching
            setupDeviceSwitching();
            
            // Select first model by default
            if (currentModels.length > 0) {
                selectModel(currentModels[0]);
            }
        });

        // Load saved label positions from server
        async function loadLabelPositions() {
            try {
                const response = await fetch('/api/jewellery/load-positions');
                const data = await response.json();
                
                if (data.success) {
                    labelPositions = data.positions;
                    console.log('Loaded saved label positions:', labelPositions);
                } else {
                    console.error('Failed to load label positions:', data.message);
                }
            } catch (error) {
                console.error('Error loading label positions:', error);
                labelPositions = {};
            }
        }

        // Setup device type switching
        function setupDeviceSwitching() {
            const deviceRadios = document.querySelectorAll('input[name="device-type"]');
            
            deviceRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    currentDeviceType = this.value;
                    switchDevicePreview(currentDeviceType);
                    loadPositionsForDevice(currentDeviceType);
                });
            });
        }

        function switchDevicePreview(deviceType) {
            const container = document.getElementById('jewellery-container');
            
            if (deviceType === 'mobile') {
                container.classList.add('mobile-preview');
            } else {
                container.classList.remove('mobile-preview');
            }
            
            // Use requestAnimationFrame to ensure DOM updates are complete
            requestAnimationFrame(() => {
                setTimeout(() => {
                    // Clear existing lines first
                    const svg = document.getElementById('connecting-lines');
                    if (svg) {
                        svg.innerHTML = '';
                    }
                    
                    // Force a reflow by reading container dimensions
                    const containerRect = container.getBoundingClientRect();
                    console.log(`Container dimensions after ${deviceType} switch:`, containerRect.width, 'x', containerRect.height);
                    
                    // Recalculate and redraw everything
                    positionLabelsAndCreateLines();
                }, 200); // Increased timeout
            });
        }

        function loadPositionsForDevice(deviceType) {
            if (!currentModelData) return;
            
            const currentImagePath = currentModelData.image;
            const savedPositions = labelPositions[currentImagePath] || {};
            const devicePositions = savedPositions[deviceType] || {};
            
            // Apply saved positions for this device type
            Object.keys(devicePositions).forEach(jewelleryType => {
                const label = document.querySelector(`.jewellery-label[data-type="${jewelleryType}"]`);
                if (label) {
                    const container = document.getElementById('jewellery-container');
                    const containerRect = container.getBoundingClientRect();
                    
                    const x = (devicePositions[jewelleryType].x / 100) * containerRect.width;
                    const y = (devicePositions[jewelleryType].y / 100) * containerRect.height;
                    
                    label.style.left = x + 'px';
                    label.style.top = y + 'px';
                }
            });
            
            // Update all connecting lines after positioning
            setTimeout(() => {
                updateAllConnectingLines();
            }, 50);
        }

        // Setup drag functionality for labels
        function setupDragFunctionality() {
            const labels = document.querySelectorAll('.jewellery-label');
            
            labels.forEach(label => {
                label.addEventListener('mousedown', startDrag);
            });
            
            document.addEventListener('mousemove', drag);
            document.addEventListener('mouseup', endDrag);
            
            // Touch events for mobile
            labels.forEach(label => {
                label.addEventListener('touchstart', startDragTouch);
            });
            
            document.addEventListener('touchmove', dragTouch);
            document.addEventListener('touchend', endDrag);
        }

        function startDrag(e) {
            e.preventDefault();
            isDragging = true;
            dragElement = e.currentTarget;
            dragElement.classList.add('dragging');
            
            const rect = dragElement.getBoundingClientRect();
            const containerRect = document.getElementById('jewellery-container').getBoundingClientRect();
            
            dragOffset.x = e.clientX - rect.left;
            dragOffset.y = e.clientY - rect.top;
        }

        function startDragTouch(e) {
            e.preventDefault();
            const touch = e.touches[0];
            isDragging = true;
            dragElement = e.currentTarget;
            dragElement.classList.add('dragging');
            
            const rect = dragElement.getBoundingClientRect();
            const containerRect = document.getElementById('jewellery-container').getBoundingClientRect();
            
            dragOffset.x = touch.clientX - rect.left;
            dragOffset.y = touch.clientY - rect.top;
        }

        function drag(e) {
            if (!isDragging || !dragElement) return;
            
            const container = document.getElementById('jewellery-container');
            const containerRect = container.getBoundingClientRect();
            
            const x = e.clientX - containerRect.left - dragOffset.x;
            const y = e.clientY - containerRect.top - dragOffset.y;
            
            // Constrain within container bounds
            const maxX = containerRect.width - dragElement.offsetWidth;
            const maxY = containerRect.height - dragElement.offsetHeight;
            
            const constrainedX = Math.max(0, Math.min(x, maxX));
            const constrainedY = Math.max(0, Math.min(y, maxY));
            
            dragElement.style.left = constrainedX + 'px';
            dragElement.style.top = constrainedY + 'px';
            
            // Update connecting line
            updateConnectingLine(dragElement.dataset.type);
        }

        function dragTouch(e) {
            if (!isDragging || !dragElement) return;
            e.preventDefault();
            
            const touch = e.touches[0];
            const container = document.getElementById('jewellery-container');
            const containerRect = container.getBoundingClientRect();
            
            const x = touch.clientX - containerRect.left - dragOffset.x;
            const y = touch.clientY - containerRect.top - dragOffset.y;
            
            // Constrain within container bounds
            const maxX = containerRect.width - dragElement.offsetWidth;
            const maxY = containerRect.height - dragElement.offsetHeight;
            
            const constrainedX = Math.max(0, Math.min(x, maxX));
            const constrainedY = Math.max(0, Math.min(y, maxY));
            
            dragElement.style.left = constrainedX + 'px';
            dragElement.style.top = constrainedY + 'px';
            
            // Update connecting line
            updateConnectingLine(dragElement.dataset.type);
        }

        function endDrag() {
            if (isDragging && dragElement) {
                dragElement.classList.remove('dragging');
                isDragging = false;
                dragElement = null;
            }
        }

        // Update connecting line between position dot and label
        function updateConnectingLine(jewelleryType) {
            const positionDot = document.querySelector(`.jewellery-position[data-type="${jewelleryType}"]`);
            const label = document.querySelector(`.jewellery-label[data-type="${jewelleryType}"]`);
            const line = document.querySelector(`#line-${jewelleryType}`);
            
            if (!positionDot || !label || !line) {
                console.log(`Missing elements for ${jewelleryType}:`, {
                    dot: !!positionDot,
                    label: !!label,
                    line: !!line
                });
                return;
            }
            
            const container = document.getElementById('jewellery-container');
            const containerRect = container.getBoundingClientRect();
            
            // Get position dot center
            const dotRect = positionDot.getBoundingClientRect();
            const dotX = dotRect.left - containerRect.left + dotRect.width / 2;
            const dotY = dotRect.top - containerRect.top + dotRect.height / 2;
            
            // Get label center
            const labelRect = label.getBoundingClientRect();
            const labelX = labelRect.left - containerRect.left + labelRect.width / 2;
            const labelY = labelRect.top - containerRect.top + labelRect.height / 2;
            
            // Update line
            line.setAttribute('x1', dotX);
            line.setAttribute('y1', dotY);
            line.setAttribute('x2', labelX);
            line.setAttribute('y2', labelY);
            
            // Debug log for mobile issues
            if (container.classList.contains('mobile-preview')) {
                console.log(`Mobile line update for ${jewelleryType}:`, {
                    dotX, dotY, labelX, labelY,
                    containerWidth: containerRect.width,
                    containerHeight: containerRect.height
                });
            }
        }

        // Update all connecting lines
        function updateAllConnectingLines() {
            const jewelleryTypes = [
                'forehead-pendant', 'hair-jewellery', 'earrings-stud', 'earrings-drops', 
                'ear-loops', 'nose-pin', 'choker-necklace', 'short-necklace', 
                'long-necklace', 'multiple-bangles', 'bracelet', 'single-bangle', 
                'rings', 'waist-belt', 'anklet', 'toe-ring'
            ];
            
            jewelleryTypes.forEach(type => {
                updateConnectingLine(type);
            });
        }

        // Generate model grid from all communities
        function generateModelGrid() {
            const modelGrid = document.getElementById('model-grid');
            currentModels = [];
            
            // Collect all models from all communities
            Object.keys(communityModelMapping).forEach(community => {
                const mapping = communityModelMapping[community];
                Object.keys(mapping).forEach(slideKey => {
                    const slideData = mapping[slideKey];
                    currentModels.push({
                        id: `${community}-${slideData.outfit}`,
                        image: slideData.png,
                        title: slideData.alt,
                        community: community,
                        outfit: slideData.outfit
                    });
                });
            });

            // Remove duplicates based on image path
            const uniqueModels = currentModels.filter((model, index, self) => 
                index === self.findIndex(m => m.image === model.image)
            );
            
            currentModels = uniqueModels;

            // Generate model cards
            modelGrid.innerHTML = '';
            currentModels.forEach((model, index) => {
                const modelCard = document.createElement('div');
                modelCard.className = 'model-card';
                modelCard.onclick = () => selectModel(model);
                
                modelCard.innerHTML = `
                    <img src="{{ asset('image/') }}/${model.image}" alt="${model.title}">
                    <div class="model-card-content">
                        <div class="model-card-title">${model.title}</div>
                        <div class="model-card-subtitle">${model.community}</div>
                    </div>
                `;
                
                modelGrid.appendChild(modelCard);
            });
        }

        // Select a model and update the jewellery positions
        function selectModel(modelData) {
            // Remove active class from all cards
            document.querySelectorAll('.model-card').forEach(card => {
                card.classList.remove('active');
            });
            
            // Add active class to selected card
            const modelIndex = currentModels.findIndex(m => m.id === modelData.id);
            if (modelIndex >= 0) {
                document.querySelectorAll('.model-card')[modelIndex].classList.add('active');
            }
            
            // Update current model data
            currentModelData = modelData;
            
            // Update the main image
            const modelImage = document.getElementById('current-model-image');
            modelImage.src = `{{ asset('image/') }}/${modelData.image}`;
            modelImage.alt = modelData.title;
            
            // Update jewellery positions and labels
            updateJewelleryPositions(modelData.image);
            
            // Wait for image to load, then position labels and create lines
            modelImage.onload = () => {
                setTimeout(() => {
                    positionLabelsAndCreateLines();
                }, 100);
            };
            
            console.log('Selected model:', modelData);
        }

        // Position labels initially and create connecting lines
        function positionLabelsAndCreateLines() {
            const jewelleryTypes = [
                'forehead-pendant', 'hair-jewellery', 'earrings-stud', 'earrings-drops', 
                'ear-loops', 'nose-pin', 'choker-necklace', 'short-necklace', 
                'long-necklace', 'multiple-bangles', 'bracelet', 'single-bangle', 
                'rings', 'waist-belt', 'anklet', 'toe-ring'
            ];
            
            const rightSideTypes = [
                'hair-jewellery', 'earrings-stud', 'earrings-drops', 'ear-loops',
                'short-necklace', 'rings', 'bracelet', 'waist-belt', 'anklet', 'toe-ring'
            ];
            
            // Ensure container has proper dimensions before positioning
            const container = document.getElementById('jewellery-container');
            const containerRect = container.getBoundingClientRect();
            
            if (containerRect.width === 0 || containerRect.height === 0) {
                console.log('Container not ready, retrying...');
                setTimeout(() => positionLabelsAndCreateLines(), 50);
                return;
            }
            
            const svg = document.getElementById('connecting-lines');
            svg.innerHTML = ''; // Clear existing lines
            
            // Ensure SVG has proper dimensions for mobile/desktop
            if (containerRect.width > 0 && containerRect.height > 0) {
                svg.setAttribute('width', containerRect.width);
                svg.setAttribute('height', containerRect.height);
                svg.setAttribute('viewBox', `0 0 ${containerRect.width} ${containerRect.height}`);
            }
            
            // Get saved positions for current model and device
            const currentImagePath = currentModelData ? currentModelData.image : null;
            const modelPositions = currentImagePath && labelPositions[currentImagePath] ? labelPositions[currentImagePath] : {};
            const savedPositions = modelPositions[currentDeviceType] || {};
            
            jewelleryTypes.forEach(type => {
                const positionDot = document.querySelector(`.jewellery-position[data-type="${type}"]`);
                const label = document.querySelector(`.jewellery-label[data-type="${type}"]`);
                
                if (positionDot && label) {
                    const dotRect = positionDot.getBoundingClientRect();
                    const container = document.getElementById('jewellery-container');
                    const containerRect = container.getBoundingClientRect();
                    
                    let labelX, labelY;
                    
                    // Check if we have saved positions for this label
                    if (savedPositions[type]) {
                        // Use saved positions (convert from percentage to pixels)
                        labelX = (savedPositions[type].x / 100) * containerRect.width;
                        labelY = (savedPositions[type].y / 100) * containerRect.height;
                        console.log(`Using saved ${currentDeviceType} position for ${type}:`, savedPositions[type]);
                    } else {
                        // Use default positioning logic
                        const isRightSide = rightSideTypes.includes(type);
                        const offsetDistance = 100; // Distance from the dot
                        
                        const dotX = dotRect.left - containerRect.left + dotRect.width / 2;
                        const dotY = dotRect.top - containerRect.top + dotRect.height / 2;
                        
                        if (isRightSide) {
                            labelX = dotX + offsetDistance;
                            labelY = dotY - label.offsetHeight / 2;
                        } else {
                            labelX = dotX - offsetDistance - label.offsetWidth;
                            labelY = dotY - label.offsetHeight / 2;
                        }
                        console.log(`Using default position for ${type}`);
                    }
                    
                    // Constrain within container
                    labelX = Math.max(0, Math.min(labelX, containerRect.width - label.offsetWidth));
                    labelY = Math.max(0, Math.min(labelY, containerRect.height - label.offsetHeight));
                    
                    label.style.left = labelX + 'px';
                    label.style.top = labelY + 'px';
                    
                    // Create connecting line
                    const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                    line.id = `line-${type}`;
                    line.classList.add('connecting-line');
                    svg.appendChild(line);
                    
                    // Update line position
                    updateConnectingLine(type);
                }
            });
        }

        // Set up jewellery visibility controls
        function setupJewelleryControls() {
            const jewelleryTypes = [
                'forehead-pendant', 'hair-jewellery', 'earrings-stud', 'earrings-drops', 
                'ear-loops', 'nose-pin', 'choker-necklace', 'short-necklace', 
                'long-necklace', 'multiple-bangles', 'bracelet', 'single-bangle', 
                'rings', 'waist-belt', 'anklet', 'toe-ring'
            ];

            jewelleryTypes.forEach(type => {
                const toggle = document.getElementById(`toggle-${type}`);
                const indicator = toggle.closest('li').querySelector('.visibility-indicator');
                
                toggle.addEventListener('change', function() {
                    const positionDot = document.querySelector(`.jewellery-position[data-type="${type}"]`);
                    const label = document.querySelector(`.jewellery-label[data-type="${type}"]`);
                    const line = document.querySelector(`#line-${type}`);
                    
                    if (this.checked) {
                        if (positionDot) positionDot.style.display = 'block';
                        if (label) label.style.display = 'flex';
                        if (line) line.style.display = 'block';
                        indicator.classList.add('visible');
                    } else {
                        if (positionDot) positionDot.style.display = 'none';
                        if (label) label.style.display = 'none';
                        if (line) line.style.display = 'none';
                        indicator.classList.remove('visible');
                    }
                });
            });
        }

        // Show all jewellery items
        function showAllJewellery() {
            document.querySelectorAll('[id^="toggle-"]').forEach(toggle => {
                toggle.checked = true;
                toggle.dispatchEvent(new Event('change'));
            });
        }

        // Hide all jewellery items
        function hideAllJewellery() {
            document.querySelectorAll('[id^="toggle-"]').forEach(toggle => {
                toggle.checked = false;
                toggle.dispatchEvent(new Event('change'));
            });
        }

        // Debug function to manually redraw lines
        function debugRedrawLines() {
            console.log('=== Debug: Manually redrawing lines ===');
            const container = document.getElementById('jewellery-container');
            const containerRect = container.getBoundingClientRect();
            const svg = document.getElementById('connecting-lines');
            
            console.log('Container rect:', containerRect);
            console.log('SVG element:', svg);
            console.log('Current device type:', currentDeviceType);
            console.log('Container classes:', container.className);
            
            // Force redraw
            positionLabelsAndCreateLines();
            
            // Also update all lines
            setTimeout(() => {
                updateAllConnectingLines();
            }, 100);
        }

        // Save current label positions
        async function savePositions() {
            if (!currentModelData) {
                alert('Please select a model first');
                return;
            }
            
            const positions = {};
            const jewelleryTypes = [
                'forehead-pendant', 'hair-jewellery', 'earrings-stud', 'earrings-drops', 
                'ear-loops', 'nose-pin', 'choker-necklace', 'short-necklace', 
                'long-necklace', 'multiple-bangles', 'bracelet', 'single-bangle', 
                'rings', 'waist-belt', 'anklet', 'toe-ring'
            ];
            
            jewelleryTypes.forEach(type => {
                const label = document.querySelector(`.jewellery-label[data-type="${type}"]`);
                if (label) {
                    const container = document.getElementById('jewellery-container');
                    const containerRect = container.getBoundingClientRect();
                    const labelRect = label.getBoundingClientRect();
                    
                    const x = ((labelRect.left - containerRect.left) / containerRect.width) * 100;
                    const y = ((labelRect.top - containerRect.top) / containerRect.height) * 100;
                    
                    positions[type] = { x, y };
                }
            });
            
            try {
                const response = await fetch('/api/jewellery/save-positions', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        model_image: currentModelData.image,
                        positions: positions,
                        device_type: currentDeviceType // Include device type
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Update local storage
                    if (!labelPositions[currentModelData.image]) {
                        labelPositions[currentModelData.image] = {};
                    }
                    labelPositions[currentModelData.image][currentDeviceType] = positions;
                    
                    alert(`${currentDeviceType.charAt(0).toUpperCase() + currentDeviceType.slice(1)} label positions saved successfully!`);
                    console.log(`Saved ${currentDeviceType} positions for`, currentModelData.image, positions);
                } else {
                    alert('Failed to save positions: ' + data.message);
                }
            } catch (error) {
                console.error('Error saving positions:', error);
                alert('Error saving positions. Please try again.');
            }
        }

        // Load jewellery position data (same as main app)
        async function loadJewelleryPositions() {
            try {
                const knownFiles = [
                    '/data/lehnga-annotations.json',
                    '/data/saree-annotations.json',
                    '/data/gown-annotations.json',
                    '/data/anarkali-annotations.json',
                    '/data/new-annotations.json',
                    '/data/telugu-lehnga-annotations.json',
                    '/data/gujarati-lehnga-annotations.json',
                    '/data/gujarati-gown-annotations.json',
                    '/data/bengali-lehnga-annotations.json',
                    '/data/bengali-saree-annotations.json',
                    '/data/marathi-lehnga-annotations.json',
                    '/data/marathi-saree-annotations.json',
                    '/data/tamil-gown-annotations.json',
                    '/data/bihari-lehnga-annotations.json',
                    '/data/bihari-saree-annotations.json',
                    '/data/kannadiga-lehnga-annotations.json',
                    '/data/kannadiga-saree-annotations.json',
                    '/data/jharkhand-lehnga-annotations.json',
                    '/data/jharkhand-saree-annotations.json',
                    '/data/jharkhand-gown-annotations.json',
                    '/data/up-lehnga-annotations.json'
                ];

                let positionData = {};
                let loadedCount = 0;

                for (const file of knownFiles) {
                    try {
                        const response = await fetch(file);
                        const data = await response.json();

                        if (Array.isArray(data) && data[0] && data[0].file_upload) {
                            const parsed = parseAnnotationData(data);
                            positionData = { ...positionData, ...parsed };
                            loadedCount++;
                        }
                    } catch (fileError) {
                        console.log(`Could not load ${file}:`, fileError.message);
                    }
                }

                console.log(`Loaded ${loadedCount} position data files`);
                jewelleryPositions = positionData;
                generateJewelleryCSSRules(positionData);

            } catch (error) {
                console.error('Failed to load jewellery positions:', error);
            }
        }

        // Parse annotation data (same as main app)
        function parseAnnotationData(annotationArray) {
            const positionData = {};

            annotationArray.forEach(item => {
                if (!item.file_upload || !item.annotations || !item.annotations[0]) {
                    return;
                }

                const fileUpload = item.file_upload;
                const imageName = extractImageName(fileUpload);

                if (!imageName) return;

                const annotation = item.annotations[0];
                if (!annotation.result) return;

                const positions = {};

                annotation.result.forEach(point => {
                    if (!point.value || !point.value.keypointlabels || !point.value.keypointlabels[0]) {
                        return;
                    }

                    const jewelleryType = point.value.keypointlabels[0];
                    const x = point.value.x;
                    const y = point.value.y;

                    positions[jewelleryType] = { x, y };
                });

                positionData[imageName] = positions;
            });

            return positionData;
        }

        // Extract image name (same as main app)
        function extractImageName(fileUpload) {
            const fileName = fileUpload.split('/').pop();
            const baseName = fileName.replace(/^[a-f0-9-]+-/, '');

            const nameMapping = {
                'lahnga.jpeg': 'lehnga.png',
                'gown.jpeg': 'gown.png',
                'saree.jpeg': 'saree.png',
                'saree.png': 'saree.png',
                'anarkali.jpeg': 'anarkali.png',
                'new.jpeg': 'new.png',
                'new.png': 'new.png',
                'telugu-saree.png': 'bystate/telugu-saree.png',
                'telugu-lehnga.png': 'bystate/telugu-lehnga.png',
                'telugu-gown.png': 'bystate/telugu-gown.png',
                'gujarati-lehnga.png': 'bystate/gujarati-lehnga.png',
                'gujarati-gown.png': 'bystate/gujarati-gown.png',
                'bengali-lehnga.png': 'bystate/bengali-lehnga.png',
                'bengali-saree.png': 'bystate/bengali-saree.png',
                'marathi-lehnga.png': 'bystate/marathi-lehnga.png',
                'marathi-saree.png': 'bystate/marathi-saree.png',
                'tamil-gown.png': 'bystate/tamil-gown.png',
                'bihari-lehnga.png': 'bystate/bihari-lehnga.png',
                'bihari-saree.png': 'bystate/bihari-saree.png',
                'kannadiga-lehnga.png': 'bystate/kannadiga-lehnga.png',
                'kannadiga-saree.png': 'bystate/kannadiga-saree.png',
                'jharkhand-lehnga.png': 'bystate/jharkhand-lehnga.png',
                'jharkhand-saree.png': 'bystate/jharkhand-saree.png',
                'jharkhand-gown.png': 'bystate/jharkhand-gown.png',
                'up-lehnga.png': 'bystate/up-lehnga.png'
            };

            let result = nameMapping[baseName];
            if (!result) {
                if (baseName.includes('-') && (baseName.includes('saree') || baseName.includes('lehnga') || baseName.includes('gown'))) {
                    result = `bystate/${baseName}`;
                } else {
                    result = baseName.replace(/\.jpeg$/, '.png');
                }
            }

            return result;
        }

        // Generate CSS rules for jewellery positioning (modified for position dots)
        function generateJewelleryCSSRules(positionData) {
            const style = document.createElement('style');
            style.id = 'dynamic-jewellery-css';

            let cssRules = `
                .image-container {
                    position: relative;
                    display: inline-block;
                    width: 100%;
                    margin: 0 auto;
                }

                .image-container .model-image {
                    display: block;
                    width: 100%;
                    height: auto;
                    position: relative;
                }

                .image-container .jewellery-position,
                .image-container .jewellery-label {
                    position: absolute;
                    z-index: 10;
                }
            `;

            Object.keys(positionData).forEach(imageFileName => {
                const positions = positionData[imageFileName];
                let sanitizedClassName = imageFileName.replace(/\.[^/.]+$/, "");

                if (sanitizedClassName.includes('bystate/')) {
                    sanitizedClassName = sanitizedClassName.replace('bystate/', '');
                }

                Object.keys(positions).forEach(jewelleryType => {
                    const position = positions[jewelleryType];

                    const cssRule = `
                        .image-container.${sanitizedClassName} .jewellery-position[data-type="${jewelleryType}"] {
                            left: ${position.x}%;
                            top: ${position.y}%;
                        }
                    `;
                    cssRules += cssRule;
                });
            });

            style.textContent = cssRules;
            document.head.appendChild(style);
        }

        // Update jewellery positions for specific image type (same as main app)
        function updateJewelleryPositions(imageTypeOrFileName) {
            const container = document.getElementById('jewellery-container');
            if (!container) return;

            // Remove all existing image type classes
            const imageTypes = ['lehnga', 'gown', 'saree', 'anarkali', 'others'];
            const stateSpecificClasses = ['telugu-saree', 'telugu-lehnga', 'telugu-gown', 'gujarati-lehnga', 'gujarati-gown',
                                        'bengali-lehnga', 'bengali-saree', 'marathi-lehnga', 'marathi-saree', 'tamil-gown', 
                                        'bihari-lehnga', 'bihari-saree', 'kannadiga-lehnga', 'kannadiga-saree', 
                                        'jharkhand-lehnga', 'jharkhand-saree', 'jharkhand-gown', 'up-lehnga'];

            [...imageTypes, ...stateSpecificClasses].forEach(type => container.classList.remove(type));

            // Extract the appropriate class name from the image path
            let className = imageTypeOrFileName;

            if (className.includes('bystate/')) {
                const fileName = className.split('/').pop();
                className = fileName.replace(/\.[^/.]+$/, "");
            } else {
                className = className.includes('.') ?
                    className.replace(/\.[^/.]+$/, "") :
                    className;
            }

            // Add new image type class
            container.classList.add(className);
            console.log(`Updated jewellery container class to: ${className}`);
        }

        // Handle window resize to update lines
        window.addEventListener('resize', () => {
            setTimeout(() => {
                updateAllConnectingLines();
            }, 100);
        });
    </script>
</body>

</html>
