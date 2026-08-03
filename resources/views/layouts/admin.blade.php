<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini-Mart Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(16,185,129,0.08),_transparent_34%),linear-gradient(180deg,_#f8fafc,_#f1f5f9)]">
        <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/90 backdrop-blur supports-[backdrop-filter]:bg-white/80">
            <div class="mm-container flex items-center gap-4 py-4">
                <a href="/admin/dashboard" class="flex items-center gap-3 rounded-2xl px-2 py-1 transition hover:bg-slate-50">
                    <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-600 to-slate-900 text-sm font-black text-white shadow-lg shadow-brand-600/20">MM</span>
                    <span>
                        <span class="block text-lg font-black tracking-[0.16em] text-slate-900">MINI-MART</span>
                        <span class="block text-xs font-medium uppercase tracking-[0.24em] text-slate-500">Admin workspace</span>
                    </span>
                </a>

                <div class="ml-auto flex items-center gap-3">
                    <a href="/" class="mm-btn-secondary hidden sm:inline-flex">View store</a>
                    <form method="post" action="{{ route('logout') }}">@csrf
                        <button class="mm-btn-primary bg-slate-900 hover:bg-slate-700">Logout</button>
                    </form>
                </div>
            </div>
        </header>
        <div class="mm-container grid gap-6 py-6 lg:grid-cols-[18rem_minmax(0,1fr)]">
            <aside class="mm-surface overflow-hidden p-4 lg:sticky lg:top-28 lg:self-start">
                <div class="rounded-[1.25rem] bg-slate-950 px-4 py-5 text-white">
                    <p class="text-xs font-semibold uppercase tracking-[0.28em] text-brand-200">Management</p>
                    <p class="mt-2 text-lg font-bold">Store operations panel</p>
                    <p class="mt-2 text-sm text-slate-300">Everything needed to manage inventory, users, and orders.</p>
                </div>
                <nav class="mt-4 space-y-1 text-sm font-semibold text-slate-700">
                    <a href="{{ route('admin.dashboard') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700 {{ request()->routeIs('admin.dashboard') ? 'bg-brand-50 text-brand-700' : '' }}">Dashboard</a>
                    <a href="{{ route('admin.categories.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700 {{ request()->is('admin/categories*') ? 'bg-brand-50 text-brand-700' : '' }}">Categories</a>
                    <a href="{{ route('admin.products.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700 {{ request()->is('admin/products*') ? 'bg-brand-50 text-brand-700' : '' }}">Products</a>
                    <a href="{{ route('admin.users.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700 {{ request()->is('admin/users*') ? 'bg-brand-50 text-brand-700' : '' }}">Users</a>
                    <a href="{{ route('admin.orders.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700 {{ request()->is('admin/orders*') ? 'bg-brand-50 text-brand-700' : '' }}">Orders</a>
                </nav>
            </aside>
            <main>
                @if(session('success'))
                    <div data-toast class="mb-6 flex items-start justify-between gap-4 rounded-[1.25rem] border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-900 shadow-sm transition duration-200">
                        <div>
                            <p class="text-sm font-semibold">Success</p>
                            <p class="mt-1 text-sm">{{ session('success') }}</p>
                        </div>
                        <button type="button" data-toast-close class="rounded-full p-2 text-emerald-700 transition hover:bg-emerald-100" aria-label="Dismiss notification">&times;</button>
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
        </div>
    </div>
</body>
</html>
