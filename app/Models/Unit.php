<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';

    protected $primaryKey = 'id_unit';

    public $timestamps = false;

    protected $fillable = [
        'screen_res',
        'refresh_rate',
        'screen_ratio',
        'price',
    ];
}
