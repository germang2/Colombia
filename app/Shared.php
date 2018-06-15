<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shared extends Model{
  protected $fillable = ['article', 'user', 'type', 'ip'];
}
