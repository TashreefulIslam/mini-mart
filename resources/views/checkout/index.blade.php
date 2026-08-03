@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-6xl space-y-6">
        <div class="mm-surface p-6 sm:p-8">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="mm-subtitle">Checkout</p>
                    <h1 class="mt-2 mm-section-title">Confirm shipping details and place your order</h1>
                    <p class="mm-section-copy">The payment flow remains unchanged, with a cleaner layout and clearer order summary.</p>
                </div>
                <div class="mm-badge bg-brand-50 text-brand-700 ring-1 ring-brand-100">Payment: Cash on Delivery</div>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_24rem]">
            <div class="mm-surface p-6 sm:p-8">
                <h2 class="text-xl font-bold text-slate-900">Customer information</h2>
                <form method="post" action="{{ route('checkout.place') }}" class="mt-6 space-y-5">@csrf
                    <div>
                        <label class="mm-label" for="shipping_name">Full name</label>
                        <input id="shipping_name" name="shipping_name" class="mm-input mt-2" value="{{ old('shipping_name', auth()->user()->name ?? '') }}">
                    </div>
                    <div>
                        <label class="mm-label" for="shipping_phone">Phone</label>
                        <input id="shipping_phone" name="shipping_phone" class="mm-input mt-2" value="{{ old('shipping_phone', auth()->user()->phone ?? '') }}">
                    </div>
                    <div>
                        <label class="mm-label" for="shipping_address">Shipping address</label>
                        <textarea id="shipping_address" name="shipping_address" rows="5" class="mm-input mt-2">{{ old('shipping_address', auth()->user()->address ?? '') }}</textarea>
                    </div>
                    <div class="rounded-[1.25rem] bg-brand-50 p-4 text-sm text-brand-700 ring-1 ring-brand-100">Please review the summary before placing the order.</div>
                    <button class="mm-btn-primary w-full sm:w-auto">Place order</button>
                </form>
            </div>

            <aside class="mm-surface p-6 sm:p-8 xl:sticky xl:top-28 xl:self-start">
                <h2 class="text-xl font-bold text-slate-900">Order summary</h2>
                <div class="mt-5 space-y-3">
                    @foreach($items as $it)
                        <div class="rounded-[1.25rem] border border-slate-200 bg-slate-50 p-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $it['product']->name }}</p>
                                    <p class="mt-1 text-sm text-slate-500">Qty {{ $it['quantity'] }}</p>
                                </div>
                                <span class="font-bold text-slate-900">৳ {{ number_format($it['subtotal']) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6 rounded-[1.25rem] bg-slate-950 p-5 text-white">
                    <div class="flex items-center justify-between text-sm text-slate-300">
                        <span>Total</span>
                        <span>COD</span>
                    </div>
                    <div class="mt-2 text-4xl font-black">৳ {{ number_format($total) }}</div>
                    <p class="mt-3 text-sm text-slate-300">Your order will be placed using the existing checkout flow.</p>
                </div>
            </aside>
        </div>
    </div>
@endsection
