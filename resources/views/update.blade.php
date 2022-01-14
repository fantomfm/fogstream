@extends('layout')

@section('title', 'Изменение '.$user->name)

@section('content')
<h3>Изменить данные пользователя {{ $user->name }}</h3>

<form class="text-start mt-5 form-center" method="post" action="{{ route('user.update', $user->id) }}">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Имя пользователя</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        @error('name')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <div class="form-group">
            <label>Должность</label>
            <select class="form-control input-sm" name="category_id">
                @foreach ($positionsAll as $position)
                    
                        <option value="{{ $position->id }}" active>{{ $position->position }}</option>
                @endforeach
            </select>
        </div>
        @error('position')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    @error('formError')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    <button class="btn btn-success" type="submit" name="send" value="1">Изменить</button>
</form>
@endsection