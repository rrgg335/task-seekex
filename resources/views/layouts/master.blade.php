<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">
	<title>@yield('title') - {{ env('APP_NAME','Ball-Bucket System') }}</title>
	@yield('styles')
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-light justify-content-center">
		<ul class="navbar-nav">
			<li class="nav-item px-3">
				<a class="nav-link {{ request()->is('buckets*') ? 'active' : '' }}" href="{{ route('buckets.index') }}">Buckets</a>
			</li>
			<li class="nav-item px-3">
				<a class="nav-link {{ request()->is('balls*') ? 'active' : '' }}" href="{{ route('balls.index') }}">Balls</a>
			</li>
			<li class="nav-item px-3">
				<a class="nav-link {{ request()->is('current-placement*') ? 'active' : '' }}" href="{{ route('current-placement.index') }}">Current Placement</a>
			</li>
			<li class="nav-item px-3">
				<a class="nav-link {{ request()->is('bucket-suggestion*') ? 'active' : '' }}" href="{{ route('bucket-suggestion.index') }}">Place Balls</a>
			</li>
		</ul>
	</nav>
	@if(session()->has('success') || session()->has('error'))
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-10 mx-auto my-2">
					@if(session()->has('error') && !empty(session()->get('error')))
						<div class="alert alert-danger alert-dismissible fade show">
							<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
							{{ session()->get('error') }}
						</div>
					@endif
					@if(session()->has('success') && !empty(session()->get('success')))
						<div class="alert alert-success alert-dismissible fade show">
							<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
							{{ session()->get('success') }}
						</div>
					@endif
				</div>
			</div>
		</div>
	@endif
	@yield('content')
	@yield('modals')
	<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
	@yield('scripts')
</body>
</html>