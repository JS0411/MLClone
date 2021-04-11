@extends('layouts.master')
@section('content')
    <reputations :user_id="{{$id}}" user_name="{{$user}}"></reputations>
@endsection
