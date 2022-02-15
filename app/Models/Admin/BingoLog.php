<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BingoLog extends Model
{
    use HasFactory;

    protected $table = 'bingo_logs';

    protected $fillable = [
        'bingo_id', 'number',
    ];
}
