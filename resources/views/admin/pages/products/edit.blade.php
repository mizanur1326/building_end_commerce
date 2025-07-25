@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('dashboard')

<div class="content-wrapper">
    <div class="page-heading">
        <h1 class="page-title">Edit Product</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('products.index') }}"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Product Edit</li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row" style="display: flex; justify-content: center;">
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Edit Product Form</div>
                    </div>
                    <div class="ibox-body">

                        {{-- Show success/error messages --}}
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        {{-- Existing Images with delete buttons --}}
                        <div class="form-group">
                            <label>Existing Images</label>
                            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                @foreach ($product->images as $img)
                                    <div style="position: relative; width: 100px; height: 100px; border: 1px solid #ddd; border-radius: 5px; overflow: hidden;">
                                        <img src="{{ asset('storage/' . $img->image) }}" alt="Product Image"
                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;">
                                        <form method="POST" action="{{ route('product-images.destroy', $img->id) }}"
                                            style="position: absolute; top: 5px; right: 5px;"
                                            onsubmit="return confirm('Are you sure you want to delete this image?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="
                                                background: rgba(255, 0, 0, 0.8);
                                                border: none;
                                                color: white;
                                                font-weight: bold;
                                                border-radius: 50%;
                                                width: 22px;
                                                height: 22px;
                                                line-height: 20px;
                                                cursor: pointer;
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                            " title="Delete Image">&times;</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Edit Product Form --}}
                        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input class="form-control" type="text" name="name" required value="{{ old('name', $product->name) }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="regular_price">Regular Price</label>
                                <input id="regular_price" class="form-control" type="number" step="0.01" name="regular_price" required value="{{ old('regular_price', $product->regular_price) }}">
                            </div>

                            <div class="form-group">
                                <label for="discount_percentage">Discount %</label>
                                <input id="discount_percentage" class="form-control" type="number" step="0.01" name="discount_percentage" min="0" max="100" value="{{ old('discount_percentage', $product->discount_percentage) }}">
                                @error('discount_percentage')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="discount_price">Discount Price (calculated)</label>
                                <input id="discount_price" class="form-control" type="number" step="0.01" readonly value="{{ $product->discount_price }}">
                            </div>

                            <div class="form-group">
                                <label for="discount_start_date">Discount Start Date</label>
                                <input type="date" name="discount_start_date" class="form-control" value="{{ old('discount_start_date', $product->discount_start_date) }}">
                            </div>

                            <div class="form-group">
                                <label for="discount_end_date">Discount End Date</label>
                                <input type="date" name="discount_end_date" class="form-control" value="{{ old('discount_end_date', $product->discount_end_date) }}">
                            </div>

                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" name="category_id">
                                    <option value="" disabled>Select a category</option>
                                    <option value="null" {{ is_null($product->category_id) ? 'selected' : '' }}>Uncategorized</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="brand_id">Brand</label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="">-- Select Brand --</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="stock_quantity">Stock Quantity</label>
                                <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" value="{{ old('stock_quantity', $product->stock_quantity) }}" min="0">
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            {{-- Upload new images --}}
                            <div class="form-group">
                                <label for="images">Add New Images (Max 4 total)</label>
                                <input type="file" class="form-control-file" name="images[]" multiple accept="image/*"
                                       onchange="if(this.files.length > 4){ alert('You can upload max 4 images'); this.value=''; }">
                                <small>Existing images are preserved unless you delete manually.</small>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update</button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.partials.footer')
</div>

@include('admin.partials.configPanel')

<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>

<script>
    function calculateDiscountPrice() {
        const regularPrice = parseFloat(document.getElementById('regular_price').value) || 0;
        const discountPercentInput = document.getElementById('discount_percentage').value;
        const discountPercent = parseFloat(discountPercentInput);

        if (!discountPercentInput || discountPercent <= 0) {
            document.getElementById('discount_price').value = regularPrice.toFixed(2);
        } else if (discountPercent > 0 && discountPercent <= 100) {
            const discountAmount = (regularPrice * discountPercent) / 100;
            const discountPrice = regularPrice - discountAmount;
            document.getElementById('discount_price').value = discountPrice.toFixed(2);
        } else {
            document.getElementById('discount_price').value = '';
        }
    }

    document.getElementById('regular_price').addEventListener('input', calculateDiscountPrice);
    document.getElementById('discount_percentage').addEventListener('input', calculateDiscountPrice);

    window.addEventListener('DOMContentLoaded', () => {
        calculateDiscountPrice();
    });
</script>

@endsection
