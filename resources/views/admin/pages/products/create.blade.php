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
                                    <label for="price">Price (৳)</label>
                                    <input class="form-control" type="number" step="0.01" name="price" required
                                        placeholder="Enter price">
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" name="category_id">
                                        <option value="" disabled selected>Select a category</option>
                                        <option value="">Uncategorized</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="images">Product Images</label>
                                    <input type="file" class="form-control-file" name="images[]" multiple accept="image/*">
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

@endsection