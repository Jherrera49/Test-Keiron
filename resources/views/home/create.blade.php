@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Nuevo Ticket
                </div>
                <div class="card-body">
                    <form class="form-group" action="{{route('home.index')}}" method="post">
                        @csrf
                        @method("post")
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Asignar ticket a:</label>
                                <select name="user" class="form-control">
                                    <option value="" disabled selected> Seleccione Usuario</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <a type="button" class="btn-primary btn-sm btn" href="{{url('home')}}"><i
                                        class="fas fa-angle-double-left"></i> Volver</a>
                                <button type="submit" class="btn-success btn-sm btn"><i class="fas fa-plus"></i>
                                    Agregar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection