<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class utilisateurs extends Model 
{
    use HasFactory;
    public $fillable= ['nom','prenom','telephone','email','password', 'password_confirmation'];
}
