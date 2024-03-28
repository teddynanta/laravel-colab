<?php

namespace App\Models;

use App\Models\KategoriDokumen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokumen extends Model
{
    public $table = "dokumen_daerah";
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(KategoriDokumen::class, 'kategori_dokumen_id');
    }
}
