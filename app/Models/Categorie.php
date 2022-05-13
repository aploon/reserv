<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nom
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property Materiel[] $materiels
 */
class Categorie extends Model
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
    protected $fillable = ['nom', 'description', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materiels()
    {
        return $this->hasMany('App\Models\Materiel', 'categorie_id');
    }
}
