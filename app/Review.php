<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    public $timestamps = false;
    protected $guarded = [];

    public function impormation(){
        return $this->belongsTo('App\Information');
    }

    public function file(){
        return $this->hasMany('App\Review_file');
    }

    public function answer(){
        return $this->hasMany('App\Answer');
    }
}
