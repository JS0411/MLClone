@extends('layouts.master')
@section('content')
    <div class="container mt-4">
        <h2 class="text-center font-weight-bold">Publicaciones Favoritas</h2>
        @foreach($favorites as $favorite)
            <div class="d-flex pt-2">
                <a href="classified/{{$favorite['id']}}" class="p-2 mx-1 my-2 favorites">
                    <img src="/storage/uploads/{{$favorite['images'][0]['URI']}}" alt="">
                    <p>{{$favorite['name']}}</p>
                    <h3>Bs. {{$favorite['price']}}</h3>
                </a>
            </div>
        @endforeach
    </div>
@endsection

