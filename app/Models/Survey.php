<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = ["id", "question"];

    public function response()
    {
        return $this->hasMany(Response::class, 'survey_id', 'id');
    }
}
