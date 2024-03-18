<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Stuff;
use App\Models\Transaction;
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

    public function stuff() {
        return $this->hasOne(Stuff::class, 'id', 'id_stuff');
    }

    public function transaction() {
        return $this->hasMany(Transaction::class, 'nota', 'nota');
    }
}
