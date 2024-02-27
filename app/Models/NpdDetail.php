<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NpdDetail extends Model
{
    use HasFactory;
    protected $table = 'npd_detail';
    protected $guarded = ['id'];

    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'kode_rekening');
    }
}
