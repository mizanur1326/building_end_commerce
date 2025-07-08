@extends('admin.layouts.app')

@section('title', 'Add Product')

@section('dashboard')

    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-heading">
            <h1 class="page-title">Add Product</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('products.index') }}"><i class="la la-home font-20"></i></a>
                </li>
                <li class="breadcrumb-item">Product Create</li>
            </ol>
        </div>

        <div class="page-content fade-in-up">
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-md-6">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Add Product Form</div>
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
                            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input class="form-control" type="text" name="name" required
                                        placeholder="Enter product name">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" rows="3"
                                        placeholder="Enter product description (optional)"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="regular_price">Regular Price</label>
                                    <input id="regular_price" class="form-control" type="number" step="0.01"
                                        name="regular_price" required placeholder="Enter Regular Price">
                                </div>

                                <div class="form-group">
                                    <label for="discount_percentage">Discount %</label>
                                    <input id="discount_percentage" class="form-control" type="number"
                                        name="discount_percentage" step="0.01" min="0" max="100"
                                        value="{{ old('discount_percentage') }}"
                                        placeholder="Enter discount percentage (e.g., 10)">
                                    @error('discount_percentage')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="discount_price">Discount Price (calculated)</label>
                                    <input id="discount_price" class="form-control" type="number" step="0.01" readonly
                                        placeholder="Discount price will be calculated automatically">
                                </div>

                                <div class="form-group">
                                    <label for="discount_start_date">Discount Start Date</label>
                                    <input type="date" name="discount_start_date" class="form-control"
                                        value="{{ old('discount_start_date') }}">
                                </div>

                                <div class="form-group">
                                    <label for="discount_end_date">Discount End Date</label>
                                    <input type="date" name="discount_end_date" class="form-control"
                                        value="{{ old('discount_end_date') }}">
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" name="category_id">
                                        <option value="" disabled {{ old('category_id') === null ? 'selected' : '' }}>Select a
                                            category</option>
                                        <option value="null" {{ old('category_id') === 'null' ? 'selected' : '' }}>
                                            Uncategorized</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="brand_id">Brand</label>
                                    <select name="brand_id" id="brand_id" class="form-control">
                                        <option value="">-- Select Brand --</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label for="stock_quantity">Stock Quantity</label>
                                    <input type="number" name="stock_quantity" id="stock_quantity" class="form-control"
                                        value="{{ old('stock_quantity', 0) }}" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="images">Product Images</label>
                                    <input type="file" class="form-control-file" name="images[]" multiple accept="image/*"
                                        onchange="if(this.files.length > 4){ alert('You can upload max 4 images'); this.value=''; }">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
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

    <script>
        function calculateDiscountPrice() {
            const regularPrice = parseFloat(document.getElementById('regular_price').value) || 0;
            const discountPercentInput = document.getElementById('discount_percentage').value;
            const discountPercent = parseFloat(discountPercentInput);

            if (!discountPercentInput || discountPercent <= 0) {
                // If discount % is empty, zero, or invalid, discount price = regular price
                document.getElementById('discount_price').value = regularPrice.toFixed(2);
            } else if (discountPercent > 0 && discountPercent <= 100) {
                const discountAmount = (regularPrice * discountPercent) / 100;
                const discountPrice = regularPrice - discountAmount;
                document.getElementById('discount_price').value = discountPrice.toFixed(2);
            } else {
                // Invalid discount %, clear discount price
                document.getElementById('discount_price').value = '';
            }
        }

        document.getElementById('regular_price').addEventListener('input', calculateDiscountPrice);
        document.getElementById('discount_percentage').addEventListener('input', calculateDiscountPrice);

        // Initialize on page load
        window.addEventListener('DOMContentLoaded', () => {
            calculateDiscountPrice();
        });
    </script>


@endsection