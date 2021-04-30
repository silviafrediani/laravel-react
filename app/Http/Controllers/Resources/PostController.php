<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Post;


class PostController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$term = $request->term;
		return new PostCollection(
			Post::with('author')
			->where('post_title', 'like', '%' . $term . '%')
			->orWhereHas('author', function (Builder $query) use ($term) {
				$query->where('name', 'like', '%' . $term . '%');
			})->paginate(30)
		);
	}
}
