<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Startup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'startups';

    
    public function sectors()
    {
        return $this->belongsToMany(Sector::class,'sector_startup','startup_id','sector_id')->withTimestamps();
    }

}
