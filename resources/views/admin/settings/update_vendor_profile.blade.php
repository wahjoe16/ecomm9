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
                                <select class="form-control" name="vendor_country" id="vendor_country" style="color:#495057;">
                                    <option value="">Pilih negara</option>
                                    @foreach ($countries as $c)
                                    <option value="{{ $c['country_name'] }}" @if ($c['country_name']==$vendorDetails['country']) selected @endif>{{ $c['country_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class=" form-group row">
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Business Information</h4>
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

                    <form class="" action="{{ url('admin/update-vendor-profile/business') }}" method="post" name="updateAdminProfileForm" id="updateAdminProfileForm" enctype="multipart/form-data">@csrf
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="shop_name">Shop Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="shop_name" class="form-control" id="shop_name" value="{{ $vendorDetails['shop_name'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="shop_address">Shop Address</label>
                            <div class="col-sm-9">
                                <input type="text" name="shop_address" class="form-control" id="shop_address" value="{{ $vendorDetails['shop_address'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="shop_city">Shop City</label>
                            <div class="col-sm-9">
                                <input type="text" name="shop_city" class="form-control" id="shop_city" value="{{ $vendorDetails['shop_city'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="shop_state">Shop State</label>
                            <div class="col-sm-9">
                                <input type="text" name="shop_state" class="form-control" id="shop_state" value="{{ $vendorDetails['shop_state'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="shop_country">Shop Country</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="shop_country" id="shop_country" style="color:#495057;">
                                    <option value="">Pilih Negara</option>
                                    @foreach ($countries as $c )
                                    <option value="{{ $c['country_name'] }}" @if ($c['country_name']==$vendorDetails['shop_country']) selected @endif>{{ $c['country_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="shop_pincode">Pincode</label>
                            <div class="col-sm-9">
                                <input type="text" name="shop_pincode" class="form-control" id="shop_pincode" value="{{ $vendorDetails['shop_pincode'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="shop_mobile">Mobile Phone</label>
                            <div class="col-sm-9">
                                <input type="text" name="shop_mobile" class="form-control" id="shop_mobile" value="{{ $vendorDetails['shop_mobile'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="shop_website">Shop Website</label>
                            <div class="col-sm-9">
                                <input type="text" name="shop_website" class="form-control" id="shop_website" value="{{ $vendorDetails['shop_website'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="email">E-mail</label>
                            <div class="col-sm-9">
                                <input type="email" name="shop_email" class="form-control" id="shop_email" value="{{ $vendorDetails['shop_email'] }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="address_proof">Addres Proof</label>
                            <div class="col-sm-9">
                                <select name="address_proof" id="address_proof" class="form-control">
                                    <option value="Passport">Passport</option>
                                    <option value="Voting Card">Voting Card</option>
                                    <option value="Pan">Pan</option>
                                    <option value="Driving License">Driving License</option>
                                    <option value="Aadhar Card">Aadhar Card</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="image">Foto</label>
                            <div class="col-sm-9">
                                <input type="file" name="address_proof_image" class="form-control" id="address_proof_image">
                                @if(!empty(Auth::guard('admin')->user()->image))
                                <a target="_blank" href="{{ url('admin/images/proofs/'.$vendorDetails['address_proof_image']) }}">Lihat Foto</a>
                                <input type="hidden" name="current_vendor_address_proof_image" value="{{ Auth::guard('admin')->user()->address_proof_image }}">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="mobile">Business License Number</label>
                            <div class="col-sm-9">
                                <input type="text" name="business_license_number" class="form-control" id="business_license_number" value="{{ $vendorDetails['business_license_number'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="mobile">GST Number</label>
                            <div class="col-sm-9">
                                <input type="text" name="gst_number" class="form-control" id="gst_number" value="{{ $vendorDetails['gst_number'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="mobile">PAN Number</label>
                            <div class="col-sm-9">
                                <input type="text" name="pan_number" class="form-control" id="pan_number" value="{{ $vendorDetails['pan_number'] }}">
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
    @elseif ($slug == 'bank')
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

                    <form class="" action="{{ url('admin/update-vendor-profile/bank') }}" method="post" name="updateAdminProfileForm" id="updateAdminProfileForm">@csrf
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="username">Account Holder Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="account_holder_name" class="form-control" id="account_holder_name" value="{{ $vendorDetails['account_holder_name'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="address">Bank Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="bank_name" class="form-control" id="bank_name" value="{{ $vendorDetails['bank_name'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="address">Account Number</label>
                            <div class="col-sm-9">
                                <input type="text" name="account_number" class="form-control" id="account_number" value="{{ $vendorDetails['account_number'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="address">Bank IFSC Code</label>
                            <div class="col-sm-9">
                                <input type="text" name="bank_ifsc_code" class="form-control" id="bank_ifsc_code" value="{{ $vendorDetails['bank_ifsc_code'] }}">
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
    @endif
</div>

@endsection