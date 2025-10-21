<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FasilitasModel extends Model
{
    use HasFactory;

    protected $table = "fasilitas";
    protected $fillable = ["nama", "foto"];

}
