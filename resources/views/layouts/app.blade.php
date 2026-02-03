<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body class="bg-gray-50">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Page Content --}}
    <main class="container mx-auto px-4">
        @yield('content')
    </main>

    {{-- SUCCESS SNACKBAR --}}

{{-- @if (session('success')) --}}
<div id="snackbar" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50
            bg-emerald-600 text-white text-sm
             
            rounded-lg shadow-lg
            flex items-center gap-3
            animate-slide-up transition-all duration-300 ease-in-out
            pointer-events-none
            max-w-md w-auto m-4">
            

    <i class="bi bi-check-circle-fill text-lg"></i>
    <span>this is just a test</span>
</div>
{{-- @endif --}}
 

    {{-- ERROR SNACKBAR --}}
@if (session('error'))
<div id="snackbar-error" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50
            bg-red-600 text-white text-sm
            px-10 py-4
            rounded-xl shadow-lg
            flex items-center gap-3
            animate-slide-up transition-all duration-300 ease-in-out
            pointer-events-none
            max-w-md w-full mx-4">

    <i class="bi bi-exclamation-circle-fill text-lg"></i>
    <span>{{ session('error') }}</span>
</div>
@endif

    {{-- Snackbar Auto Dismiss --}}
    <script>
        setTimeout(() => {
            document.querySelectorAll('#snackbar, #snackbar-error').forEach(el => {
                // fade out and slide down a bit for a smooth exit
                el.classList.add('opacity-0', 'translate-y-6');
                setTimeout(() => el.remove(), 350);
            });
        }, 3000);
    </script>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>