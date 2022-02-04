<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
    protected $table = 'bank_details';

    public function bank()
    {
        return $this->belongsTo('App\Banks');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
