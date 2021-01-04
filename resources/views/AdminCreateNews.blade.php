@extends('main')

@section('content')
@if(session('admin'))

    <div class="content">
    @if($alarm)
        <h3> {{ $alarm }} </h3>
    @endif

    <table>

    <form method="POST" action="{{ route('NewNewsCategory') }}"> 
    @csrf
        <tr><td>
            <input type="text" name="newCategory" value="" placeholder="Желаемое название">
        </tr></td>
        <tr><td>
            <input class="buttons" type="submit" value="Создать категорию">
        </td></tr>
    </form>


    <form method="POST" action="{{ route('NewsCreatePOST') }}"> 
    @csrf
        <tr><td>
            <textarea name="text" placeholder="Текст новости"></textarea>
        </tr></td>
        <tr><td>
            <div> Выберите категорию, к которой будет относиться новость: </div>
        </tr></td>
        @foreach($tableCategory as $category)
        <tr><td>
            {{ $category -> name }}
            <input type="radio" name="category_id" value='{{ $category -> id }}'>
        </tr></td>
        @endforeach
        <tr><td>
            <input class="buttons" type="submit" value="Создать новость">
        </td></tr>
    </form>

    </table>

</div>

@endif
@endsection