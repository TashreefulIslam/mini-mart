@extends('layouts.app')

@section('content')
    <section class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
        <div class="space-y-6">
            <span class="mm-badge bg-brand-50 text-brand-700 ring-1 ring-brand-100">Modern mini e-commerce</span>
            <div class="space-y-4">
                <h1 class="mm-title max-w-2xl">A cleaner way to shop everyday essentials online.</h1>
                <p class="max-w-xl text-base leading-8 text-slate-600 sm:text-lg">Mini-Mart brings curated groceries, household items, and essentials into a fast, trustworthy storefront with a polished checkout flow.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('products.index') }}" class="mm-btn-primary">Shop now</a>
                <a href="#categories" class="mm-btn-secondary">Explore categories</a>
            </div>
            <div class="grid gap-4 sm:grid-cols-3">
                <div class="mm-card mm-card-hover p-5">
                    <p class="text-sm font-semibold text-slate-500">Products</p>
                    <p class="mt-3 text-3xl font-bold text-slate-900">Curated</p>
                    <p class="mt-2 text-sm text-slate-600">Clear product cards and fast browsing.</p>
                </div>
                <div class="mm-card mm-card-hover p-5">
                    <p class="text-sm font-semibold text-slate-500">Checkout</p>
                    <p class="mt-3 text-3xl font-bold text-slate-900">Simple</p>
                    <p class="mt-2 text-sm text-slate-600">Less friction from cart to order.</p>
                </div>
                <div class="mm-card mm-card-hover p-5">
                    <p class="text-sm font-semibold text-slate-500">Support</p>
                    <p class="mt-3 text-3xl font-bold text-slate-900">Trusted</p>
                    <p class="mt-2 text-sm text-slate-600">Built for real customers, not demos.</p>
                </div>
            </div>
        </div>

        <div class="relative">
            <div class="absolute -left-8 top-10 h-32 w-32 rounded-full bg-brand-300/20 blur-3xl"></div>
            <div class="relative mm-surface overflow-hidden bg-slate-950 p-6 text-white sm:p-8">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-brand-200">Fresh deals</p>
                        <h2 class="mt-2 text-2xl font-bold sm:text-3xl">Built for quick shopping</h2>
                    </div>
                    <div class="rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-white">COD ready</div>
                </div>
                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    @forelse($featured->take(2) as $product)
                        <a href="{{ route('products.show', $product) }}" class="group overflow-hidden rounded-[1.5rem] bg-white/10 ring-1 ring-white/10 transition hover:bg-white/15">
                            <div class="aspect-[4/3] overflow-hidden bg-white/10">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                            </div>
                            <div class="p-4">
                                <p class="text-sm text-slate-200">{{ $product->category->name ?? 'General' }}</p>
                                <p class="mt-2 font-semibold text-white">{{ $product->name }}</p>
                                <div class="mt-3 flex items-center justify-between text-sm">
                                    <span class="font-bold text-brand-200">৳ {{ number_format($product->price) }}</span>
                                    <span class="rounded-full bg-white/10 px-3 py-1 text-white">{{ $product->quantity ? 'In stock' : 'Sold out' }}</span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="sm:col-span-2 rounded-[1.5rem] border border-white/10 bg-white/5 p-6 text-slate-200">No featured products available.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section id="categories" class="mt-16">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="mm-subtitle">Shop by category</p>
                <h2 class="mt-2 mm-section-title">Browse the collection by department</h2>
            </div>
            <a href="{{ route('products.index') }}" class="hidden text-sm font-semibold text-brand-700 transition hover:text-brand-800 sm:inline-flex">View all products</a>
        </div>
        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @forelse($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="mm-card mm-card-hover group p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-bold text-slate-900">{{ $category->name }}</p>
                            <p class="mt-1 text-sm text-slate-500">Explore products in this category.</p>
                        </div>
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-50 text-brand-700 transition group-hover:bg-brand-600 group-hover:text-white">→</span>
                    </div>
                </a>
            @empty
                <div class="mm-card p-6 text-slate-600">No categories available.</div>
            @endforelse
        </div>
    </section>

    <section class="mt-16">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="mm-subtitle">Featured products</p>
                <h2 class="mt-2 mm-section-title">Handpicked items ready to order</h2>
            </div>
            <a href="{{ route('products.index') }}" class="text-sm font-semibold text-brand-700 transition hover:text-brand-800">View all products</a>
        </div>

        <div id="featured" class="mt-6 grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
            @forelse($featured as $product)
                <article class="mm-card mm-card-hover overflow-hidden">
                    <a href="{{ route('products.show', $product) }}" class="block">
                        <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-300 hover:scale-105">
                            <div class="absolute left-4 top-4">
                                <span class="mm-badge bg-white/95 text-brand-700 shadow-sm">{{ $product->quantity ? 'In stock' : 'Out of stock' }}</span>
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
                            <a href="{{ route('products.show', $product) }}" class="text-sm font-semibold text-slate-600 transition hover:text-brand-700">Details</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="mm-card p-6 text-slate-500">No featured products available.</div>
            @endforelse
        </div>
    </section>

    <section class="mt-16 grid gap-6 lg:grid-cols-3">
        <div class="mm-card p-6">
            <h3 class="text-lg font-bold text-slate-900">Why Mini-Mart</h3>
            <ul class="mt-4 space-y-3 text-sm text-slate-600">
                <li class="flex gap-3"><span class="mt-0.5 inline-flex h-8 w-8 items-center justify-center rounded-full bg-brand-50 text-brand-700">✓</span>Fast delivery and support.</li>
                <li class="flex gap-3"><span class="mt-0.5 inline-flex h-8 w-8 items-center justify-center rounded-full bg-brand-50 text-brand-700">✓</span>Simple cart and checkout flow.</li>
                <li class="flex gap-3"><span class="mt-0.5 inline-flex h-8 w-8 items-center justify-center rounded-full bg-brand-50 text-brand-700">✓</span>Cash on delivery ready.</li>
            </ul>
        </div>
        <div class="mm-card p-6">
            <h3 class="text-lg font-bold text-slate-900">Shopping experience</h3>
            <div class="mt-4 grid gap-3 text-sm text-slate-600">
                <div class="rounded-2xl bg-slate-50 p-4">Responsive storefront optimized for mobile and desktop.</div>
                <div class="rounded-2xl bg-slate-50 p-4">Clear product cards, helpful pricing, and easy navigation.</div>
            </div>
        </div>
        <div class="mm-card p-6">
            <h3 class="text-lg font-bold text-slate-900">Customer trust</h3>
            <div class="mt-4 space-y-4 text-sm text-slate-600">
                <p class="rounded-2xl bg-slate-50 p-4">"Great products and fast ordering experience."</p>
                <p class="rounded-2xl bg-slate-50 p-4">"Easy checkout and helpful UI."</p>
            </div>
        </div>
    </section>
@endsection
