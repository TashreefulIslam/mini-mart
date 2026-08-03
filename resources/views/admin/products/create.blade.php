@extends('layouts.admin')

@section('content')
    <div class="mx-auto max-w-4xl space-y-6">
        <div class="mm-surface p-6 sm:p-8">
            <p class="mm-subtitle">Inventory management</p>
            <h1 class="mt-2 mm-section-title">Create product</h1>
            <p class="mm-section-copy">Add a new item to your store inventory.</p>
        </div>

        <div class="mm-surface p-6 sm:p-8">
            <form method="post" action="{{ route('admin.products.store') }}" class="space-y-5">@csrf
                <div>
                    <label class="mm-label" for="product-name">Product name</label>
                    <input id="product-name" name="name" value="{{ old('name') }}" class="mm-input mt-2">
                    @if($errors->has('name'))<div class="mt-2 text-sm text-rose-600">{{ $errors->first('name') }}</div>@endif
                </div>

                <div>
                    <label class="mm-label" for="product-category">Category</label>
                    <select id="product-category" name="category_id" class="mm-input mt-2">
                        <option value="">Select</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category_id'))<div class="mt-2 text-sm text-rose-600">{{ $errors->first('category_id') }}</div>@endif
                </div>

                <div>
                    <label class="mm-label" for="product-description">Description</label>
                    <textarea id="product-description" name="description" rows="5" class="mm-input mt-2">{{ old('description') }}</textarea>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mm-label" for="product-price">Price</label>
                        <input id="product-price" name="price" value="{{ old('price') }}" class="mm-input mt-2">
                        @if($errors->has('price'))<div class="mt-2 text-sm text-rose-600">{{ $errors->first('price') }}</div>@endif
                    </div>
                    <div>
                        <label class="mm-label" for="product-quantity">Quantity</label>
                        <input id="product-quantity" name="quantity" value="{{ old('quantity', 0) }}" class="mm-input mt-2">
                        @if($errors->has('quantity'))<div class="mt-2 text-sm text-rose-600">{{ $errors->first('quantity') }}</div>@endif
                    </div>
                </div>

                <div>
                    <label class="mm-label" for="image_url">Image URL</label>
                    <input id="image_url" name="image_url" value="{{ old('image_url') }}" class="mm-input mt-2">
                    @if($errors->has('image_url'))<div class="mt-2 text-sm text-rose-600">{{ $errors->first('image_url') }}</div>@endif
                    <img id="preview" src="" class="mt-4 hidden h-44 w-full rounded-3xl object-cover">
                </div>

                <button class="mm-btn-primary">Create product</button>
            </form>
        </div>
    </div>

    <script>
        const imgInput = document.getElementById('image_url');
        const preview = document.getElementById('preview');
        imgInput.addEventListener('input', () => {
            const url = imgInput.value.trim();
            if (!url) { preview.classList.add('hidden'); preview.src=''; return; }
            preview.src = url;
            preview.classList.remove('hidden');
        });
    </script>
@endsection
