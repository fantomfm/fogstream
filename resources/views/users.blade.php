@extends('layout')

@section('title', 'Пользователи')

@section('content')
    <h1 class="mt-5">Пользователи системы</h1>

    @if($users)
        <div class="container-fluid table-responsive">
            <table class="table table-striped caption-top table-dark">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Фото</th>
                    <th scope="col">Имя пользователя</th>
                    <th scope="col">Логин</th>
                    <th scope="col">Должность</th>
                    <th scope="col">Отдел</th>
                    <th scope="col">Роль</th>
                    <th scope="col">Действие</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="align-middle text-start">
                            <td>{{ (($users->currentPage() - 1 ) * $users->perPage() ) + $loop->iteration }}</td>
                            <td>{{ implode(', ',array_column($user->pictures->toArray(),'path')) }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->user }}</td>
                            <td>{{ implode(', ',array_column($user->positions->toArray(),'position')) }}</td>
                            <td>{!! implode('<br/>',array_column($user->departments->toArray(),'department')) !!}</td>
                            <td>{{ $user->role->role }}</td>
                            <td class="text-center"><a href="{{ route('user.show', $user->id) }}">Посмотреть</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

        {{ $users->onEachSide(5)->links() }}
@endsection