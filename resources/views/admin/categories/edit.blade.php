@extends('layouts.admin')

@section('content')
    <div class="mx-auto max-w-3xl space-y-6">
        <div class="mm-surface p-6 sm:p-8">
            <p class="mm-subtitle">Catalog management</p>
            <h1 class="mt-2 mm-section-title">Edit category</h1>
            <p class="mm-section-copy">Update the category details.</p>
        </div>

        <div class="mm-surface p-6 sm:p-8">
            <form method="post" action="{{ route('admin.categories.update', $category) }}" class="space-y-5">@csrf @method('put')
                <div>
                    <label class="mm-label" for="category-name">Name</label>
                    <input id="category-name" name="name" value="{{ old('name', $category->name) }}" class="mm-input mt-2">
                    @if($errors->has('name'))<div class="mt-2 text-sm text-rose-600">{{ $errors->first('name') }}</div>@endif
                </div>

                <div>
                    <label class="mm-label" for="category-description">Description</label>
                    <textarea id="category-description" name="description" rows="5" class="mm-input mt-2">{{ old('description', $category->description) }}</textarea>
                    @if($errors->has('description'))<div class="mt-2 text-sm text-rose-600">{{ $errors->first('description') }}</div>@endif
                </div>

                <button class="mm-btn-primary">Update category</button>
            </form>
        </div>
    </div>
@endsection
