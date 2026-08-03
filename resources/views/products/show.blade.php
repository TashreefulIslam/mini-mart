@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="mm-card p-4 sm:p-6">
            <div class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('products.index') }}" class="font-semibold text-brand-700 transition hover:text-brand-800">Shop</a>
                <span>/</span>
                <span>{{ $product->category->name ?? 'General' }}</span>
                <span>/</span>
                <span class="text-slate-700">{{ $product->name }}</span>
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-[1.15fr_0.85fr]">
            <div class="space-y-4">
                <div class="mm-surface overflow-hidden">
                    <div class="relative aspect-[4/3] bg-slate-100">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                        <div class="absolute left-4 top-4 flex gap-2">
                            <span class="mm-badge bg-white/95 text-brand-700 shadow-sm">{{ $product->quantity > 0 ? 'In stock' : 'Out of stock' }}</span>
                            <span class="mm-badge bg-slate-950/85 text-white">{{ $product->category->name ?? 'General' }}</span>
                        </div>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="mm-card p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Price</p>
                        <p class="mt-2 text-2xl font-black text-brand-700">৳ {{ number_format($product->price) }}</p>
                    </div>
                    <div class="mm-card p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Stock</p>
                        <p class="mt-2 text-2xl font-black text-slate-900">{{ $product->quantity > 0 ? $product->quantity : '0' }}</p>
                    </div>
                    <div class="mm-card p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Support</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700">Fast checkout and clear product details.</p>
                    </div>
                </div>
                <div class="mm-surface p-6 sm:p-8">
                    <p class="mm-subtitle">Description</p>
                    <h1 class="mt-2 mm-section-title">{{ $product->name }}</h1>
                    <div class="mt-4 space-y-4 text-sm leading-7 text-slate-600 sm:text-base">
                        <p>{{ $product->description }}</p>
                        <p>Designed to give customers a straightforward, production-quality shopping flow from product page to cart.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="mm-surface p-6 sm:p-8">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="mm-subtitle">Product details</p>
                            <h2 class="mt-2 text-2xl font-bold text-slate-900 sm:text-3xl">{{ $product->name }}</h2>
                        </div>
                        <a href="{{ route('products.index') }}" class="text-sm font-semibold text-brand-700 transition hover:text-brand-800">Continue shopping</a>
                    </div>

                    <div class="mt-6 rounded-[1.25rem] bg-slate-50 p-4">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-400">Price</p>
                        <div class="mt-2 text-4xl font-black text-brand-700">৳ {{ number_format($product->price) }}</div>
                    </div>

                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-[1.25rem] border border-slate-200 bg-white p-4">
                            <p class="text-sm font-semibold text-slate-500">Category</p>
                            <p class="mt-2 text-lg font-bold text-slate-900">{{ $product->category->name ?? 'General' }}</p>
                        </div>
                        <div class="rounded-[1.25rem] border border-slate-200 bg-white p-4">
                            <p class="text-sm font-semibold text-slate-500">Availability</p>
                            <p class="mt-2 text-lg font-bold {{ $product->quantity > 0 ? 'text-emerald-600' : 'text-rose-600' }}">{{ $product->quantity > 0 ? 'In stock' : 'Out of stock' }}</p>
                        </div>
                    </div>

                    @if($product->quantity <= 0)
                        <div class="mt-6 rounded-[1.25rem] border border-rose-200 bg-rose-50 px-4 py-3 text-rose-700">This product is currently out of stock.</div>
                    @else
                        <form method="post" action="{{ route('cart.add', $product) }}" class="mt-6 space-y-5">@csrf
                            <div>
                                <label class="mm-label" for="quantity">Quantity</label>
                                <input id="quantity" type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}" class="mm-input mt-2">
                            </div>
                            <button class="mm-btn-primary w-full">Add to cart</button>
                        </form>
                    @endif
                </div>

                <div class="mm-card p-6">
                    <h3 class="text-lg font-bold text-slate-900">Store promise</h3>
                    <div class="mt-4 space-y-3 text-sm text-slate-600">
                        <div class="rounded-2xl bg-slate-50 p-4">Smooth mobile-friendly layout</div>
                        <div class="rounded-2xl bg-slate-50 p-4">Clear pricing and stock status</div>
                        <div class="rounded-2xl bg-slate-50 p-4">Preserves the existing cart flow</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
