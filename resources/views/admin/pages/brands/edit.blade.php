@extends('admin.layouts.app')

@section('title', 'Edit Brand')

@section('dashboard')

    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-heading">
            <h1 class="page-title">Edit Brand</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"><i class="la la-home font-20"></i></a>
                </li>
                <li class="breadcrumb-item">Edit Brand</li>
            </ol>
        </div>

        <div class="page-content fade-in-up">
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-md-6">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Edit Brand Form</div>
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
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('brands.update', $brand->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name">Brand Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $brand->name) }}" placeholder="Enter Brand Name" required>

                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Brand</button>
                                </div>
                            </form>
                        </div> <!-- /.ibox-body -->
                    </div> <!-- /.ibox -->
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT -->

        @include('admin.partials.footer')
    </div>

    @include('admin.partials.configPanel')

    <!-- BEGIN PAGE BACKDROPS -->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGE BACKDROPS -->

@endsection
