<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarefa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TarefasORMController extends Controller
{
    /*
        Importar a Model primeiro
        $list = Tarefa::all(); //retorna todos os registros salvos
        Tarefa::where('resolvido', 0)->get(); //retorna todos os registros que obedecem a condição
        Tarefa::where('resolvido', 0)->first(); //retorna o 1º registro que obedece a condição
        Tarefa::where('resolvido', 0)->orWhere('resolvido', 1)->get(); // ...where resolvido = 0 or resolvido = 1
        Tarefa::where('resolvido', 0)->where('titulo', '!=', 'abc')->get(); //...where resolvido = 0 and titulo != 'abc'
        Tarefa::find(2); //busca item do id/chave primária passado(a)
        Tarefa::find([1, 2]); //busca itens dos ids/chaves primárias passados(as)
        Tarefa::where('resolvido', 0)->count(); //retorna a quantidade de registros que obedecem a condição

        //para inserir um item
        $t = new Tarefa;
        $t->titulo = 'Terminar o curso';
        $t->save();

        //para editar item
        $t = Tarefa::find(2);
        $t->titulo = 'Tarefa alterada';
        $t->resolvido = 1;
        $t->save();

        //para excluir item
        $t = Tarefa::find(3);
        $t->delete();

        //editação em massa
        $t = Tarefa::where('resolvido', 0)->update([
            'resolvido' => 1
        ]);

        //exclusão em massa
        $t = Tarefa::where('resolvido', 0)->delete();
    */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     */
    public function index(){
        $list = Tarefa::all();

        $user = Auth::user(); //essa linha pega o usuário logado
        //$user2 = $request->user(); //essa linha tbm

        return view('tarefas.list', [
            'list' => $list,
            'nome' => $user->name,
            'permissaoAddTarefa' => Gate::allows('add-tarefa')
        ]);
    }

    /**
     *
     */
    public function create(){
        return view('tarefas.add');
    }

    /**
     *
     */
    public function store(Request $request){
        $request->validate([
            'titulo' => ['required', 'string']
        ]);

        $titulo = $request->input('titulo');

        $tarefa = new Tarefa();
        $tarefa->titulo = $titulo;
        $tarefa->save();

        return redirect()->route('tarefas.list');
    }

    /**
     *
     */
    public function edit($id){
        $data = Tarefa::find($id);

        if($data){
            return view('tarefas.edit', [
                'data' => $data
            ]);
        }
        else{
            return redirect()->route('tarefas.list');
        }
    }

    /**
     *
     */
    public function update(Request $request, $id){
        $request->validate([
            'titulo' => ['required', 'string']
        ]);

        $titulo = $request->input('titulo');

//        $tarefa = Tarefa::find($id);
//        $tarefa->titulo = $titulo;
//        $tarefa->save();
        // --- ou ---
        Tarefa::find($id)->update(['titulo' => $titulo]);

        return redirect()->route('tarefas.list');
    }

    /**
     *
     */
    public function destroy($id){
        Tarefa::find($id)->delete();

        return redirect()->route('tarefas.list');
    }

    /**
     *
     */
    public function done($id){
        $tarefa = Tarefa::find($id);

        if($tarefa){
            $tarefa->resolvido = 1 - $tarefa->resolvido;
            $tarefa->save();
        }

        return redirect()->route('tarefas.list');
    }
}
