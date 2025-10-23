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
        $produk = Produk::latest()->select("nama", "deskripsi", "kapasitas", "harga", "id")->get();
        foreach ($produk as $item) {

            $item["foto"] = $item->gallery ?? "../No_Image_Available.jpg";
        }

        // dd($produk);

        $fasilitas = array_chunk(FasilitasModel::all()->toArray(), 2);

        // dd($fasilitas);

        $gallery = GalleryModel::latest()->take(7)->get();

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
