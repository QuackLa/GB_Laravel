@extends('main')

@section('content')
@if(session('admin'))

<div class="content">
    @if($alarm)
        <h3> {{ $alarm }} </h3>
    @endif

    <table>

    <form method="POST" action="{{ route('NewsEditOrDelete') }}">
    <tr><td>
    @csrf
        @foreach( $news as $byOne)
        <div class="block">
            <div> Номер новости: {{ $byOne -> id }} </div>
            <input type="radio" name="id" value='{{ $byOne -> id }}'>
            <div> {{ $byOne -> body }} </div><br>
            <div> Дата создания: {{ $byOne -> created_at }} </div>
            @if($byOne -> updated_at != NULL)
            <div> Дата изменения: {{ $byOne -> updated_at }} </div>
            @endif
        </div>
        @endforeach
    </td></tr>
    <tr><td>
        <textarea class="newText" name="text" placeholder="Новый текст новости"></textarea>
    </td></tr>
    <tr>
        <td>
            <button class="buttons" type="submit" name="submit" value='edit'>Редактировать новость</button>
            <button class="buttons" type="submit" name="submit" value='delete'>Удалить новость</button>
        </td>
    </tr>
    </form>

    </table>

</div>

@endif
@endsection