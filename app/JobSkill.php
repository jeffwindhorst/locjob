<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $job_id
 * @property string $skill
 * @property string $created_at
 * @property string $updated_at
 * @property Job $job
 */
class JobSkill extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['job_id', 'skill', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsToMany('App\Job', 'jobs', 'job_id', 'job');
    }
}
