<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'title',
        'body',
    ];

    /**
     * Get the project that associated the page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project(){
        return $this->belongsTo(Project::class);
    }
}
