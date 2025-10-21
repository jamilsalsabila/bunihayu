<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class UserComments extends Controller
{
    public function add(Request $request, $id)
    {
        $request->validate(
            [
                "konten" => "required|max:255",
                "rating" => "required",
            ],
            ['konten.required' => "perlu di isi", "rating.required" => "perlu di beri rating"],
        );

        $data = [
            "rating" => $request->input("rating"),
            "konten" => $request->input("konten"),
            "id_produk" => $id,
            "id_user" => auth()->user()->id,
        ];

        Comments::create($data);

        return back()->with("success", "berhasil menambah komen");
    }
}
