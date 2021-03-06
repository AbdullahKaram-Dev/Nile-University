<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Deal extends Model
{
    use HasFactory,HasTranslations;

    protected $table = 'deals';
    public $translatable = ['deal_name','deal_description'];
    protected $guarded = ['id'];

}
