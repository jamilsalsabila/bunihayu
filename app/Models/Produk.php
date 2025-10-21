<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Comments;

class Produk extends Model
{
    use HasFactory;

    protected $table = "tbl_produk";
    protected $fillable = ["nama", "deskripsi", "harga", "kapasitas", "fasilitas", "foto", 'tersedia'];

    public $timestamps = true;
    public $incrementing = true;

    public function comment()
    {
        return $this->hasMany(Comments::class, 'id_produk', 'id');
    }
}
