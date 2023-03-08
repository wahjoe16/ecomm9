<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Products;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function products()
    {
        Session::put('page', 'products');
        $products = Products::get();
        // dd($products);
        return view('admin.products.products', compact('products'));
    }

    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Products::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    public function addEditProduct(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add a new product";
            $product = new Products;
            $message = "Product successfully added";
        } else {
            $title = "update product";
            $product = Products::find($id);
            $message = "Product successfully updated";
        }

        if ($request->isMethod('POST')) {
            $data = $request->all();

            $rules = [
                'category_id' => 'required',
                'product_name' => 'required', "regex:/^([^\"!'\*\\]*)$/",
                'product_code' => 'required|regex:/^\w+$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $customMessage = [
                'category_id.required' => 'Category is required',
                'product_name.required' => 'Product name is required',
                'product_name.regex' => 'Valid product name is required',
                'product_code.required' => 'Product code is required',
                'product_code.regex' => 'Valid product code is required',
                'product_price.required' => 'Product price is required',
                'product_price.regex' => 'Valid product price is required',
                'product_color.required' => 'Product color is required',
                'product_color.regex' => 'Valid product color is required',
            ];

            $this->validate($request, $rules, $customMessage);

            // save product details in database
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];

            $adminType = Auth::guard('admin')->user()->type;
            $vendorId = Auth::guard('admin')->user()->vendor_id;
            $adminId = Auth::guard('admin')->user()->id;

            $product->admin_type = $adminType;
            $product->admin_id = $adminId;
            if ($adminType == "vendor") {
                $product->vendor_id = $vendorId;
            } else {
                $product->vendor_id = 0;
            }

            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            } else {
                $product->is_featured = "No";
            }
            $product->status = 1;
            $product->save();

            return redirect()->route('products')->with('success_message', $message);
        }

        // mengambil data sections dengan category dan sub Category
        $categories = Section::with('categories')->get()->toArray();
        // dd($categories);

        // data brands
        $brands = Brands::where('status', 1)->get()->toArray();

        return view('admin.products.add_edit_product', compact('title', 'product', 'message', 'categories', 'brands'));
    }

    public function deleteProduct($id)
    {
        Products::where('id', $id)->delete();
        $message = "Data Product Berhasil Dihapus";
        return redirect()->back()->with('success_message', $message);
    }
}
