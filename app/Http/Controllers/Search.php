<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class Search extends Controller
{
    public function index()
    {
        $param = [
            'modulename' => 'Search',
            'title' => 'Search Result',
            'data' => [],
        ];
        return view('searchresult', $param);
    }

    public function query(Request $request)
    {

        $result = Produk::where('nama', 'LIKE', '%' . $request->input('query') . '%')->get(['nama', 'deskripsi', 'harga', 'id']);


        $param = [
            'modulename' => 'Search',
            'title' => 'Search Result',
            'data' => $result,
        ];

        return view('searchresult', $param);
    }
}
