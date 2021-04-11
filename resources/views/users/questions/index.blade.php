@extends('layouts.master')
@section('content')
    <div class="container mt-2 content-spacing">
        @if($mode == 'received')
            <h2>Preguntas Recibidas:</h2>
        @elseif($mode == 'asked')
            <h2>Preguntas Hechas:</h2>
        @endif
        <replies-section :question_ids = "{{$questions}}" mode = "{{$mode}}"></replies-section>
    </div>
@endsection
