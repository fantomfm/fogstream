@extends('layout')

@section('title', 'Изменение '.$user->name)

@section('content')
<h3>Изменить данные пользователя {{ $user->name }}</h3>

<form class="text-start mt-5 form-center" method="post" enctype="multipart/form-data" action="{{ route('user.update', $user->id) }}">
    @csrf
    <div class="mb-3">
        @foreach ($user->getLastPicture as $picture)
            @if ($picture->path)
                <div class ="d-flex">
                    <div><img src="/storage/img/{{ implode(', ', array_column($user->getLastPicture->toArray(),'path')) }}" width="200"  class="rounded"></div>
                    @can('update', $user)
                    <div class="mt-auto ms-3"><a href="{{ route('user.deleteImage', $user->id) }}" class="btn btn-danger">Удалить фото</a></div>
                    @endcan
                </div>
            @endif
        @endforeach
        <label for="image" class="form-label">Фото пользователя</label>
        <input type="file" class="form-control" id="image" name="image">
        <p>Только jpg, png. Размер не больше 2 Мб.</p>
        @error('image')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Имя пользователя</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        @error('name')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="user" class="form-label">Логин пользователя</label>
        <input type="text" class="form-control" id="user" name="user" value="{{ $user->user }}">
        @error('user')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    @can('isAdmin')
    <div class="mb-3">
        <div class="form-group">
            <label for="role" class="form-label">Роль</label>
            <select class="form-control" id="role" name="role">
                @foreach ($rolesAll as $role)
                    @if ($role->id == $user->role_id)
                        <option value="{{ $role->id }}" selected>{{ $role->role }}</option>
                    @else
                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        @error('role')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    @endcan
    @can('update')
    <div class="mb-3">
        <div class="form-group">
            <label for="position" class="form-label">Должность</label>
            <select class="form-control" id="position" name="position">
                @foreach ($positionsAll as $position)
                    @if (in_array($position->id, array_column($user->positions->toArray(),'id')))
                        <option value="{{ $position->id }}" selected>{{ $position->position }}</option>
                    @else
                        <option value="{{ $position->id }}">{{ $position->position }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        @error('position')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <div class="form-group">
            <label for="departments" class="form-label">Отдел</label>
            <select class="form-control" multiple id="departments" name="departments[]">
                @foreach ($departmentsAll as $department)
                    @if (in_array($department->id, array_column($user->departments->toArray(),'id')))
                        <option value="{{ $department->id }}" selected>{{ $department->department }}</option>
                    @else
                        <option value="{{ $department->id }}">{{ $department->department }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        @error('departments')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    @endcan
    @error('formError')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    <button class="btn btn-success" type="submit" name="send" value="1">Сохранить</button>
    <a href="{{ route('user.show', $user->id) }}" class="btn btn-warning">Назад</a>
</form>
@endsection