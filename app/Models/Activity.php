<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'is_completed',
        'date',
        'activity_no',
        'image',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function getImageAttribute($value)
    {
        return url('storage/'.$value);
    }

    /**
     * Get the user that owns the Activity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get unique activity number
     *
     * @param  string  $prefix
     * @return string
     */
    public static function generateUniqueActivityNo(string $prefix = ''): string
    {
        $reference = (empty($prefix) ? '' : "{$prefix}:").time().rand(1000, 9999);

        if (self::where('activity_no', $reference)->exists()) {
            return self::generateReference($prefix);
        }

        return $reference;
    }

    public function scopeGetGlobal($query)
    {
        return $query->whereNotNull('activity_no');
    }
}
