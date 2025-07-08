@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('dashboard')

    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
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
                            <div class="ibox-tools">
                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item">option 1</a>
                                    <a class="dropdown-item">option 2</a>
                                </div>
                            </div>
                        </div>

                        <div class="ibox-body">

                            @if(session('success'))
                                <div class="alert alert-success" role="alert" style="margin-bottom: 15px;">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger" role="alert" style="margin-bottom: 15px;">
                                    {{ session('error') }}
                                </div>
                            @endif


                            <!-- Existing Images with Delete Buttons -->
                            <div class="form-group">
                                <label>Existing Images</label>
                                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    @foreach ($product->images as $img)
                                        <div style="position: relative; width: 100px; height: 100px; border: 1px solid #ddd; border-radius: 5px; overflow: hidden;">
                                            <img src="{{ asset('storage/' . $img->image) }}" alt="Product Image"
                                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; display: block;">

                                            <form method="POST" action="{{ route('product-images.destroy', $img->id) }}"
                                                style="position: absolute; top: 5px; right: 5px; margin: 0; padding: 0;"
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
                                                    padding: 0;
                                                    display: flex;
                                                    align-items: center;
                                                    justify-content: center;
                                                    " title="Delete Image">&times;</button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Main product update form STARTS HERE -->
                            <form method="POST"
                                action="{{ route('products.update', $product->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Validation errors --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger" role="alert" style="margin-bottom: 15px;">
                                        <ul style="margin: 0; padding-left: 20px;">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input class="form-control" type="text" name="name"
                                        value="{{ old('name', $product->name) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price (৳)</label>
                                    <input class="form-control" type="number" step="0.01" name="price"
                                        value="{{ old('price', $product->price) }}" required>
                                </div>

                                <!-- New Fields Added Here -->
                                <div class="form-group">
                                    <label for="discount_price">Discount Price (৳)</label>
                                    <input class="form-control" type="number" step="0.01" name="discount_price"
                                        value="{{ old('discount_price', $product->discount_price) }}">
                                </div>

                                <div class="form-group">
                                    <label for="stock_quantity">Stock Quantity</label>
                                    <input class="form-control" type="number" min="0" name="stock_quantity"
                                        value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="active" {{ old('status', $product->status) === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $product->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <!-- End New Fields -->

                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" name="category_id">
                                        <option value="" disabled {{ old('category_id', $product->category_id) === null ? 'selected' : '' }}>Select a category</option>
                                        <option value="" {{ old('category_id', $product->category_id) === null ? 'selected' : '' }}>Uncategorized</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="images">Add New Images</label>
                                    <input type="file" class="form-control-file" name="images[]" multiple accept="image/*">
                                    <small class="form-text text-muted">You can upload new images; old ones will remain.</small>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>

                            </form>
                            <!-- Main form ends -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT-->

        @include('admin.partials.footer')

    </div>

    @include('admin.partials.configPanel')

    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->

@endsection
