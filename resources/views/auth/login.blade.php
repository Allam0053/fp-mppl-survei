@extends('layouts.auth')

@section('content')
<form role="form" action="{{ route('login') }}">
	@csrf

	<label>Email</label>
	<div class="mb-3">
		<input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" name="email">
	</div>
	<label>Password</label>
	<div class="mb-3">
		<input type="email" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" name="password">
	</div>
	<div class="form-check form-switch">
		<input class="form-check-input" type="checkbox" id="rememberMe" checked="">
		<label class="form-check-label" for="rememberMe">Remember me</label>
	</div>
	<div class="text-center">
		<button type="button" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
	</div>
</form>
@endsection