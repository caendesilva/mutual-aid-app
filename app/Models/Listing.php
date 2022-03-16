<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // Update the user's position when their location is updated.
        // We still need to implement a way to run this automatically when
        // a user is created, without it affecting factory users as that slows
        // down the seeding. It's better to use FakerPHP to get the coordinates.
        static::updated(function ($listing) {
            if ($listing->isDirty('location')) {
                UpdateListingsGeospatialIndexEntry::dispatch($listing);
            }
        });
    }

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
     * Get the is_religious boolean status.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isReligious(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (bool) ($this->type == 'offer' && optional($this->metadata)->is_religious == true),
        );
    }

    /**
     * Get the is_closed boolean status.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isClosed(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (bool) ($this->closed_at != null),
        );
    }

    /**
     * Get the is_solved boolean status.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isSolved(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (bool) (optional($this->metadata)->is_resolved == true),
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
