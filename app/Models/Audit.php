<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
      protected $table = "Audits";

    protected $fillable = [
     'user_id',
     'logout_time',
        ];

 public function user()
{
    return $this->belongsTo(User::class,'user_id');
}
}   
