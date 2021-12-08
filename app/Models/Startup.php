<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Startup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'startups';


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class,'sector_startup','startup_id','sector_id')->withTimestamps();
    }

}
