<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Video extends Model
{
    use Notifiable;

    protected $table = "videos";

    protected $fillable = [
      'title',
      'resolution',
      'uploader_id',
      'description',
      'duration',
      
        ];

}
