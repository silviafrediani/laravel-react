@extends('layouts.admin')

@section('content')

	@csrf

	<h2>{{ $editing ? 'Edit post #'.$post->id : 'Create post' }}</h2>

	@include('partials.messages_errors')

	<form action="{{ $editing ? route('admin.posts.update', $post->id) : route('admin.posts.store') }}" method="post" enctype="multipart/form-data">

		<div class="form-group">
			<label for="post_title">Title</label>
			<input type="text" class="form-control @error('post_title') is-invalid @enderror" name="post_title" value="{{ old('post_title', $post->post_title) }}">
			@error('post_title')
				<div class="invalid-feedback">Campo obbligatorio.</div>
			@enderror		
		</div>
		<div class="form-group">
			<label for="post_content">Content</label>
			<textarea class="form-control" name="post_content">{{ old('post_content', $post->post_content) }}</textarea>
		</div>
		<div class="form-group">
			<label for="post_excerpt">Excerpt</label>
			<textarea class="form-control" name="post_excerpt">{{ old('post_excerpt', $post->post_excerpt) }}</textarea>
		</div>
		<div class="form-group">
			<label for="post_status">Status</label>
			<select class="form-control" name="post_status" id="post_status">
				<option value="">Select</option>
				@foreach($statuses as $status)
					<option value="{{$status}}" {{ (old('post_status') == $status || $post->post_status == $status ) ? 'selected=' : '' }}>{{$status}}</option>
				@endforeach()				
			</select>
		</div>
		<div class="form-group wrapper-pickadate" style="display: none;">
			<label for="">Choose date and time</label>
			<div class="d-flex">
				<div class="d-inline">
					<input id="date_scheduled" name="date_scheduled" type="text" class="datepicker form-control" placeholder="Choose date..." autocomplete="new-data" />
				</div>
				<div class="d-inline">
					<input type="time" name="time_scheduled" id="time_scheduled" class="form-control" value="" />
				</div>
			</div>
		</div>
		<input type="hidden" value="" name="date_time_scheduled" id="date_time_scheduled" />

		@include('partials.categories_select')
		@csrf

		@if($editing)
			@method('PATCH')		
		@endif

		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

@endsection

@section('scripts')
	@parent
	<script type="text/javascript">

	$(document).ready( function () {

		$('#date_scheduled').pickadate({
			firstDay: 1,
			min: new Date(),
			onClose: function()	{
				this.$holder.blur();
			}
		});

		var dateScheduled$input = $('#date_scheduled').pickadate();
		var dateScheduledpicker = dateScheduled$input.pickadate('picker');

		dateScheduledpicker.on('set', function(event)	{
			if (event.select)	{
				var dataP = new Date( dateScheduledpicker.get('select', 'yyyy-mm-dd') );
				var dateS = dataP.toISOString().substring(0,10);
				var timeS = $('#time_scheduled').val();
				$('#date_time_scheduled').val( dateS + ' ' + timeS );
			}
			else if ('clear' in event) {
				return;
			}
		});

		$('#time_scheduled').on('change', function() {
			var dataP = new Date( dateScheduledpicker.get('select', 'yyyy-mm-dd') );
			var dateS = dataP.toISOString().substring(0,10);
			var timeS = $('#time_scheduled').val();
			$('#date_time_scheduled').val( dateS + ' ' + timeS );
		});

		$('#post_status').on('change', function() {
			if ( $(this).val() == 'scheduled') {
				$('.wrapper-pickadate').show();
			} else {
				$('.wrapper-pickadate').hide();
			}
		});

	});
	</script>
@endsection

