<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "users";

    protected $fillable = [
      'name',
      'email',
      'password',
      'role',
        ];


        public function like()
{
    return $this->hasMany(\App\Models\Like::class);
}



    public function audit()
{
    return $this->hasMany(\App\Models\Audit::class);
}
    // Add your other properties and methods here
}
