<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NpdRincian extends Model
{
    use HasFactory;
    protected $table = 'npd_rincian';
    protected $guarded = ['id'];

    // protected $primaryKey = 'kode';
    // public $incrementing = false;

    public function rincian()
    {
        return $this->belongsTo(Rincian::class, 'kode_rincian');
    }
}
