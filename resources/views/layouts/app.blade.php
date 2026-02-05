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

<body>

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Page Content --}}
    <main class="container mx-auto px-4">
        @yield('content')
    </main>

    {{-- SUCCESS SNACKBAR --}}

    @if (session('success'))
    <div id="snackbar" role="status" aria-live="polite" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50
            bg-emerald-600 text-white text-sm
            px-6 sm:px-10 py-4
            rounded-xl shadow-2xl
            flex items-center justify-center gap-2
            animate-slide-up transition-all duration-300 ease-in-out
            pointer-events-none
            max-w-md w-auto">


        <span class="snackbar-icon" aria-hidden="true"><i class="bi bi-check-circle-fill"></i></span>
        <span class="snackbar-text">{{ session('success') }}</span>
    </div>
    @endif


    {{-- ERROR SNACKBAR --}}
    @if (session('error'))
    <div id="snackbar-error" role="status" aria-live="polite" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50
            bg-red-600 text-white text-sm
            px-6 sm:px-10 py-4
            rounded-xl shadow-2xl
            flex items-center justify-center gap-4
            animate-slide-up transition-all duration-300 ease-in-out
            pointer-events-none
            max-w-md w-auto">
        <span class="snackbar-icon" aria-hidden="true"><i class="bi bi-exclamation-circle-fill"></i></span>
        <span class="snackbar-text">{{ session('error') }}</span>
    </div>
    @endif

    {{-- Generic delete modal  --}}
    @include('components.modals.delete.delete-modal')

    {{-- Delete Modal Script --}}
    <script>
        document.addEventListener('click', function (e) {
        const btn = e.target.closest('.list-trash-btn');
        if (!btn) return;

        e.preventDefault();

        const id = btn.dataset.id;
        const action = btn.dataset.action;
        const title = btn.dataset.title || 'Delete Item';

        document.getElementById('deleteModalTitle').textContent = title;
        document.getElementById('deleteForm').action = `/${action}/${id}`;

        window.location.hash = 'deleteModal';
        });
    </script>
    {{-- Snackbar Auto Dismiss --}}
    <script>
        setTimeout(() => {
            document.querySelectorAll('#snackbar, #snackbar-error').forEach(el => {

                el.classList.add('opacity-0', 'translate-y-6');
                setTimeout(() => el.remove(), 350);
            });
        }, 3000);
    </script>
<script>
    const toggle = document.getElementById('themeToggle');
    const root = document.documentElement;

    // Load saved theme
    const savedTheme = localStorage.getItem('theme');

    if (savedTheme === 'dark') {
        root.classList.add('dark');
        toggle.checked = true;
    }

    toggle.addEventListener('change', () => {
        const isDark = toggle.checked;
        root.classList.toggle('dark', isDark);
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
</script>
    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>