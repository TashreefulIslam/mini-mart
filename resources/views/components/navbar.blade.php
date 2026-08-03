<nav class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/85">
    <div class="mm-container">
        <div class="flex items-center gap-4 py-4">
            <a href="/" class="flex items-center gap-3 rounded-2xl px-2 py-1 transition hover:bg-slate-50">
                <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-600 to-emerald-500 text-sm font-black text-white shadow-lg shadow-brand-600/20">MM</span>
                <span>
                    <span class="block text-lg font-black tracking-[0.2em] text-slate-900">MINI-MART</span>
                    <span class="block text-xs font-medium uppercase tracking-[0.24em] text-slate-500">E-commerce store</span>
                </span>
            </a>

            <form action="/products" method="get" class="relative hidden flex-1 lg:block">
                <label for="desktop-search" class="sr-only">Search products</label>
                <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.75">
                    <path d="M9 15a6 6 0 1 1 0-12 6 6 0 0 1 0 12Z" />
                    <path d="m14 14 4 4" stroke-linecap="round" />
                </svg>
                <input id="desktop-search" type="search" name="q" value="{{ request('q') }}" placeholder="Search products, brands, categories" class="mm-input pl-12 pr-28">
                <button type="submit" class="absolute inset-y-1.5 right-1.5 rounded-full bg-brand-600 px-4 text-sm font-semibold text-white transition hover:bg-brand-700">Search</button>
            </form>

            <div class="ml-auto hidden items-center gap-2 lg:flex">
                <a href="/products" class="rounded-full px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 hover:text-brand-700 {{ request()->routeIs('products.*') ? 'bg-brand-50 text-brand-700' : '' }}">Shop</a>
                <a href="/products#featured" class="rounded-full px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 hover:text-brand-700">Featured</a>
                <a href="{{ route('cart.index') }}" class="relative rounded-full px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 hover:text-brand-700">
                    Cart
                    <span class="ml-2 inline-flex min-w-7 items-center justify-center rounded-full bg-brand-600 px-2 py-1 text-xs font-bold text-white shadow-sm">{{ array_sum(session('cart', [])) }}</span>
                </a>

                @auth
                    <details class="relative">
                        <summary class="cursor-pointer list-none rounded-full px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 hover:text-brand-700">Account</summary>
                        <div class="absolute right-0 mt-3 w-56 overflow-hidden rounded-[1.25rem] border border-slate-200 bg-white p-2 shadow-[0_20px_60px_-24px_rgba(15,23,42,0.45)]">
                            <div class="px-3 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">{{ auth()->user()->name }}</div>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="block rounded-2xl px-3 py-2 text-sm text-slate-700 transition hover:bg-slate-100 hover:text-brand-700">Admin dashboard</a>
                                <a href="{{ route('admin.orders.index') }}" class="block rounded-2xl px-3 py-2 text-sm text-slate-700 transition hover:bg-slate-100 hover:text-brand-700">Orders</a>
                            @else
                                <a href="{{ route('customer.dashboard') }}" class="block rounded-2xl px-3 py-2 text-sm text-slate-700 transition hover:bg-slate-100 hover:text-brand-700">Dashboard</a>
                                <a href="{{ route('customer.orders') }}" class="block rounded-2xl px-3 py-2 text-sm text-slate-700 transition hover:bg-slate-100 hover:text-brand-700">My orders</a>
                                <a href="{{ route('profile.edit') }}" class="block rounded-2xl px-3 py-2 text-sm text-slate-700 transition hover:bg-slate-100 hover:text-brand-700">Profile</a>
                            @endif
                            <form method="post" action="{{ route('logout') }}" class="mt-1">@csrf
                                <button class="block w-full rounded-2xl px-3 py-2 text-left text-sm text-rose-600 transition hover:bg-rose-50">Logout</button>
                            </form>
                        </div>
                    </details>
                @else
                    <a href="{{ route('login') }}" class="rounded-full px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 hover:text-brand-700">Login</a>
                    <a href="{{ route('register') }}" class="mm-btn-primary px-4 py-2">Register</a>
                @endauth
            </div>

            <button type="button" data-mobile-menu-toggle aria-expanded="false" class="ml-auto inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white p-3 text-slate-700 transition hover:border-brand-300 hover:text-brand-700 lg:hidden" aria-label="Open menu">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-5 w-5" stroke-width="1.75" stroke-linecap="round">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div data-mobile-menu-panel class="hidden pb-5 lg:hidden">
            <div class="rounded-[1.5rem] border border-slate-200 bg-white p-4 shadow-sm">
                <form action="/products" method="get" class="relative">
                    <label for="mobile-search" class="sr-only">Search products</label>
                    <input id="mobile-search" type="search" name="q" value="{{ request('q') }}" placeholder="Search products, categories" class="mm-input pr-24">
                    <button type="submit" class="absolute inset-y-1.5 right-1.5 rounded-full bg-brand-600 px-4 text-sm font-semibold text-white transition hover:bg-brand-700">Search</button>
                </form>

                <div class="mt-4 grid gap-2 text-sm font-semibold text-slate-700">
                    <a href="/" class="rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700">Home</a>
                    <a href="/products" class="rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700">Shop</a>
                    <a href="/products#featured" class="rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700">Featured</a>
                    <a href="{{ route('cart.index') }}" class="rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700">Cart ({{ array_sum(session('cart', [])) }})</a>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700">Admin dashboard</a>
                            <a href="{{ route('admin.products.index') }}" class="rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700">Manage products</a>
                        @else
                            <a href="{{ route('customer.dashboard') }}" class="rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700">Dashboard</a>
                            <a href="{{ route('customer.orders') }}" class="rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700">Orders</a>
                            <a href="{{ route('profile.edit') }}" class="rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700">Profile</a>
                        @endif
                        <form method="post" action="{{ route('logout') }}" class="mt-2">@csrf
                            <button class="w-full rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-left font-semibold text-rose-700 transition hover:bg-rose-100">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700">Login</a>
                        <a href="{{ route('register') }}" class="rounded-2xl bg-brand-600 px-4 py-3 text-center font-semibold text-white transition hover:bg-brand-700">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
