@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">

					<div id="react-posts"></div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
	@parent
	<!-- Load our React component. -->
	<script src="{{ asset('js/react-posts.js') }}"></script>
@endsection


