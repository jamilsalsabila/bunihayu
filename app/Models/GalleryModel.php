<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryModel extends Model
{
    use HasFactory;

    protected $table = "gallery";
    protected $fillable = ["nama", "foto"];

}
