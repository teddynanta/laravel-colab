<?php

namespace App\Models;

use App\Models\KategoriBerita;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    public $table = "berita";
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_berita_id');
    }
}
