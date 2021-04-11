@extends('layouts.master')
@section('content')
    <div class="container mt-2">
        <h2 class="font-weight-bold">Mis Publicaciones</h2>
        <myclassifieds-search :user_id="{{auth()->user()->id}}"></myclassifieds-search>
    </div>
@endsection

