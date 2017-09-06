<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ThreadCategory extends Model {

	protected $fillable = ['title', 'slug', 'description'];

    public function thread()
    {
        return $this->hasMany('App\Thread', 'category_id');
    }

}
