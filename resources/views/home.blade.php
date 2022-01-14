@extends('layout')

@section('title', 'Главная страница')

@section('content')
  <h1 class="mt-5">Главная страница</h1>
  <p class="lead">Тестовый проект для выполнения задания. Пожалуйста, войдите в систему.</p>
  <p class="lead pt-3">
      <a href="{{ route('user.login') }}" class="btn btn-lg btn-outline-success fw-bold">Войти</a>
  </p>
@endsection