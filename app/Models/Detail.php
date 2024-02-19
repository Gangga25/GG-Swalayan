<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'details';

    protected $primaryKey = 'id';

    protected $keyType = 'integer';

    protected $fillable = [
        'id',
        'nota',
        'id_stuff',
        'count',
        'price',
        'discount',

    ];
}
