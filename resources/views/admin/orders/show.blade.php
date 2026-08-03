@extends('layouts.admin')

@section('content')
    @php
        $statusClass = match (strtolower($order->status)) {
            'pending' => 'bg-amber-50 text-amber-700 ring-amber-200',
            'approved', 'processing' => 'bg-brand-50 text-brand-700 ring-brand-100',
            'delivered' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
            'declined', 'cancelled' => 'bg-rose-50 text-rose-700 ring-rose-200',
            default => 'bg-slate-100 text-slate-700 ring-slate-200',
        };
    @endphp

    <div class="space-y-6">
        <div class="mm-surface p-6 sm:p-8">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="mm-subtitle">Order management</p>
                    <h1 class="mt-2 mm-section-title">Order #{{ $order->id }}</h1>
                    <p class="mm-section-copy">Order details and status management.</p>
                </div>
                <span class="mm-badge ring-1 {{ $statusClass }}">{{ $order->status }}</span>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1fr_0.85fr]">
            <div class="mm-surface p-6 sm:p-8">
                <h2 class="text-xl font-bold text-slate-900">Customer</h2>
                <div class="mt-5 space-y-3 text-sm text-slate-600">
                    <p class="rounded-[1.25rem] bg-slate-50 p-4"><span class="font-semibold text-slate-900">Name:</span> {{ $order->user->name }}</p>
                    <p class="rounded-[1.25rem] bg-slate-50 p-4"><span class="font-semibold text-slate-900">Email:</span> {{ $order->user->email }}</p>
                    <p class="rounded-[1.25rem] bg-slate-50 p-4"><span class="font-semibold text-slate-900">Shipping:</span> {{ $order->shipping_name }}, {{ $order->shipping_phone }}</p>
                    <p class="rounded-[1.25rem] bg-slate-50 p-4 leading-7">{{ $order->shipping_address }}</p>
                    <p class="rounded-[1.25rem] bg-slate-50 p-4"><span class="font-semibold text-slate-900">Payment:</span> {{ $order->payment_method }}</p>
                </div>
            </div>
            <div class="mm-surface p-6 sm:p-8">
                <h2 class="text-xl font-bold text-slate-900">Update status</h2>
                <form method="post" action="{{ route('admin.orders.updateStatus', $order) }}" class="mt-5 space-y-4">@csrf
                    <div>
                        <label class="mm-label" for="status">Current status</label>
                        <select id="status" name="status" class="mm-input mt-2">
                            <option @selected($order->status === 'Pending')>Pending</option>
                            <option @selected($order->status === 'Approved')>Approved</option>
                            <option @selected($order->status === 'Declined')>Declined</option>
                            <option @selected($order->status === 'Delivered')>Delivered</option>
                        </select>
                    </div>
                    <button class="mm-btn-primary w-full">Update order</button>
                </form>
            </div>
        </div>

        <div class="mm-surface p-6 sm:p-8">
            <h2 class="text-xl font-bold text-slate-900">Items</h2>
            <div class="mt-5 space-y-3">
                @foreach($order->items as $item)
                    <div class="rounded-[1.25rem] border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-semibold text-slate-900">{{ $item->product->name }}</p>
                                <p class="mt-1 text-sm text-slate-500">Qty {{ $item->quantity }}</p>
                            </div>
                            <span class="font-bold text-slate-900">৳ {{ number_format($item->price) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6 rounded-[1.25rem] bg-slate-950 p-5 text-white">
                <div class="flex items-center justify-between text-sm text-slate-300">
                    <span>Total</span>
                    <span>Order summary</span>
                </div>
                <div class="mt-2 text-4xl font-black">৳ {{ number_format($order->total_amount) }}</div>
            </div>
        </div>
    </div>
@endsection
