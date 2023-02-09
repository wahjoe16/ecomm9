<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SectionController extends Controller
{
    public function sections()
    {
        Session::put('page', 'sections');
        $section = Section::get()->toArray();
        return view('admin.sections.sections', compact('section'));
    }

    public function updateSectionStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Section::where('id', $data['section_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
        }
    }

    public function addEditSection(Request $request, $id = null)
    {
        Session::put('page', 'sections');
        if ($id == "") {
            $title = "Tambah Section";
            $section = new Section;
            $message = "Sukses Menambahkan Section";
        } else {
            $title = "Edit Section";
            $section = Section::find($id);
            $message = "Sukses Update Section";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'section_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $customMessages = [
                'section_name.required' => 'Nama Section Tidak Boleh Kosong',
                'section_name.regex' => 'Format Nama Section Salah'
            ];

            $this->validate($request, $rules, $customMessages);

            $section->name = $data['section_name'];
            $section->status = 1;
            $section->save();
            return redirect()->route('sections')->with('success_message', $message);
        }

        return view('admin.sections.add_edit_section', compact('section', 'title', 'message'));
    }

    public function deleteSection($id)
    {
        Section::where('id', $id)->delete();
        $message = "Section telah berhasil di delete";
        return redirect()->back()->with('success_message', $message);
    }
}
