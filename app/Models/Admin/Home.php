<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    protected $table = 'homes';

    protected $casts = [
        'home_carousel' => 'array',
        'footer_info' => 'array',
    ];

    protected $fillable = [
        'home_title', 'home_carousel', 'aboutus_title', 'aboutus_description', 'aboutus_video',
        'footer_info', 'footer_description', 'facebook', 'linkedin', 'youtube',
    ];
}
