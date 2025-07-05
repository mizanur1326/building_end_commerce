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
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="ibox">
                                <div class="ibox-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th width="50px"></th>
                                                    <th>Categories</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($categories as $category)
                                                    <tr>
                                                        <td>
                                                            <label class="ui-checkbox">
                                                                <input type="checkbox">
                                                                <span class="input-span"></span>
                                                            </label>
                                                        </td>
                                                        <td>{{ $category->name }}</td>
                                                        <td>
                                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                                class="btn btn-default btn-xs m-r-5" data-toggle="tooltip"
                                                                title="Edit">
                                                                <i class="fa fa-pencil font-14"></i>
                                                            </a>
                                                            <form action="{{ route('categories.destroy', $category->id) }}"
                                                                method="POST" style="display:inline;"
                                                                onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-default btn-xs"
                                                                    data-toggle="tooltip" title="Delete">
                                                                    <i class="fa fa-trash font-14"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3">No categories found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
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