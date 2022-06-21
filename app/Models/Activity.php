<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'title',
        'description',
        'lat',
        'lng',
        'is_free',
        'price',
        'is_active',
    ];


    public static function boot() {
        parent::boot();
    
        static::created(function ($activity) {
            self::updateCacheKeys();
        });
        static::updated(function ($activity) {
            self::updateCacheKeys();
        });
        static::deleted(function ($activity) {
            \Artisan::call('cache:clear');
        });

    }

    public static function updateCacheKeys(){
        City::updateCacheKeys();
    } 



    /**
     * RELATIONSHIPS
     */

    public function categories()
    {
        return $this->belongsToMany(ActivityCategory::class, 'activity_activity_category');
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

}
