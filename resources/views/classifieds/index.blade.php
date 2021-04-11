@extends ('layouts.master')
@section('content')
    <div class="container mt-2">
      <h2 class="font-weight-bold text-center">Resultados de la Busqueda</h2>
      <hr>
      <classifieds-search query="{{$query}}"></classifieds-search>
    </div>
@endsection
