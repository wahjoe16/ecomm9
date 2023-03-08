@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
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

                    <form class="form-sample" @if(empty($category['id'])) action="{{ route('addEditCategory') }}" @else action="{{ route('addEditCategory', $category['id']) }}" @endif method="post" name="addEditCategoryForm" id="addEditCategoryForm" enctype="multipart/form-data">@csrf
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="category_name">Nama Kategori</label>
                            <div class="col-sm-9">
                                <input type="text" name="category_name" class="form-control" id="category_name" @if(!empty($category['category_name'])) value="{{ $category['category_name'] }}" @else value="{{ old('category_name') }}" @endif placeholder="Masukan Nama category">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="section_id">Pilih Section</label>
                            <div class="col-sm-9">
                                <select name="section_id" id="section_id" class="form-control" style="color: #000">
                                    <option value="">Select</option>
                                    @foreach($getSections as $section)
                                    <option value="{{ $section['id'] }}" @if(!empty($category['section_id']) && $category['section_id']==$section['id']) selected @endif>{{ $section['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="appendCategoriesLevel">
                            @include('admin.category.append_categories_level')
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="category_image">Gambar Kategori</label>
                            <div class="col-sm-9">
                                <input type="file" name="category_image" class="form-control" id="category_image">
                                @if(!empty($category->category_image))
                                <a target="_blank" href="{{ url('/admin/images/categories/'. $category->category_image) }}">Lihat Gambar</a>&nbsp;|&nbsp;
                                <a href="javascript:void(0)" class="confirm-delete" module="category-image" module_id="{{ $category['id'] }}" module_name=" {{ $category['category_name'] }}">Hapus Gambar</a>
                                <input type="hidden" name="current_category_image" id="current_category_image" value="{{ $category->category_image }}">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="category_discount">Diskon Kategori</label>
                            <div class="col-sm-9">
                                <input type="text" name="category_discount" class="form-control" id="category_discount" @if(!empty($category['category_discount'])) value="{{ $category['category_discount'] }}" @else value="{{ old('category_discount') }}" @endif placeholder="Masukan Nama category">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="description">Deskripsi Kategori</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" id="description" rows="10" @if(!empty($category['description'])) value="{{ $category['description'] }}" @endif>{{ $category['description'] }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="url">Url Kategori</label>
                            <div class="col-sm-9">
                                <input type="text" name="url" class="form-control" id="url" @if(!empty($category['url'])) value="{{ $category['url'] }}" @else value="{{ old('url') }}" @endif placeholder="Masukan URL">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="meta_title">Meta Title Kategori</label>
                            <div class="col-sm-9">
                                <input type="text" name="meta_title" class="form-control" id="meta_title" @if(!empty($category['meta_title'])) value="{{ $category['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif placeholder="Masukan Meta Title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="meta_keywords">Meta Keywords Kategori</label>
                            <div class="col-sm-9">
                                <input type="text" name="meta_keywords" class="form-control" id="meta_keywords" @if(!empty($category['meta_keywords'])) value="{{ $category['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif placeholder="Masukan Meta Keywords">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="meta_description">Meta Description Kategori</label>
                            <div class="col-sm-9">
                                <input type="text" name="meta_description" class="form-control" id="meta_description" @if(!empty($category['meta_description'])) value="{{ $category['meta_description'] }}" @else value="{{ old('meta_description') }}" @endif placeholder="Masukan Meta Description">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">

                            </div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route('categories') }}" class="btn btn-light">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection