@extends('layouts.master')
@section('content')
<div class="container user-menu d-flex">
    <div class="vertical-menu pt-4 pb-4 d-block py-auto text-center">
        <h4 class="font-weight-bold">Menu de Navegación</h4>

        <a href="{{ route('questions.index', ['mode' => 'received']) }}" class="pr-2">
            <button class="btn mb-3">Preguntas sin responder...</button>
        </a>

        <br>

        <a href="{{ route('questions.index', ['mode' => 'asked']) }}" class="pr-2">
            <button class="btn mb-3">Preguntas realizadas</button>
        </a>

        <br>

        <a href="{{ route('purchase.index', ['item' => 'bought']) }}" class="pr-2">
            <button class="btn mb-3">Compras</button>
        </a>

        <br>

        <a href="{{ route('purchase.index', ['item' => 'sold']) }}" class="pr-2">
            <button class="btn mb-3">Ventas</button>
        </a>

        <br>

        <a href="/userinfo/classifieds" class="pr-2">
            <button class="btn mb-3">Tus Publicaciones</button>
        </a>

        <br>

        <a href="{{ route('reputation.index', ['id' => $user->id]) }}" class="pr-2">
            <button class="btn mb-3">Reputación</button>
        </a>

        <br>

        <a href="/userinfo/favorites" class="pr-2">
            <button class="btn mb-3">Tus Favoritos</button>
        </a>

    </div>
    <span class="vertical-divider"></span>
    <div class="info-box py-4" style="width: 100%">
        <div class="d-flex align-items-baseline">
            <i class="far fa-2x fa-id-card mr-2"></i>
            <h2 class="font-weight-bold pb-2">Información de Usuario</h2>
        </div>
        <hr>
        <ul>
            <li>
                <h4>Nombre de Usuario: {{$user->username}}</h4>
            </li>
            <li>
                <h4>Correo: {{$user->email}}</h4>
            </li>
            <li>
                @if ($user->debt == null)
                <h4>Deuda: 0 Bs.</h4>
                @else
                <h4>Deuda: {{$user->debt}} Bs.</h4>
                @endif
            </li>
        </ul>
        
        <hr>
        <div class="d-flex py-2 align-items-baseline">
            <i class="fas fa-2x fa-user mr-2"></i>
            <h2 class="font-weight-bold">Información Personal</h2>
        </div>
        <hr>
        <ul>
            <li>
                <h4>Nombre: {{$user->name}}</h4>
            </li>
            <li>
                <h4>Apellido: {{$user->surname}}</h4>
            </li>
            <li>
                <h4>Estado: {{$user->state}}</h4>
            </li>
            <li>
                <h4>Direccion: {{$user->address}}</h4>
            </li>
            <li>
                <h4>Fecha de Nacimiento: {{$user->birthdate}}</h4>
            </li>
        </ul>
    </div>
</div>
@endsection
