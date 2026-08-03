@extends('layouts.admin')

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
            <div>
                <p class="mm-subtitle">Order management</p>
                <h1 class="mt-2 mm-section-title">Orders</h1>
                <p class="mm-section-copy">Review customer orders and update status.</p>
            </div>
        </div>

        <div class="mm-table-shell">
            <table class="w-full min-w-[680px] divide-y divide-slate-200 text-left text-slate-700">
                <thead class="bg-slate-50 text-xs uppercase tracking-[0.2em] text-slate-500">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach($orders as $order)
                        <tr>
                            <td class="px-6 py-4 font-semibold text-slate-900">{{ $order->id }}</td>
                            <td class="px-6 py-4">{{ $order->user->name }}</td>
                            <td class="px-6 py-4">৳ {{ number_format($order->total_amount) }}</td>
                            <td class="px-6 py-4"><span class="mm-badge ring-1 {{ $statusStyles($order->status) }}">{{ $order->status }}</span></td>
                            <td class="px-6 py-4">{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4"><a href="{{ route('admin.orders.show', $order) }}" class="font-semibold text-brand-700 transition hover:text-brand-800">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="rounded-[1.5rem] bg-white p-4 shadow-sm">{{ $orders->links() }}</div>
    </div>
@endsection
