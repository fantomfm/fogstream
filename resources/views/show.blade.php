@extends('layout')

@section('title', $user->name)

@section('content')
    <h1 class = "mt-5">Карточка пользователя {{ $user->name }}</h1>

    <div class = "card-user d-flex shadow p-3 mt-5 rounded ms-auto me-auto text-start">
        <div class = "me-auto ">
            @if ($picture = array_column($user->getLastPicture->toArray(),'path'))
                <img src="/storage/img/{{ implode(', ', array_column($user->getLastPicture->toArray(),'path')) }}" width="270"  class="rounded">
            @else
                <p>Фотографии нет</p>
            @endif
        </div>
        <div class="table-responsive col-8">
            <table class="table table-striped caption-top table-dark mb-3">
                <tbody class="align-middle text-start">
                    <tr>
                        <td>Имя</td>
                        <td class="fs-4">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Логин</td>
                        <td class="fs-4">{{ $user->user }}</td>
                    </tr>
                    <tr>
                        <td>Роль</td>
                        <td class="fs-4">{{ $user->role->role }}</td>
                    </tr>
                    <tr>
                        <td>Должность</td>
                        <td class="fs-4">{{ implode(', ', array_column($user->positions->toArray(),'position')) }}</td>
                    </tr>
                    <tr>
                        <td>Отдел</td>
                        <td class="fs-4">{{ implode(', ', array_column($user->departments->toArray(),'department')) }}</td>
                    </tr>
                </tbody>
            </table>
            @can('isAdmin')
            <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger">Удалить</a>
            @endcan
            @can('update', $user)
            <a href="{{ route('user.update', $user->id) }}" class="btn btn-success">Изменить</a>
            @endcan
            <a href="{{ route('user.users') }}" class="btn btn-warning">К списку</a>
        </div>
    </div>
@endsection