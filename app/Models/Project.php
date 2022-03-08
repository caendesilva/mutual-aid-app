<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Base class for Requests and Offers
 */
class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'subject',
        'location',
        'body',
        'expires_at',
        'resources',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expires_at' => 'datetime',
        'resources' => 'array',
    ];

    /**
     * Get the user that owns the Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
    /**
     * Get the created_at date in a more human friendly form.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function niceDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($this->created_at->isToday() 
                ? 'Today at ' . $this->created_at->format('g:ia')
                : ($this->created_at->isYesterday() ? 'Yesterday at ' . $this->created_at->format('g:ia')
                : $this->created_at->format('Y-m-d H:i'))),
        );
    }
}
