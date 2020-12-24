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
        @foreach($detail as $all)
        <td> {{ $all }} </td>
        @endforeach
    </tr>
    @endforeach
</table>
@endif
</div>
@endsection