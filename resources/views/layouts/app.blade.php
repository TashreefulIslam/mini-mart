<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini-Mart</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <div class="relative isolate overflow-hidden bg-slate-950 text-white">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(16,185,129,0.34),_transparent_36%),radial-gradient(circle_at_top_right,_rgba(14,165,233,0.22),_transparent_28%)]"></div>
        <div class="relative">
            <div class="mm-container flex flex-col gap-2 py-3 text-xs font-medium sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-2 text-slate-200">
                    <span class="mm-badge bg-brand-500/15 text-brand-200 ring-1 ring-inset ring-brand-500/25">Fast delivery</span>
                    <span>Same-day support for nearby orders in select areas.</span>
                </div>
                <div class="flex items-center gap-4 text-slate-300">
                    <span>Trusted e-commerce experience</span>
                    <span class="hidden h-1 w-1 rounded-full bg-slate-500 sm:inline-flex"></span>
                    <span>Cash on delivery available</span>
                </div>
            </div>
        </div>
    </div>
    @include('components.navbar')
    <main class="mm-container py-6 sm:py-8 lg:py-10">
        @if(session('success'))
            <div data-toast class="mb-6 flex items-start justify-between gap-4 rounded-[1.25rem] border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-900 shadow-sm transition duration-200">
                <div>
                    <p class="text-sm font-semibold">Success</p>
                    <p class="mt-1 text-sm">{{ session('success') }}</p>
                </div>
                <button type="button" data-toast-close class="rounded-full p-2 text-emerald-700 transition hover:bg-emerald-100" aria-label="Dismiss notification">&times;</button>
            </div>
        @endif
        @if(session('error'))
            <div data-toast class="mb-6 flex items-start justify-between gap-4 rounded-[1.25rem] border border-rose-200 bg-rose-50 px-4 py-3 text-rose-900 shadow-sm transition duration-200">
                <div>
                    <p class="text-sm font-semibold">Error</p>
                    <p class="mt-1 text-sm">{{ session('error') }}</p>
                </div>
                <button type="button" data-toast-close class="rounded-full p-2 text-rose-700 transition hover:bg-rose-100" aria-label="Dismiss notification">&times;</button>
            </div>
        @endif
        @if($errors->any())
            <div data-toast class="mb-6 flex items-start justify-between gap-4 rounded-[1.25rem] border border-rose-200 bg-rose-50 px-4 py-3 text-rose-900 shadow-sm transition duration-200">
                <div>
                    <p class="text-sm font-semibold">Validation issue</p>
                    <p class="mt-1 text-sm">{{ $errors->first() }}</p>
                </div>
                <button type="button" data-toast-close class="rounded-full p-2 text-rose-700 transition hover:bg-rose-100" aria-label="Dismiss notification">&times;</button>
            </div>
        @endif

        @yield('content')
    </main>
    <footer class="mt-12 border-t border-slate-200 bg-white/90 backdrop-blur">
        <div class="mm-container py-12">
            <div class="grid gap-10 md:grid-cols-2 xl:grid-cols-4">
                <div>
                    <div class="text-2xl font-black tracking-[0.2em] text-brand-700">MINI-MART</div>
                    <p class="mt-4 max-w-sm text-sm leading-7 text-slate-600">A polished neighborhood store for everyday essentials, groceries, and fast online ordering.</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-900">Quick links</h3>
                    <ul class="mt-4 space-y-3 text-sm text-slate-600">
                        <li><a href="/" class="transition hover:text-brand-700">Home</a></li>
                        <li><a href="/products" class="transition hover:text-brand-700">Shop</a></li>
                        <li><a href="/products#featured" class="transition hover:text-brand-700">Featured products</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-900">Customer care</h3>
                    <ul class="mt-4 space-y-3 text-sm text-slate-600">
                        <li><a href="{{ route('cart.index') }}" class="transition hover:text-brand-700">Cart</a></li>
                        @auth
                            <li><a href="{{ route('customer.dashboard') }}" class="transition hover:text-brand-700">Dashboard</a></li>
                            <li><a href="{{ route('customer.orders') }}" class="transition hover:text-brand-700">Orders</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="transition hover:text-brand-700">Login</a></li>
                            <li><a href="{{ route('register') }}" class="transition hover:text-brand-700">Register</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-900">Store promise</h3>
                    <div class="mt-4 space-y-3 text-sm text-slate-600">
                        <p>Clean ordering flow</p>
                        <p>Responsive shopping experience</p>
                        <p>Clear product presentation</p>
                    </div>
                </div>
            </div>
            <div class="mt-10 flex flex-col gap-3 border-t border-slate-200 pt-6 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p>© 2026 Mini-Mart. All rights reserved.</p>
                <a href="#top" class="font-medium text-brand-700 transition hover:text-brand-800">Back to top</a>
            </div>
        </div>
    </footer>

    <button type="button" data-back-to-top class="fixed bottom-6 right-6 z-50 inline-flex items-center justify-center rounded-full bg-slate-900 px-4 py-3 text-sm font-semibold text-white shadow-lg transition duration-200 hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 opacity-0 pointer-events-none translate-y-2">Top</button>
</body>
</html>
