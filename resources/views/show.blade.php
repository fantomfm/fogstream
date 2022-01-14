@extends('layout')

@section('title', $user->name)

@section('content')
    <h1 class = "mt-5">Карточка пользователя {{ $user->name }}</h1>

    <div class = "card-user d-flex shadow p-3 mt-5 rounded ms-auto me-auto text-start">
        <div class = "me-auto ">{{ implode(', ', array_column($pictures->toArray(),'path')) }}</div>
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
                        <td class="fs-4">{{ $role->role }}</td>
                    </tr>
                    <tr>
                        <td>Должность</td>
                        <td class="fs-4">{{ implode(', ', array_column($positions->toArray(),'position')) }}</td>
                    </tr>
                    <tr>
                        <td>Отдел</td>
                        <td class="fs-4">{{ implode(', ', array_column($departments->toArray(),'department')) }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger">Удалить</a>
            <a href="{{ route('user.update', $user->id) }}" class="btn btn-success">Изменить</a>
        </div>
    </div>
@endsection