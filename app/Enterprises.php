<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprises extends Model
{
    protected $table = 'enterprises';

    public function restorant()
    {
        return $this->hasMany('App\Restorant','enterprise_id','id');
    }

}
