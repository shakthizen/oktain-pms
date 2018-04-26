<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function service(){
        return $this->belongsTo(Service::class);
    }
}
