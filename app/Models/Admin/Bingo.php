<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bingo extends Model
{
    use HasFactory;

    protected $table = 'bingo';

    protected $fillable = [
        'name', 'code',
    ];
}
