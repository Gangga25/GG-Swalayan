<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Detail;
use App\Models\Customer;
use App\Models\User;
class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $primaryKey = 'nota';

    protected $keyType = 'string';

    protected $fillable = [
        'id_user',
        'id_user',
        'id_customer',
        'date',
    ];

    public function customer() {
        return $this->hasOne(Customer::class, 'id', 'id_customer');
    }

    public function detail() {
        return $this->hasMany(Detail::class, 'nota', 'nota');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
