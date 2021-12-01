<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $keyType = 'string';
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_description',
        'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function recruitments(){
    //     return $this->hasMany(Recruitment::class);
    // }

    public function recruitments(){
        return $this->belongsToMany(Recruitment::class,'comments','user_id','recruitment_id')
                    ->withPivot('comment')
                    ->withTimestamps();
    }

    public function user_entry_recruitments(){
        return $this->belongsToMany(Recruitment::class,'user_entry');
    }
}
