@extends('layouts.master')
@section('content')
<div class="container content-spacing classified" style="">
    @if($classified->active == 0)
        <div class="alert alert-primary text-center mt-2">
            <strong>Publicación Finalizada.</strong>
        </div>
    @endif
    <div class="row pt-2">
        <div class="col-8">
            <image-gallery :images-prop = "{{ json_encode($classified->images)}}"> </image-gallery>
            <hr>
            <div class="mt-4">
                <h3>Descripción de la Publicación:</h3>
                <div class="my-4">
                    <p class="lead">{{$classified->description}}</p>
                </div>
            </div>
        </div>
        <div class ="col-4 ">
            <div class="p-4 info-box">
                <div class="row mr-2">
                    <div class="col-10">
                       <h2 class="font-weight-bold">{{$classified->name}}</h2> 
                    </div>
                    <div class="col-2">
                        @if(auth::check())
                            @if($classified->active AND $classified->sellerProfile->user->id != auth()->user()->id)
                                <favorite-button :classified_id ="{{$classified->id}}" favorited = "{{$favorited}}"></favorite-button>
                            @endif
                        @endif
                    </div>
                </div>

                <hr class="divider">
                <p class="font-weight-light mb-2" style="color: #939393;">Articulo {{$classified->usage}}</p>
                <h2>Bs. {{$classified->price}}</h2>
                @if($classified->active AND $classified->sellerProfile->user->id != auth()->user()->id)
                    <a href={{ route('purchase.create', ['classified_id' => $classified->id]) }}>
                      <button class="link btn pt-2 mt-2" style="">
                        <strong>Comprar</strong>
                      </button>
                    </a>
                @endif
            </div>
            <hr>
            <div class="p-4 info-box">
                <h4 class=" font-weight-bold text-center">Datos del Vendedor</h2>
                <hr>
                <h4 class="font-weight-bold text-center">Ubicacion: {{$classified->sellerProfile->user->state}},{{$classified->sellerProfile->user->address}}</h4>
                <hr>
                <h4 class="font-weight-bold text-center" style="margin:20px 0px 10px 0px">Nivel de Reputación</h4>
                <reputation-gradient :sales-count = "{{$classified->sellerProfile->sales_count}}"
                    :positive-rep = "{{$classified->sellerProfile->positive_rep}}">
                </reputation-gradient>
                <hr>
                <div class="row mt-2 text-center">
                    <div class="col-4" style="">
                        <p class="font-weight-bold">Ventas Totales</p>
                        <h2>{{$classified->sellerProfile->sales_count}}</h2>
                    </div>
                    <div class="col-4">
                        <p class="font-weight-bold">Ventas Positivas</p>
                        <h2>{{$classified->sellerProfile->positive_rep}}</h2>
                    </div>
                    <div class="col-4">
                        <p class="font-weight-bold">Ventas Negativas</p>
                        <h2>{{$classified->sellerProfile->negative_rep}}</h2> 
                    </div>
                </div>
                <hr>
                <a class="btn link pt-2 mt-2" href="/userinfo/1/reputation">
                    <strong>Ver reputación del vendedor</strong>
                </a>
            </div>
        </div>
    </div>

    <questions-section classified_id = "{{$classified->id}}"
     active="{{$classified->active}}"
     reader_id="{{auth::check() ? auth()->user()->id : 0}}"
     owner_id="{{$classified->sellerProfile->user->id}}"></questions-section>
 </div>
 @endsection
