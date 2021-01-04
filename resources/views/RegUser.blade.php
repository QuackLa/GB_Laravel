@extends('main')

@section('content')
<div class="content">

@if($alarm)
    <div> {{ $alarm }}</div>
@else

    <form class="RegForm" method="POST" action="{{ route('RegUser') }}">
    @csrf
        <input type="text" name="newlogin" value="" placeholder="Логин">
        <input type="password" name="newpass" value="" placeholder="Пароль">
        <input type="text" name="newname" value="" placeholder="Имя">
        <input type="text" name="newsurname" value="" placeholder="Фамилия">
        <input type="email" name="newemail" value="" placeholder="Почта">
        <input class="submit" type="submit" name="submit" value="Зарегистрироваться">
    </form>

@endif

</div>
@endsection