@extends('main')

@section('content')
<div class="content">
@if($info)
<table class="LCtable">
    <tr>
        <td> Логин </td>
        <td> Пароль </td>
        <td> Имя </td>
        <td> Фамилия </td>
        <td> Электронная почта </td>
    </tr>
    <tr>
    @foreach($info as $detail)
        <td> {{ $detail->login }} </td>
        <td> {{ $detail->password }} </td>
        <td> {{ $detail->name }} </td>
        <td> {{ $detail->surname }} </td>
        <td> {{ $detail->email }} </td> 
    </tr>
    @endforeach
</table>
@endif
</div>
@endsection