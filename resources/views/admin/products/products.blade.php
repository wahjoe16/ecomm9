@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Products</h4>
                    <a href="{{ route('addEditProduct') }}" class="btn btn-success btn-block" style="max-width: 150px; float: right; display:inline-block;">
                        add Products
                    </a>
                    @if(Session::has('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Error: </strong>{{ Session::get('error_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>Sukses: </strong>{{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="table-responsive pt-3">
                        <table id="products" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Section</th>
                                    <th>Category</th>
                                    <th>Added By</th>
                                    <th>Brand</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $p)
                                <tr>
                                    <td>{{ $p['id'] }}</td>
                                    <td>{{ $p['product_name'] }}</td>
                                    <td>{{ $p['product_code'] }}</td>
                                    <td>{{ $p['section']['name'] }}</td>
                                    <td>{{ $p['category']['category_name'] }}</td>
                                    <td>
                                        @if($p['admin_type']=="vendor")
                                        <a href="{{ route('viewVendor', $p['admin_id']) }}">{{ ucfirst($p['admin_type']) }}</a>
                                        @else
                                        {{ ucfirst($p['admin_type']) }}
                                        @endif
                                    </td>
                                    <td>{{ $p['brand']['name'] }}</td>
                                    <td>
                                        @if ($p['status']==1)
                                        <a href="javascript:void(0)" class="updateProductStatus" id="product-{{ $p['id'] }}" product_id="{{ $p['id'] }}">
                                            <i class="mdi mdi-bookmark-check" style="font-size:25px" status="Active"></i>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="updateProductStatus" id="product-{{ $p['id'] }}" product_id="{{ $p['id'] }}">
                                            <i class="mdi mdi-bookmark-outline" style="font-size:25px" status="Inactive"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('addEditProduct', $p['id']) }}">
                                            <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                        </a>
                                        <!-- <a href="{{ route('deleteCategory', $p['id']) }}" class="confirm-delete" title="Category">
                                            <i class="mdi mdi-delete" style="font-size: 25px;"></i>
                                        </a> -->
                                        <a href="javascript:void(0)" class="confirm-delete" module="product" module_id="{{ $p['id'] }}" module_name="{{ $p['product_name'] }}">
                                            <i class="mdi mdi-delete" style="font-size: 25px;"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection