<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Ticket;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $auth = Auth::id();
        $user = User::find($auth);
        if($user->id_tipouser == 1){
            $tickets = Ticket::all();
        }else{
            $tickets = Ticket::where('id_user', $user->id)->get();
        }
        return view('home.index', compact('user','tickets'));

    }

    public function create(){
        $users = User::where('id_tipouser', '2')->get();
        return view('home.create', compact('users'));
    }

    public function store(Request $request){
        $request->validate([
            'user' => 'required',
        ],[
            'user.required' => 'El campo Usuario es obligatorio',
        ]);

        $ticket = new Ticket;
        $ticket->id_user = $request->input('user');
        $ticket->save();
            
        return redirect()->route('home.index', $ticket->id)->with('success', 'Nuevo ticket creado con la id \'#'.$ticket->id.'\'');
    }

    public function edit($id){
        $ticket = Ticket::find($id);
        $users = User::where('id_tipouser','2')->get();
        return view('home.edit', compact('ticket','users'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'user' => 'required',
        ],[
            'user.required' => 'El campo Usuario es obligatorio',
        ]);

        $ticket = Ticket::find($id);
        $ticketCondition = [
            'id_user' => $request->input('user'),
        ];

        if ($ticket->id_user == $request->input('user')){
            return back()->withInput()->with('info', 'No hay cambios que guardar.');
        }else if(!Ticket::where($ticketCondition)->get()->first()){
            $ticket->id_user =  $request->input('user');
            $ticket->save();
            return redirect()->route('home.index')->with('success', 'Ticket #'.$id.' - '.$ticket->ticket.' modificada con éxito.');
        }else{
            return back()->withInput()->with('warning','El nombre \''.$request->input('ticket').'\' ya está registrado.');
        }
    }
    
    public function destroy($id){
        $ticket = Ticket::find($id);
        $ticket->delete();
        return redirect()->route('home.index')->with('success', 'Ticket #'.$id.' - '.$ticket->ticket.' eliminado con éxito.');;
    }

    public function changeStatus($id)
    {
        $ticket = Ticket::find($id);
        if($ticket){
            $opt = '';
            if($ticket->ticket_pedido == "Generado"){
                $opt = "Solicitado";
            }else{
                $opt = "Generado";
            }
            $ticket->ticket_pedido = $opt;
            $ticket->save();
            return redirect()->route('home.index')->with(
                [
                    "success" => "Se cambió el estado del ticket #".$id." a '".$opt."'"
                ]
            );
        }else{
            return redirect()->route('home.index');
        }
    }
}




    
