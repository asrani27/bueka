<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NPD extends Model
{
    use HasFactory;
    protected $table = 'npd';
    protected $guarded = ['id'];

    public function detail()
    {
        return $this->hasMany(NpdDetail::class, 'npd_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function program()
    {
        return $this->belongsTo(Program::class, 'kode_program');
    }
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kode_kegiatan');
    }
    public function subkegiatan()
    {
        return $this->belongsTo(Subkegiatan::class, 'kode_subkegiatan');
    }
    public function rincian()
    {
        return $this->hasManyThrough(NpdRincian::class, NpdDetail::class);
    }
    public function getTotalDPAAttribute()
    {
        return $this->detail->sum('total_rincian');
    }
    public function getTotalAkumulasiAttribute()
    {
        return $this->detail->sum('total_akumulasi_rincian');
    }
    public function getTotalPencairanAttribute()
    {
        return $this->detail->sum('total_pencairan');
    }
}
