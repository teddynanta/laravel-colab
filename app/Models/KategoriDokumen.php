<?php

namespace App\Models;

use App\Models\Dokumen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriDokumen extends Model
{
    public $table = "kategori_dokumen";
    use HasFactory;

    public function posts()
    {
        return $this->hasMany(Dokumen::class, 'kategori_dokumen_id', 'id');
    }
}
