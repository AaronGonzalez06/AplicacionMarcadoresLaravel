@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('message'))
            <div class="alert alert-primary" role="alert">
                {{session('message')}}
            </div>
            @endif
            <form id="formularioBuscar" class="col-md-7 d-flex" method="GET" action="{{ route('marcador.buscar') }}">
                <input id="titulo" class="form-control me-2 mr-3" type="search" placeholder="Search" aria-label="Search">
                <button id="buscar" class="btn btn-outline-success" type="submit">Search</button>
            </form>                                
                    @foreach($urls as $data)
                    <div class="card mb-3 mt-3">
                <div class="card-header"><span class="categoria" style="background-color: {{$data->categoria->color}};"><a class="link-primary" href="{{ route('categoria.marcadores',['id' => $data->categoria->id]) }}">{{$data->categoria->name}}</a></span></div>
                <div class="card-body">
                    <ul class="list-group">
                    <li class="list-group-item list-group-item-primary list-group-item-action">
                        <div class="card">
                        <div class="card-body">
                        <span class="d-flex modFlex">
                            <h5 class="card-title">  {{$data->titulo}} </h5>
                            <h6 class="card-title"> {{$data->created_at->format('d-m-Y')}}</h6>
                        </span>
                        <span class="d-flex modIcono">
                                <span>
                                <h6 class="card-subtitle mb-2 text-muted">{{$data->descripcion}}</h6>
                                <a href="{{$data->url}}" class="card-link" target="_blank">Ir al sitio</a>
                                <a href="{{ route('marcador.delete',['id' => $data->id]) }}" class="card-link">Eliminar marcador</a>
                                <a href="{{ route('marcador.editar',['id' => $data->id]) }}" class="card-link">Editar marcador</a>
                                </span>
                                @if($cantidad == 0)
                                    <img id="{{$data->id}}" class="icono" width="25" height="25" src="https://img.icons8.com/fluency/25/pin.png"/>
                                @else
                                @php
                                    $mostrar= true
                                @endphp
                                @foreach($fav as $favdata)
                                    @if( $favdata->marcador_id == $data->id)
                                        <img id="{{$data->id}}" class="icono fav" width="25" height="25" src="https://img.icons8.com/stickers/25/pin.png"/>
                                        @php
                                            $mostrar= false
                                        @endphp
                                    @endif
                                @endforeach
                                @if($mostrar)
                                    <img id="{{$data->id}}" class="icono" width="25" height="25" src="https://img.icons8.com/fluency/25/pin.png"/>
                                @endif
                                @endif
                            </span>                          
                        </div>
                        
                    </li>
                    </ul>
                </div>
            </div>
                    @endforeach
        </div>
    </div>
</div>
@endsection
