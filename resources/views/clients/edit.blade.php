@extends('layouts.app')
@section('titulo-pagina')
 <h1>Editar Cliente</h1>   
@endsection


@section('content')
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{route('clients.update',$client->id)}}">
               {{ csrf_field() }}
               {{method_field('PUT')}}

               @include('clients.form')
          </form>

          <a href="{{route('clients.index')}}">Voltar para a lista de clientes</a>
        </div>
      </div>
@endsection


