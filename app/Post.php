<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $table = 'articles';

	protected $fillable = ['title', 'slug', 'image', 'body'];

    public function getDates()
    {
        return ['created_at', 'updated_at', 'published_at'];
    }

    public function setPublishedAtAttribute($date)
    {
        try
        {
            $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
        }
        catch(\Exception $e)
        {
            $this->attributes['published_at'] = $date;
        }
    }

    /**
     * An article is owned by a user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Every article must have a category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Each article can have multiple tags
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag','article_tag','article_id','tag_id');
    }

    /**
     * Get the selected tag on edit the post
     */
    public function getTagListAttribute()
    {
        return $this->tags->lists('id');
    }

}
