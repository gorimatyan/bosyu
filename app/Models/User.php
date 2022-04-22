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
        'id',
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

    public function hasRecruitments(){
        return $this->hasMany(Recruitment::class);
    }

    // // Commentテーブルを中間テーブルとする多対多のリレーション
    public function recruitments(){
        return $this->belongsToMany(Recruitment::class,'comments','user_id','recruitment_id')
                    ->withPivot('comment')
                    ->withTimestamps();
    }

    public function userEntries(){
        return $this->belongsToMany(Recruitment::class,'user_entries','user_id','recruitment_id')
                    ->withPivot('message')
                    ->withTimestamps();
    }

    public function newNotices(){
        return $this->hasMany(NewNotice::class);
    }

    public function favoriteTags(){
        return $this->belongsToMany(Tag::class,'favorite_tags','user_id','tag_id')
                    ->withPivot('tag_id')
                    ->withTimestamps();
    }
}
