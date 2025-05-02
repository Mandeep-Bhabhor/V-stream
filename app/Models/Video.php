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
      'video',
      'resolution',
      'uploader_id',
      'description',
      'duration',
      'status', // 'pending', 'approved', 'rejected'
      
        ];

        // app/Models/Video.php

public function uploader()
{
    return $this->belongsTo(User::class, 'uploader_id');
}
public function likes()
{
    return $this->hasMany(Like::class);
}


}
