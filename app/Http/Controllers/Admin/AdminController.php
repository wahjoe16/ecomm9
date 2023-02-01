<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre";
            // print_r($data);
            // die;

            // aturan validasi
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required'
            ];

            // pesan error validasi
            $customeMessages = [
                'email.required' => 'Email Tidak Boleh Kosong',
                'email.email' => 'Email Harus Memiliki Format Email yang Benar',
                'password.required' => 'Password Tidak Boleh Kosong',
            ];

            $this->validate($request, $rules, $customeMessages);

            if (Auth::guard('admin')->attempt([
                'email' => $data['email'],
                'password' => $data['password'],
                'status' => 1
            ])) {
                return redirect()->route('dashboardAdmin');
            } else {
                return redirect()->back()->with('error_message', 'Salah Email / Password');
            }
        }
        return view('admin.login');
    }

    public function updatePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // cek jika password lama yang dimasukan admin benar
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                // cek jika password baru sesuai dengan konfirmasi password
                if ($data['new_password'] == $data['confirm_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update([
                        'password' => Hash::make($data['new_password'])
                    ]);
                    return redirect()->back()->with('success_message', 'Password anda berhasil diubah');
                } else {
                    return redirect()->back()->with('error_message', 'Password baru harus sesuai dengan konfirmasi password baru');
                }
            } else {
                return redirect()->back()->with('error_message', 'Password lama anda salah');
            }
        }

        $dataAdmin = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password', compact('dataAdmin'));
    }

    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";
        // print_r($data);
        // die;

        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateProfile(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // aturan validasi
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric',
                'image' => 'mimes:jpg,jpeg,png,gif'
            ];

            // pesan error validasi
            $customeMessages = [
                'name.required' => 'Nama Tidak Boleh Kosong',
                'name.regex' => 'Format Nama Salah',
                'mobile.required' => 'Nomor Handphone Tidak Boleh Kosong',
                'mobile.numeric' => 'Nomor Handphone Harus Angka',
                'image.mimes' => 'Foto harus mempunyai format jpg, jpeg, png, gif'
            ];

            $this->validate($request, $rules, $customeMessages);

            // upload foto admin
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // get extension image
                    $extension = $image_tmp->getClientOriginalExtension();
                    // generate nama file
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'admin/images/foto/' . $imageName;
                    // upload image
                    Image::make($image_tmp)->save($imagePath);
                }
            } elseif (!empty($data['current_admin_image'])) {
                $imageName = $data['current_admin_image'];
            } else {
                $imageName = '';
            }

            Admin::where('id', Auth::guard('admin')->user()->id)->update([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'image' => $imageName
            ]);

            return redirect()->back()->with('success_message', 'Profile admin berhasil di Update');
        }
        return view('admin.settings.update_admin_profile');
    }

    public function updateVendorProfile($slug, Request $request)
    {
        if ($slug == "personal") {

            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();

            if ($request->isMethod('post')) {

                $data = $request->all();

                $rules = [
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile' => 'required|numeric',
                    'vendor_image' => 'mimes:jpg,jpeg,png,gif',
                    'vendor_email' => 'required|email:rfc,dns',
                    'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_state' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_country' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_pincode' => 'required|numeric'
                ];

                $customeMessages = [
                    'vendor_name.required' => 'Nama Tidak Boleh Kosong',
                    'vendor_name.regex' => 'Format Nama Salah',
                    'vendor_mobile.required' => 'Nomor Handphone Tidak Boleh Kosong',
                    'vendor_mobile.numeric' => 'Nomor Handphone Harus Angka',
                    'vendor_image.mimes' => 'Foto harus mempunyai format jpg, jpeg, png, gif',
                    'vendor_city.required' => 'Nama Kota Tidak Boleh Kosong',
                    'vendor_city.regex' => 'Format Nama Kota Salah',
                    'vendor_state.required' => 'Nama Daerah Tidak Boleh Kosong',
                    'vendor_state.regex' => 'Format Nama Daerah Salah',
                    'vendor_country.required' => 'Nama Negara Tidak Boleh Kosong',
                    'vendor_country.regex' => 'Format Nama Negara Salah',
                    'vendor_pincode.required' => 'Nomor Kode Pin Tidak Boleh Kosong',
                    'vendor_pincode.numeric' => 'Nomor Kode Pin Harus Angka',
                    'vendor_email.required' => 'Email Tidak Boleh Kosong',
                    'vendor_email.email' => 'Format Email Salah'
                ];

                $this->validate($request, $rules, $customeMessages);

                // upload foto vendor
                if ($request->hasFile('vendor_image')) {
                    $image_tmp = $request->file('vendor_image');
                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111, 9999) . '.' . $extension;
                        $image_path = 'admin/images/foto/' . $imageName;

                        Image::make($image_tmp)->save($image_path);
                    }
                } elseif (!empty($data['current_vendor_image'])) {
                    $imageName = $data['current_vendor_image'];
                } else {
                    $imageName = "";
                }

                // update data ke database table admin
                Admin::where('id', Auth::guard('admin')->user()->id)->update([
                    'name' => $data['vendor_name'],
                    'mobile' => $data['vendor_mobile'],
                    'image' => $imageName
                ]);

                // update data ke database table vendor
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update([
                    'name' => $data['vendor_name'],
                    'address' => $data['vendor_address'],
                    'city' => $data['vendor_city'],
                    'state' => $data['vendor_state'],
                    'country' => $data['vendor_country'],
                    'pincode' => $data['vendor_pincode'],
                    'mobile' => $data['vendor_mobile'],
                    'email' => $data['vendor_email'],
                ]);

                // dd($data);

                return redirect()->back()->with('success_message', 'Data vendor berhasil di update!');
            }
        } elseif ($slug == "business") {
            # code...
        } elseif ($slug == "bank") {
            # code...
        }

        return view('admin.settings.update_vendor_profile')->with(compact('slug', 'vendorDetails'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('loginAdmin');
    }
}
