<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $job_type
 * @property Job[] $jobs
 */
class JobTypes extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'job_type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobs()
    {
        return $this->hasMany('App\Job');
    }
}
