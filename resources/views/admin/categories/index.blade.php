@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        <div class="mm-surface p-6 sm:p-8">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="mm-subtitle">Catalog management</p>
                    <h1 class="mt-2 mm-section-title">Categories</h1>
                    <p class="mm-section-copy">Add, edit, or remove product categories.</p>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="mm-btn-primary">New category</a>
            </div>
        </div>

        <div class="mm-table-shell">
            <table class="w-full min-w-[680px] divide-y divide-slate-200 text-left text-slate-700">
                <thead class="bg-slate-50 text-xs uppercase tracking-[0.2em] text-slate-500">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Description</th>
                        <th class="px-6 py-4">Created</th>
                        <th class="px-6 py-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach($categories as $category)
                        <tr>
                            <td class="px-6 py-4 font-semibold text-slate-900">{{ $category->id }}</td>
                            <td class="px-6 py-4">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $category->description }}</td>
                            <td class="px-6 py-4">{{ $category->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="font-semibold text-brand-700 transition hover:text-brand-800">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="post">@csrf @method('delete')
                                        <button onclick="return confirm('Delete this category?')" class="font-semibold text-rose-600 transition hover:text-rose-700">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="rounded-[1.5rem] bg-white p-4 shadow-sm">{{ $categories->links() }}</div>
    </div>
@endsection
