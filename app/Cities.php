<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $state_id
 * @property int $name
 * @property float $latitude
 * @property float $longitude
 * @property string $created_at
 * @property string $updated_at
 * @property State $state
 */
class Cities extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['state_id', 'name', 'latitude', 'longitude', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
