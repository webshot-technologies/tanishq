@extends('layouts.app')

@section('title', 'Product Choose')

@section('content')
 <section class="product-categories-section " style=" ">
    <div class="container">
        <div class="row justify-content-center">
            <!-- First Grid Item -->
            <div class="col-md-5 col-sm-6 mb-4">
                <a href="{{route('list.product', ['slug' => 'recommended-products'])}}" class="text-decoration-none">
                    <div class="product-card">
                        <img  src="{{ asset('image/18kt-jewellery.webp') }}" alt="Auspicious Occasion Jewellery">

                </div>
                <div class="product-card-body">
                        <h3 class="product-card-title">Recommended Products</h3>
                    </div>
                </a>
            </div>
            <!-- Second Grid Item -->
            <div class="col-md-5 col-sm-6 mb-4">
                <a href="{{route('list.product', ['slug' => 'all-products'])}}" class="text-decoration-none">
                    <div class="product-card">
                        <img  src="{{ asset('image/sbg-women.jpg') }}" alt="Gifting Jewellery">

                   </div>
                <div class="product-card-body">
                        <h3 class="product-card-title">Full Catalogue</h3>
                    </div>
                </a>
            </div>

            <!-- If you need a third, you would add another col-md-4 here -->
        </div>
        <div class="mt-auto text-center pt-4 fs-6 text-custom-dark text-dark-gray opacity-75">
                                    &copy; Powered By <a href="https://www.mirrar.com/" class="base-color"> MIRRAR </a>
                                </div>
    </div>
</section>
@endsection
