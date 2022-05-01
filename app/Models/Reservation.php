<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $materiel_id
 * @property integer $user_id
 * @property string $nom
 * @property string $description
 * @property string $date_debut
 * @property string $date_fin
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Materiel $materiel
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
    protected $fillable = ['materiel_id', 'user_id', 'nom', 'description', 'date_debut', 'date_fin', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materiel()
    {
        return $this->belongsTo('App\Models\Materiel');
    }
}
