<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcaraModel extends Model
{
    protected $table = "tbl_acara";

    protected $fillable = [
        "judul",
        "deskripsi",
        "foto",
        "mulai",
        "selesai"
    ];
}
