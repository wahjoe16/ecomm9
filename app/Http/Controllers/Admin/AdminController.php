<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
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

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('loginAdmin');
    }
}
