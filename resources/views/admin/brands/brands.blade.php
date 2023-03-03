@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Brands</h4>
                    <a href="{{ route('addEditBrand') }}" class="btn btn-success btn-block" style="max-width: 150px; float: right; display:inline-block;">add Brand</a>
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
                        <table id="sections" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Brand Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $b )
                                <tr>
                                    <td>{{ $b['id'] }}</td>
                                    <td>{{ $b['name'] }}</td>
                                    <td>
                                        @if ($b['status']==1)
                                        <a href="javascript:void(0)" class="updateBrandStatus" id="brand-{{ $b['id'] }}" brand_id="{{ $b['id'] }}">
                                            <i class="mdi mdi-bookmark-check" style="font-size:25px" status="Active"></i>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="updateBrandStatus" id="brand-{{ $b['id'] }}" brand_id="{{ $b['id'] }}">
                                            <i class="mdi mdi-bookmark-outline" style="font-size:25px" status="Inactive"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('addEditBrand', $b['id']) }}">
                                            <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                        </a>
                                        <!-- <a href="{{ route('deleteSection', $b['id']) }}" class="confirm-delete" title="Section">
                                            <i class="mdi mdi-delete" style="font-size: 25px;"></i>
                                        </a> -->
                                        <a href="javascript:void(0)" class="confirm-delete" module="brand" module_id="{{ $b['id'] }}" module_name="{{ $b['name'] }}">
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