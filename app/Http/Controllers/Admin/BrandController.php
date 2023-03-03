<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    public function brands()
    {
        Session::put('page', 'brands');
        $brands = Brands::get()->toArray();
        return view('admin.brands.brands', compact('brands'));
    }

    public function updateBrandStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Brands::where('id', $data['brand_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }

    public function addEditBrand(Request $request, $id = null)
    {
        Session::put('page', 'brands');
        if ($id == "") {
            $title = "Tambah Brand";
            $brands = new Brands;
            $message = "Sukses Menambahkan Brand";
        } else {
            $title = "Edit Brand";
            $brands = Brands::find($id);
            $message = "Sukses Update Brand";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $customMessages = [
                'name.required' => 'Nama Brand Tidak Boleh Kosong',
                'name.regex' => 'Format Nama Brand Salah'
            ];

            $this->validate($request, $rules, $customMessages);

            $brands->name = $data['name'];
            $brands->status = 1;
            $brands->save();
            return redirect()->route('brands')->with('success_message', $message);
        }

        return view('admin.brands.add_edit_brand', compact('brands', 'title', 'message'));
    }

    public function deleteBrand($id)
    {
        Brands::where('id', $id)->delete();
        $message = "Brand telah berhasil di delete";
        return redirect()->back()->with('success_message', $message);
    }
}
