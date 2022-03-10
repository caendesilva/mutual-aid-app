<?php

namespace App\Models;

use App\Core\LocationService;
use App\Core\Roles;
use App\Jobs\UpdateUsersGeospatialIndexEntry;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    use Roles;

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
        static::updated(function ($user) {
            if ($user->isDirty('area') || $user->isDirty('location')) {
                UpdateUsersGeospatialIndexEntry::dispatch($user);
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'area',
        'location',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get all of the projects for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get all of the requests for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Request::class);
    }

    /**
     * Get all of the offers for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Offer::class);
    }

    /**
     * The roles that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get the user's roles as a comma separated list.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function roleList(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => implode(', ', $this->roles()->pluck('name')->toArray()),
        );
    }

    /**
     * Get the user's position from the Geospatial index.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function position(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => LocationService::getUserPositionFromGeospatialIndex($this),
        );
    }
}
