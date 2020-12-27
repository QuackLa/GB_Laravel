@extends('main')

@section('content')
<div class="content">

@if($alarm)
    <div> {{ $alarm }}</div>
@else

<form class="RegForm" method="POST" action="{{ route('AuthUser') }}">
    @csrf
        <input type="text" name="login" value="" placeholder="Логин">
        <input type="password" name="pass" value="" placeholder="Пароль">
        <input class="submit" type="submit" name="submit" value="Войти">
        <button class="submit"><a href="{{ route('WannaReg') }}">Зарегистрироваться</a></button>
    </form>

@endif

</div>
@endsection