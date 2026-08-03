@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        <div class="mm-surface p-6 sm:p-8">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="mm-subtitle">Inventory management</p>
                    <h1 class="mt-2 mm-section-title">Products</h1>
                    <p class="mm-section-copy">Manage inventory, pricing, and product details.</p>
                </div>
                <a href="{{ route('admin.products.create') }}" class="mm-btn-primary">New product</a>
            </div>
        </div>

        <div class="mm-table-shell">
            <table class="w-full min-w-[680px] divide-y divide-slate-200 text-left text-slate-700">
                <thead class="bg-slate-50 text-xs uppercase tracking-[0.2em] text-slate-500">
                    <tr>
                        <th class="px-6 py-4">Image</th>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Stock</th>
                        <th class="px-6 py-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach($products as $product)
                        <tr>
                            <td class="px-6 py-4"><img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-14 w-14 rounded-2xl object-cover"></td>
                            <td class="px-6 py-4 font-semibold text-slate-900">{{ $product->name }}</td>
                            <td class="px-6 py-4">{{ $product->category->name ?? '-' }}</td>
                            <td class="px-6 py-4">৳ {{ number_format($product->price) }}</td>
                            <td class="px-6 py-4">{{ $product->quantity }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="font-semibold text-brand-700 transition hover:text-brand-800">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="post">@csrf @method('delete')
                                        <button onclick="return confirm('Delete this product?')" class="font-semibold text-rose-600 transition hover:text-rose-700">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="rounded-[1.5rem] bg-white p-4 shadow-sm">{{ $products->links() }}</div>
    </div>
@endsection
