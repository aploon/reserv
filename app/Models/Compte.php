<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $utilisateur_id
 * @property string $pseudo
 * @property string $email
 * @property string $type
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 * @property Utilisateur $utilisateur
 */
class Compte extends Model
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
    protected $fillable = ['utilisateur_id', 'pseudo', 'email', 'type', 'password', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function utilisateur()
    {
        return $this->belongsTo('App\Models\Utilisateur');
    }
}
