@extends('layouts.app')

@section('navbar')
@include('components.sidenav', ['active' => "survey-data"])
@endsection

@section('content')

<div class="card mt-4 z-index-0">
  <div class="card-header text-center pt-4">
    <h5>Form Edit Pertanyaan</h5>
  </div>
  <div class="card-body">
    <form role="form text-left" method="POST" action="{{ route('survey-data-put', ['id' => $survey->id]) }}">
      @method('PUT')
      @csrf
      <div class="form-group">
        <label>Pertanyaan</label>
        <input type="text" class="form-control {{ $errors->has('question') ? 'error' : '' }}" name="question" id="question" value="{{ $survey->question }}">

        @if ($errors->has('question'))
        <div class="error">
          {{ $errors->first('question') }}
        </div>
        @endif
      </div>
      <div class="text-center">
        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Simpan</button>
      </div>
    </form>
  </div>
</div>

@endsection