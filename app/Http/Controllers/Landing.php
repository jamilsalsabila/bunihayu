<?php

namespace App\Http\Controllers;

use App\Models\FasilitasModel;
use App\Models\GalleryModel;
use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\Produk;

class Landing extends Controller
{
    public function index()
    {
        $produk = Produk::latest()->select("foto", "nama", "deskripsi", "kapasitas", "harga", "id")->get();
        foreach ($produk as $item) {
            //$item["fasilitas"] = explode(",", $item["fasilitas"]);
            $item["foto"] = explode(",", $item["foto"] ?? "No_Image_Available.jpg");
        }

        $fasilitas = array_chunk(FasilitasModel::all()->toArray(), 2);

        // dd($fasilitas);

        $gallery = GalleryModel::all()->toArray();

        $comments = Comments::latest()->take(5)->get();
        //dd($comments);
        $param = [
            "modulename" => 'Landing',
            "title" => "Home / Bunihayu",
            "products" => $produk,
            "fasilitas" => $fasilitas,
            "gallery" => $gallery,
            "comments" => $comments,
        ];

        // dd($produk);
        return view('landing', $param);
    }
}
