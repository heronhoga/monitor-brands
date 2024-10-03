<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;


    protected $table = 'brands';

    protected $timestamps = false;

    protected $primaryKey = 'id_brand';

    protected $fillable = [
        'name',
        'country',
        'id_legal',
        'establish_date',
    ];
}
