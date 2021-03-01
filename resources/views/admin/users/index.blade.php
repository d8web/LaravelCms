@extends('adminlte::page')
@section('title', 'Usuários')

@section('content_header')
    <h1>Usuários <a href="{{ route('create') }}" class="btn btn-sm btn-success">Novo usuário</a> </h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </thead>

                @foreach($users as $user)
                    <tbody>
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a href="{{ route('edit', ['id' => $user->id]) }}" class="btn btn-sm btn-info">Editar</a>
                                @if($loggedId !== intval($user->id))
                                    <form
                                        class="d-inline"
                                        action="{{route('destroy', ['id' => $user->id])}}"
                                        method="post"
                                        onsubmit="return confirm('Tem certeza que deseja excluir?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Excluir</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
    {{ $users->links('pagination::bootstrap-4') }}

@stop
