<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewNotice extends Model
{
    use HasFactory;

    // NewNoticeとUserの
    public function user(){
        return $this->belongsTo(User::class);
    }
}
