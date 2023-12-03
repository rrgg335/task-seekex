@extends('layouts.master')
@section('title','Buckets')
@section('styles')
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 my-3">
			<div class="mb-5">
				<h3 class="mb-0">Buckets <button type="button" class="float-end btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBucketModal">Add New</button></h3>
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
					@if(!$buckets->isEmpty())
						@foreach($buckets as $bucket)
						<tr>
							<td>{{ $bucket->name }}</td>
							<td>{{ $bucket->volume }} Cubic Inches</td>
							<td>
								<a href="javascript:void(0)" class="text-danger" confirm-href="{{ route('buckets.delete',$bucket->id) }}" confirm-text="Delete {{ $bucket->name }}?">Delete</a>
							</td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="3" class="text-center">
								No Buckets Yet. 
								<a href="javascript:void(0)" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addBucketModal">Add New</a>
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
<div id="addBucketModal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Bucket</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<form class="row" method="post" action="{{ route('buckets.create') }}">
					@csrf
					<div class="col-md-12 pt-3 pb-4">
						<div class="mb-4">
							<label for="bucket_name">Bucket Name</label>
							<input id="bucket_name" type="text" class="form-control" placeholder="Enter Bucket Name" name="bucket_name" required="required">
						</div>
						<div class="mb-4">
							<label for="bucket_volume">Bucket Volume</label>
							<div class="input-group">
								<input id="bucket_volume" type="number" step="0.01" class="form-control" placeholder="Enter Bucket Volume" min="0.01" name="bucket_volume" required="required">
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