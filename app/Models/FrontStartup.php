<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontStartup extends Model
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
        return $this->belongsTo(FrontCity::class,'city_id');
    }

    public function sectors()
    {
        return $this->belongsToMany(FrontSector::class,'sector_startup','startup_id','sector_id')
            ->withTimestamps();
    }

    public function deals()
    {
        return $this->hasMany(FrontDeal::class,'startup_id');
    }

}

