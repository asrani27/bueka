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

    public function npd()
    {
        return $this->belongsTo(NPD::class, 'npd_id');
    }
    public function rincian()
    {
        return $this->hasMany(NpdRincian::class, 'npd_detail_id');
    }

    public function getTotalRincianAttribute()
    {
        return $this->rincian->sum('anggaran');
    }
    public function getTotalJanuariAttribute()
    {
        return $this->rincian->sum('januari');
    }
    public function getTotalFebruariAttribute()
    {
        return $this->rincian->sum('februari');
    }
    public function getTotalMaretAttribute()
    {
        return $this->rincian->sum('maret');
    }
    public function getTotalAprilAttribute()
    {
        return $this->rincian->sum('april');
    }
    public function getTotalMeiAttribute()
    {
        return $this->rincian->sum('mei');
    }
    public function getTotalJuniAttribute()
    {
        return $this->rincian->sum('juni');
    }
    public function getTotalJuliAttribute()
    {
        return $this->rincian->sum('juli');
    }
    public function getTotalAgustusAttribute()
    {
        return $this->rincian->sum('agustus');
    }
    public function getTotalSeptemberAttribute()
    {
        return $this->rincian->sum('september');
    }
    public function getTotalOktoberAttribute()
    {
        return $this->rincian->sum('oktober');
    }
    public function getTotalNovemberAttribute()
    {
        return $this->rincian->sum('november');
    }
    public function getTotalDesemberAttribute()
    {
        return $this->rincian->sum('desember');
    }
    public function getTotalRAKAttribute()
    {
        return $this->total_januari +
            $this->total_februari +
            $this->total_maret +
            $this->total_april +
            $this->total_mei +
            $this->total_juni +
            $this->total_juli +
            $this->total_agustus +
            $this->total_september +
            $this->total_oktober +
            $this->total_november +
            $this->total_desember;
    }
}
