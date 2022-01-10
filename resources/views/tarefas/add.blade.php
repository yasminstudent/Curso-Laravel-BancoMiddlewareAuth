@extends('layouts.layout_tarefas')

@section('title', 'Adição de Tarefas')

@section('content')
    <h1>Adição</h1>

    {{-- Verifica se existe algum erro --}}
    @if($errors->any())
        <x-alert>
            @foreach($errors->all() as $error)
                {{ $error  }} <br/>
            @endforeach
        </x-alert>
    @endif

    {{-- Usando uma propriedade flash --}}
    @if(session('warning'))
        <x-alert>
            {{session('warning')}}
        </x-alert>
    @endif

    <form method="POST">
        @csrf

        <label>
            Titulo <br>
            <input type="text" name="titulo">
        </label>

        <input type="submit" value="Adicionar">
    </form>
@endsection
