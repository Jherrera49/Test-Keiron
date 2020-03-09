@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if($user->id_tipouser == 1)
                        Gestión de Tickets
                    @else
                        Mis Tickets
                    @endif
                </div>

                <div class="card-body">
                    @if($user->id_tipouser == 1)
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <a href="{{url('home/create')}}" class="btn btn-primary btn-sm col-sm-auto col">
                                <i class="fas fa-plus"></i>
                                Nuevo Ticket
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col table-responsive">
                            <table id="example" class="table table-hover table-stripped">
                                <thead>
                                    <tr>
                                        <th># Ticket</th>
                                        <th>Nombre Usuario</th>
                                        <th>Ticket Pedido</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($tickets as $ticket)
                                   <tr>
                                       <td>{{$ticket->id}}</td>
                                       <td>{{$ticket->user->name}}</td>
                                       <td>{{$ticket->ticket_pedido}}</td>
                                       <td>
                                           <div class="btn-group w-100 btn-group-s">
                                                <a class="btn-warning btn" href="{{route('home.edit',$ticket->id)}}"
                                                    title="Editar">Editar</a>
                                                <form action="{{route('home.destroy',$ticket->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger"
                                                        title="Eliminar Registro">Eliminar
                                                    </button>
                                                </form>
                                           </div>
                                       </td>
                                   </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col table-responsive">
                            <table id="example" class="table table-hover table-stripped">
                                <thead>
                                    <tr>
                                        <th># Ticket</th>
                                        <th>Ticket Pedido</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                   <tr>
                                       <td>{{$ticket->id}}</td>
                                       <td>{{$ticket->ticket_pedido}}</td>
                                       <td>
                                            @if($ticket->ticket_pedido == 'Generado')
                                                <div class="btn-group w-100 btn-group-s">
                                                        <a class="btn-success btn" href="{{route('home.changeStatus',$ticket->id)}}"
                                                            title="Solicitar">Solicitar</a>
                                                </div>
                                            @endif
                                       </td>
                                   </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection