@extends('layouts.master')
@section('title','Current Placement')
@section('styles')
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 my-3">
			<div class="mb-5">
				<h3 class="mb-0">Current Placement <a href="javascript:void(0)" class="float-end btn btn-danger" confirm-href="{{ route('current-placement.clear-all') }}" confirm-text="Clear All Buckets?">Clear All Buckets</a></h3>
			</div>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Bucket Name</th>
						<th>Balls</th>
						<th>Total Volume</th>
						<th>Filled Volume</th>
						<th>Empty Volume</th>
					</tr>
				</thead>
				<tbody>
					@if(!empty($ballsinbuckets) && !$ballsinbuckets->isEmpty())
						@foreach($ballsinbuckets as $ballsinbucket)
						<tr>
							<td>
								{{ $ballsinbucket->first()->bucket->name }}
							</td>
							<td>
								{{ implode(', ',$ballsinbucket->map(function($ball){
									return $ball->full_value = $ball->amount.' '.$ball->ball->name.' Balls';
								})->toArray()) }}
							</td>
							<td>
								{{ floatval($ballsinbucket->first()->bucket->volume) }} Cubic Inches
							</td>
							<td>
								{{ floatval($ballsinbucket->first()->bucket->filledVolume()) }} Cubic Inches
							</td>
							<td>
								{{ floatval($ballsinbucket->first()->bucket->emptyVolume()) }} Cubic Inches
							</td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="5" class="text-center">
								No Balls are put in Buckets Yet.
								<a href="{{ route('bucket-suggestion.index') }}" class="text-decoration-none">Place Now</a>
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('scripts')
@endsection