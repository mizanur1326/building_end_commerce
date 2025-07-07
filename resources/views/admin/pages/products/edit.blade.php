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
                            <form method="POST"
                                  action="{{ route('products.update', $product->id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input class="form-control" type="text" name="name"
                                           value="{{ $product->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" rows="3">{{ $product->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price (৳)</label>
                                    <input class="form-control" type="number" step="0.01" name="price"
                                           value="{{ $product->price }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" name="category_id">
                                        <option value="" disabled>Select a category</option>
                                        <option value="">Uncategorized</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Existing Images</label><br>
                                    @forelse ($product->images as $img)
                                        <div style="display:inline-block; margin:5px;">
                                            <img src="{{ asset('storage/' . $img->image) }}"
                                                 style="width: 80px; border-radius: 4px; border: 1px solid #ccc;">
                                        </div>
                                    @empty
                                        <p>No images uploaded.</p>
                                    @endforelse
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
