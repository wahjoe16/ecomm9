@extends('admin.layout.layout')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <h4 class="card-title">Foto Profile</h4>
                    <div>
                        <img src="{{ asset('admin/images/foto/'.$vendorDetail['image']) }}" height="370px" alt="user">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Bank Info</h4>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Name</div>
                            <b>{{ $vendorDetail['vendor_bank']['account_holder_name']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Address</div>
                            <b>{{ $vendorDetail['vendor_bank']['bank_name'] }}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">City</div>
                            <b>{{ $vendorDetail['vendor_bank']['account_number']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">State</div>
                            <b>{{ $vendorDetail['vendor_bank']['bank_ifsc_code']}}</b>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6 offset-md-2">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Personal Info</h4>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Name</div>
                            <b>{{ $vendorDetail['vendor_personal']['name']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Address</div>
                            <b>{{ $vendorDetail['vendor_personal']['address'] }}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">City</div>
                            <b>{{ $vendorDetail['vendor_personal']['city']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">State</div>
                            <b>{{ $vendorDetail['vendor_personal']['state']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Country</div>
                            <b>{{ $vendorDetail['vendor_personal']['country']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Pin Code</div>
                            <b>{{ $vendorDetail['vendor_personal']['pincode']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Mobile Numer</div>
                            <b>{{ $vendorDetail['vendor_personal']['mobile']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Email</div>
                            <b>{{ $vendorDetail['vendor_personal']['email']}}</b>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Business Info</h4>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Name</div>
                            <b>{{ $vendorDetail['vendor_business']['shop_name']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Address</div>
                            <b>{{ $vendorDetail['vendor_business']['shop_address'] }}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">City</div>
                            <b>{{ $vendorDetail['vendor_business']['shop_city']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">State</div>
                            <b>{{ $vendorDetail['vendor_business']['shop_state']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Country</div>
                            <b>{{ $vendorDetail['vendor_business']['shop_country']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Pin Code</div>
                            <b>{{ $vendorDetail['vendor_business']['shop_pincode']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Mobile Numer</div>
                            <b>{{ $vendorDetail['vendor_business']['shop_mobile']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Email</div>
                            <b>{{ $vendorDetail['vendor_business']['shop_email']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Email</div>
                            <b>{{ $vendorDetail['vendor_business']['address_proof']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Email</div>
                            <b>{{ $vendorDetail['vendor_business']['business_license_number']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Email</div>
                            <b>{{ $vendorDetail['vendor_business']['gst_number']}}</b>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Email</div>
                            <b>{{ $vendorDetail['vendor_business']['pan_number']}}</b>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <h4 class="card-title">Foto Business Profile</h4><br>
                    <div>
                        <img src="{{ asset('admin/images/proofs/'.$vendorDetail['vendor_business']['address_proof_image']) }}" height="370px" alt="user">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection