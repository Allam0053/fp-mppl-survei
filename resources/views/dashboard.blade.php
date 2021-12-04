@extends('layouts.app')

@section('navtext')
@include('components.navbar', ['page' => 'Dashboard'])
@endsection

@section('navbar')
@include('components.sidenav', ['active' => "dashboard", 'survey_data' => ''])
@endsection

@section('content')
    <div class="p-6 bg-white border-b border-gray-200">
        Selamat Datang Admin, {{Auth::User()->name}}
    </div>
@endsection
