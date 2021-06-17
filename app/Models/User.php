<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Group;
use Laravel\Passport\HasApiTokens;
use App\Traits\FullTextSearch;
class User extends Authenticatable
{
    use HasFactory,Notifiable, HasApiTokens,FullTextSearch;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'c_name','user','avatar', 'email',
        'provider', 'provider_id', 'password', 'remember_token',
    ];

    protected $searchable = [
        'c_name',
        'user'
    ];

    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function groups()
    {
        return $this->belongsToMany(Group::class)->withTimestamps();
    }
}
