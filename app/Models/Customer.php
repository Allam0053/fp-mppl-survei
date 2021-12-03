<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "name",
        "email",
        "occupation",
    ];

    public function response()
    {
        return $this->hasMany(Response::class, 'customer_id', 'id');
    }
}
