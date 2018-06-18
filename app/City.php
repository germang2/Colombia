<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model{
  protected $fillable = ['name', 'state'];

  public function getState(){
    return $this->belongsTo('App\State', 'state');
  }
}
