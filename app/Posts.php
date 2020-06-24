<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use \Conner\Tagging\Taggable;
    use \Rinvex\Categories\Traits\Categorizable;
    use \Spatie\Translatable\HasTranslations;
    
    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatable = ['title', 'slug', 'body'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'cover_img', "body", "online"
    ];

    /**
     * The method that have relationship with another table in DB.
     */
    public function author() {
        return $this->belongsTo('App\User', 'author_id');
    }

    /**
     * The method retuns created_at time formated with ISO 8601.
     */
    public function create_time() {
        return $this->created_at->format('c');
    }
}
