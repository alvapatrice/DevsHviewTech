<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected $table = 'tags';

    protected $fillable = ['title', 'slug', 'description'];


    /**
     * Each tag can have multiple posts
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'article_tag','tag_id', 'article_id');
    }
}
