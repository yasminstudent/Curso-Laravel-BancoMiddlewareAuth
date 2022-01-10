@extends('layouts.layout_tarefas')

@section('title', 'Listagem de Tarefas')

@section('content')
    <h1>Listagem</h1>

    @if(isset($nome))
        Olá {{$nome}}
    @endif

{{--    <a href="{{ url('tarefas/add') }}">Adicionar Nova Tarefa</a>--}}
    @if(isset($permissaoAddTarefa))
        @if($permissaoAddTarefa)
            <a href="{{ route('tarefas.add') }}">Adicionar Nova Tarefa</a>
        @endif
    @endif

    @if(count($list) > 0)
        <ul>
            @foreach($list as $item)
                <li>
                    <a href="{{ route('tarefas.done', ['id' => $item->id]) }}">[@if($item->resolvido) Desmarcar (✗) @else Marcar (✓) @endif]</a>
                    {{$item->titulo}}
                    <a href="{{ route('tarefas.edit', ['id' => $item->id]) }}">[ Editar (✎) ]</a>
                    <a href="{{ route('tarefas.del', ['id' => $item->id]) }}" onclick="return confirm('Tem certeza que deseja excluir?')">[ Excluir (✗)]</a>
                </li>
            @endforeach
        </ul>
    @else
        Não há itens para exibir
    @endif

@endsection
