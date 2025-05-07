<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'identity_no',
        'phone',
        'address',
        'city',
        'dob',
        'gender',
        'status',
        'nationality',
        'religion',
        'profile_picture',
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

    public function education_details(){
        return $this->hasMany(EducationDetail::class);
    }

    public function experience_details(){
        return $this->hasMany(ExperienceDetail::class);
    }

    public function skill_details(){
        return $this->hasMany(Skill::class);
    }

    public function language_details(){
        return $this->hasMany(LanguageDetails::class);
    }

    public function staff(){
        return $this->hasOne(Staff::class);
    }
}
 