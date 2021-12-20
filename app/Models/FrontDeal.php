<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FrontDeal extends Model
{
    use HasFactory,HasTranslations;

    protected $table = 'deals';
    public $translatable = ['deal_name','deal_description'];
    protected $guarded = ['id'];

    public function toArray()
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, app()->getLocale());
        }
        return $attributes;
    }

    public function startup()
    {
        return $this->belongsTo(Startup::class);
    }
}
