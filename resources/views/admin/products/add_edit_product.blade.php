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

                    <form class="form-sample" @if(empty($product['id'])) action="{{ route('addEditProduct') }}" @else action="{{ route('addEditProduct', $product['id']) }}" @endif method="post" name="addEditProductForm" id="addEditProductForm" enctype="multipart/form-data">@csrf
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="section_id">Select Category</label>
                            <div class="col-sm-9">
                                <select name="category_id" id="category_id" class="form-control" style="color: #000">
                                    <option value="">Select</option>
                                    @foreach($categories as $c)
                                    <optgroup label="{{ $c['name'] }}"></optgroup>
                                    @foreach ($c['categories'] as $category)
                                    <option value="{{ $category['id'] }}">&nbsp;&nbsp;&nbsp;--&nbsp;{{ $category['category_name'] }}</option>
                                    @foreach ($category['subcategories'] as $subcategory)
                                    <option value="{{ $subcategory['id'] }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{ $subcategory['category_name'] }}</option>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="section_id">Select Brand</label>
                            <div class="col-sm-9">
                                <select name="brand_id" id="brand_id" class="form-control" style="color: #000">
                                    <option value="">Select</option>
                                    @foreach($brands as $b)
                                    <option value="{{ $b['id'] }}">{{ $b['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="product_name">Product Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="product_name" class="form-control" id="product_name" @if(!empty($product['product_name'])) value="{{ $product['product_name'] }}" @else value="{{ old('product_name') }}" @endif placeholder="Enter product Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="product_code">Product Code</label>
                            <div class="col-sm-9">
                                <input type="text" name="product_code" class="form-control" id="product_code" @if(!empty($product['product_code'])) value="{{ $product['product_code'] }}" @else value="{{ old('product_code') }}" @endif placeholder="Enter product Code">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="product_color">Product Color</label>
                            <div class="col-sm-9">
                                <input type="text" name="product_color" class="form-control" id="product_color" @if(!empty($product['product_color'])) value="{{ $product['product_color'] }}" @else value="{{ old('product_color') }}" @endif placeholder="Enter product Color">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="product_price">Product Price</label>
                            <div class="col-sm-9">
                                <input type="text" name="product_price" class="form-control" id="product_price" @if(!empty($product['product_price'])) value="{{ $product['product_price'] }}" @else value="{{ old('product_price') }}" @endif placeholder="Enter product Price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="product_discount">Product Discount (%)</label>
                            <div class="col-sm-9">
                                <input type="text" name="product_discount" class="form-control" id="product_discount" @if(!empty($product['product_discount'])) value="{{ $product['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif placeholder="Enter product Discount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="product_weight">Product Weight</label>
                            <div class="col-sm-9">
                                <input type="text" name="product_weight" class="form-control" id="product_weight" @if(!empty($product['product_weight'])) value="{{ $product['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif placeholder="Enter product Weight">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="product_video">Product Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="product_image" class="form-control" id="product_image">
                                @if(!empty($product->product_image))
                                <a target="_blank" href="{{ url('/admin/images/products/'. $product->product_image) }}">See Image</a>&nbsp;|&nbsp;
                                <a href="javascript:void(0)" class="confirm-delete" module="product-image" module_id="{{ $product['id'] }}" module_name=" {{ $product['product_image'] }}">Delete Image</a>
                                <input type="hidden" name="current_product_image" id="current_product_image" value="{{ $product->product_image }}">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="product_video">Product Video</label>
                            <div class="col-sm-9">
                                <input type="file" name="product_video" class="form-control" id="product_video">
                                @if(!empty($product->product_video))
                                <a target="_blank" href="{{ url('/admin/videos/products/'. $product->product_video) }}">See Video</a>&nbsp;|&nbsp;
                                <a href="javascript:void(0)" class="confirm-delete" module="product-video" module_id="{{ $product['id'] }}" module_name=" {{ $product['product_video'] }}">Delete Video</a>
                                <input type="hidden" name="current_product_video" id="current_product_video" value="{{ $product->product_video }}">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="description">Product Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" id="description" rows="10" @if(!empty($product['description'])) value="{{ $product['description'] }}" @endif></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="meta_title">Meta Title Product</label>
                            <div class="col-sm-9">
                                <input type="text" name="meta_title" class="form-control" id="meta_title" @if(!empty($product['meta_title'])) value="{{ $product['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif placeholder="Masukan Meta Title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="meta_keywords">Meta Keywords Product</label>
                            <div class="col-sm-9">
                                <input type="text" name="meta_keywords" class="form-control" id="meta_keywords" @if(!empty($product['meta_keywords'])) value="{{ $product['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif placeholder="Masukan Meta Keywords">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="meta_description">Meta Description Product</label>
                            <div class="col-sm-9">
                                <input type="text" name="meta_description" class="form-control" id="meta_description" @if(!empty($product['meta_description'])) value="{{ $product['meta_description'] }}" @else value="{{ old('meta_description') }}" @endif placeholder="Masukan Meta Description">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="is_featured">Featured Item</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="is_featured" id="is_featured" value="Yes" @if (!empty($product['is_featured']) && $product['is_featured']=="Yes" ) checked @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">

                            </div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route('products') }}" class="btn btn-light">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection