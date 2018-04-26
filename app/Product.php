<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function project(){
        return $this->belongsTo(Project::class);
    }
}
