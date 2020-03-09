@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar Ticket #{{$ticket->id}}
                </div>
                <div class="card-body">
                    <form class="form-group" action="{{route('home.update', $ticket->id)}}" method="post">
                        @csrf
                        @method("patch")
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Asignar ticket a:</label>
                                <select name="user" class="form-control">
                                    @if(isset($ticket->id_user))
                                        <option value="{{$ticket->id_user}}">{{$ticket->user->name}}</option>
                                    @endif
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
                                    Modificar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection