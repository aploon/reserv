<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;

class comptes extends Model implements Authenticatable
{
    use HasFactory;
    use BasicAuthenticatable;
    public $fillable= ['email','password'];
    /**
    * Get the password for the user.
    *
    * @return string
    */
   public function getAuthPassword()
   {
       return $this->password;
   }

}
