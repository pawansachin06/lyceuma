<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRoleEnum;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use UuidTrait;
    use TwoFactorAuthenticatable;

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'password', 'profile_photo_path',
        'username', 'email_verified_at', 'role', 'phone', 'phone_country',
        'phone_prefix',
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
        'role' => UserRoleEnum::class,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
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

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'user_pivot_classroom', 'user_id', 'classroom_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'user_pivot_subject', 'user_id', 'subject_id');
    }

    public function profilePhotoUrl(): Attribute
    {
        return Attribute::get(function () {

            $path = $this->profile_photo_path;

            if ($path != null && Storage::disk($this->profilePhotoDisk())->exists($path)) {
                return Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path);
            } elseif ($path != null && !empty($path)) {
                // Use Photo URL from Social sites link...
                return $path;
            } else {
                //empty path. Use defaultProfilePhotoUrl
                return $this->defaultProfilePhotoUrl();
            }
        });
    }

    public function isSuperAdmin()
    {
        if($this->role == UserRoleEnum::SUPERADMIN){
            return true;
        }
        return false;
    }

    public function isAdmin()
    {
        if($this->role == UserRoleEnum::ADMIN){
            return true;
        }
        return false;
    }

    public function isEditor()
    {
        if($this->role == UserRoleEnum::EDITOR){
            return true;
        }
        return false;
    }

    public function isTeacher()
    {
        if($this->role == UserRoleEnum::TEACHER){
            return true;
        }
        return false;
    }

    public function isStudent()
    {
        if($this->role == UserRoleEnum::STUDENT){
            return true;
        }
        return false;
    }
}
