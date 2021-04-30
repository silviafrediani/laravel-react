@extends('layouts.admin')

@section('content')

	@csrf

	<h2>Users
	<a href="{{ route('users.create') }}" class="btn btn-outline-primary">Add user</a>
	</h2>
	@if (session()->has('messaggio'))
		<div>{{session()->get('messaggio')}}</div>
	@endif

	<table class="table" id="posts-table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Email</th>
				<th scope="col">Created at</th>
				<th scope="col">Updated at</th>
				<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>

			@foreach ($users as $user)
			<tr>
				<td>
					{{ $user->id }}
				</td>
				<td>
					{{ $user->name }}
				</td>
				<td>
					{{ $user->email }}
				</td>
				<td>
					{{ $user->created_at->format('d/m/Y H:i') }}
				</td>
				<td>
					{{ $user->updated_at->format('d/m/Y H:i') }}
				</td>
			</tr>
			@endforeach

		</tbody>
	</table>

	@if ($users->hasPages())

		{{ $users->links('vendor.pagination.bootstrap-4') }}

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

