<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nom
 * @property string $prenom
 * @property string $sexe
 * @property string $telephone
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 * @property Compte[] $comptes
 * @property Reservation[] $reservations
 */
class Utilisateur extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['nom', 'prenom', 'sexe', 'telephone', 'email', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comptes()
    {
        return $this->hasMany('App\Models\Compte');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }
}
