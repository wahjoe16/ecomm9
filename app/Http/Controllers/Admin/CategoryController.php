<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function categories()
    {
        Session::put('page', 'categories');
        $category = Category::with(['section', 'parentcategory'])->get()->toArray();
        // dd($category);
        return view('admin.category.category', compact('category'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function addEditCategory(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "add category";
            $category = new Category;
            $getCategories = array();
            $message = "Data kategori berhasil disimpan";
        } else {
            $title = "edit category";
            $category = Category::find($id);
            // dd($category['category_name']);
            $getCategories = Category::with('subcategories')->where(['parent_id' => 0, 'section_id' => $category['section_id']])->get();
            $message = "Data kategori berhasil diedit";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);

            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'category_image' => 'mimes:jpg,jpeg,png',
                'url' => 'required',
            ];

            $message = [
                'category_name.required' => 'Nama Kategori Tidak Boleh Kosong',
                'category_name.regex' => 'Format Nama Kategori Tidak Boleh Salah',
                'section_id.required' => 'Section ID Tidak Boleh Kosong',
                'category_image.mimes' => 'Format Kategori Image harus JPEG, JPG, PNG',
                'url.required' => 'Url Tidak Boleh Kosong',
            ];

            $this->validate($request, $rules, $message);

            // jika diskon tidak ada
            if ($data['category_discount'] == "") {
                $data['category_discount'] = 0;
            }

            // dd($data);
            // upload image
            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    $imageExt = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . "." . $imageExt;
                    $imagePath = 'admin/images/categories/' . $imageName;
                    Image::make($image_tmp)->save($imagePath);
                    $category->category_image = $imageName;
                } else if (!empty($data['current_category_image'])) {
                    $imageName = $data['current_category_image'];
                } else {
                    $imageName = '';
                }
            }

            $category->section_id = $data['section_id'];
            $category->parent_id = $data['parent_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            // $category->category_image = $imageName;
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->meta_description = $data['meta_description'];
            $category->status = 1;
            $category->save();

            return redirect()->route('categories')->with('success_message', 'Data Kategori Berhasil Disimpan');
        }

        $getSections = Section::get()->toArray();
        return view('admin.category.add_edit_category', compact('message', 'title', 'category', 'getSections', 'getCategories'));
    }

    public function appendCategoryLevel(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo $data['section_id'];
            // die;
            $getCategories = Category::with('subcategories')->where([
                'parent_id' => 0,
                'section_id' => $data['section_id'],
            ])->get()->toArray();

            return view('admin.category.append_categories_level', compact('getCategories'));
        };
    }

    public function deleteCategory($id)
    {
        Category::where('id', $id)->delete();
        $message = "Kategori Berhasil Dihapus";
        return redirect()->route('categories')->with('success_message', $message);
    }

    public function deleteCategoryImage($id)
    {
        // get category image
        $categoryImage = Category::select('category_image')->where('id', $id)->first();

        // get path to category image
        $categoryImagePath = 'admin/images/categories/';

        // delete category image from category_images folder if it exists
        if (file_exists($categoryImagePath . $categoryImage->category_image)) {
            unlink($categoryImagePath . $categoryImage->category_image);
        }

        // delete category image from category_images folder
        Category::where('id', $id)->update(['category_image' => '']);
        $message = "Gambar Kategori Sudah Berhasil Dihapus";

        return redirect()->back()->with('success_message', $message);
    }
}
