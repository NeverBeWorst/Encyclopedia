<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomCreature extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'img',
        'mythology',
        'habitat',
        'short_description',
        'description',
    ];
}
