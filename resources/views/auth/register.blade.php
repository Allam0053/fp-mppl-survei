@extends('layouts.auth')

@section('content')
<form role="form" method="POST" action="{{ route('register') }}">
    @csrf

    <label>Nama</label>
    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="name-addon" name="name">
    </div>
    <label>Email</label>
    <div class="mb-3">
        <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" name="email">
    </div>
    <label>Password</label>
    <div class="mb-3">
        <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" name="password">
    </div>
    <label>Ulangi Password</label>
    <div class="mb-3">
        <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" name="password_confirmation">
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
        <label class="form-check-label" for="rememberMe">Ingat Saya</label>
    </div>
    <div class="text-center">
        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Daftar</button>
    </div>
</form>
@endsection