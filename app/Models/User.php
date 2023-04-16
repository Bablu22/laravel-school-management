<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property mixed $email
 * @property mixed $password
 * @property mixed $role
 * @property mixed $name
 * @property int|mixed $status
 * @property mixed $phone
 * @property mixed|string $profile_photo_path
 * @property mixed $gender
 * @property mixed $address
 * @property mixed $code
 * @property mixed $father_name
 * @property mixed $mother_name
 * @property mixed $religion
 * @property mixed $date_of_birth
 * @property mixed $discount
 * @property mixed $year_id
 * @property mixed|string $id_no
 * @property mixed|string $usertype
 * @property mixed|string $roll
 * @method static max(string $string)
 * @method static findOrFail($id)
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'role', 'profile_photo_path', 'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
