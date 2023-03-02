<div class="form-group row">
    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="parent_id">Pilih Level Kategori</label>
    <div class="col-sm-9">
        <select name="parent_id" id="parent_id" class="form-control" style="color: #000">
            <option value="0">Main Category</option>
            @if (!empty($getCategories))
            @foreach($getCategories as $parentcategory)
            <option value="{{ $parentcategory['id'] }}" @if(null !==($parentcategory['parent_id'] && $parentcategory['parent_id']==$parentcategory['id'])) selected @endif>{{ $parentcategory['category_name'] }}</option>
            @if(!empty($parentcategory['subcategories']))
            @foreach($parentcategory['subcategories'] as $subcategory)
            <option value="{{ $subcategory['id'] }}" @if(null !==($subcategory['parent_id'] && $subcategory['parent_id']==$subcategory['id'])) selected @endif>&nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
            @endforeach
            @endif
            @endforeach
            @endif
        </select>
    </div>
</div>