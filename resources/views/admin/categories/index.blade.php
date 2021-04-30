@extends('layouts.admin')

@section('content')

	@csrf

	<h2>Categories
	<a href="{{ route('categories.create') }}" class="btn btn-outline-primary">Add category</a>
	</h2>
	@if (session()->has('messaggio'))
		<div>{{session()->get('messaggio')}}</div>
	@endif

	<table class="table" id="posts-table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Created at</th>
				<th scope="col">Updated at</th>
				<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>

			@foreach ($categories as $category)
			<tr>
				<td>
					{{ $category->id }}
				</td>
				<td>
					{{ $category->name }}
				</td>
				<td>
					{{ $category->created_at->format('d/m/Y H:i') }}
				</td>
				<td>
					{{ $category->updated_at->format('d/m/Y H:i') }}
				</td>
			</tr>
			@endforeach

		</tbody>
	</table>

	@if ($categories->hasPages())

		{{ $categories->links('vendor.pagination.bootstrap-4') }}

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


	});
	</script>
@endsection

