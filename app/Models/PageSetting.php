<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSetting extends Model
{
    protected $table = 'page_settings';

    protected $fillable = [
        'banner_image',
        'about_us',
        'mission',
        'vision',
        'phone',
        'email',
        'address',
        'facebook',
        'instagram',
        'youtube',
    ];
}