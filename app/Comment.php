<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    protected $table = 'answers';
    protected $fillable = ['body', 'thread_id', 'user_id', 'likes'];

    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}