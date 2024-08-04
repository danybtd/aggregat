<?php

namespace App\Models;

use App\Builders\UserBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;


/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static UserBuilder query()
 * @method static UserBuilder newQuery()
 */
class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @param  Builder  $query
     */
    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }
}
