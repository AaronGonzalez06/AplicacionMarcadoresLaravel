@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><span class="categoria" style="background-color: {{$categoria->color}};">{{$categoria->name}}</span></div>
                <div class="card-body">
                <ul class="list-group">

                    @if(count($categoria->urls) == 0)
                        <li class="list-group-item list-group-item-primary list-group-item-action">No tienes ningún marcador. Añada una!!</li>
                    @else
                        @foreach($categoria->urls()->orderBy('created_at', 'desc')->get() as $data)
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
                        @endforeach
                    @endif                                                            
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
