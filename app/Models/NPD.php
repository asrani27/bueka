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
    public function getAlokasiAnggaranAttribute()
    {
        return $this->detail->sum('total_rincian');
    }
    public function getAlokasiRAKAttribute()
    {
        return $this->detail->sum('total_rak');
    }
    public function getTotalAkumulasiAttribute()
    {
        return $this->detail->sum('total_akumulasi_rincian');
    }
    public function getTotalPencairanAttribute()
    {
        return $this->detail->sum('total_pencairan');
    }
    public function getJumlahJanuariAttribute()
    {
        return $this->detail->sum('total_januari');
    }
    public function getJumlahFebruariAttribute()
    {
        return $this->detail->sum('total_februari');
    }
    public function getJumlahMaretAttribute()
    {
        return $this->detail->sum('total_maret');
    }
    public function getJumlahAprilAttribute()
    {
        return $this->detail->sum('total_april');
    }
    public function getJumlahMeiAttribute()
    {
        return $this->detail->sum('total_mei');
    }
    public function getJumlahJuniAttribute()
    {
        return $this->detail->sum('total_juni');
    }
    public function getJumlahJuliAttribute()
    {
        return $this->detail->sum('total_juli');
    }
    public function getJumlahAgustusAttribute()
    {
        return $this->detail->sum('total_agustus');
    }
    public function getJumlahSeptemberAttribute()
    {
        return $this->detail->sum('total_september');
    }
    public function getJumlahOktoberAttribute()
    {
        return $this->detail->sum('total_oktober');
    }
    public function getJumlahNovemberAttribute()
    {
        return $this->detail->sum('total_november');
    }
    public function getJumlahDesemberAttribute()
    {
        return $this->detail->sum('total_desember');
    }
    public function getTriwulanSatuAttribute()
    {
        return $this->jumlah_januari + $this->jumlah_februari + $this->jumlah_maret;
    }
    public function getTriwulanDuaAttribute()
    {
        return $this->jumlah_april + $this->jumlah_mei + $this->jumlah_juni;
    }
    public function getTriwulanTigaAttribute()
    {
        return $this->jumlah_juli + $this->jumlah_agustus + $this->jumlah_september;
    }
    public function getTriwulanEmpatAttribute()
    {
        return $this->jumlah_oktober + $this->jumlah_november + $this->jumlah_desember;
    }
    public function getSemesterSatuAttribute()
    {
        return $this->triwulan_satu + $this->triwulan_dua;
    }
    public function getSemesterDuaAttribute()
    {
        return $this->triwulan_tiga + $this->triwulan_empat;
    }
}
