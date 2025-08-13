
<header class="tanishq-header">
    <div class="header-content container d-flex align-items-center justify-content-between">
        <!-- Left: Back Button -->
        <div class="header-left">
            <button type="button" class="btn btn-link p-0 d-flex align-items-center" onclick="history.back()">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#300708" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
                </svg>
                <span class="visually-hidden">Back</span>
            </button>
        </div>
        <!-- Center: Logo -->
        <div class="header-center text-center ">
            <a href="/" class="d-inline-block mx-auto"><img src="{{ asset('image/logo.png') }}" alt="Tanishq Rivaah Wedding Jewellery" class="tanishq-logo"></a>
        </div>

        <div class="d-flex justify-content-end wishlist-btn">
        <!-- Right: Wishlist Button -->
        <div class="header-right">
            <button type="button" class="btn btn-link p-0 d-flex align-items-center" aria-label="Wishlist">
               <svg version="1.1" class="mr-3" width="20px" height="20px" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 512.003 512.003" style="enable-background:new 0 0 512.003 512.003;" xml:space="preserve">
<g>
	<path style="fill:#E8594B;" d="M256.001,105.69c19.535-49.77,61.325-87.79,113.231-87.79c43.705,0,80.225,22.572,108.871,54.44
		c39.186,43.591,56.497,139.193-15.863,209.24c-37.129,35.946-205.815,212.524-205.815,212.524S88.171,317.084,50.619,281.579
		C-22.447,212.495-6.01,116.919,34.756,72.339c28.919-31.629,65.165-54.44,108.871-54.44
		C195.532,17.899,236.466,55.92,256.001,105.69"/>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>
                Wishlist
            </button>
        </div>
        </div>
    </div>
</header>

<style>
    .tanishq-header {
        width: 100%;
        padding: 20px 0;
        background-color: #fef9f7;
    }
    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
    }
    .header-left{
        flex:20%;
    }
    .header-center{
        flex: 60%;

    }
    .header-right{

        width: max-content;
    }
    .wishlist-btn{
        flex:20%;
    }
    .header-left, .header-center, .header-right {
        display: flex;
        align-items: center;
    }
    /* .header-center {
        flex: 1 1 0%;
        justify-content: center;
    } */
    .tanishq-logo {
        width: 150px;
        height: auto;
    }
    .header-right{
        border:2px solid #42210b;
        padding: 10px 20px;
        border-radius: 30px;
    }
    .header-right button {
        text-decoration: none;
        font-weight: semibold;

            color:black;

    }
    .header-right {
        border: 2px solid #42210b;
        padding: 10px 20px;
        border-radius: 30px;
    }
    .header-right button:hover{
        color: black;
    }
    .header-right button svg{
        margin-right: 5px;
    }
    @media (max-width: 768px) {
        .tanishq-logo {
            width: 120px;
        }
        .header-content {
            padding-left: 8px;
            padding-right: 8px;
        }
    }
</style>
