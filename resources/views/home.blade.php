@extends('layouts.default')

@section('content')
<h1>User</h1>

<ul>
    <li>ID: {{ $user->id }}</li>
    <li>Name: {{ $user->name }}</li>
</ul>
<img src="{{ $user->photo }}">
</body>
@endsection