@extends('admin.layouts.app')

@section('title', 'Products')

@section('dashboard')

<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Products</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') ?? '#' }}"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Product List</li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row" style="display: flex; justify-content: center;">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Show Products</div>
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
                        <div class="alert alert-success" role="alert" style="margin: 15px 0;">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align: middle;" width="50px">Checkbox</th>
                                                <th style="vertical-align: middle;">Product</th>
                                                <th style="vertical-align: middle;">Slug</th>
                                                <th style="vertical-align: middle;">Category</th>
                                                <th style="vertical-align: middle;">Brand</th>
                                                <th style="vertical-align: middle;">Price (৳)</th>
                                                <th style="vertical-align: middle;">Discount %</th>
                                                <th style="vertical-align: middle;">Discount Price (৳)</th>
                                                <th style="vertical-align: middle;">Discount Start Date</th>
                                                <th style="vertical-align: middle;">Discount End Date</th>
                                                <th style="vertical-align: middle;">Stock Quantity</th>
                                                <th style="vertical-align: middle;">Status</th>
                                                <th style="vertical-align: middle;">Photo</th>
                                                <th style="vertical-align: middle;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($products as $product)
                                            <tr>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    <label class="ui-checkbox">
                                                        <input type="checkbox">
                                                        <span class="input-span"></span>
                                                    </label>
                                                </td>

                                                <td style="vertical-align: middle; text-align: center;">
                                                    {{ $product->name }}
                                                </td>


                                                <td style="vertical-align: middle; text-align: center;">
                                                    {{ $product->slug }}
                                                </td>

                                                <td style="vertical-align: middle; text-align: center;">
                                                    {{ $product->category->name ?? '—' }}
                                                </td>

                                                <td style="vertical-align: middle; text-align: center;">
                                                    {{ $product->brand->name ?? '—' }}
                                                </td>


                                                <td style="vertical-align: middle; text-align: center;">
                                                    {{ number_format($product->regular_price, 2) }}
                                                </td>

                                                <td style="vertical-align: middle; text-align: center;">
                                                    {{ $product->discount_percentage !== null ? number_format($product->discount_percentage, 2) . '%' : '—' }}
                                                </td>

                                                <td style="vertical-align: middle; text-align: center;">
                                                    {{ $product->discount_price ? number_format($product->discount_price, 2) : '—' }}
                                                </td>

                                                <td style="vertical-align: middle; text-align: center;">
                                                    {{ $product->discount_start_date ?? '—' }}
                                                </td>

                                                <td style="vertical-align: middle; text-align: center;">
                                                    {{ $product->discount_end_date ?? '—' }}
                                                </td>

                                                <td style="vertical-align: middle; text-align: center;">
                                                    {{ $product->stock_quantity }}
                                                </td>

                                                <td style="vertical-align: middle; text-align: center;">
                                                    @if($product->status === 'active')
                                                    <span class="badge badge-success">Active</span>
                                                    @else
                                                    <span class="badge badge-secondary">Inactive</span>
                                                    @endif
                                                </td>

                                                <td style="vertical-align: middle; text-align: center;">
                                                    @if ($product->images->isNotEmpty())
                                                    <div
                                                        style="display: inline-flex; gap: 5px; flex-wrap: wrap; justify-content: center; align-items: center;">
                                                        @foreach ($product->images as $image)
                                                        <img src="{{ asset('storage/' . $image->image) }}" alt="Image"
                                                            style="width: 80px; height: 80px; border-radius: 5px; object-fit: cover;">
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </td>

                                                <td style="vertical-align: middle; text-align: center;">
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-default btn-xs m-r-5" data-toggle="tooltip"
                                                        title="Edit">
                                                        <i class="fa fa-pencil font-14"></i>
                                                    </a>

                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                        method="POST" style="display:inline;"
                                                        onsubmit="return confirm('Are you sure you want to delete this product?');">
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
                                                <td colspan="12">No products found.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>


                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.ibox-body -->
                </div> <!-- /.ibox -->
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