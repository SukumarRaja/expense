<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Income extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'income';

    protected $fillable = [
        'category_name',
        'amount',
        'date',
        'user_id',
        'user_name',
        'user_email',
    ];
}
