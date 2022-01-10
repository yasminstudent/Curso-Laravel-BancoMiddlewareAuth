@extends('layouts.layout_tarefas')

@section('title', 'Edição de Tarefas')

@section('content')
    <h1>Edição</h1>

    @if($errors->any())
        <x-alert>
            @foreach($errors->all() as $error)
                {{ $error  }} <br/>
            @endforeach
        </x-alert>
    @endif

    @if(session('warning'))
        <x-alert>
            {{session('warning')}}
        </x-alert>
    @endif

    <form method="POST">
        @csrf

        <label>
            Titulo <br>
            <input type="text" name="titulo" value="{{ $data->titulo }}">
        </label>

        <input type="submit" value="Salvar">
    </form>
@endsection
