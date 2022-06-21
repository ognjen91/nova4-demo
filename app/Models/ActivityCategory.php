<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
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



    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'activity_activity_category');
    }

}
