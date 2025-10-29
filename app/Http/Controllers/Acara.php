<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcaraModel;
use Illuminate\Support\Facades\Storage;

class Acara extends Controller
{
    public function add()
    {
        $acara = AcaraModel::all();

        $param = [
            "modulename" => "Acara",
            "title" => "Acara",
            "data" => $acara,
        ];
        return view("acara", $param);
    }

    public function save(Request $request)
    {
        $request->validate([
            "judul" => "required|max:100",
            "foto" => "required|image|mimes:jpeg,png,jpg,gif|max:10000",
            "mulai" => "required",
            "selesai" => "required",
        ]);

        $foto = $request->file("foto");
        $namaFile = $foto->getClientOriginalName();
        $foto->storeAs("images/acara", $namaFile, 'public');

        $data = [
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'foto' => $namaFile,
            'mulai' => $request->input('mulai'),
            'selesai' => $request->input('selesai'),
        ];


        AcaraModel::create($data);

        return back()->with("success", "Acara berhasil ditambahkan");
    }

    public function saveedit(Request $request)
    {
        $rules = [
            "judul" => "required|max:100",
            "mulai" => "required",
            "selesai" => "required",
        ];

        if ($request->hasFile("foto")) {
            $rules['foto'] = "required|image|mimes:jpeg,png,jpg,gif|max:10000";
        }

        $request->validate($rules);

        $data = [
            "judul" => $request->input('judul'),
            "deskripsi" => $request->input('deskripsi'),
            'mulai' => $request->input('mulai'),
            'selesai' => $request->input('selesai'),
        ];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFile = $foto->getClientOriginalName();

            Storage::disk('public')->delete("images/acara/$request->fotolama");

            $foto->storeAs('images/acara', $namaFile, 'public');
            $data['foto'] = $namaFile;
        }

        // dd($data);

        $result = AcaraModel::where('id', $request->input('id'))->update($data);
        //dd($result);
        return redirect(url('acara'));
    }

    public function edit($id)
    {
        $acara = AcaraModel::findOrFail($id);
        $param = [
            "modulename" => 'Acara',
            "title" => 'Acara - Edit',
            'data' => $acara,
        ];
        return view('acara-edit', $param);
    }

    public function delete(Request $request)
    {
        $result = AcaraModel::findOrFail($request->input('id'));
        AcaraModel::destroy($request->input('id'));
        Storage::disk('public')->delete("images/acara/$result->foto");
        return back()->with('success', 'acara berhasil dihapus');
    }


}
