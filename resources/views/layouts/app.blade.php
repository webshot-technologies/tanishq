<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Jewellery Showcase')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @stack('styles')
</head>
<body>
    <div class="main-wrapper" style="min-height: 100vh">
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
    <script>
document.addEventListener('DOMContentLoaded', function() {
    var logo = document.querySelector('.header-logo, #header-logo, .navbar-brand'); // Adjust selector as needed
    if (logo) {
        console.log(logo);
        logo.addEventListener('click', function() {
            if (window.posthog && typeof window.posthog.reset === 'function') {
                window.posthog.reset();
                console.log('PostHog session reset triggered.');
            }
        });
    }
});
</script>
</body>
