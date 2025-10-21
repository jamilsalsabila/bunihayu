<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Produk;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['rating', 'konten', 'id_produk', 'id_user'];

    public $incrementing = true;

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
