@extends('layouts.master')
@section('content')
    <div class="container mt-2">
        <h2 class="font-weight-bold">{{$mode == 'bought' ? 'Compras' : 'Ventas'}} Realizadas</h3>
        <mypurchases-search :user_id="{{auth()->user()->id}}" mode="{{$mode}}"></mypurchases-search>
    </div>
@endsection
