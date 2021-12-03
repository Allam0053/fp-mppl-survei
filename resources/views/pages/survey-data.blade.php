@extends('layouts.app')

@section('navbar')
@include('components.sidenav', ['active' => "survey-data"])
@endsection

@section('content')

@if(Session::has('success'))
<div class="alert alert-success">
  {{Session::get('success')}}
</div>
@elseif(Session::has('error'))
<div class="alert alert-danger text-white">
  {{Session::get('error')}}
</div>
@endif

<div class="container mt-5">
  <div class="row">
    <div class="col-10">
      <h3>Pertanyaan Survei</h3>
    </div>
    <div class="col-2">
      <a href="{{ route('survey-data-form') }}" class="btn btn-primary">Tambah Pertanyaan</a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 mx-auto">
      <div class="position-relative border-radius-xl shadow-lg mb-7">
        <div class="overflow-scroll">
          <!-- Projects table -->
          <table class="table align-items-center table-flush" id="data-table">
            <thead class="thead-light">
              <tr class="text-center">
                <th scope="col" class="col-2">Nomor</th>
                <th scope="col" class="col-9">Pertanyaan</th>
                <th scope="col" class="col-1"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($surveys as $survey) <tr>
                <td class="text-center">
                  {{$survey->id}}
                </td>
                <td>
                  {{$survey->question}}
                </td>
                <td>
                  <button class="btn btn-success p-2" type="button"><i class="bi-pencil"></i></button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection