@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="mm-surface p-6 sm:p-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="mm-subtitle">Product catalog</p>
                    <h1 class="mt-2 mm-section-title">Browse everything available in Mini-Mart</h1>
                    <p class="mm-section-copy">Search by product name and narrow results by category without changing the underlying store logic.</p>
                </div>
                <div class="rounded-[1.25rem] bg-brand-50 px-4 py-3 text-sm text-brand-700 ring-1 ring-brand-100">Use filters to quickly find the right item.</div>
            </div>

            <form method="get" action="/products" class="mt-6 grid gap-4 rounded-[1.5rem] border border-slate-200 bg-slate-50 p-4 lg:grid-cols-[minmax(0,1fr)_16rem_auto]">
                <div>
                    <label class="sr-only" for="catalog-search">Search</label>
                    <input id="catalog-search" name="q" value="{{ request('q') }}" placeholder="Search products" class="mm-input">
                </div>
                <div>
                    <label class="sr-only" for="catalog-category">Category</label>
                    <select id="catalog-category" name="category" class="mm-input">
                        <option value="">All categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="mm-btn-primary w-full lg:w-auto">Filter</button>
            </form>
        </div>

        <div class="grid gap-6 xl:grid-cols-[16rem_minmax(0,1fr)]">
            <aside class="mm-surface p-5">
                <h2 class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Browse</h2>
                <div class="mt-4 space-y-2 text-sm font-semibold text-slate-700">
                    <a href="{{ route('products.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700 {{ !request('category') ? 'bg-brand-50 text-brand-700' : '' }}">All products</a>
                    @foreach($categories as $cat)
                        <a href="{{ route('products.index', ['category' => $cat->id, 'q' => request('q')]) }}" class="block rounded-2xl px-4 py-3 transition hover:bg-slate-100 hover:text-brand-700 {{ request('category') == $cat->id ? 'bg-brand-50 text-brand-700' : '' }}">{{ $cat->name }}</a>
                    @endforeach
                </div>
                <div class="mt-6 rounded-[1.25rem] bg-slate-50 p-4 text-sm text-slate-600">
                    Clear product presentation, smooth hover states, and quick add-to-cart actions.
                </div>
            </aside>

            <div>
                <div class="grid gap-5 sm:grid-cols-2 2xl:grid-cols-4">
                    @forelse($products as $product)
                        <article class="mm-card mm-card-hover overflow-hidden">
                            <a href="{{ route('products.show', $product) }}" class="block">
                                <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-300 hover:scale-105">
                                    <div class="absolute left-4 top-4">
                                        <span class="mm-badge {{ $product->quantity ? 'bg-white/95 text-brand-700' : 'bg-rose-50 text-rose-700' }} shadow-sm">
                                            {{ $product->quantity ? 'In stock' : 'Out of stock' }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <div class="space-y-4 p-5">
                                <div>
                                    <p class="text-sm text-slate-500">{{ $product->category->name ?? 'General' }}</p>
                                    <h3 class="mt-1 line-clamp-2 text-lg font-bold text-slate-900">{{ $product->name }}</h3>
                                </div>
                                <div class="flex items-end justify-between gap-3">
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Price</p>
                                        <div class="mt-1 text-2xl font-black text-brand-700">৳ {{ number_format($product->price) }}</div>
                                    </div>
                                    <a href="{{ route('products.show', $product) }}" class="text-sm font-semibold text-slate-600 transition hover:text-brand-700">View</a>
                                </div>
                                <div class="flex items-center gap-3">
                                    @if($product->quantity > 0)
                                        <form method="post" action="{{ route('cart.add', $product) }}" class="flex-1">@csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button class="mm-btn-primary w-full">Add to cart</button>
                                        </form>
                                    @else
                                        <div class="mm-btn-secondary w-full cursor-not-allowed opacity-60">Unavailable</div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full mm-surface p-10 text-center">
                            <h2 class="text-2xl font-bold text-slate-900">No products found.</h2>
                            <p class="mt-3 text-slate-600">Try changing your search or category filter.</p>
                            <div class="mt-6">
                                <a href="{{ route('products.index') }}" class="mm-btn-primary">Browse all products</a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8 rounded-[1.5rem] bg-white p-4 shadow-sm">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
