<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Illuminate\Database\Eloquent\Relations\BelongsTo; // MANY TO ONE
use Illuminate\Database\Eloquent\Relations\HasMany; // ONE TO MANY
use Illuminate\Database\Eloquent\Relations\HasOne; // ONE TO ONE

class Stuff extends Model
{
    use HasFactory;

    protected $table = 'stuffs';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'price',
        'unit',
        'image',
        'status',
        'id_category',

    ];

    function category() {
        return $this->HasOne(Category::class, 'id', 'id_category');
    }

    function detail() {
        return $this->hasMany(Detail::class, 'id_stuff', 'id');
    }

}
