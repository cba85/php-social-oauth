@extends('layouts.default')

@section('content')
<div class="text-center">
    <h1>Connectez-vous !</h1>

    <a href="/auth/github" class="btn-github">Sign in with Github <img src="/img/iconmonstr-github-1.svg" style="width: 11px"></a>

    <a href="/auth/facebook" class="btn-github">Sign in with Facebook <img src="/img/iconmonstr-facebook-6.svg" style="width: 11px"></a>
</div>

@endsection