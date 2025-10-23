<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryModel;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Comments;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index()
    {
        $products = Produk::latest()->paginate(6);

        foreach ($products as $product) {

            $product['foto'] = $product->gallery->toArray()[0]['nama'];

        }

        // dd($data);

        $param = [
            "modulename" => "ProductController",
            "title" => "List Product",
            "data" => $products,
        ];

        return view('products.list', $param);
    }

    public function create()
    {
        $param = [
            'modulname' => 'ProductController',
            'title' => 'Add Product',
        ];
        return view('products.create', $param);
    }

    public function save(Request $request)
    {

        $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'kapasitas' => 'required|integer',
            'fasilitas' => 'nullable|string',
            'foto.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'Nama Perlu diisi',
            'deskripsi.required' => 'deskripsi perlu diisi',
            'harga.required' => 'harga perlu diisi',
            'kapasitas.required' => 'kapasitas perlu diisi',
            'foto.required' => 'foto diperlukan',
        ]);

        $datafoto = [];

        foreach ($request->file('foto') as $foto) {
            $namaFile = $foto->getClientOriginalName() ?? 'gambar';

            $now = Carbon::now();
            $datafoto[] = ["nama" => $namaFile, "idproduk" => $request->input('nama'), "foto" => $namaFile, "created_at" => $now->toDateTimeString(), "updated_at" => $now->toDateTimeString()];

            $foto->storeAs("images/" . $request->input('nama'), $namaFile, 'public');

        }

        $data = [
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'kapasitas' => $request->input('kapasitas'),
            'fasilitas' => $request->input('fasilitas'),
            //'foto' => implode(",", $namaFiles),
        ];

        try {
            //dd($datafoto);

            Produk::create($data);

        } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
            return redirect()->back()->with('error', 'nama ' . $request->input('nama') . ' already taken');
        }

        GalleryModel::insert($datafoto);

        return redirect(url('product'))->with('success', 'Berhasil memasukkan data baru');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);

        $produk->foto = $produk->gallery;
        // dd($produk->foto);

        $comments = Comments::latest()->where('id_produk', intval($id))->get();

        //dd($comments);

        $param = [
            'modulename' => 'ProductController',
            'title' => "show - $produk->id",
            'data' => $produk,
            'comments' => $comments,
        ];

        return view('products.show', $param);
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        $produk->foto = $produk->gallery;

        $param = [
            'modulename' => 'ProductController',
            'title' => "Edit Product - $id",
            'data' => $produk,
        ];
        return view('products.edit', $param);
    }

    public function update(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'kapasitas' => 'required|integer',
            'fasilitas' => 'nullable|string',
        ];

        $params = [
            'nama.required' => 'Nama Perlu diisi',
            'deskripsi.required' => 'deskripsi perlu diisi',
            'harga.required' => 'harga perlu diisi',
            'kapasitas.required' => 'kapasitas perlu diisi',
        ];

        $nfoto = $request->input('nfoto');

        // dd($nfoto);

        for ($i = 1; $i <= intval($nfoto); $i++) {

            if ($request->hasFile("foto$i")) {

                $rules["foto$i"] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
                $params["foto$i.required"] = 'foto perlu diinput';
            }
        }

        $request->validate($rules, $params);


        $data = [
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'kapasitas' => $request->input('kapasitas'),
            'fasilitas' => $request->input('fasilitas'),
            'tersedia' => $request->input('tersedia') ?? '0',
        ];

        //dd($data);

        // Ganti nama folder tempat simpan gambar jika ganti nama produk
        if ($request->input('namalama') != $request->input('nama')) {
            Storage::disk('public')->move('images/' . $request->input('namalama') . '/', 'images/' . $request->input('nama') . '/');
        }


        // dd(explode(",", $product->foto));

        for ($i = 1; $i <= intval($nfoto); $i++) {
            if ($request->hasFile("foto$i")) {

                $foto = $request->file("foto$i");

                $fotoid = $request->input("fotoid$i");
                $fotonama = $request->input("fotonama$i");

                $newNamaFile = $foto->getClientOriginalName();

                // Hapus foto lama
                Storage::disk('public')->delete("images/" . $request->input('nama') . "/" . $fotonama);

                // Simpan foto baru
                $foto->storeAs("images/" . $request->input('nama'), $newNamaFile, 'public');

                // update foto
                GalleryModel::where('id', $fotoid)->update(['nama' => $newNamaFile, 'foto' => $newNamaFile]);

            }
        }


        Produk::where('id', $request->input('id'))->update($data);

        return redirect(url('product'))->with('success', 'data berhasil di update');
    }

    public function delete(Request $request)
    {
        $data = Produk::findOrFail($request->id);
        Produk::where('id', $data->id)->delete();
        Storage::disk('public')->deleteDirectory("images/$data->nama");
        return redirect(url('product'))->with('success', 'data berhasil di hapus');
    }
}
