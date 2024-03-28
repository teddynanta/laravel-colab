<?php

namespace App\Models;

use App\Models\Berita;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriBerita extends Model
{
    public $table = "kategori_berita";
    use HasFactory;

    public function posts()
    {
        return $this->hasMany(Berita::class, 'kategori_berita_id', 'id');
    }
}
