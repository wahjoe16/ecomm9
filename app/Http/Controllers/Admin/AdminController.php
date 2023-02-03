<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBusinessDetail;
use App\Models\VendorsBankDetail;
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
            $customMessages = [
                'name.required' => 'Nama Tidak Boleh Kosong',
                'name.regex' => 'Format Nama Salah',
                'mobile.required' => 'Nomor Handphone Tidak Boleh Kosong',
                'mobile.numeric' => 'Nomor Handphone Harus Angka',
                'image.mimes' => 'Foto harus mempunyai format jpg, jpeg, png, gif'
            ];

            $this->validate($request, $rules, $customMessages);

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

                $customMessages = [
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

                $this->validate($request, $rules, $customMessages);

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

            $vendorDetails = VendorsBusinessDetail::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();

            if ($request->isMethod('post')) {

                $data = $request->all();

                $rules = [
                    'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile' => 'required|numeric',
                    'address_proof_image' => 'mimes:jpg,jpeg,png,gif',
                    'shop_email' => 'required|email:rfc,dns',
                    'shop_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_state' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_country' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_pincode' => 'required|numeric',
                    'business_license_number' => 'required|numeric',
                    'gst_number' => 'required|numeric',
                    'pan_number' => 'required|numeric',
                ];

                $customMessages = [
                    'shop_name.required' => 'Nama Tidak Boleh Kosong',
                    'shop_name.regex' => 'Format Nama Salah',
                    'shop_mobile.required' => 'Nomor Handphone Tidak Boleh Kosong',
                    'shop_mobile.numeric' => 'Nomor Handphone Harus Angka',
                    'address_proof_image.mimes' => 'Foto harus mempunyai format jpg, jpeg, png, gif',
                    'shop_city.required' => 'Nama Kota Tidak Boleh Kosong',
                    'shop_city.regex' => 'Format Nama Kota Salah',
                    'shop_state.required' => 'Nama Daerah Tidak Boleh Kosong',
                    'shop_state.regex' => 'Format Nama Daerah Salah',
                    'shop_country.required' => 'Nama Negara Tidak Boleh Kosong',
                    'shop_country.regex' => 'Format Nama Negara Salah',
                    'shop_pincode.required' => 'Nomor Kode Pin Tidak Boleh Kosong',
                    'shop_pincode.numeric' => 'Nomor Kode Pin Harus Angka',
                    'shop_email.required' => 'Email Tidak Boleh Kosong',
                    'shop_email.email' => 'Format Email Salah',
                    'business_license_number.required' => 'Nomor Lisensi Bisnis Tidak Bolah Kosong',
                    'business_license_number.numeric' => 'Nomor Lisensi Bisnis Harus Angka',
                    'gst_number.required' => 'Nomor GST Tidak Bolah Kosong',
                    'gst_number.numeric' => 'Nomor GST Harus Angka',
                    'pan_number.required' => 'Nomor PAN Tidak Bolah Kosong',
                    'pan_number.numeric' => 'Nomor PAN Harus Angka'
                ];

                $this->validate($request, $rules, $customMessages);

                // upload foto vendor
                if ($request->hasFile('address_proof_image')) {
                    $image_tmp = $request->file('address_proof_image');
                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111, 9999) . '.' . $extension;
                        $image_path = 'admin/images/proofs/' . $imageName;

                        Image::make($image_tmp)->save($image_path);
                    }
                } elseif (!empty($data['current_vendor_address_proof_image'])) {
                    $imageName = $data['current_vendor_address_proof_image'];
                } else {
                    $imageName = "";
                }

                // update data ke database table vendor business detail
                VendorsBusinessDetail::where('id', Auth::guard('admin')->user()->vendor_id)->update([
                    'shop_name' => $data['shop_name'],
                    'shop_address' => $data['shop_address'],
                    'shop_city' => $data['shop_city'],
                    'shop_state' => $data['shop_state'],
                    'shop_country' => $data['shop_country'],
                    'shop_pincode' => $data['shop_pincode'],
                    'shop_mobile' => $data['shop_mobile'],
                    'shop_email' => $data['shop_email'],
                    'shop_website' => $data['shop_website'],
                    'address_proof' => $data['address_proof'],
                    'address_proof_image' => $imageName,
                    'business_license_number' => $data['business_license_number'],
                    'gst_number' => $data['gst_number'],
                    'pan_number' => $data['pan_number'],
                ]);

                // dd($data);

                return redirect()->back()->with('success_message', 'Data vendor berhasil di update!');
            }
        } elseif ($slug == "bank") {

            $vendorDetails = VendorsBankDetail::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();

            if ($request->isMethod('post')) {
                $data = $request->all();

                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'bank_name' => 'required',
                    'account_number' => 'required|numeric',
                    'bank_ifsc_code' => 'required|numeric'
                ];

                $customMessages = [
                    'account_holder_name.required' => 'Nama Akun Tidak Boleh Kosong',
                    'account_holder_name.regex' => 'Format Nama Akun Salah',
                    'bank_name.required' => 'Nama Bank Tidak Boleh Kosong',
                    'account_number.required' => 'Nomor Akun Tidak Boleh Kosong',
                    'account_number.numeric' => 'Nomor Akun Harus Angka',
                    'bank_ifsc_code.required' => 'Kode Bank Tidak Boleh Kosong',
                    'bank_ifsc_code.numeric' => 'Kode Bank Harus Angka'
                ];

                $this->validate($request, $rules, $customMessages);

                VendorsBankDetail::where('id', Auth::guard('admin')->user()->vendor_id)->update([
                    'account_holder_name' => $data['account_holder_name'],
                    'bank_name' => $data['bank_name'],
                    'account_number' => $data['account_number'],
                    'bank_ifsc_code' => $data['bank_ifsc_code']
                ]);

                return redirect()->back()->with('success_message', 'Data Vendor Bank Berhasil di Update');
            }
        }

        return view('admin.settings.update_vendor_profile')->with(compact('slug', 'vendorDetails'));
    }

    public function admins($type = null)
    {
        $admins = Admin::query();
        if (!empty($type)) {
            $admins = $admins->where('type', $type);
            $title = ucfirst($type);
        } else {
            $title = "All Admins, SubAdmins, Vendors";
        }
        $admins = $admins->get()->toArray();

        return view('admin.admins.admins', compact('admins', 'title'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('loginAdmin');
    }
}
