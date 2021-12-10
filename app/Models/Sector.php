<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Sector extends Model
{
    use HasFactory,HasTranslations;

    public $translatable = ['sector_name'];
    protected $guarded = ['id'];
    protected $hidden = ['pivot'];


}
