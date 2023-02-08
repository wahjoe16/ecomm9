@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sections</h4>
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
                    <div class="table-responsive">
                        <table id="sections" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name Section</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($section as $s )
                                <tr>
                                    <td>{{ $s['id'] }}</td>
                                    <td>{{ $s['name'] }}</td>
                                    <td>
                                        @if ($s['status']==1)
                                        <a href="javascript:void(0)" class="updateSectionStatus" id="section-{{ $s['id'] }}" section_id="{{ $s['id'] }}">
                                            <i class="mdi mdi-bookmark-check" style="font-size:25px" status="Active"></i>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="updateSectionStatus" id="section-{{ $s['id'] }}" section_id="{{ $s['id'] }}">
                                            <i class="mdi mdi-bookmark-outline" style="font-size:25px" status="Inactive"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('editSection', $s['id']) }}">
                                            <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                        </a>
                                        <!-- <a href="{{ route('deleteSection', $s['id']) }}" class="confirm-delete" title="Section">
                                            <i class="mdi mdi-delete" style="font-size: 25px;"></i>
                                        </a> -->
                                        <a href="javascript:void(0)" class="confirm-delete" module="Section" module_id="{{ $s['id'] }}" module_name="{{ $s['name'] }}">
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