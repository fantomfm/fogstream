@extends('layout')

@section('title', 'Пользователи')

@section('content')
    <h1 class="mt-5">Пользователи системы</h1>

    @if($users)
        <div class="container-fluid table-responsive">
            <table class="table table-striped caption-top table-dark text-start">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Фото</th>
                    <th scope="col">Имя пользователя</th>
                    <th scope="col">Логин</th>
                    <th scope="col">Роль</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->user }}</td>
                        <td>{{ $user->role->role }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

        {{ $users->onEachSide(5)->links() }}
@endsection