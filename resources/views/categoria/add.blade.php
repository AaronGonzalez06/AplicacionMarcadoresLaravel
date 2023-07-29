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
            <div class="card mb-5 mt-2">
                <div class="card-header">Nueva categoría</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('categoria.add.new') }}" aria-label="Nueva categoría">
                        @csrf

                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>

                            <div class="col-md-6">
                                <input id="color" type="color" class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}" name="color" required autofocus>

                                @if ($errors->has('color'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('color') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Añadir
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-5 mt-2">
                <div class="card-header">Mis categorías</div>
                <div class="card-body">
                <ul class="list-group">
                @foreach($categorias as $categoria)
                <li class="list-group-item list-group-item-primary list-group-item-action d-flex modFlexTwo">
                    <span>
                    <a class="link-primary" href="{{ route('categoria.marcadores',['id' => $categoria->id]) }}">
                        <span class="categoria" style="background-color: {{$categoria->color}};">{{$categoria->name}}</span>
                    </a>- Marcadores: {{count($categoria->urls)}} - 
                    <a href="{{ route('categoria.delete',['id' => $categoria->id]) }}" class="card-link">Eliminar</a>
                    </span>
                    <span>Fecha creación: {{$categoria->created_at->format('d-m-Y')}}</span>
                </li>
                @endforeach
                </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
