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
        'user_id',
        'people',
        'title',
        'number_of_people',
    ] ;

    // User：Recruimentの1：多のリレーション
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    // Commentテーブルを中間テーブルとする多対多のリレーション
    public function users(){
        return $this->belongsToMany(User::class,'comments','recruitment_id','user_id')
                    ->withPivot('comment')
                    ->withTimestamps();
    }

    public function userEntries(){
        return $this->belongsToMany(User::class,'user_entry','recruitment_id','user_id')
                    ->withPivot('message');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class)
                     ->withPivot('user_id');
    }
}