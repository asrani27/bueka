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
}
