@extends('layouts.app')

@section('navtext')
@include('components.navbar', ['page' => 'Halaman Survei'])
@endsection

@section('content')
<section>
<div class="text-center mt-12">
<br>
<br>
<div class="d-flex flex-row justify-content-center">
    <img src="https://www.freeiconspng.com/thumbs/survey-icon/survey-icon-12.png" alt="Logo ITS" height="175px">
    <div class="d-flex flex-column align-items-center">
        <h2 class="align-self-start fontku">Survei </h2>
        <h2 class="align-self-start ">Pelanggan ITS</h2>
        <div class="butttton d-flex flex-row buton">
            <a href="/isi-survey">
                <div class="btn btn-primary-outline align-self-start flex-fill buton">Mulai</div>
            </a>
        </div>
        
    </div>
</div>
</div>    
</section>   
@endsection