@extends('layouts.master')
@section('title','Bucket Suggestion')
@section('styles')
@endsection
@section('content')
<div class="container-fluid">
	<form class="row" method="post" action="{{ route('bucket-suggestion.create') }}">
		@csrf
		<div class="col-md-10 mx-auto">
			<div class="row">
				<div class="col-md-12 my-3">
					<h3 class="mb-0">Bucket Suggestion</h3>
				</div>
				@if(!empty($balls) && !$balls->isEmpty())
					<div class="col-md-12 my-3">
						@foreach($balls as $ball)
							<div class="mb-4">
								<div class="input-group">
									<span class="input-group-text">{{ $ball->name }} Balls</span>
									<input type="number" step="1" class="form-control" placeholder="Enter Ball Volume" min="0" value="0" name="ball_volume[{{ $ball->id }}]" required="required">
								</div>
							</div>
						@endforeach
					</div>
					<div class="col-md-4 mx-auto mt-3">
						<button type="submit" class="btn w-100 btn-primary">Place Balls in Bucket</button>
					</div>
				@else
				<div class="col-md-12 my-3">
					No Balls Added Yet. <a href="{{ route('balls.index') }}">Add Now</a>
				</div>
				@endif
				@if($errors->any())
					<div class="col-md-10 mx-auto mt-3 text-center">
						@foreach($errors->all() as $error)
							<p class="mb-1 text-danger">{{ $error }}</p>
						@endforeach
					</div>
				@endif
			</div>
		</div>
	</form>
</div>
@endsection
@section('modals')
@endsection
@section('scripts')
@endsection