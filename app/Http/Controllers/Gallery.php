<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryModel;
use Illuminate\Support\Facades\Storage;

class Gallery extends Controller
{
    public function add()
    {
        $gallery = GalleryModel::all();

        $param = [
            "modulename" => "Gallery",
            "title" => "Gallery",
            "data" => $gallery,
        ];
        return view("gallery", $param);
    }

    public function save(Request $request)
    {
        $request->validate([
            "nama" => "required|max:100",
            "foto" => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        $foto = $request->file("foto");
        $namaFile = $foto->getClientOriginalName();
        $foto->storeAs("images/gallery", $namaFile, 'public');

        $data = [
            'nama' => $request->input('nama'),
            'foto' => $namaFile,
        ];

        GalleryModel::create($data);

        return back()->with("success", "gallery berhasil ditambahkan");
    }

    public function saveedit(Request $request)
    {
        $rules = [
            "nama" => "required|max:100",
        ];

        if ($request->hasFile("foto")) {
            $rules['foto'] = "required|image|mimes:jpeg,png,jpg,gif|max:2048";
        }

        $request->validate($rules);

        $data = [
            "nama" => $request->input('nama'),
        ];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFile = $foto->getClientOriginalName();

            Storage::disk('public')->delete("images/gallery/$request->fotolama");

            $foto->storeAs('images/gallery', $namaFile, 'public');
            $data['foto'] = $namaFile;
        }

        //dd($data);

        $result = GalleryModel::where('id', $request->input('id'))->update($data);
        //dd($result);
        return redirect(url('gallery'));
    }

    public function edit($id)
    {
        $gallery = GalleryModel::find($id);
        $param = [
            "modulename" => 'Gallery',
            "title" => 'Gallery - Edit',
            'data' => $gallery,
        ];
        return view('gallery-edit', $param);
    }

    public function delete(Request $request)
    {
        $result = GalleryModel::find($request->input('id'));
        GalleryModel::destroy($request->input('id'));
        Storage::disk('public')->delete("images/gallery/$result->foto");
        return back()->with('success', 'gallery berhasil dihapus');
    }


}
