<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Events\PostCreated;
use App\Jobs\SchedulePost;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$user = User::find(Auth::user()->id);
			if($user->isAdmin()) {
				$posts = Post::orderBy('id')->with('author','categories')->paginate(20);
			} else {
				$posts = $user->posts()->orderBy('id')->with('author', 'categories')->paginate(20);
			}

			return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::get();
		  return view('admin.posts.create_update', [
				'editing' => false,
				'post' => new Post(),
				'categories' => $categories,
				'selectedCategories' => array(),
				'statuses' => array('published','scheduled','draft'),
			]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
		  date_default_timezone_set('Europe/Rome');
			$post = new Post();
			$post->post_title = $request->input('post_title');
			$post->post_content = $request->input('post_content');
			$post->post_excerpt = $request->input('post_excerpt');
			$post->post_status = $request->input('post_status');
			if ($request->input('post_status') == 'scheduled') {
				$post->date_scheduled =	$request->input('date_time_scheduled');
			}
			$post->post_author = Auth::user()->id;

			$response = $post->save();
			// se l'inserimento va a buon fine attacchiamo le categories e "spediamo" evento PostCreated
			if ($response) {
				if ($request->has('categories')) {
					$post->categories()->attach($request->input('categories'));
				}
				// dispatch event
				event( new PostCreated($post) );
			}
			$messaggio = $response ? 'Post saved.' : 'Post not created.';
			session()->flash('messaggio', $messaggio);
			return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
			if (Gate::denies('update-post', $post)) {
				abort(403);
			}			
		  $categories = Category::get();
			$selectedCategories = $post->categories->pluck('id')->toArray();

			return view('admin.posts.create_update', [
				'editing' => true,
				'post' => $post,
				'categories' => $categories,
				'selectedCategories' => $selectedCategories,
				'statuses' => array('published', 'scheduled', 'draft'),
			]);
  
		}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\PostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
			date_default_timezone_set('Europe/Rome');
			$post->post_title = $request->input('post_title');
			$post->post_content = $request->input('post_content');
			$post->post_excerpt = $request->input('post_excerpt');
			$post->post_status = $request->input('post_status');
			if ($request->input('post_status') == 'scheduled') {
				$post->date_scheduled =	$request->input('date_time_scheduled');
			}
			$post->post_author = Auth::user()->id;

			$response = $post->save();
			// se l'inserimento va a buon fine attacchiamo le categories e "spediamo" evento PostCreated
			if ($response) {
				if ($request->has('categories')) {
					$post->categories()->sync($request->input('categories'));
				}
				// dispatch event
				event(new PostCreated($post));
			}
			$messaggio = $response ? 'Post updated.' : 'Post not updated.';
			session()->flash('messaggio', $messaggio);
			return redirect()->route('admin.posts.index');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
			$response = $post->delete();
			return $response;
    }
}
