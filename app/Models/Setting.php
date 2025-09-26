<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    /** @use HasFactory<\Database\Factories\SettingFactory> */
    use HasFactory;

    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        // Clear cache whenever a setting is updated, created, or deleted
        static::saved(function () {
            Cache::forget('app_settings');
        });

        static::deleted(function () {
            Cache::forget('app_settings');
        });
    }


    /**
     * Get all settings as a key-value array, cached.
     */
    public static function getCollection()
    {
        return Cache::remember('app_settings', 3600, function () {
            return static::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Get a single setting by key, with optional default.
     */
    public static function get($key, $default = null)
    {
        return self::getCollection()[$key] ?? $default;
    }

    /**
     * Set a setting (doesn't save to DB — use model for that)
     */
    public static function set($key, $value)
    {
        // This only updates DB; cache will auto-clear and reload
        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    /**
     * Search settings by comment (useful for admin panel)
     */
    public static function searchByComment($query)
    {
        return self::where('comment', 'LIKE', "%{$query}%")->get();
    }

}
