@extends('layouts.master')
@section('content')
    <div id="carousel-banner" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-banner" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-banner" data-slide-to="1"></li>
            <li data-target="#carousel-banner" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="/assets/img/mlslide-1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/assets/img/mlslide-2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/assets/img/mlslide-3.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel-banner" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-banner" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container mt-4 pl-4">
        <h2 class="font-weight-bold">Publicaciones Populares</h2>
        <classified-gallery></classified-gallery>
    </div>
@endsection
