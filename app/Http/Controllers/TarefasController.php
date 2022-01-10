<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TarefasController extends Controller
{
    /**
     *
     */
    public function index(){
        $list = DB::select('SELECT * FROM tarefas');
        //$list = DB::select('SELECT * FROM tarefas WHERE resolvido = :status', ['status' => 1]);
        return view('tarefas.list', [
            'list' => $list
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
        //Recurso de validação do próprio Laravel
        $request->validate([
            'titulo' => ['required', 'string']
        ]);

        $titulo = $request->input('titulo');

        DB::insert('INSERT INTO tarefas (titulo) VALUES(:titulo)',
            [ 'titulo' => $titulo ]
        );

        return redirect()->route('tarefas.list');
//        if($request->filled('titulo')){ //se o campo estiver preenchido
//            $titulo = $request->input('titulo');
//
//            DB::insert('INSERT INTO tarefas (titulo) VALUES(:titulo)',
//                [ 'titulo' => $titulo ]
//            );
//
//            return redirect()->route('tarefas.list');
//        }
//        else{
//            return redirect()
//                ->route('tarefas.add')
//                ->with('warning', 'Preencha o titulo!'); //É uma funcionalidade flash, uma vez lida ela some
//        }
    }

    /**
     *
     */
    public function edit($id){
        $data = DB::select('SELECT * FROM tarefas WHERE id = :id', ['id' => $id]);

        if(count($data) > 0){
            return view('tarefas.edit', [
                'data' => $data[0]
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

        DB::update('UPDATE tarefas SET titulo = :titulo WHERE id = :id', [
            'titulo' => $titulo,
            'id' => $id
        ]);

        return redirect()->route('tarefas.list');

//        if($request->filled('titulo')){
//            $titulo = $request->input('titulo');
//
//            DB::update('UPDATE tarefas SET titulo = :titulo WHERE id = :id', [
//                'titulo' => $titulo,
//                'id' => $id
//            ]);
//
//            return redirect()->route('tarefas.list');
//        }
//        else{
//            return redirect()
//                ->route('tarefas.edit', ['id' => $id])
//                ->with('warning', 'Preencha o titulo!');
//        }
    }

    /**
     *
     */
    public function destroy($id){
        DB::delete('DELETE FROM tarefas WHERE id = :id', [
            'id' => $id
        ]);

        return redirect()->route('tarefas.list');
    }

    /**
     *
     */
    public function done($id){
        DB::update('UPDATE tarefas SET resolvido = 1 - resolvido WHERE id = :id', [
            'id' => $id
        ]);

        return redirect()->route('tarefas.list');
    }
}
