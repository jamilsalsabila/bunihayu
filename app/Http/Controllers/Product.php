<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class Product extends Controller
{
    public function show()
    {
        $data = Produk::all();
        $param = [
            "moduleName" => "Produk",
            "title" => "Landing Page",
            "data" => $data,
        ];
        return view("landing", $param);
    }
}
