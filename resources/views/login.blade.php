@extends('layout')

@section('title', 'Авторизация')

@section('content')
<h3>Авторизация пользователя</h3>

<form class="text-start mt-5 form-center" method="post" action="{{ route('user.login') }}">
    @csrf
    <div class="mb-3">
        <label for="user" class="form-label">Логин пользователя</label>
        <input type="text" class="form-control" id="user" name="user">
        @error('user')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="password" name="password">
        @error('password')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    @error('formError')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    <button class="btn btn-success" type="submit" name="send">Войти</button>
    <a href="{{ route('user.registration') }}" class="ms-3 btn btn-success">Зарегистрироваться</a>
</form>
@endsection