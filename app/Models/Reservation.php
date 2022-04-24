<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $materiel_id
 * @property integer $utilisateur_id
 * @property string $libelle
 * @property string $date_reservation
 * @property string $date_debut
 * @property string $date_fin
 * @property string $created_at
 * @property string $updated_at
 * @property Materiel $materiel
 * @property Utilisateur $utilisateur
 */
class Reservation extends Model
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
    protected $fillable = ['materiel_id', 'utilisateur_id', 'libelle', 'date_reservation', 'date_debut', 'date_fin', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materiel()
    {
        return $this->belongsTo('App\Models\Materiel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function utilisateur()
    {
        return $this->belongsTo('App\Models\Utilisateur');
    }
}
