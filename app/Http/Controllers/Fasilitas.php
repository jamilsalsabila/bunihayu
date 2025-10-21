<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FasilitasModel;
use Illuminate\Support\Facades\Storage;

class Fasilitas extends Controller
{
    public function add()
    {
        $fasilitas = FasilitasModel::all();

        $param = [
            "modulename" => "Fasilitas",
            "title" => "Fasilitas",
            "data" => $fasilitas,
        ];
        return view("fasilitas", $param);
    }

    public function save(Request $request)
    {
        $request->validate([
            "nama" => "required|max:100",
            "foto" => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        $foto = $request->file("foto");
        $namaFile = $foto->getClientOriginalName();
        $foto->storeAs("images/fasilitas", $namaFile, 'public');

        $data = [
            'nama' => $request->input('nama'),
            'foto' => $namaFile,
        ];

        FasilitasModel::create($data);

        return back()->with("success", "fasilitas berhasil ditambahkan");
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

            Storage::disk('public')->delete("images/fasilitas/$request->fotolama");

            $foto->storeAs('images/fasilitas', $namaFile, 'public');
            $data['foto'] = $namaFile;
        }

        //dd($data);

        $result = FasilitasModel::where('id', $request->input('id'))->update($data);
        //dd($result);
        return redirect(url('fasilitas'));
    }

    public function edit($id)
    {
        $fasilitas = FasilitasModel::find($id);
        $param = [
            "modulename" => 'Fasilitas',
            "title" => 'Fasilitas - Edit',
            'data' => $fasilitas,
        ];
        return view('fasilitas-edit', $param);
    }

    public function delete(Request $request)
    {
        $result = FasilitasModel::find($request->input('id'));
        FasilitasModel::destroy($request->input('id'));
        Storage::disk('public')->delete("images/fasilitas/$result->foto");
        return back()->with('success', 'fasilitas berhasil dihapus');
    }


}
