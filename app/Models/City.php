<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lat',
        'lng',
        'priority',
    ];

    public static $INDEX_WITH = [
        'activities',
    ];

    public static $SHOW_WITH = [
        'activities',
        'activities.categories',
        'activities.categories.tags',
        'activities.tags',
        'priority'
    ];


    public static function boot() {
        parent::boot();


        static::created(function ($city) {
            self::updateCacheKeys($city);
        });
        static::updated(function ($city) {
            self::updateCacheKeys($city);
        });
        static::deleted(function ($city) {
            \Artisan::call('cache:clear');
        });

    }

    public static function updateCacheKeys(){
        cache()->forget('cities');

        cache()->rememberForever('cities', function () {
            return City::with(self::$INDEX_WITH)->orderBy('priority', 'desc')->get();
        });
    } 


    /**
     * RELATIONSHIP
     */

    public function activities(){
        return $this->hasMany(Activity::class)->orderBy('priority', 'desc');
    }

    public function users(){
        return $this->hasMany(User::class);
    }


}
