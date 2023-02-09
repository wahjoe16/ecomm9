@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Categories</h4>
                    <a href="{{ route('addEditCategory') }}" class="btn btn-success btn-block" style="max-width: 150px; float: right; display:inline-block;">
                        add Category
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
                        <table id="category" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name Category</th>
                                    <th>Section</th>
                                    <th>Parent Category</th>
                                    <th>Url</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $c )
                                @if (isset($c['parentcategory']['category_name']) && !empty($c['parentcategory']['category_name']))
                                @php $parent_category = $c['parentcategory']['category_name']; @endphp
                                @else
                                @php $parent_category = "Root"; @endphp
                                @endif
                                <tr>
                                    <td>{{ $c['id'] }}</td>
                                    <td>{{ $c['category_name'] }}</td>
                                    <td>{{ $c['section']['name'] }}</td>
                                    <td>{{ $parent_category }}</td>
                                    <td>{{ $c['url'] }}</td>
                                    <td>
                                        @if ($c['status']==1)
                                        <a href="javascript:void(0)" class="updateCategoryStatus" id="category-{{ $c['id'] }}" category_id="{{ $c['id'] }}">
                                            <i class="mdi mdi-bookmark-check" style="font-size:25px" status="Active"></i>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="updateCategoryStatus" id="category-{{ $c['id'] }}" category_id="{{ $c['id'] }}">
                                            <i class="mdi mdi-bookmark-outline" style="font-size:25px" status="Inactive"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('addEditCategory', $c['id']) }}">
                                            <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                        </a>
                                        <!-- <a href="{{ route('deleteCategory', $c['id']) }}" class="confirm-delete" title="Category">
                                            <i class="mdi mdi-delete" style="font-size: 25px;"></i>
                                        </a> -->
                                        <a href="javascript:void(0)" class="confirm-delete" module="Category" module_id="{{ $c['id'] }}" module_name="{{ $c['category_name'] }}">
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