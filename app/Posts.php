<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    public function author() {
        return $this->belongsTo('App\User', 'author_id');
    }
}
