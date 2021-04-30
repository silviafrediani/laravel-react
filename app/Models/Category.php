<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
			
		public function posts()
		{
			/*
				to determine the table name of the relationship's joining table, 
				Eloquent will join the two related model names in alphabetical order. 
				However, you are free to override this convention. 
				You may do so by passing a second argument to the belongsToMany method:			
			*/
			/*
			The third argument is the foreign key name of the model on which you are defining the relationship (category),
			 while the fourth argument is the foreign key name of the model that you are joining to (post):			
			*/
			/* many-to-many relationship -> 1 post + categorie / 1 categoria + posts */
			return $this->belongsToMany(Post::class, 'post_category');
			// return $this->belongsToMany(Post::class, 'post_category', 'category_id', 'post_id');
		}

}
