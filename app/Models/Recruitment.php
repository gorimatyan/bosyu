<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'people',
        'title',
        'number_of_people',
    ] ;

    // User：Recruimentの1：多のリレーション
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,'comments','recruitment_id','user_id')
                    ->withPivot('comment')
                    ->withTimestamps();
    }

    public function entry_users_users(){
        return $this->belongsToMany(User::class,'entry_users');
    }
}