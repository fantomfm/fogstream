@extends('layout')

@section('title', 'Пользователи')

@section('content')
    <h1 class="mt-5">Пользователи системы</h1>

    <div class="container-fluid table-responsive">
        <form class="d-flex navbar-brand mb-3" method="GET" action="{{ route('user.users') }}">
            @csrf
            <input class="form-control me-2" id="search" name="search" type="search" placeholder="Поиск" value="{{ old('search') }}">
            <button class="btn btn-outline-success" type="submit">Найти</button>
        </form>
        @error('search')
            <p class="text-danger text-start">{{ $message }}</p>
        @enderror
    @if(count($users))
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
                <th scope="col">Дата регистрации</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="align-middle text-start">
                        <td>{{ (($users->currentPage() - 1 ) * $users->perPage() ) + $loop->iteration }}</td>
                        <td>
                            @if ($picture = array_column($user->getLastPicture->toArray(),'path'))
                                <img src="/storage/img/{{ implode(', ', $picture) }}" width="70"  class="rounded">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->user }}</td>
                        <td>{{ implode(', ',array_column($user->positions->toArray(),'position')) }}</td>
                        <td>{!! implode('<br/>',array_column($user->departments->toArray(),'department')) !!}</td>
                        <td>{{ $user->role->role }}</td>
                        <td>{{ $user->getDateRegistration() }}</td>
                        <td class="text-center"><a href="{{ route('user.show', $user->id) }}" class="btn btn-success btn-sm">Посмотреть</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->onEachSide(5)->links() }}
    @else
        <p class="text-warning">Данные не найдены!</p>
    @endif
    </div>
@endsection