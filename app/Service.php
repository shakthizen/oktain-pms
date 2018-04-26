<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $appends = array(
        'taskCount'
    );
    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function getTaskCountAttribute(){
        return $this->tasks->count();
    }
}
