@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5 mt-1">
                <div class="card-header">Ultimos marcadores</div>
            </div>
        </div>
        <div class="col-md-8">
            @if(session('message'))
            <div class="alert alert-primary" role="alert">
                {{session('message')}}
            </div>
            @endif                               
                    @foreach($fav as $data)
                    <div class="card mb-3 mt-3 caja">
                <div class="card-header"><span class="categoria" style="background-color: {{$data->colorCategoria}};"><a class="link-primary" href="{{ route('categoria.marcadores',['id' => $data->categoria_id]) }}">{{$data->categoria}}</a></span></div>
                <div class="card-body">
                    <ul class="list-group">
                    <li class="list-group-item list-group-item-primary list-group-item-action">
                        <div class="card">
                        <div class="card-body">
                        <span class="d-flex modFlex">
                            <h5 class="card-title">  {{$data->titulo}} </h5>
                            <h6 class="card-title"> {{$data->fechaFormateada}}</h6>
                        </span>
                        <span class="d-flex modIcono">
                                <span>
                                <h6 class="card-subtitle mb-2 text-muted">{{$data->descripcion}}</h6>
                                <a href="{{$data->url}}" class="card-link" target="_blank">Ir al sitio</a>
                                <a href="{{ route('marcador.delete',['id' => $data->id]) }}" class="card-link">Eliminar marcador</a>
                                <a href="{{ route('marcador.editar',['id' => $data->id]) }}" class="card-link">Editar marcador</a>
                                </span>
                                <img id="{{$data->marcador_id}}" class="icono fav delete" width="25" height="25" src="https://img.icons8.com/stickers/25/pin.png"/>
                            </span>                          
                        </div>
                        
                    </li>
                    </ul>
                </div>
            </div>
                    @endforeach 
            <div class="alert alert-primary modificacion" role="alert">
                No hay ningún marcador guardado.
            </div>
        </div>
    </div>
</div>
@endsection
