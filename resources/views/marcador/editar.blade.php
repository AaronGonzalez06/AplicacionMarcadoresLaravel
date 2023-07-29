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
            <div class="card">
                <div class="card-header">Editar marcador</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('marcador.update') }}" aria-label="Nueva categoría">
                        @csrf

                        <div class="form-group row">
                            <label for="titulo" class="col-md-4 col-form-label text-md-right">{{ __('Titulo') }}</label>

                            <div class="col-md-6">
                                <input id="titulo" type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" value="{{$url->titulo}}" required autofocus>

                                @if ($errors->has('titulo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('titulo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <textarea id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" row="3" required autofocus>{{$url->descripcion}}</textarea>

                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Url') }}</label>

                            <div class="col-md-6">
                                <input id="url" type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" value="{{$url->url}}" required autofocus>

                                @if ($errors->has('url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                       
                        <div class="form-group row">
                            <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Categoría') }}</label>
                            <div class="col-md-6">                              
                                @foreach($categorias as $data)
                                    @if ($data->id == $url->categoria_id )
                                        <input id="categoria" name="categoria" type="radio" name="hm" value="{{$data->id}}" checked> <span class="categoria" style="background-color: {{$data->color}};">{{$data->name}}</span>                                    
                                    @else
                                        <input id="categoria" name="categoria" type="radio" name="hm" value="{{$data->id}}"> <span class="categoria" style="background-color: {{$data->color}};">{{$data->name}}</span>                                    
                                    @endif 
                                @endforeach
                            </div>
                        </div>
                        
                        <input id="idMarcador" type="hidden" name="idMarcador" value="{{$idMarcador}}">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Editar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
