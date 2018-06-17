<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shared extends Model{
  protected $table = "shareds";
  protected $fillable = ['article', 'user', 'type', 'ip', 'shared', 'left'];
}
