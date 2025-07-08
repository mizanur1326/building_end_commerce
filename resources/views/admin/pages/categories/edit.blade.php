@extends('admin.layouts.app')

@section('title', 'Add Categories')

@section('dashboard')

    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-heading">
            <h1 class="page-title">Basic Form</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html"><i class="la la-home font-20"></i></a>
                </li>
                <li class="breadcrumb-item">Basic Form</li>
            </ol>
        </div>
        <div class="page-content fade-in-up">
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-md-8">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Show Categories Form</div>
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

                            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                                @csrf
                                @method('PUT')

                                @php
                                    function renderCategoryOptions($categories, $prefix = '', $selected = null)
                                    {
                                        foreach ($categories as $categoryOption) {
                                            $isSelected = old('parent_id', $selected) == $categoryOption->id ? 'selected' : '';
                                            echo "<option value='{$categoryOption->id}' {$isSelected}>{$prefix}{$categoryOption->name}</option>";

                                            if ($categoryOption->children && $categoryOption->children->count()) {
                                                renderCategoryOptions($categoryOption->children, $prefix . '-- ', $selected);
                                            }
                                        }
                                    }
                                @endphp

                                <div class="form-group">
                                    <label for="parent_id">Parent Category (Optional)</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="">-- No Parent (Root Category) --</option>
                                        @php renderCategoryOptions($categories, '', $category->parent_id); @endphp
                                    </select>
                                </div>


                                <div class="form-group">
                                    <input class="form-control" type="text" name="name"
                                        value="{{ old('name', $category->name) }}" required placeholder="Category Name">

                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
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