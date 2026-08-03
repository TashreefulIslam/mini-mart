@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="mm-surface p-6 sm:p-8">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="mm-subtitle">Shopping cart</p>
                    <h1 class="mt-2 mm-section-title">Review your selected items before checkout</h1>
                    <p class="mm-section-copy">Update quantities, remove products, and continue to a clean checkout flow.</p>
                </div>
                <span class="mm-badge bg-brand-50 text-brand-700 ring-1 ring-brand-100">{{ count($items) }} item(s)</span>
            </div>
        </div>

        @if(count($items) === 0)
            <div class="mm-surface p-10 text-center">
                <h2 class="text-2xl font-bold text-slate-900">Your cart is empty.</h2>
                <p class="mt-3 text-slate-600">Looks like you have not added anything yet.</p>
                <div class="mt-6">
                    <a href="{{ route('products.index') }}" class="mm-btn-primary">Start shopping</a>
                </div>
            </div>
        @else
            <div class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_24rem]">
                <div class="space-y-4">
                    <div class="hidden lg:block mm-table-shell">
                        <table class="w-full divide-y divide-slate-200 text-left text-slate-700">
                            <thead class="bg-slate-50 text-xs uppercase tracking-[0.2em] text-slate-500">
                                <tr>
                                    <th class="px-6 py-4">Product</th>
                                    <th class="px-6 py-4">Price</th>
                                    <th class="px-6 py-4">Qty</th>
                                    <th class="px-6 py-4">Subtotal</th>
                                    <th class="px-6 py-4"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white">
                                @foreach($items as $it)
                                    <tr class="transition hover:bg-slate-50">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <img src="{{ $it['product']->image_url }}" alt="{{ $it['product']->name }}" class="h-16 w-16 rounded-2xl object-cover">
                                                <div>
                                                    <a href="{{ route('products.show', $it['product']) }}" class="font-semibold text-slate-900 transition hover:text-brand-700">{{ $it['product']->name }}</a>
                                                    <p class="mt-1 text-sm text-slate-500">{{ $it['product']->category->name ?? 'General' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-medium">৳ {{ number_format($it['product']->price) }}</td>
                                        <td class="px-6 py-4">
                                            <form method="post" action="{{ route('cart.update', $it['product']) }}" class="flex items-center gap-2">@csrf
                                                <input type="number" name="quantity" value="{{ $it['quantity'] }}" min="1" max="{{ $it['product']->quantity }}" class="mm-input w-24">
                                                <button class="mm-btn-secondary px-4 py-2">Update</button>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-slate-900">৳ {{ number_format($it['subtotal']) }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <form method="post" action="{{ route('cart.remove', $it['product']) }}">@csrf @method('delete')
                                                <button class="rounded-full px-3 py-2 text-sm font-semibold text-rose-600 transition hover:bg-rose-50">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="space-y-4 lg:hidden">
                        @foreach($items as $it)
                            <article class="mm-card p-4">
                                <div class="flex gap-4">
                                    <img src="{{ $it['product']->image_url }}" alt="{{ $it['product']->name }}" class="h-24 w-24 rounded-2xl object-cover">
                                    <div class="min-w-0 flex-1">
                                        <a href="{{ route('products.show', $it['product']) }}" class="line-clamp-2 font-semibold text-slate-900">{{ $it['product']->name }}</a>
                                        <p class="mt-1 text-sm text-slate-500">{{ $it['product']->category->name ?? 'General' }}</p>
                                        <div class="mt-3 flex items-center justify-between gap-3">
                                            <span class="font-semibold text-brand-700">৳ {{ number_format($it['product']->price) }}</span>
                                            <form method="post" action="{{ route('cart.remove', $it['product']) }}">@csrf @method('delete')
                                                <button class="rounded-full px-3 py-2 text-sm font-semibold text-rose-600 transition hover:bg-rose-50">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" action="{{ route('cart.update', $it['product']) }}" class="mt-4 flex items-center gap-2">@csrf
                                    <input type="number" name="quantity" value="{{ $it['quantity'] }}" min="1" max="{{ $it['product']->quantity }}" class="mm-input w-24">
                                    <button class="mm-btn-secondary px-4 py-2">Update</button>
                                    <span class="ml-auto text-sm font-semibold text-slate-900">৳ {{ number_format($it['subtotal']) }}</span>
                                </form>
                            </article>
                        @endforeach
                    </div>
                </div>

                <aside class="mm-surface p-6 sm:p-8 xl:sticky xl:top-28 xl:self-start">
                    <h2 class="text-xl font-bold text-slate-900">Order summary</h2>
                    <div class="mt-4 space-y-3 rounded-[1.25rem] bg-slate-50 p-4 text-sm text-slate-600">
                        <div class="flex items-center justify-between">
                            <span>Subtotal</span>
                            <span class="font-semibold text-slate-900">৳ {{ number_format($total) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Delivery</span>
                            <span class="font-semibold text-slate-900">Calculated at checkout</span>
                        </div>
                    </div>
                    <div class="mt-6 rounded-[1.25rem] bg-slate-950 p-5 text-white">
                        <div class="flex items-center justify-between text-sm text-slate-300">
                            <span>Total</span>
                            <span>Ready to pay</span>
                        </div>
                        <div class="mt-2 text-4xl font-black">৳ {{ number_format($total) }}</div>
                        <p class="mt-3 text-sm text-slate-300">Proceed to checkout to confirm shipping and payment details.</p>
                    </div>
                    <div class="mt-6 grid gap-3">
                        <a href="{{ route('products.index') }}" class="mm-btn-secondary w-full">Continue shopping</a>
                        <a href="{{ route('checkout.index') }}" class="mm-btn-primary w-full">Proceed to checkout</a>
                    </div>
                </aside>
            </div>
        @endif
    </div>
@endsection
