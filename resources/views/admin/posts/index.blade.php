@extends('layouts.admin')

@section('content')

	@csrf

	<h2>Posts
	<a href="{{ route('admin.posts.create') }}" class="btn btn-outline-primary">Add post</a>
	</h2>
	@if (session()->has('messaggio'))
		<div>{{session()->get('messaggio')}}</div>
	@endif

	<table class="table" id="posts-table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Title</th>
				<th scope="col">Author</th>
				<th scope="col">Category/ies</th>
				<th scope="col">Status</th>
				<th scope="col">Created at</th>
				<th scope="col">Updated at</th>
				<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>

			@foreach ($posts as $post)
			<tr>
				<td>
					{{ $post->id }}
				</td>
				<td>
					{{ $post->post_title }}
				</td>
				<td>
					{{ $post->author->name }}
				</td>
				<td>
					<ul>
					@if ($post->categories->count())
						@foreach($post->categories as $category)
							<li>{{$category->name}}</li>
						@endforeach
					@else
						No categories found
					@endif
					</ul>
				</td>
				<td>
					{{ $post->post_status }}
				</td>
				<td>
					{{ $post->created_at->format('d/m/Y H:i') }}
				</td>
				<td>
					{{ $post->updated_at->format('d/m/Y H:i') }}
				</td>
				<td>
					<a class="btn btn-primary button-edit" href="{{route('admin.posts.edit',$post->id)}}">UPDATE</a>
				</td>
			</tr>
			@endforeach

		</tbody>
	</table>

	@if ($posts->hasPages())

		{{ $posts->links('vendor.pagination.bootstrap-4') }}

	@endif

@endsection

@section('scripts')
	@parent
	<script type="text/javascript">
	function validazione() {
		if( confirm('Confermi eliminazione?') ) {
			return true;
		}
		return false;
	}
	$(document).ready( function () {

		console.log('js admin posts index');	

	});
	</script>
@endsection

