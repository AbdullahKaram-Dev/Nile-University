<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FrontSector extends Model
{
    use HasFactory,HasTranslations;
    
    public $translatable = ['sector_name'];
    protected $guarded = ['id'];
    protected $table = 'sectors';

    public function toArray()
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, app()->getLocale());
        }
        return $attributes;
    }
}
