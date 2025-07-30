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
                        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Regular Price</label>
                                <input type="number" step="0.01" name="regular_price" class="form-control" id="regular_price"
                                    value="{{ old('regular_price', $product->regular_price) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Discount %</label>
                                <input type="number" step="0.01" min="0" max="100" name="discount_percentage"
                                    id="discount_percentage" class="form-control"
                                    value="{{ old('discount_percentage', $product->discount_percentage) }}">
                            </div>

                            <div class="form-group">
                                <label>Discount Price (calculated)</label>
                                <input type="number" step="0.01" readonly id="discount_price" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Discount Start Date</label>
                                <input type="date" name="discount_start_date" class="form-control"
                                    value="{{ old('discount_start_date', $product->discount_start_date) }}">
                            </div>

                            <div class="form-group">
                                <label>Discount End Date</label>
                                <input type="date" name="discount_end_date" class="form-control"
                                    value="{{ old('discount_end_date', $product->discount_end_date) }}">
                            </div>

                            <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Brand</label>
                                <select name="brand_id" class="form-control">
                                    <option value="">-- Select Brand --</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Stock Quantity</label>
                                <input type="number" name="stock_quantity" class="form-control"
                                    value="{{ old('stock_quantity', $product->stock_quantity) }}">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Product Images (You can re-upload or leave empty)</label>
                                <input type="file" class="form-control-file" name="images[]" multiple accept="image/*"
                                    onchange="if(this.files.length > 4){ alert('You can upload max 4 images'); this.value=''; }">
                                <div class="mt-3">
                                    @foreach ($product->images as $image)
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="Product Image" class="mr-2" width="80" height="80">
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
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
        const discountPercent = parseFloat(document.getElementById('discount_percentage').value) || 0;

        const discountAmount = (regularPrice * discountPercent) / 100;
        const discountPrice = regularPrice - discountAmount;

        document.getElementById('discount_price').value = discountPrice.toFixed(2);
    }

    document.getElementById('regular_price').addEventListener('input', calculateDiscountPrice);
    document.getElementById('discount_percentage').addEventListener('input', calculateDiscountPrice);

    // Trigger calculation on load
    window.addEventListener('DOMContentLoaded', calculateDiscountPrice);
</script>

@endsection
