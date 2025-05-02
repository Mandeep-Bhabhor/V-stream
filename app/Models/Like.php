<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = "likes";

    protected $fillable = [
     'user_id',
     'video_id'
        ];



        public function video()
{
    return $this->belongsTo(Video::class);
}

}
