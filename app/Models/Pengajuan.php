<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function detail()
    {
        return $this->hasMany(Detail_Pengajuan::class, 'pengajuan_id');
    }
}
