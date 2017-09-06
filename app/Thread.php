<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model {

	protected $fillable = ['title', 'slug', 'body', 'user_id', 'category_id', 'article_id'];

    public function category()
    {
        return $this->belongsTo('App\ThreadCategory');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
