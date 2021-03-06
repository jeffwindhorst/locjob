<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\JobType;
use App\JobSkill;

/**
 * @property int $id
 * @property int $state_id
 * @property int $job_type_id
 * @property string $linkback
 * @property string $company
 * @property string $title
 * @property string $description
 * @property float $salary
 * @property string $created_at
 * @property string $updated_at
 * @property JobType $jobType
 * @property State $state
 * @property JobSkill[] $jobSkills
 */
class Job extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['city_id', 'job_type_id', 'linkback', 'company', 'title', 'description', 'salary', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jobType()
    {
        return $this->belongsTo('App\JobType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\City');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobSkills()
    {
        return $this->hasMany('App\JobSkill');
    }
}
