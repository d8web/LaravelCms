@extends('adminlte::page')
@section('title', 'Páginas')

@section('content_header')
    <h1>Minhas Páginas
        <a href="{{ route('pages.create') }}" class="btn btn-sm btn-success">Nova Página</a></h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th width="50">ID</th>
                    <th>Título</th>
                    <th width="200">Ações</th>
                </thead>

                @foreach($pages as $page)
                    <tbody>
                        <tr>
                            <td>{{$page->id}}</td>
                            <td>{{$page->title}}</td>
                            <td>
                                <a href="" target="_blank" class="btn btn-sm btn-success">Ver</a>
                                <a href="{{ route('page.edit', ['page' => $page->id]) }}" class="btn btn-sm btn-info">Editar</a>

                                <form
                                    class="d-inline"
                                    action="{{route('page.destroy', ['page' => $page->id])}}"
                                    method="post"
                                    onsubmit="return confirm('Tem certeza que deseja excluir?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Excluir</button>
                                </form>

                            </td>
                        </tr>
                    </tbody>
                @endforeach

            </table>
        </div>
    </div>

    <!-- Páginação usando bootstrap 4  -->
    {{ $pages->links('pagination::bootstrap-4') }}

@stop
