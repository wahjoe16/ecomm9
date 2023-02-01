@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <h3>Setting</h3><br><br>
    </div>
    @if ($slug == 'personal')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Personal Information</h4>
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

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <form class="" action="{{ url('admin/update-vendor-profile/personal') }}" method="post" name="updateAdminProfileForm" id="updateAdminProfileForm" enctype="multipart/form-data">@csrf
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="username">Vendor Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="vendor_name" class="form-control" id="vendor_name" value="{{ $vendorDetails['name'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="address">Address</label>
                            <div class="col-sm-9">
                                <input type="text" name="vendor_address" class="form-control" id="vendor_address" value="{{ $vendorDetails['address'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="address">City</label>
                            <div class="col-sm-9">
                                <input type="text" name="vendor_city" class="form-control" id="vendor_city" value="{{ $vendorDetails['city'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="address">State</label>
                            <div class="col-sm-9">
                                <input type="text" name="vendor_state" class="form-control" id="vendor_state" value="{{ $vendorDetails['state'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="address">Country</label>
                            <div class="col-sm-9">
                                <input type="text" name="vendor_country" class="form-control" id="vendor_country" value="{{ $vendorDetails['country'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="address">Pin Code</label>
                            <div class="col-sm-9">
                                <input type="text" name="vendor_pincode" class="form-control" id="vendor_pincode" value="{{ $vendorDetails['pincode'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="email">E-mail</label>
                            <div class="col-sm-9">
                                <input type="email" name="vendor_email" class="form-control" id="vendor_email" value="{{ $vendorDetails['email'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="mobile">Mobile Phone</label>
                            <div class="col-sm-9">
                                <input type="text" name="vendor_mobile" class="form-control" id="vendor_mobile" value="{{ $vendorDetails['mobile'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="image">Foto</label>
                            <div class="col-sm-9">
                                <input type="file" name="vendor_image" class="form-control" id="vendor_image">
                                @if(!empty(Auth::guard('admin')->user()->image))
                                <a target="_blank" href="{{ url('admin/images/foto/'.Auth::guard('admin')->user()->image) }}">Lihat Foto</a>
                                <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">

                            </div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route('dashboardAdmin') }}" class="btn btn-light">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @elseif ($slug == 'business')

    @elseif ($slug == 'bank')

    @endif

</div>

@endsection