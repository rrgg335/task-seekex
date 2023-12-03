@extends('layouts.master')
@section('title','Ball Types')
@section('styles')
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 my-3">
			<div class="mb-5">
				<h3 class="mb-0">Ball Types <button type="button" class="float-end btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBallModal">Add New</button></h3>
			</div>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Volume</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@if(!$balls->isEmpty())
						@foreach($balls as $ball)
						<tr>
							<td>{{ $ball->name }}</td>
							<td>{{ $ball->volume }} Cubic Inches</td>
							<td>
								<a href="javascript:void(0)" class="text-danger" confirm-href="{{ route('balls.delete',$ball->id) }}" confirm-text="Delete {{ $ball->name }}?">Delete</a>
							</td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="3" class="text-center">
								No Ball Types Yet. 
								<a href="javascript:void(0)" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addBallModal">Add New</a>
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('modals')
<div id="addBallModal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Ball Type</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<form class="row" method="post" action="{{ route('balls.create') }}">
					@csrf
					<div class="col-md-12 pt-3 pb-4">
						<div class="mb-4">
							<label for="ball_name">Ball Type Name</label>
							<input id="ball_name" type="text" class="form-control" placeholder="Enter Ball Name" name="ball_name" required="required">
						</div>
						<div class="mb-4">
							<label for="ball_volume">Ball Volume</label>
							<div class="input-group">
								<input id="ball_volume" type="number" step="0.01" class="form-control" placeholder="Enter Ball Volume" min="0.01" name="ball_volume" required="required">
								<span class="input-group-text">Cubic Inches</span>
							</div>
						</div>
					</div>
					<div class="col-md-8 mx-auto">
						<div class="row">
							<div class="col-md-6">
								<button type="submit" class="btn w-100 btn-primary">Add</button>
							</div>
							<div class="col-md-6">
								<button type="button" class="btn w-100 btn-danger" data-bs-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
@endsection