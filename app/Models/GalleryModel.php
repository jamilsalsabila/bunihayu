<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Produk;

class GalleryModel extends Model
{
    use HasFactory;

    protected $table = "gallery";
    protected $fillable = ["nama", "idproduk", "foto"];

    public function produk()
    {
        return $this->belongsTo(Produk::class, "idproduk", "nama");
    }
}
