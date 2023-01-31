@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <h3>Update Password</h3><br><br>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                    <form class="" action="{{ route('updatePasswordAdmin') }}" method="post" name="updateAdminPasswordForm" id="updateAdminPasswordForm">@csrf
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="username">Username</label>
                            <div class="col-sm-9">
                                <input type="text" name="" class="form-control" id="username" value="{{ $dataAdmin['name'] }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="email">E-mail</label>
                            <div class="col-sm-9">
                                <input type="text" name="" class="form-control" id="email" value="{{ $dataAdmin['email'] }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="current_password">Password Lama</label>
                            <div class="col-sm-9">
                                <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Password Lama" required>
                                <span id="check_password"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="password">Password Baru</label>
                            <div class="col-sm-9">
                                <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Password Baru" required>
                                @error('new_password')
                                <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="password">Konfirmasi Password Baru</label>
                            <div class="col-sm-9">
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Konfirmasi Password Baru" required>
                                @error('password_confirmation')
                                <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
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
</div>

@endsection