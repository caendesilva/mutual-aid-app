<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Project to Listing Migration Notes:
 *
 * The expires_at column and religion filters have been removed.
 * Instead, these attributes are reccomended to be added in the guarded
 * metadata property. The User id is now also a guarded property.
 */
class Listing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'location',
        'contacts',
        'body',
        'type',
        'resources',
        'closed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'resources' => 'array',
        'metadata' => 'object',
        'closed_at' => 'datetime',
    ];

    /**
     * =================
     * | Relationships |
     * =================
     */

    /**
     * Get the user that created the Listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
    /**
     * ==============
     * | Attributes |
     * ==============
     */

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

    /**
     * =========
     * | Other |
     * =========
     */

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'subject' => $this->subject,
            'location' => $this->location,
            'resources' => explode(' ', $this->resources),
            'body' => $this->body,
        ];
    }
}
