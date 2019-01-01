@extends('layout')

@section('content')
    <h1>Create a new project</h1>
    
    <form method="POST" action="/projects">
    {{ csrf_field()}}

    <div class="field">
    <label for="title" class="label">Project Title</label>
    <div class="control">
    <input type="text" class="input {{ $errors -> has('title') ? 'is-danger' : '' }}" name="title" value="{{old('title')}}">
    </div>
    </div>

    <div class="field">
<label for="description" class="label">Project Description</label>
<div class="control">
    <textarea name="description">
    {{old('description')}}
    </textarea>

</div>
    </div>

    <div class="field">
    <button type="submit">Create Project</button>
    </div>

@if ($errors->any())
    <div class="notification is-danger">
    <ul>
    @foreach ($errors -> all() as $error)
<li>{{$error}}</li>
    @endforeach
    </ul>
    </div>
    @endif
    
    </form>
@endsection
