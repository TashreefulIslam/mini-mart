@extends('layouts.app')

@section('content')
    @php
        $statusStyles = fn ($status) => match (strtolower($status)) {
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
                    <p class="mm-subtitle">Order history</p>
                    <h1 class="mt-2 mm-section-title">Track your purchase history</h1>
                    <p class="mm-section-copy">Review order status, totals, and details in a cleaner browsing experience.</p>
                </div>
                <a href="{{ route('products.index') }}" class="mm-btn-secondary">Continue shopping</a>
            </div>
        </div>

        <div class="mm-surface overflow-hidden">
            <div class="hidden md:block">
                <table class="w-full divide-y divide-slate-200 text-left text-slate-700">
                    <thead class="bg-slate-50 text-xs uppercase tracking-[0.2em] text-slate-500">
                        <tr>
                            <th class="px-6 py-4">Order</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($orders as $order)
                            <tr>
                                <td class="px-6 py-4 font-semibold text-slate-900">#{{ $order->id }}</td>
                                <td class="px-6 py-4">৳ {{ number_format($order->total_amount) }}</td>
                                <td class="px-6 py-4"><span class="mm-badge ring-1 {{ $statusStyles($order->status) }}">{{ $order->status }}</span></td>
                                <td class="px-6 py-4">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4"><a href="{{ route('customer.orders.show', $order) }}" class="font-semibold text-brand-700 transition hover:text-brand-800">View</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-500">You have not placed any orders yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="space-y-3 p-4 md:hidden">
                @forelse($orders as $order)
                    <div class="rounded-[1.25rem] border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="font-semibold text-slate-900">Order #{{ $order->id }}</p>
                                <p class="mt-1 text-sm text-slate-500">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                            <span class="mm-badge ring-1 {{ $statusStyles($order->status) }}">{{ $order->status }}</span>
                        </div>
                        <div class="mt-4 flex items-center justify-between text-sm">
                            <span class="text-slate-500">Total</span>
                            <span class="font-semibold text-slate-900">৳ {{ number_format($order->total_amount) }}</span>
                        </div>
                        <a href="{{ route('customer.orders.show', $order) }}" class="mt-4 inline-flex font-semibold text-brand-700 transition hover:text-brand-800">View details</a>
                    </div>
                @empty
                    <div class="rounded-[1.25rem] border border-dashed border-slate-300 p-6 text-center text-slate-500">You have not placed any orders yet.</div>
                @endforelse
            </div>
        </div>

        <div class="rounded-[1.5rem] bg-white p-4 shadow-sm">{{ $orders->links() }}</div>
    </div>
@endsection
