<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

	protected $fillable = [
		'title',
		'body',
		'published_at',
		'user_id'
	];

	protected $dates = ['published_at'];
	protected $table = 'pages';

	public function setPublishedAttribute($date)
	{
		$this->attributes['published_at'] = Carbon::parse($date);
	}

	/**
	 * An article is owned by a user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * Get the tags associated with the given page.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany('App\Tag')->withTimestamps();
	}

	/**
	 * Get a list of tag ids associated with the current page.
	 *
	 * @return mixed
	 */
	public function getTagListAttribute()
	{
		return $this->tags->Lists('id');
	}
}
