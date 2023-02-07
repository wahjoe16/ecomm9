@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <p class="card-description">
                        Add class <code>.table-striped</code>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Admin ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin )
                                <tr>
                                    <td>{{ $admin['id'] }}</td>
                                    <td>{{ $admin['name'] }}</td>
                                    <td>{{ $admin['type'] }}</td>
                                    <td>{{ $admin['mobile'] }}</td>
                                    <td>{{ $admin['email'] }}</td>
                                    <td class="py-1"><img src="{{ asset('admin/images/foto/'.$admin['image']) }}"></td>
                                    <td>
                                        @if ($admin['status']==1)
                                        <a href="javascript:void(0)" class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}">
                                            <i class="mdi mdi-bookmark-check" style="font-size:25px" status="Active"></i>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}">
                                            <i class="mdi mdi-bookmark-outline" style="font-size:25px" status="Inactive"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($admin['type'] == "vendor")
                                        <a href="{{ route('viewVendor', $admin['id']) }}">
                                            <i class="mdi mdi-account-search" style="font-size: 25px;"></i>
                                        </a>
                                        @endif
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