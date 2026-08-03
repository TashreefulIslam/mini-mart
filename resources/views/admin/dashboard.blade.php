@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        <div class="mm-surface p-6 sm:p-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="mm-subtitle">Admin dashboard</p>
                    <h1 class="mt-2 mm-section-title">Overview of store activity</h1>
                    <p class="mm-section-copy">Quick access to the core management screens without changing backend behavior.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.products.index') }}" class="mm-btn-primary">Products</a>
                    <a href="{{ route('admin.categories.index') }}" class="mm-btn-secondary">Categories</a>
                    <a href="{{ route('admin.users.index') }}" class="mm-btn-secondary">Users</a>
                    <a href="{{ route('admin.orders.index') }}" class="mm-btn-secondary">Orders</a>
                </div>
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div class="mm-card p-6">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Products</p>
                <p class="mt-4 text-4xl font-black text-slate-900">{{ \App\Models\Product::count() }}</p>
            </div>
            <div class="mm-card p-6">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Categories</p>
                <p class="mt-4 text-4xl font-black text-slate-900">{{ \App\Models\Category::count() }}</p>
            </div>
            <div class="mm-card p-6">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Customers</p>
                <p class="mt-4 text-4xl font-black text-slate-900">{{ \App\Models\User::where('role', 'customer')->count() }}</p>
            </div>
        </div>
    </div>
@endsection
