@extends('main')

@section('content')
<div class="content">
    <h3> Новости по категориям </h3>

    <table>

    <form method="GET" action="{{ route('NewsByCat') }}">
    <tr><td>
    @csrf
        @foreach($cat as $newsCategory)
        <div>
            {{ $newsCategory -> name }} 
            <input type="radio" name="choseCategory" value="{{ $newsCategory -> id }}">
        </div>
        @endforeach
    </td></tr>
    <tr><td>
        <input type="submit" value="Отобразить новости по данной категории">
    </td></tr>
    </form>

    </table>

    @if($checkButton)
    <table>

        <tr><td>
        @forelse($news as $one)
        <div class="NewsBlock">
            <div> {{ $one->body }} </div><br>
            <div> {{ $one->created_at }} </div>
        </div><br>
        @empty
            <div> Эта категория пуста </div>
        @endforelse
        </td></tr>

    </table>
    @endif

</div>
@endsection