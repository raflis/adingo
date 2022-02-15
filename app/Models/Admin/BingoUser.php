<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BingoUser extends Model
{
    use HasFactory;

    protected $table = 'bingo_users';

    protected $casts = [
        'numbers' => 'array',
    ];

    protected $fillable = [
        'user_id ', 'bingo_id ', 'numbers'
    ];
}
