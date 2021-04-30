<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;

	protected $dates = [
		'post_date',
	];

	protected $fillable = [
		'id',
		'post_title',
		'post_content',
		'post_author',
		'post_date',
		'post_status',
		'post_excerpt'
	];

	public function author()
	{
		// vedi /database/migrations/create_posts_table campo post_author
		return $this->belongsTo(User::class, 'post_author');
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'post_category');
	}

}
