<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rincian extends Model
{
    use HasFactory;
    protected $table = 'rincian';
    protected $guarded = ['id'];
    public $timestamps = false;
}
