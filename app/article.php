<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    //
    protected $table = 'articles';
    public function User(){
    	return $this->belongsTo('App\User');
    }
}
