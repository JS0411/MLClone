@extends('layouts.master')
@section('content')
    <div class="container pt-2">
        <h3 class="text-center">Información de la {{$mode == 'bought' ? 'Compra' : 'Venta'}}</h3>
        <!-- Si el modo esta en compra, se mostrara eso, de lo contrario, venta -->
        <div class="row d-flex pt-3">
            <div class="col-4 text-center">
                <h5>Datos del {{$mode == 'bought' ? 'Vendedor' : 'Comprador'}}</h5>
                <hr>
                <p>Nombre del {{$mode == 'bought' ? 'Vendedor' : 'Comprador'}}: {{$partnerInfo->name}}</p>
                <p>Numero de Cedula: {{$partnerInfo->id_number}}</p>
                <p>Ubicacion: {{$partnerInfo->state}}, {{$partnerInfo->address}}</p>
                <p>Correo electronico: {{$partnerInfo->email}}</p>
                @if(!($purchase->active))
                    <h5>La compra ya ha finalizado...</h5>
                @elseif(($mode == 'sold' AND $purchase->seller_rated) OR ($mode == 'bought' AND $purchase->buyer_rated))
                    <h5>Ya has calificado
                        <h5>
                            @if(($mode == 'sold' AND !($purchase->buyer_rated)) OR ($mode == 'bought' AND !($purchase->seller_rated)))
                                <h5 class="pt-3">Esperando calificación del otro usuario para finalizar la venta...</h5>
                            @endif
                            @else
                                <p class="text-muted">Al finalizar la venta, o si hay algun problema, calificar al otro
                                    usuario...</p>
                                <a href="{{ route('reputation.create', ['id' => $purchase->id, 'mode' => $mode]) }}">
                                    <button class="btn-primary btn">
                                        Calificar {{$mode == 'bought' ? 'Vendedor' : 'Comprador'}}
                                    </button>
                                </a>
                                @if(($mode == 'sold' AND $purchase->buyer_rated) OR ($mode == 'bought' AND $purchase->seller_rated))
                                    <h5 class="pt-3">El otro usuario ya te ha calificado, califica para finalizar la
                                        venta.</h5>
                @endif
                @endif
            </div>
            <div class="col-8">
                <h5 class="text-center">Información del Articulo</h5>
                <hr>
                <a href="/classified/{{$purchase->classified_id}}" class="d-flex justify-content-center pl-5">
                    <img src="/storage/uploads/{{$purchase->image}}" class="col-3" alt="">
                    <div class="col-5">
                        <p>Articulo: {{$purchase->name}}</p>
                        <p class="">Precio: {{$purchase->price}} bs.</p>
                    </div>
                </a>
            </div>
        </div>
        <hr>
        <h5 class="text-center mb-3">Chat con el {{$mode == 'bought' ? 'Vendedor' : 'Comprador'}}</h5>
        <chat-box :purchase_id="{{$purchase->id}}" :active="{{$purchase->active}}"
                  mode="{{$mode == 'bought' ? 'buyer' : 'seller'}}"></chat-box>
    </div>
@endsection
