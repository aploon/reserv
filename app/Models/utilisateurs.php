<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;


class utilisateurs extends Model implements Authenticatable
{
    use HasFactory;
    use BasicAuthenticatable;
    public $fill= ['email','password'];
    public $fillable= ['nom','prenom','telephone','email','password', 'password_confirmation'];
}
