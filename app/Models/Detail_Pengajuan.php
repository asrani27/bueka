<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'detail_pengajuan';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function bibit()
    {
        return $this->belongsTo(Bibit::class, 'bibit_id');
    }
}
