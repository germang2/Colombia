<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "articles";

    protected $fillable = [
        'title', 'content', 'video', 'date', 'seen'
    ];

    public function getShareds() {
        return $this->hasMany('App\Shared', 'article');
    }

}
