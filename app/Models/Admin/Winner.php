<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Winner extends Model
{
    use HasFactory;

    protected $table = 'winners';

    protected $fillable = [
        'bingo_id', 'user_id',
    ];

    public function bingo()
    {
        return $this->belongsTo(Bingo::class, 'bingo_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
