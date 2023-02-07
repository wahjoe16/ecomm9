@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sections</h4>

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
                                        <a href="{{ route('deleteSection', $s['id']) }}">
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