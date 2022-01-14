@extends('layout')

@section('title', 'Регистрация')

@section('content')
<h3>Регистрация пользователя</h3>

<form class="text-start mt-5 form-center" method="post" action="{{ route('user.registration') }}">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Имя пользователя</label>
        <input type="text" class="form-control" id="name" name="name">
        @error('name')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="user" class="form-label">Логин пользователя</label>
        <input type="text" class="form-control" id="user" name="user">
        @error('user')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control mb-2" id="password" name="password">
        <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
        <input type="password_confirmation" class="form-control" id="password_confirmation" name="password_confirmation">
        @error('password')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    @error('formError')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    <button class="btn btn-success" type="submit" name="send" value="1">Зарегистрировать</button>
</form>
@endsection