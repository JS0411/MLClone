@extends('layouts.master')
@section('content')
    <div class="container mt-3 rating-box ">
        <h2 class="text-center pt-2">Calificar {{$target == 'bought' ? 'vendedor' : 'comprador'}}...</h2>
        <hr>
        <div class="row py-4 justify-content-center">
            <div class="col-8">
                <a href="/classified/{{$purchase->classified_id}}" class ="d-flex">
                    <img src="/storage/uploads/{{$purchase->image}}" class=" mr-3 col-3" alt="">
                    <div class="col-5">
                        <h3 class="text-break">Nombre de articulo: {{$purchase->name}}</h3>
                        <h4>Precio: {{$purchase->price}}</h4>
                    </div>
                </a>
            </div>
        </div>
        <hr>
        <form action="{{ route('reputation.store', ['purchase_id' => $purchase->id, 'target' => ($target == 'bought' ? 'Seller' : 'Buyer')]) }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-9 offset-2">
                    <div class="d-flex">
                        <i class="fa fa-5x fa-comments"></i>
                        <div class="form-group ml-3 flex-grow-1">
                            <label for="description" class="col-form-label">Descripción</label>
                            <textarea id="description"
                                   placeholder="Cuentanos, ¿cómo te fue?"
                                   type="text"
                                   maxlength="300"
                                   class="form-control @error('description') is-invalid @enderror"
                                   name="description"
                                   required autocomplete="description">

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </textarea>
                        </div>
                    </div>

                    <div class="d-flex">
                        <i class="fa fa-5x fa-smile-o"></i>
                        <div class="form-group row ml-4">
                            <label for="rating" class="col-form-label">Calificación</label>
                            <select class="form-control" name="rating" id="rating" required>
                                <option value="">Selecciona una calificación</option>
                                <option value="Positive">Positivo</option>
                                <option value="Neutral">Neutro</option>
                                <option value="Negative">Negativo</option>
                            </select>

                            @error('rating')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>



                    </div>
                    <div class="row pt-5 pb-3 justify-content-center">
                        <button class="btn btn-primary">Calificar Usuario</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
