<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    public function comments_users(){
        return $this->belongsToMany(Users::class,'comments');
    }

    public function entry_users_users(){
        return $this->belongsToMany(Users::class,'entry_users');
    }
}